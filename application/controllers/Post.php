<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('username') == "") {
		// 	redirect(base_url() . 'ad789');
		// }
		// $this->load->helper('text');
	}

	function index()
	{
		switch ($_GET['action']) {
			case 'airlines':
				$this->airlines();
				break;
			case 'airports':
				$this->airports();
				break;
			case 'routes':
				$this->routes();
				break;
			case 'price':
				$this->price();
				break;
		}
	}

	function price()
	{
		$id = $this->model->Id();
		if (isset($_GET['save'])) {
			$data = array(
				'id_price' => $id,
				'flight' => $_GET['id'],
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'adult' => $this->input->post('adult'),
				'children' => $this->input->post('children'),
				'infants' => $this->input->post('infants'),
			);

			$save = $this->model->save('price', $data);

			if (isset($_POST['save'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'routes?action=price&data=' . $_GET['id']);
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'routes?action=price&data=' . $_GET['id']);
				}
			}
		}
		if (isset($_GET['update'])) {
			for ($i = 0; $i < count($_POST['id_price']); $i++) {

				$where = array(
					'id_price' => $_POST['id_price'][$i],
				);

				$data = array(
					'flight' => $_GET['id'],
					'adult' => $_POST['adults'][$i],
					'children' => $_POST['children'][$i],
					'infants' => $_POST['infants'][$i],
				);

				$update = $this->model->update('price', $where, $data);
			}

			if (isset($_POST['update'])) {
				if (!$update) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Update</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'routes?action=price&data=' . $_GET['id']);
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'routes?action=price&data=' . $_GET['id']);
				}
			}
		}
		if (isset($_GET['delete'])) {
			if ($this->input->post('id') === null) {
				redirect(base_url() . 'access/forbidden');
			} else {
				$id = $this->input->post('id');
				$where = array(
					'id_price' => $id
				);

				$delete = $this->model->delete($where, 'price');
				if (!$delete) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
				}
			}
		}
	}

	function routes()
	{
		$id = $this->model->Id();
		if (isset($_GET['save'])) {
			$main = array(
				'id_routes' => $id,
				'status' => $this->input->post('status'),
				'bagage' => $this->input->post('bagage'),
				'total_hour' => $this->input->post('total_hour'),
				'vat_tax' => $this->input->post('vat_tax'),
				'class' => $this->input->post('class'),
				'refundable' => $this->input->post('refundable'),
				'description' => $this->input->post('description'),
			);

			$save = $this->model->save('main_routes', $main);
			$this->save_flight($id, 'Departure');
			$this->save_flight($id, 'Arrival');
			$count = count($_POST['city_transit']);
			if ($count > 0) {
				for ($i = 0; $i < $count; $i++) {
					$data = array(
						'id_flight' => md5($id . $i),
						'main_routes' => $id,
						'type' => 'Transit',
						'airport_flight' => $_POST['city_transit'][$i],
						'airlines_plane' =>  $_POST['plane_transit'][$i],
						'flight_no' =>  $_POST['no_transit'][$i],
						'flight_time' =>  $_POST['time_transit'][$i],
					);

					$this->model->save('flight_routes', $data);
				}
			}

			if (isset($_POST['save_back'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'routes');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'routes');
				}
			} else if (isset($_POST['save_new'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'routes?action=routes');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'routes?action=routes');
				}
			}
		}
		if (isset($_GET['delete'])) {
			if ($this->input->post('id') === null) {
				redirect(base_url() . 'access/forbidden');
			} else {
				$id = $this->input->post('id');
				$where = array(
					'id_routes' => $id
				);

				$delete = $this->model->delete($where, 'main_routes');
				if (!$delete) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
				}
			}
		}
		if (isset($_GET['update'])) {
			$where = array(
				'id_routes' => $_GET['id'],
			);
			$main = array(
				'status' => $this->input->post('status'),
				'bagage' => $this->input->post('bagage'),
				'total_hour' => $this->input->post('total_hour'),
				'vat_tax' => $this->input->post('vat_tax'),
				'class' => $this->input->post('class'),
				'refundable' => $this->input->post('refundable'),
				'description' => $this->input->post('description'),
			);

			$where_del = array(
				'main_routes' => $_GET['id'],
				'type' => 'Transit'
			);

			$this->model->delete($where_del, 'flight_routes');
			$update = $this->model->update('main_routes', $where, $main);

			$this->update_flight($_GET['id'], 'Departure');
			$this->update_flight($_GET['id'], 'Arrival');

			$count = count($_POST['city_transit']);
			if ($count > 0) {
				for ($i = 0; $i < $count; $i++) {
					$data = array(
						'id_flight' => md5($_GET['id'] . $i),
						'main_routes' => $_GET['id'],
						'type' => 'Transit',
						'airport_flight' => $_POST['city_transit'][$i],
						'airlines_plane' =>  $_POST['plane_transit'][$i],
						'flight_no' =>  $_POST['no_transit'][$i],
						'flight_time' =>  $_POST['time_transit'][$i],
					);

					$this->model->save('flight_routes', $data);
				}
			}

			if (isset($_POST['update'])) {
				if (!$update) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Update</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'routes');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'routes');
				}
			}
		}
	}

	function save_flight($id, $type)
	{
		$data = array(
			'id_flight' => md5(strtolower($type) . $id . $id),
			'main_routes' => $id,
			'type' => $type,
			'airport_flight' => $this->input->post('airport_' . strtolower($type)),
			'airlines_plane' => $this->input->post('airlines_' . strtolower($type)),
			'flight_no' => $this->input->post('no_' . strtolower($type)),
			'flight_time' => $this->input->post('hour_' . strtolower($type)),
		);

		$this->model->save('flight_routes', $data);
	}

	function update_flight($id, $type)
	{
		$where = array(
			'id_flight' => $id,
		);

		$data = array(
			'main_routes' => $id,
			'type' => $type,
			'airport_flight' => $this->input->post('airport_' . strtolower($type)),
			'airlines_plane' => $this->input->post('airlines_' . strtolower($type)),
			'flight_no' => $this->input->post('no_' . strtolower($type)),
			'flight_time' => $this->input->post('hour_' . strtolower($type)),
		);

		$this->model->update('flight_routes', $where, $data);
	}

	function airports()
	{
		$id = $this->model->Id();
		if (isset($_GET['save'])) {
			$data = array(
				'id_airports' => $id,
				'airports' => $this->input->post('airports'),
				'code' => $this->input->post('code'),
				'countryname' => $this->input->post('countryname'),
				'countrycode' => $this->input->post('countrycode'),
				'cityname' => $this->input->post('cityname'),
				'citycode' => $this->input->post('citycode'),
				'timezone' => $this->input->post('timezone'),
				'lat' => $this->input->post('lat'),
				'lon' => $this->input->post('lon'),
			);

			$save = $this->model->save('airports', $data);
			if (isset($_POST['save_back'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airports');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airports');
				}
			} else if (isset($_POST['save_new'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airports?action=airports');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airports?action=airports');
				}
			}
		}
		if (isset($_GET['preview'])) {
			$resultSet = array();
			$id = $this->input->post('id');

			$where = array(
				'id_airports' => $id
			);

			$hasil = $this->model->show_data('airports', $where);
			foreach ($hasil->result() as $has) {
				$resultSet['content'] = '
				<div class="row">
					<div class="col-md-12 mt-3">
						<div class="table-responsive">
							<table class="table table-striped mb-0">
								<tbody>
									<tr>
										<th scope="row" width="80px">Code</th>
										<td width="10px">:</td>
										<td><b>' . $has->code . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Name</th>
										<td width="10px">:</td>
										<td><b>' . $has->airports . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Citycode</th>
										<td width="10px">:</td>
										<td><b>' . $has->citycode . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Cityname</th>
										<td width="10px">:</td>
										<td><b>' . $has->cityname . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Countryname</th>
										<td width="10px">:</td>
										<td><b>' . $has->countryname . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Countrycode</th>
										<td width="10px">:</td>
										<td><b>' . $has->countrycode . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Timezone</th>
										<td width="10px">:</td>
										<td><b>' . $has->timezone . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Latitude</th>
										<td width="10px">:</td>
										<td><b>' . $has->lat . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Longitude</th>
										<td width="10px">:</td>
										<td><b>' . $has->lon . '</b></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>';
			}

			$data = array(
				$resultSet
			);

			echo json_encode($data);
		}
		if (isset($_GET['delete'])) {
			if ($this->input->post('id') === null) {
				redirect(base_url() . 'access/forbidden');
			} else {
				$id = $this->input->post('id');
				$where = array(
					'id_airports' => $id
				);

				$delete = $this->model->delete($where, 'airports');
				if (!$delete) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
				}
			}
		}
		if (isset($_GET['multiple'])) {
			$id = $this->input->post('id');
			$where = array(
				'id_airports' => $id
			);

			$delete = $this->model->delete($where, 'airports');
			if (!$delete) {
				$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
			}
		}
		if (isset($_GET['update'])) {
			if (isset($_POST['save'])) {

				$where = array(
					'id_airports' => $_GET['id']
				);

				$data = array(
					'airports' => $this->input->post('airports'),
					'code' => $this->input->post('code'),
					'countryname' => $this->input->post('countryname'),
					'countrycode' => $this->input->post('countrycode'),
					'cityname' => $this->input->post('cityname'),
					'citycode' => $this->input->post('citycode'),
					'timezone' => $this->input->post('timezone'),
					'lat' => $this->input->post('lat'),
					'lon' => $this->input->post('lon'),
				);

				$update = $this->model->update('airports', $where, $data);
				if (!$update) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Update</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airports');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airports');
				}
			}
		}
	}

	function airlines()
	{
		$id = $this->model->Id();
		if (isset($_GET['save'])) {
			$data = array(
				'id_airlines' => $id,
				'airlines' => $this->input->post('name'),
				'digit_code' => $this->input->post('codes'),
				'country' => $this->input->post('country'),
				'thumb' => $this->model->upload_image($id, 'thumbnail'),
			);

			$save = $this->model->save('airlines', $data);
			if (isset($_POST['save_back'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airlines');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airlines');
				}
			} else if (isset($_POST['save_new'])) {
				if (!$save) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Save</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airlines?action=airlines');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airlines?action=airlines');
				}
			}
		}
		if (isset($_GET['preview'])) {
			$resultSet = array();
			$id = $this->input->post('id');

			$where = array(
				'id_airlines' => $id
			);
			$hasil = $this->model->show_data('airlines', $where);
			foreach ($hasil->result() as $has) {
				$resultSet['content'] = '
				<div class="row">
					<div class="col-md-6 mb-3">
						<img style="height: 95px;" src="' . base_url('assets/image/') . $has->thumb . '" alt="product image">
					</div>
					<div class="col-md-12 mt-3">
						<div class="table-responsive">
							<table class="table table-striped mb-0">
								<tbody>
									<tr>
										<th scope="row" width="80px">Nama</th>
										<td width="10px">:</td>
										<td><b>' . $has->airlines . '</b></td>
									</tr>

									<tr>
										<th scope="row" width="80px">3 Digit Codes</th>
										<td width="10px">:</td>
										<td><b>' . $has->digit_code . '</b></td>
									</tr>
									<tr>
										<th scope="row" width="80px">Country</th>
										<td width="10px">:</td>
										<td><b>' . $has->country . '</b></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>';
			}

			$data = array(
				$resultSet
			);

			echo json_encode($data);
		}

		if (isset($_GET['delete'])) {
			if ($this->input->post('id') === null) {
				redirect(base_url() . 'access/forbidden');
			} else {
				$id = $this->input->post('id');
				$where = array(
					'id_airlines' => $id
				);

				$get_image = $this->model->show_data('airlines', $where);

				foreach ($get_image->result() as $gm) {
					unlink('./assets/image/' . $gm->thumb);
				}
				$message = array();
				$delete = $this->model->delete($where, 'airlines');
				if (!$delete) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
				}
			}
		}

		if (isset($_GET['multiple'])) {
			$id = $this->input->post('id');
			$where = array(
				'id_airlines' => $id
			);

			$get_image = $this->model->show_data('airlines', $where);

			foreach ($get_image->result() as $gm) {
				unlink('./assets/image/' . $gm->thumb);
			}

			$delete = $this->model->delete($where, 'airlines');
			if (!$delete) {
				$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>delete</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
			}
		}

		if (isset($_GET['update'])) {
			if (isset($_POST['save'])) {

				$where = array(
					'id_airlines' => $_GET['id']
				);

				$image = '';
				var_dump($this->input->post());
				var_dump($_FILES);
				if ($_FILES['thumb']['name'] === null) {
					$image = $this->input->post('old_image');
				} else {
					unlink('./assets/image/' . $this->input->post('old_image'));
					$image = $this->model->upload_image($_GET['id'], 'thumb');
				}

				$data = array(
					'airlines' => $this->input->post('name'),
					'digit_code' => $this->input->post('codes'),
					'country' => $this->input->post('country'),
					'thumb' => $image,
				);

				$update = $this->model->update('airlines', $where, $data);
				if (!$update) {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Update</strong> data success You should check in on some of those
						fields below.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="ti ti-close"></i>
						</button>
					</div>
				</div>');
					redirect(base_url() . 'airlines');
				} else {
					$this->session->set_flashdata('message', '<div class="col-12 mb-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Error </strong>something went wrong.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="ti ti-close"></i>
							</button>
						</div>
					</div>');
					redirect(base_url() . 'airlines');
				}
			}
		}
	}
}
