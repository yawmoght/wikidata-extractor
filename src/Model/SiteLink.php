<?php

namespace Model;

class SiteLink extends DataModel
{
    protected $site;
    protected $title;
    protected $badges = array();
    protected $url;

    /**
     * SiteLink constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->site = $data['site'];
        $this->title = $data['title'];
        $this->badges = $data['badges'];
        if (isset($data['url'])){
            $this->url = $data['url'];
        }
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * @param array $badges
     */
    public function setBadges($badges)
    {
        $this->badges = $badges;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function jsonSerialize()
    {
        return array(
            'site' => $this->getSite(),
            'title' => $this->getTitle(),
            'badges' => $this->getBadges(),
            'url' => $this->getUrl(),
        );
    }

}