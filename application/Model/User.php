<?php

namespace Mini\Model;

use Mini\Core\Model;

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other users. Useful for display profile information, creating user lists etc.
 */
class User extends Model
{
    public function getAllUsers() {

        $sql = "SELECT users.id, CONCAT(users.first_name, ' ', users.last_name) AS name, users.username, users.email, GROUP_CONCAT(roles.name) AS roles, users.is_active, facilities.name AS facility, users.created_at, users.updated_at
            FROM users
            INNER JOIN facilities ON users.facility_id = facilities.id
            LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
            LEFT JOIN roles ON user_has_roles.role_id = roles.id
            GROUP BY id";
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * @param $user_name_or_email
     *
     * @return mixed
     */
    public function getUserDataByUserNameOrEmail($user_name_or_email)
    {
        $query = $this->db->prepare("SELECT id, username, email FROM users
                                     WHERE (username = :user_name_or_email OR email = :user_name_or_email)
                                     LIMIT 1");
        $query->execute(array(':user_name_or_email' => $user_name_or_email));

        return $query->fetch();
    }

    /**
     * Checks if a username is already taken
     *
     * @param $username string username
     *
     * @return bool
     */
    public function doesUsernameAlreadyExist($username)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $query->execute(array(':username' => $username));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * Checks if a email is already used
     *
     * @param $email string email
     *
     * @return bool
     */
    public function doesEmailAlreadyExist($email)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $query->execute(array(':email' => $email));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * Writes new username to database
     *
     * @param integer $id
     * @param integer $facility_id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @param integer $is_active
     * @param array $remove_roles
     * @param array $add_roles
     *
     * @return bool
     */
    public function addUser($facility_id, $first_name, $last_name, $email, $password, $is_active = 0, $roles = [])
    {
        $sql = "INSERT into users (facility_id, first_name, last_name, email, password, is_active, created_at) VALUES (:facility_id, :first_name, :last_name, :email, :password, :is_active, :created_at)";

        $query = $this->db->prepare($sql);

        // Encrypt password
        $password = password_hash($password, PASSWORD_BCRYPT);
        $created_at = date("Y-m-d H:i:s");

        $parameters = array(':facility_id' => $facility_id, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':password' => $password, ':is_active' => $is_active, ':created_at' => $created_at);

        $query->execute($parameters);

        if ($query) {
            // Get the user id to add roles to
            $user_id = $this->db->lastInsertId(); 

            // Add each role for the user to user_has_roles table
            foreach ($roles as $role) {
                $sql = "INSERT into user_has_roles (user_id, role_id) VALUES (:user_id, :role_id)";
                $query = $this->db->prepare($sql);
                $query->execute(array(':user_id' => $user_id, ':role_id' => $role)); 
            }
        }
    }

    /**
     * Updates user record
     *
     * @param integer $id
     * @param integer $facility_id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @param integer $is_active
     * @param array $remove_roles
     * @param array $add_roles
     * @return void
     */
    public function updateUser($id, $facility_id, $first_name, $last_name, $email, $password, $is_active = 0, $remove_roles = [], $add_roles = [])
    {
        $sql = "UPDATE users SET facility_id = :facility_id, first_name = :first_name, last_name = :last_name, email = :email, is_active = :is_active ";

        // Check if password is set when updating
        // If entered update password with other fields.
        if (!empty($password)) {
            $sql .= ", password = :password ";
        }

        $sql .= "WHERE id = :id";

        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id, ':facility_id' => $facility_id, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':is_active' => $is_active);

        // Check if password is set when updating
        // If entered update password add value to parameters array.
        if (!empty($password)) {
            // Encrypt password.
            $password = password_hash($password, PASSWORD_BCRYPT);
            $parameters[':password'] = $password;
        }
        $query->execute($parameters);

        // Add each role for the user to user_has_roles table.
        foreach ($add_roles as $role) {
            $sql = "INSERT into user_has_roles (user_id, role_id) VALUES (:user_id, :role_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_id' => $id, ':role_id' => $role)); 
        }

        // Remove roles from user.
        foreach ($remove_roles as $role) {
            $sql = "DELETE from user_has_roles WHERE (user_id = :user_id AND role_id = :role_id)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_id' => $id, ':role_id' => $role)); 
        }
    }

    /**
     * Writes new email address to database
     *
     * @param $id int user id
     * @param $new_user_email string new email address
     *
     * @return bool
     */
    public function saveNewEmailAddress($id, $new_user_email)
    {
        $query = $this->db->prepare("UPDATE users SET email = :email WHERE id = :id LIMIT 1");
        $query->execute(array(':email' => $new_user_email, ':id' => $id));
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    /**
     * Edit the user's name, provided in the editing form
     *
     * @param $new_user_name string The new username
     *
     * @return bool success status
     */
    public function editUserName($new_user_name)
    {
        // new username same as old one ?
        if ($new_user_name == Session::get('username')) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_SAME_AS_OLD_ONE'));
            return false;
        }

        // username cannot be empty and must be azAZ09 and 2-64 characters
        if (!preg_match("/^[a-zA-Z0-9]{2,64}$/", $new_user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        // clean the input, strip usernames longer than 64 chars (maybe fix this ?)
        $new_user_name = substr(strip_tags($new_user_name), 0, 64);

        // check if new username already exists
        if (self::doesUsernameAlreadyExist($new_user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN'));
            return false;
        }

        $status_of_action = self::saveNewUserName(Session::get('id'), $new_user_name);
        if ($status_of_action) {
            Session::set('username', $new_user_name);
            Session::add('feedback_positive', Text::get('FEEDBACK_USERNAME_CHANGE_SUCCESSFUL'));
            return true;
        } else {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
    }

    /**users
     * Edit the user's email
     *
     * @param $new_user_email
     *
     * @return bool success status
     */
    public function editUserEmail($new_user_email)
    {
        // email provided ?
        if (empty($new_user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
            return false;
        }

        // check if new email is same like the old one
        if ($new_user_email == Session::get('email')) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_SAME_AS_OLD_ONE'));
            return false;
        }

        // user's email must be in valid email format, also checks the length
        // @see http://stackoverflow.com/questions/21631366/php-filter-validate-email-max-length
        // @see http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
        if (!filter_var($new_user_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        // strip tags, just to be sure
        $new_user_email = substr(strip_tags($new_user_email), 0, 254);

        // check if user's email already exists
        if (self::doesEmailAlreadyExist($new_user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_EMAIL_ALREADY_TAKEN'));
            return false;
        }

        // write to database, if successful ...
        // ... then write new email to session, Gravatar too (as this relies to the user's email address)
        if (self::saveNewEmailAddress(Session::get('id'), $new_user_email)) {
            Session::set('email', $new_user_email);
            Session::set('user_gravatar_image_url', AvatarModel::getGravatarLinkByEmail($new_user_email));
            Session::add('feedback_positive', Text::get('FEEDBACK_EMAIL_CHANGE_SUCCESSFUL'));
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    /**
     * Gets the user's id
     *
     * @param $username
     *
     * @return mixed
     */
    public function getUserById($id)
    {

        $sql = "SELECT users.id, users.first_name, users.last_name, users.username, users.email, GROUP_CONCAT(user_has_roles.role_id) AS roles, users.is_active, facility_id
        FROM users
        LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
        WHERE users.id = :id
        GROUP BY id";
        
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':id' => $id));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }

    /**
     * Gets the user's data
     *
     * @param $username string User's name
     *
     * @return mixed Returns false if user does not exist, returns object with user's data when user exists
     */
    public function getUserDataByUsername($username)
    {
        $sql = "SELECT users.id, users.first_name, users.last_name, users.username, users.email, users.password, users.role, users.is_active, users.facility_id, users.created_at, users.updated_at, facilities.name AS facility
                 FROM users
                 LEFT JOIN facilities ON users.facility_id = facilities.id
                 WHERE (username = :username OR email = :username)
                 LIMIT 1";
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':username' => $username));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }


    /**
     * Validates the registration input
     *
     * @param $captcha
     * @param $user_name
     * @param $user_password_new
     * @param $user_password_repeat
     * @param $user_email
     * @param $user_email_repeat
     *
     * @return bool
     */
    public function registrationInputValidation($captcha, $user_name, $user_password_new, $user_password_repeat, $user_email, $user_email_repeat)
    {
        $return = true;

        // if username, email and password are all correctly validated, but make sure they all run on first sumbit
        if (self::validateUserName($user_name) AND self::validateUserEmail($user_email, $user_email_repeat) AND self::validateUserPassword($user_password_new, $user_password_repeat) AND $return) {
            return true;
        }

        // otherwise, return false
        return false;
    }

    /**
     * Validates the username
     *
     * @param $user_name
     * @return bool
     */
    public function validateUserName($user_name)
    {
        if (empty($user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_FIELD_EMPTY'));
            return false;
        }

        // if username is too short (2), too long (64) or does not fit the pattern (aZ09)
        if (!preg_match('/^[a-zA-Z0-9]{2,64}$/', $user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the email
     *
     * @param $user_email
     * @param $user_email_repeat
     * @return bool
     */
    public function validateUserEmail($user_email, $user_email_repeat)
    {
        if (empty($user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
            return false;
        }

        if ($user_email !== $user_email_repeat) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_REPEAT_WRONG'));
            return false;
        }

        // validate the email with PHP's internal filter
        // side-fact: Max length seems to be 254 chars
        // @see http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        return true;
    }

    /**
     * Validates the password
     *
     * @param $user_password_new
     * @param $user_password_repeat
     * @return bool
     */
    public function validateUserPassword($user_password_new, $user_password_repeat)
    {
        if (empty($user_password_new) OR empty($user_password_repeat)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_FIELD_EMPTY'));
            return false;
        }

        if ($user_password_new !== $user_password_repeat) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_REPEAT_WRONG'));
            return false;
        }

        if (strlen($user_password_new) < 6) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_TOO_SHORT'));
            return false;
        }

        return true;
    }
}
