<?php

namespace App\Models;

use App\Core\Model;

class Photo extends Model
{
    protected String $url;
    protected int $id;
    protected int $advertId;

    /**
     * @return mixed
     */
    public function getUrl(): string
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
     * @return int
     */
    public function getAdvertId(): int
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