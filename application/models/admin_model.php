<?php

class admin_model extends CI_Model {	
    function cetak_siswa_terdaftar_diteriman(){	

	    $sql="select * from siswa where status = 'Diterima' order by jumlah_semua_nilai desc";
       return $this->db->query($sql)->result(); 
    }
    function cetak_siswa_terdaftar_blm_diteriman(){	

	    $sql="select * from siswa where status = 'Belum Diterima' order by jumlah_semua_nilai desc";
       return $this->db->query($sql)->result(); 
    }
    
    function urutkan_semua_siswa_tertinggi($perPage, $uri){	
		$this->db->order_by('jumlah_semua_nilai','desc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		
		return $query;       
    }
    
    function siswa_terdaftar_semua_laki_laki($perPage, $uri){	
		$this->db->where('jk','laki-laki');
		$this->db->order_by('jumlah_semua_nilai','desc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_semua_perempuan($perPage, $uri){	
		$this->db->where('jk','perempuan');
		$this->db->order_by('jumlah_semua_nilai','desc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_diteriman($perPage, $uri){	
		$this->db->where('status','Diterima');
		$this->db->order_by('jumlah_semua_nilai','desc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_blm_diterima($perPage, $uri){	
		$this->db->where('status','Belum Diterima');
		$this->db->order_by('jumlah_semua_nilai','desc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    //batas
    function urutkan_semua_siswa_terendah($perPage, $uri){	
		$this->db->order_by('jumlah_semua_nilai','asc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		
		return $query;       
    }
    
    function siswa_terdaftar_semua_laki_laki_terendah($perPage, $uri){	
		$this->db->where('jk','laki-laki');
		$this->db->order_by('jumlah_semua_nilai','asc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_semua_perempuan_terendah($perPage, $uri){	
		$this->db->where('jk','perempuan');
		$this->db->order_by('jumlah_semua_nilai','asc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_diteriman_terendah($perPage, $uri){	
		$this->db->where('status','Diterima');
		$this->db->order_by('jumlah_semua_nilai','asc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    function siswa_terdaftar_blm_diterima_terendah($perPage, $uri){	
		$this->db->where('status','Belum Diterima');
		$this->db->order_by('jumlah_semua_nilai','asc');
		$query = $getData = $this->db->get('siswa', $perPage, $uri);
		return $query;
    }
    //batas
	public function get_data($id){
			$sql= "select * from siswa where id_siswa = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}

	public function id_rapor_ijazah($id){
			$sql= "select * from ijazah where ijazah = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function id_rapor_kls4_sm1($id){
			$sql= "select * from kls4_sm1 where id_kls4_sm1 = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function id_rapor_kls4_sm2($id){
			$sql= "select * from kls4_sm2 where id_kls4_sm2 = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function id_rapor_kls5_sm1($id){
			$sql= "select * from kls5_sm1 where id_kls5_sm1 = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function id_rapor_kls5_sm2($id){
			$sql= "select * from kls5_sm2 where id_kls5_sm2 = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function id_rapor_kls6_sm1($id){
			$sql= "select * from kls6_sm1 where id_kls6_sm1 = '".$id. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
    function cari($cari){
        $this->db->like('nisn',$cari);
        $this->db->or_like("nama",$cari);
        return $this->db->get('siswa');
    }
 public function terima_siswa($id){
		$tanggal = date('Y-m-d');
		$status ="Diterima";
          $data = array(
			'status' => $status,
			'tgl_diterima' => $tanggal
        );
 $this->db->update('siswa', $data, "id_siswa =".$id); 
    }
 public function batal_terima_siswa($id){
		$tanggal = "";
		$status ="Belum Diterima";
          $data = array(
			'status' => $status,
			'tgl_diterima' => $tanggal
        );
 $this->db->update('siswa', $data, "id_siswa =".$id); 
    }
	public function cari_jumlah($id){
			$sql= "select jumlah_semua_nilai from siswa where id_siswa='$id' LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function atur_jadwal(){
		$id_tanggal="1";
			$atur_jadwal_pendaaftaran = array(
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_tutup' => $this->input->post('tgl_tutup')
		);
		 $this->db->update('tgl_pendaftaran', $atur_jadwal_pendaaftaran, "id_atur_tgl =".$id_tanggal); 
	}
	public function lihat_atur_jadwal(){
		$id_tanggal="1";
			$sql= "select * from tgl_pendaftaran where id_atur_tgl = '".$id_tanggal. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function lihat_atur_admin(){
			$sql= "select * from admin where id_admin = 'admin'LIMIT 1";
			return $this->db->query($sql)->row();
	}

	public function atur_kuota(){
		$id_tanggal="1";
			$atur_kuota = array(
			'kuota' => $this->input->post('kuota')
		);
		 $this->db->update('tgl_pendaftaran', $atur_kuota, "id_atur_tgl =".$id_tanggal); 
	}
	public function metode_penerimaan($metode){
		$id_tanggal="1";
			$atur_kuota = array(
			'metode_penerimaan' => $metode
		);
		 $this->db->update('tgl_pendaftaran', $atur_kuota, "id_atur_tgl =".$id_tanggal); 
	}
	public function get_kuota(){
			$sql= "select kuota from tgl_pendaftaran where id_atur_tgl = '1'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	
	public function hapus_ijazah($id){
     $sql_hapus = "delete from ijazah where ijazah = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_kls4_sm1($id){
     $sql_hapus = "delete from kls4_sm1 where id_kls4_sm1 = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_kls4_sm2($id){
     $sql_hapus = "delete from kls4_sm2 where id_kls4_sm2 = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_kls5_sm1($id){
     $sql_hapus = "delete from kls5_sm1 where id_kls5_sm1 = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_kls5_sm2($id){
     $sql_hapus = "delete from kls5_sm2 where id_kls5_sm2 = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_kls6_sm1($id){
     $sql_hapus = "delete from kls6_sm1 where id_kls6_sm1 = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);
	}
	public function hapus_siswa($id){
     $sql_hapus = "delete from siswa where id_siswa = '".$id."'LIMIT 1";
        return $this->db->query($sql_hapus);       
	}
    function cek($id){
        $this->db->where('id_siswa',$id);
        $query=$this->db->get('siswa');
        
        return $query;
    }
    
	public function atur_admin(){
		
		$atur_admin = array(
			'nama' => $this->input->post('nama'),
			'password_admin' => $this->input->post('password'),			
			'email_address' => $this->input->post('email_address')		
		);
		 $this->db->update('admin', $atur_admin); 
	}
	
	

}
