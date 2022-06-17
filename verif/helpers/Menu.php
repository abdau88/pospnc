<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'tb_masterpos', 
			'label' => 'Verifikasi POS', 
			'icon' => '<i class="fa fa-database "></i>'
		),
		
		array(
			'path' => 'tb_karyawan', 
			'label' => 'Karyawan', 
			'icon' => '<i class="fa fa-slideshare "></i>'
		),
		
		array(
			'path' => 'tb_unitkerja', 
			'label' => 'Unit Kerja', 
			'icon' => '<i class="fa fa-trello "></i>'
		),
		
		array(
			'path' => 'tb_user', 
			'label' => 'User', 
			'icon' => '<i class="fa fa-users "></i>'
		)
	);
		
			public static $navbartopleft = array(
		array(
			'path' => 'v_pos', 
			'label' => 'Cetak POS', 
			'icon' => ''
		)
	);
		
	
	
			public static $verifikasi = array(
		array(
			"value" => "Revisi (Verifikator)", 
			"label" => "Revisi (Verifikator)", 
		),
		array(
			"value" => "Acc", 
			"label" => "Acc", 
		),);
		
			public static $disahkan = array(
		array(
			"value" => "Dr. Aris Tjahyanto, M.Kom.", 
			"label" => "Dr. Aris Tjahyanto, M.Kom.", 
		),);
		
}