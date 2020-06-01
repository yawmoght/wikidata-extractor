<?php

namespace client;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Model\EntityBuilder;

class WikidataClient
{
    /** @var Client */
    protected $guzzleClient;

    /**
     * @var EntityBuilder
     */
    protected $entitiesBuilder;

    protected $entities = array();
    protected $entitiesLimit = 1;
    /**
     * WikidataClient constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
        $this->entitiesBuilder = new EntityBuilder();
    }

    /**
     * @param int $entitiesLimit
     */
    public function setEntitiesLimit($entitiesLimit)
    {
        if ($entitiesLimit < 1){
            $entitiesLimit = 1;
        }
        $this->entitiesLimit = $entitiesLimit;
    }

    /**
     * Adds an entity request to the queue. If this fills the queue, executes request, clears queue and returns response.
     * @param $entity
     * @return array
     */
    public function requestEntity($entity)
    {
        $this->addEntityToQueue($entity);

        $response = $this->checkRequest();

        if (!empty($response)){
            $this->entities = array();
            $response = $this->entitiesBuilder->buildEntities($response);
        }

        return $response;
    }

    /**
     * Executes request with queued entities, clears the queue and returns response.
     */
    public function requestQueued()
    {
        $response = $this->checkRequest();
        $this->entities = array();

        return $response;
    }

    protected function checkRequest()
    {
        if (!$this->isRequestNeeded()) {
            return array();
        }

        $uri = $this->buildUri();
        $clientOptions = $this->buildOptions();
        $response = $this->guzzleClient->get($uri, $clientOptions);

        $jsonString = $response->getBody()->getContents();

        return json_decode($jsonString, true);
    }

    protected function isRequestNeeded()
    {
        return count($this->entities) >= $this->entitiesLimit;
    }

    protected function buildUri()
    {
        $entities = $this->buildEntitiesQuery();

        return 'https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=' . $entities;
    }

    protected function buildEntitiesQuery()
    {
        return implode('|', $this->entities);
    }

    protected function buildOptions()
    {
        return [RequestOptions::HEADERS => ['Accept' => 'application/json']];
    }

    protected function addEntityToQueue($entity)
    {
        $this->entities[] = $entity;

        return true;
    }

}