<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

class Article {
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Store data with picture
    public function Create($title, $author, $tag_id, $cat_id, $status, $content, $uploaded_image, $description, $published_at)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_article(title, author, tag_id,
            cat_id, status, content, photo, description, published_at)
            VALUES(:title, :author, :tag_id, :cat_id, :status, :content,
            :uploaded_image, :description, :published_at)");
                $stmt->bindparam(":title", $title);
                $stmt->bindparam(":author", $author);
                $stmt->bindparam(":tag_id", $tag_id);
                $stmt->bindparam(":cat_id", $cat_id);
                $stmt->bindparam(":status", $status);
                $stmt->bindparam(":content", $content);
                $stmt->bindparam(":uploaded_image", $uploaded_image);
                $stmt->bindparam(":description", $description);
                $stmt->bindparam(":published_at", $published_at);
                $insertedData = $stmt->execute();
            if ($insertedData) {
                header("Refresh:2;article_index.php?dataInserted");
            } else {
                header("Location:add_article.php");
            }
            return true;
        } catch (PDOException $e) {
            echo "Error!" . $e->getMessage();
        }
        return true;
    }
    // Insert data without picture
    public function CreateWithoutPicture($title, $author, $tag_id, $cat_id, $status, $content, $description,  $published_at)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_article(title, author, tag_id, cat_id,
            status, content, description, published_at)
            VALUES(:title, :author, :tag_id, :cat_id, :status, :content, :description, :published_at)");
                $stmt->bindparam(":title", $title);
                $stmt->bindparam(":author", $author);
                $stmt->bindparam(":tag_id", $tag_id);
                $stmt->bindparam(":cat_id", $cat_id);
                $stmt->bindparam(":status", $status);
                $stmt->bindparam(":content", $content);
                $stmt->bindparam(":description", $description);
                $stmt->bindparam(":published_at", $published_at);
                $insertedData = $stmt->execute();
            if ($insertedData) {
                header("Refresh:2;article_index.php?dataInserted");
            } else {
                header("Location:add_article.php");
            }
            return true;
        } catch (Exception $e) {
            echo "Error!" . $e->getMessage();
        }
        return true;
    }
    // Fetch data from database to article_index.php
    public function viewData($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($r=$stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
                <td><?php echo $id++;?></td>
                <td><?php echo $fm->textShorten($r->title, 25);?></td>
                <td><?php echo $r->author;?></td>
                <td><?php echo $fm->textShorten($r->content, 50);?></td>
                <td>
                <?php
                if (empty($r->photo)) {
                    echo '<span style="color:red;font-weight:bold;">No photo</span>';
                } else { ?>
                    <img src="<?php echo $r->photo ;?>" alt="Image" style="width:80px; height:70px; border:  px solid# ; border-radius:5px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <?php
                }
                ?>
                </td>
                <td><?php echo $fm->textShorten($r->description, 50);?></td>
                <td><?php echo $r->cat_id;?></td>
                <td><?php echo $r->tag_id;?></td>
                <td>
                <?php
                if ($r->status==1) {
                    echo " <span style='border:px solid#DDD; background-color:#; color:#;
                    padding:px px; border-radius:px;font-weight:bold;'>
                    Published</span>";
                } elseif ($r->status==0) {
                    echo "<span style='border:px solid#; background-color:#;
                    padding:px px; border-radius:px; color:#B50000;font-weight:bold;'>
                    Draft</span>";
                }
                ?>
                </td>
                <td><?php echo $fm->dateFormat($r->created_at);?></td>
                <td><?php echo $fm->dateFormat($r->updated_at);?></td>
                <td><?php echo $fm->dateFormat($r->published_at);?></td>
                <td>
                    <a href="edit_article.php?edit_id=<?php echo $r->art_id;?>"
                    style="display:block; margin-bottom: 3px;"
                    class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top"
                    title="Update article" onclick="return confirm('Sure to go to edit view of this post ?')">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Update</a>
                    <?php if ($r->status == '1') { ?>
                    <a href="unpublish_article.php?unpublish_id=<?php echo $r->art_id;?>"
                    style="display:block; margin-bottom: 3px;"
                    class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"
                    title="Unpublish article" onclick="return confirm('Sure to go to unpublish view ?')">
                    <i class="fa fa-cloud-download" aria-hidden="true"></i> Unpublish</a>
                    <?php } else { ?>
                    <a href="publish_article.php?publish_id=<?php echo $r->art_id;?>"
                    style="display:block; margin-bottom:3px;"
                    class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"
                    title="Publish article" onclick="return confirm('Sure to go to publish view ?')">
                    <i class="fa fa-cloud-upload" aria-hidden="true"></i> Publish</a>
                    <?php } ?>
                    <a href="delete_article.php?delete_id=<?php echo $r->art_id; ?>"
                    style="display:block; margin-bottom: px;"
                    class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="top"
                    title="Delete article" onclick="return confirm('Sure to go to delete view ?')">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </td>
            </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="15" class="text-center" id="empty-data">
            <strong><span style="color:#B50717;"><h2>No data is here to display.
             Upload data...</h2></span></strong></td>
        </tr>
    <?php
        }
    }
    // Posts count code
    public function posts($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        return $rows;
    }
    // Post status data will be displayed
    public function Status($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($r = $stmt->fetch(PDO::FETCH_OBJ)) {
                return $r->status;
            }
        }
    }
    // Updatable data view
    public function updateView($query)
    {
        $fm = new helpers();
        $query = $this->conn->prepare($query);
        $query->execute([":art_id"=>$_GET['edit_id']]);
        $query->bindparam(":art_id", $id);
        while ($r = $query->fetch(PDO::FETCH_OBJ)) { ?>
        <form class="form" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group" >
                    <label for="id">Id</label>
                    <input type="text" name="art_id" class="form-control"
                    id="art_id" value="<?php echo $r->art_id;?>" disabled>
                </div>
                <div class="form-group" >
                    <label for="title" >Title</label>
                    <input type="text" name="title" class="form-control"
                    id="title" value="<?php echo $r->title;?>">
                </div>
                <div class="form-group">
                    <label for="author" >Author</label>
                    <input type="text" name="author" class="form-control" id="author"
                    value="<?php echo $r->author;?>">
                </div>
                <div class="form-group">
                    <label for="cat_id" >Category</label>
                    <select id="cat_id" name="cat_id" type="text" class="form-control">
                        <!-- Will match category_id with article table and category
                        table and will display selected -->
                        <?php
                        $db = new Category();
                        $stmt = "SELECT * FROM tbl_category";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                <option
                                    <?php if ($result->cat_id == $r->cat_id) { ?>
                                    selected = "selected"
                                    <?php } ?>
                                    value="<?php echo $result->cat_id;?>"
                                    >
                                    <?php echo $result->cat_name;?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tag_id" >Tag</label>
                    <select id="tag_id" name="tag_id" type="text" class="form-control">
                        <!-- Will match tag_id with article table and tag atable and will display selected -->
                        <?php
                        $db = new Tag();
                        $stmt = "SELECT * FROM tbl_tag";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                                <option
                                    <?php if ($result->tag_id == $r->tag_id) { ?>
                                    selected = "selected"
                                    <?php } ?>
                                    value="<?php echo $result->tag_id;?>">
                                    <?php echo $result->tag_name;?>
                                </option>
                            <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="created_at" class="form-control"
                    id="inputcreated_at3" value="<?php echo $r->created_at;?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="updated_at" class="form-control"
                    id="inputupdated_at3" value="<?php echo $r->updated_at;?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="photo"> Photo</label>
                    <div class="">
                        <img src="<?php echo $r->photo ;?>" class="img-responsive" alt="Image"
                        style="width:345px;height:182px;background-color: #DDD;padding: 4px;
                        border: 2px solid#ddd;border-radius: 2%;
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="photo" >Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="status" >Post Status</label>
                            <div class="selection">
                                <select name="status" style="padding: 6px 1px;">
                                    <option value="<?php echo $r->status;?>"><?php echo $r->status;?></option>
                                    <?php
                                    if ($r->status == "1") { ?>
                                        <option value="0"> 0 </option>
                                    <?php
                                    } elseif ($r->status == "0") { ?>
                                        <option value="1">1</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($r->status == '0') {
                                    echo "<span style='color:#FFF;
                                    border:2px solid #DDD;
                                    font-weight:bold;background-color: #367FA9; padding:8px 2px;
                                    border-radius:5px;'>
                                    Draft: $r->status </span>";
                                } elseif ($r->status == '1') {
                                    echo "<span style='color:#FFF; border:4px solid #A8A8A8;
                                    font-weight: bold; background-color: #07AAC2; padding:5px;
                                    border-radius:5px; padding:4px 1px; border-radius:5px;'>
                                    Publ: $r->status </span>";
                                } else {
                                    echo "<span style='color:#C12E2A;font-weight:bold;
                                    font-size:18px;border:2px solid #DDD; font-weight: bold;
                                    background-color: #07AAC2;
                                    padding: 1px 6px; border-radius:3px;'>
                                    Empty</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="published_at" >Published_at</label>
                    <input type="datetime-local" name="published_at" class="form-control" id="published_at" value="<?php echo  $r->published_at ;?> ">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description"> Description</label>
            <input type="text" name="description" class="form-control" id="description"
            value="<?php echo $r->description;?>">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="editor1" class="form-control" type="text" cols="" rows="">
            <?php echo $r->content;?>
            </textarea>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" name="btn-update">
                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                </button>
                <a href="article_index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
        </div>
        </form>
        <?php
        }
    }

    //Update data in database
    public function update($art_id, $title, $author, $cat_id, $status, $tag_id,
        $content, $uploaded_image, $description, $published_at)
    {
        // Deletes/unlinks image from folder
        if (!empty($file_name)) {
            $query = $this->conn->prepare('SELECT photo FROM tbl_article WHERE art_id = :art_id');
            $query->execute(array(':art_id' => $_GET['edit_id']));
            $query->bindparam(":art_id", $id);
            while ($ImgData = $query->fetch(PDO::FETCH_OBJ)) {
                $delImage = $ImgData->photo;
                unlink($delImage);
            }
        } else {
            try {
                $stmt = $this->conn->prepare("UPDATE tbl_article SET
                art_id 	    = :art_id,
                title 		= :title,
                author 		= :author,
                cat_id		= :cat_id,
                status	 	= :status,
                tag_id	 	= :tag_id,
                content	  	= :content,
                photo 		= :uploaded_image,
                description = :description,
                published_at= :published_at
                WHERE art_id 	= :art_id");
                $stmt->bindparam(":art_id", $art_id);
                $stmt->bindparam(":title", $title);
                $stmt->bindparam(":author", $author);
                $stmt->bindparam(":cat_id", $cat_id);
                $stmt->bindparam(":status", $status);
                $stmt->bindparam(":tag_id", $tag_id);
                $stmt->bindparam(":content", $content);
                $stmt->bindparam(":uploaded_image", $uploaded_image);
                $stmt->bindparam(":description", $description);
                $stmt->bindparam(":published_at", $published_at);
                $updatedData = $stmt->execute();
                if ($updatedData) {
                    header("Refresh:2; article_index.php?edited");
                } else {
                    header("Location: edit_article.php");
                }
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    // Picture Data tbl_articleUpdate without picture
    public function UpdateWithoutPicture($art_id, $title, $author, $cat_id, $status, $tag_id, $content, $description, $published_at)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_article SET
            art_id 	    = :art_id,
            title 		= :title,
            author 		= :author,
            cat_id		= :cat_id,
            status	 	= :status,
            tag_id	 	= :tag_id,
            content	  	= :content,
            description	  	= :description,
            published_at= :published_at
            WHERE art_id = :art_id");
            $stmt->bindparam(":art_id", $art_id);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":author", $author);
            $stmt->bindparam(":cat_id", $cat_id);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":tag_id", $tag_id);
            $stmt->bindparam(":content", $content);
            $stmt->bindparam(":description", $description);
            $stmt->bindparam(":published_at", $published_at);
            $updatedData = $stmt->execute();
            if ($updatedData) {
                header("Refresh:4; article_index.php?edited");
            } else {
                header("Location: edit_article.php");
            }
            return true;
        } catch (PDOException $e) {
             echo $e->getMessage();
            return false;
        }
    }
    // Unpublish post
    public function unpblishView($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["art_id" =>$_GET['unpublish_id']]);
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="row">
                <div class="col-md-8">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group" >
                            <label for="id">Id</label>
                            <input type="text" name="art_id" class="form-control"
                            id="art_id" value="<?php echo $result->art_id;?>" disabled>
                        </div>
                        <div class="form-group" >
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control"
                            id="title" value="<?php echo $result->title;?>">
                        </div>
                        <div class="form-group" >
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control"
                            id="author" value="<?php echo $result->author;?>">
                        </div>
                        <div class="form-group">
                            <label for="published_at">Published at</label>
                            <input type="text" class="form-control" name="published_at"
                            id="published_at"
                            value="<?php echo $fm->dateFormat($result->published_at);?>">
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Category</label>
                            <input type="text" class="form-control" id="cat_id" name="cat_id"
                            value="<?php echo $result->cat_id;?>">
                        </div>
                        <div class="form-group">
                            <label for="tag_id">Tag</label>
                            <input type="text" class="form-control" id="tag_id" name="tag_id"
                            value="<?php echo $result->tag_id;?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                            value="<?php echo $result->description;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="picture">Picture</label>
                        <div class="form-group" >
                            <img src="<?php echo $result->photo;?>"
                            alt="Picture" style="width:335px;height:180px;
                            border-radius: 10px;
                            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        </div>
                        <div class="form-group">
                            <label for="phone">Created at</label>
                            <input type="text" class="form-control"
                            id="created_at" name="created_at"
                            value="<?php echo $fm->dateFormat($result->created_at);?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Updatedat</label>
                            <input type="text" class="form-control" id="updated_at" name="updated_at"
                            value="<?php echo $fm->dateFormat($result->updated_at);?>">
                        </div>
                        <div class="form-group" >
                            <label for="status" >Status</label>
                            <div class="selection">
                                <select name="status" style="padding: 6px 1px;">
                                    <option value="<?php echo $result->status;?>"><?php echo $result->status;?></option>
                                    <?php
                                    if ($result->status == "1") { ?>
                                    <option value="0">0</option>
                                    <?php } elseif ($result->status == "0") { ?>
                                    <option value="1">1</option>
                                    <?php	} ?>
                                </select>
                                <?php
                                if ($result->status == '0') {
                                    echo "<span style='color:#FFF; border:1px solid #DDD; font-weight:bold;background-color: #5D8C20;
                                    padding:8px 5px; border-radius:5px;'>
                                     Draft : $result->status </span>";
                                } elseif ($result->status == '1') {
                                    echo "<span style='color:#FFF;border:4px solid #A8A8A8;
                                    font-weight: bold; background-color: #07AAC2;
                                    padding:4px 5px;border-radius:5px; border-radius:5px;'>
                                    Published : $result->status </span>";
                                } else {
                                    echo "<span style='color:#C12E2A;font-weight:bold; font-size:18px;border:2px solid #DDD; font-weight: bold;background-color: #07AAC2;
                                    padding: 1px 6px; border-radius:3px;'>
                                    Empty</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="editor1" class="form-control" type="text"
                            cols="" rows="">
                            <?php echo $result->content;?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm"
                        name="btn-unpublish"
                        onclick="return confirm('Sure to change state of the post ?')">
                        <span class="glyphicon glyphicon-edit">
                        </span> Unpublish</button>
                        <a href="article_index.php" class="btn btn-warning btn-sm">
                        <span class="glyphicon glyphicon-fast-backward"></span> Go Back</a>
                    </form>
                </div>
            </div>
        <?php
            }
        }
        return true;
    }

    //Unpublish
    public function Unpublish($art_id, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_article SET
            art_id = :art_id,
            status 	= :status
            WHERE art_id 	= :art_id");
            $stmt->bindparam(":art_id", $art_id);
            $stmt->bindparam(":status", $status);
            $updatedData = $stmt->execute();
            if ($updatedData) {
                header("Refresh:1; article_index.php?unpublished");
            }
            else {
                header("Location: unpublish_article.php?unpublish_error");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
            }
    }
    // Publish post
    public function publishView($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["art_id" =>$_GET['publish_id']]);
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group" >
                                <label for="id">Id</label>
                                <input type="text" name="art_id" class="form-control"
                                id="art_id"
                                value="<?php echo $result->art_id;?>" disabled>
                            </div>
                            <div class="form-group" >
                                <label for="name">Title</label>
                                <input type="text" name="title" class="form-control"
                                id="title" value="<?php echo $result->title;?>">
                            </div>
                            <div class="form-group" >
                                <label for="position">Author</label>
                                <input type="text" name="author" class="form-control"
                                id="author" value="<?php echo $result->author;?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Published at</label>
                                <input type="text" class="form-control"
                                id="published_at" name="published_at"
                                value="<?php echo $fm->dateFormat($result->published_at);?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Category</label>
                                <input type="text" class="form-control" id="cat_id" name="cat_id"
                                value="<?php echo $result->cat_id;?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Tag</label>
                                <input type="text" class="form-control" id="tag_id" name="tag_id"
                                value="<?php echo $result->tag_id;?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="picture">Picture</label>
                            <div class="form-group" >
                                <img src="<?php echo $result->photo;?>"
                                alt="Picture" style="width:335px;height:180px;
                                border-radius: 10px;
                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                value="<?php echo $result->description;?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Created at</label>
                                <input type="text" class="form-control" id="created_at" name="created_at"
                                value="<?php echo $fm->dateFormat($result->created_at);?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Updatedat</label>
                                <input type="text" class="form-control" id="updated_at" name="updated_at"
                                value="<?php echo $fm->dateFormat($result->updated_at);?>">
                            </div>
                            <div class="form-group" >
                                <label for="status" >Status</label>
                                <div class="selection">
                                    <select name="status" style="padding: 6px 1px;">
                                        <option value="<?php echo $result->status;?>">
                                        <?php echo $result->status;?></option>
                                        <?php
                                        if ($result->status == "1") { ?>
                                        <option value="0">0</option>
                                        <?php } elseif ($result->status == "0") { ?>
                                        <option value="1">1</option>
                                        <?php
                                        } ?>
                                    </select>
                                    <?php
                                    if ($result->status == '0') {
                                        echo "<span style='color:#FFF;
                                        border:1px solid #DDD; font-weight:bold;
                                        background-color: #5D8C20;
                                        padding:8px 5px; border-radius:5px;'> Draft : $result->status
                                        </span>";
                                    } elseif ($result->status == '1') {
                                        echo "<span style='color:#FFF;
                                        border:4px solid #A8A8A8;
                                        font-weight: bold; background-color: #07AAC2;
                                        padding:4px 5px; border-radius:5px; border-radius:5px;'>
                                         Published : $result->status </span>";
                                    }
                                    else {
                                        echo "<span style='color:#C12E2A;
                                        font-weight:bold; font-size:18px;
                                        border:2px solid #DDD; font-weight: bold;
                                        background-color: #07AAC2; padding:1px 6px; border-radius:3px;'>
                                        Empty</span>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="editor1" class="form-control" type="text" cols="" rows="">
                                <?php echo $result->content;?>
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm" name="btn-publish"
                            onclick="return confirm('Sure to change state of the post ?')">
                            <span class="glyphicon glyphicon-edit"></span> Publish</button>
                            <a href="article_index.php" class="btn btn-warning btn-sm">
                            <span class="glyphicon glyphicon-fast-backward"></span> Go Back</a>
                        </form>
                    </div>
                </div>
            <?php
            }
        }
        return true;
    }
    //Unpublish
    public function Publish($art_id, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_article SET
            art_id = :art_id,
            status 	= :status
            WHERE art_id 	= :art_id");
            $stmt->bindparam(":art_id", $art_id);
            $stmt->bindparam(":status", $status);
            $updatedData = $stmt->execute();
            if ($updatedData) {
                header("Refresh:1; article_index.php?published");
            }
            else {
                header("Location: publish_article.php");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // Updatable data view
    public function deleteView($query)
    {
        $query = $this->conn->prepare($query);
        $query->execute([":art_id"=>$_GET['delete_id']]);
        while ($r=$query->fetch(PDO::FETCH_OBJ)) {
        ?>
        <div class="row">
            <form class="form" action="" method="POST" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="form-group" >
                        <label for="id">Id</label>
                        <input type="text" name="art_id" class="form-control" id="art_id"
                        value="<?php echo $r->art_id;?>" disabled>
                    </div>
                    <div class="form-group" >
                        <label for="title" >Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?php echo $r->title;?>">
                    </div>
                    <div class="form-group">
                        <label for="author" >Author</label>
                        <input type="text" name="author" class="form-control" id="author"
                        value="<?php echo $r->author;?>">
                    </div>
                    <div class="form-group">
                        <label for="cat_id" >Category</label>
                        <select id="cat_id" name="cat_id" class="form-control">
                            <?php
                            $db = new Category();
                            $stmt = "SELECT * FROM tbl_category";
                            $data = $db->Category($stmt);
                            if ($data) {
                                while ($result = $data->fetch(PDO::FETCH_OBJ)) {
                                ?>
                                <option
                                    <?php if ($r->cat_id == $result->cat_id) { ?>
                                    selected ="selected"
                                    <?php
                                    }
                                    ?>
                                    value="<?php echo $r->cat_id; ?>">
                                    <?php echo $r->category; ?>
                                </option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="created_at" >Created_at</label> -->
                        <input type="hidden" name="created_at" class="form-control"
                        id="inputcreated_at3" value="<?php echo $r->created_at;?>">
                    </div>
                    <div class="form-group">
                        <!-- <label for="updated_at" >Updated_at</label> -->
                        <input type="hidden" name="updated_at" class="form-control"
                        id="inputupdated_at3" value="<?php echo $r->updated_at;?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="photo"> Photo</label>
                        <div class="">
                            <img src="<?php echo $r->photo ;?>" class="img-responsive" alt="Image" style="width:345px;height:182px;background-color: #DDD;padding: 4px; border: 2px solid#ddd;border-radius: 2%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                        value="<?php echo $result->description;?>">
                    </div>
                    <div class="form-group">
                        <label for="tag" >Tag</label>
                        <select id="tag_id" name="tag_id" class="form-control">
                            <?php
                            $db = new Tag();
                            $stmt = "SELECT * FROM tbl_tag";
                            $data = $db->Tag($stmt);
                            if ($data) {
                                while ($result = $data->fetch(PDO::FETCH_OBJ)) {
                            ?>
                            <option
                                <?php if ($r->tag_id == $result->tag_id) {?>
                                selected = "selected"
                                <?php }  ?>
                                value="<?php echo $r->tag_id; ?>">
                                <?php echo $r->tag; ?>
                            </option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="editor1" class="form-control" type="text" cols="" rows="">
                        <?php echo $r->content;?>
                        </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button  onclick="return confirm('Are you sure to delete this data!');"
                    type="submit" class="btn btn-danger" name="btn-delete">
                    <span class="glyphicon glyphicon-trash"></span>  Delere this Record !
                    </button>
                    <a href="article_index.php" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                </div>
            </form>
        </div>
        <!-- </div> -->
        <?php
        }
    }
    //Deletable data view
    public function delete($id)
    {
        //Select image from db to delete from folder
        $query = $this->conn->prepare('SELECT photo FROM tbl_article WHERE art_id =:art_id');
        $query->execute(array(':art_id'=>$_GET['delete_id']));
        $query->bindparam(":art_id", $id);
        while ($ImgData = $query->fetch(PDO::FETCH_OBJ)) {
            $delImage = $ImgData->photo;
            unlink($delImage);
        }
        // Delete image and data from database
        $stmt=$this->conn->prepare("DELETE FROM tbl_article WHERE art_id=:art_id");
        $stmt->bindparam(":art_id", $id);
        $deletedData = $stmt->execute();
        if ($deletedData) {
            header("Location: article_index.php?deleted");
        } else {
             header("Location:deleteArticle.php");
        }
        return true;
    }
    // Get Tag
    public function Category($query = "SELECT * FROM tbl_category")
    {
        $cat = new Categry($query);
        $stmt = $this->conn->prepare();
        $data = $stmt->execute();
        if ($data) {
            while ($result = $data->fetch(PDO::FETCH_OBJ)) { ?>
                <select name="" multiple>
                    <option value="<?php echo $result->cat_id; ?>">
                        <?php echo $result->cat_name; ?>
                    </option>
                </select>
            <?php
            }
        }
        return true;
    }

    // Get id to edit Not used anywhere
    public function getID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM article WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    // Counts number of published posts
    public function countPublishedPosts($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        echo $rows;
    }
    //Pagination begins
    public function paging($query, $records_per_page)
    {
        $starting_position=0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }
    public function paginglink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        if ($total_no_of_records > 0) {
        ?>
        <ul class="pagination">
            <?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page=$_GET["page_no"];
            }
            if ($current_page!=1) {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for ($i=1; $i<=$total_no_of_pages; $i++) {
                if ($i==$current_page) {
                    echo "<li><a href='".$self."?page_no=".$i."'
                    style='color:red; background-color:#D9EDF7;'>".$i."</a></li>";
                } else {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if ($current_page!=$total_no_of_pages) {
                    $next=$current_page+1;
                    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?>
        </ul>
        <?php
        }
    }
    /* pagination ends*/
}
