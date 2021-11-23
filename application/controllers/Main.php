<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
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
		if (isset($_GET['action'])) {
			switch ($_GET['action']) {
				case 'airlines':
					if (isset($_GET['edit'])) {

						$where = array(
							'id_airlines' => $_GET['edit']
						);
						$get_data = $this->model->show_data('airlines', $where);

						if ($get_data->num_rows() > 0) {
							$data = array(
								'title' => 'Airlines Management',
								'data' => $get_data
							);
							$this->load->view('form/airlines', $data);
						}
					} else {
						$data = array(
							'title' => 'Airlines Management',
						);
						$this->load->view('form/airlines', $data);
					}
					break;
				case 'airports':
					if (isset($_GET['edit'])) {
						$where = array(
							'id_airports' => $_GET['edit']
						);
						$get_air =  $this->model->show_data('airports', $where);

						if ($get_air->num_rows() > 0) {
							$data = array(
								'title' => 'Airports Management',
								'data' => $get_air,
							);
							$this->load->view('form/airports', $data);
						}
					} else {
						$data = array(
							'title' => 'Airports Management',
						);
						$this->load->view('form/airports', $data);
					}
					break;
				case 'routes':
					if (isset($_GET['edit'])) {

						$where = array(
							'id_routes' => $_GET['edit']
						);
						$get_rout =  $this->model->show_data('main_routes', $where);

						if ($get_rout->num_rows() > 0) {
							$data = array(
								'title' => 'Routes Management',
								'data' => $this->get_routes($_GET['edit']),
								'airlines' => $this->model->show_data('airlines', null, 'airlines', 'ASC'),
								'airports' => $this->model->show_data('airports', null, 'airports', 'ASC')
							);
							$this->load->view('form/routes', $data);
						}
					} else {
						$data = array(
							'title' => 'Routes Management',
							'airlines' => $this->model->show_data('airlines', null, 'airlines', 'ASC'),
							'airports' => $this->model->show_data('airports', null, 'airports', 'ASC')
						);
						$this->load->view('form/routes', $data);
					}
					break;
				case 'price':

					$where = array(
						'flight' => $_GET['data']
					);

					$data = array(
						'title' => 'Flight Price',
						'data' => $this->model->show_data('price', $where)
					);
					$this->load->view('menu/price', $data);
					break;
			}
		} else {
			switch ($this->uri->segment(1)) {
				case 'dashboard':
					$data = array(
						'title' => 'Dashboard'
					);
					$this->load->view('index', $data);
					break;
				case 'routes':
					$data = array(
						'title' => 'Routes Management',
						'data' => $this->get_routes()
					);
					$this->load->view('menu/routes', $data);
					break;
				case 'airlines':
					// if (isset($_GET['data'])) {
					// 	if ($_GET['data'] === 'true') {
					// 		$this->load_airlines();
					// 	}
					// } else {
					// 	$data = array(
					// 		'title' => 'Airlines Management',
					// 		'data' => $this->model->show_data('airlines')
					// 	);
					// 	$this->load->view('menu/airlines', $data);
					// }
					$data = array(
						'title' => 'Airlines Management',
						'data' => $this->model->show_data('airlines')
					);
					$this->load->view('menu/airlines', $data);
					break;
				case 'airports':
					$data = array(
						'title' => 'Airports Management',
						'data' => $this->model->show_data('airports')
					);
					$this->load->view('menu/airports', $data);
					break;
				case 'print':
					$data = array(
						'data' => $this->model->show_data($_GET['data'])
					);
					$this->load->view('print', $data);
					break;
				default:
					$data = array(
						'title' => 'Dashboard'
					);
					$this->load->view('index', $data);
			}
		}
	}

	function get_routes($id = null)
	{

		$where = array(
			'id_routes' => $id
		);

		if ($id) {
			$get_main = $this->model->show_data('main_routes', $where);
		} else {
			$get_main = $this->model->show_data('main_routes');
		}

		if ($get_main->num_rows() > 0) {

			foreach ($get_main->result() as $gm) {
				$where = array(
					'main_routes' => $gm->id_routes
				);
				// $get_routes = $this->model->show_data('flight_routes', $where, 'flight_time', 'ASC');
				$get_routes = $this->db->query('SELECT * FROM flight_routes INNER JOIN airports ON airports.id_airports = flight_routes.airport_flight INNER JOIN airlines ON airlines.id_airlines = flight_routes.airlines_plane WHERE flight_routes.main_routes = "' . $gm->id_routes . '" ORDER BY flight_routes.flight_time');

				$flight_no = array();
				$from = '';
				$to = '';
				$airline = '';
				$time_dep = '';
				$time_arr = '';
				$dep = array();
				$get_trans = null;
				$arrival = array();
				foreach ($get_routes->result() as $gr) {
					$flight_no[] = $gr->flight_no;
					if ($gr->type === 'Departure') {
						$where_airport = array(
							'id_airports' => $gr->airport_flight
						);

						$airports = $this->model->show_data('airports', $where_airport);

						$dep = array(
							'id_flight' => $gr->id_flight,
							'main_routes' => $gr->main_routes,
							'type' => $gr->type,
							'airport' => $gr->airport_flight,
							'airlines_plane' => $gr->airlines_plane,
							'airlines_name' => $gr->airlines,
							'airport_name' => $gr->airports,
							'id_airports' => $gr->id_airports,
							'id_airlines' => $gr->id_airlines,
							'city_name' => $gr->cityname,
							'flight_no' => $gr->flight_no,
							'flight_time' => $gr->flight_time,
						);

						foreach ($airports->result() as $air) {
							$from = $air->countryname;
						}

						$where_airlines = array(
							'id_airlines' => $gr->airlines_plane
						);

						$get_airlines = $this->model->show_data('airlines', $where_airlines);

						foreach ($get_airlines->result() as $ail) {
							$airline = $ail->airlines;
						}
						$time_dep = $gr->flight_time;
					} else if ($gr->type === 'Arrival') {
						$where_air = array(
							'id_airlines' => $gr->airlines_plane
						);

						$airlines = $this->model->show_data('airlines', $where_air);
						$arrival = array(
							'id_flight' => $gr->id_flight,
							'main_routes' => $gr->main_routes,
							'type' => $gr->type,
							'airport' => $gr->airport_flight,
							'airlines_plane' => $gr->airlines_plane,
							'airlines_name' => $gr->airlines,
							'airport_name' => $gr->airports,
							'id_airports' => $gr->id_airports,
							'id_airlines' => $gr->id_airlines,
							'city_name' => $gr->cityname,
							'flight_no' => $gr->flight_no,
							'flight_time' => $gr->flight_time,
						);
						foreach ($airlines->result() as $air) {
							$to = $air->country;
						}
						$time_arr = $gr->flight_time;
					} else if ($gr->type === 'Transit') {
						// $where_trans = array(
						// 	'main_routes' => $gm->id_routes,
						// 	'type' => 'Transit'
						// );

						// $get_trans = $this->model->show_data('flight_routes', $where_trans);
						$get_trans = $this->db->query('SELECT * FROM flight_routes INNER JOIN airports ON airports.id_airports = flight_routes.airport_flight INNER JOIN airlines ON airlines.id_airlines = flight_routes.airlines_plane WHERE flight_routes.main_routes = "' . $gm->id_routes . '" AND flight_routes.type = "Transit"');

						// foreach ($get_trans->result() as $gts) {
						// 	if ($gts->type === 'Transit') {
						// 		$tran = array(
						// 			'id_flight' => $gts->id_flight,
						// 			'main_routes' => $gts->main_routes,
						// 			'type' => $gts->type,
						// 			'airport' => $gts->airport,
						// 			'airlines_plane' => $gts->airlines_plane,
						// 			'flight_no' => $gts->flight_no,
						// 			'flight_time' => $gts->flight_time,
						// 		);
						// 	}
						// 	// $transit = array(
						// 	// 	$tran
						// 	// );
						// 	$transit[] = $tran;
						// }

						// $tran = array(
						// 	$get_trans->result_array()
						// );
					}
				}

				$data['id_routes'] = $gm->id_routes;
				$data['status'] = $gm->status;
				$data['total_hour'] = $gm->total_hour;
				$data['class'] = $gm->class;
				$data['bagage'] = $gm->bagage;
				$data['vat_tax'] = $gm->vat_tax;
				$data['refundable'] = $gm->refundable;
				$data['description'] = $gm->description;
				$data['flight_no'] = $flight_no;
				$data['from'] = $from;
				$data['to'] = $to;
				$data['airlines'] = $airline;
				$data['time_dep'] = $time_dep;
				$data['time_arr'] = $time_arr;

				// $data['routes'] = $get_routes->result_array();
				$data['departure'] = $dep;
				$data['arrival'] = $arrival;

				if ($get_trans) {
					$data['transit'] = $get_trans->result_array();
				} else {
					$data['transit'] = array();
				}

				$arr[] = $data;
			}
		} else {
			$arr = array();
		}

		return $arr;
		// var_dump($arr);
	}

	function load_airlines()
	{
		$resultSet = array();
		$getData = $this->model->show_data('airlines');

		foreach ($getData->result() as $has) {
			$resultSet = array(
				'checkbox' => '<input type="checkbox" class="input-check" name="airlines_check[]" value="' . $has->id_airlines . '" />',
				'thumb' => '<img style="width: 35px;" src="' . base_url() . '"assets/image/"' . $has->thumb . '" alt="thumbnail" />',
				'airlines' => $has->airlines,
				'digit_code' => $has->digit_code,
				'country' => $has->country,
				'button' => '<button data-type="POST" data-modal="preview" data-id="' . $has->id_airlines . '" data-url="post?action=airlines&preview=true" class="button-preview btn btn-icon btn-info btn-sm">
					<i class="fa fa-search"></i>
				</button>
				<a href="" class="btn btn-icon btn-warning btn-sm">
					<i class="fa fa-edit"></i>
				</a>
				<button data-target="airlines" data-id="' . $has->id_airlines . '" data-url="post?action=airlines&delete=true" class="button-delete btn btn-icon btn-danger btn-sm">
					<i class="fa fa-trash"></i>
				</button>'
			);
			$data[] = $resultSet;
		}
		$final['data'] = $data;

		echo json_encode($final);
	}
}
