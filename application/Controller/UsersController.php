<?php

/**
 * Class UserController
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
use Mini\Model\User;
use Mini\Model\Facility;
use Mini\Model\Role;
use Mini\Model\Permission;

class UsersController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class.use Mini\Model\VehicleRequest;
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
     * This method handles what happens when you move to http://yourproject/user/index
     */
    public function index()
    {
        if (!$this->Permission->hasAnyRole(['power-user'])) {
            Redirect::toError();
        }

        // Instance new Model (VehicleRequest)
        $User = new User();
        $users = $User->getAllUsers(); // getting all users and amount of users

        $Facility = new Facility();
        $facilities = $Facility->getAllFacilities();

        $Roles = new Role();
        $roles = $Roles->getAllRoles();

        // load views. within the views we can echo out $users easily
        $this->View->render('users/index', array('users' => $users, 'facilities' => $facilities, 'roles' => $roles)); 
    }

    /**
     * ACTION: Show the form for creating a new resource.
     *
     * This method handles what happens when you move to http://yourproject/user/addRequest
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a admin" form on user/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to user/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function create()
    {
        
    }

    /**
     * Create a new admin object and stores to the database.
     *
     * @return void
     */
    public function store() {
        
        if (!$this->Permission->hasAnyRole(['power-user'])) {
            Redirect::toError();
        }

        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("submit_add_user")) {
            // set the default timezone to use. Available since PHP 5.1
            date_default_timezone_set('UTC');

            // Check if is_active is submitted i.e. checkbox is checked
            // set to 1 for true is checked else 0
            $is_active = !empty(Request::post('is_active')) ? 1 : 0;

            $User = new User();
            $User->addUser(Request::post('facility_id'), Request::post('first_name'), Request::post('last_name'), Request::post('email'), Request::post('password'), $is_active, Request::post('roles'));
        }

        // where to go after vehicle_request has been added
        Redirect::to('users/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

     /**
     * ACTION: Show the form for editing the specified resource.
     * This method handles what happens when you move to http://yourproject/user/editsong
     * @param int $id Id of the to-edit admin
     */
    public function edit($id)
    {
        if (!$this->Permission->hasAnyRole(['power-user'])) {
            Redirect::toError();
        }

        // if we have an id of a vehicle_request that should be edited
        if (isset($id)) {
            // Instance new Model (VehicleRequest)
            $User = new User();
            $user = $User->getUserById($id);

            $Facility = new Facility();
            $facilities = $Facility->getAllFacilities();
     
            $Roles = new Role();
            $roles = $Roles->getAllRoles();

            // load views. within the views we can echo out $vehicle_request easily
            $this->View->render('users/edit', array('user' => $user, 'facilities' => $facilities, 'roles' => $roles));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('users/index');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     *
     * This method handles what happens when you move to http://yourproject/user/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a admin" form on user/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to user/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function update($id)
    {
        if (!$this->Permission->hasAnyRole(['power-user'])) {
            Redirect::toError();
        }
        
        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("submit_update_user")) {

            // New selected roles to be added to user.
            $add_roles = array_diff(Request::post('roles'), explode(',', Request::post('old_roles')));;

            // Roles that was deselected from user.
            $remove_roles = array_diff(explode(',', Request::post('old_roles')), Request::post('roles'));

            // Check if is_active is submitted i.e. checkbox is checked
            // set to 1 for true is checked else 0
            $is_active = !empty(Request::post('is_active')) ? 1 : 0;

            $User = new User();
            $User->updateUser($id, Request::post('facility_id'), Request::post('first_name'), Request::post('last_name'), Request::post('email'), Request::post('password'), $is_active, $remove_roles, $add_roles);
        }

        // where to go after vehicle_request has been added
        Redirect::to('users/index');
    }

    /**
     * ACTION: Remove the specified resource from storage.
     * 
     * This method handles what happens when you move to http://yourproject/user/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a admin" button on user/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to user/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete admin
     */
    public function delete($id)
    {
      
    }
}
