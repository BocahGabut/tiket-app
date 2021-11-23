<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('__libs/header');
?>

<body data-name="price">
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
							<div class="col-md-12 mb-30">
								<div class="card">
									<div class="card-body">
										<form action="post?action=price&save=true&id=<?= $_GET['data'] ?>" method="post">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>From Date</label>
																<input data-id="to-date" type="date" min="<?php date_default_timezone_set("Asia/Bangkok");
																											echo  date("Y-m-d") ?>" name="from_date" class="from-date form-control" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>To Date</label>
																<input id="to-date" min="<?php date_default_timezone_set("Asia/Bangkok");
																							echo  date("Y-m-d") ?>" type="date" name="to_date" class="to-date form-control" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Adults Price</label>
														<input type="number" placeholder="Rp" name="adult" class="form-control" />
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Children Price</label>
														<input type="number" placeholder="Rp" name="children" class="form-control" />
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Infants Price</label>
														<input type="number" placeholder="Rp" name="infants" class="form-control" />
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label></label>
														<input style="color: #fff;" type="submit" name="save" value="Add Data" class="form-control btn btn-info" />
													</div>
												</div>
											</div>
										</form>
										<form action="post?action=price&update=true&id=<?= $_GET['data'] ?>" method="post">
											<div class="row mt-30">
												<div class="col-md-12 table-responsive">
													<table class="table">
														<thead class="thead-light">
															<tr>
																<th scope="col">Date from To</t>
																<th scope="col">Adults</t>
																<th scope="col">Children</t>
																<th scope="col">Infants</t>
																<th scope="col" width="10px">
																</th>
															</tr>
														</thead>
														<tbody>
															<?php
															if ($data->num_rows() > 0) {
																foreach ($data->result() as $dt) {
															?>
																	<tr>
																		<td><?= ($dt->from_date === null & $dt->to_date === null || $dt->from_date === '' & $dt->to_date === '') ? '<center>-- - --</center>' : $dt->from_date . ' - ' . $dt->to_date ?></td>
																		<td>
																			<input type="text" readonly hidden name="id_price[]" value="<?= $dt->id_price ?>">
																			<input type="number" placeholder="Rp" name="adults[]" value="<?= $dt->adult ?>" class="form-control">
																		</td>
																		<td>
																			<input type="number" placeholder="Rp" name="children[]" value="<?= $dt->children ?>" class="form-control">
																		</td>
																		<td>
																			<input type="number" placeholder="Rp" name="infants[]" value="<?= $dt->infants ?>" class="form-control">
																		</td>
																		<td>
																			<button data-id="<?= $dt->id_price ?>" data-target="routes?action=price&data=<?= $_GET['data'] ?>" data-url="post?action=price&delete=true" class="ml-2 button-delete btn btn-icon btn-danger">
																				<i class="fa fa-trash"></i>
																			</button>
																		</td>
																	</tr>

																<?php
																}
															} else {
																?>
																<tr>
																	<td colspan="5">
																		<center>No data available in table</center>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
												</div>
												<?php
												if ($data->num_rows() > 0) {
												?>
													<input style="color: #fff;" type="submit" name="update" value="Update" class="col-md-2 ml-3 mt-30 btn btn-info" />
												<?php }
												?>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php
	$this->load->view('modal');
	$this->load->view('__libs/footer');
	?>
