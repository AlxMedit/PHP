<?php

namespace App\Controllers;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->renderHTML('../Views/index_view.php');
    }
}