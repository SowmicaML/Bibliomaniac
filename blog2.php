<?php
//session_start(); 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
     Blog
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>

<body class="">

    <?php include('header.php'); ?>
     <!-- Slider -->

	<div class="main_slider" style="background-image:url(images/bg2.jpeg)">
		  <div class="container fill_height">
		   </div>
  </div>
    <div class="col-md-12" style="padding-left:10%;padding-top:5%;padding-right:10%">
                <h2 class="card-title" style="color:#fe4c50;text-align:center">Thought of the day</h2>
                <div class="col-md-12" style="padding-top:5%">
                <div class="card card-user">
                <div class="card-header">
                <h4 style="padding-left:10%;padding-right:10%">
                “If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed.
                 The Vision Pulls You.” <br>
                 </h4>
                 <h5 style="text-align:right;color:#fe4c50">– Steve Jobs</h5>
                </div>
                </div>
                </div>
    </div>
    <?php include("news.php"); ?>
<?php include("Footer.php"); ?>
</body>

</html>
