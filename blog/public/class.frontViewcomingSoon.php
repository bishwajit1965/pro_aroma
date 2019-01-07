<?php
spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class FrontViewComingSoon
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // View data for indexing
    public function viewComingSoonData($query)
    {
        try {
            $fm = new helpers();
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <div class="middle">
                        <h1><?php echo $data->title;?></h1>
                        <hr class="coming-soon">
                        <p id="demo" style=""></p>
                        <hr class="coming-soon-description">
                    </div>

                    <div class="bottomleft">
                        <p><?php echo $fm->textShorten($data->description, 60);?></p>
                    </div>
                <?php
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // View data for indexing
    public function viewComingSoonPhoto($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <img src="../../admin/comingSoon/<?php echo $data->photo;?>" alt="Coming soon image" style="width:100%;height:450px;" class="bgimg">
                <?php
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // Coming soon publishing data fetching for fron view
    public function comingSoonPublishedDateView($query)
    {
        $fm = new helpers;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($datedata = $stmt->fetch(PDO::FETCH_OBJ)) {
                return $fm->dateFormat($datedata->published_at);
            }
        }
    }
}
