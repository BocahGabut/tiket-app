<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="mobile-web-app-capable" content="yes">
	<!-- app favicon -->
	<title><?= $title . ' - RumahAkad' ?> </title>
	<link rel="icon" type="image/png" sizes="56x56" href="<?= base_url() ?>assets/img/rumah-akad-icons.png">
	<meta name='og:image' content='<?= base_url() ?>assets/img/rumah-akad-icons.png'>
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#2C2E3E">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#2C2E3E">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#2C2E3E">
	<!-- plugin stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>css/vendors.css" />
	<!-- app style -->
	<link href="<?php echo base_url('assets/') ?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/') ?>css/custom.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


</head>
<?php
$this->load->view('__libs/navbar__top');
$this->load->view('__libs/navbar__left');

?>
