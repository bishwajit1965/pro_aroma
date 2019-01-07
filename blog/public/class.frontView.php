<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

class FrontView
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Select Meta post wise single Author name for SEO
    public function singlePostMetaAuthor($stmt)
    {
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute([":art_id" => $_GET['post_id']]);
        $stmt->bindparam(":art_id", $id);
        if ($stmt->rowCount() > 0) {
            while ($meta_author = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo $meta_author->author;
                echo ',';
            }
        } else {
        }
    }

    // Select Meta Author names for SEO
    public function metaAuthor($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($meta_author = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo $meta_author->author;
                echo ',';
            }
        } else {
        }
    }

    // Select single post Meta Tag name for SEO
    public function singlePostMetaTag($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":art_id" => $_GET['post_id']]);
        $stmt->bindparam(":art_id", $id);
        if ($stmt->rowCount() > 0) {
            while ($meta_data = $stmt->fetch(PDO::FETCH_OBJ)) {
                $stmt = "SELECT * FROM tbl_tag";
                $stmt = $this->conn->prepare($stmt);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if ($result->tag_id == $meta_data->tag_id) {
                            echo $result->tag_name;
                            echo ',';
                        }
                    }
                }
            }
        }
    }
    // Select Meta Tag names for SEO
    public function metaTags($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($meta_data = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo $meta_data->tag_name;
                echo ',';
            }
        }
    }

    // Post wise mete description
    public function singlePostMetaDescription($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":art_id" => $_GET['post_id']]);
            $stmt->bindparam(":art_id", $id);
            if ($stmt->rowCount() > 0) {
                while ($description = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo $description->description;
                    echo ',';
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Fetching frofile wdata
    public function profileView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php
            }
        }
    }
    // View data from database
    public function viewData($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="front-view-post-content">
                <div class="post-title">
                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>">
                    <h1><?php echo $result->title; ?></h1></a>
                </div>

                <div class="author-pubnlished">
                    <p style="font-weight:bold;color:#999;">Author: <?php echo $result->author; ?>
                    || Published on: <?php echo $fm->dateFormat($result->created_at); ?></p>
                </div>

                <div class="post-image">
                    <?php
                    if (!empty($result->photo)) { ?>
                        <a href="single_post.php?post_id=<?php echo $result->art_id;?>">
                        <img src="../../admin/articles/<?php echo $result->photo;?>" class="rounded
                        img-responsive img-thumbnail img-fluid">
                        <div class="text-block"><strong> Description : </strong>
                            <p><?php echo $fm->textShorten($result->description, 60);?></p>
                        </div></a>
                    <?php
                    } else {
                        #Code...
                    }
                ?>
                </div>

                <div class="content">
                    <p><?php echo $fm->textShorten($result->content, 480);?></p>
                </div>

                <span class="read-more">
                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-book"></i> Read more</a>
                </span>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
            </div>
            <?php
            }
        }
    }
    // View carusal
    public function viewSliderImages($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($sliderImage = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <div>
                    <img data-u="image" src="../../admin/slider/<?php echo $sliderImage->photo;?>"/>

                    <div class="carousel-caption d-none d-md-block">
                        <h4><?php echo $sliderImage->title; ?></h4>
                        <p><?php echo $sliderImage->description; ?></p>
                    </div>
                    <img data-u="thumb" src="../../admin/slider/<?php echo $sliderImage->photo; ?>"/>
                </div>
            <?php
            }
        }
    }

    // Recent posts view in index page
    public function recentPostsView($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>

            <div class="r-sidebar-recent-posts">
                <a href="single_post.php?post_id=<?php echo $result->art_id;?>">

                <h4 id="r-sidebar-recent-post-title">
                <?php echo $result->title; ?></h4></a>

                <p id="r-sidebar-recent-post-author">
                Author: <?php echo $result->author; ?><br>
                Published: <?php echo $fm->dateFormat($result->created_at); ?></p>

                <div id="r-sidebar-recent-posts-image">
                    <?php
                    if (!empty($result->photo)) { ?>
                        <a href="single_post.php?post_id=<?php echo $result->art_id; ?>">
                        <img src="../../admin/articles/<?php echo $result->photo;?>"
                        class="img-thumbnail img-responsive"></a>
                    <?php
                    } else {
                    }
                    ?>
                </div>
                <div class="post-content">
                    <p id="right-sidebar-content">
                    <?php echo $fm->textShorten($result->content, 166); ?></p>
                </div>

                <span id="r-sidebar-readmore">
                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-book"></i> Read more</a>
                </span>
                <br><br>
            </div>

            <?php
            }
        }
    }

    // For searching data from database
    public function searchData($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <a href="single_post.php?post_id=<?php echo $result->art_id; ?>">
                <h2 style="color: #333;text-shadow: 2px 2px 3px #000000;">
                <?php echo $result->title; ?></h2></a>
                <p style="font-weight:bold;color:#999;">Author: <?php echo $result->author; ?> || Published on:
                <?php echo $fm->dateFormat($result->created_at); ?></p>
                <div class="post-image-content clearfix">
                    <?php
                    if (!empty($result->photo)) { ?>
                        <img src="../../admin/articles/<?php echo $result->photo; ?>"
                        class="img rounded img-responsive img-thumbnail img-fluid"
                        style="float:left;margin-right:15px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                        0 6px 20px 0 rgba(0, 0, 0, 0.19); height:350px; margin-bottom:35px;margin-top:20px;">
                    <?php
                    } else {
                    }
                    ?>
                    <p><?php echo $fm->textShorten($result->content, 550); ?></p>

                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>"
                    class="btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Read more</a>
                </div>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
                <?php
            }
        } else { ?>
            <div class="notfound text-center" style="background-color:#EDEFF0;">

                <h1 style="color:#CF1F27;text-align:center;
                font-size:px;text-shadow: 2px 2px 3px #000000">
                SORRY !!!</h1>

                <h1 style="color:#CF1F27;text-align:center;font-size:px;
                text-shadow: 2px 2px 3px #000000">
                Searched data is not available in the database ! Check your spelling and search again.</h1>

                <div class="row">
                    <div class="col-sm-12">
                        <a href="index.php" class="btn btn-block btn-info">
                            <i class="fa fa-fast-backward"></i> Go Home</a>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Select Category names
    public function categoryNames($query)
    {
        $query ="SELECT * FROM tbl_category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="category-list">
                <ul>
                    <li>
                        <a href="rel_cat_posts.php?rel_cat_post_id=<?php echo $result->cat_id;?>">
                    <?php echo $result->cat_name;?></a>
                    </li>
                </ul>
            </div>
            <?php
            }
        }
    }
    // Select all tags to insert with articles/posts
    public function tagNames($stmt)
    {
        $query = "SELECT * FROM tbl_tag";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <span class="badge badge-pill badge-secondary">
                    <a href="rel_tag_posts.php?rel_tag_post_id=<?php echo $result->tag_id; ?>">
                    <?php echo $result->tag_name;?></a>
                </span>
            <?php
            }
        }
    }

    // Related category post view*****
    public function relatedCategoryPostView($query)
    {
        $fm = new helpers();
        $query = $this->conn->prepare($query);
        $query->execute([":cat_id" => $_GET['rel_cat_post_id']]);
        $query->bindparam(":cat_id", $id);
        if ($query->rowCount() > 0) {
            while ($r = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="related-category-post-view">
                <a href="index.php">
                    <h1 style="color: #333;text-shadow: 2px 2px 3px #000000;">
                    <?php echo $r->title; ?></h1>
                </a>

                <p style="font-weight:bold;color:#999;">Author: <?php echo $r->author; ?>
                || Published on: <?php echo $fm->dateFormat($r->created_at); ?> </p>

                <!-- Single Post Tag & Category section -->
                <div class="row">
                    <div class="col-sm-2">
                    <!-- Will match category_id with article table and category
                    table and will display selected category here -->
                        <?php
                        $db = new frontView();
                        $stmt = "SELECT * FROM tbl_category";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->cat_id == $r->cat_id) { ?>
                                    <a href="#">
                                    <button type="button" class="btn btn-primary">
                                    Cat
                                    <span class="badge badge-light"> <?php echo $result->cat_name; ?>
                                    </span>
                                    </button>
                                    </a>
                                <?php
                                }
                            }
                        } else {
                        }
                        ?>
                    </div>

                    <div class="col-sm-2">
                        <!-- Will match tag_id with article table and tag
                        atable and will display selected -->
                        <?php
                        $db = new frontView();
                        $stmt = "SELECT * FROM tbl_tag";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->tag_id == $r->tag_id) { ?>
                                    <a href="#">
                                    <button type="button" class="btn btn-success">
                                        Tag <span class="badge badge-light">
                                        <?php echo $result->tag_name;?></span>
                                    </button>
                                    </a>
                                <?php
                                }
                            }
                        } else {
                        }
                        ?>
                    </div>
                </div>
                <!-- /Single Post Tag & Category section -->

                <!-- Single Post Image section-->
                <?php
                if (!empty($r->photo)) { ?>
                    <div class="post-photo" style="height:250px; margin-top:20px;margin-bottom:30px;">
                        <a href="index.php">
                            <img src="../../admin/articles/<?php echo $r->photo; ?>"
                            class="img-fluid rounded img-responsive img-thumbnail"
                            alt="Image" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                            0 6px 20px 0 rgba(0, 0, 0, 0.19);height:250px;">
                        </a>
                    </div>
                <?php
                } else {
                }
                ?>
                <!-- /Single Post Image section-->

                <!-- Single Post Content section-->
                <div class="post-content">
                    <p><?php echo $fm->textShorten($r->content, 550); ?></p>
                    <span class="read-more">
                        <a href="single_post.php?post_id=<?php echo $r->art_id; ?>"
                        class="btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Read more</a>
                    </span>
                </div>
                <!-- /Single Post Content section-->

                <div class="clear-fix">
                    <span class="go-back">
                    <a href="index.php" class="btn btn-sm btn-primary">
                        <i class="fa fa-fast-backward"></i> Go back</a>
                    </span>
                </div>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
            </div>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:2.5rem;">&times;</span>
                    </button>
                    <strong id= "strong"#9C0A0A>
                        <h2 style="color:red;">SORRY !!! There is no post yet in this category !
                    </strong>&nbsp &nbsp </h2>
                    <div class="row">
                        <a href="index.php" class="btn btn-block btn-info">
                        <i class="fa fa-fast-backward"></i> Go Home</a>
                    </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Select all tags to insert with articles/posts
    public function tag($stmt)
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

    // Related Tag post view
    public function relatedtagPostView($query)
    {
        $fm = new helpers();
        $query = $this->conn->prepare($query);
        $query->execute([":tag_id" => $_GET['rel_tag_post_id']]);
        $query->bindparam(":tag_id", $id);
        if ($query->rowCount() > 0) {
            while ($r = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="related-category-post-view">

                <a href="index.php">
                    <h2 style="color: #333;text-shadow: 2px 2px 3px #000000;">
                    <?php echo $r->title; ?></h2>
                </a>

                <p style="font-weight:bold;color:#999;">Author: <?php echo $r->author; ?>
                || Published on: <?php echo $fm->dateFormat($r->created_at); ?> </p>

                <!-- Single Post Tag & Category section -->
                <div class="row">
                    <div class="col-sm-2">
                        <!-- Will match category_id with article table and category
                        table and will display selected category here -->
                        <?php
                        $db = new frontView();
                        $stmt = "SELECT * FROM tbl_category";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->cat_id == $r->cat_id) { ?>
                                    <a href="#">
                                    <button type="button" class="btn btn-primary">
                                    Cat
                                    <span class="badge badge-light"> <?php echo $result->cat_name; ?>
                                    </span>
                                    </button>
                                    </a>
                                <?php
                                }
                            }
                        } else {
                        }
                        ?>
                    </div>

                    <div class="col-sm-2">
                        <!-- Will match tag_id with article table and tag
                        atable and will display selected -->
                        <?php
                        $db = new frontView();
                        $stmt = "SELECT * FROM tbl_tag";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->tag_id == $r->tag_id) { ?>
                                    <a href="">
                                    <button type="button" class="btn btn-success">
                                        Tag <span class="badge badge-light">
                                        <?php echo $result->tag_name;?></span>
                                        </button>
                                    </a>
                                <?php
                                }
                            }
                        } else {
                        }
                        ?>
                    </div>
                </div>
                <!-- /Single Post Tag & Category section -->

                <!-- Single Post Image section-->
                <?php
                if (!empty($r->photo)) { ?>
                    <div class="post-photo" style="height:350px; margin-top:20px;margin-bottom:30px;">
                        <a href="index.php">
                            <img src="../../admin/articles/<?php echo $r->photo; ?>"
                            class="img-fluid rounded img-responsive img-thumbnail"
                            alt="Image" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                            0 6px 20px 0 rgba(0, 0, 0, 0.19);height:350px;">
                        </a>
                    </div>
                <?php
                } else {
                }
                ?>
                <!-- /Single Post Image section-->

                <!-- Single Post Content section-->
                <div class="post-content">
                    <p><?php echo $fm->textShorten($r->content, 550); ?></p>
                    <span class="read-more">
                        <a href="single_post.php?post_id=<?php echo $r->art_id; ?>"
                        class="btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Read more</a>
                    </span>
                </div>
                <!-- /Single Post Content section-->

                <div class="clear-fix">
                    <span class="go-back">
                    <a href="index.php" class="btn btn-sm btn-primary">
                        <i class="fa fa-fast-backward"></i> Go back</a>
                    </span>
                </div>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
            </div>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:2.5rem;">&times;</span></button>
                    <strong id= "strong"#9C0A0A>
                    <h2 style="color:red;">SORRY !!! There is no post yet in this tag !
                        </strong>&nbsp &nbsp </h2>
                    <a href="index.php" class="btn btn-block btn-info"><i class="fa fa-fast-backward"></i> Go Home</a>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Updatable data view
    public function singleView($query)
    {
        $fm = new helpers();
        $query = $this->conn->prepare($query);
        $query->execute([":art_id" => $_GET['post_id']]);
        $query->bindparam(":art_id", $id);
        while ($r = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="single-post-view">
                <a href="index.php"><h1><?php echo $r->title; ?></h1></a>
                <p id="single-post-view">Author: <?php echo $r->author; ?> || Published on:
                <?php echo $fm->dateFormat($r->created_at); ?></p>

                <!-- Single Post Tag & Category section -->
                <div class="row">
                    <div class="col-sm-2">
                        <!-- Will match category_id with article table and category
                        table and will display selected category here -->
                        <?php
                        $fm = new helpers;
                        $db = new frontView();
                        $stmt = "SELECT * FROM tbl_category";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->cat_id == $r->cat_id) { ?>
                                    <button type="button" class="btn btn-primary">
                                    Cat
                                    <span class="badge badge-light"> <?php echo $result->cat_name; ?>
                                    </span>
                                    </button>
                                <?php
                                }
                            }
                        } else {
                            #code...
                        }
                        ?>
                    </div>

                    <div class="col-sm-2">
                    <!-- Will match tag_id with article table and tag
                    atable and will display selected -->
                        <?php
                        $db = new frontView();
                        $fm = new helpers();
                        $stmt = "SELECT * FROM tbl_tag";
                        $stmt = $this->conn->prepare($stmt);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($result->tag_id == $r->tag_id) { ?>
                                    <button type="button" class="btn btn-success">
                                        Tag <span class="badge badge-light"> <?php echo $result->tag_name;?></span>
                                    </button>
                                <?php
                                }
                            }
                        } else {
                            #code...
                        }
                        ?>
                    </div>
                </div>
                <!-- /Single Post Tag & Category section -->

                <!-- Single Post Image section-->
                <div class="post-image">
                    <?php
                    if (!empty($r->photo)) { ?>
                    <a href="index.php">
                        <img src="../../admin/articles/<?php echo $r->photo;?>"
                        class="img-fluid img-responsive img-thumbnail"
                        alt="Image" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                        0 6px 20px 0 rgba(0, 0, 0, 0.19);" title="Post Image">
                        <div class="text-block">
                            <strong> Description : </strong>
                            <p><?php echo $fm->textShorten($r->description, 60);?></p>
                        </div></a>
                    <?php
                    } else { ?>
                        <!-- <img src="../public/images/toronto-banner-3.jpg" alt="Alternative image"
                        class="img-fluid img-responsive img-thumbnail"
                        alt="Image" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                        0 6px 20px 0 rgba(0, 0, 0, 0.19);" title="Post Image">
                        <div class="text-block">
                            <strong> Description : </strong>
                            <p><?php echo $fm->textShorten($r->description, 60);?></p>
                        </div> -->
                    <?php
                    }
                    ?>
                </div>
                <!-- /Single Post Image section-->

                <!-- Single Post Content section-->
                <div class="post-content">
                    <p style="text-indent:50px;"><?php echo $r->content; ?></p>
                </div>
                <!-- /Single Post Content section-->

                <div class="clear-fix">
                    <span class="go-back">
                        <a href="index.php" class="btn btn-sm btn-primary">
                        <i class="fa fa-fast-backward"></i> Go back</a>
                    </span>
                </div>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
            </div>

            <!-- Related category posts photo -->
            <div class="related-category-posts">
                <div class="borders">
                <h5>Related category posts</h5>
                </div>
                <?php
                $cat_id = $r->cat_id;
                $data = "SELECT * FROM tbl_article WHERE cat_id = $cat_id ORDER BY rand() LIMIT 21";
                $stmt = $this->conn->prepare($data);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if (!empty($data->photo)) { ?>
                            <a href="single_post.php?post_id=<?php echo $data->art_id;?>">
                                <img src="../../admin/articles/<?php echo $data->photo; ?>"
                            alt="<?php echo $data->description; ?>" style="width:120px;height:100px;margin-bottom:10px;" class="img-thumbnail img-responsive" data-toggle="tooltip" data-placement="top"
                            title="<?php echo 'Title: '. $data->title .' || ' . 'Desscription: '. $data->description;?>">
                            </a>
                        <?php
                        } else { ?>
                            <a href="single_post.php?post_id=<?php echo $data->art_id; ?>">
                            <img src="images/avatar/avatar.jpg" alt="Empty Image" style="width:120px;
                            height:100px;margin-bottom:10px;"
                            class="img-thumbnail img-responsive" data-toggle="tooltip" data-placement="top" title="<?php echo 'Title: ' . $data->title . ' || ' . 'Desscription: ' . $data->description; ?>">
                            </a>
                        <?php
                        }
                    }
                }
                ?>
            </div>
           <!-- /Related category posts photo -->
        <?php
        }
    }

    // Display all related category post
    public function relatedCategoryPosts($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":cat_id" => $_GET['post_id']]);
        $stmt->bindparam(":cat_id", $cat_id);
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <img src="../../admin/articles/<?php echo $data->photo;?>"
                alt="Photo" style="width:120px;height:110px;">
            <?php
            }
        } else {
        }
    }

    // Footer text view from 'tbl_footer'
    public function viewCopyright($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
                <?php echo $result->copyright; ?>
            <?php
            }
        } else { ?>
            <h2> There is no data to display. Upload data...</h2>
            <?php
        }
    }

    //Marquee text
    public function marqueeData()
    {
        $query = "SELECT * FROM tbl_article WHERE  published_at <= Now() AND status = 1 LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <p><a href ="single_post.php?post_id=<?php echo $data->art_id; ?>"><?php echo $data->title;?></a></p>
            <?php
            }
        }
    }

    // Search archived
    public function searchArchived($query)
    {
        $fm = new helpers;
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":month" => $_GET['month']]);
        $stmt->bindparam(":month", $month);
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="front-view-post-content">
                <div class="post-title">
                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>">
                    <h1><?php echo $result->title; ?></h1></a>
                </div>

                <div class="author-pubnlished">
                    <p style="font-weight:bold;color:#999;">Author: <?php echo $result->author; ?>
                    || Published on: <?php echo $fm->dateFormat($result->created_at); ?></p>
                </div>

                <div class="post-image">
                    <?php
                    if (!empty($result->photo)) { ?>
                        <a href="single_post.php?post_id=<?php echo $result->art_id; ?>">
                        <img src="../../admin/articles/<?php echo $result->photo; ?>" class="rounded
                        img-responsive img-thumbnail img-fluid">
                        <div class="text-block"><strong> Description : </strong>
                            <p><?php echo $fm->textShorten($result->description, 60); ?></p>
                        </div></a>
                    <?php

                } else {
                        #Code...
                }
                ?>
                </div>

                <div class="content">
                    <p><?php echo $fm->textShorten($result->content, 480); ?></p>
                </div>

                <span class="read-more">
                    <a href="single_post.php?post_id=<?php echo $result->art_id; ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-book"></i> Read more</a>
                </span>
                <!-- Styled hr -->
                <div class="row">
                    <hr class="type_7">
                </div>
                <!-- /Styled hr -->
            </div>

            <?php
            }
        } else {
            echo "<span style='color:red;'><strong>No data is available yet in this month !</strong></span>";
        }
    }

    //Pagination begins
    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"]-1) * $records_per_page;
        }
        $query2 = $query." limit $starting_position, $records_per_page";
        return $query2;
    }

    // Pagination
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
            $total_no_of_pages = ceil($total_no_of_records/$records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page=$_GET["page_no"];
            }
            if ($current_page!=1) {
                $previous = $current_page-1;
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a class='page-link' href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for ($i=1; $i<=$total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'
                    style='color:red; background-color:#D9EDF7;'> ".$i."</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if ($current_page!=$total_no_of_pages) {
                $next=$current_page+1;
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>
                Last</a></li>";
            }
            ?>
        </ul>
        <?php
        }
    }
}
