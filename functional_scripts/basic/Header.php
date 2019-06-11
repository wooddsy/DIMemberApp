<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $properties->title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $appDir; ?>/View/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome PRO SVG JS -->
    <script defer src="<?php echo $appDir; ?>/View/vendor/fontawesome/js/all.js"></script>

    <!-- custom stylesheets -->
    <link href="<?php echo $appDir; ?>/View/css/di-styles.css" rel="stylesheet">
    <?php 
    if($properties->uri != 'login' && $properties->uri != 'register') {
        echo '<!-- Custom styles for this template -->';
        echo '<link href="' . $appDir . '/View/css/simple-sidebar.css" rel="stylesheet">';
    }
    ?>
    <?php 
    if($properties->uri == 'login' || $properties->uri == 'register') {
        echo '<link href="' . $appDir . '/View/css/login.css" rel="stylesheet">';
    }
    ?>

</head>

<body>
    <?php 
    if($properties->uri != 'login' && $properties->uri != 'register') {
    ?>
    <div class="d-flex" id="wrapper">
        <?php include(getcwd() . '/View/Menu/Sidebar.php'); ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include(getcwd() . '/View/Menu/Topbar.php'); ?>
    <?php } ?>
