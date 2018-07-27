<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Libs\Helper;

/**
 * PermissionModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other permissions. Useful for display profile information, creating user lists etc.
 */
class Permission extends Model
{
    public function getAllPermissions() {

        $sql = "SELECT permissions.id, permissions.name
            FROM permissions";
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addPermission($name)
    {
        $sql = "INSERT INTO permissions (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)";

        $query = $this->db->prepare($sql);

        $current_date = date("Y-m-d H:i:s");
        $parameters = array(':name' => $name, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getPermission($id)
    {
        $sql = "SELECT id, name FROM permissions WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updatePermission($id, $name)
    {
        $sql = "UPDATE permissions SET name = :name, updated_at = :updated_at WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':name' => $name, ':updated_at' => date("Y-m-d H:i:s"));

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
}
