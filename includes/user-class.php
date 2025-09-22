<?php
require "db.php";

class User{
    private $pdo;

    public function __construct()
    {
     $this->pdo = new DB();   
    }
    public function registerUser(String $name, String $email, String $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->pdo->run("INSERT INTO user (naam, email, password) VALUES (:name, :email, :password)", 
        ["name"=>$name,"email"=>$email,"password"=>$hash]);
    }           
    public function loginUser(String $email, String $password) {
        $user = $this->pdo->run(
            "SELECT * FROM user WHERE email = :email",
            ["email" => $email]
        )->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['userid'];
            $_SESSION['username'] = $user['naam'];
            return true;
        }
        return false;
    }

        // Check of gebruiker ingelogd is
    public function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    // Uitloggen
    public function logoutUser(): void {
        session_unset();
        session_destroy();
    }
}
?>