<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Portfolio extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('Setting_model');
 		$this->load->model('Page_model');
 		$this->load->model('Homesetting_model');
 		$this->load->model('Collection_model');
 		$this->load->model('Press_model');
 		$this->load->library('mylang');
 		$this->load->library('checkdevice');
 		if($this->session->userdata('lang_portfolio'))
 		{
 			$lang = $this->session->userdata('lang_portfolio');
 			$this->lang->load($lang[0], $lang[1]);
 		}else
 		{
 			$lang = $this->mylang->get_config();
 			$this->lang->load($lang[0], $lang[1]);
 		}
 		header('Content-Type: text/html; charset=utf-8');
 	}
 	public function index()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$about = $this->Page_model->getItemById(2);
 		$contact = $this->Page_model->getItemById(1);
 		$home = $this->Homesetting_model->getItemById(1);
 		$collections = $this->Collection_model->getListLimit(0, 9);
 		$press = $this->Press_model->getList();
 		$data['about_title'] = $about['page_name'];
 		$data['about_content'] = $about['page_content'];
 		$data['contact_name'] = $contact['page_name'];
 		$data['contact_content'] = $contact['page_content'];
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['collections'] = $collections;
 		$data['press'] = $press;
 		$data['message'] = $this->lang->line('message');
 		$device = $this->checkdevice->make();
 		switch ($device) {
 			case 'Desktop':
 				$this->load->view("index", $data);
 				break;
 			case 'Mobile':
 				$data['view'] = 'home';
 				$this->load->view('mobile', $data);
 				break;
 			case 'Tablet':
 				$this->load->view("index", $data);
 				break;		
 			default:
 				# code...
 				break;
 		}
 		
 	}
 	public function get_collection_by_id()
 	{
 		$collect_id = $this->input->post('collect_id');
 		$collect_id = explode('_', $collect_id);
 		$collect_id = (int) $collect_id[1];
 		$collection = $this->Collection_model->getItemById($collect_id);
 		header('Content-Type: application/json');
 		echo json_encode($collection);
 	}
 	public function set_lang($id)
	{
		switch ($id) {
			case 'vi':
				$lang = array(
					0 => 'vi',
					1 => 'vietnamese'
				);
				break;
			
			case 'en':
				$lang = array(
					0 => 'en',
					1 => 'english'
				);
				break;
		}
		
		$this->session->set_userdata('lang_portfolio',$lang);
		header('location:'.base_url());
	}
	public function checkDevice()
	{
		$device = $this->checkdevice->make();
		echo $device;
	}
	public function about()
	{
		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$about = $this->Page_model->getItemById(2);
 		$contact = $this->Page_model->getItemById(1);
 		$home = $this->Homesetting_model->getItemById(1);
 		$collections = $this->Collection_model->getListLimit(0, 9);
 		$press = $this->Press_model->getListLimit(0, 12);
 		$data['about_title'] = $about['page_name'];
 		$data['about_content'] = $about['page_content'];
 		$data['contact_name'] = $contact['page_name'];
 		$data['contact_content'] = $contact['page_content'];
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['collections'] = $collections;
 		$data['press'] = $press;
 		$data['message'] = $this->lang->line('message');
 		$data['view'] = 'about';
 		$this->load->view('mobile', $data);
	}
	public function collections()
	{
		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$home = $this->Homesetting_model->getItemById(1);
 		$collections = $this->Collection_model->getList();
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['collections'] = $collections;
 		$data['view'] = 'collections';
 		$this->load->view('mobile', $data);
	}
	public function collection($cid)
	{
		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$home = $this->Homesetting_model->getItemById(1);
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['view'] = 'collection';
 		$data['collection'] = $this->Collection_model->getItemById($cid);
 		$this->load->view('mobile', $data);
	}
	public function press()
	{
		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$home = $this->Homesetting_model->getItemById(1);
 		$press = $this->Press_model->getListLimit(0, 12);
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['press'] = $press;
 		$data['view'] = 'press';
 		$this->load->view('mobile', $data);
	}
 }