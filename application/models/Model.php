<?php

class Model extends CI_Model
{

	public function Id()
	{
		return md5(base_convert(microtime(false), 18, 36));
	}

	public function show_data($table, $where = null, $field = null, $order = null, $limit = null)
	{
		if ($where) {

			$this->db->where($where);
		}

		if ($order) {
			$this->db->order_by($field, $order);
		}

		if ($limit) {
			$this->db->limit($limit);
		}

		return $this->db->get($table);
	}

	public function detail_field($field, $data, $table)
	{
		$where = array(
			$field => $data
		);
		$this->db->where($where);
		$this->db->limit(1);
		return $this->db->get($table);
	}

	public function delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function data_like($where, $table)
	{
		$this->db->like($where);
		return $this->db->get($table);
	}

	public function update($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function save($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function join($table, $field, $data, $where = null, $order = null, $by = null, $limit = null)
	{

		if ($where) {
			$this->db->where($where);
		}

		if ($order) {
			$this->db->order_by($order, $by);
		}

		if ($limit) {
			$this->db->limit($limit);
		}

		$this->db->join($field, $data);
		return $this->db->get($table);
	}

	public function double_join($table, $field, $field1, $data, $data1, $where = null, $order = null, $limit = null)
	{

		if ($where) {
			$this->db->where($where);
		}

		if ($order) {
			$this->db->order_by($order);
		}

		if ($limit) {
			$this->db->limit($limit);
		}

		$this->db->join($field, $data);
		$this->db->join($field1, $data1);
		return $this->db->get($table);
	}

	public function count_data($table, $where)
	{
		$this->db->count_all();
		$this->db->where($where);
		return $this->db->get($table);
	}

	public function distinct($table, $select, $where = null, $field = null, $order = null, $limit = null)
	{
		if ($where) {

			$this->db->where($where);
		}

		if ($order) {
			$this->db->order_by($field, $order);
		}

		if ($limit) {
			$this->db->limit($limit);
		}
		$this->db->select($select);
		$this->db->distinct();
		return $this->db->get($table);
	}

	function generatePasswd($numAlpha = 6, $numNonAlpha = 2)
	{
		$listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$listNonAlpha = ';:!?$/*-+&@_+;/*&?$-!,';
		return str_shuffle(
			substr(str_shuffle($listAlpha), 0, $numAlpha) .
				substr(str_shuffle($listNonAlpha), 0, $numNonAlpha)
		);
	}

	public function history($history)
	{
		date_default_timezone_set("Asia/Bangkok");
		$skrng = strtotime("now");
		$id = base_convert(microtime(false), 18, 36);
		$data = array(
			'id_history' => $id,
			'history' => $history,
			'seller' => $this->session->userdata('id_user'),
			'date' => $skrng
		);
		$this->db->insert('history', $data);
	}

	function createFile($file, $txt, $folder)
	{
		$data = $txt;
		if (!is_dir('assets/image/' . $folder)) {
			mkdir('./assets/image/' . $folder, 0777, TRUE);
			if (!write_file('./assets/image/' . $folder . '/' . $file, $data)) {
				echo 'Unable to write the file';
			} else {
				echo 'File written!';
			}
		} else {
			if (!write_file('./assets/image/' . $folder . '/' . $file, $data)) {
				echo 'Unable to write the file';
			} else {
				echo 'File written!';
			}
		}
	}

	function upload_image($id, $file_name)
	{
		$config['upload_path']          = './assets/image/';
		$config['allowed_types']        = 'jpg|png|jpeg|mp4';
		$config['file_name']            = md5(md5(md5($id)));
		$config['overwrite']            = false;
		$config['max_size']             = 100024;

		$this->load->library('upload', $config);

		if (!is_dir('assets/image/')) {
			mkdir('./assets/image/', 0777, TRUE);
			if (!$this->upload->do_upload($file_name)) {
				return $this->upload->data("file_name");
			} else {
				return $this->upload->data("file_name");
			}
		} else {
			if (!$this->upload->do_upload($file_name)) {
				return $this->upload->data("file_name");
			} else {
				return $this->upload->data("file_name");
			}
		}
	}
}
