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
     * @param mixed $monday
     */
    public function setMonday($monday): void
    {
        $this->monday = $monday;
    }

    /**
     * @return mixed
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @param mixed $tuesday
     */
    public function setTuesday($tuesday): void
    {
        $this->tuesday = $tuesday;
    }

    /**
     * @return mixed
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @param mixed $wednesday
     */
    public function setWednesday($wednesday): void
    {
        $this->wednesday = $wednesday;
    }

    /**
     * @return mixed
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * @param mixed $thursday
     */
    public function setThursday($thursday): void
    {
        $this->thursday = $thursday;
    }

    /**
     * @return mixed
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * @param mixed $friday
     */
    public function setFriday($friday): void
    {
        $this->friday = $friday;
    }

    /**
     * @return mixed
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * @param mixed $saturday
     */
    public function setSaturday($saturday): void
    {
        $this->saturday = $saturday;
    }

    /**
     * @return mixed
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * @param mixed $sunday
     */
    public function setSunday($sunday): void
    {
        $this->sunday = $sunday;
    }


}