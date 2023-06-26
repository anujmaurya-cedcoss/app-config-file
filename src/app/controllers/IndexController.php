<?php
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // redirected to view
        echo "<pre>";
        print_r($this->app_details[0]);
        die;
    }
}
