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
use Mini\Core\Mail;
use Mini\Core\Config;
use Mini\Model\VehicleRequest;
use Mini\Model\User;

class RequestsController extends Controller
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
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/requests/index
     */
    public function index()
    {
        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();
        
        // getting all requests and amount of requests
        $requests = $VehicleRequest->getAllRequests(true, false);

        // load views. within the views we can echo out $requests.
        $this->View->render('requests/index', array('requests' => $requests));
    }


    /**
     * ACTION: Show the form for creating a new resource.
     *
     * This method handles what happens when you move to http://yourproject/requests/addrequest
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a vehicle_request" form on requests/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to requests/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function create()
    {
        
    }

    /**
     * Create a new vehicle_request object and stores to the database.
     *
     * @return void
     */
    public function store() {
        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("submit_add_request")) {
            // set the default timezone to use. Available since PHP 5.1
            date_default_timezone_set('UTC');

            // TODO: Get id's from logged in user.
            $facility_id = 1; 
            $dept_supervisor = Session::get('id');
            $requested_date = date("Y-m-d H:i:s");

            // Instance new Model (VehicleRequest)
            $VehicleRequest = new VehicleRequest();
            // do addRequest() in model/model.php
            $VehicleRequest->addRequest($facility_id, Request::post('department'), Request::post('num_pers'), Request::post('purpose'), Request::post('pickup'), Request::post('reqdate'), Request::post('dep_time'), Request::post('destination'), Request::post('other_info'), $dept_supervisor, Request::post('phone'), $requested_date);
        }

        // where to go after vehicle_request has been added
        Redirect::to('requests/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();

        $request = $VehicleRequest->getRequest($id);
        $vehicles = $VehicleRequest->getAllVehicles();
        $drivers = $VehicleRequest->getAllDrivers();
        $this->View->render('requests/screen', array('request' => $request,'vehicles' => $vehicles, 'drivers' => $drivers));
    }

     /**
     * ACTION: Show the form for editing the specified resource.
     * This method handles what happens when you move to http://yourproject/requests/editrequest
     * @param int $id Id of the to-edit vehicle_request
     */
    public function edit($id)
    {
        // if we have an id of a vehicle_request that should be edited
        if (isset($id)) {
            // Instance new Model (VehicleRequest)
            $VehicleRequest = new VehicleRequest();
            $request = $VehicleRequest->getRequest($id);

            // load views. within the views we can echo out $vehicle_request easily
            $this->View->render('requests/edit', array('request' => $request));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('requests/index');
        }
    }
    
    public function checkDriver()
    {   
        $id = 1;
    // if we have an id of a vehicle_request that should be edited
        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();
        // do getSong() in model/model.php
        $driver_id = $_POST['driver_id'];
        $required_date = $_POST['required_date'];

        $request = $VehicleRequest->driverCheck($driver_id, $required_date);

        // in a real application we would also check if this db entry exists and therefore show the result or
        // redirect the user to an error page or similar

        // load views. within the views we can echo out $vehicle_request easily
        if ($request) {
            echo $request->driver." is already the driver for Request #".$request->id." on the same day.";
        } else {
            return false;
        }

    }
    public function checkVehicle()
    {   
        $id = 1;
    // if we have an id of a vehicle_request that should be edited
        // Instance new Model (VehicleRequest)
        $VehicleRequest = new VehicleRequest();
        // do getSong() in model/model.php
        $license_plate = $_POST['license_plate'];
        $required_date = $_POST['required_date'];

        $vrequest = $VehicleRequest->vehicleCheck($license_plate, $required_date);

        // in a real application we would also check if this db entry exists and therefore show the result or
        // redirect the user to an error page or similar

        // load views. within the views we can echo out $vehicle_request easily
        if ($vrequest) {
            echo $vrequest->license_plate." is already the vehicle for Request #".$vrequest->id." on the same day.";
        } else {
            return false;
        }

    }

    /**
     * ACTION: Update the specified resource in storage.
     *
     * This method handles what happens when you move to http://yourproject/requests/updaterequest
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a vehicle_request" form on requests/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to requests/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function update($id)
    {
        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("submit_update_request")) {
            // Instance new Model (VehicleRequest)
            $VehicleRequest = new VehicleRequest();
            // do updateSong() from model/model.php
            $VehicleRequest->updateRequest($id, Request::post('department'), Request::post('num_pers'), Request::post('purpose'), Request::post('pickup'), Request::post('reqdate'), Request::post('dep_time'), Request::post('destination'), Request::post('other_info'), Request::post('phone'));
        }

        // where to go after vehicle_request has been added
        Redirect::to('requests/index');
    }

    /**
     * Approve/reject the request.
     *
     * @param integer $id The request id
     * @return void
     */
    public function screen($id)
    {
         // Instance new Model (VehicleRequest)
         $VehicleRequest = new VehicleRequest();
         
        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("screen_request")) {
            // do updateSong() from model/model.php
            $updated = $VehicleRequest->screenRequest($id, Request::post('license_plate'), Request::post('driver_id'), Request::post('status'), Request::post('comments'));

            // Send email if no error.
            if ($updated) {

                // Instance new Model (VehicleRequest)
                $VehicleRequest = new VehicleRequest();
                $request = $VehicleRequest->getRequest($id);

                if ($request) {                    
                    // Get user making the request.
                    // Instance new Model (VehicleRequest)
                    $User = new User();
                    $user = $User->getUserById($request->dept_supervisor);
    
                    // If user send email.
                    if ($user) {
                        // TODO: Create approved_by field to record the coordinator that
                        // approves or reject request.
                        $body = $request->status == 'Approved' 
                            ? "Your request was $request->status. Have a nice and safe trip."
                            : "Sorry, your request was $request->status. $request->comments.";

$body .= <<<EOD
\n
Regards,

Fleet Coordinator
Robert Robinson
Phone: 318-0787
E-mail: robert.robinson@srha.gov.jm
Southern Regional Health Authority
3 Brumalia Road, Mandeville, Manchester
Phone: 625-0612/3/779-2663
www.srha.gov.jm
EOD;
    
                        // TODO: Send email to notify the person making the request of status.
                        $Mail = new Mail();
                        $response = $Mail->sendMail($user->email, 'no-reply@srha.gov.jm', 'Fleet Management System', "RE: Request #$request->id to $request->destination", $body);
                        // die(var_dump($response));
                    }
                }
            } 
        }
        // where to go after vehicle_request has been added
        Redirect::to('requests/index');
    }

    /**
     * ACTION: Remove the specified resource from storage.
     * 
     * This method handles what happens when you move to http://yourproject/requests/deleterequest
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a vehicle_request" button on requests/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to requests/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $request_id Id of the to-delete vehicle_request
     */
    public function delete($id)
    {
        // if we have an id of a vehicle_request that should be deleted
        if (isset($id)) {
            // Instance new Model (VehicleRequest)
            $VehicleRequest = new VehicleRequest();
            // do deleteSong() in model/model.php
            $VehicleRequest->deleteSong($id);
        }

        // where to go after vehicle_request has been deleted
        Redirect::to('requests/index');
    }
}
