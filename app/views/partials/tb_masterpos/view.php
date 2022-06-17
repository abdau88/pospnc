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
                    <h4 class="record-title">View Pengajuan POS</h4>
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
                                                <?php echo $data['tb_karyawan_nama_karyawan'] ?>
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
                                    <tr  class="td-nomor_pos">
                                        <th class="title"> Nomor Pos: </th>
                                        <td class="value"> <?php echo $data['nomor_pos']; ?></td>
                                    </tr>
                                    <tr  class="td-tgl_pembuatan">
                                        <th class="title"> Tgl Pembuatan: </th>
                                        <td class="value"> <?php echo $data['tgl_pembuatan']; ?></td>
                                    </tr>
                                    <tr  class="td-tgl_revisi">
                                        <th class="title"> Tgl Revisi: </th>
                                        <td class="value"> <?php echo $data['tgl_revisi']; ?></td>
                                    </tr>
                                    <tr  class="td-tgl_efektif">
                                        <th class="title"> Tgl Efektif: </th>
                                        <td class="value"> <?php echo $data['tgl_efektif']; ?></td>
                                    </tr>
                                    <tr  class="td-disahkan">
                                        <th class="title"> Disahkan: </th>
                                        <td class="value"> <?php echo $data['disahkan']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_pos">
                                        <th class="title"> Nama Pos: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-dasar_hukum">
                                        <th class="title"> Dasar Hukum: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="dasar_hukum" 
                                                data-title="Enter Dasar Hukum" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dasar_hukum']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-keterkaitan">
                                        <th class="title"> Keterkaitan: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="keterkaitan" 
                                                data-title="Enter Keterkaitan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['keterkaitan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kualifikasi_pelaksana">
                                        <th class="title"> Kualifikasi Pelaksana: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="kualifikasi_pelaksana" 
                                                data-title="Enter Kualifikasi Pelaksana" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['kualifikasi_pelaksana']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-peralatan">
                                        <th class="title"> Peralatan: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="peralatan" 
                                                data-title="Enter Peralatan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['peralatan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-flowmap">
                                        <th class="title"> Flowmap: </th>
                                        <td class="value"><?php Html :: page_link_file($data['flowmap']); ?></td>
                                    </tr>
                                    <tr  class="td-verifikasi">
                                        <th class="title"> Status Verifikasi: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $verifikasi); ?>' 
                                                data-value="<?php echo $data['verifikasi']; ?>" 
                                                data-pk="<?php echo $data['no'] ?>" 
                                                data-url="<?php print_link("tb_masterpos/editfield/" . urlencode($data['no'])); ?>" 
                                                data-name="verifikasi" 
                                                data-title="Enter Revisi (Wajib Ceklist)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="radiolist" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['verifikasi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("tb_masterpos/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("tb_masterpos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
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
