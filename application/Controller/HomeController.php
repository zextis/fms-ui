<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Redirect;
use Mini\Core\Session;
use Mini\Core\Config;
use Mini\Model\VehicleRequest;

class HomeController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $VehicleRequest = new VehicleRequest();
        // getting all requests and amount of requests
        $requests = $VehicleRequest->getAllRequests(false, true);

        
        // load views
        if(Session::userIsLoggedIn()){ 
            $this->View->render('request/index');
        } else {
        // load views. within the views we can echo out $requests and $amount_of_requests easily
            $this->View->render('home/index', array('requests' => $requests));
        }
    }
}
