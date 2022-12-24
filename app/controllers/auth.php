<?php

Class Auth extends Controller
{
    public function index() { $this->login(); }

    public function login()
    {
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
        {
            header("location: /dashboard");
            exit;
        }

        $userModel = $this->loadModel("userModel");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty(trim($_POST["username"]))){
                $userModel->usernameErr = "Please enter username";
            } else{
                $userModel->username = trim($_POST["username"]);
            }

            if(empty(trim($_POST["password"]))){
                $userModel->passwordErr = "Please enter your password";
            } else{
                $userModel->password = trim($_POST["password"]);
            }

            if(
                empty($userModel->usernameErr) &&
                empty($userModel->passwordErr) &&
                empty($userModel->loginErr) 
            ) {
                $userModel->checkCredentials();
            }
        }

        $data['loginData'] = (object) [
            "username" => $userModel->firstname ?? "",
            "password" => $userModel->password ?? "",

            "usernameErr" => $userModel->usernameErr ?? "",
            "passwordErr" => $userModel->passwordErr ?? "", 
            "loginErr" => $userModel->loginErr ?? "",
        ];

        $data["page_title"] = "Login";

        $this->view("/auth/login", $data);
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();

        header("location: /auth/login");
        exit;
    }

    public function register()
    {
        $userModel = $this->loadModel("userModel");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty(trim($_POST["username"]))){
                $userModel->usernameErr = "Please enter a username";
            } else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
                $userModel->usernameErr = "No special chars allowed";
            } else {
                $userModel->checkUniqueUser(trim($_POST["username"]));
            }

            if(empty(trim($_POST["password"]))){
                $userModel->passwordErr = "Please enter a password"; 
            } else if(strlen(trim($_POST["password"])) < 6){
                $userModel->passwordErr = "Password must have atleast 6 characters";
            } else {
                $userModel->password = trim($_POST["password"]);
            }

            if(empty(trim($_POST["confirm_password"]))){
                $userModel->confirmPasswordErr = "Please confirm password";     
            } else {
                $userModel->confirmPassword = trim($_POST["confirm_password"]);
                if(
                    empty($userModel->passwordErr) && 
                    ($userModel->password != $userModel->confirmPassword)
                ) {
                    $userModel->confirmPasswordErr = "Password did not match";
                }
            }

            if(
                empty($userModel->usernameErr) &&
                empty($userModel->passwordErr) &&
                empty($userModel->confirmPasswordErr) &&
                empty($userModel->registerErr)
            ) {
                $userModel->createUser();
            }
        }

        $data['registerData'] = (object) [
            "username" => $userModel->firstname ?? "",
            "password" => $userModel->password ?? "",
            "confirmPassword" => $userModel->confirm_password ?? "",

            "usernameErr" => $userModel->usernameErr ?? "",
            "passwordErr" => $userModel->passwordErr ?? "", 
            "confirmPasswordErr" => $userModel->confirmPasswordErr ?? "", 
            "registerErr" => $userModel->registerErr ?? "",
        ];

        $data["page_title"] = "Register";
        
        $this->view("/auth/register", $data);
    }
}