<?php

/**
 * Class Permission
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php// $permission = $this->Permission->can('do anything');
 * 
 * Usage:
 * 
 * $permission = $this->Permission->hasPermission('do anything');
 * $permission = $this->Permission->hasRole('power-user');
 * $permission = $this->Permission->hasAnyPermission(['manage request'], 2);
 * $permission = $this->Permission->hasAnyRole(['power-user']);
 *
 */

namespace Mini\Core;

use Mini\Core\Model;

class Permission extends Model
{
    /**
     * Check if the user can perform an action.
     *
     * @param string $permission
     * @param int $user_id
     * @return boolean
     */
    public function can($permission, $user_id = 0) {

        // Check if user id is set in session.
        if ($user_id == 0 && null !== Session::get('id')) {
            $user_id = Session::get('id');
        }
        
        // Query the user table to get the user_id.
        // Get the user_id to get the assigned user role on the user_id.
        // Get the assigned permissions for the user role on the role_id.
        // Use the assigned permission and the user id to check if user has the role the has the permission.
        $sql = "SELECT users.id, user_has_roles.role_id, role_has_permissions.permission_id, permissions.name FROM users
            INNER JOIN user_has_roles ON users.id = user_has_roles.user_id
            INNER JOIN role_has_permissions ON user_has_roles.role_id = role_has_permissions.role_id
            INNER JOIN permissions ON role_has_permissions.permission_id = permissions.id
            WHERE users.id = :user_id AND permissions.name = :permission";
        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':permission' => $permission);

        $query->execute($parameters);

        // Return true is rows returned else false.
        return $query->fetchAll() ? true : false;
    }

    /**
     * Check if the user has $role assigned.
     *
     * @param string $role
     * @param int $user_id
     * @return boolean
     */
    public function hasRole($role, $user_id = 0) {

        // Check if user id is set in session.
        if ($user_id == 0 && null !== Session::get('id')) {
            $user_id = Session::get('id');
        }

        // Query the user table to get the user_id.
        // Get the user_id to get the assigned user role on the user_id.
        // Get the role name for user role on the role_id.
        $sql = "SELECT users.id, user_has_roles.role_id, roles.name FROM users
            INNER JOIN user_has_roles ON users.id = user_has_roles.user_id
            INNER JOIN roles ON roles.id = user_has_roles.role_id
            WHERE users.id = :user_id AND roles.name = :role";
        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':role' => $role);

        $query->execute($parameters);

        // Return true is rows returned else false.
        return $query->fetchAll() ? true : false;
    }

    /**
     * Check if the user has any roles assigned.
     *
     * @param array $roles
     * @param int $user_id
     * @return boolean
     */
    public function hasAnyRole($roles, $user_id = 0) {

        // Check if user id is set in session.
        if ($user_id == 0 && null !== Session::get('id')) {
            $user_id = Session::get('id');
        }
        
        // Query the user table to get the user_id.
        // Get the user_id to get the assigned user role on the user_id.
        // Get the role name for user role on the role_id.
         // Construct the values to check with IN.
        $roles = "'" . implode( "', '", $roles ) . "'";

        $sql = "SELECT users.id, user_has_roles.role_id, roles.name FROM users
            INNER JOIN user_has_roles ON users.id = user_has_roles.user_id
            INNER JOIN roles ON roles.id = user_has_roles.role_id
            WHERE users.id = :user_id AND roles.name IN ($roles)";
        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        // Return true is rows returned else false.
        return $query->fetchAll() ? true : false;
    }

    /**
     * Check if the user has the permissiion to perform action.
     *
     * @param string $permission
     * @param int $user_id
     * @return boolean
     */
    public function hasPermission($permission, $user_id = 0) {
        // hasPermission is the same as can.
        return $this->can($permission, $user_id);
    }

   /** Check if the user has the permissiion to perform action.
    *
    * @param array $permissions
    * @param int $user_id
    * @return boolean
    */
    public function hasAnyPermission($permissions, $user_id = 0) {
        
        // Check if user id is set in session.
        if ($user_id == 0 && null !== Session::get('id')) {
            $user_id = Session::get('id');
        }

        // Query the user table to get the user_id.
        // Get the user_id to get the assigned user role on the user_id.
        // Get the assigned permissions for the user role on the role_id.
        // Use the assigned permission and the user id to check if user has the role the has the permission.

        // Construct the values to check with IN.
        $permissions = "'" . implode( "', '", $permissions ) . "'";
        
        $sql = "SELECT users.id, user_has_roles.role_id, role_has_permissions.permission_id, permissions.name FROM users
            INNER JOIN user_has_roles ON users.id = user_has_roles.user_id
            INNER JOIN role_has_permissions ON user_has_roles.role_id = role_has_permissions.role_id
            INNER JOIN permissions ON role_has_permissions.permission_id = permissions.id
            WHERE users.id = :user_id AND permissions.name IN ($permissions)";
        $query = $this->db->prepare($sql);

        // When $permissions is added to array like :permissions => $permissions does not work.
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);
     
        // Return true is rows returned else false.
        return $query->fetchAll() ? true : false;
    }
}