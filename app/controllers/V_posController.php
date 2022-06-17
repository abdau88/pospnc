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
}
