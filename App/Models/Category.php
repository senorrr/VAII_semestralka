<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    protected int $id;
    protected String $name;
    protected String $destinationOfPicture;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDestinationOfPicture(): string
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}