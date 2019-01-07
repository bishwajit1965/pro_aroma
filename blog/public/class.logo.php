<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

class Logo
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // View logo on front page
    public function viewLogo($stmt)
    {
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($logo = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <img src="../../admin/logo/<?php echo $logo->photo;?>"
                alt="Logo" style="width:100px;height:100px;">
            <?php
            }
        } else {
        }
    }
}
