<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View Data Usulan POS</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['no']) ? urlencode($data['no']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-nama_pengusul">
                                        <th class="title"> Nama Pengusul: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("tb_karyawan/view/" . urlencode($data['nama_pengusul'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['tb_karyawan_nama_karyawan'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-kd_unit">
                                        <th class="title"> Unit Kerja: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("tb_unitkerja/view/" . urlencode($data['kd_unit'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['tb_unitkerja_nama_unit'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_pos">
                                        <th class="title"> Nama Pos: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['nama_pos']; ?>" 
                                                data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="nama_pos" 
                                                data-title="Tulis Nama Pos" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['nama_pos']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="fa fa-ban"></i> No Record Found
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
