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
								foreach ($data as $ds) {
							?>
									<form action="post?action=routes&update=true&id=<?= $_GET['edit'] ?>" method="POST" class="col-md-12">
										<div class="row">
											<div class="col-md-12 mb-3">
												<div class="card">
													<div class="card-header">
														<div class="d-block d-lg-flex flex-nowrap align-items-center">
															<div class="page-title mr-4">
																<input type="submit" class="btn-add btn btn-outline-success mr-2" name="update" value="Update Data" />
																<a href="routes" class="btn-add btn btn-outline-warning">
																	Back
																</a>
															</div>
														</div>
													</div>
													<!-- <div class="card-body"></div> -->
												</div>
											</div>
											<div class="col-md-12 ">
												<div class="card">
													<div class="card-header">
														FLIGHTS MANAGEMENT
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-md-12 table-responsive select-wrapper">
																<table class="table table-bordered">
																	<thead class="thead-light">
																		<tr>
																			<th scope="col" width="10px">Type</th>
																			<th scope="col">CITY - AIRPORT</th>
																			<th scope="col">AIRLINE</th>
																			<th scope="col" width="10px">FLIGHT NO.</th>
																			<th scope="col" width="10px">FLIGHT TIME</th>
																		</tr>
																	</thead>
																	<tbody id="table-container">
																		<tr id="template-first">
																			<td><button class="btn btn-secondary" style="width: 100%;" disabled>Departure</button></td>
																			<td>
																				<div class="selects-contant routes">
																					<select data-country="country-code" class="js-single-selected form-control" required name="airport_departure" id="city-departure">
																						<option value="<?= $ds['departure']['id_airports'] ?>" selected><?= $ds['departure']['city_name'] . ' - ' . $ds['departure']['airport_name'] . ' [selected]' ?></option>
																						<?php
																						foreach ($airports->result() as $air) {
																						?>
																							<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
																						<?php
																						}
																						?>
																					</select>
																				</div>
																			</td>
																			<td>
																				<div class="selects-contant routes" style="margin-right: 0 !important;">
																					<select required data-country="country-code" class="js-single-selected form-control" name="airlines_departure" id="airlines-departure">
																						<option value="<?= $ds['departure']['id_airlines'] ?>" selected><?= $ds['departure']['airlines_name'] . ' [selected]' ?></option>
																						<?php
																						foreach ($airlines->result() as $aln) {
																						?>
																							<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
																						<?php
																						}
																						?>
																					</select>
																				</div>
																			</td>
																			<td>
																				<input type="number" maxlength="4" value="<?= $ds['departure']['flight_no'] ?>" name="no_departure" required class="form-control" />
																			</td>
																			<td>
																				<input type="time" required value="<?= $ds['departure']['flight_time'] ?>" name="hour_departure" id="time-departure" class="form-control" />
																			</td>
																		</tr>
																		<?php
																		for ($i = 0; $i < count($ds['transit']);) {
																		?>
																			<tr class="template-items" id="tr-<?= $i ?>">
																				<td>
																					<button class="btn btn-secondary" disabled>Transit</button>
																					<button data-id="tr-<?= $i ?>" id="btn-<?= $i ?>" type="button" class="button-remove-transit btn btn-outline-danger ml-1 btn-sm">X</button>
																				</td>
																				<td>
																					<div class="selects-contant routes">
																						<select required data-country="country-code" class="country-transit js-single-selected form-control" name="city_transit[]">
																							<option value="<?= $ds['transit'][$i]['id_airports'] ?>" selected><?= $ds['transit'][$i]['cityname'] . ' - ' . $ds['transit'][$i]['airports'] . ' [selected]' ?></option>
																							<?php
																							foreach ($airports->result() as $air) {
																							?>
																								<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</td>
																				<td>
																					<div class="selects-contant routes" style="margin-right: 0 !important;">
																						<select required data-country="country-code" class="plane-transit js-single-selected form-control" name="plane_transit[]">
																							<option value="<?= $ds['transit'][$i]['id_airlines'] ?>" selected><?= $ds['transit'][$i]['airlines'] . ' [selected]' ?></option>
																							<?php
																							foreach ($airlines->result() as $aln) {
																							?>
																								<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
																							<?php
																							}
																							?>
																						</select>
																					</div>
																				</td>
																				<td>
																					<input type="number" maxlength="4" value="<?= $ds['transit'][$i]['flight_no'] ?>" required name="no_transit[]" class="form-control" />
																				</td>
																				<td>
																					<input type="time" required value="<?= $ds['transit'][$i]['flight_time'] ?>" name="time_transit[]" class="form-control" />
																				</td>
																			</tr>
																		<?php
																			$i++;
																		}
																		?>
																		<tr>
																			<td><button class="btn btn-secondary" style="width: 100%;" disabled>Arrival</button></td>
																			<td>
																				<div class="selects-contant routes">
																					<select data-country="country-code" class="js-single-selected form-control" name="airport_arrival" id="country-arrival">
																						<option value="<?= $ds['arrival']['id_airports'] ?>" selected><?= $ds['arrival']['city_name'] . ' - ' . $ds['arrival']['airport_name'] . ' [selected]' ?></option>
																						<?php
																						foreach ($airports->result() as $air) {
																						?>
																							<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
																						<?php
																						}
																						?>
																					</select>
																				</div>
																			</td>
																			<td>
																				<div class="selects-contant routes" style="margin-right: 0 !important;">
																					<select data-country="country-code" class="js-single-selected form-control" name="airlines_arrival" id="airlines-arrival">
																						<option value="<?= $ds['arrival']['id_airlines'] ?>" selected><?= $ds['arrival']['airlines_name'] . ' [selected]' ?></option>
																						<?php
																						foreach ($airlines->result() as $aln) {
																						?>
																							<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
																						<?php
																						}
																						?>
																					</select>
																				</div>
																			</td>
																			<td>
																				<input type="number" value="<?= $ds['arrival']['flight_no'] ?>" maxlength="4" name="no_arrival" class="form-control" />
																			</td>
																			<td>
																				<input type="time" value="<?= $ds['arrival']['flight_time'] ?>" name="hour_arrival" id="time-arrival" class="form-control" />
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>

															<div class="col-md-4">
																<button type="button" class="button-add-transit btn btn-success">Add Transit</button>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-4 select-wrapper">
												<div class="card">
													<div class="card-header">
														MAIN SETTINGS
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-md-12 selects-contant">
																<div class="form-group">
																	<label>Status</label>
																	<select name="status" required id="status" class="js-basic-single form-control">
																		<option value="<?= $ds['status'] ?>"><?= $ds['status'] . ' [selected]' ?></option>
																		<option value="Enabled">Enabled</option>
																		<option value="Disabled">Disabled</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label>Bagage</label>
																	<div class="input-group">
																		<input required value="<?= $ds['bagage'] ?>" name="bagage" type="number" class="form-control">
																		<div class="input-group-append">
																			<span class="input-group-text">Kg</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label>Total hour </label>
																	<input type="number" value="<?= $ds['total_hour'] ?>" name="total_hour" id="t_hour" class="form-control">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label>Vat Tax</label>
																	<div class="input-group">
																		<input name="vat_tax" value="<?= $ds['vat_tax'] ?>" required type="text" class="form-control">
																		<div class="input-group-append">
																			<span class="input-group-text">%</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12 selects-contant">
																<div class="form-group">
																	<label>Class</label>
																	<select required class="js-basic-single form-control" name="class" id="class">
																		<option value="<?= $ds['class'] ?>"><?= $ds['class'] . ' [selected]' ?></option>
																		<option value="Economy">Economy</option>
																		<option value="Business">Business</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12 selects-contant">
																<div class="form-group">
																	<label>Refundable</label>
																	<select required class="js-basic-single form-control" name="refundable" id="refundable">
																		<option value="<?= $ds['refundable'] ?>"><?= $ds['refundable'] . ' [selected]' ?></option>
																		<option value="Refundable">Refundable</option>
																		<option value="Non Refundable">Non Refundable</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="card">
													<div class="card-header">
														DESCRIPTION AND BAGGAGE INFO
													</div>
													<div class="card-body">
														<div class="form-group">
															<textarea class="form-control" id="description" name="description">
																<?= $ds['description'] ?>
															</textarea>
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
								<form action="post?action=routes&save=true" method="POST" class="col-md-12">
									<div class="row">
										<div class="col-md-12 mb-3">
											<div class="card">
												<div class="card-header">
													<div class="d-block d-lg-flex flex-nowrap align-items-center">
														<div class="page-title mr-4">
															<input type="submit" class="btn-add btn btn-outline-success" name="save_back" value="Save & Back" />
															<input type="submit" class="btn-add btn btn-outline-info ml-2 mr-2" name="save_new" value="Save & New" />
															<a href="routes" class="btn-add btn btn-outline-warning">
																Back
															</a>
														</div>
													</div>
												</div>
												<!-- <div class="card-body"></div> -->
											</div>
										</div>
										<div class="col-md-12 ">
											<div class="card">
												<div class="card-header">
													FLIGHTS MANAGEMENT
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-md-12 table-responsive select-wrapper">
															<table class="table table-bordered">
																<thead class="thead-light">
																	<tr>
																		<th scope="col" width="10px">Type</th>
																		<th scope="col">CITY - AIRPORT</th>
																		<th scope="col">AIRLINE</th>
																		<th scope="col" width="10px">FLIGHT NO.</th>
																		<th scope="col" width="10px">FLIGHT TIME</th>
																	</tr>
																</thead>
																<tbody id="table-container">
																	<tr id="template-first">
																		<td><button class="btn btn-secondary" style="width: 100%;" disabled>Departure</button></td>
																		<td>
																			<div class="selects-contant routes">
																				<select data-country="country-code" class="js-single-selected form-control" required name="airport_departure" id="city-departure">
																					<option value="" selected disabled>- Enter City Or Airport -</option>
																					<?php
																					foreach ($airports->result() as $air) {
																					?>
																						<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</td>
																		<td>
																			<div class="selects-contant routes" style="margin-right: 0 !important;">
																				<select required data-country="country-code" class="js-single-selected form-control" name="airlines_departure" id="airlines-departure">
																					<option value="" selected disabled>- Enter Arline Name -</option>
																					<?php
																					foreach ($airlines->result() as $aln) {
																					?>
																						<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</td>
																		<td>
																			<input type="number" maxlength="4" name="no_departure" required class="form-control" />
																		</td>
																		<td>
																			<input type="time" required name="hour_departure" id="time-departure" class="form-control" />
																		</td>
																	</tr>
																	<tr>
																		<td><button class="btn btn-secondary" style="width: 100%;" disabled>Arrival</button></td>
																		<td>
																			<div class="selects-contant routes">
																				<select data-country="country-code" class="js-single-selected form-control" name="airport_arrival" id="country-arrival">
																					<option value="" selected disabled>- Enter City Or Airport -</option>
																					<?php
																					foreach ($airports->result() as $air) {
																					?>
																						<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</td>
																		<td>
																			<div class="selects-contant routes" style="margin-right: 0 !important;">
																				<select data-country="country-code" class="js-single-selected form-control" name="airlines_arrival" id="airlines-arrival">
																					<option value="" selected disabled>- Enter Arline Name -</option>
																					<?php
																					foreach ($airlines->result() as $aln) {
																					?>
																						<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</td>
																		<td>
																			<input type="number" maxlength="4" name="no_arrival" class="form-control" />
																		</td>
																		<td>
																			<input type="time" name="hour_arrival" id="time-arrival" class="form-control" />
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>

														<div class="col-md-4">
															<button type="button" class="button-add-transit btn btn-success">Add Transit</button>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4 select-wrapper">
											<div class="card">
												<div class="card-header">
													MAIN SETTINGS
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-md-12 selects-contant">
															<div class="form-group">
																<label>Status</label>
																<select name="status" required id="status" class="js-basic-single form-control">
																	<option value="Enabled">Enabled</option>
																	<option value="Disabled">Disabled</option>
																</select>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Bagage</label>
																<div class="input-group">
																	<input required name="bagage" type="number" class="form-control">
																	<div class="input-group-append">
																		<span class="input-group-text">Kg</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Total hour </label>
																<input type="number" name="total_hour" id="t_hour" class="form-control">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>Vat Tax</label>
																<div class="input-group">
																	<input name="vat_tax" required type="text" class="form-control">
																	<div class="input-group-append">
																		<span class="input-group-text">%</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-12 selects-contant">
															<div class="form-group">
																<label>Class</label>
																<select required class="js-basic-single form-control" name="class" id="class">
																	<option value="Economy">Economy</option>
																	<option value="Business">Business</option>
																</select>
															</div>
														</div>
														<div class="col-md-12 selects-contant">
															<div class="form-group">
																<label>Refundable</label>
																<select required class="js-basic-single form-control" name="refundable" id="refundable">
																	<option value="Refundable">Refundable</option>
																	<option value="Non Refundable">Non Refundable</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="card">
												<div class="card-header">
													DESCRIPTION AND BAGGAGE INFO
												</div>
												<div class="card-body">
													<div class="form-group">
														<textarea class="form-control" id="description" name="description"></textarea>
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

	<template>
		<tr class="template-items" id="">
			<td>
				<button class="btn btn-secondary" disabled>Transit</button>
				<button data-id="" id="" type="button" class="button-remove-transit btn btn-outline-danger ml-1 btn-sm">X</button>
			</td>
			<td>
				<div class="selects-contant routes">
					<select required data-country="country-code" class="country-transit js-single-selected form-control" name="city_transit[]">
						<option value="" selected disabled>- Enter City Or Airport -</option>
						<?php
						foreach ($airports->result() as $air) {
						?>
							<option value="<?= $air->id_airports ?>"><?= $air->cityname . ' - ' . $air->airports ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</td>
			<td>
				<div class="selects-contant routes" style="margin-right: 0 !important;">
					<select required data-country="country-code" class="plane-transit js-single-selected form-control" name="plane_transit[]">
						<option value="" selected disabled>- Enter Airlines Name -</option>
						<?php
						foreach ($airlines->result() as $aln) {
						?>
							<option value="<?= $aln->id_airlines ?>"><?= $aln->airlines ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</td>
			<td>
				<input type="number" maxlength="4" required name="no_transit[]" class="form-control" />
			</td>
			<td>
				<input type="time" required name="time_transit[]" class="form-control" />
			</td>
		</tr>
	</template>
	<?php
	$this->load->view('__libs/footer');
	?>
	<script>
		$(document).ready(function() {
			$('.js-single-selected').select2();
		});
	</script>
	<script src="https://cdn.tiny.cloud/1/3c9u2a5btj33eisnohk2ody6zfniaz88zih7gd8jkechddka/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: 'textarea#description',
			height: 474,
			theme: 'silver',
			plugins: 'searchreplace fullscreen preview table hr toc insertdatetime advlist lists wordcount imagetools textpattern noneditable quickbars emoticons',
			toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview ',
			toolbar_sticky: false,
			mobile: {
				theme: 'mobile',
				plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				toolbar_sticky: false,
			}
		});
	</script>
