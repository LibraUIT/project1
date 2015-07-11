<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mylang {
	public function get_config()
	{
		$CI =& get_instance();
		$CI->load->model('lang_model');
		$lang = $CI->lang_model->getItemById(1);
		$code = $lang['name'];
		if($code == 'en')
		{
			$arr = array(
				0 => 'en',
				1 => "english"
			);
		}else
		{
			$arr = array(
				0 => 'vi',
				1 => "vietnamese"
			);
		}
		
		return $arr;
	}	
}