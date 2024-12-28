<?php

namespace App\Models;

use App\Core\Model;

class Photo extends Model
{
    protected $url;
    protected $advert;

    public static function getPkColumnName(): string
    {
        return 'url';
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
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @param mixed $advert
     */
    public function setAdvert($advert): void
    {
        $this->advert = $advert;
    }




}