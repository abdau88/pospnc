<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Tambah Usulan POS</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="tb_masterpos-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("tb_masterpos/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama_pengusul">Nama Pengusul <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <select required=""  id="ctrl-nama_pengusul" name="nama_pengusul"  placeholder="Ketik nama anda ..."    class="selectize" >
                                                    <option value="">Ketik nama anda ...</option>
                                                    <?php 
                                                    $nama_pengusul_options = $comp_model -> tb_masterpos_nama_pengusul_option_list();
                                                    if(!empty($nama_pengusul_options)){
                                                    foreach($nama_pengusul_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = $this->set_field_selected('nama_pengusul',$value, "");
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                        <?php echo $label; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="kd_unit">Unit Kerja <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <select required=""  id="ctrl-kd_unit" name="kd_unit"  placeholder="Pilih unit kerja ..."    class="selectize" >
                                                    <option value="">Pilih unit kerja ...</option>
                                                    <?php 
                                                    $kd_unit_options = $comp_model -> tb_masterpos_kd_unit_option_list();
                                                    if(!empty($kd_unit_options)){
                                                    foreach($kd_unit_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = $this->set_field_selected('kd_unit',$value, "");
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                        <?php echo $label; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama_pos">Nama Pos <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-nama_pos"  value="<?php  echo $this->set_field_value('nama_pos',""); ?>" type="text" placeholder="Tulis Nama Pos"  required="" name="nama_pos"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="dasar_hukum">Dasar Hukum <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Tulis Dasar Hukum" id="ctrl-dasar_hukum"  required="" rows="5" name="dasar_hukum" class=" form-control"><?php  echo $this->set_field_value('dasar_hukum',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="keterkaitan">Keterkaitan </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Tulis Keterkaitan" id="ctrl-keterkaitan"  rows="5" name="keterkaitan" class=" form-control"><?php  echo $this->set_field_value('keterkaitan',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="kualifikasi_pelaksana">Kualifikasi Pelaksana </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Tulis Kualifikasi Pelaksana" id="ctrl-kualifikasi_pelaksana"  rows="5" name="kualifikasi_pelaksana" class=" form-control"><?php  echo $this->set_field_value('kualifikasi_pelaksana',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="peralatan">Peralatan </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Tulis Peralatan" id="ctrl-peralatan"  rows="5" name="peralatan" class=" form-control"><?php  echo $this->set_field_value('peralatan',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="flowmap">Flowmap <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <div class="dropzone required" input="#ctrl-flowmap" fieldname="flowmap"    data-multiple="false" dropmsg="Upload file dengan format excel"    btntext="Browse" extensions=".docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps" filesize="3" maximum="1">
                                                        <input name="flowmap" id="ctrl-flowmap" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('flowmap',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-submit-btn-holder text-center mt-3">
                                        <div class="form-ajax-status"></div>
                                        <button class="btn btn-primary" type="submit">
                                            Submit
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
