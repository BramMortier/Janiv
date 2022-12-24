<?php 

class UserModel extends Model 
{
    public $username;
    public $usernameErr;

    public $password;
    public $passwordErr;

    public $confirmPassword;
    public $confirmPasswordErr;

    public $loginErr;
    public $registerErr;

    public function checkUniqueUser($user)
    {
        $db = $this->db_connect();

        $sql = 
        "SELECT id 
        FROM janiv.users 
        WHERE username = :username";

        if($stmt = $db->prepare($sql)){
            $stmt->bindValue(":username", trim($user), PDO::PARAM_STR);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $this->usernameErr = "This username is already taken";
                } else {
                    $this->username = trim($_POST["username"]);
                }
            } else{
                $this->registerErr =  "Oops! Something went wrong";
            }
        }
        unset($stmt);
        unset($db);
    }

    public function createUser()
    {
        $db = $this->db_connect();

        $sql = 
        "INSERT INTO janiv.users
            (username, password_hash) 
        VALUES 
            (:username, :password)";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":username", $this->username, PDO::PARAM_STR);
            $stmt->bindValue(":password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR);

            if($stmt->execute())
            {
                header("location: /auth/login");
            } else {
                $this->registerErr = "Oops! Something went wrong";
            }
        }
        unset($stmt);
        unset($db);
    }

    public function checkCredentials()
    {
        $db = $this->db_connect();

        $sql = 
        "SELECT id, username, password_hash 
        FROM janiv.users 
        WHERE username = :username";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":username", $this->username, PDO::PARAM_STR);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($user = $stmt->fetch()){
                        $userId = $user["id"];
                        $username = $user["username"];
                        $passwordHash = $user["password_hash"];

                        if(password_verify($this->password, $passwordHash)){
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $userId;
                            $_SESSION['username'] = $username;

                            header("location: /dashboard");
                        } else {
                            $this->loginErr = "Invalid username or password";
                        }
                    }
                } else {
                    $this->loginErr = "Invalid username or password";
                }
            } else {
                $this->loginErr = "Oops! Something went wrong";
            }
            unset($stmt);
            unset($db);
        }
    }
}