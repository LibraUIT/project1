<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Hr extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('User_model');
 		$this->load->model('Tb_model');
 		$this->load->model('Hrlevel_model');
 		$this->load->model('Hrteam_model');
 		$this->load->model('Hr_model');
 		if($this->session->userdata('lang') !== null)
 		{
 			//$this->lang->load($this->session->userdata('lang'));
 			$this->lang->load($this->session->userdata('lang')['0'], $this->session->userdata('lang')['1']);
 		}else
 		{
 			$this->lang->load('vi', 'vietnamese');
 		}
 	}
 	public function createHrLevel()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$levelid = $this->input->post('levelid');
			$name = $this->input->post('name');
			$note = $this->input->post('note');
			//$exit = $this->Hrlevel_model->checkExit($name);
			$exit = $this->Hrlevel_model->checkExitLevelId($levelid);
			if($exit == "TRUE")
			{
				$insert = array(
					"level_id" => $levelid,
					"name" => $name,
					"note" => $note
					);
				$this->Hrlevel_model->insertItem($insert);
				echo "TRUE";
			}else
			{
				echo "FALSE";
			}
		}
 	}
 	public function edit_level($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$item = $this->Hrlevel_model->getItemById($id);
 			$view = array(
 				'title' => 'Chỉnh sửa',
 				'view' => 'edit_hrlevel',
 				'userLogin' => $userLogin,
 				'item' => $item
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function updateHrLevel()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$id = $this->input->post('id');
			$levelid = $this->input->post('levelid');
			$name = $this->input->post('name');
			$note = $this->input->post('note');
			//$exit = $this->Hrlevel_model->checkExitNotById($id, $name);
			$exit = $this->Hrlevel_model->checkExitLevelIdNotById($id, $levelid);
			if($exit == "FALSE")
			{
				echo "FALSE";
			}else
			{
				$update = array(
						"level_id" => $levelid,
						"name" => $name,
						"note" => $note
					);
				$this->Hrlevel_model->updateItemById($id, $update);
				echo "TRUE";
			}
		}
 	} 
 	public function del_level($id)
 	{
 		$this->Hrlevel_model->deleteItemById($id);
 		redirect('/auth/hrlevel', 'location', 301);
 	}
 	public function createHrTeam()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$teamid = $this->input->post('teamid');
			$name = $this->input->post('name');
			$note = $this->input->post('note');
			//$exit = $this->Hrteam_model->checkExit($name);
			$exit = $this->Hrteam_model->checkExitTeamId($teamid);
			if($exit == "TRUE")
			{
				$insert = array(
					"team_id" => $teamid,
					"name" => $name,
					"note" => $note
					);
				$this->Hrteam_model->insertItem($insert);
				echo "TRUE";
			}else
			{
				echo "FALSE";
			}
		}
 	}
 	public function del_team($id)
 	{
 		$this->Hrteam_model->deleteItemById($id);
 		redirect('/auth/hrteam', 'location', 301);
 	}
 	public function edit_team($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$item = $this->Hrteam_model->getItemById($id);
 			$view = array(
 				'title' => 'Chỉnh sửa',
 				'view' => 'edit_hrteam',
 				'userLogin' => $userLogin,
 				'item' => $item
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function updateHrTeam()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$id = $this->input->post('id');
			$teamid = $this->input->post('teamid');
			$name = $this->input->post('name');
			$note = $this->input->post('note');
			//$exit = $this->Hrteam_model->checkExitNotById($id, $name);
			$exit = $this->Hrteam_model->checkExitTeamIdNotById($id, $teamid);
			if($exit == "FALSE")
			{
				echo "FALSE";
			}else
			{
				$update = array(
						"team_id" => $teamid,
						"name" => $name,
						"note" => $note
					);
				$this->Hrteam_model->updateItemById($id, $update);
				echo "TRUE";
			}
		}
 	}
 	public function createHr()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$date_create = date_create($this->input->post('timejoin'));
			$fullname = $this->input->post('fullname');
			$idHr = $this->input->post('idHr');
			$level = $this->input->post('level');
			$team = $this->input->post('team');
			$timejoin = date_format($date_create,"Y-m-d");
			$email = $this->input->post('email');
			$skype = $this->input->post('skype');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$note = $this->input->post('note');
			$exit = $this->Hr_model->checkExit($idHr);
			if($exit == "TRUE")
			{
				$insert = array(
						"fullname" => $fullname,
						"id_hr" => $idHr,
						"level" => $level,
						"team" => $team,
						"date_join" => $timejoin,
						"email" => $email,
						"skype" => $skype,
						"address" => $address,
						"phone" => $phone,
						"note" => $note
					);
				$this->Hr_model->insertItem($insert);
				echo "TRUE";
			}else
			{
				echo "FALSE";
			}
		}
 	}
 	public function del_hr($id)
 	{
 		$this->Hr_model->deleteItemById($id);
 		redirect('/auth/hrb', 'location', 301);
 	}
 	public function editHr($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$item = $this->Hr_model->getItemById($id);
 			$levels = $this->Hrlevel_model->getListItem();
 			$teams = $this->Hrteam_model->getListItem();
 			$view = array(
 				'title' => 'Chỉnh sửa',
 				'view' => 'edit_hr',
 				'userLogin' => $userLogin,
 				'item' => $item,
 				'levels' => $levels,
 				'teams' => $teams
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function updateHr()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$date_create = date_create($this->input->post('timejoin'));
			$id = $this->input->post('id');
			$fullname = $this->input->post('fullname');
			$idHr = $this->input->post('idHr');
			$level = $this->input->post('level');
			$team = $this->input->post('team');
			$timejoin = date_format($date_create,"Y-m-d");
			$email = $this->input->post('email');
			$skype = $this->input->post('skype');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$note = $this->input->post('note');
			$exit = $this->Hr_model->checkExitNotByIdHr($id, $idHr);
			if($exit == "FALSE")
			{
				echo "FALSE";
			}else
			{
				$update = array(
						"fullname" => $fullname,
						"id_hr" => $idHr,
						"level" => $level,
						"team" => $team,
						"date_join" => $timejoin,
						"email" => $email,
						"skype" => $skype,
						"address" => $address,
						"phone" => $phone,
						"note" => $note
					);

				$this->Hr_model->updateItemById($id, $update);
				echo "TRUE";
			}
		}
 	}
 	public function excel_2()
	{
			set_include_path(implode(PATH_SEPARATOR, [
			    realpath(__DIR__ . '/Classes'), // assuming Classes is in the same directory as this script
			    get_include_path()
			]));

			require_once 'PHPExcel.php';
			$excel = new PHPExcel(); 
			//activate worksheet number 1
			$excel->setActiveSheetIndex(0);
			$excel->setActiveSheetIndex(0);
			//name the worksheet
			$excel->getActiveSheet()->setTitle('test worksheet');
			//set cell A1 content with some text
			//set aligment to center for that merged cell (A1 to D1)
			// Result
					 $items = $this->Hr_model->getListItem();
					$row = 1;
					$stt = 1;
					$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $this->lang->line('serial'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $this->lang->line('idhr'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $this->lang->line('fullname'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $this->lang->line('level'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $this->lang->line('team'));
					$row++;
					foreach($items as $item)
					{
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $stt);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $item['id_hr']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $item['fullname']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $item['level']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $item['team']);
						$row++;
						$stt++;

					}
					
			
			//
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			 
			$filename='Report.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

	} 
 }