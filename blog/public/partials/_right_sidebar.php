<div class="col-sm-2">

    <div class="right-sidebar">
        <div class="post-category">
            <h5 class="card-title">Post Archives</h5>
            <!-- Blog archive -->
            <div class="blog-archive-popular-testimonial">
                <a href="posts_archieve.php" class="btn btn-sm btn-dark ">Archived all</a>
                <a href="" class="btn btn-sm btn-success ">Popular</a>
            </div>
            <!--/Blog archive -->

            <!-- Search monthly archived data -->
            <h5 class="card-title">Monthly Arch 2018</h5>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['submit'])) {
                    $month = trim($_POST['month']);
                }
            }
            ?>
            <form action="monthlyArchived.php" mathod="post">
                <select name="month" id="month" style="padding:5px 4px">
                    <option value="">Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <button type="submit" name="submit" class="btn btn-sm btn-success">
                <i class="fa fa-search"></i> Search</button>
            </form>
            <!-- /Search archived data -->
        </div>
        <div class="post-category">
            <h5 class="card-title">Post categories</h5>
            <?php
            $db = new frontView();
            $query = "SELECT * FROM tbl_category";
            $db->categoryNames($query);
            ?>
        </div>
        <div class="post-tags">
            <h5 class="card-title">Post Tags</h5>
            <?php
            $db = new frontView();
            $query = "SELECT * FROM tbl_tag";
            $db->tagNames($query);
            ?>
        </div>

        <div class="recent-post">
            <h5 class="card-title">Recent posts</h5>
            <?php
            $db = new frontView();
            $query = "SELECT * FROM tbl_article WHERE  published_at <= Now() AND status = 1 LIMIT 4";
            $db->recentPostsView($query);
            ?>
        </div>
    </div>
</div>
