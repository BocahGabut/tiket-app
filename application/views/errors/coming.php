<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta content="Potenz Global Solutions" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="mobile-web-app-capable" content="yes">
	<!-- app favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/template/') ?>img/favicon.ico">
	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<!-- plugin stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/template/') ?>css/vendors.css" />
	<!-- app style -->
	<link href="<?php echo base_url('assets/template/') ?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/template/') ?>css/custom.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tiny.cloud/1/3c9u2a5btj33eisnohk2ody6zfniaz88zih7gd8jkechddka/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
	<!-- begin app -->
	<div class="app">
		<!-- begin app-wrap -->
		<div class="app-wrap">
			<!-- begin pre-loader -->
			<div class="loader">
				<div class="h-100 d-flex justify-content-center">
					<div class="align-self-center">
						<img src="assets/img/loader/loader.svg" alt="loader">
					</div>
				</div>
			</div>
			<!-- end pre-loader -->
			<!--start login contant-->
			<div class="app-contant">
				<div class="bg-white comingsoon">
					<div class="container-fluid p-0">
						<div class="row no-gutters">
							<div class="col-lg-6 align-self-center bg-gradient">
								<div class="d-flex align-items-center h-100-vh">
									<div class="comingsoon-wrap w-100">
										<div class="row no-gutters align-items-center justify-content-center">
											<div class="col-md-10 text-center m-b-40">

												<!-- Coming soon text -->
												<div class="px-5">
													<h2 class="text-white display-3 font-weight-normal">We are Coming soon</h2>
													<span class="text-white">We are currently working on a website and won't take long. Don't forget to check out our Social updates.</span>
												</div>

												<!-- newsletter -->
												<div class="row no-gutters ">
													<div class="col-md-7 mx-auto">
														<div class="mt-3"><a href="#" onclick="goBack()" class="btn btn-inverse-light"> Back Home </a></div>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 align-self-end">
								<img class="img-fluid" src="<?= base_url() . 'assets/template/img/bg/coming-soon-bg.svg' ?>" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end login contant-->
		</div>
		<!-- end app-wrap -->
	</div>
	<!-- end app -->

	<!-- plugins -->
	<script src="<?php echo base_url('assets/template/') ?>js/vendors.js"></script>
	<script src="<?php echo base_url('assets/template/') ?>js/app.js"></script>
	<script src="<?php echo base_url('assets/template/') ?>js/custom.js"></script>

	<script>
		function goBack() {
			window.history.back();
		}
	</script>

</body>
