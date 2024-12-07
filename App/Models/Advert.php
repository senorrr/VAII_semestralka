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
    protected $owner;
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
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
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

    protected ?bool $monday;
    protected ?bool $tuesday;
    protected ?bool $wednesday;
    protected ?bool $thursday;
    protected ?bool $friday;
    protected ?bool $saturday;
    protected ?bool $sunday;

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    public function setMonday(?bool $monday): void
    {
        $this->monday = $monday;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    public function setTuesday(?bool $tuesday): void
    {
        $this->tuesday = $tuesday;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    public function setWednesday(?bool $wednesday): void
    {
        $this->wednesday = $wednesday;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    public function setThursday(?bool $thursday): void
    {
        $this->thursday = $thursday;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    public function setFriday(?bool $friday): void
    {
        $this->friday = $friday;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    public function setSaturday(?bool $saturday): void
    {
        $this->saturday = $saturday;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    public function setSunday(?bool $sunday): void
    {
        $this->sunday = $sunday;
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


}