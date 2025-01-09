<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Village;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action): bool
    {
        return true;
    }

    public function index(): Response
    {
        $advertController = new AdvertController();
        return $this->html($advertController->getCounfOfAllAdverts());
        //todo konzultuj!
    }


    public function getCity():Response
    {
        $data = $this->request()->getRawBodyJSON();
        $villages = Village::getAll(whereClause: '`name` LIKE ?', whereParams: [$data.'%'], orderBy: '`name` asc', limit: 10);
        $cities = [];
        foreach ($villages as $village) {
            $cities[] = $village->getName();
        }
        return $this->json($cities);
    }
}
