<?php
class admin extends CI_Controller{
      private $limit=10;
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    		$this->load->library('upload');
        $this->load->library('form_validation');
        $this->load->model('admin_model');  
		 if(!$this->session->userdata('is_logged_admin')){
				redirect('web');
			}
 $this->load->library(array('pagination','form_validation','upload'));
    }
    
    function index(){
		$data['main_content'] = 'admin/index';
         $this->load->view('admin/include/template',$data);
    }

    function urut(){
		$urut = $this->input->post('urutkan');
		$urutkan_siswa = $this->input->post('urutkan_siswa');
		if($urut == "tertinggi" and $urutkan_siswa =="semua"){
			$this->siswa_terdaftar_semua_tertinggi();		
		}else if($urut == "tertinggi" and $urutkan_siswa =="laki-laki"){
			$this->siswa_terdaftar_semua_laki_laki();
		}else if($urut == "tertinggi" and $urutkan_siswa =="perempuan"){
			$this->siswa_terdaftar_semua_perempuan();
		}else if($urut == "tertinggi" and $urutkan_siswa =="diterima"){
			$this->siswa_terdaftar_diteriman();
		}else if($urut == "tertinggi" and $urutkan_siswa =="blm_diterima"){
			$this->siswa_terdaftar_blm_diterima();
		}else if($urut == "terendah" and $urutkan_siswa =="semua"){
			$this->siswa_terdaftar_semua_terendah();		
		}else if($urut == "terendah" and $urutkan_siswa =="laki-laki"){
			$this->siswa_terdaftar_semua_laki_laki_terendah();
		}else if($urut == "terendah" and $urutkan_siswa =="perempuan"){
			$this->siswa_terdaftar_semua_perempuan_terendah();
		}else if($urut == "terendah" and $urutkan_siswa =="diterima"){
			$this->siswa_terdaftar_diteriman_terendah();
		}else if($urut == "terendah" and $urutkan_siswa =="blm_diterima"){
			$this->siswa_terdaftar_blm_diterima_terendah();
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="<div class='alert alert-warning'>Maaf, Data siswa tidak ditemukan</br>silahkan periksa kembali</div>";
	    $data['message']="<h3>Data Semua Siswa Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
		}
    }
    
     function siswa_terdaftar_semua_tertinggi(){
     	$this->db->select('*');
     	$this->db->from('siswa');
     	$ada_siswa=$this->db->get();
		
		if($ada_siswa->num_rows() ==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Mendaftar Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/tabel/daftar_semua';
         $this->load->view('admin/include/template',$data);
	 }
    }
     function siswa_terdaftar_semua_laki_laki(){
	     $ada_siswa=mysql_query("select id_siswa from siswa where jk='laki-laki'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Semua Laki-Laki yang Mendaftar Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_laki_laki'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_semua_laki_laki($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Laki-Laki Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_semua_perempuan(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_perempuan'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_semua_perempuan($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Perempuan Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_diteriman(){
	     $ada_siswa=mysql_query("select id_siswa from siswa where status='Diterima'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Diterima Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_diteriman'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_diteriman($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Diterima Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_blm_diterima(){
     $ada_siswa=mysql_query("select id_siswa from siswa where status='Belum Diterima'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Belum Diterima Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_blm_diterima'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_blm_diterima($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Belum Diterima Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }

     function siswa_terdaftar_semua_terendah(){
     $ada_siswa=mysql_query("select id_siswa from siswa");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_terendah'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_terendah($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Berdasarkan</br>Urutan Nilai Terendah</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_semua_laki_laki_terendah(){
     $ada_siswa=mysql_query("select id_siswa from siswa where jk='laki-laki'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_laki_laki_terendah'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_semua_laki_laki_terendah($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Laki-Laki Berdasarkan</br>Urutan Nilai Terendah</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_semua_perempuan_terendah(){
    $ada_siswa=mysql_query("select id_siswa from siswa where jk='perempuan'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_perempuan_terendah'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_semua_perempuan_terendah($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Perempuan Berdasarkan</br>Urutan Nilai Terendah</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_diteriman_terendah(){
    $ada_siswa=mysql_query("select id_siswa from siswa where status='Diterima'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_diteriman_terendah'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_diteriman_terendah($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Diterima Berdasarkan</br>Urutan Nilai Terendah</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
    }
     function siswa_terdaftar_blm_diterima_terendah(){
    $ada_siswa=mysql_query("select id_siswa from siswa where status='Belum Diterima'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_blm_diterima_terendah'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_blm_diterima_terendah($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="";
	    $data['message']="<h3>Data Semua Siswa Belum Diterima Berdasarkan</br>Urutan Nilai Terendah</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
        }
    }

    
     function lihat_detail($id){
		  $data['status']="";
		$query1=mysql_query("select id_siswa from siswa where id_siswa='$id' LIMIT 1");
		$cek_id=mysql_num_rows($query1);
				$data ['ijazah'] = $this->admin_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->admin_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->admin_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->admin_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->admin_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->admin_model->id_rapor_kls6_sm1($id);
		if($cek_id){
			$data ['m'] = $this->admin_model->get_data($id);
			 $data['main_content'] = 'admin/lihat_detail_siswa';
         $this->load->view('include/template',$data);		
		}else{
		$data['message']="<div class='alert alert-warning'>Data Siswa Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}
    }
    
     function lihat_detail_rapor_ijazah($id){
		$data ['ijazah'] = $this->admin_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->admin_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->admin_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->admin_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->admin_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->admin_model->id_rapor_kls6_sm1($id);	 
		$data['main_content'] = 'admin/lihat_detail_rapor_ijazah';
         $this->load->view('include/template',$data);
			
    }

         
     function cari_siswa(){
		  $data['message']="";
       $cari=$this->input->post('cari');
        $cek=$this->admin_model->cari($cari);
        if($cek->num_rows()>0){
            $data['message_ceksiswa']="";
            $data['urutkan_siswa']=$cek;
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
        }else{
            $data['message_ceksiswa']="<div class='alert alert-warning'>Data yang dicari tidak ditemukan</div>";
            $data['urutkan_siswa']=$cek;
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
        }
			
    }
     function terima_siswa($id){
		 $data['status']="";
		 $status="Diterima";
		$query_terima=mysql_query("select id_siswa from siswa where id_siswa='$id' and status='$status'  LIMIT 1");
		$cek_terima=mysql_num_rows($query_terima);
		
		$sql_kuota_sekarang=mysql_query("select id_siswa from siswa where status='$status' ");
		$kuota_sekarang=mysql_num_rows($sql_kuota_sekarang);
		
		$sql_kuota=mysql_query("select kuota from tgl_pendaftaran where kuota='1' ");
		$jmlm_kuota=mysql_num_rows($sql_kuota);
	
		$data ['m'] = $this->admin_model->get_kuota();
		$jml_kuota=$data['m']->kuota;
			
		$data ['jumlah'] = $this->admin_model->cari_jumlah($id);
		$jumlah=$data['jumlah']->jumlah_semua_nilai;	

			$metode = $this->input->post('metode_penerimaan');
			$sql_tgl= "select kuota,tgl_tutup from tgl_pendaftaran where id_atur_tgl = 1 LIMIT 1";
			$kuota['tgl'] = $this->db->query($sql_tgl)->row();
			$jml_kuota=$kuota['tgl']->kuota;
			$tgl_penutupan=$kuota['tgl']->tgl_tutup;

			$tanggal_hari_ini = date('Y-m-d');
		if($tanggal_hari_ini<$tgl_penutupan){
		$data['message']="<div class='alert alert-warning'>Maaf, anda belum bisa memilih  metode penerimaan siswa</br>ketika penerimaan siswa masih belum berakhir</br>silahkan memililh metode ini ketika pendaftaran telah berkahir</div>";	
		$metode="Belum Tersedia";	
		$query = $this->admin_model->metode_penerimaan($metode);
		$data ['atur'] = $this->admin_model->lihat_atur_jadwal();
		$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
		

		$data['main_content'] = 'admin/atur_jadwal';
		$this->load->view('include/template', $data);	
		}else{
		if($kuota_sekarang==$jml_kuota){
			$data['status']="<div class='alert alert-warning'>Maaf,</br>Kuota Penerimaa Siswa Telah Penuh";
		}else if($jumlah==0){
			$data['status']="<div class='alert alert-warning'>Maaf,</br>Siswa ini belum bisa diterima</br>Jumlah nilai siswa ini belum mencukupi";	
		}else if($cek_terima==1){
			$data['status']="<div class='alert alert-warning'>Maaf,</br>Status Siswa Telah Diterima Sebelumnya";
		}else{
			$data['status']="<div class='alert alert-success'>BERHASIL</br>Siswa Telah Diterima";
		
        $cek=$this->admin_model->terima_siswa($id);
		}
		$query1=mysql_query("select id_siswa from siswa where id_siswa='$id' LIMIT 1");
		$cek_id=mysql_num_rows($query1);
		$data ['ijazah'] = $this->admin_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->admin_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->admin_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->admin_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->admin_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->admin_model->id_rapor_kls6_sm1($id);
		if($cek_id){
			$data ['m'] = $this->admin_model->get_data($id);
			 $data['main_content'] = 'admin/lihat_detail_siswa';
         $this->load->view('include/template',$data);		
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '0'; //the number of per page for pagination
			$config['uri_segment'] = 0; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		$data['message_ceksiswa']="<div class='alert alert-warning'>Maaf, Data siswa tidak ditemukan</br>silahkan periksa kembali</div>";
			
	    $data['message']="";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
}

}
     function batal_terima_siswa($id){
		 $data['status']="";
        $cek=$this->admin_model->batal_terima_siswa($id);
		$data['status']="<div class='alert alert-warning'>Siswa Batal Diterima";
		$query1=mysql_query("select id_siswa from siswa where id_siswa='$id' LIMIT 1");
		$cek_id=mysql_num_rows($query1);
				$data ['ijazah'] = $this->admin_model->id_rapor_ijazah($id);	 
		$data ['kls4_sm1'] = $this->admin_model->id_rapor_kls4_sm1($id);	 
		$data ['kls4_sm2'] = $this->admin_model->id_rapor_kls4_sm2($id);	 
		$data ['kls5_sm1'] = $this->admin_model->id_rapor_kls5_sm1($id);	 
		$data ['kls5_sm2'] = $this->admin_model->id_rapor_kls5_sm2($id);	 
		$data ['kls6_sm1'] = $this->admin_model->id_rapor_kls6_sm1($id);
		if($cek_id){
			$data ['m'] = $this->admin_model->get_data($id);
			 $data['main_content'] = 'admin/lihat_detail_siswa';
         $this->load->view('include/template',$data);		
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '0'; //the number of per page for pagination
			$config['uri_segment'] = 0; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		$data['message_ceksiswa']="<div class='alert alert-warning'>Maaf, Data siswa tidak ditemukan</br>silahkan periksa kembali</div>";
			
	    $data['message']="";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
}
     function hapus_siswa($id){
  
  			$detail=$this->admin_model->cek($id)->result();
			foreach($detail as $det):
				unlink("assets/img/siswa/".$det->image);
			endforeach;    
			
        $cek=$this->admin_model->hapus_ijazah($id);
        $cek=$this->admin_model->hapus_kls4_sm1($id);
       $cek=$this->admin_model->hapus_kls4_sm2($id);
       $cek=$this->admin_model->hapus_kls5_sm1($id);
       $cek=$this->admin_model->hapus_kls5_sm2($id);
       $cek=$this->admin_model->hapus_kls6_sm1($id);
       $cek=$this->admin_model->hapus_siswa($id);
        
     $ada_siswa=mysql_query("select * from siswa");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data siswa berhasil dihapus</br>Sekarang tidak ada data siswa yang terdaftar</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
		 $data['message_ceksiswa']="<div class='alert alert-success'>Data siswa berhasil dihapus</div>";
	    $data['message']="<h3>Data Semua Siswa Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
	 }
}
     function atur_jadwal(){
		  $data['message']="";
				$data ['atur'] = $this->admin_model->lihat_atur_jadwal();	
				$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
				$data['main_content'] = 'admin/atur_jadwal';
				$this->load->view('include/template', $data);
		}
    
     function proses_atur_jadwal(){
		  $data['message']="";
		 $tgl_mulai = $this->input->post('tgl_mulai');
		 $tgl_tutup = $this->input->post('tgl_tutup');
		 if($tgl_mulai==$tgl_tutup){
			$data['message']="<div class='alert alert-warning'>Maaf, Tanggal dimulai dan ditutup pendaftaran tidak boleh sama</br>tanggal dimulai minimal bisa dilakukan 1 hari sebelum tanggal ditutup</br>(Misalnya, tanggal mulai 06-29-2014 dan tanggal ditutup 06-30-2014</div>";
			$data ['atur'] = $this->admin_model->lihat_atur_jadwal();	
			$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
			$data['main_content'] = 'admin/atur_jadwal';
			$this->load->view('include/template', $data);				 
		 }else if($tgl_mulai>$tgl_tutup){
			$data['message']="<div class='alert alert-warning'>Maaf, Tanggal mulai pendaftaran melebihi dari tanggal penutup pendaftaran</div>";
			$data ['atur'] = $this->admin_model->lihat_atur_jadwal();	
			$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
			$data['main_content'] = 'admin/atur_jadwal';
			$this->load->view('include/template', $data);	
		 }else{
		$data['message']="<div class='alert alert-success'>Penjadwalan Berhasil diatur</div>";
		
				$query = $this->admin_model->atur_jadwal();
				$data ['atur'] = $this->admin_model->lihat_atur_jadwal();	
				$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
				$data['main_content'] = 'admin/atur_jadwal';
				$this->load->view('include/template', $data);
		}
    }
     function atur_kuota(){
		$data['message']="";
		$kuota = $this->input->post('kuota');
		$query = $this->admin_model->atur_kuota();
		$data ['atur'] = $this->admin_model->lihat_atur_jadwal();
		$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
		$data['message']="<div class='alert alert-success'>Kuota Berhasil diatur</div>";	
		$data['main_content'] = 'admin/atur_jadwal';
		$this->load->view('include/template', $data);		
		}
     function atur_metode(){
	     $ada_siswa=mysql_query("select * from siswa");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);

		$data['message']="";
			$metode = $this->input->post('metode_penerimaan');
			$sql= "select kuota,tgl_tutup from tgl_pendaftaran where id_atur_tgl = 1 LIMIT 1";
			$kuota ['m'] = $this->db->query($sql)->row();
			$jml_kuota=$kuota['m']->kuota;
			$tgl_penutupan=$kuota['m']->tgl_tutup;

			$tanggal_hari_ini = date('Y-m-d');
		if($tanggal_hari_ini<$tgl_penutupan){
		$data['message']="<div class='alert alert-warning'>Maaf, anda belum bisa memilih  metode penerimaan siswa</br>ketika penerimaan siswa masih belum berakhir</br>silahkan memililh metode ini ketika pendaftaran telah berkahir</div>";	
		$metode="Belum Tersedia";	
		$query = $this->admin_model->metode_penerimaan($metode);
		$data ['atur'] = $this->admin_model->lihat_atur_jadwal();
		$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	

		$data['main_content'] = 'admin/atur_jadwal';
		$this->load->view('include/template', $data);	
		}else if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Mendaftar Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
         				
	 }else  if($metode == 'Grade Tertinggi'){					
		$sql_terima_siswa="select id_siswa from siswa order by jumlah_Semua_nilai desc LIMIT $jml_kuota";
			$sql_terima_siswa = $this->db->query($sql_terima_siswa)->result();
			foreach($sql_terima_siswa as $row1 ){
						$tanggal = date('Y-m-d');
						$status ="Diterima";
						$data = array(
							'status' => $status,
							'tgl_diterima' => $tanggal
				);
				
				$this->db->update('siswa', $data, "id_siswa =".$row1->id_siswa); 
			}
			$data_diterima['status']="<div class='alert alert-success'>Metode penerimaan siswa baru diambil</br>dari data siswa nilai tertinggi berhasil diterima</div>";	

			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/laporan_siswa_diterima'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
		$query = $this->admin_model->metode_penerimaan($metode);
		 $data_diterima ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
	    $data_diterima['message']="<h3>Data Semua Siswa Diterima</br>di SMP Kita Bersama</h3>";
		$data_diterima['main_content'] = 'admin/laporan_siswa_diterima';
         $this->load->view('include/template',$data_diterima);
			
		}else if($metode == 'Manual'){
		$data['message_ceksiswa']="<div class='alert alert-success'>Berhasil </br>Pemilihan siswa diterima  menggunakan metode dipilih secara manual</div>";	
			
		$query = $this->admin_model->metode_penerimaan($metode);
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data ['urutkan_siswa'] = $this->admin_model->urutkan_semua_siswa_tertinggi($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
	    $data['message']="<h3>Data Semua Siswa Berdasarkan</br>Urutan Nilai Tertinggi</h3>";
		$data['main_content'] = 'admin/siswa_terdaftar';
         $this->load->view('include/template',$data);
		}else{
			$data['message']="<div class='alert alert-warning'>Maaf, Pemilihan metode gagal dilakukan</div>";	
		$metode ="Belum Dipilih";
		$query = $this->admin_model->metode_penerimaan($metode);
		}
				
		
  }  
     function laporan_siswa_diterima(){
     	$this->db->select('*');
     	$this->db->from('siswa');
     	$ada_siswa=$this->db->get();
		if($ada_siswa->num_rows()==0){
			$data['message']="<div class='alert alert-warning'>Data Siswa Mendaftar Masih Belum Tersedia</div>";
			$data['main_content'] = 'admin/tabel/siswa_diterima';
	         $this->load->view('admin/include/template',$data);
	 	}else{
			$data_diterima['status']="";
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'admin/tabel/siswa_diterima'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data_diterima ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_diteriman($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
	    $data_diterima['message']="<h3>Data Semua Siswa Diterima</br>di SMP Kita Bersama</h3>";
		$data_diterima['main_content'] = 'admin/tabel/siswa_diterima';
         $this->load->view('admin/include/template',$data_diterima);
	 }
    }
     function laporan_siswa_belum_diterima(){
		   $ada_siswa=mysql_query("select * from siswa where status='Belum Diterima'");
		$periksa_ada_siswa=mysql_num_rows($ada_siswa);
		if($periksa_ada_siswa==0){
		$data['message']="<div class='alert alert-warning'>Data Siswa Mendaftar Masih Belum Tersedia</div>";
		$data['main_content'] = 'admin/data_kosong';
         $this->load->view('include/template',$data);
	 }else{
			$data_diterima['status']="";
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/admin/laporan_siswa_blm_diterima'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '10'; //the number of per page for pagination
			$config['uri_segment'] = 3; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p class=pagination>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination

		 $data_diterima ['urutkan_siswa'] = $this->admin_model->siswa_terdaftar_blm_diterima($config['per_page'],$this->uri->segment(3));
		 $urutkan_data = $this->input->post('urutkan');
	    $data_diterima['message']="<h3>Data Semua Siswa Belum Diterima</br>di SMP Kita Bersama</h3>";
		$data_diterima['main_content'] = 'admin/laporan_siswa_blm_diterima';
         $this->load->view('include/template',$data_diterima);
	 }
    }
     function penerimaan(){
		$data['main_content'] = 'admin/atur_penerimaan';
		$this->load->view('include/template', $data);
    }
     function statistik_pendaftaran(){
		 $data['message']="";
		$data['main_content'] = 'admin/statistik_pendaftar';
		$this->load->view('include/template', $data);
    }
    public function cetak_diterima(){ 
	
	$this->load->helper('to_pdf'); 
	$data_diterima['urutkan_siswa'] = $this->admin_model->cetak_siswa_terdaftar_diteriman();
	$html = $this->load->view('admin/cetak_laporan_siswa_diterima',$data_diterima, true);
    $this->load->view('admin/cetak_laporan_siswa_diterima',$data_diterima);	
	pdf_create($html, 'Data Siswa Diterima');
		
	
    }
    public function cetak_blm_diterima(){ 
	
	$this->load->helper('to_pdf'); 
	$data_diterima['urutkan_siswa'] = $this->admin_model->cetak_siswa_terdaftar_blm_diteriman();
	$html = $this->load->view('admin/cetak_laporan_siswa_blm_diterima',$data_diterima, true);
    $this->load->view('admin/cetak_laporan_siswa_diterima',$data_diterima);	
	pdf_create($html, 'Data Siswa Belum Diterima');
		
	
    }
    public function cetak_statistik_laporan(){ 
	
	$this->load->helper('to_pdf'); 
	$data_diterima['urutkan_siswa'] = $this->admin_model->cetak_siswa_terdaftar_blm_diteriman();
	$html = $this->load->view('admin/cetak_statistik_laporan',$data_diterima, true);
    $this->load->view('admin/cetak_laporan_siswa_diterima',$data_diterima);	
	pdf_create($html, 'Statistik Pendaftaran');
		
	
    }

  	public function atur_admin(){
		$this->form_validation->set_message('required', '%s is required.');
		$this->form_validation->set_message('min_length', '%s Minimal %s Karakter.');
		$this->form_validation->set_message('max_length', '%s Maksimal %s Karakter.');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
	if($this->form_validation->run() == FALSE){
         $this->atur_jadwal();
       }else{
				$query = $this->admin_model->atur_admin();
				$data['message']="<div class='alert alert-success'>SELAMAT</br>data admin berhasil diperbaruhi</div>";
				$data ['atur'] = $this->admin_model->lihat_atur_jadwal();	
				$data ['atur_aadmin'] = $this->admin_model->lihat_atur_admin();	
				$data['main_content'] = 'admin/atur_jadwal';
				$this->load->view('include/template', $data);
	  }
	}

     function logout(){
        $this->session->unset_userdata('is_logged_admin');
        redirect('web');
    }
	
}
