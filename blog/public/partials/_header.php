<div class="row header-one-top py-4">
    <div class="header-social-media">
          <!-- ## -->
    </div>
</div>
<div class="row header-two-middle py-2">
    <div class="col-sm-2 header-two-middle-one-logo">
        <?php
        $db = new Logo();
        $stmt = "SELECT * FROM tbl_logo";
        $db->viewLogo($stmt);
        ?>
    </div>
    <div class="col-sm-8 header-two-middle-two">
        <div class="header-blog-title">
            <?php
            $db = new headerDescription();
            $stmt = "SELECT * FROM tbl_header LIMIT 1";
            $db->viewHeaderDescription($stmt);
            ?>
        </div>
        <hr class="header">
    </div>
    <div class="col-sm-2 header-two-middle-three">
        <div class="header-important-links">
            <!-- Important links data loaded -->
            <?php
            $db = new ImportantLink;
            $query = "SELECT * FROM tbl_impt_links";
            $db->viewImportantLinksData($query);
            ?>
            <!-- /Important links data loaded -->
        </div>
        <div class="header-social-media">
            <!-- Social media data -->
            <h5 class="header-text">Social media sites</h5>
            <?php
            $db = new socialMedia;
            $query = "SELECT * FROM tbl_social_media";
            $db->getSocialMediaData($query);
            ?>
            <!-- /Social media data -->
        </div>
    </div>
</div>

<!--Wiil get the filename-->
<?php
$path = $_SERVER['SCRIPT_FILENAME'];
$current_page = basename($path, '.php');
?>
<!--/Wiil get the filename-->
<div class="row" id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"
    style="width:100%;"><a
    <?php
    if ($current_page == 'home') {
        echo 'id="active"';
    }
    ?>
    class="navbar-brand" href="home.php">Aroma</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a
                <?php
                if ($current_page == 'index') {
                    echo 'id="active"';
                }
                ?>
                href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a>
            </li>
            <div class="dropdown">
                <button class="dropbtn">Dropdown <i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <li class="nav-item"><a
                <?php
                if ($current_page == 'profile') {
                    echo 'id="active"';
                }
                ?>
                class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item"><a
            <?php
            if ($current_page == 'portfolio') {
                echo 'id="active"';
            }
            ?>
            class="nav-link" href="portfolio.php">Portfolio</a>
            </li>
            <div class="dropdown">
                <button class="dropbtn">Dropdown <i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <li class="nav-item"><a
            <?php
            if ($current_page == 'aboutUs') {
                echo 'id="active"';
            }
            ?>
            class="nav-link" href="aboutUs.php">About us</a>
            </li>
            <li class="nav-item"><a
            <?php
            if ($current_page == 'contactUs') {
                echo 'id="active"';
            }
            ?>
            class="nav-link" href="contactUs.php">Contact us</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"
                id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">

            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">Search</button>
        </form>
    </div>
    </nav>
</div>
