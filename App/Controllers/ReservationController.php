<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Advert;
use App\Models\Reservation;
use App\Models\User;
use PDO;

class ReservationController extends AControllerBase
{
    public function authorize(string $action):bool
    {
        switch ($action) {
            case 'new':
            case 'myReservations':
            case 'reservedFromMe':
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
            $date = new \DateTime();
            $currentDate = $date->format('Y-m-d');

            if ($formData['from'] <= $formData['to'] && $formData['from'] >= $currentDate && $formData['to'] >= $currentDate) {
                $reservation = new Reservation();
                $reservation->setAdvertId($advertId);
                $reservation->setReservedBy($this->app->getAuth()->getLoggedUserId());
                $reservation->setFrom($formData['from']);
                $reservation->setTo($formData['to']);
                $reservation->setStatusId(1);
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

    public function reservedFromMe():Response
    {
        $con = Connection::connect();
        $sql = "SELECT rs.id, rs.advertId, rs.from, rs.to, rs.reservedBy, rs.message, rs.statusId, rs.totalCost
                    FROM `reservations` AS `rs`
                        JOIN `adverts` ON rs.advertId = adverts.id
                            WHERE adverts.ownerId like ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$this->app->getAuth()->getLoggedUserId()]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //musim pouzit referenciu aby to funogalo
        foreach ($result as &$reservation) {
            $reservedBy = User::getOne($reservation['reservedBy']);
            $reservation['reservedBy'] = $reservedBy->getName() . ' ' . $reservedBy->getSurname();
        }
        return $this->html($result);
    }
}