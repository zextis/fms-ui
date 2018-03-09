<?php 
/**
 * Class SongsController
 * This is a demo Controller class.
 *
 * If you want, you can use multiple Models or Controllers.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Redirect;
use Mini\Core\Request;
use Mini\Core\Auth;
use Mini\Core\Session;
use Mini\Core\Permission;
use Mini\Model\VehicleRequest;

class ReqHistoryController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class.
     */
    public function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions.
        Auth::checkAuthentication();
    }

/**
     * PAGE: request history
     * This method handles what happens when you move to http://yourproject/requests/reqhistory
     */
    public function index()
    {
        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();
        
        // getting all requests and amount of requests
        $requests = $VehicleRequest->getAllRequests(false, false);

        // load views. within the views we can echo out $requests.
        $this->View->render('requests/reqhistory', array('requests' => $requests));
    }
    
}

?>

