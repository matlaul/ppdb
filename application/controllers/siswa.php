<?php
class siswa extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('admin_model'); 
        $this->load->model('siswa_model');  
        $this->load->model('web_model'); 
		 if(!$this->session->userdata('is_logged_siswa')){
				redirect('web');	
			}
		 $this->load->library(array('template','pagination','form_validation','upload'));
    }
    
    function index(){
		$email = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/index';
         $this->load->view('include/template',$data);
    }
    function lihat_profil_saya(){
		$data['message']="";
		$email = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/lihat_profil';
         $this->load->view('include/template',$data);
    }
    function edit_profil(){
		$data['message']="";
		$email = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/edit_profil';
         $this->load->view('include/template',$data);
    }
    function proses_edit_profil(){
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_message('min_length', '%s Minimal %s Karakter.');
		$this->form_validation->set_message('max_length', '%s Maksimal %s Karakter.');
		$this->form_validation->set_message('numeric', '%s Harus diisi Angka.');	
		
		$this->form_validation->set_rules('nisn', 'Nisn ', 'trim|numeric|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'phone', 'trim|numeric');
		
		$config['upload_path'] = './assets/img/siswa/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '1024';
		
		$email = $this->session->userdata('email_address');
		$nisn = $this->input->post('nisn');

		
		$query1=mysql_query("select * from siswa where email_address='$email' LIMIT 1");
		$cek_nisn1=mysql_num_rows($query1);
		
		$query2=mysql_query("select * from siswa where nisn='$nisn' LIMIT 1");
		$cek_nisn2=mysql_num_rows($query2);
		
		$query3=mysql_query("select * from siswa where nisn='$nisn' and  email_address='$email' LIMIT 1");
		$cek_nisn3=mysql_num_rows($query3);
		
		
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		
		$data ['m'] = $this->siswa_model->get_id($id);
		if($this->form_validation->run() == FALSE){
			$this->lihat_profil_saya();
		}else if($cek_nisn3){
			

	
				$query = $this->upload->initialize($config);
				$query = $this->siswa_model->edit_profil($id);
			$data['message']="<div class='alert alert-success'>Data berhasil diperbaruhi</div>";
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/lihat_profil';
         $this->load->view('include/template',$data);

	
		}else if($cek_nisn2){
		$data['message']="<div class='alert alert-warning'>NISN sudah terdaftar, anda tidak bisa menggunakan NISN yang sudah terdaftar</div>";
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/edit_profil';
         $this->load->view('include/template',$data);

	
		}else if($cek_nisn1){
				$query = $this->upload->initialize($config);
				$query = $this->siswa_model->edit_profil2($id);
			$data['message']="<div class='alert alert-success'>Data berhasil diperbaruhi</div>";
		$data ['m'] = $this->siswa_model->get_email($email);
		$data['main_content'] = 'siswa/lihat_profil';
         $this->load->view('include/template',$data);
	
		}else{
				//$nisn = $this->session->userdata('nisn');
				//$query = $this->upload->initialize($config);
				//$query = $this->siswa_model->edit_profil($nisn);
				//$this->lihat_profil_saya();
			}
    }
    
    function isi_data_rapor_ijazah(){
		$data['message']="";
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
	
		
		$data ['jumlah'] = $this->siswa_model->cari_jumlah($id);
		$jumlah=$data['jumlah']->jumlah_semua_nilai;

		$sql= "select tgl_tutup from tgl_pendaftaran where id_atur_tgl ='1' LIMIT 1";
		$tgl_tutup['tgl'] = $this->db->query($sql)->row();
		$tutup=$tgl_tutup['tgl']->tgl_tutup;
		$tanggal_hari_ini = date('Y-m-d');

		if($tanggal_hari_ini>=$tutup){
		$data['main_content'] = 'siswa/tutup_pendaftaran';
         $this->load->view('include/template',$data);	
		}else if(!$jumlah==0){
		$data['message']="<div class='alert alert-success'>Data Rincian Nilai Rapor dan Ijazah</br>Sudah Tersedia</br>Anda tidak bisa mengisi data rapor atau ijazah jika sebelumnya sudah mengisi data tersebut,</br>tetapi anda bisa memperbaruhi data rapor dan ijazah anda</div>";
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	
		$data['main_content'] = 'siswa/edit_rapor_izajah';
         $this->load->view('include/template',$data);
			
		}else{
		$data['main_content'] = 'siswa/isi_rapor_izajah';
         $this->load->view('include/template',$data);
	 }
    }
    
    function proses_isi_data_rapor_ijazah(){
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		$query = $this->siswa_model->isi_rapor_izajah($id);
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	
		$data['message']="<div class='alert alert-success'>Data Rincian Nilai Rapor dan Ijazah</br>Berhasil disimpan</div>";
		$data['main_content'] = 'siswa/lihat_rapor_ijazah';
         $this->load->view('include/template',$data);
    }
    function lihat_rapor_ijazah(){
		$data['message']="";
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		
		$data ['jumlah'] = $this->siswa_model->cari_jumlah($id);
		$jumlah=$data['jumlah']->jumlah_semua_nilai;

		if(!$jumlah==0){
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	 
		$data['main_content'] = 'siswa/lihat_rapor_ijazah';
         $this->load->view('include/template',$data);
			
		}else{
$data['message']="<div class='alert alert-warning'>Maaf, Data Rincian Nilai Rapor dan Ijazah</br>Belum ada, silahkan mengisi terlebih dahulu</div>";
		 $data['main_content'] = 'siswa/isi_rapor_izajah';
         $this->load->view('include/template',$data);	
	 }

    }
    function edit_rapor_izajah(){
		$data['message']="";
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		
		$data ['jumlah'] = $this->siswa_model->cari_jumlah($id);
		$jumlah=$data['jumlah']->jumlah_semua_nilai;
		
		$sql= "select tgl_tutup from tgl_pendaftaran where id_atur_tgl ='1' LIMIT 1";
		$tgl_tutup['tgl'] = $this->db->query($sql)->row();
		$tutup=$tgl_tutup['tgl']->tgl_tutup;
		$tanggal_hari_ini = date('Y-m-d');

		if($tanggal_hari_ini>=$tutup){
		$data['main_content'] = 'siswa/tutup_pendaftaran';
         $this->load->view('include/template',$data);	
		}else if(!$jumlah==0){
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	
		$data['main_content'] = 'siswa/edit_rapor_izajah';
         $this->load->view('include/template',$data);
			
		}else{
$data['message']="<div class='alert alert-warning'>Maaf, Data Rincian Nilai Rapor dan Ijazah</br>Belum ada, silahkan mengisi terlebih dahulu</div>";
		 $data['main_content'] = 'siswa/isi_rapor_izajah';
         $this->load->view('include/template',$data);	
	 }

    }
    function proses_edit_data_rapor_ijazah(){
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		$query = $this->siswa_model->edit_rapor_izajah($id);
		$data['message']="<div class='alert alert-success'>Data Rincian Nilai Rapor dan Ijazah</br>Berhasil diperbaruhi</div>";
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	 
		$data['main_content'] = 'siswa/lihat_rapor_ijazah';
         $this->load->view('include/template',$data);		
    }
    function kembali_lihat_data_rapor_ijazah(){
		$data['message']="<div class='alert alert-warning'>Data Rincian Nilai Rapor dan Ijazah</br>Batal diperbaruhi</div>";
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		$data ['ijazah'] = $this->siswa_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->siswa_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->siswa_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->siswa_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->siswa_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->siswa_model->id_rapor_kls6_sm1($id);	 
		$data['main_content'] = 'siswa/lihat_rapor_ijazah';
         $this->load->view('include/template',$data);
    }
    function bukti_pendaftaran(){
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;
		
		$data ['jumlah'] = $this->siswa_model->cari_jumlah($id);
		$jumlah=$data['jumlah']->jumlah_semua_nilai;
		
		 if(!$jumlah==0){
			$data['main_content'] = 'siswa/bukti_pendaftaran';
			$this->load->view('include/template',$data);
		}else{
			$data['message']="<div class='alert alert-warning'>Maaf, anda belum bisa mengmabil/melihat bukti pendaftaran</br>Silahkan mengisi data rapor dan ijazah SD anda terlebih dahulu</br>Sebelum mangambil bukti pendaftran</div>";
			$data['main_content'] = 'siswa/isi_rapor_izajah';
			$this->load->view('include/template',$data);
		}
    }
    function siswa_diterima(){
		$data['message_ceksiswa']="";
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;

		$query1=mysql_query("select * from siswa where id_siswa='$id' and status='Diterima' LIMIT 1");
		$jumlah=mysql_num_rows($query1);
		$data ['tgl'] = $this->web_model->get_tanggal_mendaftar();
		$tgl_tutup=$data['tgl']->tgl_tutup;
		$tanggal = date('Y-m-d');
		
		if($tanggal<$tgl_tutup){
			$data['message_ceksiswa']="<div class='alert alert-warning'><h1>MAAF</h1></br><h2 class='page-header'>Anda belum bisa melihat status anda diterima / belum</br>sebelum pendaftaran berakhir $tgl_tutup</h2></div>";
			$data['main_content'] = 'siswa/siswa_bl_diterima';
			$this->load->view('include/template',$data);		
				
		}else if(!$jumlah==0){
			$data['main_content'] = 'siswa/siswa_diterima';
			$this->load->view('include/template',$data);
		}else{
			$data['message_ceksiswa']="<div class='alert alert-warning'><h1>MAAF</h1><h2>Anda belum diterima di SMP Kita Bersama</h2><h2 class='page-header'>Terus semangat dan berjuang</h2></div>";		
			$data['main_content'] = 'siswa/siswa_bl_diterima';
			$this->load->view('include/template',$data);
		}
    }
    public function cetak_bukti(){ 
		$this->load->helper('to_pdf'); 
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$html = $this->load->view('siswa/cetak_bukti',$data, true);
		pdf_create($html, 'Bukti Pendaftaran');	
	
    }
    public function cetak_kartu_siswa(){ 
		$this->load->helper('to_pdf'); 
		$id_siswa_login_cari = $this->session->userdata('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$html = $this->load->view('siswa/cetak_kartu_siswa',$data, true);
		pdf_create($html, 'Kartu Tanda Siswa');	
	
    }
    
    
  
     function logout(){
        $this->session->unset_userdata('is_logged_siswa');
       
        redirect('web');
    }
	}
