<!DOCTYPE html>

<html lang="en">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Invoice | </title>

<?php if($login==1 || $home_page ==1){ ?>

    <!-- Bootstrap -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- NProgress -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/nprogress/nprogress.css" rel="stylesheet">

     <!-- Custom Theme Style -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>build/css/custom.min.css" rel="stylesheet">

 <!-- Animate.css -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/animate.css/animate.min.css" rel="stylesheet">

    <?php } ?>

    <!-- iCheck -->

<?php if($home_page ==1){ ?>

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">

	

    <!-- bootstrap-progressbar -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <!-- JQVMap -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

    <!-- bootstrap-daterangepicker -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



    <!-- Custom Theme Style -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>build/css/custom.min.css" rel="stylesheet">

<?php } ?>

 

  </head>