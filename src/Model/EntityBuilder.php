<?php

namespace Model;

use Model\DataValues\DataValueCoordinate;
use Model\DataValues\DataValueEntityId;
use Model\DataValues\DataValueQuantity;
use Model\DataValues\DataValueString;
use Model\DataValues\DataValueTime;

class EntityBuilder
{
    protected $allowedClaims = array();

    /**
     * @param $allowedClaims
     */
    public function __construct($allowedClaims)
    {
        $this->allowedClaims = $allowedClaims;
    }


    public function buildEntities($response)
    {
        $entities = array();
        $entitiesJSON = $response['entities'];

        foreach ($entitiesJSON as $entityJSON){
            $entities[] = $this->buildEntity($entityJSON);
        }

        return $entities;
    }

    protected function buildEntity($entityJSON)
    {
        $entity = new Entity($entityJSON);
        $this->hydrate($entity);

        return $entity;
    }

    /**
     * @param Entity $entity
     */
    protected function hydrate(Entity $entity)
    {
        $this->hydrateLabels($entity);
        $this->hydrateAliases($entity);
        $this->hydrateDescriptions($entity);
        $this->hydrateSiteLinks($entity);
        $this->hydrateClaims($entity);
    }

    protected function hydrateLabels(Entity $entity)
    {
        $labelsJSON = $entity->getLabels();
        $labels = $this->buildLocaleValues($labelsJSON);

        $entity->setLabels($labels);

        return $entity;
    }

    protected function hydrateDescriptions(Entity $entity)
    {
        $descriptionsJSON = $entity->getDescriptions();
        $descriptions = $this->buildLocaleValues($descriptionsJSON);

        $entity->setDescriptions($descriptions);

        return $entity;
    }

    protected function hydrateAliases(Entity $entity)
    {
        $aliasesJSON = $entity->getAliases();

        $aliases = array();
        foreach ($aliasesJSON as $language => $languageAliases)
        {
            $newAliases = $this->buildLocaleValues($languageAliases);
            $aliases = array_merge($aliases, $newAliases);
        }

        $entity->setAliases($aliases);

        return $entity;
    }

    protected function buildLocaleValues($jsons)
    {
        $array = array();
        foreach ($jsons as $json)
        {
            $array[] = new LocaleValue($json);
        }

        return $array;
    }

    protected function hydrateSiteLinks(Entity $entity)
    {
        $siteLinksJson = $entity->getSitelinks();

        $siteLinks = array();
        foreach ($siteLinksJson as $siteLinkJson)
        {
            $siteLinks[] = new SiteLink($siteLinkJson);
        }

        $entity->setSitelinks($siteLinks);
    }

    protected function hydrateClaims(Entity $entity)
    {
        $claimsJSON = $entity->getClaims();

        $claims = array();
        foreach ($claimsJSON as $property => $propertyClaimsJSON)
        {
            if (!empty($this->allowedClaims) && !in_array($property, $this->allowedClaims)){
                continue;
            }

            foreach ($propertyClaimsJSON as $claimJSON){
                $json = $claimJSON['mainsnak'];
                $snak = $this->buildSnak($json);
                $this->hydrateQualifiers($claimJSON, $snak);
                $claims[] = $snak;
            }
        }

        $entity->setClaims($claims);
    }

    protected function buildSnak($snakJson)
    {
        $snak = new Snak($snakJson);
        $this->hydrateDataValue($snak);

        return $snak;

    }

    protected function hydrateDataValue(Snak $snak)
    {
        $datavalueJSON = $snak->getDatavalue();
        if (empty($datavalueJSON)){
            $snak->setDatavalue(array());
            return;
        }

        $type = $datavalueJSON['type'];
        $valueJSON = $datavalueJSON['value'];

        $value = $valueJSON;
        switch ($type) {
            case 'string':
                $value = new DataValueString($valueJSON);
                break;
            case 'wikibase-entityid':
                $value = new DataValueEntityId($valueJSON);
                break;
            case 'globecoordinate':
                $value = new DataValueCoordinate($valueJSON);
                break;
            case 'quantity':
                $value = new DataValueQuantity($valueJSON);
                break;
            case 'time':
                $value = new DataValueTime($valueJSON);
                break;
        }

        $datavalue = array('type' => $type, 'value' => $value);

        $snak->setDatavalue($datavalue);
    }

    protected function hydrateQualifiers($claimJSON, Snak $snak)
    {
        if (!isset($claimJSON['qualifiers'])){
            return;
        }

        foreach ($claimJSON['qualifiers'] as $qualifiersJSON)
        {
            foreach ($qualifiersJSON as $qualifierJSON)
            {
                $qualifier = $this->buildSnak($qualifierJSON);
                $snak->addQualifier($qualifier);
            }
        }
    }
}