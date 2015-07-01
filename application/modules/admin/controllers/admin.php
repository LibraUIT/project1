<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Admin extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->library('session');
 		$this->load->helper('url');
 		$this->load->helper('string');
 		$this->lang->load('en', 'english');
 		$this->load->model('Admin_model');
 		$this->load->model('Setting_model');
 		$this->load->model('Page_model');
 		$this->load->model('Collection_model');
 		$this->load->model('Homesetting_model');
 	}
 	public function index()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$this->load->view('index');
 		}else
 		{
 			redirect('/admin/login', 'location', 301);
 		}
 	}
 	public function lang()
 	{
 		header('Content-Type: application/json');
 		echo json_encode($this->lang->language);
 	}
 	public function login()
 	{
 		
 		if($this->session->userdata('login') === null)
 		{
 			$this->load->view("login");
 		}else
 		{
 			//redirect('/admin/index', 'location', 301);
 		}
 	}
 	public function login_submit()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$u_email = $this->input->post('email');
			$u_password = $this->input->post('password');
			$login = $this->Admin_model->checkUserLogin($u_email, $u_password);
			
			if( $login == "FALSE")
			{
				echo "FALSE";
			}else
			{
				$this->session->set_userdata('login', $login['u_id']);
				header('Content-Type: application/json');
 				echo json_encode($login);
			}
		}
 	}
 	public function logout()
 	{
 		$this->session->sess_destroy();
 		redirect('/admin/login', 'location', 301);
 	}
 	public function get_user()
 	{
 		
			$u_id = $this->input->post('id');
			$user = $this->Admin_model->getUserById($u_id);
			header('Content-Type: application/json');
 			echo json_encode($user);

 	}
 	public function portfolio_save()
 	{
 		$data = $this->input->post('data');
 		$newdata = serialize($data);
 		$id = 1;
 		$update = array(
 				"setting_info" => $newdata
 			);
 		$this->Setting_model->updateItemById($id, $update);
 		echo "TRUE";
 	}
 	public function get_setting_portfolio()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		header('Content-Type: application/json');
 		$data = unserialize($portfolio['setting_info']);
 		echo json_encode($data);
 	}
 	public function contact_page_save()
 	{
 		$data = $this->input->post('data');
 		$contact_page = $data['contact_page'];
 		$page_name = $data['page_name'];
 		$id = 1;
 		$update = array(
 				"page_name" => $page_name,
 				"page_content" => $contact_page
 			);
 		$this->Page_model->updateItemById($id, $update);
 		echo "TRUE";
 	}
 	public function get_contact_page()
 	{
 		$id = 1;
 		$contact_page = $this->Page_model->getItemById($id);
 		header('Content-Type: application/json');
 		echo json_encode($contact_page);
 	}
 	public function get_about_page()
 	{
 		$id = 2;
 		$about_page = $this->Page_model->getItemById($id);
 		header('Content-Type: application/json');
 		echo json_encode($about_page);
 	}
 	public function about_page_save()
 	{
 		$data = $this->input->post('data');
 		$about_page = $data['about_page'];
 		$page_name = $data['page_name'];
 		$id = 2;
 		$update = array(
 				"page_name" => $page_name,
 				"page_content" => $about_page
 			);
 		$this->Page_model->updateItemById($id, $update);
 		echo "TRUE";
 	}
 	public function postImgUpload()
	{
		$mimes = array(
    		'image/jpeg', 'image/png', 'image/gif'
		);
		sleep(2);
		if (isset($_FILES['myfile'])) {
		    $fileName = $_FILES['myfile']['name'];
		    $fileType = $_FILES['myfile']['type'];
		    $fileError = $_FILES['myfile']['error'];
		    $fileStatus = array(
		        'status' => 0,
		        'message' => '' 
		    );
		    if ($fileError== 1) { //Lỗi vượt dung lượng
		       
		    } elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
		        
		    } else { //Không có lỗi nào
		    	$random_string = random_string('alnum', 16);
		        move_uploaded_file($_FILES['myfile']['tmp_name'], 'upload/collections/'.date("Y_m_d_H_i_s").$random_string.$fileName);
		        $fileStatus = '/upload/collections/'.date("Y_m_d_H_i_s").$random_string.$fileName;
		    }   
			echo $fileStatus;
		    exit();
		}
	}
	public function postImgUpload2()
	{
		$mimes = array(
    		'image/jpeg', 'image/png', 'image/gif'
		);
		sleep(2);
		if (isset($_FILES['myfile'])) {
		    $fileName = $_FILES['myfile']['name'];
		    $fileType = $_FILES['myfile']['type'];
		    $fileError = $_FILES['myfile']['error'];
		    $fileStatus = array(
		        'status' => 0,
		        'message' => '' 
		    );
		    if ($fileError== 1) { //Lỗi vượt dung lượng
		       
		    } elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
		        
		    } else { //Không có lỗi nào
		    	$random_string = random_string('alnum', 16);
		        move_uploaded_file($_FILES['myfile']['tmp_name'], 'upload/thumbs/'.date("Y_m_d_H_i_s").$random_string.$fileName);
		        $fileStatus = '/upload/thumbs/'.date("Y_m_d_H_i_s").$random_string.$fileName;
		    }   
			echo $fileStatus;
		    exit();
		}
	}
	public function collection_save()
	{
		$data = $this->input->post('data');
		$title = $data['title'];
		$featured = $data['featured'];
		$collections = $data['collections'];
		$date = date('Y-m-d H:i:s');

		$insert = array(
				"collection_name" => $title,
				"collection_featured_image" => $featured,
				"collection_image_list" => $collections,
				"collection_status" => 0,
				"collection_date_created" => $date
			);
		$this->Collection_model->insertItem($insert);
		echo "TRUE";
	}
	public function collection_list()
	{
		$page = $this->input->post('page');
		$limit = 10;
		$total = count($data = $this->Collection_model->getList());
		$total_page = ceil($total/$limit);
		$offset = ( (int) $page - 1)  * $limit;
		$data = $this->Collection_model->getListLimit($offset, $limit);
		$table = array(
				"current_page" => (int)$page,
				"total_page" => $total_page,
				"data" => $data,
				"total" => $total
			);
		header('Content-Type: application/json');
 		echo json_encode($table);
 		/*$dt = array();
 		foreach($data as $val)
 		{
 			$v = array();
 			$v[] = $val['collection_featured_image'];
 			$v[] = $val['collection_name'];
 			$v[] = $val['collection_date_created'];
 			$v[] = $val['collection_id'];
 			$v[] = $val['collection_id'];
 			$dt[] = $v;
 		}
 		$datatable = array(
 				"draw" => 1,
 				"recordsTotal" => 57,
 				"recordsFiltered" => 57,
 				"data" => $dt
 			);
 		header('Content-Type: application/json');
 		echo json_encode($datatable);*/
	}
	public function collection_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->Collection_model->getItemById($id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function update_get_by_id()
	{
		$data = $this->input->post('data');
		$name = $data['name'];
		$id = $data['id'];
		if( !$data['featuredImage'] && ! $data['collectionImage'])
		{
			$update = array(
				"collection_name" => $name,
				"collection_date_updated" => date('Y-m-d H:i:s')
			);
		}else
		{
			$update = array(
				"collection_name" => $name,
				"collection_date_updated" => date('Y-m-d H:i:s'),
				"collection_featured_image" => $data['featuredImage'],
				"collection_image_list" => $data['collectionImage']
			);
		}
		$this->Collection_model->updateItemById($id, $update);
		echo "TRUE";
	}
	public function delete_get_by_id()
	{
		$id = $this->input->post('id');
		$this->Collection_model->deleteItemById($id);
	}
	public function home_save()
	{
		$data = $this->input->post('data');
		$id = 1;
		$update = array(
				"link_1_title" => $data['link_1_title'],
				"link_1_small_title" => $data['link_1_small_title'],
				"link_1_url" => $data['link_1_url'],
				"link_2_title" => $data['link_2_title'],
				"link_2_small_title" => $data['link_2_small_title'],
				"link_2_url" => $data['link_2_url']		
			);
		$this->Homesetting_model->updateItemById($id, $update);
		echo "TRUE";
	}
	public function get_home_page()
 	{
 		$id = 1;
 		$home_page = $this->Homesetting_model->getItemById($id);
 		header('Content-Type: application/json');
 		echo json_encode($home_page);
 	}
 }