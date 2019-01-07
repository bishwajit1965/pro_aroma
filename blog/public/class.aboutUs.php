<?php

spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class aboutUs
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // Blog Front View Code
    public function blogViewAboutUsText($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowcount() > 0) {
            while ($aboutUsData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <h5><?php echo $aboutUsData->heading; ?> </h5>
                <?php echo $fm->textShorten($aboutUsData->description, 380); ?>
                <a href="aboutUs.php" style="font-size:14px;" class="btn btn-sm btn-primary pull-right">
                <i class="fa fa-book"></i> Read more</a>
            <?php
            }
        } else { ?>
            <tr>
            <td colspan="15" class="text-center" id="empty-data">
            <strong><span style="color:#B50717;"><h2>No data is here to display.
             Upload data...</h2></span></strong></td>
        </tr>
        <?php
        }
    }
}
