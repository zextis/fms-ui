<?php 
namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Redirect;
use Mini\Core\Request;
use Mini\Core\Auth;
use Mini\Core\Session;
use Mini\Core\Permission;
use Mini\Model\VehicleRequest;

/**
 * Reqhistory Controller
 */
class ReqhistoryController extends Controller
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
        if (!$this->Permission->hasAnyRole(['power-user', 'supervisor','approver'])) {
            Redirect::toError();
        }

        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();
        
        // getting all requests and amount of requests
        $requests = $VehicleRequest->getAllRequests(false, true, true, false);

        // load views. within the views we can echo out $requests.
        $this->View->render('requests/reqhistory', array('requests' => $requests));
    }
    
}
