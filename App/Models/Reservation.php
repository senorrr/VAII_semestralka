<?php

namespace App\Models;

use App\Core\Model;

class Reservation extends Model
{
    protected int $id;
    protected int $advertId;
    protected string $from;
    protected string $to;
    protected int $reservedBy;
    protected string $message;
    protected int $statusId;
    protected float $totalCost;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAdvertId(): int
    {
        return $this->advertId;
    }

    public function setAdvertId(int $advertId): void
    {
        $this->advertId = $advertId;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): void
    {
        $this->from = $from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $to): void
    {
        $this->to = $to;
    }

    public function getReservedBy(): int
    {
        return $this->reservedBy;
    }

    public function setReservedBy(int $reservedBy): void
    {
        $this->reservedBy = $reservedBy;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getTotalCost(): float
    {
        return $this->totalCost;
    }

    public function setTotalCost(float $totalCost): void
    {
        $this->totalCost = $totalCost;
    }



}