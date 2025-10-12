<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AZ_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('az_auth');
        az_check_auth('dashboard');
		$this->load->helper('az_crud');
		$this->load->helper('az_config');
		$this->load->helper('az_core');
    }

	public function index(){
		$this->load->library('AZApp');
		$app = $this->azapp;
		$data_header['title'] = azlang('Dashboard');
		$data_header['breadcrumb'] = array('dashboard');
		$app->set_data_header($data_header);

		$total_anggaran = 0;
		$total_realisasi = 0;
		$sudah_dibayar = 0;
		$belum_dibayar = 0;
		$belum_direalisasi = 0;
		$tahun_ini = date('Y');
		// $tahun_ini = "2024";


		// GRAFIK REALISASI ANGGARAN
		$grafik_realisasi_anggaran = $this->grafik_realisasi_anggaran($tahun_ini);
		$sudah_dibayar = $grafik_realisasi_anggaran['sudah_dibayar'];
		$belum_dibayar = $grafik_realisasi_anggaran['belum_dibayar'];
		$belum_direalisasi = $grafik_realisasi_anggaran['belum_direalisasi'];


		// GRAFIK POTENSI SISA ANGGARAN
		$grafik_potensi_sisa_anggaran = $this->grafik_potensi_sisa_anggaran($tahun_ini);
		$total_anggaran = $grafik_potensi_sisa_anggaran['total_anggaran_tahun_ini'];
		$realisasi_anggaran = $sudah_dibayar;


		// GRAFIK REALISASI ANGGARAN PER SUMBER DANA
		$grafik_sumber_dana = $this->grafik_sumber_dana($tahun_ini);
		$dbh = $grafik_sumber_dana['dbh'];
		$blud = $grafik_sumber_dana['blud'];


		// GRAFIK PERBANDINGAN TARGET & REALISASI PER BULAN
		$target_per_bulan = [];
		$realisasi_per_bulan = [];

		for ($bulan = 1; $bulan <= 12; $bulan++) {

		    // Target: total anggaran paket belanja yang aktif dan OK
			$this->db->where('YEAR(pb.created)', $tahun_ini);
			$this->db->where('pb.status_paket_belanja = "OK" ');
			$this->db->where('pb.is_active = 1');
			$this->db->where('pb.status = 1');
			$this->db->where('pbd.status = 1');
			$this->db->where('pbds.status = 1');
			$this->db->where('pbds.volume IS NOT NULL');
			$this->db->where('pbds.idsatuan IS NOT NULL');
			$this->db->where('pbds.harga_satuan IS NOT NULL');
			$this->db->where('pbds.jumlah IS NOT NULL');					
					
			$this->db->join('paket_belanja_detail pbd', 'pbd.idpaket_belanja = pb.idpaket_belanja');
			$this->db->join('akun_belanja', 'akun_belanja.idakun_belanja = pbd.idakun_belanja');
			$this->db->join('paket_belanja_detail_sub pbds', 
					'pbds.idpaket_belanja_detail = pbd.idpaket_belanja_detail 
				OR pbds.is_idpaket_belanja_detail_sub IN (
					SELECT sub.idpaket_belanja_detail_sub 
					FROM paket_belanja_detail_sub sub 
					WHERE sub.idpaket_belanja_detail = pbd.idpaket_belanja_detail
				)', 
				'left', false // false = tidak di-escape (untuk subquery)
			);

			if ($bulan == 1) {
				$this->db->select('sum(rak_jumlah_januari) as nilai_anggaran');	
			}
			else if ($bulan == 2) {
				$this->db->select('sum(rak_jumlah_februari) as nilai_anggaran');	
			}
			else if ($bulan == 3) {
				$this->db->select('sum(rak_jumlah_maret) as nilai_anggaran');	
			}
			else if ($bulan == 4) {
				$this->db->select('sum(rak_jumlah_april) as nilai_anggaran');	
			}
			else if ($bulan == 5) {
				$this->db->select('sum(rak_jumlah_mei) as nilai_anggaran');	
			}
			else if ($bulan == 6) {
				$this->db->select('sum(rak_jumlah_juni) as nilai_anggaran');	
			}
			else if ($bulan == 7) {
				$this->db->select('sum(rak_jumlah_juli) as nilai_anggaran');	
			}
			else if ($bulan == 8) {
				$this->db->select('sum(rak_jumlah_agustus) as nilai_anggaran');	
			}
			else if ($bulan == 9) {
				$this->db->select('sum(rak_jumlah_september) as nilai_anggaran');	
			}
			else if ($bulan == 10) {
				$this->db->select('sum(rak_jumlah_oktober) as nilai_anggaran');	
			}
			else if ($bulan == 11) {
				$this->db->select('sum(rak_jumlah_november) as nilai_anggaran');	
			}
			else if ($bulan == 12) {
				$this->db->select('sum(rak_jumlah_desember) as nilai_anggaran');	
			}
			$pb = $this->db->get('paket_belanja pb');
			$target = $pb->row()->nilai_anggaran;
			$target_per_bulan[] = floatval($target);
			// echo "<pre>"; print_r($this->db->last_query()); die;

			
		    // Realisasi: total realisasi transaksi pada bulan tsb
		    $this->db->where('status', 1);
		    $this->db->where('transaction_status !=', 'DRAFT');
		    $this->db->where('YEAR(transaction_date)', $tahun_ini);
		    $this->db->where('MONTH(transaction_date)', $bulan);
		    $this->db->select_sum('total_realisasi');
		    $trx = $this->db->get('transaction');
		    $realisasi = $trx->row()->total_realisasi;
			// echo "<pre>"; print_r($this->db->last_query()); die;
			
		    $realisasi_per_bulan[] = floatval($realisasi);
		}


		// TABLE PAKET BELANJA YANG BELUM TEREALISASI
		$crud_table = $app->add_crud();
		$crud_table->set_column(array('#', "Program", "Paket Belanja", "Nilai Anggaran"));
		$crud_table->set_th_class(array('', '', '', ''));
		$crud_table->set_id('idpaket_belanja');
		$crud_table->set_default_url(false);
		$crud_table->set_btn_add(false);

		$crud_table->set_url("app_url+'home/get_paket_belanja/".$tahun_ini."'");
		$crud_table->set_url_edit("app_url+'home/edit_paket_belanja'");
		$crud_table->set_url_delete("app_url+'home/delete_paket_belanja'");
		$crud_table->set_url_save("app_url+'home/save_paket_belanja'");
		// $crud_table->set_callback_table_complete('callback_check_request_table();');
		$belum_terealisasi = $crud_table->render();

		
		$data = array(
			'tahun_ini' => $tahun_ini,
			'total_anggaran_tahun_ini' => floatval($total_anggaran),
			'realisasi_anggaran_tahun_ini' => floatval($realisasi_anggaran),
			'sudah_dibayar' => floatval($sudah_dibayar),
			'belum_dibayar' => floatval($belum_dibayar),
			'belum_direalisasi' => floatval($belum_direalisasi),
			'dbh' => floatval($dbh),
			'blud' => floatval($blud),
			'target_per_bulan' => $target_per_bulan,
			'realisasi_per_bulan' => $realisasi_per_bulan,
			'belum_terealisasi' => $belum_terealisasi,
		);
		// echo "<pre>"; print_r($data); die;

		$view = $this->load->view('home/v_home', $data, true);
		$app->add_content($view);

		// $js = az_add_js('home/vjs_home');
		// $app->add_js($js);

		echo $app->render();	
	}

	function grafik_realisasi_anggaran($tahun_ini) {
		$sudah_dibayar = 0;
		$belum_dibayar = 0;
		$belum_direalisasi = 0;

		// sudah dibayar
		$this->db->where('npd.status', 1);
		$this->db->where('npd.npd_status = "SUDAH DIBAYAR BENDAHARA" ');
		$this->db->where('YEAR(npd.confirm_payment_date) = "'.$tahun_ini.'" ');
		$this->db->select('sum(total_pay) as total_yang_sudah_dibayar');
		$npd = $this->db->get('npd');
		// echo "<pre>"; print_r($this->db->last_query()); die;

		if ($npd->num_rows() > 0) {
			$sudah_dibayar = $npd->row()->total_yang_sudah_dibayar;
		}


		// belum dibayar
		$this->db->where('npd.status', 1);
		$this->db->where('npd.npd_status = "INPUT NPD" ');
		$this->db->where('YEAR(npd.npd_date_created) = "'.$tahun_ini.'" ');
		$this->db->select('sum(total_anggaran) as total_yang_belum_dibayar');
		$npd_before_pay = $this->db->get('npd');
		// echo "<pre>"; print_r($this->db->last_query()); die;

		if ($npd_before_pay->num_rows() > 0) {
			$belum_dibayar = $npd_before_pay->row()->total_yang_belum_dibayar;
		}


		// belum direalisasi
		// ambil data paket belanja yang sudah di realisasi
		$this->db->where('transaction.status', 1);
		$this->db->where('transaction.transaction_status != "DRAFT" ');
		$this->db->where('transaction_detail.status', 1);
		$this->db->where('YEAR(transaction.transaction_date) = "'.$tahun_ini.'" ');
		$this->db->join('transaction_detail', 'transaction_detail.idtransaction = transaction.idtransaction');
		$this->db->group_by('idpaket_belanja');
		$this->db->select('idpaket_belanja');
		$trx = $this->db->get('transaction');
		// echo "<pre>"; print_r($this->db->last_query()); die;

		$arr_idpaket_belanja = array();
		foreach ($trx->result() as $key => $value) {
			$arr_idpaket_belanja[] = $value->idpaket_belanja;
		}
		$data_idpaket_belanja = '"'.implode(' ", " ', $arr_idpaket_belanja).'"';

		// hitung total nilai anggaran di paket belanja
		$this->db->where('paket_belanja.status', 1);
		$this->db->where('paket_belanja.status_paket_belanja = "OK" ');
		$this->db->where('paket_belanja.is_active', 1);
		$this->db->where('YEAR(paket_belanja.created) = "'.$tahun_ini.'" ');
		$this->db->where('paket_belanja.idpaket_belanja NOT IN ('.$data_idpaket_belanja.') ');
		$this->db->where('paket_belanja.nilai_anggaran > 0');
		$this->db->select('sum(nilai_anggaran) as total_yang_belum_direalisasi');
		$paket_belanja = $this->db->get('paket_belanja');
		// echo "<pre>"; print_r($this->db->last_query()); die;

		if ($paket_belanja->num_rows() > 0) {
			$belum_direalisasi = $paket_belanja->row()->total_yang_belum_direalisasi;
		}

		$return = array(
			'sudah_dibayar' => floatval($sudah_dibayar),
			'belum_dibayar' => floatval($belum_dibayar),
			'belum_direalisasi' => floatval($belum_direalisasi),
		);

		return $return;
	}

	function grafik_potensi_sisa_anggaran($tahun_ini) {
		$total_anggaran = 0;

		// Hitung total anggaran pada tahun ini
		$this->db->join('sub_kegiatan', 'sub_kegiatan.idsub_kegiatan = paket_belanja.idsub_kegiatan');
		$this->db->join('kegiatan', 'kegiatan.idkegiatan = sub_kegiatan.idkegiatan');
        $this->db->join('program', 'program.idprogram = kegiatan.idprogram');
        $this->db->join('bidang_urusan', 'bidang_urusan.idbidang_urusan = program.idbidang_urusan');
        $this->db->join('urusan_pemerintah', 'urusan_pemerintah.idurusan_pemerintah = bidang_urusan.idurusan_pemerintah');
		$this->db->where('paket_belanja.status', 1);
		$this->db->where('paket_belanja.is_active', 1);
		$this->db->where('paket_belanja.status_paket_belanja = "OK" ');
		$this->db->where('urusan_pemerintah.tahun_anggaran_urusan = "'.$tahun_ini.'" ');
		$this->db->select_sum('paket_belanja.nilai_anggaran');
		$pb = $this->db->get('paket_belanja');
		// echo "<pre>"; print_r($this->db->last_query()); die;

		if ($pb->num_rows() > 0) {
			$total_anggaran = $pb->row()->nilai_anggaran;
		}

		$return = array(
			'total_anggaran_tahun_ini' => floatval($total_anggaran),
		);

		return $return;
	}

	function grafik_sumber_dana($tahun_ini) {
		$dbh = 0;
		$blud = 0;

		$this->db->where('npd.npd_status = "SUDAH DIBAYAR BENDAHARA" ');
		$this->db->where('npd.status = 1 ');
		$this->db->where('npd_detail.status = 1 ');
		$this->db->where('verification.status = 1 ');
		$this->db->where('verification.verification_status = "SUDAH DIBAYAR BENDAHARA" ');
		$this->db->where('verification.status_approve = "DISETUJUI" ');
		$this->db->where('verification_detail.status = 1 ');
		$this->db->where('transaction.status = 1 ');
		$this->db->where('transaction.transaction_status = "SUDAH DIBAYAR BENDAHARA" ');
		$this->db->where('transaction_detail.`status` = 1 ');
		$this->db->where('YEAR(transaction_detail.created) = "'.$tahun_ini.'" ');

		$this->db->join('npd_detail', 'npd_detail.idnpd = npd.idnpd');
		$this->db->join('verification', 'verification.idverification = npd_detail.idverification');
		$this->db->join('verification_detail', 'verification_detail.idverification = verification.idverification');
		$this->db->join('transaction', 'transaction.idtransaction = verification_detail.idtransaction');
		$this->db->join('transaction_detail', 'transaction_detail.idtransaction = transaction.idtransaction');
		$this->db->join('sub_kategori', 'sub_kategori.idsub_kategori = transaction_detail.iduraian');
		$this->db->join('sumber_dana', 'sumber_dana.idsumber_dana = sub_kategori.idsumber_dana');

		$this->db->group_by('nama_sumber_dana');
		$this->db->select('SUM(total) AS total_sumber_dana, nama_sumber_dana');
		$npd = $this->db->get('npd');
		// echo "<pre>"; print_r($this->db->last_query());die;

		foreach ($npd->result() as $key => $value) {
			$sumber_dana = $value->nama_sumber_dana;
			$total_sumber_dana = $value->total_sumber_dana;

			if ($sumber_dana == "DBH Cukai Hasil Tembakau (CHT)") {
				$dbh = $total_sumber_dana;
			}
			else if ($sumber_dana == "Pendapatan dari BLUD") {
				$blud = $total_sumber_dana;
			}
		}

		$return = array(
			'dbh' => floatval($dbh),
			'blud' => floatval($blud),
		);

		// echo "<pre>"; print_r($return);die;

		return $return;
	}

	function get_paket_belanja($tahun_ini) {

		$this->load->library('AZApp');
		$crud_table = $this->azapp->add_crud();

		// query utama
		$this->db->select('pb.idpaket_belanja, p.nama_program, pb.nama_paket_belanja, pb.nilai_anggaran');
		
		$this->db->join('sub_kegiatan sk', 'sk.idsub_kegiatan = pb.idsub_kegiatan');
		$this->db->join('kegiatan k', 'k.idkegiatan = sk.idkegiatan');
		$this->db->join('program p', 'p.idprogram = k.idprogram');
		$this->db->join('paket_belanja_detail pbd', 'pbd.idpaket_belanja = pb.idpaket_belanja');
		$this->db->join('paket_belanja_detail_sub pbds', 'pbds.idpaket_belanja_detail = pbd.idpaket_belanja_detail');

		$this->db->where('YEAR(pb.created) = "'.$tahun_ini.'" ');
		$this->db->where('pb.status_paket_belanja', 'OK');
		$this->db->where('pb.is_active', 1);
		$this->db->where('pb.status', 1);
		$this->db->where('pbd.status', 1);
		$this->db->where('pbds.status', 1);
		$this->db->where('pbds.volume IS NOT NULL', null, false);
		$this->db->where('pbds.idsatuan IS NOT NULL', null, false);
		$this->db->where('pbds.harga_satuan IS NOT NULL', null, false);
		$this->db->where('pbds.jumlah IS NOT NULL', null, false);

		$this->db->group_by([
			'pb.idpaket_belanja',
			'p.nama_program',
			'pb.nama_paket_belanja',
			'pb.nilai_anggaran'
		]);

		$this->db->get('paket_belanja pb');
		$last_query1 = $this->db->last_query();
		// echo "<pre>"; print_r($last_query1); die;

		// query turunan
		$this->db->select('pb.idpaket_belanja, p.nama_program, pb.nama_paket_belanja, pb.nilai_anggaran');
		
		$this->db->join('sub_kegiatan sk', 'sk.idsub_kegiatan = pb.idsub_kegiatan');
		$this->db->join('kegiatan k', 'k.idkegiatan = sk.idkegiatan');
		$this->db->join('program p', 'p.idprogram = k.idprogram');
		$this->db->join('paket_belanja_detail pbd', 'pbd.idpaket_belanja = pb.idpaket_belanja');
		$this->db->join('paket_belanja_detail_sub pbds_parent', 'pbds_parent.idpaket_belanja_detail = pbd.idpaket_belanja_detail');
		$this->db->join('paket_belanja_detail_sub pbds', 'pbds.is_idpaket_belanja_detail_sub = pbds_parent.idpaket_belanja_detail_sub');

		$this->db->where('YEAR(pb.created) = "'.$tahun_ini.'" ');
		$this->db->where('pb.status_paket_belanja', 'OK');
		$this->db->where('pb.is_active', 1);
		$this->db->where('pb.status', 1);
		$this->db->where('pbd.status', 1);
		$this->db->where('pbds.status', 1);
		$this->db->where('pbds.volume IS NOT NULL', null, false);
		$this->db->where('pbds.idsatuan IS NOT NULL', null, false);
		$this->db->where('pbds.harga_satuan IS NOT NULL', null, false);
		$this->db->where('pbds.jumlah IS NOT NULL', null, false);

		$this->db->group_by([
			'pb.idpaket_belanja',
			'p.nama_program',
			'pb.nama_paket_belanja',
			'pb.nilai_anggaran'
		]);

		$this->db->get('paket_belanja pb');
		$last_query2 = $this->db->last_query();
		// echo "<pre>"; print_r($last_query2); die;


		// query realisasi
		$this->db->where('transaction.status', 1);
		$this->db->where('transaction.transaction_status != "DRAFT" ');
		$this->db->where('transaction_detail.status', 1);
		$this->db->where('YEAR(transaction.transaction_date)', $tahun_ini);
		$this->db->join('transaction_detail', 'transaction_detail.idtransaction = transaction.idtransaction');
		$this->db->group_by('idpaket_belanja');
		$this->db->select('idpaket_belanja');
		$this->db->get('transaction');
		$last_query_where = $this->db->last_query();
		// echo "<pre>"; print_r($last_query_where); die;
		

		// $query = array_merge($last_query1, $last_query2);
		$query = 'select * from (' . $last_query1 . ' UNION ' . $last_query2 . ') new_query WHERE idpaket_belanja NOT IN (' . $last_query_where . ')';
		// echo "<pre>"; print_r($query); die;

		$crud_table->set_manual_query($query);

		$crud_table->set_select_table('idpaket_belanja, nama_program, nama_paket_belanja, nilai_anggaran');
		$crud_table->set_filter('nama_program, nama_paket_belanja, nilai_anggaran');
		$crud_table->set_sorting('nama_program, nama_paket_belanja, nilai_anggaran');
		$crud_table->set_select_align(' , , right');
		$crud_table->set_edit(false);
		$crud_table->set_delete(false);
		$crud_table->set_id('paket_belanja');
		// $crud_table->set_custom_first_column(true);
		
		$crud_table->set_order_by('idpaket_belanja, nama_program, nama_paket_belanja, nilai_anggaran');
		$crud_table->set_custom_style('custom_style');
		$crud_table->set_table('paket_belanja');
		echo $crud_table->get_table();

		// SELECT 
		// pb.idpaket_belanja,
		// p.nama_program,
		// pb.nama_paket_belanja,
		// pb.nilai_anggaran

		// FROM paket_belanja pb
		// JOIN sub_kegiatan sk ON sk.idsub_kegiatan = pb.idsub_kegiatan
		// JOIN kegiatan k ON k.idkegiatan = sk.idkegiatan
		// JOIN program p ON p.idprogram = k.idprogram
		// JOIN paket_belanja_detail pbd ON pb.idpaket_belanja = pbd.idpaket_belanja
		// JOIN paket_belanja_detail_sub pbds
		// ON (
		// 	-- Ambil yang langsung dari detail (bukan anak dari kategori)
		// 	pbds.idpaket_belanja_detail = pbd.idpaket_belanja_detail
		// 	OR pbds.is_idpaket_belanja_detail_sub IN (
		// 		-- Ambil anak-anak dari sub-detail lain yang berelasi dengan detail
		// 		SELECT sub.idpaket_belanja_detail_sub
		// 		FROM paket_belanja_detail_sub sub
		// 		WHERE sub.idpaket_belanja_detail = pbd.idpaket_belanja_detail
		// 	)
		// )

		// -- WHERE: Semua kondisi penyaringan
		// WHERE 
		// YEAR(pb.created) = 2025
		// AND pb.status_paket_belanja = 'OK'
		// AND pb.is_active = 1
		// AND pb.status = 1
		// AND pbd.status = 1
		// AND `pbds`.`status` = 1
		// AND pbds.volume IS NOT NULL
		// AND pbds.idsatuan IS NOT NULL
		// AND pbds.harga_satuan IS NOT NULL
		// AND pbds.jumlah IS NOT NULL
		// GROUP BY pb.idpaket_belanja,
		// p.nama_program,
		// pb.nama_paket_belanja,
		// pb.nilai_anggaran

		// return $paket_belanja;
	}

	function custom_style($key, $value, $data) {
		
		if ($key == 'nilai_anggaran') {
			return az_thousand_separator($value);
		}

		return $value;
	}
}