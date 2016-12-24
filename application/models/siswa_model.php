<?php

class siswa_model extends CI_Model {

	public function get_email($id_siswa_login_cari){
			$sql= "select * from siswa where email_address = '".$id_siswa_login_cari. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function cari_jumlah($id){
			$sql= "select jumlah_semua_nilai from siswa where id_siswa='$id' LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function cari_siswa_diterima($id){
			$sql= "select * from siswa where id_siswa='$id' and status='Diterima' LIMIT 1";
			return $this->db->query($sql)->row();
	}
	public function get_id($email){
			$sql= "select * from siswa where id_siswa = '".$email. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}


  public function edit_profil($id){
             if(!$this->upload->do_upload('gambar')){
                    $gambar=$this->input->post('image');
                }else{
			$detail=$this->cek($id)->result();
			foreach($detail as $det):
				unlink("assets/img/siswa/".$det->image);
			endforeach;
     
                    $gambar=$this->upload->file_name;
                }    
        $data = array(
			'nama' => $this->input->post('nama'),
			'password' => md5($this->input->post('password')),			
			'jk' => $this->input->post('jk'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'agama' => $this->input->post('agama'),
			'alamat' => $this->input->post('alamat'),
			'phone' => $this->input->post('phone'),
			'nama_sekolah' => $this->input->post('nama_sekolah'),
			'alamat_sekolah' => $this->input->post('alamat_sekolah'),
			'ayah' => $this->input->post('ayah'),
			'ibu' => $this->input->post('ibu'),
			'alamat_ortu' => $this->input->post('alamat_ortu'),
			'pekerjaan_ortu' => $this->input->post('pekerjaan_ortu'),
			'image' =>$gambar
        );
 $this->db->update('siswa', $data, "id_siswa =".$id); 
    }
  public function edit_profil1($id){
             if(!$this->upload->do_upload('gambar')){
                    $gambar=$this->input->post('image');
                }else{
					  $gambar_hapus=$this->input->post('image');
					 unlink("assets/img/siswa/".$det->$gambar_hapus);
                    $gambar=$this->upload->file_name;
                   
                }    
        $data = array(
			'nama' => $this->input->post('nama'),
			'password' => md5($this->input->post('password')),		
			'email_address' => $this->input->post('email_address'),		
			'jk' => $this->input->post('jk'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'agama' => $this->input->post('agama'),
			'alamat' => $this->input->post('alamat'),
			'phone' => $this->input->post('phone'),
			'nama_sekolah' => $this->input->post('nama_sekolah'),
			'alamat_sekolah' => $this->input->post('alamat_sekolah'),
			'ayah' => $this->input->post('ayah'),
			'ibu' => $this->input->post('ibu'),
			'alamat_ortu' => $this->input->post('alamat_ortu'),
			'pekerjaan_ortu' => $this->input->post('pekerjaan_ortu'),
			'image' =>$gambar
        );
 $this->db->update('siswa', $data, "id_siswa =".$id); 
    }
  public function edit_profil2($id){
             if(!$this->upload->do_upload('gambar')){
                    $gambar=$this->input->post('image');
                }else{
                    $gambar=$this->upload->file_name;
                }    
        $data = array(
			'nisn' => $this->input->post('nisn'),
			'nama' => $this->input->post('nama'),
			'password' => md5($this->input->post('password')),		
			'jk' => $this->input->post('jk'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'agama' => $this->input->post('agama'),
			'alamat' => $this->input->post('alamat'),
			'phone' => $this->input->post('phone'),
			'nama_sekolah' => $this->input->post('nama_sekolah'),
			'alamat_sekolah' => $this->input->post('alamat_sekolah'),
			'ayah' => $this->input->post('ayah'),
			'ibu' => $this->input->post('ibu'),
			'alamat_ortu' => $this->input->post('alamat_ortu'),
			'pekerjaan_ortu' => $this->input->post('pekerjaan_ortu'),
			'image' =>$gambar
        );
 $this->db->update('siswa', $data, "id_siswa =".$id); 
    }


	function isi_rapor_izajah($id){
		$pend_agama4_1=$this->input->post('pend_agama4_1');
		$b_indo4_1=$this->input->post('b_indo4_1');
		$mtk4_1=$this->input->post('mtk4_1');
		$ipa4_1=$this->input->post('ipa4_1');
		$ips4_1=$this->input->post('ips4_1');
		$pkn4_1=$this->input->post('pkn4_1');
		$b_inggris4_1=$this->input->post('b_inggris4_1');
		$penjaskesor4_1=$this->input->post('penjaskesor4_1');
		$jumlah4_1=$this->input->post('jumlah4_1');
		$rata_rata4_1=$this->input->post('rata_rata4_1');
	$jumlahkls4_1=($pend_agama4_1+$b_indo4_1+$mtk4_1+$ipa4_1+$ips4_1+$pkn4_1+$b_inggris4_1+$penjaskesor4_1);
	$rata_ratakls4_1=($pend_agama4_1+$b_indo4_1+$mtk4_1+$ipa4_1+$ips4_1+$pkn4_1+$b_inggris4_1+$penjaskesor4_1)/8;
	
		$pend_agama4_2=$this->input->post('pend_agama4_2');
		$b_indo4_2=$this->input->post('b_indo4_2');
		$mtk4_2=$this->input->post('mtk4_2');
		$ipa4_2=$this->input->post('ipa4_2');
		$ips4_2=$this->input->post('ips4_2');
		$pkn4_2=$this->input->post('pkn4_2');
		$b_inggris4_2=$this->input->post('b_inggris4_2');
		$penjaskesor4_2=$this->input->post('penjaskesor4_2');
		$jumlah4_2=$this->input->post('jumlah4_2');
		$rata_rata4_2=$this->input->post('rata_rata4_2');
	$jumlahkls4_2=($pend_agama4_2+$b_indo4_2+$mtk4_2+$ipa4_2+$ips4_2+$pkn4_2+$b_inggris4_2+$penjaskesor4_2);
	$rata_ratakls4_2=($pend_agama4_2+$b_indo4_2+$mtk4_2+$ipa4_2+$ips4_2+$pkn4_2+$b_inggris4_2+$penjaskesor4_2)/8;

		$pend_agama5_1=$this->input->post('pend_agama5_1');
		$b_indo5_1=$this->input->post('b_indo5_1');
		$mtk5_1=$this->input->post('mtk5_1');
		$ipa5_1=$this->input->post('ipa5_1');
		$ips5_1=$this->input->post('ips5_1');
		$pkn5_1=$this->input->post('pkn5_1');
		$b_inggris5_1=$this->input->post('b_inggris5_1');
		$penjaskesor5_1=$this->input->post('penjaskesor5_1');
		$jumlah5_1=$this->input->post('jumlah5_1');
		$rata_rata5_1=$this->input->post('rata_rata5_1');
	$jumlahkls5_1=($pend_agama5_1+$b_indo5_1+$mtk5_1+$ipa5_1+$ips5_1+$pkn5_1+$b_inggris5_1+$penjaskesor5_1);
	$rata_ratakls5_1=($pend_agama5_1+$b_indo5_1+$mtk5_1+$ipa5_1+$ips5_1+$pkn5_1+$b_inggris5_1+$penjaskesor5_1)/8;

		$pend_agama5_2=$this->input->post('pend_agama5_2');
		$b_indo5_2=$this->input->post('b_indo5_2');
		$mtk5_2=$this->input->post('mtk5_2');
		$ipa5_2=$this->input->post('ipa5_2');
		$ips5_2=$this->input->post('ips5_2');
		$pkn5_2=$this->input->post('pkn5_2');
		$b_inggris5_2=$this->input->post('b_inggris5_2');
		$penjaskesor5_2=$this->input->post('penjaskesor5_2');
		$jumlah5_2=$this->input->post('jumlah5_2');
		$rata_rata5_2=$this->input->post('rata_rata5_2');
	$jumlahkls5_2=($pend_agama5_2+$b_indo5_2+$mtk5_2+$ipa5_2+$ips5_2+$pkn5_2+$b_inggris5_2+$penjaskesor5_2);
	$rata_ratakls5_2=($pend_agama5_2+$b_indo5_2+$mtk5_2+$ipa5_2+$ips5_2+$pkn5_2+$b_inggris5_2+$penjaskesor5_2)/8;

		$pend_agama6_1=$this->input->post('pend_agama6_1');
		$b_indo6_1=$this->input->post('b_indo6_1');
		$mtk6_1=$this->input->post('mtk6_1');
		$ipa6_1=$this->input->post('ipa6_1');
		$ips6_1=$this->input->post('ips6_1');
		$pkn6_1=$this->input->post('pkn6_1');
		$b_inggris6_1=$this->input->post('b_inggris6_1');
		$penjaskesor6_1=$this->input->post('penjaskesor6_1');
		$jumlah6_1=$this->input->post('jumlah6_1');
		$rata_rata6_1=$this->input->post('rata_rata6_1');
	$jumlahkls6_1=($pend_agama6_1+$b_indo6_1+$mtk6_1+$ipa6_1+$ips6_1+$pkn6_1+$b_inggris6_1+$penjaskesor6_1);
	$rata_ratakls6_1=($pend_agama6_1+$b_indo6_1+$mtk6_1+$ipa6_1+$ips6_1+$pkn6_1+$b_inggris6_1+$penjaskesor6_1)/8;

		$b_indo_i=$this->input->post('b_indo_i');
		$ipa_i=$this->input->post('ipa_i');
		$mtk_i=$this->input->post('mtk_i');
	$jumlah_i=($b_indo_i+$ipa_i+$mtk_i);
	$rata_rata_i=($b_indo_i+$ipa_i+$mtk_i)/3;

		$kls4_sm1 = array(
			'pend_agama4_1' => $pend_agama4_1,
			'b_indo4_1' => $b_indo4_1,	
			'mtk4_1' => $mtk4_1,			
			'ipa4_1' => $ipa4_1,
			'ips4_1' => $ips4_1,
			'pkn4_1' => $pkn4_1,
			'b_inggris4_1' => $b_inggris4_1,
			'penjaskesor4_1' => $penjaskesor4_1,
			'jumlah4_1' => $jumlahkls4_1,
			'rata_rata4_1' => $rata_ratakls4_1
		);
		 $this->db->update('kls4_sm1', $kls4_sm1, "id_kls4_sm1 =".$id); 
		
		$ijazah = array(
			'b_indo_i' => $b_indo_i,
			'ipa_i' => $ipa_i,			
			'mtk_i' => $mtk_i,
			'jumlah_i' => $jumlah_i,
			'rata_rata_i' => $rata_rata_i
		);
		$this->db->update('ijazah', $ijazah, "ijazah =".$id); 
		
		$kls4_sm2 = array(
			'pend_agama4_2' => $pend_agama4_2,
			'b_indo4_2' => $b_indo4_2,	
			'mtk4_2' => $mtk4_2,			
			'ipa4_2' => $ipa4_2,
			'ips4_2' => $ips4_2,
			'pkn4_2' => $pkn4_2,
			'b_inggris4_2' => $b_inggris4_2,
			'penjaskesor4_2' => $penjaskesor4_2,
			'jumlah4_2' => $jumlahkls4_2,
			'rata_rata4_2' => $rata_ratakls4_2
		);
		$this->db->update('kls4_sm2', $kls4_sm2, "id_kls4_sm2 =".$id); 
		

		$kls5_sm1 = array(
			'pend_agama5_1' => $pend_agama5_1,
			'b_indo5_1' => $b_indo5_1,	
			'mtk5_1' => $mtk5_1,			
			'ipa5_1' => $ipa5_1,
			'ips5_1' => $ips5_1,
			'pkn5_1' => $pkn5_1,
			'b_inggris5_1' => $b_inggris5_1,
			'penjaskesor5_1' => $penjaskesor5_1,
			'jumlah5_1' => $jumlahkls5_1,
			'rata_rata5_1' => $rata_ratakls5_1
		);
		$this->db->update('kls5_sm1', $kls5_sm1, "id_kls5_sm1 =".$id); 
		

		
		$kls5_sm2 = array(
			'pend_agama5_2' => $pend_agama5_2,
			'b_indo5_2' => $b_indo5_2,	
			'mtk5_2' => $mtk5_2,			
			'ipa5_2' => $ipa5_2,
			'ips5_2' => $ips5_2,
			'pkn5_2' => $pkn5_2,
			'b_inggris5_2' => $b_inggris5_2,
			'penjaskesor5_2' => $penjaskesor5_2,
			'jumlah5_2' => $jumlahkls5_2,
			'rata_rata5_2' => $rata_ratakls5_2
		);
		$this->db->update('kls5_sm2', $kls5_sm2, "id_kls5_sm2 =".$id);
	
		
		$kls6_sm1 = array(
			'pend_agama6_1' => $pend_agama6_1,
			'b_indo6_1' => $b_indo6_1,	
			'mtk6_1' => $mtk6_1,			
			'ipa6_1' => $ipa6_1,
			'ips6_1' => $ips6_1,
			'pkn6_1' => $pkn6_1,
			'b_inggris6_1' => $b_inggris6_1,
			'penjaskesor6_1' => $penjaskesor6_1,
			'jumlah6_1' => $jumlahkls6_1,
			'rata_rata6_1' => $rata_ratakls6_1
		);
		$this->db->update('kls6_sm1', $kls6_sm1, "id_kls6_sm1 =".$id);
		
	/*	$tanggal_konfirmasi = date('Y-m-d');
		$bukti_pendaftaran = array(
			'tanggal_konfirmasi' => $tanggal_konfirmasi
		);
		$this->db->update('bukti_pendaftaran', $bukti_pendaftaran, "id_siswa =".$id);
	*/	
		
		$jumlah_semua=($jumlahkls4_1+$jumlahkls4_2+$jumlahkls5_1+$jumlahkls5_2+$jumlah6_1+$jumlah_i);
       $jumlah_seluruh = array(
			'jumlah_semua_nilai' => $jumlah_semua
        );
 $this->db->update('siswa', $jumlah_seluruh, "id_siswa =".$id); 
	}
	
    function cek($id){
        $this->db->where('id_siswa',$id);
        $query=$this->db->get('siswa');
        
        return $query;
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
   public function edit_rapor_izajah($id){
		$pend_agama4_1=$this->input->post('pend_agama4_1');
		$b_indo4_1=$this->input->post('b_indo4_1');
		$mtk4_1=$this->input->post('mtk4_1');
		$ipa4_1=$this->input->post('ipa4_1');
		$ips4_1=$this->input->post('ips4_1');
		$pkn4_1=$this->input->post('pkn4_1');
		$b_inggris4_1=$this->input->post('b_inggris4_1');
		$penjaskesor4_1=$this->input->post('penjaskesor4_1');
		$jumlah4_1=$this->input->post('jumlah4_1');
		$rata_rata4_1=$this->input->post('rata_rata4_1');
	$jumlahkls4_1=($pend_agama4_1+$b_indo4_1+$mtk4_1+$ipa4_1+$ips4_1+$pkn4_1+$b_inggris4_1+$penjaskesor4_1);
	$rata_ratakls4_1=($pend_agama4_1+$b_indo4_1+$mtk4_1+$ipa4_1+$ips4_1+$pkn4_1+$b_inggris4_1+$penjaskesor4_1)/8;
	
        $data_kls4_sm1 = array(
       		'pend_agama4_1'=>$pend_agama4_1,
			'b_indo4_1'=>$b_indo4_1,
			'mtk4_1'=>$mtk4_1,
			'ipa4_1'=>$ipa4_1,
			'ips4_1'=>$ips4_1,
			'pkn4_1'=>$pkn4_1,
			'b_inggris4_1'=>$b_inggris4_1,
			'penjaskesor4_1'=>$penjaskesor4_1,
			'jumlah4_1'=>$jumlahkls4_1,
			'rata_rata4_1'=>$rata_ratakls4_1
        );
 $this->db->update('kls4_sm1', $data_kls4_sm1, "id_kls4_sm1 =".$id); 
 
 $pend_agama4_2=$this->input->post('pend_agama4_2');
		$b_indo4_2=$this->input->post('b_indo4_2');
		$mtk4_2=$this->input->post('mtk4_2');
		$ipa4_2=$this->input->post('ipa4_2');
		$ips4_2=$this->input->post('ips4_2');
		$pkn4_2=$this->input->post('pkn4_2');
		$b_inggris4_2=$this->input->post('b_inggris4_2');
		$penjaskesor4_2=$this->input->post('penjaskesor4_2');
		$jumlah4_2=$this->input->post('jumlah4_2');
		$rata_rata4_2=$this->input->post('rata_rata4_2');
	$jumlahkls4_2=($pend_agama4_2+$b_indo4_2+$mtk4_2+$ipa4_2+$ips4_2+$pkn4_2+$b_inggris4_2+$penjaskesor4_2);
	$rata_ratakls4_2=($pend_agama4_2+$b_indo4_2+$mtk4_2+$ipa4_2+$ips4_2+$pkn4_2+$b_inggris4_2+$penjaskesor4_2)/8;
	
        $data_kls4_sm2 = array(
       		'pend_agama4_2'=>$pend_agama4_2,
			'b_indo4_2'=>$b_indo4_2,
			'mtk4_2'=>$mtk4_2,
			'ipa4_2'=>$ipa4_2,
			'ips4_2'=>$ips4_2,
			'pkn4_2'=>$pkn4_2,
			'b_inggris4_2'=>$b_inggris4_2,
			'penjaskesor4_2'=>$penjaskesor4_2,
			'jumlah4_2'=>$jumlahkls4_2,
			'rata_rata4_2'=>$rata_ratakls4_2
        );
 $this->db->update('kls4_sm2', $data_kls4_sm2, "id_kls4_sm2 =".$id); 
 
 $pend_agama5_1=$this->input->post('pend_agama5_1');
		$b_indo5_1=$this->input->post('b_indo5_1');
		$mtk5_1=$this->input->post('mtk5_1');
		$ipa5_1=$this->input->post('ipa5_1');
		$ips5_1=$this->input->post('ips5_1');
		$pkn5_1=$this->input->post('pkn5_1');
		$b_inggris5_1=$this->input->post('b_inggris5_1');
		$penjaskesor5_1=$this->input->post('penjaskesor5_1');
		$jumlah5_1=$this->input->post('jumlah5_1');
		$rata_rata5_1=$this->input->post('rata_rata5_1');
	$jumlahkls5_1=($pend_agama5_1+$b_indo5_1+$mtk5_1+$ipa5_1+$ips5_1+$pkn5_1+$b_inggris5_1+$penjaskesor5_1);
	$rata_ratakls5_1=($pend_agama5_1+$b_indo5_1+$mtk5_1+$ipa5_1+$ips5_1+$pkn5_1+$b_inggris5_1+$penjaskesor5_1)/8;
	
        $data_kls5_sm1 = array(
       		'pend_agama5_1'=>$pend_agama5_1,
			'b_indo5_1'=>$b_indo5_1,
			'mtk5_1'=>$mtk5_1,
			'ipa5_1'=>$ipa5_1,
			'ips5_1'=>$ips5_1,
			'pkn5_1'=>$pkn5_1,
			'b_inggris5_1'=>$b_inggris5_1,
			'penjaskesor5_1'=>$penjaskesor5_1,
			'jumlah5_1'=>$jumlahkls5_1,
			'rata_rata5_1'=>$rata_ratakls5_1
        );
 $this->db->update('kls5_sm1', $data_kls5_sm1, "id_kls5_sm1 =".$id); 

$pend_agama5_2=$this->input->post('pend_agama5_2');
		$b_indo5_2=$this->input->post('b_indo5_2');
		$mtk5_2=$this->input->post('mtk5_2');
		$ipa5_2=$this->input->post('ipa5_2');
		$ips5_2=$this->input->post('ips5_2');
		$pkn5_2=$this->input->post('pkn5_2');
		$b_inggris5_2=$this->input->post('b_inggris5_2');
		$penjaskesor5_2=$this->input->post('penjaskesor5_2');
		$jumlah5_2=$this->input->post('jumlah5_2');
		$rata_rata5_2=$this->input->post('rata_rata5_2');
	$jumlahkls5_2=($pend_agama5_2+$b_indo5_2+$mtk5_2+$ipa5_2+$ips5_2+$pkn5_2+$b_inggris5_2+$penjaskesor5_2);
	$rata_ratakls5_2=($pend_agama5_2+$b_indo5_2+$mtk5_2+$ipa5_2+$ips5_2+$pkn5_2+$b_inggris5_2+$penjaskesor5_2)/8;
	
        $data_kls5_sm2 = array(
       		'pend_agama5_2'=>$pend_agama5_2,
			'b_indo5_2'=>$b_indo5_2,
			'mtk5_2'=>$mtk5_2,
			'ipa5_2'=>$ipa5_2,
			'ips5_2'=>$ips5_2,
			'pkn5_2'=>$pkn5_2,
			'b_inggris5_2'=>$b_inggris5_2,
			'penjaskesor5_2'=>$penjaskesor5_2,
			'jumlah5_2'=>$jumlahkls5_2,
			'rata_rata5_2'=>$rata_ratakls5_2
        );
 $this->db->update('kls5_sm2', $data_kls5_sm2, "id_kls5_sm2 =".$id); 

$pend_agama6_1=$this->input->post('pend_agama6_1');
		$b_indo6_1=$this->input->post('b_indo6_1');
		$mtk6_1=$this->input->post('mtk6_1');
		$ipa6_1=$this->input->post('ipa6_1');
		$ips6_1=$this->input->post('ips6_1');
		$pkn6_1=$this->input->post('pkn6_1');
		$b_inggris6_1=$this->input->post('b_inggris6_1');
		$penjaskesor6_1=$this->input->post('penjaskesor6_1');
		$jumlah6_1=$this->input->post('jumlah6_1');
		$rata_rata6_1=$this->input->post('rata_rata6_1');
	$jumlahkls6_1=($pend_agama6_1+$b_indo6_1+$mtk6_1+$ipa6_1+$ips6_1+$pkn6_1+$b_inggris6_1+$penjaskesor6_1);
	$rata_ratakls6_1=($pend_agama6_1+$b_indo6_1+$mtk6_1+$ipa6_1+$ips6_1+$pkn6_1+$b_inggris6_1+$penjaskesor6_1)/8;
	
        $data_kls6_sm1 = array(
       		'pend_agama6_1'=>$pend_agama6_1,
			'b_indo6_1'=>$b_indo6_1,
			'mtk6_1'=>$mtk6_1,
			'ipa6_1'=>$ipa6_1,
			'ips6_1'=>$ips6_1,
			'pkn6_1'=>$pkn6_1,
			'b_inggris6_1'=>$b_inggris6_1,
			'penjaskesor6_1'=>$penjaskesor6_1,
			'jumlah6_1'=>$jumlahkls6_1,
			'rata_rata6_1'=>$rata_ratakls6_1
        );
 $this->db->update('kls6_sm1', $data_kls6_sm1, "id_kls6_sm1 =".$id); 
 
 $b_indo_i=$this->input->post('b_indo_i');
		$ipa_i=$this->input->post('ipa_i');
		$mtk_i=$this->input->post('mtk_i');
	$jumlah_i=($b_indo_i+$ipa_i+$mtk_i);
	$rata_rata_i=($b_indo_i+$ipa_i+$mtk_i)/3;


		$ijazah = array(
			'b_indo_i' => $b_indo_i,
			'ipa_i' => $ipa_i,			
			'mtk_i' => $mtk_i,
			'jumlah_i' => $jumlah_i,
			'rata_rata_i' => $rata_rata_i
		);
		$kls4_sm1= $this->db->update('ijazah', $ijazah, "ijazah =".$id);

		$jumlah_semua=($jumlahkls4_1+$jumlahkls4_2+$jumlahkls5_1+$jumlahkls5_2+$jumlah6_1+$jumlah_i);
       $jumlah_seluruh = array(
			'jumlah_semua_nilai' => $jumlah_semua
        );
 $this->db->update('siswa', $jumlah_seluruh, "id_siswa =".$id); 
 
    }
   
    
}
