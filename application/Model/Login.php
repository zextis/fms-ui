<?php

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Core\Session;

/**
 * LoginModel
 *
 * The login part of the model: Handles the login / logout stuff
 */
class Login extends Model
{
    /**
     * Login process (for DEFAULT user accounts).
     *
     * @param $username string The user's name
     * @param $user_password string The user's password
     * @param $set_remember_me_cookie mixed Marker for usage of remember-me cookie feature
     *
     * @return bool success state
     */
    public function login($email, $user_password, $set_remember_me_cookie = null)
    {
        // we do negative-first checks here, for simplicity empty username and empty password in one line
        if (empty($email) OR empty($user_password)) {
            Session::add('feedback_negative', 'E-mail and password cannot be empty');
            return false;
        }

        // checks if user exists, if login is not blocked (due to failed logins) and if password fits the hash
        $result = $this->validateAndGetUser($email, $user_password);

        // check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        if (!$result) {
            //No Need to give feedback here since whole validateAndGetUser controls gives a feedback
            return false;
        }

        // save timestamp of this login in the database line of that user
        // $this->saveTimestampOfLoginOfUser($result->email);

        // successfully logged in, so we write all necessary data into the session and set "user_logged_in" to true
        $this->setSuccessfulLoginIntoSession(
            $result->id, $result->first_name." ".$result->last_name, $result->email, $result->role, $result->facility_id, $result->facility
        );

        // return true to make clear the login was successful
        // maybe do this in dependence of setSuccessfulLoginIntoSession ?
        return true;
    }

    /**
     * Validates the inputs of the users, checks if password is correct etc.
     * If successful, user is returned
     *
     * @param $username
     * @param $user_password
     *
     * @return bool|mixed
     */
    private function validateAndGetUser($email, $user_password)
    {
        // Instance new Model (User)
        $User = new User();

        // get all data of that user (to later check if password and password_hash fit)
        $result = $User->getUserDataByUsername($email);
        
        // check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        // brute force attack mitigation: reset failed login counter because of found user
        if (!$result) {

            // user does not exist, but we won't to give a potential attacker this details, so we just use a basic feedback message
            Session::add('feedback_negative', 'Username or password does not match');
            return false;
        }

        // if hash of provided password does NOT match the hash in the database: +1 failed-login counter
        if (!password_verify($user_password, $result->password)) {
            Session::add('feedback_negative', 'Username or password does not match');
            return false;
        }

        // if user is not active (= has not verified account by verification mail)
        if ($result->is_active != 1) {
            Session::add('feedback_negative', 'Account is inactive');
            return false;
        }

        return $result;
    }

    /**
     * Log out process: delete cookie, delete session
     */
    public function logout()
    {
        $id = Session::get('id');

        $this->deleteCookie($id);

        Session::destroy();
    }

    /**
     * The real login process: The user's data is written into the session.
     * Cheesy name, maybe rename. Also maybe refactoring this, using an array.
     *
     * @param $id
     * @param $username
     * @param $email
     * @param $user_account_type
     */
    public function setSuccessfulLoginIntoSession($id, $username, $email, $user_account_type, $facility_id, $facility)
    {
        Session::init();

        // remove old and regenerate session ID.
        // It's important to regenerate session on sensitive actions,
        // and to avoid fixated session.
        // e.g. when a user logs in
        session_regenerate_id(true);
        $_SESSION = array();

        Session::set('id', $id);
        Session::set('username', $username);
        Session::set('email', $email);
        Session::set('facility_id', $facility_id);
        Session::set('facility', $facility);
        Session::set('user_account_type', $user_account_type);
        Session::set('user_provider_type', 'DEFAULT');

        // finally, set user as logged-in
        Session::set('user_logged_in', true);

        // set session cookie setting manually,
        // Why? because you need to explicitly set session expiry, path, domain, secure, and HTTP.
        // @see https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet#Cookies
        setcookie(session_name(), session_id(), time() + SESSION_RUNTIME, COOKIE_PATH,
            COOKIE_DOMAIN, COOKIE_SECURE, COOKIE_HTTP);
    }

    /**
     * Write timestamp of this login into database (we only write a "real" login via login form into the database,
     * not the session-login on every page request
     *
     * @param $username
     */
    public function saveTimestampOfLoginOfUser($username)
    {
        $sql = "UPDATE users SET user_last_login_timestamp = :user_last_login_timestamp
                WHERE username = :username LIMIT 1";
        $sth = $this->db->prepare($sql);
        $sth->execute(array(':username' => $username, ':user_last_login_timestamp' => time()));
    }

    /**
     * Deletes the cookie
     * It's necessary to split deleteCookie() and logout() as cookies are deleted without logging out too!
     * Sets the remember-me-cookie to ten years ago (3600sec * 24 hours * 365 days * 10).
     * that's obviously the best practice to kill a cookie @see http://stackoverflow.com/a/686166/1114320
     *
     * @param string $id
     */
    public function deleteCookie($id = null)
    {
        // delete remember_me cookie in browser
        setcookie('remember_me', false, time() - (3600 * 24 * 3650), COOKIE_PATH,
            COOKIE_DOMAIN, COOKIE_SECURE, COOKIE_HTTP);
    }

    /**
     * Returns the current state of the user's login
     *
     * @return bool user's login status
     */
    public function isUserLoggedIn()
    {
        return Session::userIsLoggedIn();
    }
}
