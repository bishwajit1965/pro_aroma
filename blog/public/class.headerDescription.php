<?php
spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class headerDescription
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // View header description
    public function viewHeaderDescription($stmt)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($header = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <h1 class="header-text"><?php echo $header->title; ?></h1>
                <h2 class="header-text"><?php echo $header->slogan; ?></h2>
                <h3 class="header-text"><?php echo $header->motto; ?></h3>
                <h3 class="header-text">Working since : <?php echo $fm->formatData($header->established); ?> AD</h3>
            <?php
            }
        }
    }
}
