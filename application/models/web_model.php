<?php

class web_model extends CI_Model {

	public function get_tanggal_mendaftar(){
		$id_tanggal="1";
			$sql= "select * from tgl_pendaftaran where id_atur_tgl = '".$id_tanggal. "'LIMIT 1";
			return $this->db->query($sql)->row();
	}
	
	function create_member(){
                if(!$this->upload->do_upload('gambar')){
                    $gambar=$this->upload->file_name;
                }else{
                    $gambar=$this->upload->file_name;
                }    
        $jumlah_semua_nilai ="0";
		$tanggal = date('Y-m-d');
		$tanggal_diterima = "";
		$status ="Belum Diterima";
		$new_member_insert_data = array(
			'nisn' => $this->input->post('nisn'),
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
			'status' => $status,
			'tgl_daftar' =>$tanggal,
			'tgl_diterima' =>$tanggal_diterima,
			'image' => $gambar,
			'jumlah_semua_nilai' =>$jumlah_semua_nilai
		);
		$insert= $this->db->insert('siswa', $new_member_insert_data);
		//return $insert;
		
		$id_siswa_login_cari = $this->input->post('email_address');
		$data ['m'] = $this->siswa_model->get_email($id_siswa_login_cari);
		$id=$data['m']->id_siswa;

			$kls4_sm1 = array(
			'id_kls4_sm1' => $id,
			'pend_agama4_1' => "0",
			'b_indo4_1' => "0",
			'mtk4_1' => "0",		
			'ipa4_1' => "0",
			'ips4_1' => "0",
			'pkn4_1' => "0",
			'b_inggris4_1' => "0",
			'penjaskesor4_1' => "0",
			'jumlah4_1' => "0",
			'rata_rata4_1' => "0"
		);
		$kls4_sm1= $this->db->insert('kls4_sm1', $kls4_sm1);
		
		$ijazah = array(
			'ijazah' => $id,
			'b_indo_i' => "0",
			'ipa_i' => "0",		
			'mtk_i' => "0",
			'jumlah_i' => "0",
			'rata_rata_i' => "0"
		);
		$kls4_sm1= $this->db->insert('ijazah', $ijazah);
		
		$kls4_sm2 = array(
			'id_kls4_sm2' => $id,
			'pend_agama4_2' => "0",
			'b_indo4_2' => "0",
			'mtk4_2' => "0",		
			'ipa4_2' => "0",
			'ips4_2' => "0",
			'pkn4_2' => "0",
			'b_inggris4_2' => "0",
			'penjaskesor4_2' => "0",
			'jumlah4_2' => "0",
			'rata_rata4_2' =>"0"
		);
		$kls4_sm2= $this->db->insert('kls4_sm2', $kls4_sm2);
		

		$kls5_sm1 = array(
			'id_kls5_sm1' => $id,
			'pend_agama5_1' => "0",
			'b_indo5_1' => "0",
			'mtk5_1' => "0",			
			'ipa5_1' => "0",
			'ips5_1' => "0",
			'pkn5_1' => "0",
			'b_inggris5_1' => "0",
			'penjaskesor5_1' => "0",
			'jumlah5_1' => "0",
			'rata_rata5_1' => "0"
		);
		$kls5_sm1= $this->db->insert('kls5_sm1', $kls5_sm1);
		

		
		$kls5_sm2 = array(
			'id_kls5_sm2' => $id,
			'pend_agama5_2' => "0",
			'b_indo5_2' => "0",
			'mtk5_2' => "0",			
			'ipa5_2' => "0",
			'ips5_2' => "0",
			'pkn5_2' => "0",
			'b_inggris5_2' => "0",
			'penjaskesor5_2' =>"0",
			'jumlah5_2' => "0",
			'rata_rata5_2' => "0"
		);
		$kls5_sm2= $this->db->insert('kls5_sm2', $kls5_sm2);
	
		
		$kls6_sm1 = array(
			'id_kls6_sm1' => $id,
			'pend_agama6_1' => "0",
			'b_indo6_1' => "0",
			'mtk6_1' => "0",			
			'ipa6_1' => "0",
			'ips6_1' =>"0",
			'pkn6_1' => "0",
			'b_inggris6_1' => "0",
			'penjaskesor6_1' => "0",
			'jumlah6_1' => "0",
			'rata_rata6_1' => "0"
		);
		$kls6_sm1= $this->db->insert('kls6_sm1', $kls6_sm1);
		
		
	 $jumlah_seluruh = array(
			'jumlah_semua_nilai' => "0"
        );
 $this->db->update('siswa', $jumlah_seluruh, "id_siswa =".$id); 
		
	
	}

}
