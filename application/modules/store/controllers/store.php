<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Store extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 	}
 	public function index()
 	{
 		$view = array(
 				"title" => "Title Pgae",
 				"template" => "home"
 			);
 		$this->load->view("common/main", $view);

 	}
 	
 }