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
		$sqltext = "SELECT  DISTINCT id_karyawan AS value,nama_karyawan AS label FROM tb_karyawan ORDER BY nama_karyawan ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * tb_masterpos_kd_unit_option_list Model Action
     * @return array
     */
	function tb_masterpos_kd_unit_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT kd_unit AS value,nama_unit AS label FROM tb_unitkerja ORDER BY nama_unit ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
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
     * tb_user_id_karyawan_option_list Model Action
     * @return array
     */
	function tb_user_id_karyawan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_karyawan AS value,nama_karyawan AS label FROM tb_karyawan ORDER BY nama_karyawan ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
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

}
