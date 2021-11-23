<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('__libs/header');
?>

<body data-name="airports">
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
									<div class="card-header">
										<div class="d-block d-lg-flex flex-nowrap align-items-center">
											<div class="page-title mr-4">
												<button class="btn-add btn btn-outline-success">
													<i class="fa fa-plus mr-2"></i>
													Add
												</button>
											</div>
											<div class="ml-auto d-flex align-items-center secondary-menu text-center">
												<button data-url="print?data=airports" data-valid="false" class="button-direct btn btn-outline-light">
													<i class="fa fa-print mr-2"></i>
													PRINT
												</button>
												<button data-name="airports" class="button-csv ml-2 mr-2 btn btn-outline-light">
													<i class="fas fa-file-csv mr-2"></i>
													EXPORT TO CSV
												</button>
												<button data-name="airports_check" data-url="post?action=airports&multiple=true" class="button-del-selected btn btn-outline-danger">
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
												<th width="40px">Codes</th>
												<th>Name</th>
												<th>Country name</th>
												<th>City name</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($data->result() as $dt) {
											?>
												<tr>
													<td><input type="checkbox" class="input-check" name="airports_check[]" value="<?= $dt->id_airports ?>"></td>
													<td><?= $no ?></td>
													<td><?= $dt->code ?></td>
													<td><?= $dt->airports ?></td>
													<td><?= $dt->countryname ?></td>
													<td><?= $dt->cityname ?></td>
													<td>
														<button data-type="POST" data-modal="preview" data-id="<?= $dt->id_airports ?>" data-url="post?action=airports&preview=true" class="button-preview btn btn-icon btn-info btn-sm">
															<i class="fa fa-search"></i>
														</button>
														<a href="?action=airports&edit=<?= $dt->id_airports ?>" class="btn btn-icon btn-warning btn-sm">
															<i class="fa fa-edit"></i>
														</a>
														<button data-target="airports" data-id="<?= $dt->id_airports ?>" data-url="post?action=airports&delete=true" class="button-delete btn btn-icon btn-danger btn-sm">
															<i class="fa fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php
												$no++;
											}
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
	$this->load->view('modal');
	$this->load->view('__libs/footer');
	?>
