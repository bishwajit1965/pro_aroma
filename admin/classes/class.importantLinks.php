<?php
spl_autoload_register(function ($class) {
    include_once('../class.' . $class . '.php');
});

include_once '../dbconfig.php';

class importantLinks
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // Add about us description
    public function store($heading, $phone, $cell_phone, $email, $address, $url)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_impt_links(heading, phone, cell_phone,  email, address, url) VALUES(:heading, :phone, :cell_phone, :email, :address, :url)");
            $stmt->bindparam(":heading", $heading);
            $stmt->bindparam(":phone", $phone);
            $stmt->bindparam(":cell_phone", $cell_phone);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":address", $address);
            $stmt->bindparam(":url", $url);
            $data = $stmt->execute();
            if ($data) {
                header("Location:importantLinks_index.php?inserted=1");
            } else {
                header("Location:add_importantLinks.php?inserted=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // View data
    public function viewImportantLinksData($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowcount() > 0) {
            while ($importantLinksData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <tr>
                    <td><?php echo $importantLinksData->id;?></td>
                    <td><?php echo $importantLinksData->heading;?></td>
                    <td><?php echo $importantLinksData->phone; ?></td>
                    <td><?php echo $importantLinksData->cell_phone; ?></td>
                    <td><?php echo $importantLinksData->email; ?></td>
                    <td><?php echo $importantLinksData->address; ?></td>
                    <td><?php echo $importantLinksData->url; ?></td>
                    <td><?php echo $importantLinksData->created_at; ?></td>
                    <td><?php echo $importantLinksData->updated_at; ?></td>
                    <td>
                        <a href="edit_importantLinks.php?edit_id=<?php echo $importantLinksData->id;?>" class="btn btn-xs btn-primary btn-block">
                        <i class="fa fa-edit"></i> Edit</a>
                        <a href="delete_importantLinks.php?delete_id=<?php echo $importantLinksData->id;?>" class="btn btn-xs btn-danger btn-block">
                        <i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php
            }
        } else { ?>
            <tr>
                <td colspan="15" class="text-center" id="empty-data">
                <strong>
                    <span style="color:#B50717;">
                    <h2>No data is here to display. Upload data...</h2>
                    </span>
                </strong></td>
            </tr>
        <?php
        }
    }

    // Update view
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['edit_id']]);
        if ($stmt->rowCount() > 0) {
            while ($edit_importantLinksData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="Id">Id</label>
                        <input type="text" name="id" class="form-control" 
                        value="<?php echo $edit_importantLinksData->id;?>">
                    </div>
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" 
                        value="<?php echo $edit_importantLinksData->heading;?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" 
                        value="<?php echo $edit_importantLinksData->phone;?>">      
                    </div>
                    <div class="form-group">
                        <label for="cell_phone"> Cell Phone</label>
                        <input type="text" name="cell_phone" id="cell_phone" class="form-control" 
                        value="<?php echo $edit_importantLinksData->cell_phone;?>">      
                    </div>email
                    <div class="form-group">
                        <label for="phone"> Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                        value="<?php echo $edit_importantLinksData->email;?>">      
                    </div>
                    <div class="form-group">
                        <label for="address"> Address</label>
                        <input type="text" name="address" id="address" class="form-control" 
                        value="<?php echo $edit_importantLinksData->address;?>">      
                    </div>
                    <div class="form-group">
                        <label for="url"> Url</label>
                        <input type="text" name="url" id="url" class="form-control" 
                        value="<?php echo $edit_importantLinksData->url;?>">   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="btn-update" 
                            onclick="return confirm('Are you sure to update this data?');">
                            <span class="glyphicon glyphicon-edit"></span> Update this Record !
                            </button>
                            <a href="importantLinks_index.php" class="btn btn-large btn-success">
                            <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </div>
                    </div>
                </form>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SORRY EMPTY!!! There is nothing in the database to update!</strong>
                    &nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Update about us
    public function update($id, $heading, $phone, $cell_phone, $email, $address, $url)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_impt_links WHERE id = :id");
        $stmt->execute([":id" => $_GET['edit_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_impt_links 
            SET 
            id = :id,
            heading = :heading,
            phone = :phone,
            cell_phone = :cell_phone,
            email = :email,
            address = :address,
            url = :url
            WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":heading", $heading);
            $stmt->bindparam(":phone", $phone);
            $stmt->bindparam(":cell_phone", $cell_phone);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":address", $address);
            $stmt->bindparam(":url", $url);
            $edited_about_us = $stmt->execute();
            if ($edited_about_us) {
                header("Location:importantLinks_index.php?updated=1");
            } else {
                header("Location:edit_importantLinks.php?updated=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Delete view
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['delete_id']]);
        if ($stmt->rowCount() > 0) {
            while ($del_importantLinksData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="Id">Id</label>
                        <input type="text" name="id" class="form-control" 
                        value="<?php echo $del_importantLinksData->id;?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" 
                        value="<?php echo $del_importantLinksData->heading;?>">
                    </div>
                    <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="text" name="" id="" class="form-control" 
                        value="<?php echo $del_importantLinksData->phone;?>">      
                    </div>
                    <div class="form-group">
                        <label for="cell_phone"> Cell Phone</label>
                        <input type="text" name="cell_phone" id="cell_phone" class="form-control" 
                        value="<?php echo $del_importantLinksData->cell_phone;?>">      
                    </div>
                    <div class="form-group">
                        <label for="phone"> Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                        value="<?php echo $del_importantLinksData->email;?>">      
                    </div>
                    <div class="form-group">
                        <label for="address"> Address</label>
                        <input type="text" name="address" id="address" class="form-control" 
                        value="<?php echo $del_importantLinksData->address;?>">      
                    </div>
                    <div class="form-group">
                        <label for="url"> Url</label>
                        <input type="text" name="url" id="url" class="form-control" 
                        value="<?php echo $edit_importantLinksData->url;?>">   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger" name="btn-delete" 
                            onclick="return confirm('Are you sure to delete this data?');">
                            <span class="glyphicon glyphicon-trash"></span> Delete this Record !
                            </button>
                            <a href="importantLinks_index.php" class="btn btn-large btn-success">
                            <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </div>
                    </div>
                </form>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SORRY EMPTY!!! There is nothing in the database to delete!</strong>
                    &nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Delete about us data
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_impt_links WHERE id = :delete_id");
        $stmt->execute([":delete_id" => $_GET['delete_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_impt_links WHERE id = :delete_id");
        $stmt->bindparam(":delete_id", $id);
        $delete_about_us = $stmt->execute();
        if ($delete_about_us) {
            header("Location:importantLinks_index.php?deleted=1");
        } else {
            header("Location:delete_importantLinks.php?deleted=0");
        }
    }
}


