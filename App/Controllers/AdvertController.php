<?php

namespace App\Controllers;

use App\App;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Advert;

class AdvertController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function add(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit'])) {

        }
        if (sizeof($formData) == 0) {
            return $this->html();
        }
        return $this->html($formData);
    }
}