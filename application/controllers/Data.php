<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	public function __construct() {
        parent::__construct();

    }

	public function get_urusan_pemerintah(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_urusan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_urusan", $q);
			$this->db->or_like("no_rekening_urusan", $q);
			$this->db->group_end();
		}
		$this->db->where('is_active','1');
		$this->db->select("idurusan_pemerintah as id, concat(no_rekening_urusan, ' - ', nama_urusan, ' (Tahun Anggaran ', tahun_anggaran_urusan, ')') as text");
		$this->db->where('status', '1');

		$data = $this->db->get("urusan_pemerintah", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_urusan", $q);
			$this->db->or_like("no_rekening_urusan", $q);
			$this->db->group_end();
		}
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("urusan_pemerintah");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_bidang_urusan(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_bidang_urusan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_bidang_urusan", $q);
			$this->db->or_like("no_rekening_bidang_urusan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idbidang_urusan as id, concat(no_rekening_bidang_urusan, ' - ', nama_bidang_urusan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("bidang_urusan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_bidang_urusan", $q);
			$this->db->or_like("no_rekening_bidang_urusan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("bidang_urusan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_bidang_urusan_parent(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		$parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_bidang_urusan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_bidang_urusan", $q);
			$this->db->or_like("no_rekening_bidang_urusan", $q);
			$this->db->group_end();
		}
		$this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idbidang_urusan as id, concat(no_rekening_bidang_urusan, ' - ', nama_bidang_urusan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("bidang_urusan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_bidang_urusan", $q);
			$this->db->or_like("no_rekening_bidang_urusan", $q);
			$this->db->group_end();
		}
		$this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("bidang_urusan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_program(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_program");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_program", $q);
			$this->db->or_like("no_rekening_program", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idprogram as id, concat(no_rekening_program, ' - ', nama_program) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("program", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_program", $q);
			$this->db->or_like("no_rekening_program", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("program");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_program_parent(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		$parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_program");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_program", $q);
			$this->db->or_like("no_rekening_program", $q);
			$this->db->group_end();
		}
		$this->db->where('idbidang_urusan', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idprogram as id, concat(no_rekening_program, ' - ', nama_program) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("program", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_program", $q);
			$this->db->or_like("no_rekening_program", $q);
			$this->db->group_end();
		}
		$this->db->where('idbidang_urusan', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("program");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_kegiatan(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_kegiatan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_kegiatan", $q);
			$this->db->or_like("no_rekening_kegiatan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idkegiatan as id, concat(no_rekening_kegiatan, ' - ', nama_kegiatan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("kegiatan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_kegiatan", $q);
			$this->db->or_like("no_rekening_kegiatan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("kegiatan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_kegiatan_parent(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		$parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_kegiatan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_kegiatan", $q);
			$this->db->or_like("no_rekening_kegiatan", $q);
			$this->db->group_end();
		}
		$this->db->where('idprogram', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idkegiatan as id, concat(no_rekening_kegiatan, ' - ', nama_kegiatan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("kegiatan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_kegiatan", $q);
			$this->db->or_like("no_rekening_kegiatan", $q);
			$this->db->group_end();
		}
		$this->db->where('idprogram', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("kegiatan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_sub_kegiatan(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_subkegiatan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_subkegiatan", $q);
			$this->db->or_like("no_rekening_subkegiatan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idsub_kegiatan id, concat(no_rekening_subkegiatan, ' - ', nama_subkegiatan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("sub_kegiatan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_subkegiatan", $q);
			$this->db->or_like("no_rekening_subkegiatan", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("sub_kegiatan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_sub_kegiatan_parent(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		$parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_subkegiatan");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_subkegiatan", $q);
			$this->db->or_like("no_rekening_subkegiatan", $q);
			$this->db->group_end();
		}
		$this->db->where('idkegiatan', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idsub_kegiatan id, concat(no_rekening_subkegiatan, ' - ', nama_subkegiatan) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("sub_kegiatan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_subkegiatan", $q);
			$this->db->or_like("no_rekening_subkegiatan", $q);
			$this->db->group_end();
		}
		$this->db->where('idkegiatan', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("sub_kegiatan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_akun_belanja(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_akun_belanja");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_akun_belanja", $q);
			$this->db->or_like("no_rekening_akunbelanja", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idakun_belanja id, concat(no_rekening_akunbelanja, ' - ', nama_akun_belanja) as text");
		$this->db->where('status', '1');

		$data = $this->db->get("akun_belanja", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_akun_belanja", $q);
			$this->db->or_like("no_rekening_akunbelanja", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("akun_belanja");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_kategori(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_kategori");
		if (strlen($q) > 0) {
			$this->db->like("nama_kategori", $q);
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idkategori id, nama_kategori as text");
		$this->db->where('status', '1');

		$data = $this->db->get("kategori", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->like("nama_kategori", $q);
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("kategori");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_subkategori(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_sub_kategori");
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_sub_kategori", $q);
			$this->db->or_like("kode_rekening", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('sub_kategori.is_active','1');
		$this->db->select("sub_kategori.idsub_kategori id, 
		CONCAT(
        	sub_kategori.nama_sub_kategori, ' (',
        	IFNULL(SUBSTRING_INDEX(kode_rekening.kode_rekening, '-', 1), ''), ')'
    	) AS text");
		$this->db->where('sub_kategori.status', '1');
		$this->db->join('kode_rekening', 'kode_rekening.idkode_rekening = sub_kategori.idkode_rekening', 'left');

		$data = $this->db->get("sub_kategori", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->group_start();
			$this->db->like("nama_sub_kategori", $q);
			$this->db->or_like("kode_rekening", $q);
			$this->db->group_end();
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('sub_kategori.is_active','1');
		$this->db->where('sub_kategori.status', '1');
		$this->db->join('kode_rekening', 'kode_rekening.idkode_rekening = sub_kategori.idkode_rekening', 'left');
		$cdata = $this->db->get("sub_kategori");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_satuan(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");
		// $parent = $this->input->get("parent");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_satuan");
		if (strlen($q) > 0) {
			$this->db->like("nama_satuan", $q);
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->select("idsatuan id, nama_satuan as text");
		$this->db->where('status', '1');

		$data = $this->db->get("satuan", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->like("nama_satuan", $q);
		}
		// $this->db->where('idurusan_pemerintah', $parent);
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("satuan");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_room(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;
		
		$this->db->order_by("nama_ruang");
		if (strlen($q) > 0) {
			$this->db->like("nama_ruang", $q);
		}
		$this->db->where('is_active','1');
		$this->db->select("idruang as id, nama_ruang as text");
		$this->db->where('status', '1');

		$data = $this->db->get("ruang", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->like("nama_ruang", $q);
		}
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("ruang");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_sumber_dana(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("nama_sumber_dana");
		if (strlen($q) > 0) {
			$this->db->like("nama_sumber_dana", $q);
		}
		$this->db->where('is_active','1');
		$this->db->select("idsumber_dana as id, nama_sumber_dana as text");
		$this->db->where('status', '1');

		$data = $this->db->get("sumber_dana", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->like("nama_sumber_dana", $q);
		}
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("sumber_dana");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}

	public function get_kode_rekening(){
		$limit = 20;
		$q = $this->input->get("term");
		$page = $this->input->get("page");

		$offset = ($page - 1) * $limit;
		
		// var_dump($parent);die();
		$this->db->order_by("kode_rekening");
		if (strlen($q) > 0) {
			$this->db->like("kode_rekening", $q);
		}
		$this->db->where('is_active','1');
		$this->db->select("idkode_rekening as id, kode_rekening as text");
		$this->db->where('status', '1');

		$data = $this->db->get("kode_rekening", $limit, $offset);
		
		if (strlen($q) > 0) {
			$this->db->like("kode_rekening", $q);
		}
		$this->db->where('is_active','1');
		$this->db->where('status', '1');
		$cdata = $this->db->get("kode_rekening");
		$count = $cdata->num_rows();

		$endCount = $offset + $limit;
		$morePages = $endCount < $count;

		$results = array(
		  "results" => $data->result_array(),
		  "pagination" => array(
		  	"more" => $morePages
		  )
		);
		echo json_encode($results);
	}
}	
