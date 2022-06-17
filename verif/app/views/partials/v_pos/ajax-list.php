<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['']) ? urlencode($data['']) : null);
$counter++;
?>
<tr>
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-no"> <?php echo $data['no']; ?></td>
    <td class="td-nama_karyawan"> <?php echo $data['nama_karyawan']; ?></td>
    <td class="td-tgl_pembuatan"> <?php echo $data['tgl_pembuatan']; ?></td>
    <td class="td-tgl_revisi"> <?php echo $data['tgl_revisi']; ?></td>
    <td class="td-tgl_efektif"> <?php echo $data['tgl_efektif']; ?></td>
    <td class="td-disahkan"> <?php echo $data['disahkan']; ?></td>
    <td class="td-nama_pos"> <?php echo $data['nama_pos']; ?></td>
    <td class="td-dasar_hukum"> <?php echo $data['dasar_hukum']; ?></td>
    <td class="td-kualifikasi_pelaksana"> <?php echo $data['kualifikasi_pelaksana']; ?></td>
    <td class="td-keterkaitan"> <?php echo $data['keterkaitan']; ?></td>
    <td class="td-peralatan"> <?php echo $data['peralatan']; ?></td>
</tr>
<?php 
}
?>
<?php
} else {
?>
<td class="no-record-found col-12" colspan="100">
    <h4 class="text-muted text-center ">
        No Record Found
    </h4>
</td>
<?php
}
?>
