<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="../dist/img/bishwajit.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Bishwajit Paul</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
            </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="active treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Articles Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="../articles/add_article.php"><i class="fa fa-circle-o"></i> Create Article</a></li>
            <li><a href="../articles/article_index.php"><i class="fa fa-circle-o"></i> Article Index</a></li>

            </ul>
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Header Description Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="../headerDescription/addHeaderDescription.php"><i class="fa fa-circle-o"></i> Create header description</a></li>
            <li><a href="../headerDescription/headerdescriptionIndex.php"><i class="fa fa-circle-o"></i> Header description index</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Logo Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="../logo/addLogo.php"><i class="fa fa-circle-o"></i> Add logo description</a></li>
            <li><a href="../logo/logoIndex.php"><i class="fa fa-circle-o"></i> Logo index</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Theme Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../theme/theme.php"><i class="fa fa-circle-o"></i> Theme options</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Coming Soon Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../comingSoon/addComingSoon.php"><i class="fa fa-circle-o"></i> Coming soon post</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Category Navigation</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="../category/add_category.php"><i class="fa fa-circle-o"></i> Create Category</a></li>
            <li><a href="../category/category_index.php"><i class="fa fa-circle-o"></i> Category Index</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Slider gallery </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../slider/addSlider.php">
                    <i class="fa fa-circle-o"></i> Add slider photo</a></li>
                    <li><a href="../slider/sliderIndex.php">
                    <i class="fa fa-circle-o"></i> Slider gallery</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Tag Navigation </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="../tag/add_tag.php"><i class="fa fa-circle-o"></i> Create Tag</a></li>
            <li><a href="../tag/tag_index.php"><i class="fa fa-circle-o"></i> Tag Index</a></li>

            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Photo gallery </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../gallery/add_photo.php">
                    <i class="fa fa-circle-o"></i> Add photo</a></li>
                    <li><a href="../gallery/photo_gallery.php">
                    <i class="fa fa-circle-o"></i> Photo gallery</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span>Pages </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../pages/pages_home.php"><i class="fa fa-circle-o"></i> Pages home</a></li>
                <li>   
                <?php $db = new Pages();
                $query = "SELECT * FROM tbl_pages";
                $db->fetchPages($query); ?>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span>About Us Navigation </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../aboutUs/add_about_us.php">
                <i class="fa fa-circle-o"></i> Add About Us</a></li>
                <li><a href="../aboutUs/about_us_index.php">
                <i class="fa fa-circle-o"></i> About Us Index</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span>Received Messages</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="../inbox/message_index.php">
                <i class="fa fa-circle-o"></i> Messages index</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-navicon (alias)"></i> <span>Important Links </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../importantLinks/add_importantLinks.php">
                    <i class="fa fa-circle-o"></i> Add Important Links</a></li>
                    <li><a href="../importantLinks/importantLinks_index.php">
                    <i class="fa fa-circle-o"></i> Important Link Index</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span> Social Navigation</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../socialMedia/add_social_media.php">
                <i class="fa fa-circle-o"></i> Add Social Media</a></li>
                <li><a href="../socialMedia/social_media_index.php">
                <i class="fa fa-circle-o"></i> Social Media Home</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span> Meta Description</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../metaDescription/add_metaDescription.php">
                <i class="fa fa-circle-o"></i> Add Meta description</a></li>
                <li><a href="../metaDescription/metaDescription_index.php">
                <i class="fa fa-circle-o"></i> Meta description Home</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span> Copyright Navigation</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="../copyright/add_copyright.php">
                <i class="fa fa-circle-o"></i> Add copyright</a></li>
                <li><a href="../copyright/copyright_home.php">
                <i class="fa fa-circle-o"></i> Copyright home</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-navicon (alias)"></i> <span>Result Navigation </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="../result/add_result.php">
                <i class="fa fa-circle-o"></i> Store Result</a></li>
                <li><a href="../result/result_index.php">
                <i class="fa fa-circle-o"></i> Result Index</a></li>
            </ul>
        </li>
        
    </ul>
</section>
