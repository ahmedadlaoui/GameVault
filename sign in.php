<?php 

class signup{
    
    private $nickname;
    private $email;
    private $password;

    public function __construct($nickname,$email,$password){

        $this->nickname = $nickname;
        $this->email = $password;
        $this->nickname = $nickname;
    }

    
    
        
    }


?>






<!-- if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'author')");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error during signup: " . $e->getMessage();
        }
    } -->