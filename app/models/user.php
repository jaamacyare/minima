<?php

class User
{
    function login($POST)
    {
        $_SESSION['error'] = "";
        $DB = new Database();
        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];

            $query = "SELECT * FROM USERS WHERE username = :username && password = :password limit 1";
            $data =  $DB->read($query, $arr);
            if (is_array($data)) {
                // show($data);
                //logged in 

                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
                header("Location:" . ROOT . "home");
                die();
            } else {
                $_SESSION['error'] = "wrong username or password";
            }
        } else {
            $_SESSION['error'] = "please enter valid username and password";
        }
    }
    function signup($POST)
    {

        $_SESSION['error'] = "";
        $DB = new Database();
        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];
            $arr['email'] = $POST['email'];
            $arr['url_address'] = get_random_string_max(60);
            $arr['date'] = date("Y-m-d H:i:s");

            $query = "INSERT INTO users (username,password,email,url_address,date) VALUES (:username,:password,:email,:url_address,:date)";
            $data =  $DB->write($query, $arr);
            if ($data) {
                header("Location:" . ROOT . "login");
                die();
            }
        } else {
            $_SESSION['error'] = "please enter valid username and password";
        }
    }

    function check_login()
    {
        $DB = new Database();
        if (isset($_SESSION['user_url'])) {

            $arr['user_url'] = $_SESSION['user_url'];

            $query = "SELECT * FROM USERS WHERE url_address  = :user_url limit 1";
            $data =  $DB->read($query, $arr);
            if (is_array($data)) {
                //logged in 

                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
                return true;
            }
        }
        return false;
    }
    function logout()
    {
        //logged out 
        unset($_SESSION['user_name']);
        unset($_SESSION['user_url']);
        header("Location:" . ROOT . "login");
        die();
    }
}
