<?php

namespace App\Models;

use App\Core\Model;

class Status extends Model
{
    protected int $id;
    protected string $popis;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPopis(): string
    {
        return $this->popis;
    }

    public function setPopis(string $popis): void
    {
        $this->popis = $popis;
    }


}