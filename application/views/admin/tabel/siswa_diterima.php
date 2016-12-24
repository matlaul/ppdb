<div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Siswa Diterima
        </div>
        <div class="card-body no-padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Asal Sekolah</th>
                  <th>Status</th>
                  <th>Jumlah Rapor</th>
                  <th>Jumlah UN</th>
                  <th>Jumlah Nilai</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <?php
                $i=1;
                foreach($urutkan_siswa->result() as $row):

                    $id = $row->id_siswa;;
                      $sql="select jumlah4_1 from kls4_sm1 where id_kls4_sm1 = '".$id. "'LIMIT 1";
                        $id_kls4_sm1 = $this->db->query($sql)->result();
                    
                      $sql_id_kls4_sm2="select jumlah4_2 from kls4_sm2 where id_kls4_sm2 = '".$id. "'LIMIT 1";
                        $id_kls4_sm2 = $this->db->query($sql_id_kls4_sm2)->result();
                        
                      $sql_id_kls5_sm1="select jumlah5_1 from kls5_sm1 where id_kls5_sm1 = '".$id. "'LIMIT 1";
                        $id_kls5_sm1 = $this->db->query($sql_id_kls5_sm1)->result();
                        
                      $sql_id_kls5_sm2="select jumlah5_2 from kls5_sm2 where id_kls5_sm2 = '".$id. "'LIMIT 1";
                        $id_kls5_sm2 = $this->db->query($sql_id_kls5_sm2)->result();
                        
                      $sql_id_kls6_sm1="select jumlah6_1 from kls6_sm1 where id_kls6_sm1 = '".$id. "'LIMIT 1";
                        $id_kls6_sm1 = $this->db->query($sql_id_kls6_sm1)->result();
                        
                      $sql_ijazah="select jumlah_i from ijazah where ijazah = '".$id. "'LIMIT 1";
                        $id_ijazah = $this->db->query($sql_ijazah)->result();
              ?>
              <tbody>
                <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row->nisn;?></td>
                        <td><?php echo $row->nama;?></td>
                        <td><?php echo $row->nama_sekolah;?></td>
                        <td><?php echo $row->status;?></td>
                     <?php foreach($id_kls6_sm1 as $row5 ){?>
                    <td><?php echo $row5->jumlah6_1;}?></td>
                    
                    
                     <?php foreach($id_ijazah as $row6 ){?>
                    <td><?php echo $row6->jumlah_i;}?></td>
                    <td><?php echo $row->jumlah_semua_nilai;?></td>
                 <td><a href="<?php echo site_url('admin/lihat_detail/'.$id);?>"><i class="glyphicon glyphicon-search"></i></a></td>    
                 <?php  $i++; ?>
                <?php endforeach;  ?>
                 </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>