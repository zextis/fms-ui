<?php

namespace Mini\Model;

use Mini\Core\Model;

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in role, it's more for handling
 * data of all the other roles. Useful for display profile information, creating role lists etc.
 */
class Role extends Model
{
    public function getAllRoles() {

        $sql = "SELECT roles.id, roles.name, GROUP_CONCAT(permissions.name) AS permissions
        FROM roles
        LEFT JOIN role_has_permissions ON roles.id = role_has_permissions.role_id
        LEFT JOIN permissions ON role_has_permissions.permission_id = permissions.id
        GROUP BY roles.id";

        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }


    public function addRole($name, $permissions)
    {
        $sql = "INSERT INTO roles (name, created_at, updated_at) VALUES (:name, :created_at, :updated_at)";

        $query = $this->db->prepare($sql);

        $current_date = date("Y-m-d H:i:s");
        $parameters = array(':name' => $name, ':created_at' => $current_date, ':updated_at' => $current_date);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        if ($query) {
            // Get the role id to add roles to
            $role_id = $this->db->lastInsertId(); 

            // Add each role for the role to role_has_roles table
            foreach ($permissions as $permission) {
                $sql = "INSERT into role_has_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";
                $query = $this->db->prepare($sql);
                $query->execute(array(':role_id' => $role_id, ':permission_id' => $permission)); 
            }
        }
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getRole($id)
    {
        $sql = "SELECT roles.id, roles.name, GROUP_CONCAT(role_has_permissions.permission_id) AS permissions
        FROM roles
        LEFT JOIN role_has_permissions ON roles.id = role_has_permissions.role_id
        WHERE roles.id = :id
        GROUP BY roles.id
        LIMIT 1";

        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update role along with permissions.
     *
     * @param integer $id
     * @param string $name
     * @param array $add_permissions
     * @param array $remove_permissions
     * @return void
     */
    public function updateRole($id, $name, $add_permissions = [], $remove_permissions = [])
    {
        $sql = "UPDATE roles SET name = :name, updated_at = :updated_at WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':name' => $name, ':updated_at' => date("Y-m-d H:i:s"));

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // Add each permission to role_has_permissions table.
        foreach ($add_permissions as $permission) {
            $sql = "INSERT into role_has_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':role_id' => $id, ':permission_id' => $permission)); 
        }

        // Remove permission from roles.
        foreach ($remove_permissions as $permission) {
            $sql = "DELETE from role_has_permissions WHERE (role_id = :role_id AND permission_id = :permission_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':role_id' => $id, ':permission_id' => $permission)); 
        }
    }
}