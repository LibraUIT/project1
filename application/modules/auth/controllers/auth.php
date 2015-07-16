<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Auth extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('User_model');
 		$this->load->model('Tb_model');
 		$this->load->model('Hrlevel_model');
 		$this->load->model('Hrteam_model');
 		$this->load->model('Hr_model');
 		$this->load->model('Use_model');
 		if($this->session->userdata('lang') !== null)
 		{
 			//$this->lang->load($this->session->userdata('lang'));
 			$this->lang->load($this->session->userdata('lang')['0'], $this->session->userdata('lang')['1']);
 		}else
 		{
 			$this->lang->load('vi', 'vietnamese');
 		}
 	}
 	public function index(){
 		/*if($this->session->userdata('login') !== null)
 		{
 			redirect('/auth/report', 'location', 301);
 		}else
 		{
 			$this->load->view('login');
 		}*/
 		redirect('/auth/report', 'location', 301);
 	}
 	public function login()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			redirect('/auth/report', 'location', 301);
 		}else
 		{
 			$this->load->view('login');
 		}
 	}
 	public function submit(){
 		if($this->input->post())
 		{
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			if($username != NULL && $password != NULL)
 			{
 				$login = $this->User_model->checkUser($username, md5($password));
 				if($login == 'FALSE')
 				{
 					$message['error'] = $this->lang->line('message_login_error');
 					$message['username'] = $username;
 					$this->load->view('login', $message); 
 				}else
 				{
 					$this->session->set_userdata('login', $login['id']);
 					redirect('/auth/report', 'location', 301);
 				}
 			}else
 			{
 				$message['error'] =  $this->lang->line('message_login_required'); 
 				$this->load->view('login', $message);
 			}
 			
 		}
 	}
 	public function logout()
 	{
 		$this->session->sess_destroy();
 		redirect('/auth/index', 'location', 301);
 	}
 	public function admin()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 			$userLogin = $this->User_model->getUserById($loginId);
 			$view = array(
 				'title' => "Admin",
 				'view' => 'admin',
 				'userLogin' => $userLogin
 				);
 			$this->load->view('template', $view);
 		}else
 		{	
 			redirect('/auth/login', 'location', 301);
 		}	
 			
 	}
 	public function admin_submit()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$old = $this->input->post('old');
			$new = $this->input->post('newp');
			$re = $this->input->post('re');
			$loginId = $this->session->userdata('login');
			$check = $this->User_model->checkPassword($loginId, md5($old));
			if($check == "TRUE")
			{
				$update = array(
						"password" => md5($re)
					);
				$this->User_model->updateItemById($loginId, $update);
				echo "TRUE";
			}else
			{
				echo "FALSE";
			}

		}
 	}
 	public function manager()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$view = array(
 				'title' => $this->lang->line('home'),
 				'view' => 'manager',
 				'userLogin' => $userLogin
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function tb()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Tb_model->getList();
 			$view = array(
 				'title' => $this->lang->line('menu_asset'),
 				'view' => 'tb',
 				'userLogin' => $userLogin,
 				'items' => $items
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function hrb()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$levels = $this->Hrlevel_model->getListItem();
 			$teams = $this->Hrteam_model->getListItem();
 			$items = $this->Hr_model->getListItem();
 			$view = array(
 				'title' => $this->lang->line('menu_hr'),
 				'view' => 'hr',
 				'userLogin' => $userLogin,
 				'levels' => $levels,
 				'teams' => $teams,
 				'items' => $items
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function hrlevel()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Hrlevel_model->getListItem();
 			$view = array(
 				'title' => $this->lang->line('menu_hr'),
 				'view' => 'hrlevel',
 				'userLogin' => $userLogin,
 				'items' => $items
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function hrteam()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Hrteam_model->getListItem();
 			$view = array(
 				'title' => $this->lang->line('menu_hr_team'),
 				'view' => 'hrteam',
 				'userLogin' => $userLogin,
 				'items' => $items
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function tbuse()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Hrteam_model->getListItem();
 			$lists = $this->Tb_model->getListNotUsed();
 			$teams = $this->Hrteam_model->getListItem();
 			$hrs = $this->Hr_model->getListItem();
 			$uses = $this->Use_model->getListItem();
	 		$arrs = array();
	 		foreach ($uses as $item) {
	 			switch ($item['object']) {
	 				case 1:
	 						$object = $this->lang->line('all');
	 					break;
	 				case 2:
	 						$permission = explode( '_', $item['permission']) ;
	 						$string = '';
	 						for($i = 0; $i < count($permission) ; $i++)
	 						{
	 							$per = $this->Hrteam_model->getItemById((int) $permission[$i]);
	 							
	 							if($i == count($permission) - 1)
	 							{
	 								$string .= $this->lang->line('team').' '.$per['name'];
	 							}else
	 							{
	 								$string .= $this->lang->line('team').' '.$per['name'].' & ';
	 							}
	 						}
	 						$object = $string;
	 					break;
	 				case 3:
	 						$permission = explode('_', $item['permission']);
	 						$string = '';
	 						for($i = 0; $i < count($permission) ; $i++)
	 						{
	 							$per = $this->Hr_model->getItemById((int) $permission[$i]);
	 							if($i == count($permission) - 1)
	 							{
	 								$string .= $per['fullname'];
	 							}else
	 							{
	 								$string .= $per['fullname'].' & ';
	 							}
	 						}
	 						$object = $string;
	 					break;
	 			}
 			$arrs [] = array(
 					"use_id" => $item['id'],
 					"tb_id" => $item['idTb'],
 					"name_tb" => $item['name'],
 					"date_use" => $item['date'],
 					"note_use" => $item['note'],
 					"object_use" => $object
 				);
 			}
 			$view = array(
 				'title' => 'Bàn giao',
 				'view' => 'tb_use',
 				'userLogin' => $userLogin,
 				'items' => $items,
 				'lists' => $lists,
 				'teams' => $teams,
 				'hrs' => $hrs,
 				'arrs' => $arrs
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function assign()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$view = array(
 				'title' => 'Bàn giao',
 				'view' => 'assign',
 				'userLogin' => $userLogin
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function managers()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Use_model->getListItem();
	 		$arr = array();
	 		$assign_type = array(
	 				1 => $this->lang->line('type_1'),
	 				2 => $this->lang->line('type_2'),
	 				3 => $this->lang->line('type_3')
	 			);
	 		foreach ($items as $item) {
	 			$tbs = explode('-', $item['id_tb']);
	 			$hrs = explode('-', $item['object2']);
	 			$assings = explode('-', $item['object1']);
	 			$string1 = '<ul class="subtd">';
	 			$string1_1 = '<ul class="subtd">';
	 			foreach($tbs as $tb)
	 			{
	 				$t = $this->Tb_model->getItemByIdTb($tb);
	 				$string1 .= '<li>'.$t['name'].'</li>';
	 				$string1_1 .='<li>'.$t['idTb'].'</li>';
	 			}
	 			$string1 .="</ul>";
	 			$string1_1 .="</ul>";
	 			$string2 = '<ul class="subtd">';
	 			foreach($hrs as $hr)
	 			{
	 				$h = explode('_', $hr);
	 				switch($h[0])
	 				{
	 					case "H":
	 						$p = $this->Hr_model->getItemByIdHr($h[1]);
	 						$string2 .= '<li>'.$p['fullname'] ."</li>";
	 						break;
	 					case "D":
	 						$d = $this->Hrteam_model->getItemByIdTeam($h[1]);
	 						$string2 .= '<li>'.$d['name']."</li>";
	 						break;
	 					case "Company":
	 						$string2 .= '<li>'.$this->lang->line('company')."</li>";
	 						break;			
	 				}

	 			}
	 			$string2 .= "</ul>";
	 			$string3 = '<ul class="subtd">';
	 			foreach($assings as $assign)
	 			{
	 				$a = explode('_', $assign);
	 				switch($a[0])
	 				{
	 					case "H":
	 						$p = $this->Hr_model->getItemByIdHr($a[1]);
	 						$string3 .= '<li>'.$p['fullname'] ." | ".$p['id_hr']."</li>";
	 						break;
	 					case "D":
	 						$d = $this->Hrteam_model->getItemByIdTeam($a[1]);
	 						$string3 .= '<li>'.$d['name']."</li>";
	 						break;
	 					case "Company":
	 						$string3 .= '<li>'.$this->lang->line('company')."</li>";
	 						break;			
	 				}
	 			}
	 			$string3 .= '</ul>';
	 			if(array_key_exists($item['type'], $assign_type))
	 			{
	 				$typeA = $assign_type[$item['type']];
	 			}
	 			$arr[] = array(
	 					"id" => $item['id'],
	 					"id_use" => $item['id_use'],
	 					"note" => $item['note'],
	 					"date" => $item['date'],
	 					"tb" => $string1,
	 					"idtb"=> $string1_1,
	 					"hr" => $string2,
	 					"assign" => $string3,
	 					"quantity" => 1,
	 					"type" => $typeA
	 				);
	 		}
 			$view = array(
 				'title' => 'Quản Lý Bàn Giao Thiết Bị',
 				'view' => 'manager',
 				'userLogin' => $userLogin,
 				'lists' => $arr
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function report()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$depts = $this->Hrteam_model->getListItem();
 			$hrs = $this->Hr_model->getListItem();
 			$assigns = $this->Tb_model->getListTbHr();
	 		$trees = array();
	 		$listHrView = array();
	 		$assign_type = array(
	 				1 => $this->lang->line('type_1'),
	 				2 => $this->lang->line('type_2'),
	 				3 => $this->lang->line('type_3')
	 			);
	 		foreach($assigns as $assign)
	 		{
	 			$tb = $this->Tb_model->getItemByIdTb($assign['tb']);
	 			$use = $this->Use_model->getItemByIdAssign($assign['assign']);
	 			$hr = $assign['hr'];
	 			if($hr == "Company")
	 			{
	 				$hr = "company";
	 			}else {
	 				$hr = explode('_', $hr);
	 				if($hr[0] == "D")
	 				{
	 					$dept = $this->Hrteam_model->getItemByIdTeam($hr[1]);
	 					$hr = $dept['team_id'];
	 				}else if($hr[0] == "H")
	 				{
	 					
	 					$hr = $hr[1];

	 				}
	 			}

	 			$trees[] = array(
	 					"typeId" => $assign['type'],
	 					"type" => $assign_type[$assign['type']],
	 					"idTb" => $tb['idTb'],
	 					"tb_name" => $tb['name'],
	 					"ob" => $hr,
	 					"note" => $use['note'],
	 					"date" => $assign['date']
	 				);
	 			$listHrView[] = $hr;
	 		}

 			$view = array(
 				'title' => 'Báo Cáo',
 				'view' => 'report',
 				'userLogin' => $userLogin,
 				'depts' => $depts,
 				'hrs' => $hrs,
 				'tbs' => $trees,
 				'hrView' => $listHrView
 				);
 			
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function report1()
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$items = $this->Tb_model->getList();
 			$view = array(
 				'title' => 'Báo cáo tồn kho',
 				'view' => 'report1',
 				'userLogin' => $userLogin,
 				'lists' => $items
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function report2($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			
 			$use = $this->Use_model->getItemByIdAssign($id);
 			$items = $this->Tb_model->getItemById($use['id_tb']);
 			$assign_form = $use['object1'];
 			$idHr = $use['object2'];
 			$object = array();
 			$table = array();
 			$HR = array();
 			$object1  =array();
 			$object2 = array();
 			$tb = array();
 			$items[] = $this->Tb_model->getItemByIdTb($use['id_tb']);
 			foreach($items as $item)
 			{
 				$table[$item['idTb']] = array(
 						"name" => $item['name'],
 						"quantity" => 1,
 						"descTb" => $item['descTb']
 					);
 				$tb[$item['idTb']] = $item['name'];
 			}
 			if($idHr == "Company")
 				{
 					$HR['Company'] = $this->lang->line('company');
 					$object2['Company'] = $this->lang->line('company');
 				}else
 				{
 					$idHr = explode('_', $idHr);
 					if($idHr[0] == "H")
 					{
 						$p = $this->Hr_model->getItemByIdHr($idHr[1]);
 						$dept = $this->Hrteam_model->getItemById($p['team']);
 						$HR[$p['id_hr']] = $p['fullname']." - ".$this->lang->line('team')." : ".$dept['name'];
 						$object2['H_'.$p['id_hr']] = $p['fullname']." - ".$p['id_hr'];
 					}else
 					{
 						$dept = $this->Hrteam_model->getItemByIdTeam($idHr[1]);
 						$HR[$dept['team_id']] = $this->lang->line('team')." : ".$dept['name'];
 						$object2['D_'.$dept['team_id']] = $dept['name'];
 					}
 				}
 			if($assign_form == "Company")
 			{
 				$object['Company'] = $this->lang->line('company');
 				$object1['Company'] = $this->lang->line('company');
 			}else
 			{
 				$assign_form = explode('-', $assign_form);
 				foreach($assign_form as $val)
 				{
 					$val = explode('_', $val);
 					switch($val[0])
 					{
 						case "company":
 							$object['Company'] = $this->lang->line('company');
 							$object1['Company'] = $this->lang->line('company');
 							break;
 						case "D":
 							$dept = $dept = $this->Hrteam_model->getItemByIdTeam($val[1]);
 							$object[$dept['team_id']] = $this->lang->line('team')." : ".$dept['name'];
 							$object1['D_'.$dept['team_id']] = $dept['name'];
 							break;
 						case "H":
 							$p = $this->Hr_model->getItemByIdHr($val[1]);
 							$dept  = $this->Hrteam_model->getItemById($p['team']);
 							$object[$p['id_hr']] = $p['fullname']." - ".$this->lang->line('team')." : ".$dept['name'];
 							$object1['H_'.$p['id_hr']] = $p['fullname']." - ".$dept['name'];
 							break;		
 					}
 				}
 			}
 			$view = array(
 				'title' => 'Báo cáo tồn kho',
 				'view' => 'report2',
 				'userLogin' => $userLogin,
 				'item' => $items,
 				'table' => $table,
 				'HR' => $HR,
 				'object' => $object,
 				'use' => $use,
 				"object1" => $object1,
 				"object2" => $object2,
 				"tb2" => $tb
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 }