<?php

/**
 * Class Vehicle Request Controller
 * 
 */

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Core\Session;
use Mini\Core\Permission;
use Mini\Libs\Helper;

/**
 * Class VehicleRequest
 * 
 * Please note:
 * Don't use the same name for class and method, as this might trigger an       (unintended) __construct of the class.
 *
 */

class VehicleRequest extends Model
{
    /**
    * Gets all requests
    *
    * @param boolean $pending
    * @param boolean $approved
    * @param boolean $rejected
    * @param boolean $timely
    *
    * @return void
    */
    public function getAllRequests($pending = false, $approved = false,         $rejected = false, $timely = false) 
    {   
        $where = "";

        //Create a new permission object.
        $this->Permission  = new Permission();

        $sql = "SELECT requests.id, CONCAT(users.first_name, ' ', users.last_name) AS dept_supervisor, facilities.name AS facility, requests.department, requests.number_of_persons, requests.required_date, requests.departure_time, requests.destination, requests.contact_num, CONCAT(drivers.first_name, ' ', drivers.last_name) AS driver, requests.status
        FROM requests
        INNER JOIN users ON requests.dept_supervisor = users.id
        INNER JOIN facilities ON requests.facility_id = facilities.id
        LEFT JOIN drivers ON requests.driver_id = drivers.id";

        if ($pending ) { 
            $where .= empty($where) ? " WHERE (status = 'Pending'" :  " AND status = 'Pending' ";
        }

        if ($approved ) {
            $where .= empty($where) ? " WHERE (status = 'Approved'" :  " AND status = 'Approved' ";
        }
        if ($rejected ) {
             $where .= empty($where) ? " WHERE (status = 'Rejected'" :  " OR status = 'Rejected' ";
        } 
        if ($timely ) {
            $where .= empty($where) ? " WHERE requests.required_date > CURDATE()" :  " AND requests.required_date > CURDATE() ";
        }  

        $where .= ")";

        $sql .= $where;

        $cur_user = Session::get('id');

        if (!empty($cur_user) && !$this->Permission->hasAnyRole(['power-user','approver']) ) {
            if ($approved || $pending ) {
                $sql = $sql." AND (users.id = ".Session::get('id');
            } else {
                $sql = $sql." WHERE (users.id = ".Session::get('id');
            }
            $sql .= ")";
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    /**
     * Get all vehicles
     *
     * @return void
     */
    public function getAllVehicles()
    {
        $sql = "SELECT `license_plate`, `vehicle_type`, `body_type`, `make`, `model`, `year`, `transmission`, `fuel`, `production_year`, `facility_id`, `engine_number`, `chasis_number`, `colour`, `seating`, `cc_rating`, `fitness_expiration`, `license_expiration`, `next_maintenance`, `is_available`, `is_operable`, `created_at`, `updated_at` FROM `vehicles`";

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Get all drivers
     *
     * @return void
     */
    public function getAllDrivers()
    {
        $sql = "SELECT `id`, `first_name`, `last_name`, `facility_id`, `is_active`, `created_at`, `updated_at` FROM `drivers`";

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Check if driver is assigned to a request
     *
     * @return void
     */
    public function driverCheck()
    {
        $driver_id = $_POST['driver_id'];
        $required_date = $_POST['required_date'];
        $sql = "SELECT requests.id, CONCAT(users.first_name, ' ', users.last_name) AS dept_supervisor, requests.required_date, requests.contact_num, CONCAT(drivers.first_name, ' ', drivers.last_name) AS driver, requests.status
        FROM requests
        INNER JOIN users ON requests.dept_supervisor = users.id
        LEFT JOIN drivers ON requests.driver_id = drivers.id WHERE requests.driver_id = :driver_id AND requests.required_date = :required_date LIMIT 1";


        $query = $this->db->prepare($sql);
        $parameters = array(':required_date' => $required_date, ':driver_id'=>$driver_id);

        $query->execute($parameters);
        return $query->fetch();
    }

    /**
     * Checks if vehicle is assigned to a request
     *
     * @return void
     */
    public function vehicleCheck()
    {
        $license_plate = $_POST['license_plate'];
        $required_date = $_POST['required_date'];
        $sql = "SELECT requests.id, CONCAT(users.first_name, ' ', users.last_name) AS dept_supervisor, requests.required_date, requests.contact_num, requests.license_plate, requests.status
        FROM requests
        INNER JOIN users ON requests.dept_supervisor = users.id
        LEFT JOIN drivers ON requests.driver_id = drivers.id WHERE requests.license_plate = :license_plate AND requests.required_date = :required_date LIMIT 1";


        $query = $this->db->prepare($sql);
        $parameters = array(':required_date' => $required_date, ':license_plate'=>$license_plate);

        $query->execute($parameters);
        return $query->fetch();
    }

    /**
     * Adds a request
     *
     * @param [type] $facility_id
     * @param [type] $department
     * @param [type] $number_of_persons
     * @param [type] $purpose_of_trip
     * @param [type] $pick_up_point
     * @param [type] $required_date
     * @param [type] $departure_time
     * @param [type] $destination
     * @param [type] $other_info
     * @param [type] $dept_supervisor
     * @param [type] $contact_num
     * @param [type] $request_date
     * @return void
     */
    public function addRequest($facility_id, $department, $number_of_persons, $purpose_of_trip, $pick_up_point, $required_date, $departure_time, $destination, $other_info, $dept_supervisor, $contact_num, $created_at)
    {
        // NOTE: stop registration flow if registrationInputValidation() returns false (= anything breaks the input check rules)
        // $validation_result = self::registrationInputValidation(Request::post('captcha'), $user_name, $user_password_new, $user_password_repeat, $user_email, $user_email_repeat);
        // if (!$validation_result) {
        //     return false;
        // }

        $sql = "INSERT INTO requests (facility_id, department, number_of_persons, purpose_of_trip, pick_up_point, required_date, departure_time, destination, other_info, dept_supervisor, contact_num, created_at) VALUES (:facility_id, :department, :number_of_persons, :purpose_of_trip, :pick_up_point, :required_date, :departure_time, :destination, :other_info, :dept_supervisor, :contact_num, :created_at)";

        $query = $this->db->prepare($sql);

        $parameters = array(':facility_id' => $facility_id, ':department' => $department, ':number_of_persons' => $number_of_persons, ':purpose_of_trip' => $purpose_of_trip, ':pick_up_point' => $pick_up_point, ':required_date' => $required_date, ':departure_time' => $departure_time, ':destination' => $destination, ':other_info' => $other_info, ':dept_supervisor' => $dept_supervisor, ':contact_num' => $contact_num, ':created_at' => $created_at);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Deletes a request
     *
     * @param [type] $id
     * @return void
     */
    public function deleteRequest($id)
    {
        $sql = "DELETE FROM requests WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Gets a request from database
     * @param integer $id
     */
    public function getRequest($id)
    {
        $sql = "SELECT id, department, number_of_persons, purpose_of_trip, pick_up_point, required_date, departure_time, destination, other_info, dept_supervisor, contact_num, created_at FROM requests WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Updates a request
     *
     * @param [type] $id
     * @param [type] $department
     * @param [type] $number_of_persons
     * @param [type] $purpose_of_trip
     * @param [type] $pick_up_point
     * @param [type] $required_date
     * @param [type] $departure_time
     * @param [type] $destination
     * @param [type] $other_info
     * @param [type] $contact_num
     * @return void
     */
    public function updateRequest($id, $department, $number_of_persons, $purpose_of_trip, $pick_up_point, $required_date, $departure_time, $destination, $other_info, $contact_num)
    {
        $sql = "UPDATE requests SET department = :department, number_of_persons = :number_of_persons, purpose_of_trip = :purpose_of_trip, pick_up_point = :pick_up_point, required_date = :required_date, departure_time = :departure_time, destination = :destination, other_info = :other_info, contact_num = :contact_num, updated_at = :updated_at WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':department' => $department, ':number_of_persons' => $number_of_persons, ':purpose_of_trip' => $purpose_of_trip, ':pick_up_point' => $pick_up_point, ':required_date' => $required_date, ':departure_time' => $departure_time, ':destination' => $destination, ':other_info' => $other_info, ':contact_num' => $contact_num, ':updated_at' => date("Y-m-d H:i:s"));

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
    /**
     * Screen request
     *
     * @param [type] $id
     * @param [type] $license_plate
     * @param [type] $driver_id
     * @param [type] $status
     * @param [type] $comments
     * @return void
     */
    public function screenRequest($id, $license_plate, $driver_id, $status, $comments)

    { 
        $sql = "UPDATE requests SET license_plate = :license_plate, driver_id = :driver_id, status = :status, comments =:comments WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':license_plate' => !empty($license_plate) ? $license_plate : null, ':driver_id' => !empty($driver_id) ? $driver_id : null, ':status' => $status, ':comments' => $comments);
        // die(var_dump($query));

        $query->execute($parameters);

        // NOTE: Print error message.
        if (!$query) {
            print_r($query->errorInfo());
        }
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/vehicles request.php for more)
     */
    public function getAmountOfRequests()
    {
        $sql = "SELECT COUNT(id) AS total_requests FROM request";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->total_requests;
    }
}
