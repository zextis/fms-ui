<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Libs\Helper;

/**
 * VehicleModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other vehicles. Useful for display profile information, creating user lists etc.
 */
class Vehicle extends Model
{
    public function getAllVehicles() {

        $sql = "SELECT vehicles.`license_plate`, vehicles.`vehicle_type`, vehicles.`body_type`, vehicles.`make`, vehicles.`model`, vehicles.`year`, vehicles.`transmission`, vehicles.`fuel`, vehicles.`production_year`, facilities.name AS facility, vehicles.`engine_number`, vehicles.`chasis_number`, vehicles.`colour`, vehicles.`seating`, vehicles.`cc_rating`, vehicles.`fitness_expiration`, vehicles.`liscense_expiration`, vehicles.`next_maintenance`, vehicles.`is_available`, vehicles.`is_operable`, vehicles.`created_at`, vehicles.`updated_at` FROM `vehicles` INNER JOIN facilities on facility_id = facilities.id";
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addVehicle($license_plate, $vehicle_type, $body_type, $make, $model, $year, $transmission, $fuel, $production_year, $facility_id, $engine_number, $chasis_number, $colour, $seating, $cc_rating, $fitness_expiration, $license_expiration, $next_maintenance, $is_available, $is_operable)
    {
        $sql = "INSERT INTO vehicles (INSERT INTO `vehicles`(`license_plate`, `vehicle_type`, `body_type`, `make`, `model`, `year`, `transmission`, `fuel`, `production_year`, `facility_id`, `engine_number`, `chasis_number`, `colour`, `seating`, `cc_rating`, `fitness_expiration`, `license_expiration`, `next_maintenance`, `is_available`, `is_operable`, `created_at`, `updated_at`) VALUES (:license_plate,:vehicle_type,:body_type,:make,:model,:year,:transmission,:fuel,:production_year,:facility_id,:engine_number,:chasis_number,:colour,:seating,:cc_rating,:fitness_expiration,:license_expiration,:next_maintenance,:is_available,:is_operable,:created_at,:updated_at)";

        $query = $this->db->prepare($sql);

        $current_date = date("Y-m-d H:i:s");
        $parameters = array(':license_plate' => $license_plate, ':vechicle_type' => $vehicle_type, ':body_type' => $body_type, ':make' => $make, ':model' => $model, ':year' => $year, ':transmission' => $transmission, ':fuel' => $fuel, ':production_year' => $production_year, ':facility_id' => $facility_id, ':engine_number' => $engine_number, ':chasis_number' => $chasis_number, ':colour' => $colour, ':seating' => $seating, ':cc_rating' => $cc_rating, ':fitness_expiration' => $fitness_expiration, ':license_expiration' => $license_expiration, ':next_maintenance' => $next_maintenance, ':is_available' => $is_available, ':is_operable' => $is_operable, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        $current_date = date("Y-m-d H:i:s");
        $parameters = array(':name' => $name, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a vehicle from database
     * @param integer $id
     */
    public function getVehicle($id)
    {
        $sql = "SELECT vehicles.`license_plate`, vehicles.`vehicle_type`, vehicles.`body_type`, vehicles.`make`, vehicles.`model`, vehicles.`year`, vehicles.`transmission`, vehicles.`fuel`, vehicles.`production_year`, facilities.name AS facility, vehicles.`engine_number`, vehicles.`chasis_number`, vehicles.`colour`, vehicles.`seating`, vehicles.`cc_rating`, vehicles.`fitness_expiration`, vehicles.`liscense_expiration`, vehicles.`next_maintenance`, vehicles.`is_available`, vehicles.`is_operable`, vehicles.`created_at`, vehicles.`updated_at` FROM `vehicles` INNER JOIN facilities on facility_id = facilities.id WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updateVehicle($id, $license_plate, $vehicle_type, $body_type, $make, $model, $year, $transmission, $fuel, $production_year, $facility_id, $engine_number, $chasis_number, $colour, $seating, $cc_rating, $fitness_expiration, $license_expiration, $next_maintenance, $is_available, $is_operable)
    {
        $sql = "UPDATE `vehicles` SET `license_plate`=:liscense_plate,`vehicle_type`=:vehicle_type,`body_type`=:body_type,`make`=:make,`model`=:model,`year`=:year,`transmission`=:transmission,`fuel`=:fuel,`production_year`=:production_year,`facility_id`=:facility_id,`engine_number`=:engine_number,`chasis_number`=:chasis_number,`colour`=:colour,`seating`=:seating,`cc_rating`=:cc_rating,`fitness_expiration`=:fitness_expiration,`license_expiration`=:license_expiration,`next_maintenance`=:next_maintenance,`is_available`=:is_available,`is_operable`=:is_operable,`created_at`=:created_at,`updated_at`=:updated_at WHERE id = :id";

        $query = $this->db->prepare($sql);
        
        $current_date = date("Y-m-d H:i:s"); 
        $parameters = array(':id' => $id, ':license_plate' => $license_plate, ':vechicle_type' => $vehicle_type, ':body_type' => $body_type, ':make' => $make, ':model' => $model, ':year' => $year, ':transmission' => $transmission, ':fuel' => $fuel, ':production_year' => $production_year, ':facility_id' => $facility_id, ':engine_number' => $engine_number, ':chasis_number' => $chasis_number, ':colour' => $colour, ':seating' => $seating, ':cc_rating' => $cc_rating, ':fitness_expiration' => $fitness_expiration, ':license_expiration' => $license_expiration, ':next_maintenance' => $next_maintenance, ':is_available' => $is_available, ':is_operable' => $is_operable, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
}
