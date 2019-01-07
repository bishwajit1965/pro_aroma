<?php
spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class metaDescription
{
    // Databse connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Get Meta Description for SEO
    public function getMetaDescription($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($meta_description = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo $meta_description->description;
            }
        } else {
        }
    }
}
