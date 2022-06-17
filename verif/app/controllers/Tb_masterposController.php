<?php 
/**
 * Tb_masterpos Page Controller
 * @category  Controller
 */
class Tb_masterposController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "tb_masterpos";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("tb_masterpos.no", 
			"tb_masterpos.nama_pengusul", 
			"tb_karyawan.nama_karyawan AS tb_karyawan_nama_karyawan", 
			"tb_masterpos.kd_unit", 
			"tb_unitkerja.nama_unit AS tb_unitkerja_nama_unit", 
			"tb_masterpos.nama_pos", 
			"tb_masterpos.flowmap", 
			"tb_masterpos.verifikasi", 
			"tb_masterpos.c_rev");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				tb_masterpos.no LIKE ? OR 
				tb_masterpos.nama_pengusul LIKE ? OR 
				tb_masterpos.kd_unit LIKE ? OR 
				tb_masterpos.nomor_pos LIKE ? OR 
				tb_masterpos.tgl_pembuatan LIKE ? OR 
				tb_masterpos.tgl_revisi LIKE ? OR 
				tb_masterpos.tgl_efektif LIKE ? OR 
				tb_masterpos.disahkan LIKE ? OR 
				tb_masterpos.nama_pos LIKE ? OR 
				tb_masterpos.dasar_hukum LIKE ? OR 
				tb_masterpos.keterkaitan LIKE ? OR 
				tb_masterpos.kualifikasi_pelaksana LIKE ? OR 
				tb_masterpos.peralatan LIKE ? OR 
				tb_masterpos.flowmap LIKE ? OR 
				tb_masterpos.verifikasi LIKE ? OR 
				tb_masterpos.peringatan LIKE ? OR 
				tb_masterpos.pencatatan LIKE ? OR 
				tb_masterpos.c_rev LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "tb_masterpos/search.php";
		}
		$db->join("tb_karyawan", "tb_masterpos.nama_pengusul = tb_karyawan.id_karyawan", "INNER");
		$db->join("tb_unitkerja", "tb_masterpos.kd_unit = tb_unitkerja.kd_unit", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("date_modified", "DESC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Verifikasi POS";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "tb_masterpos/ajax-list.php" : "tb_masterpos/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("tb_masterpos.no", 
			"tb_masterpos.nama_pos", 
			"tb_masterpos.nama_pengusul", 
			"tb_karyawan.nama_karyawan AS tb_karyawan_nama_karyawan", 
			"tb_masterpos.kd_unit", 
			"tb_unitkerja.nama_unit AS tb_unitkerja_nama_unit", 
			"tb_masterpos.nomor_pos", 
			"tb_masterpos.tgl_pembuatan", 
			"tb_masterpos.tgl_revisi", 
			"tb_masterpos.tgl_efektif", 
			"tb_masterpos.disahkan", 
			"tb_masterpos.dasar_hukum", 
			"tb_masterpos.keterkaitan", 
			"tb_masterpos.kualifikasi_pelaksana", 
			"tb_masterpos.peralatan", 
			"tb_masterpos.flowmap", 
			"tb_masterpos.verifikasi", 
			"tb_masterpos.peringatan", 
			"tb_masterpos.pencatatan");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("tb_masterpos.no", $rec_id);; //select record based on primary key
		}
		$db->join("tb_karyawan", "tb_masterpos.nama_pengusul = tb_karyawan.id_karyawan", "INNER");
		$db->join("tb_unitkerja", "tb_masterpos.kd_unit = tb_unitkerja.kd_unit", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Prosedur Operasional Standar";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("tb_masterpos/view.php", $record);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("no","nama_pengusul","nomor_pos","tgl_pembuatan","tgl_revisi","tgl_efektif","disahkan","nama_pos","dasar_hukum","keterkaitan","kualifikasi_pelaksana","peralatan","flowmap","verifikasi","peringatan","c_rev");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama_pengusul' => 'required',
				'nomor_pos' => 'required',
				'tgl_pembuatan' => 'required',
				'tgl_revisi' => 'required',
				'tgl_efektif' => 'required',
				'disahkan' => 'required',
				'nama_pos' => 'required',
				'flowmap' => 'required',
				'verifikasi' => 'required',
				'peringatan' => 'required',
				'c_rev' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pengusul' => 'sanitize_string',
				'nomor_pos' => 'sanitize_string',
				'tgl_pembuatan' => 'sanitize_string',
				'tgl_revisi' => 'sanitize_string',
				'tgl_efektif' => 'sanitize_string',
				'disahkan' => 'sanitize_string',
				'nama_pos' => 'sanitize_string',
				'dasar_hukum' => 'sanitize_string',
				'keterkaitan' => 'sanitize_string',
				'kualifikasi_pelaksana' => 'sanitize_string',
				'peralatan' => 'sanitize_string',
				'flowmap' => 'sanitize_string',
				'verifikasi' => 'sanitize_string',
				'peringatan' => 'sanitize_string',
				'c_rev' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tb_masterpos.no", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("tb_masterpos");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("tb_masterpos");
					}
				}
			}
		}
		$db->where("tb_masterpos.no", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit Verifikasi";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("tb_masterpos/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("no","nama_pengusul","nomor_pos","tgl_pembuatan","tgl_revisi","tgl_efektif","disahkan","nama_pos","dasar_hukum","keterkaitan","kualifikasi_pelaksana","peralatan","flowmap","verifikasi","peringatan","c_rev");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nama_pengusul' => 'required',
				'nomor_pos' => 'required',
				'tgl_pembuatan' => 'required',
				'tgl_revisi' => 'required',
				'tgl_efektif' => 'required',
				'disahkan' => 'required',
				'nama_pos' => 'required',
				'flowmap' => 'required',
				'verifikasi' => 'required',
				'peringatan' => 'required',
				'c_rev' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pengusul' => 'sanitize_string',
				'nomor_pos' => 'sanitize_string',
				'tgl_pembuatan' => 'sanitize_string',
				'tgl_revisi' => 'sanitize_string',
				'tgl_efektif' => 'sanitize_string',
				'disahkan' => 'sanitize_string',
				'nama_pos' => 'sanitize_string',
				'dasar_hukum' => 'sanitize_string',
				'keterkaitan' => 'sanitize_string',
				'kualifikasi_pelaksana' => 'sanitize_string',
				'peralatan' => 'sanitize_string',
				'flowmap' => 'sanitize_string',
				'verifikasi' => 'sanitize_string',
				'peringatan' => 'sanitize_string',
				'c_rev' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tb_masterpos.no", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("tb_masterpos.no", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("tb_masterpos");
	}
}
