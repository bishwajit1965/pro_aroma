<?php
spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class Theme
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Update theme
    public function update($theme)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_theme 
            SET 
            theme =:theme
            WHERE id = 1");
            $stmt->bindparam(":theme", $theme);
            $result = $stmt->execute();
            if ($result) {
                header("Location:theme.php?updated=1");
            } else {
                header("Location:theme.php?updated=0");
            }
        } catch (PDOException $e) {
            echo "ERROR !!! ".$e->getMessage();
        }
    }

    // Get theme to get it checked
    public function getTheme($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($resultTheme = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $data = $resultTheme->theme;
                    if ($data) { ?>
                        <form class="form" action="" method="post" enctype="multipart/form-data">
                        <table class="table">

                        </table>
                        <!-- To avoid error when submitbutton is clicked-->
                        <input type="hidden" name="theme">
                        <!-- /To avoid error when submitbutton is clicked-->
                        <div class="form-group">
                            <input type="radio" name="theme" value="default"
                            <?php
                            if ($data == "default") {
                                echo "checked";
                            }?>> <span class="badge badge-pill" style="background-color:#3C8DBC;width:100px;border:1px solid #A8A8A8;">Default theme</span>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="theme" value="green"
                            <?php
                            if ($data == "green") {
                                echo "checked";
                            }?>> <span class="badge badge-pill" style="background-color:green;width:100px;border:1px solid #A8A8A8;">Green theme</span>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="theme" value="blue"
                            <?php
                            if ($data == "blue") {
                                echo "checked";
                            }?>> <span class="badge badge-pill" style="background-color:skyblue;width:100px;border:1px solid #A8A8A8;">Blue theme</span>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="theme" value="sky"
                            <?php
                            if ($data == "sky") {
                                echo "checked";
                            }?>> <span class="badge badge-pill" style="background-color:#00A65A;width:100px;border:1px solid #A8A8A8;">Light Sky theme</span>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fa fa-upload" aria-hidden="true"></i> Set Theme</button>
                    </form>
                    <?php
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
