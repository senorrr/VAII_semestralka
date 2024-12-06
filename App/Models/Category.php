<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    protected $id;
    protected $name;
    protected $destinationOfPicture;

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDestinationOfPicture()
    {
        return $this->destinationOfPicture;
    }

    /**
     * @param mixed $destinationOfPicture
     */
    public function setDestinationOfPicture($destinationOfPicture): void
    {
        $this->destinationOfPicture = $destinationOfPicture;
    }


}