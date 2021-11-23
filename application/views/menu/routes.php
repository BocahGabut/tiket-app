<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('__libs/header');
?>

<body data-name="routes">
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
								<div class="d-block d-lg-flex d-flex flex-nowrap align-items-center mb-30">
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
									<div class="card-header">
										<div class="d-block d-lg-flex flex-nowrap align-items-center">
											<div class="page-title mr-4">
												<button class="btn-add btn btn-outline-success">
													<i class="fa fa-plus mr-2"></i>
													Add
												</button>
											</div>
											<div class="ml-auto d-flex align-items-center secondary-menu text-center">
												<button data-url="print?data=airlines" data-valid="false" class="button-direct btn btn-outline-light">
													<i class="fa fa-print mr-2"></i>
													PRINT
												</button>
												<button data-name="airlines" class="button-csv ml-2 mr-2 btn btn-outline-light">
													<i class="fas fa-file-csv mr-2"></i>
													EXPORT TO CSV
												</button>
												<button data-name="airlines_check" data-url="post?action=airlines&multiple=true" class="button-del-selected btn btn-outline-danger">
													<i class="fa fa-trash mr-2"></i>
													Delete Selected
												</button>
											</div>
										</div>
									</div>
									<!-- <div class="card-body"></div> -->
								</div>
							</div>
							<div class="col-md-12">
								<div class="data-export dataTables_wrapper table table-hover table-responsive">
									<table data-url="airlines?data=true" data-id="table-airlines" id="data-table" class="display compact table ">
										<thead>
											<tr>
												<th width="10px"><input type="checkbox" class="checkbox-selected" name="" id=""></th>
												<th width="10px">#</th>
												<th width="10px">Flight status</th>
												<th width="10px">Flight No</th>
												<th width="10px">Class</th>
												<th width="10px">From</th>
												<th width="10px">To</th>
												<th width="10px">Airlines</th>
												<th width="10px">Total Hours</th>
												<th width="10px">Price</th>
												<th width="10px">Departure Time</th>
												<th width="10px">Arrival Time</th>
												<th width="10px"></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($data as $dt) {
											?>
												<tr>
													<td>
														<input type="checkbox" class="input-check" name="airlines_check[]" value="<?= $dt['id_routes'] ?>">
													</td>
													<td><?= $no ?></td>
													<td><?= $dt['status'] ?></td>
													<!-- <td>
														<?php
														foreach ($dt['flight_no'] as $fl) {
															echo $fl;
														}
														?>
													</td> -->
													<td>
														<?php
														$count = count($dt['flight_no']);
														if ($count > 0) {
															$flight = '[';
															for ($i = 0; $i < $count; $i++) {
																$flight .= '"' . $dt['flight_no'][$i] . '"';
																if ($i < $count - 1) {
																	$flight .= ',';
																}
															}
															$flight .= ']';
															echo $flight;
														}
														?>
													</td>
													<td><?= $dt['class'] ?></td>
													<td><?= $dt['from'] ?></td>
													<td><?= $dt['to'] ?></td>
													<td><?= $dt['airlines'] ?></td>
													<td><?= $dt['total_hour'] ?></td>
													<td>
														<a href="?action=price&data=<?= $dt['id_routes'] ?>" class="btn btn-outline-primary btn-sm">
															price
														</a>
													</td>
													<td><?= $dt['time_dep'] ?></td>
													<td><?= $dt['time_arr'] ?></td>
													<td>
														<a href="?action=routes&edit=<?= $dt['id_routes'] ?>" class="btn btn-icon btn-warning btn-sm">
															<i class="fa fa-edit"></i>
														</a>
														<button data-target="routes" data-id="<?= $dt['id_routes'] ?>" data-url="post?action=routes&delete=true" class="button-delete btn btn-icon btn-danger btn-sm">
															<i class="fa fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php
												$no++;
											};
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php
	$this->load->view('__libs/footer');
	?>
