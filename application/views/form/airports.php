<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('__libs/header');
?>

<body data-name="airlines">
	<div class="app">
		<div class="app-wrap">
			<!-- <div class="loader">
				<div class="h-100 d-flex justify-content-center">
					<div class="align-self-center">
						<img src="<?php echo base_url('assets/') ?>img/loader/loader.svg" alt="loader">
					</div>
				</div>
			</div> -->

			<div class="app-container">
				<div class="app-main" id="main">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12 mb-30">
								<!-- begin page title -->
								<div class="d-block d-lg-flex d-flex flex-nowrap align-items-center mb-3">
									<div class="page-title mr-2 pr-2 ">
										<h1>
											<?= $title ?>
										</h1>
									</div>
									<div class="ml-auto d-flex align-items-center secondary-menu text-center">
										<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Log out">
											<i class="fa fa-power-off btn btn-icon text-danger"></i>
										</a>
									</div>
								</div>
								<!-- end page title -->
							</div>
							<?php echo $this->session->flashdata('message') ?>
							<?php
							if (isset($_GET['edit'])) {
								foreach ($data->result() as $ds) {
							?>
									<form action="post?action=airports&update=true&id=<?= $_GET['edit'] ?>" method="POST" class="col-md-12">
										<div class="col-md-12 mb-3">
											<div class="card">
												<div class="card-header">
													<div class="d-block d-lg-flex flex-nowrap align-items-center">
														<div class="page-title mr-4">
															<input type="submit" class="btn-add btn btn-outline-success mr-2" name="save" value="Update data" />
															<a href="airlines" class="btn-add btn btn-outline-warning">
																Back
															</a>
														</div>
													</div>
												</div>
												<!-- <div class="card-body"></div> -->
											</div>
										</div>
										<div class="col-md-12 select-wrapper">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>code</label>
																<input type="text" maxlength="3" required value="<?= $ds->code ?>" name="code" id="code" class="form-control" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Name</label>
																<input type="text" required name="airports" value="<?= $ds->airports ?>" id="airports" class="form-control" />
															</div>
														</div>
														<div class="col-md-6 selects-contant">
															<div class="form-group">
																<label>Country</label>
																<select data-country="country-code" class="select-country-air js-basic-single form-control" name="countryname" id="country">
																	<option value="<?= $ds->countryname ?>" selected><?= $ds->countryname . ' [selected]' ?></option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Country code</label>
																<input style="background: transparent;" type="text" readonly maxlength="3" required name="countrycode" value="<?= $ds->countrycode ?>" id="country-code" class="form-control" />
															</div>
														</div>
														<div class="col-md-6 selects-contant">
															<div class="form-group">
																<label>City <span id="loading" style="color: red;display: none">Please wait ...</span></label>
																<select class="select-city js-basic-single form-control" name="cityname" id="city-">
																	<option value="<?= $ds->cityname ?>" selected><?= $ds->cityname . ' [selected]' ?></option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>City code </label>
																<input style="background: transparent;" type="text" readonly maxlength="3" required name="citycode" value="<?= $ds->citycode ?>" id="city-code" class="form-control" />
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label>TimeZone</label>
																<input type="number" maxlength="3" required name="timezone" id="timezone" class="form-control" value="<?= $ds->timezone ?>" />
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<label>Latitude </label>
																<input type="text" value="<?= $ds->lat ?>" required name="lat" id="lat" class="form-control" />
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<label>Longitude </label>
																<input type="text" value="<?= $ds->lon ?>" required name="lon" id="lon" class="form-control" />
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								<?php
								}
							} else {
								?>
								<form action="post?action=airports&save=true" method="POST" class="col-md-12">
									<div class="col-md-12 mb-3">
										<div class="card">
											<div class="card-header">
												<div class="d-block d-lg-flex flex-nowrap align-items-center">
													<div class="page-title mr-4">
														<input type="submit" class="btn-add btn btn-outline-success" name="save_back" value="Save & Back" />
														<input type="submit" class="btn-add btn btn-outline-info ml-2 mr-2" name="save_new" value="Save & New" />
														<a href="airports" class="btn-add btn btn-outline-warning">
															Back
														</a>
													</div>
												</div>
											</div>
											<!-- <div class="card-body"></div> -->
										</div>
									</div>
									<div class="col-md-12 select-wrapper">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>code</label>
															<input type="text" maxlength="3" required name="code" id="code" class="form-control" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Name</label>
															<input type="text" required name="airports" id="airports" class="form-control" />
														</div>
													</div>
													<div class="col-md-6 selects-contant">
														<div class="form-group">
															<label>Country</label>
															<select data-country="country-code" class="select-country-air js-basic-single form-control" name="countryname" id="country">
																<option value="" selected disabled>- None -</option>
																<option value="awd">- None -</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Country code</label>
															<input style="background: transparent;" type="text" readonly maxlength="3" required name="countrycode" id="country-code" class="form-control" />
														</div>
													</div>
													<div class="col-md-6 selects-contant">
														<div class="form-group">
															<label>City <span id="loading" style="color: red;display: none">Please wait ...</span></label>
															<select class="select-city js-basic-single form-control" name="cityname" id="city-">
																<option value="" selected disabled>- Selected Country -</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>City code </label>
															<input style="background: transparent;" type="text" readonly maxlength="3" required name="citycode" id="city-code" class="form-control" />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label>TimeZone</label>
															<input type="number" maxlength="3" required name="timezone" id="timezone" class="form-control" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label>Latitude </label>
															<input type="text" required name="lat" id="lat" class="form-control" />
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<label>Longitude </label>
															<input type="text" required name="lon" id="lon" class="form-control" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php
	$this->load->view('__libs/footer');
	?>
