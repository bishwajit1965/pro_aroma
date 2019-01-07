<?php
spl_autoload_register(function ($class) {
    include_once('class.' .$class.'.php');
});

class sendMessage
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    public function createMessage($firstname, $lastname, $email, $message)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_contact (firstname, lastname, email, message) 
            VALUES(:firstname, :lastname, :email, :message)");
            $stmt->bindparam(":firstname", $firstname);
            $stmt->bindparam(":lastname", $lastname);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":message", $message);
            $message = $stmt->execute();
            if ($message) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SUCCESSFUL !!! Message has been sent!</strong>
                </div>
            <?php
            }
        } catch (PDOException $e) {
            echo "ERROR Found: ". $e->getMessage();
        }
    }
}