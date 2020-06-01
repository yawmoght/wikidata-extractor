<?php

namespace Model;

class Entity extends DataModel
{
    protected $id;
    protected $type;
    protected $labels = array();
    protected $descriptions = array();
    protected $aliases = array();
    protected $claims = array();
    protected $sitelinks = array();
    protected $lastrevid;
    protected $modified;

    /**
     * Entity constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setId($data['id']);
        $this->setType($data['type']);
        $this->setLabels($data['labels']);
        $this->setDescriptions($data['descriptions']);
        $this->setAliases($data['aliases']);
        $this->setClaims($data['claims']);
        $this->setSitelinks($data['sitelinks']);
        $this->setLastrevid($data['lastrevid']);
        $this->setModified($data['modified']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param array $labels
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    /**
     * @return array
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param array $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @param array $aliases
     */
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
    }

    /**
     * @return array
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @param array $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
    }

    /**
     * @return array
     */
    public function getSitelinks()
    {
        return $this->sitelinks;
    }

    /**
     * @param array $sitelinks
     */
    public function setSitelinks($sitelinks)
    {
        $this->sitelinks = $sitelinks;
    }

    /**
     * @return mixed
     */
    public function getLastrevid()
    {
        return $this->lastrevid;
    }

    /**
     * @param mixed $lastrevid
     */
    public function setLastrevid($lastrevid)
    {
        $this->lastrevid = $lastrevid;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'type' => $this->getType(),
            'labels' => $this->getLabels(),
            'descriptions' => $this->getDescriptions(),
            'aliases' => $this->getAliases(),
            'claims' => $this->getClaims(),
            'sitelinks' => $this->getSitelinks(),
            'lastrevid' => $this->getLastrevid(),
            'modified' => $this->getModified(),
        );
    }

}