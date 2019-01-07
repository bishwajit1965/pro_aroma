<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

class Tag
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
// Store Tag
    public function store($tag_name)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_tag
			(tag_name) VALUES(:tag_name)");
            $stmt->bindparam(":tag_name", $tag_name);
            $data = $stmt->execute();
            if ($data) {
                header("Refresh:5; tag_index.php?inserted");
            } else {
                header("Location:add_tag.php");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Tag Index View
    public function viewTag($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
                <td><?php echo $id++;?></td>
                <td><?php echo $result->tag_name;?></td>
                <td><?php echo $fm->dateFormat($result->created_at); ?></td>
                <td><?php echo $fm->dateFormat($result->updated_at); ?></td>


                <td>
                    <a href="edit_tag.php?editTag_id=<?php echo $result->tag_id;?>"
                    class="btn btn-xs btn-primary"
                    onclick="return confirm('Are you sure to edit this data?');">
                    <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    <a href="delete_tag.php?delTag_id=<?php echo $result->tag_id;?>" class="btn btn-xs btn-danger"
                    onclick="return confirm('Are you sure to go to delete  view of this this data ?');">
                    <span class="glyphicon glyphicon-trash"></span> Delete</a>
                </td>
            </tr>
            <?php }
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

    public function tester()
    {
        echo "Hello! I am a tag class method.";
    }

    // Select all tags to insert with articles/posts
    public function Tag($stmt)
    {
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <option value="<?php echo $result->tag_id;?>">
                <?php echo $result->tag_name;?>
            </option>
            <?php }
        }
    }
    // Delete tag
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":tag_id" => $_GET['delTag_id']]);
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form action="" class="form" method="post">
            <div class="form-group" >
                <label for="tag_id">Id</label>
                <input type="text" name="tag_id" class="form-control" id="tag_id" value="<?php echo $result->tag_id;?>" disabled>
            </div>
            <div class="form-group" >
                <label for="tag">Tag</label>
                <input type="text" name="tag_name" class="form-control" id="tag_name" value="<?php echo $result->tag_name;?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger"
                name="btn-delete" onclick="return confirm('Are you sure to delete this data?');">
                <span class="glyphicon glyphicon-trash"></span> Delete this Record !
                </button>
                <a href="tag_index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
        </form>
        <?php }
    }
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":tag_id" => $_GET['editTag_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form action="" class="form" method="post">
            <div class="form-group" >
                <label for="tag_id">Id</label>
                <input type="text" name="tag_id" class="form-control" id="tag_id" value="<?php echo $r->tag_id;?>" disabled>
            </div>
            <div class="form-group" >
                <label for="tag" class="col-sm-2 control-label"> Tag</label>
                <input type="text" name="tag_name" class="form-control" id="tag_name" value="<?php echo $r->tag_name;?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn-update"
                onclick="return confirm('Are you sure to delete this data?');">
                <span class="glyphicon glyphicon-edit"></span> Update this Record
                </button>
                <a href="tag_index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
        </form>
        <?php }
    }
    public function update($id, $tag_name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_tag WHERE tag_id = :tag_id");
        $stmt->execute([":tag_id" => $_GET['editTag_id']]);
        $stmt->bindparam(":tag_id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_tag
				SET
				tag_id = :tag_id,
				tag_name = :tag_name
				WHERE tag_id = :tag_id ");
            $stmt->bindparam(":tag_id", $id);
            $stmt->bindparam(":tag_name", $tag_name);
            $data = $stmt->execute();
            if ($data) {
                header("Refresh:1; tag_index.php?updated");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // Delete data
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_tag WHERE tag_id = :tag_id ");
        $stmt->execute([":tag_id" => $_GET['delTag_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_tag WHERE tag_id = :tag_id ");
        $stmt->bindparam(":tag_id", $id);
        $data = $stmt->execute();
        if ($data) {
            header("Refresh:1; tag_index.php?deleted");
        }
        return true;
    }
}
