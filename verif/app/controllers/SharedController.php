<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * tb_masterpos_nama_pengusul_option_list Model Action
     * @return array
     */
	function tb_masterpos_nama_pengusul_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_karyawan AS value , id_karyawan AS label FROM tb_karyawan ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tb_user_id_karyawan_option_list Model Action
     * @return array
     */
	function tb_user_id_karyawan_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id_karyawan AS value,nama_karyawan AS label FROM tb_karyawan WHERE nama_karyawan LIKE ? ORDER BY nama_karyawan ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * tb_user_username_value_exist Model Action
     * @return array
     */
	function tb_user_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("tb_user");
		return $exist;
	}

	/**
     * tb_user_email_value_exist Model Action
     * @return array
     */
	function tb_user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("tb_user");
		return $exist;
	}

	/**
     * getcount_pending Model Action
     * @return Value
     */
	function getcount_pending(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tb_masterpos WHERE verifikasi IS NULL";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_revisiverifikator Model Action
     * @return Value
     */
	function getcount_revisiverifikator(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tb_masterpos WHERE verifikasi ='Revisi (Verifikator)'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_revisipengguna Model Action
     * @return Value
     */
	function getcount_revisipengguna(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tb_masterpos WHERE verifikasi ='Revisi (Pengguna)'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_acc Model Action
     * @return Value
     */
	function getcount_acc(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tb_masterpos WHERE verifikasi ='Acc'";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
