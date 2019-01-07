<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Trial of extending backend code</h1>
    <?php
    include_once('FrontEnd.php');
    $db = new FrontEnd;
    // $query = "SELECT * FROM tbl_article";
    $db->name();
    ?>

</div>

</body>
</html>
