<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
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

    public function createHeaderDescription($title, $slogan, $motto, $established)
    {
        $stmt = $this->conn->prepare("INSERT INTO tbl_header(title, slogan, motto, established) VALUES(:title, :slogan, :motto, :established)");
        $stmt->bindparam(":title", $title);
        $stmt->bindparam(":slogan", $slogan);
        $stmt->bindparam(":motto", $motto);
        $stmt->bindparam(":established", $established);
        $headerDescription = $stmt->execute();
        if ($headerDescription) {
            header("Location:headerDescriptionIndex.php?inserted=1");
        } else {
            header("Location:addHeaderDescription.php?inserted=0");
        }
    }

    // View header description
    public function viewHeaderDescription($stmt)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $i = 1;
            while ($header = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $header->title; ?></td>
                <td><?php echo $header->slogan; ?></td>
                <td><?php echo $header->motto; ?></td>
                <td><?php echo $fm->dateFormat($header->established); ?></td>
                <td><?php echo $fm->dateFormat($header->created_at); ?></td>
                <td>
                    <a href="editHeaderDescription.php?edit_id=<?php echo $header->id; ?>" class="btn btn-xs btn-primary btn-block" onclick ="return confirm('Are you sure of going to editing view of this data ?');"><i class="fa fa-edit"></i> Edit</a>
                    <a href="deleteHeaderDescription.php?delete_id=<?php echo $header->id; ?>" class="btn btn-xs btn-danger btn-block" onclick ="return confirm('Are you sure of going to deleting view of this data ?');"><i class="fa fa-trash"  ></i> Delete</a>   
                </td>
            </tr>    
            <?php
            }
        }
    }

    // Update view
    public function headerDescriptionUpdateView($stmt)
    {
        try {
            $fm = new helpers();
            $stmt = $this->conn->prepare("SELECT * FROM tbl_header WHERE id = :id");
            $stmt->execute([":id" => $_GET['edit_id']]);
            if ($stmt->rowCount() > 0) {
                while ($header = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <form class="form" action="" method="POST">
                        <div class="form-group">
                            <label for="title"> Id</label>
                            <input type="text" name="title" 
                            class="form-control" id="title" value="<?php echo $header->id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title"> Title</label>
                            <input type="text" name="title" 
                            class="form-control" id="title" value="<?php echo $header->title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="slogan"> Slogan</label>
                            <input type="text" name="slogan" 
                            class="form-control" id="slogan" value="<?php echo $header->slogan; ?>">
                        </div>
                        <div class="form-group">
                            <label for="motto"> Motto</label>
                            <input type="text" name="motto" 
                            class="form-control" id="motto" value="<?php echo $header->motto; ?>">
                        </div>

                        <div class="form-group">
                            <label for="established"> Established</label>
                            <input type="date" name="established" 
                            class="form-control" id="established" value="<?php echo $fm->dateFormat($header->established); ?>">
                        </div>
                        <div class="form-group">   
                            <button type="submit" name="submit" 
                            class="btn btn-sm btn-primary" 
                            onclick ="return confirm('Are you sure of editing this data ?');">
                            <i class="fa fa-upload" aria-hidden="true"> Update</i></button>

                            <button type="reset-data" value="cancel" 
                            class="btn btn-danger btn-sm">
                            <i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>

                            <a href="headerDescriptionIndex.php" class="btn btn-sm btn-primary">
                            <span class="glyphicon glyphicon-inbox"></span> Header description index</a>
                        </div>
                    </form>
                <?php
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Update header description
    public function updateHeaderDescription($id, $title, $slogan, $motto, $established)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_header 
            SET
            id = :id, 
            title = :title,
            slogan = :slogan,
            motto = :motto,
            established = :established
            WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":slogan", $slogan);
            $stmt->bindparam(":motto", $motto);
            $stmt->bindparam(":established", $established);
            $headerDescription = $stmt->execute();
            if ($headerDescription) { ?>
                <script>
                    window.location='headerDescriptionIndex.php?updated=1';
                </script>
            <?php
            }
        } catch (PDOException $e) {
            echo 'ERROR!!!'.$e->getMessage();
        }
    }

    // Update view
    public function headerDescriptionDeleteView($stmt)
    {
        try {
            $fm = new helpers();
            $stmt = $this->conn->prepare("SELECT * FROM tbl_header WHERE id = :id");
            $stmt->execute([":id" => $_GET['delete_id']]);
            if ($stmt->rowCount() > 0) {
                while ($header = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <form class="form" action="" method="POST">
                        <div class="form-group">
                            <label for="title"> Id</label>
                            <input type="text" name="title" 
                            class="form-control" id="title" value="<?php echo $header->id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title"> Title</label>
                            <input type="text" name="title" 
                            class="form-control" id="title" value="<?php echo $header->title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="slogan"> Slogan</label>
                            <input type="text" name="slogan" 
                            class="form-control" id="slogan" value="<?php echo $header->slogan; ?>">
                        </div>
                        <div class="form-group">
                            <label for="motto"> Motto</label>
                            <input type="text" name="motto" 
                            class="form-control" id="motto" value="<?php echo $header->motto; ?>">
                        </div>

                        <div class="form-group">
                            <label for="established"> Established</label>
                            <input type="date" name="established" 
                            class="form-control" id="established" value="<?php echo $fm->dateFormat($header->established); ?>">
                        </div>
                        <div class="form-group">   
                            <button type="submit" name="submit" 
                            class="btn btn-sm btn-primary" 
                            onclick ="return confirm('Are you sure of deleting this data ?');">
                            <i class="fa fa-upload" aria-hidden="true"> Delete</i></button>

                            <button type="reset-data" value="cancel" 
                            class="btn btn-danger btn-sm">
                            <i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>

                            <a href="headerDescriptionIndex.php" class="btn btn-sm btn-primary">
                            <span class="glyphicon glyphicon-inbox"></span> Header description index</a>
                        </div>
                    </form>
                <?php
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Delete header description
    public function deleteHeaderDescription($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_header WHERE id = :id");
            $stmt->execute([":id" => $_GET['delete_id']]);
            $stmt = $this->conn->prepare("DELETE FROM tbl_header WHERE id =:id");
            $stmt->bindparam(":id", $id);
            $deletedHeader = $stmt->execute();
            if ($deletedHeader) {
                header("Location:headerDescriptionIndex.php?deleted=1");
            } else {
                header("Location:deleteHeaderDescription.php?deleted=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
