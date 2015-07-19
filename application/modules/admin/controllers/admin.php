<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Admin extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->library('session');
 		$this->load->helper('url');
 		$this->load->helper('string');
 		$this->load->library('mylang');
 		if($this->session->userdata('lang'))
 		{
 			$lang = $this->session->userdata('lang');
 			$this->lang->load($lang[0], $lang[1]);
 		}else
 		{
 			$lang = $this->mylang->get_config();
 			$this->lang->load($lang[0], $lang[1]);
 		}
 		
 		$this->load->model('Admin_model');
 		$this->load->model('Setting_model');
 		$this->load->model('Page_model');
 		$this->load->model('Collection_model');
 		$this->load->model('Homesetting_model');
 		$this->load->model('Press_model');
 		$this->load->model('Category_model');
 		$this->load->model('Product_model');
 		$this->load->model('Lang_model');
 		$this->load->model('User_model');
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
 			header('location:'.base_url().'admin/admin.html');
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
			$login = $this->Admin_model->checkUserLogin($u_email, md5($u_password));
			
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
 	public function check_login()
 	{
 		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}else
		{
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$login = $this->Admin_model->checkUserLogin($email, $pass);
			
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
 	public function get_user()
 	{
			$u_id = $this->input->post('id');
			$u_email = $this->input->post('email');
			$u_pass = $this->input->post('pass');
			$user = $this->Admin_model->getUser($u_id, $u_email,$u_pass);
			if($user)
			{
				header('Content-Type: application/json');
 				echo json_encode($user);
			}else
			{
				echo "FALSE";
			}
			

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
 		$en_contact_page = $data['en_contact_page'];
 		$vi_contact_page = $data['vi_contact_page'];
 		$page_name = $data['page_name'];
 		$id = 1;
 		$update = array(
 				"page_name" => $page_name,
 				"en_page_content" => $en_contact_page,
 				"vi_page_content" => $vi_contact_page
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
 		$en_about_page = $data['en_about_page'];
 		$vi_about_page = $data['vi_about_page'];
 		$page_name = $data['page_name'];
 		$id = 2;
 		$update = array(
 				"page_name" => $page_name,
 				"en_page_content" => $en_about_page,
 				"vi_page_content" => $vi_about_page
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
		$en_title = $data['en_title'];
		$vi_title = $data['vi_title'];
		$featured = $data['featured'];
		$collections = $data['collections'];
		$date = date('Y-m-d H:i:s');

		$insert = array(
				"en_collection_name" => $en_title,
				"vi_collection_name" => $vi_title,
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
		$en_name = $data['en_name'];
		$vi_name = $data['vi_name'];
		$id = $data['id'];
		if( !$data['featuredImage'] && ! $data['collectionImage'])
		{
			$update = array(
				"en_collection_name" => $en_name,
				"vi_collection_name" => $vi_name,
				"collection_date_updated" => date('Y-m-d H:i:s')
			);
		}else
		{
			$update = array(
				"en_collection_name" => $en_name,
				"vi_collection_name" => $vi_name,
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
		$data = $this->Collection_model->getItemById($id);
		$featuredImage = PUBPATH.substr($data['collection_featured_image'], 1);
		unlink($featuredImage);
		$replace = array("[", "]", '"');
		$col = str_replace($replace, '', $data['collection_image_list'])  ;
		$col = explode(',', $col);
		foreach ($col as $value) {
			unlink(PUBPATH.substr($value, 1));
		}
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
 	public function postImgPressUpload()
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
		        move_uploaded_file($_FILES['myfile']['tmp_name'], 'upload/press/'.date("Y_m_d_H_i_s").$random_string.$fileName);
		        $fileStatus = '/upload/press/'.date("Y_m_d_H_i_s").$random_string.$fileName;
		    }   
			echo $fileStatus;
		    exit();
		}
	}
	public function press_save()
	{
		$data = $this->input->post('data');
		$en_name = $data['en_name'];
		$vi_name = $data['vi_name'];
		$press1 = $data['image1'];
		$press2 = $data['image2'];
		$date = date('Y-m-d H:i:s');

		$insert = array(
				"en_press_name" => $en_name,
				"vi_press_name" => $vi_name,
				"press_image_1" => $press1,
				"press_image_2" => $press2,
				"date_created" => $date
			);
		$this->Press_model->insertItem($insert);
		echo "TRUE";
	}
	public function press_list()
	{
		$page = $this->input->post('page');
		$limit = 10;
		$total = count($data = $this->Press_model->getList());
		$total_page = ceil($total/$limit);
		$offset = ( (int) $page - 1)  * $limit;
		$data = $this->Press_model->getListLimit($offset, $limit);
		$table = array(
				"current_page" => (int)$page,
				"total_page" => $total_page,
				"data" => $data,
				"total" => $total
			);
		header('Content-Type: application/json');
 		echo json_encode($table);
 	}
 	public function delete_press_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->Press_model->getItemById($id);
		$press_image_1 = PUBPATH.substr($data['press_image_1'], 1);
		unlink($press_image_1);
		$press_image_2 = PUBPATH.substr($data['press_image_2'], 1);
		unlink($press_image_2);
		$this->Press_model->deleteItemById($id);
	}
	public function press_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->Press_model->getItemById($id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function press_update_get_by_id()
	{
		$data = $this->input->post('data');
		$id = $data['id'];
		$en_name = $data['en_name'];
		$vi_name = $data['vi_name'];
		$press1 = $data['image1'];
		$press2 = $data['image2'];
		$date = date('Y-m-d H:i:s');

		$update = array(
				"en_press_name" => $en_name,
				"vi_press_name" => $vi_name,
				"press_image_1" => $press1,
				"press_image_2" => $press2,
				"date_updated" => $date
			);
		$this->Press_model->updateItemById($id, $update);
		echo "TRUE";
	}
	public function category_save()
	{
		$data = $this->input->post('data');
		$title = $data['title'];
		$check = $this->Category_model->checkName($title);
		if($check == 1)
		{
			echo "FALSE";
		}else
		{
			$insert = array(
					"category_name" => $title
				);
			$this->Category_model->insertItem($insert);
			echo "TRUE";
		}
	}
	public function category_list()
	{
		$data = $this->Category_model->getList();
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function delete_category_get_by_id()
	{
		$id = $this->input->post('id');
		$this->Category_model->deleteItemById($id);
	}
	public function category_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->Category_model->getItemById($id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function category_update_get_by_id()
	{
		$data = $this->input->post('data');
		$id = $data['id'];
		$name = $data['name'];
		$check = $this->Category_model->checkNameNotId($name, $id);
		if($check == 0)
		{
			$update = array(
					"category_name" => $name
				);
			$this->Category_model->updateItemById($id, $update);
			echo "TRUE";
		}else
		{
			echo 'FALSE';
		}
	}
	public function postImgUploadProduct()
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
		        move_uploaded_file($_FILES['myfile']['tmp_name'], 'upload/products/'.date("Y_m_d_H_i_s").$random_string.$fileName);
		        $fileStatus = '/upload/products/'.date("Y_m_d_H_i_s").$random_string.$fileName;
		    }   
			echo $fileStatus;
		    exit();
		}
	}
	public function product_save()
	{
		$data = $this->input->post('data');
		$en_name = $data['en_name'];
		$vi_name = $data['vi_name'];
		$category_id = $data['category_id'];
		$en_description = $data['en_description'];
		$vi_description = $data['vi_description'];
		$price = $data['price'];
		$images = $data['images'];
		if($data['price_new'])
		{
			$price_new = $data['price_new'];
			$insert = array(
					"en_name" => $en_name,
					"vi_name" => $vi_name,
					"category_id" => $category_id,
					"en_description" => $en_description,
					"vi_description" => $vi_description,
					"price" => $price,
					"price_new" => $price_new,
					"images" => $images
				);
		}else
		{
			$insert = array(
					"en_name" => $en_name,
					"vi_name" => $vi_name,
					"category_id" => $category_id,
					"en_description" => $en_description,
					"vi_description" => $vi_description,
					"price" => $price,
					"images" => $images
				);
		}
		$this->Product_model->insertItem($insert);
		
	}
	public function product_list()
	{
		$page = $this->input->post('page');
		$limit = 10;
		$total = count($data = $this->Product_model->getList());
		$total_page = ceil($total/$limit);
		$offset = ( (int) $page - 1)  * $limit;
		$data = $this->Product_model->getListLimit($offset, $limit);
		$new_data = array();
		foreach($data as $val)
		{
			$images = json_decode($val['images']);
			$array = array(
					"id" => $val['id'],
					"en_name" => $val['en_name'],
					"vi_name" => $val['vi_name'],
					"en_description" => $val['en_description'],
					"vi_description" => $val['vi_description'],
					"images" => $val['images'],
					"image" => $images[0],
					"price" => $val['price'],
					"price_new" => $val['price_new'],
					"date_created" => $val['date_created'],
					"category_id" => $val['category_id'],
					"category_name" => $val['category_name']
				);
			$new_data[] = $array;
			unset($array);
		}
		$table = array(
				"current_page" => (int)$page,
				"total_page" => $total_page,
				"data" => $new_data,
				"total" => $total
			);
		header('Content-Type: application/json');
 		echo json_encode($table);
	}
	public function delete_product_get_by_id()
	{
		$id = $this->input->post('id');
		$this->Product_model->deleteItemById($id);
	}
	public function product_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->Product_model->getItemById($id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function product_update_get_by_id()
	{
		$data = $this->input->post('data');
		$id = $data['id'];
		$en_name = $data['en_name'];
		$vi_name = $data['vi_name'];
		$category_id = $data['category_id'];
		$en_description = $data['en_description'];
		$vi_description = $data['vi_description'];
		$price = $data['price'];
		$images = $data['images'];
		if(isset($data['price_new']))
		{
			$price_new = $data['price_new'];
			$update = array(
					"en_name" => $en_name,
					"vi_name" => $vi_name,
					"category_id" => $category_id,
					"en_description" => $en_description,
					"vi_description" => $vi_description,
					"price" => $price,
					"price_new" => $price_new,
					"images" => $images
				);
		}else
		{
			$update = array(
					"en_name" => $en_name,
					"vi_name" => $vi_name,
					"category_id" => $category_id,
					"en_description" => $en_description,
					"vi_description" => $vi_description,
					"price" => $price,
					"images" => $images
				);
		}
		$this->Product_model->updateItemById($id, $update);
		echo "TRUE";
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
		
		$this->session->set_userdata('lang',$lang);
		redirect('/admin/login', 'location', 301);
	}
	public function getLang()
	{
		$lang = $this->Lang_model->getItemById(1);
		header('Content-Type: application/json');
 		echo json_encode($lang);
	}
	public function language_save()
	{
		$data= $this->input->post('data');
		$update = array(
				'name' => $data['name']
			);
		$this->Lang_model->updateItemById(1, $update);
		echo 'TRUE';

	}
	public function removeImage()
	{
		$data = $this->input->post('images');
		$images = json_decode($data);
		foreach($images as $image)	
		{
			unlink(PUBPATH.substr($image, 1));
		}
	}
	public function changePass()
	{
		$data = $this->input->post('data');
		$old_pass = $data['old_password'];
		$new_pass = $data['new_password'];
		$new_password_repeat = $data['new_password_repeat'];
		$userId = $data['userId'];
		$check = $this->User_model->checkPassword($userId, md5($old_pass));
		if($check == "TRUE")
		{
			$update = array(
				"u_password" => md5($new_pass)
				);
			$this->User_model->updateItemById($userId, $update);
			echo md5($new_pass);
		}else
		{
			echo 1;
		}
	}
	public function test()
	{
		session_destroy();
		//$this->session->sess_destroy();
	}
	public function user_save()
	{
		$data = $this->input->post('data');
		$email = $data['u_email'];
		$password = $data['u_password'];
		$check = $this->User_model->checkEmail($email);
		if($check == "FALSE")
		{
			echo 0;
		}else
		{
			$insert = array(
					"u_email" => $email,
					"u_password" => md5($password)
				);
			$this->User_model->insertItem($insert);
			echo 1;
		}

	}
	public function user_list()
	{
		$data = $this->User_model->getList();
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function delete_user_get_by_id()
	{
		$id = $this->input->post('id');
		$this->User_model->deleteItemById($id);
	}
	public function user_get_by_id()
	{
		$id = $this->input->post('id');
		$data = $this->User_model->getUserById($id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}
	public function user_update_get_by_id()
	{
		$data = $this->input->post('data');
		$id = $data['u_id'];
		$password = $data['u_password'];
		$update = array(
				"u_password" => md5($password)
			);
		$this->User_model->updateItemById($id, $update);
	}
	public function server()
	{
		date_default_timezone_set("Asia/Saigon");
		$host = $_SERVER['HTTP_HOST'];
		$bowser = $_SERVER['HTTP_USER_AGENT'];
		$bytes = disk_free_space("."); 
    	$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    	$base = 1024;
    	$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    	$disk_free = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    	$disk_total = sprintf('%1.2f' , disk_total_space("/") / pow($base,$class)) . ' ' . $si_prefix[$class];
    	$server_info = array(
    			"hostname" => $host,
    			"bowser" => $bowser,
    			"disk_total" => $disk_total,
    			"disk_free" => $disk_free,
    			"timezone" => date_default_timezone_get(),
    			"categorys" => count($this->Category_model->getList()),
    			"products" => count($this->Product_model->getList()),
    			"collections" => count($this->Collection_model->getList()),
    			"press" => count($this->Press_model->getList())
    		);
    	header('Content-Type: application/json');
 		echo json_encode($server_info);
	}
	public function last_activity()
	{
		$last_activity = array(
			"product" => $this->Product_model->lastitem(),
			"collection" => $this->Collection_model->lastitem(),
			"press" => $this->Press_model->lastitem()
			);
		header('Content-Type: application/json');
		echo json_encode($last_activity);
	}
 }