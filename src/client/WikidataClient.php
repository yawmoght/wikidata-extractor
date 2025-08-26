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
    protected $entitiesLimit = 10;

    protected $userClient;
    /**
     * WikidataClient constructor.
     */
    public function __construct($allowedClaims = array(), $entitiesLimit = 1, $userClient = 'WikidataClient')
    {
        $this->guzzleClient = new Client();
        $this->entitiesBuilder = new EntityBuilder($allowedClaims);
        $this->entitiesLimit = $entitiesLimit;
        $this->userClient = $userClient;
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
    public function requestAndCleanQueued()
    {
        $response = $this->checkRequest(true);
        $this->entities = array();

        return $response;
    }

    protected function checkRequest($force = false)
    {
        if (!$force && !$this->isRequestNeeded()) {
            return array();
        }

        $response = $this->fetchResponse();

        $jsonString = $response->getBody()->getContents();

        return json_decode($jsonString, true);
    }

    protected function isRequestNeeded()
    {
        return count($this->entities) >= $this->entitiesLimit;
    }

    protected function fetchResponse(){
        $uri = $this->buildUri();
        $clientOptions = $this->buildOptions();
        return $this->guzzleClient->get($uri, $clientOptions);
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
        return [RequestOptions::HEADERS => ['Accept' => 'application/json',
                                            'User-Agent' => $this->userClient,]];
    }

    protected function addEntityToQueue($entity)
    {
        $this->entities[] = $entity;

        return true;
    }

}