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
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        return $this->html();
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact(): Response
    {
        return $this->html();
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
