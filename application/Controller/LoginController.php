<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Redirect;
use Mini\Core\Request;
use Mini\Core\Session;
use Mini\Model\Login;

/**
 * LoginController
 * Controls everything that is authentication-related
 */
class LoginController extends Controller
{
    /**
     * The login action, when you do login/login
     */
    public function login()
    {
        // Instance new Model (Login)
        $Login = new Login();

        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $Login->login(
            Request::post('email'), Request::post('password')
        );

        // check login status: if true, then redirect user to user/index, if false, then to login form again
        if ($login_successful) {
            Redirect::to('admin/index');
        } else {
            Redirect::to('home/index'); // Redirect to home if login failed.
        }
    }

    /**
     * The logout action
     * Perform logout, redirect user to main-page
     */
    public function logout()
    {
        // Instance new Model (Login)
        $Login = new Login();
        $Login->logout();

        Redirect::home();
        exit();
    }
}
