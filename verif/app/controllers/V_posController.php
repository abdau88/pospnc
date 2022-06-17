<?php 
/**
 * V_pos Page Controller
 * @category  Controller
 */
class V_posController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_pos";
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
		$fields = array("no", 
			"nama_karyawan", 
			"tgl_pembuatan", 
			"tgl_revisi", 
			"tgl_efektif", 
			"disahkan", 
			"nama_pos", 
			"dasar_hukum", 
			"kualifikasi_pelaksana", 
			"keterkaitan", 
			"peralatan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_pos.no LIKE ? OR 
				v_pos.nama_karyawan LIKE ? OR 
				v_pos.tgl_pembuatan LIKE ? OR 
				v_pos.tgl_revisi LIKE ? OR 
				v_pos.tgl_efektif LIKE ? OR 
				v_pos.disahkan LIKE ? OR 
				v_pos.nama_pos LIKE ? OR 
				v_pos.dasar_hukum LIKE ? OR 
				v_pos.kualifikasi_pelaksana LIKE ? OR 
				v_pos.keterkaitan LIKE ? OR 
				v_pos.peralatan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_pos/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_pos.nama_karyawan", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Cetak POS";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "landscape";
		$this->view->report_hidden_fields = array('nama_karyawan');
		$view_name = (is_ajax() ? "v_pos/ajax-list.php" : "v_pos/list.php");
		$this->render_view($view_name, $data);
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
