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
                    <h4 class="record-title"></h4>
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
                            <table border="1" style="height: auto">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-no">
                                        <td valign="top" rowspan="6" class="title" width="55%"> <center><img src="http://localhost:8080/pospnc/verif/uploads/photos/tutwuri.png" width="150" /><br>
                                            <h4>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN </h4>
                                            </td>
                                        <td class="value"width="15%" style="font-weight: bold"> Nomor POS</td>
                                        <td>:</td>
                                        <td class="value"width="30%" ><?php echo $data['nomor_pos']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="title" style="font-weight: bold"> Tanggal Pembuatan </td>
                                        <td>:</td>
                                        <td class="value"width="30%">
                                            <?php echo date('d-M-Y',strtotime($data['tgl_pembuatan'])); ?></td>
                                    </tr>
                                     <tr>
                                        <td class="title" style="font-weight: bold"> Tanggal Revisi </td>
                                        <td>:</td>
                                        <td class="value"width="30%">
                                            <?php echo date('d-M-Y',strtotime($data['tgl_revisi'])); ?></td>
                                    </tr>
                                     <tr>
                                        <td class="title" style="font-weight: bold"> Tanggal Efektif </td>
                                        <td>:</td>
                                        <td class="value"width="30%">
                                            <?php echo date('d-M-Y',strtotime($data['tgl_efektif'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="title" style="font-weight: bold"> Disahkan Oleh </td>
                                        <td>:</td>
                                        <td class="value"width="30%" style="font-weight: bold" align="center"><br><br><br><br><br>
                                            <u><?php echo $data['disahkan']; ?></u></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold"> Nama POS </td>
                                        <td>:</td>
                                        <td class="value"width="30%">
                                            <?php echo $data['nama_pos']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold"> Dasar Hukum: </td>
                                        <td colspan="3" style="font-weight: bold"> Kualifikasi Pelaksana: </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                           <?php echo nl2br($data['dasar_hukum']); ?>
                                        </td>
                                    <td colspan="3" valign="top">
                                           <?php echo nl2br($data['kualifikasi_pelaksana']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold"> Keterkaitan: </td>
                                        <td colspan="3" style="font-weight: bold"> Peralatan/Perlengkapan: </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                           <?php echo nl2br($data['keterkaitan']); ?>
                                        </td>
                                    <td colspan="3" valign="top">
                                           <?php echo nl2br($data['peralatan']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold"> Peringatan: </td>
                                        <td colspan="3" style="font-weight: bold"> Pencatatan dan Pendataan: </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                           <?php echo nl2br($data['peringatan']); ?>
                                        </td>
                                    <td colspan="3" valign="top">
                                           <?php echo nl2br($data['pencatatan']); ?>
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
