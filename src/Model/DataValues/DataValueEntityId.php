<?php

namespace Model\DataValues;

class DataValueEntityId extends DataValue
{
    protected $type = 'wikibase-entityid';

    protected $entityType;
    protected $id;
    protected $numericId;

    public function __construct($data)
    {
        $this->setEntityType($data['entity-type']);
        $this->setId($data['id']);
        $this->setNumericId($data['numeric-id']);
    }

    /**
     * @return mixed
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @param mixed $entityType
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
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
    public function getNumericId()
    {
        return $this->numericId;
    }

    /**
     * @param mixed $numericId
     */
    public function setNumericId($numericId)
    {
        $this->numericId = $numericId;
    }

    public function getValue()
    {
        return array(
            'entity-type' => $this->getEntityType(),
            'id' => $this->getId(),
            'numeric-id' => $this->getNumericId(),
        );
    }

}