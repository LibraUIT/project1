<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Thietbi extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('User_model');
 		$this->load->model('Tb_model');
 		$this->load->model('Use_model');
 		$this->load->model('Hrteam_model');
 		$this->load->model('Hr_model');
 		if($this->session->userdata('lang') !== null)
 		{
 			$this->lang->load($this->session->userdata('lang')['0'], $this->session->userdata('lang')['1']);
 		}else
 		{
 			$this->lang->load('vi', 'vietnamese');
 		}
 	} 
 	public function submit()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$date1 = date_create($this->input->post('timebuy'));
			$date2 = date_create($this->input->post('timeuse'));
			$nameTb = $this->input->post('nameTb');
			$idTb= $this->input->post('idTb');
			$desc = $this->input->post('desc');
			$note = $this->input->post('note');
			$timebuy = date_format($date1 , 'Y-m-d');
			$timeuse = date_format($date2 , 'Y-m-d');
			//$insert = $this->Tb_model->insertItem($nameTb, $idTb, $desc ,$note, $timebuy, $timeuse);
			$check = $this->Tb_model->checkExit($idTb);
			if($check == "TRUE")
			{
				$this->Tb_model->insertItem($nameTb, $idTb, $desc ,$note, $timebuy, $timeuse);
				echo "TRUE";
			}else
			{
				echo "FAlSE";
			}
		}
 	}
 	public function getList()
 	{
 		$offset = 0;
 		$limit = 10;
 		$listItem = $this->Tb_model->getListItemLimit($offset, $limit);
 		$total = $this->Tb_model->getCountAll();
 		$countItemLimit = $this->Tb_model->getCountAllResultLimit($offset, $limit);
 		$data = array(
 				"listItem" => $listItem,
 				"total" => $total,
 				"limit" => $limit,
 				"countItemLimit" => $countItemLimit
 			);
 		header('Content-Type: application/json');
    	echo json_encode($data);
 	}
 	public function edit($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$item = $this->Tb_model->getItemById($id);
 			$view = array(
 				'title' => 'Chỉnh sửa',
 				'view' => 'edit_tb',
 				'userLogin' => $userLogin,
 				'item' => $item
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function update()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			/*$date1 = date_create($this->input->post('timebuy'));
			$date2 = date_create($this->input->post('timeuse'));*/
			$id = $this->input->post('id');
			$nameTb = $this->input->post('nameTb');
			$idTb= $this->input->post('idTb');
			$desc = $this->input->post('desc');
			$note = $this->input->post('note');
			//$timebuy = date_format($date1 , 'Y-m-d');
			//$timeuse = date_format($date2 , 'Y-m-d');
			$update = array(
					"name" => $nameTb,
					"idTb" => $idTb,
					"descTb" => $desc,
					"note" => $note
					//"date_buy" => $timebuy,
					//"date_use" => $timeuse
				);
			$check = $this->Tb_model->checkExitNotByIdTb($id, $idTb);
			if($check == "TRUE")
			{
				$this->Tb_model->updateItemById($update, $id) ;
				echo "TRUE";
			}else
			{
				echo "FAlSE";
			}
			
		}
 	}
 	public function createSetUse()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$date = date_create($this->input->post('dateUse'));
			$object = $this->input->post('object');
			$data = $this->input->post('data');
			$idTb = $this->input->post('idTb');
			$note = $this->input->post('note');
			$dateUse = date_format($date, 'Y-m-d');
			$insert = array(
					"id_tb" => $idTb,
					"object" => $object,
					"date" => $dateUse,
					"note" => $note,
					"permission" => $data
				);
			$this->Use_model->insertItem($insert);
			echo "TRUE";
		}
 	}
 	public function delTbUse($id)
 	{
 		//$this->Use_model->deleteItemById($id);
 		$assign = $this->Use_model->getItemById($id);
 		/*$tbs = explode('-', $assign['id_tb']);
 		foreach($tbs as $tb)
 		{
 			$t = $this->Tb_model->getItemByIdTb($tb);
 			$quantity = $t['quantity'];
 			$quantity_assign = $t['quantity_assign'] - 1;
 			$update = array(
 					"quantity" => $quantity,
 					"quantity_assign" => $quantity_assign
 				);
 			$this->Tb_model->updateItemById($update, $t['id']);
 		}*/
 		$t = $this->Tb_model->getItemByIdTb($assign['id_tb']);
 		
 		if($assign['type'] == 1)
 		{	
 			$quantity_assign = $t['quantity_assign'] - 1;
	 		$update = array(
	 					"quantity_assign" => $quantity_assign
	 				);
	 	}else if($assign['type'] == 2)
	 	{
	 		$quantity_cancle = $t['quantity_cancle'] - 1;
	 		$update = array(
	 					"quantity_cancle" => $quantity_cancle
	 				);
	 	}else if($assign['type'] == 3)
	 	{
	 		$quantity_destroy = $t['quantity_destroy'] - 1;
	 		$update = array(
	 					"quantity_destroy" => $quantity_destroy
	 				);
	 	}
	 	$this->Tb_model->updateItemById($update, $t['id']);
	 	$this->Tb_model->deleteItemTbHR($assign['id_use']);
	 	$this->Use_model->deleteItemById($id);
  		redirect('/auth/managers', 'location', 301);
 	}
 	public function editUse($id)
 	{
 		if($this->session->userdata('login') !== null)
 		{
 			$loginId = $this->session->userdata('login');
 		}else
 		{	
 			$loginId = 3;
 		}	
 			$userLogin = $this->User_model->getUserById($loginId);
 			$lists = $this->Tb_model->getListNotUsed();
 			$teams = $this->Hrteam_model->getListItem();
 			$hrs = $this->Hr_model->getListItem();
 			$item = $this->Use_model->getItemById($id);
 			$lists[] = $this->Tb_model->getItemById($item['id_tb']);
 			switch ($item['object']) {
	 				case 1:
	 						$object = $this->lang->line('all');
	 					break;
	 				case 2:
	 						$permission = explode( '_', $item['permission']) ;
	 						$string = '';
	 						for($i = 0; $i < count($permission) ; $i++)
	 						{
	 							$per = $this->Hrteam_model->getItemById(1);
	 							
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
	 							$per = $this->Hr_model->getItemById(1);
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
	 		$tb = $this->Tb_model->getItemById($item['id_tb']);	
	 		$arr = array(
 					"use_id" => $item['id'],
 					"ob" => $item['object'],
 					"name_tb" => $tb['name'],
 					"date_use" => $item['date'],
 					"note_use" => $item['note'],
 					"object_use" => $object
 				);
 			$view = array(
 				'title' => 'Chỉnh sửa',
 				'view' => 'edit_use',
 				'userLogin' => $userLogin,
 				'item' => $arr,
 				'lists' => $lists,
 				'teams' => $teams,
 				'hrs' => $hrs
 				);
 			$this->load->view('template', $view);
 		/*}else
 		{
 			redirect('/auth/index', 'location', 301);
 		}*/
 	}
 	public function updateUse()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$use_id = $this->input->post('id');
			$object = $this->input->post('object');
			$permission = $this->input->post('data');
			$tb_id = $this->input->post('idTb');
			$note = $this->input->post('note');
			$date = date_create($this->input->post('dateUse'));
			$date_use = date_format($date, 'Y-m-d');
			$update = array(
					"id_tb" => $tb_id,
					"object" => $object,
					"permission" => $permission,
					"date" => $date_use,
					"note" => $note
				);
			$this->Use_model->updateItemById($use_id, $update);
			echo "TRUE";
		}
 	}
 	public function getUpdateUse()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$item = $this->Use_model->getItemById($this->input->post('id'));
			header('Content-Type: application/json');
			echo json_encode($item);
		}
 	}
 	public function delTb()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$id = $this->input->post('id');
			$check  = $this->Tb_model->checkItemNotUse($id);
	 		if($check == "TRUE")
	 		{
	 			$this->Tb_model->deleteItemByIdTb($id);
	 			echo "TRUE";
	 		}else
	 		{
	 			echo "FAlSE";
	 		}
		}
 	}
 	public function getById()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$id = $this->input->post('id');
			$item = $this->Tb_model->getItemById($id);
			header('Content-Type: application/json');
			echo json_encode($item);
		}
 	}
 	public function updateQuantity()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$id = $this->input->post('id');
			$quantity = $this->input->post('quantity');
			$date1 = date_create($this->input->post('timebuy'));
			$date2 = date_create($this->input->post('timeuse'));
			$date_buy = date_format($date1, 'Y-m-d');
			$time_use = date_format($date2, 'Y-m-d');
			$update = array(
					"date_buy" => $date_buy,
					"date_use" => $time_use,
					"quantity" => $quantity
				);
			$this->Tb_model->updateItemById($update, $id) ;
			echo "TRUE";
		}
 	}
 	public function test()
 	{
 		
 		$assigns = $this->Tb_model->getListTbHr();
 		$trees = array();
 		foreach($assigns as $assign)
 		{
 			$tb = $this->Tb_model->getItemByIdTb($assign['tb']);
 			$hr = $assign['hr'];
 			if($hr == "Company")
 			{
 				$hr = "company";
 			}else {
 				$hr = explode('_', $hr);
 				if(count($hr) > 1)
 				{
 					$dept = $this->Hrteam_model->getItemByIdTeam($hr[1]);
 					$hr = $dept['team_id'];
 				}else
 				{
 					$hr = $hr[0];
 				}
 			}
 			$trees[] = array(
 					"tb_name" => $tb['name'],
 					"ob" => $hr
 				);
 		}
 		echo '<pre>';
 		print_r($trees);
 		echo '</pre>';
 	}
 	public function assign()
 	{
 		$trees = array();
 		$trees[] = array(
 				"label" => $this->lang->line('company'),
 				"category" => "",
 				"value" => $this->lang->line('company'),
 				"id" => "Company"
 			);
 		$company = array("name"=> "Company", "value" => "root");
 		$depts = $this->Hrteam_model->getListItem();
 		foreach($depts as $dept)
 		{
 			$hrs = $this->Hr_model->getListItemByTeamId($dept['id']);
 			$company['depts'][] = array(
 					"id" => $dept['id'],
 					"name" => $dept['name'],
 					"value" => $dept['team_id'],
 					"hrs" => $hrs
 				);
 			$trees[] = array(
 					"label" => $dept['name'],
 					"category" => "<b>".$this->lang->line('company')."</b>",
 					"value" => $dept['name'],
 					"id" => "D_".$dept['team_id']
 				);
 			if(count($hrs) > 0)
 			{
 				foreach($hrs as $hr)
	 			{
	 				$trees[] = array(
	 						"label" => $hr['fullname']."-".$dept['name'],
	 						"category" => "<b>".$dept['name']."<b>",
	 						"value" => $hr['fullname']."-".$dept['name'],
	 						"id" => "H_".$hr['id_hr']
	 					);
	 			}
 			}
 		}
 		header('Content-Type: application/json');
		echo json_encode($trees);
 	}
 	public function getListTb()
 	{
 		$tbs = $this->Tb_model->getList();
 		$trees = array();
 		foreach($tbs as $tb)
 		{
 			if($tb['quantity'] > 0)
 			{
 				$trees[] = array(
 					"label" => $tb['name']." - ".$tb['idTb'],
 					"category" => "",
 					"value" => $tb['name']." - ".$tb['idTb'],
 					"id" => $tb['idTb']
 				);
 			}
 			
			//$trees[] = $tb['name']." - ".$tb['idTb'];
 		}
 		header('Content-Type: application/json');
		echo json_encode($trees);
 	}
 	public function createAssign()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$type = $this->input->post('type');
			$assign_from = $this->input->post('assign_from');
			$assign_to = $this->input->post('assign_to');
			$select_tb = $this->input->post('select_tb');
			$note = $this->input->post('note');
			$date = date_create($this->input->post('date'));
			$date_assign = date_format($date, 'Y-m-d');
			$tbs = explode('-', $select_tb);
			$hrs = explode('-', $assign_to);
			$idNo = $assign_to.$select_tb.date('dmYHis');
	
					foreach($tbs as $tb)
					{
						
						$item = $this->Tb_model->getItemByIdTb($tb);;
						if($type == 1)
						{	
							$quantity_assign = $item['quantity_assign'] + 1;
							$update = array(
									"quantity_assign" => $quantity_assign
								);
							$this->Tb_model->updateItemById($update, $item['id']);
						}else if($type == 2)
						{
							$quantity_cancle = $item['quantity_cancle'] + 1;
							$update = array(
									"quantity_cancle" => $quantity_cancle
								);
							$this->Tb_model->updateItemById($update, $item['id']);
						}else if($type == 3)
						{
							$quantity_destroy = $item['quantity_destroy'] + 1;
							$update = array(
									"quantity_destroy" => $quantity_destroy
								);
							$this->Tb_model->updateItemById($update, $item['id']);
						}

						
						foreach($hrs as $hr)
						{
							
							$ID_USE = $tb."-".$hr;
							$array = array("H_", "D_");
							$ID_USE = str_replace($array, '', $ID_USE) ;
							$AT = $hr;
							$hr = explode('_', $hr);
							
						
								switch($hr[0])
								{
									case "H" :
										 $insert = array(
										 		"type" => $type,
										 		"assign" => $ID_USE,
										 		"hr" => "H_".$hr[1],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										 $this->Tb_model->insertTbHR($insert);
										break;
									case "Company":
										$insert = array(
												"type" => $type,
										 		"assign" => $ID_USE,
										 		"hr" => $hr[0],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										 $this->Tb_model->insertTbHR($insert);
										break;
									case "D":
										$insert = array(
												"type" => $type,
										 		"assign" => $ID_USE,
										 		"hr" => "D_".$hr[1],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										 $this->Tb_model->insertTbHR($insert);
										 break;			
								}
								$insert = array(
										"type" => $type,
										"id_use" => $ID_USE,
										"object1" => $assign_from,
										"object2" => $AT,
										"id_tb" => $tb,
										"date" => $date_assign,
										"note" => $note,
										"id_no" => $idNo
									);
							
							$this->Use_model->insertItem($insert);
						}
					}

					echo "TRUE";
			
		}
 	}
 	public function updateAssign()
 	{
 		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}else
		{
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			$idTbHr = $this->input->post('idTbHr');
			$assign_from = $this->input->post('assign_from');
			$assign_to = $this->input->post('assign_to');
			$select_tb = $this->input->post('select_tb');
			$note = nl2br($this->input->post('note'));
			$date = date_create($this->input->post('date'));
			$date_assign = date_format($date, 'Y-m-d');

			$tbs = explode('-', $select_tb);
			$hrs = explode('-', $assign_to);
							
			$exist  = 1;
			if($exist == 0)
			{
				echo "FAlSE";
			}
			else{
					
					// Update old tbs
						$old = $this->Use_model->getItemById($id);
						$old_tb = $old['id_tb'];
						$t = $this->Tb_model->getItemByIdTb($old_tb);
						$update_old = array(
									"quantity_assign" => $t['quantity_assign'] -1
								);
						$this->Tb_model->updateItemById($update_old, $t['id']);
						$update = array(
								"id_use" => $ID_USE,
								"object1" => $assign_from,
								"object2" => $assign_to,
								"id_tb" => $select_tb,
								"date" => $date_assign,
								"note" => $note
							);
						$this->Use_model->updateItemById($id, $update);

					/*foreach($tbs as $tb)
					{
						$item = $this->Tb_model->getItemByIdTb($tb);
						$quantity = $item['quantity'];
						$quantity_assign = $item['quantity_assign'] + 1;
						$update_as = array(
								//"quantity" => $quantity,
								"quantity_assign" => $quantity_assign
							);
						$this->Tb_model->updateItemById($update_as, $item['id']);
						/*$old = $this->Use_model->getItemById($id);
						$old_tb = explode('-', $old['id_tb']);
						foreach($old_tb as $otb)
						{
							$t = $this->Tb_model->getItemByIdTb($otb);
							$update_old = array(
									//"quantity" => $t['quantity'],
									"quantity_assign" => $t['quantity_assign'] -1
								);
							$this->Tb_model->updateItemById($update_old, $t['id']);
						}
						*/
						//
						/*$this->Tb_model->deleteItemTbHR($idTbHr);
						foreach($hrs as $hr)
						{
							$ID_USE = $tb."-".$hr;
							$array = array("H_", "D_");
							$ID_USE = str_replace($array, '', $ID_USE) ;
							$AT = $hr;
							$hr = explode('_', $hr);
							if($type == 1)
							{


								switch($hr[0])
								{
									case "H" :
										 $insert = array(
										 		"assign" => $ID_USE,
										 		"hr" => $hr[1],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										 $this->Tb_model->insertTbHR($insert);
										break;
									case "Company":
										$insert = array(
										 		"assign" => $ID_USE,
										 		"hr" => $hr[0],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										$this->Tb_model->insertTbHR($insert);
										break;
									case "D":
										$insert = array(
										 		"assign" => $ID_USE,
										 		"hr" => "D_".$hr[1],
										 		"tb" => $item['idTb'],
										 		"date" => $date_assign
										 	);
										 $this->Tb_model->insertTbHR($insert);
										 break;			
								}
								$update = array(
										"id_use" => $ID_USE,
										"object1" => $assign_from,
										"object2" => $AT,
										"id_tb" => $tb,
										"date" => $date_assign,
										"note" => $note
									);
								$this->Use_model->updateItemById($id, $update);
							}
						}
					}*/
					//echo $ID_USE;
			}
		}
	}
	public function excel_1()
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
			
					$items = $this->Tb_model->getList();
					$row = 1;
					$stt = 1;
					$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $this->lang->line('serial'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $this->lang->line('tb_id'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $this->lang->line('tb_name'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $this->lang->line('quantity_buy'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $this->lang->line('quantity_assign'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $this->lang->line('quantity_cancle'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $this->lang->line('quantity_destroy'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $this->lang->line('quantity_free'));
					$row++;
					foreach($items as $item)
					{
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $stt);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $item['idTb']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $item['name']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $item['quantity']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $item['quantity_assign']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $item['quantity_cancle']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $item['quantity_destroy']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $item['quantity'] + $item['quantity_cancle'] - $item['quantity_assign'] - $item['quantity_destroy']);
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
	public function excel_2()
	{
		$items = $this->Use_model->getListItem();
		$array = array();
		$listTo = array();
		$listFrom = array();
		$hrs = $this->Hr_model->getListItem();
		$depts = $this->Hrteam_model->getListItem();
		$Tb = $this->Tb_model->getList();
		$listTb = array();
		foreach($hrs as $hr)
		{
			$listTo[$hr['id_hr']] = $hr;
		}
		foreach($depts as $f)
		{
			$listFrom[$f['team_id']] = $f;
		}
		foreach($Tb as $t)
		{
			$listTb[$t['idTb']] = $t;
		}
		foreach($items as $item)
		{
			$idFrom = $item['object1'];
			if($idFrom == "Company")
			{
				$idFrom = $idFrom;
				$nameFrom = $this->lang->line('company');
			}else
			{
				$idFrom = explode('_', $idFrom);
				if($idFrom[0] == "D")
				{
					if(array_key_exists($idFrom[1], $listFrom))
					{
						$idFrom = $idFrom[1];
						$nameFrom = $listFrom[$idFrom]['name'];
					}
				}else
				{
					if(array_key_exists($idFrom[1], $listTo))
					{
						$idFrom = $idFrom[1];
						$nameFrom = $listTo[$idFrom]['fullname'];
					}
				}
			}
			$idTo = $item['object2'];
			if($idTo == "Company")
			{
				$idTo = $idTo;
				$nameTo = $this->lang->line('company');
			}else
			{
				$idTo = explode('_', $idTo);
				if($idTo[0] == "D")
				{
					if(array_key_exists($idTo[1], $listFrom))
					{
						$idTo = $idTo[1];
						$nameTo = $listFrom[$idTo]['name'];
					}
				}else
				{
					if(array_key_exists($idTo[1], $listTo))
					{
						$idTo = $idTo[1];
						$nameTo = $listTo[$idTo]['fullname'];
					}
				}
			}
			$idTb = $item['id_tb'];
			if(array_key_exists($idTb, $listTb))
			{
				$idTb = $idTb;
				$nameTb = $listTb[$idTb]['name'];
			}
			$date = date_create($item['date']);
			$date = date_format($date, 'd-m-Y');
			$type = array(
					1 => $this->lang->line('type_1'),
					2 => $this->lang->line('type_2'),
					3 => $this->lang->line('type_3')
				);
			$array[] = array(
					"id" => $item['id'],
					"type" => $type[$item['type']],
					"idFrom" => $idFrom,
					"nameFrom" => $nameFrom,
					"idTo" => $idTo,
					"nameTo" => $nameTo,
					"idTb" => $idTb,
					"nameTb" => $nameTb,
					"date" => $date,
					"note" => $item['note']
				);
			
		}
		///Export Excel
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
			
					$row = 1;
					$stt = 1;
					$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $this->lang->line('serial'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $this->lang->line('id_assign'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $this->lang->line('type'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $this->lang->line('assign_from'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $this->lang->line('id'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $this->lang->line('assign_to'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $this->lang->line('id'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $this->lang->line('tb_id'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $this->lang->line('tb_name'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $this->lang->line('tb_quantity'));
					$excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $this->lang->line('date_use'));
					$row++;
					foreach($array as $arr)
					{
						$excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $stt);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $arr['id']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $arr['type']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $arr['nameFrom']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $arr['idFrom']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $arr['nameTo']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $arr['idTo']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $arr['idTb']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $arr['nameTb']);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, 1);
						$excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $arr['date']);
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