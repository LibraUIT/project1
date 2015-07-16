<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Lang extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->lang->load('vi', 'vietnamese');
 	}
 	public function index()
 	{
 		header('Content-Type: application/json');
 		echo json_encode($this->lang->language);
 	}
 	public function set($lang)
 	{
 		switch ($lang) {
 			case 'vi':
 				$vi = array("vi", "vietnamese");
 				$this->session->set_userdata('lang', $vi );
 				break;
 			case 'en':
 				$en = array('en', 'english');
 				$this->session->set_userdata('lang', $en);
 			default:
 				# code...
 				break;
 		}
 		redirect('/auth/report', 'location', 301);

 	}
 }