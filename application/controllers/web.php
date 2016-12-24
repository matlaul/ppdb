<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('siswa_model'); 
        $this->load->model('admin_model');   
        if($this->session->userdata('is_logged_siswa')){
				redirect('siswa');
		}else if($this->session->userdata('is_logged_admin')){
			redirect('admin');
		}	

	$this->load->library(array('session','pagination','form_validation','upload')); 
	$this->load->model('web_model');
    }
    
    function index(){
		$data['message']="";
         $this->load->view('web/index',$data);
    }
    function login(){
		$data['message']="";
         $this->load->view('web/login',$data);
    }
    
 
 	function validate_credentials(){//untuk login	
		$this->db->select('*');
		$this->db->where('email_address', $this->input->post('nisn'));
		$this->db->where('password',md5($this->input->post('password')));
		$this->db->limit(1);
		$query = $this->db->get('siswa');
		$this->db->from('admin');
		$this->db->where('email_address', $this->input->post('nisn'));
		$this->db->where('password_admin',$this->input->post('password'));
		$this->db->limit(1);
		$query_admin = $this->db->get();	
	
		if($query->num_rows() == 1){
				$data = array(
				'email_address' => $this->input->post('nisn'),
				'is_logged_siswa' => true
						);
					
			$this->session->set_userdata($data);
			redirect('siswa/index');
		}else if($query_admin->num_rows() == 1){	
				$data_admin = array(
				'email_address' => $this->input->post('nisn'),
				'is_logged_admin' => true
			);
			$this->session->set_userdata($data_admin);
			redirect('admin/index');
		}else{ 
			
			// incorrect username or password
			$data['message']="<div class='alert alert-warning'>NISN dan Password salah</div>";
					$data['main_content'] = 'web/login';
         $this->load->view('web/login',$data);
		}
	}
	
    function mendaftar(){
		$data['message']="";
		$data ['m'] = $this->web_model->get_tanggal_mendaftar();
		$tgl_tutup=$data['m']->tgl_tutup;
		$tgl_mulai=$data['m']->tgl_mulai;
		$tanggal = date('Y-m-d');
		if($tgl_mulai>$tanggal){
			$data['message']="<center><div class='alert alert-warning'>Maaf, Pendaftaran Siswa Baru SMP Bersama Belum di Buka</br>Silahkan mendaftar ketika pendaftaran dibuka</br>Terima Kasih</div></center>";
		$data['main_content'] = 'web/index';
         $this->load->view('include/template',$data);
		}else if($tgl_tutup<=$tanggal){
			$data['message']="<center><div class='alert alert-warning'>Maaf, Pendaftaran Siswa Baru SMP Bersama Telah di Tutup</br>Terima Kasih</div></center>";
		$data['main_content'] = 'web/index';
         $this->load->view('include/template',$data);
		}else{
		
		$data['main_content'] = 'web/mendaftar';
         $this->load->view('include/template',$data);
	 }
    }
   
 	function create_user(){
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
		
		$nisncari=$this->input->post('nisn');
		$email= $this->input->post('email_address');		
		$query_nisn_email=mysql_query("select nisn from siswa where nisn='$nisncari' and email_address='$email' LIMIT 1");
		$cek_nisn_email=mysql_num_rows($query_nisn_email);
		$query=mysql_query("select nisn from siswa where nisn='$nisncari' LIMIT 1");
		$cek_nisn=mysql_num_rows($query);
		$query_email=mysql_query("select nisn from siswa where email_address='$email' LIMIT 1");
		$cek_email=mysql_num_rows($query_email);
                //setting konfiguras upload image
        
        $config['upload_path'] = './assets/img/siswa/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '500';
		$config['max_height']  = '500';
          
                		
		if($this->form_validation->run() == FALSE){
         $this->mendaftar();
		}else if($cek_nisn_email){
		$data['message']="<div class='alert alert-warning'>Maaf, NISN $nisncari dan Email $email Sudah digunakan, silahkan menggunakan nisn dan email yang berbeda</div>";
		$data['main_content'] = 'web/mendaftar';
         $this->load->view('include/template',$data);
		}else if($cek_nisn){
		$data['message']="<div class='alert alert-warning'>Maaf, NISN $nisncari Sudah digunakan, silahkan menggunakan nisn yang berbeda</div>";
		$data['main_content'] = 'web/mendaftar';
         $this->load->view('include/template',$data);
			
		}else if($cek_email){
		$data['message']="<div class='alert alert-warning'>Maaf, Email $email Sudah digunakan, silahkan menggunakan email yang berbeda</div>";
		$data['main_content'] = 'web/mendaftar';
         $this->load->view('include/template',$data);        
			}else{
				$query = $this->upload->initialize($config);
				$query = $this->web_model->create_member();
				$data['main_content'] = 'web/signup_successful';
				$this->load->view('include/template', $data);
			}
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
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
		}
    }
    
     function siswa_terdaftar_semua_tertinggi(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_semua_laki_laki(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_laki_laki'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_semua_perempuan(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_perempuan'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_diteriman(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_diteriman'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_blm_diterima(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_blm_diterima'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }

     function siswa_terdaftar_semua_terendah(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_terendah'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_semua_laki_laki_terendah(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_laki_laki_terendah'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_semua_perempuan_terendah(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_perempuan_terendah'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_diteriman_terendah(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_diteriman_terendah'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
    }
     function siswa_terdaftar_blm_diterima_terendah(){
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_blm_diterima_terendah'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
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
			 $data['main_content'] = 'web/lihat_detail_siswa';
         $this->load->view('include/template',$data);		
		}else{
			$getData = $this->db->get('siswa');
			$a = $getData->num_rows();
			$config['base_url'] = site_url().'/web/siswa_terdaftar_semua_tertinggi'; //set the base url for pagination
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
		$data['main_content'] = 'web/siswa_terdaftar';
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
		$data['main_content'] = 'web/lihat_detail_rapor_ijazah';
         $this->load->view('include/template',$data);
			
    }

         
     function cari_siswa(){
		  $data['message']="";
       $cari=$this->input->post('cari');
        $cek=$this->admin_model->cari($cari);
        if($cek->num_rows()>0){
            $data['message_ceksiswa']="";
            $data['urutkan_siswa']=$cek;
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
        }else{
            $data['message_ceksiswa']="<div class='alert alert-warning'>Data yang dicari tidak ditemukan</div>";
            $data['urutkan_siswa']=$cek;
		$data['main_content'] = 'web/siswa_terdaftar';
         $this->load->view('include/template',$data);
        }
			
    }
}
