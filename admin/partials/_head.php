<?php
  session_start();
  ob_start();
  require_once '../class.helpers.php';
  require_once '../class.user.php';
  $fm = new helpers();
  $user_home = new USER();
if (!$user_home->is_logged_in()) {
    $user_home->redirect('../index.php');
}
  $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['userSession']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php
    include_once('../class.helpers.php');
    echo 'Aroma || ' . $fm->title();
    ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Favicon -->
  <link rel="icon" href="../images/favicon/flower_favicon-2.jpg" type="image/x-icon" />
  <!-- Fancy box -->
  <link rel="stylesheet" type="text/css" href="../fancybox-master/jquery.fancybox.min.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- Photo gallery css -->
  <link rel="stylesheet" type="text/css" href="../gallery/css/gallery.css">
  <!-- DataTables -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  [endif] -->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- CSS Code to make a text blink -->
    <style>
      .blink_me {
      animation: blinker 1s linear infinite;
      }
      @keyframes blinker {
        50% { opacity: 0; }
    }
    </style>
  <!-- CSS Code to make a text blink  -->
    <?php
    spl_autoload_register(function ($class) {
        include_once('../classes/class.'.$class.'.php');
    });

    ?>
    <?php
    include_once('../dbconfig.php');
    include_once('../class.helpers.php');
    ?>
</head>
