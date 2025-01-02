<?php

namespace App\Models;

use App\Core\Model;
use DateTime;

class Advert extends Model
{
    protected $id;
    protected $dateOfCreate;
    protected $timeOfLastEdit;
    protected $text;
    protected $title;
    protected $ownerId;
    protected $categoryId;
    protected $villageId;
    protected $price;
    protected $views;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setDateOfCreate($dateOfCreate): void
    {
        $this->dateOfCreate = $dateOfCreate;
    }

    /**
     * @return mixed
     */
    public function getDateOfCreate()
    {
        return $this->dateOfCreate;
    }


    /**
     * @return mixed
     */
    public function getTimeOfLastEdit()
    {
        return $this->timeOfLastEdit;
    }

    /**
     * @param mixed $timeOfLastEdit
     */
    public function setTimeOfLastEdit($timeOfLastEdit): void
    {
        $this->timeOfLastEdit = $timeOfLastEdit;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
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
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }


    /**
     * @return mixed
     */
    public function getVillageId()
    {
        return $this->villageId;
    }

    /**
     * @param mixed $villageId
     */
    public function setVillageId($villageId): void
    {
        $this->villageId = $villageId;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views): void
    {
        $this->views = $views;
    }


    protected  $monday;
    protected  $tuesday;
    protected  $wednesday;
    protected  $thursday;
    protected  $friday;
    protected $saturday;
    protected $sunday;

    /**
     * @return mixed
     */
    public function getMonday()
    {
        return $this->monday;
    }


    /**
     * @return mixed
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @return mixed
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @return mixed
     */
    public function getThursday()
    {
        return $this->thursday;
    }



    /**
     * @return mixed
     */
    public function getFriday()
    {
        return $this->friday;
    }


    /**
     * @return mixed
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @return mixed
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    public function setMonday($monday) {
        $this->monday = $monday ? 1 : 0;
    }

    public function setTuesday($tuesday) {
        $this->tuesday = $tuesday ? 1 : 0;
    }

    public function setWednesday($wednesday) {
        $this->wednesday = $wednesday ? 1 : 0;
    }

    public function setThursday($thursday) {
        $this->thursday = $thursday ? 1 : 0;
    }

    public function setFriday($friday) {
        $this->friday = $friday ? 1 : 0;
    }

    public function setSaturday($saturday) {
        $this->saturday = $saturday ? 1 : 0;
    }

    public function setSunday($sunday) {
        $this->sunday = $sunday ? 1 : 0;
    }


}