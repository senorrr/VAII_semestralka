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
            case 'changeStatus':
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
                //kontrola ze ci to je vacsie, ako aktualny den
                $currentDate = date('Y-m-d');
                if ($formData['from'] >= $currentDate && $formData['to'] >= $currentDate) {
                    $reservations = Reservation::getAll(whereClause: '`advertId` LIKE ?', whereParams: [$advertId]);
                    foreach ($reservations as $res) {
                        if ($res->getStatusId() == 2 && date_create($res->getId()) < date_create($formData['from'])) {
                            $data['advertId'] = $advertId;
                            $data['message'] = 'V tomto dátume už má niekto iný rezerváciu';
                            if (isset($formData['textMessage'])) {
                                $data['textMessage'] = $formData['textMessage'];
                            }
                            return $this->html($data);
                        }
                    }

                    $advert = Advert::getOne($advertId);

                    if (!$this->checkDays($advert, $formData['from'], $formData['to'])) {
                        $data['advertId'] = $advertId;
                        $data['message'] = 'V tieto dni nie je inzerát na požičanie';
                        if (isset($formData['textMessage'])) {
                            $data['textMessage'] = $formData['textMessage'];
                        }
                        return $this->html($data);
                    }

                    $reservation = new Reservation();
                    $reservation->setAdvertId($advertId);
                    $reservation->setReservedBy($this->app->getAuth()->getLoggedUserId());
                    $reservation->setFrom($formData['from']);
                    $reservation->setTo($formData['to']);
                    $reservation->setStatusId(1);
                    $cost = $reservation->getTo() - $reservation->getFrom();
                    $cost += 1;
                    $cost = $cost * $advert->getPrice();
                    $reservation->setTotalCost($cost);
                    if ($formData['textMessage']) {
                        $reservation->setMessage($formData['textMessage']);
                    }
                    $reservation->save();
                    return $this->redirect($this->url('reservation.myReservations'));
                } else {
                    $data['advertId'] = $advertId;
                    $data['message'] = 'Nepsprávny dátum';
                    if (isset($formData['textMessage'])) {
                        $data['textMessage'] = $formData['textMessage'];
                    }
                    return $this->html($data);
                }
            }
        }
        $data['advertId'] = $advertId;
        return $this->html($data);
    }

    /**
     * Kontorla ze ci je inzerat mozne pozicat v pozadovanom rozmedzi dni
     * @param Advert|null $advert
     * @param $from
     * @param $to
     * @return bool
     */
    private function checkDays(?Advert $advert, $from, $to):bool
    {
        $from = strtotime($from);
        $to = strtotime($to);

        for ($timestamp = $from; $timestamp <= $to; $timestamp = strtotime('+1 day', $timestamp)) {
            $dayOfWeek = date('l', $timestamp);

            if (($dayOfWeek == 'Monday' && $advert->getMonday() == 0) ||
                ($dayOfWeek == 'Tuesday' && $advert->getTuesday() == 0) ||
                ($dayOfWeek == 'Wednesday' && $advert->getWednesday() == 0) ||
                ($dayOfWeek == 'Thursday' && $advert->getThursday() == 0) ||
                ($dayOfWeek == 'Friday' && $advert->getFriday() == 0) ||
                ($dayOfWeek == 'Saturday' && $advert->getSaturday() == 0) ||
                ($dayOfWeek == 'Sunday' && $advert->getSunday() == 0)) {
                return false;
            }
        }

        return true;
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

        //musim pouzit referenciu aby to fungovalo
        foreach ($result as &$reservation) {
            $reservedBy = User::getOne($reservation['reservedBy']);
            $reservation['reservedBy'] = $reservedBy->getName() . ' ' . $reservedBy->getSurname();
        }
        return $this->html($result);
    }

    public function changeStatus():Response
    {
        $get = $this->app->getRequest()->getGet();
        if (isset($get['0']) && isset($get['1'])) {
            $res = Reservation::getOne($get['1']);
            if ($res->getStatusId() == 1) {
                switch ($get['0']) {
                    case 'approve':
                        $res->setStatusId(2);
                        $res->save();
                        return $this->redirect($this->url('reservation.reservedFromMe'));
                    case 'cancel':
                        $res->setStatusId(4);
                        $res->save();
                        return $this->redirect($this->url('reservation.reservedFromMe'));
                    }
            }
            if ($res->getStatusId() == 2) {
                if ($get['0'] == 'cancel') {
                    $res->setStatusId(3);
                    $res->save();
                    return $this->redirect($this->url('reservation.reservedFromMe'));
                }
                if ($get['0'] == 'finish') {
                    $res->setStatusId(5);
                    $res->save();
                    return $this->redirect($this->url('reservation.reservedFromMe'));
                }
            }
        }

        return $this->redirect($this->url('reservation.reservedFromMe'));
    }
}