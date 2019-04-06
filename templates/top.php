<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Bill Buddy
    </title>
    <meta charset="utf-8">
    <meta name="author" content="CS205 Team">
    <meta name="description" content="Apartment finance sharing web application">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
    <![endif]-->

    <?php
    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    // inlcude all libraries.
    //
    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    print '<!-- begin including libraries -->';

    include 'lib/constants.php';

    include LIB_PATH . '/Connect-With-Database.php';

    print '<!-- libraries complete-->';
    ?>

</head>

<!-- **********************     Body section      ********************** -->
<?php
//print '<body id="' . $PATH_PARTS['filename'] . '">';
?>