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
$rec_id = (!empty($data['no']) ? urlencode($data['no']) : null);
$counter++;
?>
<tr>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['no'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-nama_pengusul">
            <a size="sm" class="btn btn-secondary page-modal" href="<?php print_link("tb_karyawan/view/" . urlencode($data['nama_pengusul'])) ?>">
                <?php echo $data['tb_karyawan_nama_karyawan'] ?>
            </a>
        </td>
        <td class="td-kd_unit">
            <a size="sm" class="btn btn-white page-modal" href="<?php print_link("tb_unitkerja/view/" . urlencode($data['kd_unit'])) ?>">
                <?php echo $data['tb_unitkerja_nama_unit'] ?>
            </a>
        </td>
        <td class="td-nama_pos">
            <span  data-value="<?php echo $data['nama_pos']; ?>" 
                data-pk="<?php echo $data['no'] ?>" 
                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                data-name="nama_pos" 
                data-title="Enter Nama Pos" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['nama_pos']; ?> 
            </span>
        </td>
        <td class="td-flowmap"><?php Html :: page_link_file($data['flowmap']); ?></td>
        <td class="td-verifikasi">
            <span  data-source='<?php echo json_encode_quote(Menu :: $verifikasi); ?>' 
                data-value="<?php echo $data['verifikasi']; ?>" 
                data-pk="<?php echo $data['no'] ?>" 
                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                data-name="verifikasi" 
                data-title="Select a value ..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['verifikasi']; ?> 
            </span>
        </td>
        <td class="td-c_rev">
            <span  data-value="<?php echo $data['c_rev']; ?>" 
                data-pk="<?php echo $data['no'] ?>" 
                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                data-name="c_rev" 
                data-title="Catatan Revisi" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['c_rev']; ?> 
            </span>
        </td>
        <th class="td-btn">
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("tb_masterpos/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("tb_masterpos/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("tb_masterpos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
        </th>
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
    