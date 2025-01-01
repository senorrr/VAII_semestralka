<?php

namespace App\Models;

use App\Core\Model;

class Photo extends Model
{
    protected $url;
    protected $id;
    protected $advertId;

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
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAdvertId()
    {
        return $this->advertId;
    }

    /**
     * @param mixed $advertId
     */
    public function setAdvertId($advertId): void
    {
        $this->advertId = $advertId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}