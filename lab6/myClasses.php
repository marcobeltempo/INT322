<?php

class DBLink {

    private $conn;
    private $resaultSet = "";

    //Connect to database
    public function __construct() {
        include "password filepath";
		
        $this->conn = mysqli_connect($host, $user, $password, $database) or die("Connection failed:" . $this->conn->connect_error);

    }
    public function query($sql_query) {
        $this->resaultSet = mysqli_query($this->conn, $sql_query) or die("Qry error" . $this->conn->connect_error);
        return $this->resaultSet;
    }
    public function isEmptyResult() {

        $status = mysqli_num_rows($this->resaultSet);
        return $status;
    }
    public function __destruct() {
        //Closing Connection
        mysqli_close($this->conn);
    }

} //END DBLink Class

class ValidateUser {

    //Private class variables for login credentials
    private $username;
    private $password;
    private $mysqli;
    private $email;
    public $errorUsername = "";
    public $errorPassword = "";
    public $errorEmail = "";
    public $errorLoginFail = "";

    function __construct() {
        $this->username = isset($_POST['username']) ? $_POST['username'] : null;
        $this->password = isset($_POST['password']) ? $_POST['password'] : null;
        $this->email    = isset($_POST['email']) ? $_POST['email'] : null;
        $this->mysqli   = new DBLink();
    }

    //If user forgot their password
    function forgotPassword() {

        $result = $this->mysqli->query("SELECT * FROM users where username='$this->username' AND email='$this->email' ");
        $count  = mysqli_num_rows($result);

        if ($count == 1) {
            $row      = mysqli_fetch_assoc($result);
            //Email information
            $to       = $this->email;
            $subject  = "Password Hint";
            $message  = "Username: $this->username" . "\r\n" . "Password Hint: " . $row['passwordHint'] . "\r\n";
            $headers  = "From:" . "\r\n" . "Reply-To: mabeltempo@myseneca.ca" . "\r\n" . "X-Mailer: PHP/" . phpversion();
            $mailsent = mail($to, $subject, $message, $headers);
            if ($mailsent) {
                echo "Please check your inbox for login help.";
            }
            unset($_GET['forgot']);
        } else {
            $this->errorLoginFail = "Error: Invalid username or email address.";
        }
    }

    function loginValidation() {

        $valid = true;
        if (empty($this->username)) {
            $this->errorUsername = "Error: Please enter a valid username.";

        }
        if (empty($this->password)) {
            $valid               = false;
            $this->errorPassword = "Error: Please enter a valid password.";
        }

        if ($valid) {
            $result = $this->mysqli->query("SELECT * FROM users where username='$this->username'");

            $count = mysqli_num_rows($result);
            $row   = mysqli_fetch_assoc($result);

            if ($count == 1) {
                return (password_verify($this->password, $row['password']) && $this->username = $row['username']);

            } else {
                $this->errorLoginFail = "Error: Invalid username or password";
                $this->username       = "";
                $this->password       = "";
            }
        }
    }

} //END ValidateUser Class

class Menu {

    public function __construct($list) {

        foreach ($list as $item) {
            echo $item;
        }
    }
} //END Menu Class

?>
