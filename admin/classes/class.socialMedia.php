<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

// include_once '../dbconfig.php';

class socialMedia
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    //Insert social media data to database
    public function store($social_media_address)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_social_media(social_media_address)
            VALUES(:social_media_address)");
            $stmt->bindparam(":social_media_address", $social_media_address);
            $insertedData = $stmt->execute();
            if ($insertedData) {
                header("Location:social_media_index.php?inserted=1");
            } else {
                header("Location:add_social_media.php?inserted=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Get social media data
    public function getSocialMediaData($query)
    {
        $query = "SELECT * FROM tbl_social_media LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <a href="<?php echo $data->social_media_address;?>"><i class="fa fa-facebook"></i></a>
            <?php
            }
        }
    }

    // Social media view
    public function viewSocialMedia($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                ?>
                <tr>
                    <td><?php echo $id++; ?></td>
                    <td><?php echo $result->social_media_address; ?></td>
                    <td>
                        <a href="edit_social_media.php?edit_media_id=<?php echo $result->id; ?>"
                        class="btn btn-xs btn-primary" 
                        onclick="return confirm('Are you sure to edit this data?');">
                        <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                        <a href="delete_social_media.php?del_media_id=<?php echo $result->id; ?>"
                        class="btn btn-xs btn-danger"  onclick="return confirm('Are you sure to delete this data?');">
                        <span class="glyphicon glyphicon-trash"></span> Delete</a>
                    </td>
                </tr>
                <?php 
            }
        } else { ?>
        <tr>
            <td colspan="3" class="text-center" id="empty-data">
                <strong>
                    <span style="color:#B50717;">
                        <h2> No data is here to display. Upload data...</h2>
                    </span>
                </strong>
            </td>
        </tr>
        <?php
        }
    }

    //Update social media
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['edit_media_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <form action="" class="form" method="post">
                <div class="form-group" >
                    <label for="id">Id</label>
                    <input type="text" name="id" class="form-control" id="id" 
                    value="<?php echo $r->id; ?>" disabled>
                </div>
                <div class="form-group" >
                    <label for="social_media_address"> Social_media_address</label>
                    <input type="text" name="social_media_address" class="form-control" id="social_media_address" 
                    value="<?php echo $r->social_media_address; ?>">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="btn-update" 
                        onclick="return confirm('Are you sure to edit this data?');">
                        <span class="glyphicon glyphicon-edit"></span> Update this Record
                        </button>
                        <a href="social_media_index.php" class="btn btn-large btn-success">
                        <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                    </div>
                </div>
            </form>
        <?php 
        }
    }

    // Update social media data
    public function update($id, $social_media_address)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_social_media WHERE id = :id");
        $stmt->execute([":id" => $_GET['edit_media_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_social_media
                SET
                id          = :id,
                social_media_address    = :social_media_address
                WHERE id = :id ");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":social_media_address", $social_media_address);
            $data = $stmt->execute();
            if ($data) {
                header("Location:social_media_index.php?updated");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Delete view
    //Update social media
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['del_media_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <form action="" class="form" method="post">
                    <div class="form-group" >
                        <label for="id">Id</label>
                        <input type="text" name="id" class="form-control" id="id" 
                        value="<?php echo $r->id; ?>" disabled>
                    </div>
                    <div class="form-group" >
                        <label for="social_media_address"> Social media address</label>
                        <input type="text" name="social_media_address" class="form-control" id="social_media_address" 
                        value="<?php echo $r->social_media_address; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger" name="btn-delete" 
                            onclick="return confirm('Are you sure to delete this data?');">
                            <span class="glyphicon glyphicon-edit"></span> Delete this Record
                            </button>
                            <a href="social_media_index.php" class="btn btn-large btn-success">
                            <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </div>
                    </div>
                </form>
            <?php 
        }
    }
    // Delete data
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_social_media WHERE id = :id ");
        $stmt->execute([":id" => $_GET['del_media_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_social_media WHERE id = :id ");
        $stmt->bindparam(":id", $id);
        $data = $stmt->execute();
        if ($data) {
            header("Location:social_media_index.php?deleted");
        }
        return true;
    }
}