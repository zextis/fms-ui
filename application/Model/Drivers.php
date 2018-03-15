<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Libs\Helper;

/**
 * PermissionModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other permissions. Useful for display profile information, creating user lists etc.
 */
class Drivers extends Model
{
    /**
     * getAllDrivers
     * Gets all drivers from database
     */
    public function getAllDrivers()
    {
        

        $sql = "SELECT drivers.`id`, drivers.`first_name`, drivers.`last_name`, facilities.name AS facility, drivers.`is_active`, drivers.`created_at`, drivers.`updated_at` FROM  `drivers` INNER JOIN facilities ON drivers.facility_id=facilities.id";
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addDriver($firstname, $lastname, $facility_id, $active)
    {
        $sql = "INSERT INTO `drivers`(`id`, `first_name`, `last_name`, `facility_id`, `is_active`, `created_at`, `updated_at`) VALUES (:id, :first_name, :last_name, :facility_id, :is_active, :created_at, :updated_at)";

        $query = $this->db->prepare($sql);

        $current_date = date("Y-m-d H:i:s");
        $parameters = array(':first_name' => $firstname, ':last_name' => $lastname, ':facility_id' => $facility_id, ':is_active' => $active, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getDriver($id)
    {
        $sql = "SELECT drivers.`id`, drivers.`first_name`, drivers.`last_name`, facilities.name AS facility, drivers.`is_active`, drivers.`created_at`, drivers.`updated_at` FROM  `drivers` INNER JOIN facilities ON drivers.facility_id=facilities.id WHERE id=:id LIMIT 1";
        
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updateDriver($id, $firstname, $lastname, $facility_id, $active)
    {
        $sql = "UPDATE `drivers` SET `first_name`= :first_name,`last_name`= :last_name,`facility_id`=:facility_id,`is_active`=:is_active WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':first_name' => $firstname, ':last_name' => $lastname, ':facility_id' => $facility_id, ':is_active' => $active);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
}
