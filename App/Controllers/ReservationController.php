<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class ReservationController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->redirect($this->url('reservation.reservation'));
    }

    public function reservation()
    {
        return $this->html();
    }
}