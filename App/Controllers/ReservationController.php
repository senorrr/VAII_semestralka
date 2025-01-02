<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Advert;
use App\Models\Reservation;

class ReservationController extends AControllerBase
{
    public function authorize(string $action):bool
    {
        switch ($action) {
            case 'new':
            case 'myReservations':
                return $this->app->getAuth()->isLogged();
            default: return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->redirect($this->url('reservation.new'));
    }

    public function new(): Response
    {
        $advertId = $this->app->getRequest()->getGet()['0'];
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['from']) && $formData['to'] && isset($advertId)) {
            if ($formData['from'] <= $formData['to']) {
                $reservation = new Reservation();
                $reservation->setAdvertId($advertId);
                $reservation->setReservedBy($this->app->getAuth()->getLoggedUserId());
                $reservation->setFrom($formData['from']);
                $reservation->setTo($formData['to']);
                $reservation->setStatus(1);
                $advert = Advert::getOne($advertId);
                $cost = $reservation->getTo() - $reservation->getFrom();
                $cost += 1;
                $cost = $cost * $advert->getPrice();
                $reservation->setTotalCost($cost);
                if ($formData['message']) {
                    $reservation->setMessage($formData['message']);
                }
                $reservation->save();
                return $this->redirect($this->url('reservation.myReservations'));
            }
        }
        return $this->html($advertId);
    }

    public function myReservations(): Response
    {
        $resevations = Reservation::getAll(whereClause: '`reservedBy` LIKE ?', whereParams: [$this->app->getAuth()->getLoggedUserId()]);
        return $this->html($resevations);
    }
}