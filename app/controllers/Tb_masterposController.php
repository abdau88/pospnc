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
			"tb_masterpos.nama_pos", 
			"tb_masterpos.flowmap", 
			"tb_masterpos.verifikasi");
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
				tb_masterpos.date_modified LIKE ? OR 
				tb_masterpos.peringatan LIKE ? OR 
				tb_masterpos.pencatatan LIKE ?
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
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tb_masterpos.no", ORDER_TYPE);
		}
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );
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
		$page_title = $this->view->page_title = "Pengajuan POS";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("tb_masterpos/list.php", $data); //render the full page
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
			"tb_masterpos.nama_pengusul", 
			"tb_karyawan.nama_karyawan AS tb_karyawan_nama_karyawan", 
			"tb_masterpos.kd_unit", 
			"tb_unitkerja.nama_unit AS tb_unitkerja_nama_unit", 
			"tb_masterpos.nomor_pos", 
			"tb_masterpos.tgl_pembuatan", 
			"tb_masterpos.tgl_revisi", 
			"tb_masterpos.tgl_efektif", 
			"tb_masterpos.disahkan", 
			"tb_masterpos.nama_pos", 
			"tb_masterpos.dasar_hukum", 
			"tb_masterpos.keterkaitan", 
			"tb_masterpos.kualifikasi_pelaksana", 
			"tb_masterpos.peralatan", 
			"tb_masterpos.flowmap", 
			"tb_masterpos.verifikasi");
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );
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
			$page_title = $this->view->page_title = "View Pengajuan POS";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
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
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("nama_pengusul","kd_unit","disahkan","nama_pos","dasar_hukum","keterkaitan","kualifikasi_pelaksana","peralatan","flowmap","peringatan","pencatatan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama_pengusul' => 'required',
				'kd_unit' => 'required',
				'nama_pos' => 'required',
				'flowmap' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pengusul' => 'sanitize_string',
				'kd_unit' => 'sanitize_string',
				'disahkan' => 'sanitize_string',
				'nama_pos' => 'sanitize_string',
				'dasar_hukum' => 'sanitize_string',
				'keterkaitan' => 'sanitize_string',
				'kualifikasi_pelaksana' => 'sanitize_string',
				'peralatan' => 'sanitize_string',
				'flowmap' => 'sanitize_string',
				'peringatan' => 'sanitize_string',
				'pencatatan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("tb_masterpos");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambah Pengajuan POS";
		$this->render_view("tb_masterpos/add.php");
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
		$fields = $this->fields = array("no","nama_pengusul","kd_unit","nama_pos","dasar_hukum","keterkaitan","kualifikasi_pelaksana","peralatan","flowmap","verifikasi");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama_pengusul' => 'required',
				'kd_unit' => 'required',
				'nama_pos' => 'required',
				'flowmap' => 'required',
				'verifikasi' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pengusul' => 'sanitize_string',
				'kd_unit' => 'sanitize_string',
				'nama_pos' => 'sanitize_string',
				'dasar_hukum' => 'sanitize_string',
				'keterkaitan' => 'sanitize_string',
				'kualifikasi_pelaksana' => 'sanitize_string',
				'peralatan' => 'sanitize_string',
				'flowmap' => 'sanitize_string',
				'verifikasi' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );
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
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );$db->where("tb_masterpos.no", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit Pengajuan";
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
		$fields = $this->fields = array("no","nama_pengusul","kd_unit","nama_pos","dasar_hukum","keterkaitan","kualifikasi_pelaksana","peralatan","flowmap","verifikasi");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nama_pengusul' => 'required',
				'kd_unit' => 'required',
				'nama_pos' => 'required',
				'flowmap' => 'required',
				'verifikasi' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pengusul' => 'sanitize_string',
				'kd_unit' => 'sanitize_string',
				'nama_pos' => 'sanitize_string',
				'dasar_hukum' => 'sanitize_string',
				'keterkaitan' => 'sanitize_string',
				'kualifikasi_pelaksana' => 'sanitize_string',
				'peralatan' => 'sanitize_string',
				'flowmap' => 'sanitize_string',
				'verifikasi' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );
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
		$db->where("tb_masterpos.nama_pengusul", get_active_user('id_karyawan') );
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
