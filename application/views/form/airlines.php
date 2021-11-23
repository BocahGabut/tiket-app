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
									<form action="post?action=airlines&update=true&id=<?= $_GET['edit'] ?>" method="POST" enctype="multipart/form-data" class="col-md-12">
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
										<div class="col-md-3">
											<div class="card">
												<div class="card-body d-flex justify-content-center flex-column">
													<img src="<?= base_url() . 'assets/image/' . $ds->thumb ?>" id="edit" alt="no image" style="max-width: 250px;" class="image-thumb" data-prev="true">
													<button type="button" data-thumb="edit" data-file="edit-file" id="remove-thumb" class="remove-thumbnail btn btn-danger mt-3">Remove Image</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 select-wrapper">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Name</label>
																<input type="text" required name="name" value="<?= $ds->airlines ?>" id="name" class="form-control" />
																<input type="text" name="old_image" hidden required readonly value="<?= $ds->thumb ?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>3-Digit-Code</label>
																<input type="text" maxlength="3" value="<?= $ds->digit_code ?>" required name="codes" id="codes" class="form-control" />
															</div>
														</div>
														<div class="col-md-6 selects-contant">
															<div class="form-group">
																<label>Country</label>
																<select class="select-country js-basic-single form-control" name="country" id="country">
																	<option value="<?= $ds->digit_code ?>" selected><?= $ds->country . ' [selected]' ?></option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>Thumbnail</label>
																<input id="edit-file" data-thumb="edit" data-remove="remove-thumb" type="file" accept="image/png, image/jpeg" name="thumb" id="edit" class="thumbnail form-control" />
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
								<form action="post?action=airlines&save=true" method="POST" enctype="multipart/form-data" class="col-md-12">
									<div class="col-md-12 mb-3">
										<div class="card">
											<div class="card-header">
												<div class="d-block d-lg-flex flex-nowrap align-items-center">
													<div class="page-title mr-4">
														<input type="submit" class="btn-add btn btn-outline-success" name="save_back" value="Save & Back" />
														<input type="submit" class="btn-add btn btn-outline-info ml-2 mr-2" name="save_new" value="Save & New" />
														<a href="airlines" class="btn-add btn btn-outline-warning">
															Back
														</a>
													</div>
												</div>
											</div>
											<!-- <div class="card-body"></div> -->
										</div>
									</div>
									<div class="col-md-3">
										<div class="card">
											<div class="card-body d-flex justify-content-center flex-column">
												<img id="thumbnail" alt="no image" style="max-width: 250px;" class="image-thumb">
												<button style="display: none;" type="button" data-thumb="thumbnail" data-file="thumbnail-file" id="remove-thumb" class="remove-thumbnail btn btn-danger mt-3">Remove Image</button>
											</div>
										</div>
									</div>
									<div class="col-md-12 select-wrapper">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Name</label>
															<input type="text" required name="name" id="name" class="form-control" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>3-Digit-Code</label>
															<input type="text" maxlength="3" required name="codes" id="codes" class="form-control" />
														</div>
													</div>
													<div class="col-md-6 selects-contant">
														<div class="form-group">
															<label>Country</label>
															<select class="select-country js-basic-single form-control" name="country" id="country">
																<option value="" selected disabled>- None -</option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Thumbnail</label>
															<input id="thumbnail-file" data-thumb="thumbnail" data-remove="remove-thumb" type="file" required accept="image/png, image/jpeg" name="thumbnail" id="thumbnail" class="thumbnail form-control" />
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
