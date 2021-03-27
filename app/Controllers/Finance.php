<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Mpdf\Mpdf;
use CodeIgniter\HTTP\Files\UploadedFile;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Finance extends Controller
{
	protected $helpers = ['fn_helper'];

	public function __construct()
	{
		helper('cookie');

		$this->account_model = model('account_model');
		$this->finance_model = model('finance_model');

		$session = session();
		if (!$session->has('login')) {
			return redirect()->to('/login');
		}
	}
	// -----------------------------------------------------------------
	public function actions_debtor()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->account_model->getDebtorByDate($startmon, $endmon);
			$data['title'] = 'บันทึกข้อมูลสมาชิก';
			echo view('header', $data);
			echo view('fn/list_debtor');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'debtor_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ชื่อสมาชิก", "รหัสสมาชิก", "อายุสมาชิก", "เลขที่บัญชี", "วันที่", "สถานะ", "ยอดคงเหลือ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getDebtorByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$date = new DateTime($x['date']);
						$now = new DateTime();
						$now = $now->modify('+543 year');
						$interval = $now->diff($date);
						$x['age'] = $interval->y;
						// $x['date'] = date_format(date_create($x['date']),"d/m/Y");
						$x['date'] = date('Y/m/d', strtotime($x['date']));
						$excel = [
							'name' 						=> $x['name'],
							'id' 						=> 'MOPH-' . sprintf('%07d', $x['id']),
							'age' 						=> $x['age'],
							'follower_account_number'	=> $x['follower_account_number'],
							'date' 						=> $x['date'],
							'alive' 					=> $x['alive'],
							'balance' 					=> $x['balance'] ? $x['balance'] : 0,

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		} else
			return redirect()->to('/finance/list_debtor');
	}
	// -----------------------------------------------------------------
	public function list_debtor()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'debtor_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ชื่อสมาชิก", "รหัสสมาชิก", "อายุสมาชิก", "เลขบัตรประชาชน", "เลขที่บัญชี", "วันเกิด", "สถานะ", "ยอดคงเหลือ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getDebtorByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$date = new DateTime($x['date']);
						$now = new DateTime();
						$now = $now->modify('+543 year');
						$interval = $now->diff($date);
						$x['age'] = $interval->y;
						// $x['date'] = date_format(date_create($x['date']),"d/m/Y");
						$x['date'] = date('Y/m/d', strtotime($x['date']));
						$excel = [
							'id' 						=> $x['id'],
							'name' 						=> $x['name'],
							'member_id' 				=> 'MOPH-' . sprintf('%07d', $x['id']),
							'age' 						=> $x['age'],
							'taxpayer_number'			=> $x['taxpayer_number'],
							'follower_account_number'	=> $x['follower_account_number'],
							'date' 						=> $x['date'],
							'alive' 					=> $x['alive'],
							'balance' 					=> $x['balance'] ? $x['balance'] : 0,

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

		$data['data'] = $this->account_model->getDebtor($startmon, $endmon);

		// $data['data'] = $this->account_model->getDebtor();
		$data['title'] = 'บันทึกข้อมูลสมาชิก';
		echo view('header', $data);
		echo view('fn/list_debtor');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_debtor($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getDebtorByID($id);
			$data['title'] = 'รายละเอียดข้อมูลลูกหนี้';
			echo view('header', $data);
			echo view('fn/view_debtor');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_debtor');
	}
	// -----------------------------------------------------------------	
	public function view_debtor_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getDebtorByID($id);
			$data['title'] = 'รายละเอียดข้อมูลลูกหนี้';
			echo view('fn/view_debtor_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function debtor()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'name'     					=> $this->request->getPost('name'),
				'date'      				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'gender'      				=> $this->request->getPost('gender'),
				'taxpayer_number'   		=> $this->request->getPost('taxpayer_number'),
				'address'     				=> $this->request->getPost('address'),
				'email'    					=> $this->request->getPost('email'),
				'telephone'   				=> $this->request->getPost('telephone'),
				'alive'    					=> $this->request->getPost('alive') ? $this->request->getPost('alive') : 'มีชีวิต',

				'follower_name'     		=> $this->request->getPost('follower_name'),
				'follower_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('follower_date')))),
				'follower_taxpayer_number'  => $this->request->getPost('follower_taxpayer_number'),
				'follower_address'     		=> $this->request->getPost('follower_address'),
				'follower_email'    		=> $this->request->getPost('follower_email'),
				'follower_telephone'   		=> $this->request->getPost('follower_telephone'),
				'follower_account_number'   => $this->request->getPost('follower_account_number'),
				'follower_account_name'   	=> $this->request->getPost('follower_account_name'),
				'follower_account_type'   	=> $this->request->getPost('follower_account_type') ? $this->request->getPost('follower_account_type') : 1,
				'follower_account_branch'   => $this->request->getPost('follower_account_branch'),
				'follower_relationship'   	=> $this->request->getPost('follower_relationship'),
				'relationship'  	 		=> $this->request->getPost('relationship'),

				'emergency_name'     		=> $this->request->getPost('emergency_name'),
				'emergency_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('emergency_date')))),
				'emergency_taxpayer_number'	=> $this->request->getPost('emergency_taxpayer_number'),
				'emergency_address'     	=> $this->request->getPost('emergency_address'),
				'emergency_email'    		=> $this->request->getPost('emergency_email'),
				'emergency_telephone'   	=> $this->request->getPost('emergency_telephone'),
				'emergency_account_number'  => $this->request->getPost('emergency_account_number'),
				'emergency_account_name'   	=> $this->request->getPost('emergency_account_name'),
				'emergency_account_type'   	=> $this->request->getPost('emergency_account_type') ? $this->request->getPost('follower_account_type') : 1,
				'emergency_account_branch'  => $this->request->getPost('emergency_account_branch'),


				// 'postal_code'      	=> $this->request->getPost('postal_code') ? $this->request->getPost('postal_code') : NULL,
				// 'note'      		=> $this->request->getPost('note'),
				// 'branch'      		=> $this->request->getPost('branch'),
				// 'payout_type'      	=> $this->request->getPost('payout_type'),
				// 'tax_rate'      	=> $this->request->getPost('tax_rate'),
				// 'tax_type'      	=> $this->request->getPost('tax_type'),
				// 'tax_conditions'    => $this->request->getPost('tax_conditions'),
				// 'payer_type'      	=> $this->request->getPost('payer_type'),
				// 'account_number'    => $this->request->getPost('account_number'),
				// 'unit'      		=> $this->request->getPost('unit') ? $this->request->getPost('unit') : 0,
				// 'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				// 'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				// 'approval_limit'    => $this->request->getPost('approval_limit') ? $this->request->getPost('approval_limit') : 0,
				// 'total_early_year'	=> $this->request->getPost('total_early_year') ? $this->request->getPost('total_early_year') : 0,
				// 'balance'    		=> $this->request->getPost('balance') ? $this->request->getPost('balance') : 0,
				// 'prepaid_checks'    => $this->request->getPost('prepaid_checks'),
				// 'name'    			=> $this->request->getPost('name'),
				// 'gender'    		=> $this->request->getPost('gender'),
				// 'follower_data'    	=> $this->request->getPost('follower_data'),
			];
			$path = ROOTPATH . 'public/files';

			if ($this->request->getFile('image')->getpath() != "") {
				$image = $this->request->getFile('image');
				$newName = $image->getRandomName();
				// $image->move(WRITEPATH . 'uploads', $newName);
				$image->move($path, $newName);
				$add['image'] = $newName;
			}
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				// $document->move(WRITEPATH . 'uploads', $newName);
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			if ($this->request->getFile('emergency_document')->getpath() != "") {
				$emergency_document = $this->request->getFile('emergency_document');
				$newName = $emergency_document->getRandomName();
				// $emergency_document->move(WRITEPATH . 'uploads', $newName);
				$emergency_document->move($path, $newName);
				$add['emergency_document'] = $newName;
			}
			if ($this->request->getFile('follower_image')->getpath() != "") {
				$follower_image = $this->request->getFile('follower_image');
				$newName = $follower_image->getRandomName();
				// $follower_image->move(WRITEPATH . 'uploads', $newName);
				$follower_image->move($path, $newName);
				$add['follower_image'] = $newName;
			}

			$this->account_model->addDebtor($add);
			$this->account_model->addLog(1);

			return redirect()->to('/finance/list_debtor');

			// var_dump($add);
		} else {
			$data['title'] = 'บันทึกข้อมูลสมาชิก';
			$data['id'] = $this->account_model->getDebtorLastID();
			echo view('header', $data);
			echo view('fn/debtor');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------	
	public function edit_debtor($id = null)
	{
		if ($id == null) return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'name'     					=> $this->request->getPost('name'),
				'date'      				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'gender'      				=> $this->request->getPost('gender'),
				'taxpayer_number'  			=> $this->request->getPost('taxpayer_number'),
				'address'     				=> $this->request->getPost('address'),
				'email'    					=> $this->request->getPost('email'),
				'telephone'   				=> $this->request->getPost('telephone'),
				'alive'    					=> $this->request->getPost('alive') ? $this->request->getPost('alive') : 'มีชีวิต',
				'follower_name'     		=> $this->request->getPost('follower_name'),
				'follower_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('follower_date')))),
				'follower_taxpayer_number'  => $this->request->getPost('follower_taxpayer_number'),
				'follower_address'     		=> $this->request->getPost('follower_address'),
				'follower_email'    		=> $this->request->getPost('follower_email'),
				'follower_telephone'   		=> $this->request->getPost('follower_telephone'),
				'follower_account_number'   => $this->request->getPost('follower_account_number'),
				'follower_account_name'   	=> $this->request->getPost('follower_account_name'),
				'follower_account_type'   	=> $this->request->getPost('follower_account_type') ? $this->request->getPost('follower_account_type') : 1,
				'follower_account_branch'   => $this->request->getPost('follower_account_branch'),
				'follower_relationship'   	=> $this->request->getPost('follower_relationship'),
				'relationship'   			=> $this->request->getPost('relationship'),

				'emergency_name'     		=> $this->request->getPost('emergency_name'),
				'emergency_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('emergency_date')))),
				'emergency_taxpayer_number'	=> $this->request->getPost('emergency_taxpayer_number'),
				'emergency_address'     	=> $this->request->getPost('emergency_address'),
				'emergency_email'    		=> $this->request->getPost('emergency_email'),
				'emergency_telephone'   	=> $this->request->getPost('emergency_telephone'),
				'emergency_account_number'  => $this->request->getPost('emergency_account_number'),
				'emergency_account_name'   	=> $this->request->getPost('emergency_account_name'),
				'emergency_account_type'   	=> $this->request->getPost('emergency_account_type') ? $this->request->getPost('follower_account_type') : 1,
				'emergency_account_branch'  => $this->request->getPost('emergency_account_branch'),


				// 'postal_code'      	=> $this->request->getPost('postal_code') ? $this->request->getPost('postal_code') : NULL,
				// 'note'      		=> $this->request->getPost('note'),
				// 'branch'      		=> $this->request->getPost('branch'),
				// 'payout_type'      	=> $this->request->getPost('payout_type'),
				// 'tax_rate'      	=> $this->request->getPost('tax_rate'),
				// 'tax_type'      	=> $this->request->getPost('tax_type'),
				// 'tax_conditions'    => $this->request->getPost('tax_conditions'),
				// 'payer_type'      	=> $this->request->getPost('payer_type'),
				// 'account_number'    => $this->request->getPost('account_number'),
				// 'unit'      		=> $this->request->getPost('unit') ? $this->request->getPost('unit') : 0,
				// 'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				// 'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				// 'approval_limit'    => $this->request->getPost('approval_limit') ? $this->request->getPost('approval_limit') : 0,
				// 'total_early_year'	=> $this->request->getPost('total_early_year') ? $this->request->getPost('total_early_year') : 0,
				// 'balance'    		=> $this->request->getPost('balance') ? $this->request->getPost('balance') : 0,
				// 'prepaid_checks'    => $this->request->getPost('prepaid_checks'),
				// 'name'    			=> $this->request->getPost('name'),
				// 'gender'    		=> $this->request->getPost('gender'),
				// 'follower_data'    	=> $this->request->getPost('follower_data'),
			];
			// $path = WRITEPATH . 'uploads';
			$path = ROOTPATH . 'public/files';

			// $path = '/public/files/';
			// var_dump($path);
			if ($this->request->getFile('image')->getpath() != "") {
				$image = $this->request->getFile('image');
				$newName = $image->getRandomName();
				$image->move($path, $newName);
				// $image->move(WRITEPATH . 'uploads', $newName);
				$add['image'] = $newName;
			}
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				// $document->move(WRITEPATH . 'uploads', $newName);
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			if ($this->request->getFile('emergency_document')->getpath() != "") {
				$emergency_document = $this->request->getFile('emergency_document');
				$newName = $emergency_document->getRandomName();
				$emergency_document->move(WRITEPATH . 'uploads', $newName);
				// $document->move($path, $newName);
				$add['emergency_document'] = $newName;
			}
			if ($this->request->getFile('follower_image')->getpath() != "") {
				$follower_image = $this->request->getFile('follower_image');
				$newName = $follower_image->getRandomName();
				// $follower_image->move(WRITEPATH . 'uploads', $newName);
				$follower_image->move($path, $newName);
				$add['follower_image'] = $newName;
			}
			$this->account_model->editDebtor($id, $add);
			$this->account_model->addLog(1);

			// var_dump($this->request->getFile('image')->getpath());
			return redirect()->to('/finance/list_debtor');
		} else {
			$data['data'] = $this->account_model->getDebtorByID($id);
			$data['title'] = 'แก้ไขข้อมูลลูกหนี้';

			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['data'][0]['follower_date'] = Date('d/m/Y', strtotime($data['data'][0]['follower_date']));
			$data['data'][0]['emergency_date'] = Date('d/m/Y', strtotime($data['data'][0]['emergency_date']));
			echo view('header', $data);
			echo view('fn/edit_debtor');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_debtor($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteDebtorByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/finance/list_debtor');
		}
	}
	// -----------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'ภาพรวมการเงิน';
		echo view('header', $data);
		echo view('fn/index');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function setting()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'organization_name'	=> $this->request->getPost('organization_name'),
				'telephone'     	=> $this->request->getPost('telephone'),
				'address'     		=> $this->request->getPost('address'),
				'email'     		=> $this->request->getPost('email'),
				'fax'     			=> $this->request->getPost('fax'),
				'logo'     			=> $this->request->getPost('logo'),
				'website'     		=> $this->request->getPost('website'),
				'rate'     			=> $this->request->getPost('rate'),
				'maintenance'  		=> $this->request->getPost('maintenance'),
				'vat'   			=> $this->request->getPost('vat'),
				'fee'   			=> $this->request->getPost('fee'),
			];
			$this->finance_model->editSetting($add);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/setting');
		} else {
			$data['setting'] = $this->finance_model->getSetting();
			$data['title'] = 'ตั้งค่าการเงิน';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/setting');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function actions_receiving_money()
	{
		// if ($this->request->getPost('search')) {
		// 	$from = $this->request->getPost('datepicker_from');
		// 	$to = $this->request->getPost('datepicker_to');

		// 	$data['from'] = $from;
		// 	$data['to'] = $to;
		// 	$data['txt'] = $this->request->getPost('txt');

		// 	$data['data'] = $this->finance_model->getReceiveMoney($from, $to, $txt);
		// 	$data['title'] = 'รายการรับเงินสด';
		// 	echo view('header', $data);
		// 	echo view('fn/list_receiving_money');
		// 	echo view('footer');
		// } else {

		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getReceiveMoneyByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายการรับเงินสด']];
			$data['title'] = 'รายการรับเงินสด';
			echo view('header', $data);
			echo view('fn/list_receiving_money');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'receiving_money_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "เลขที่เอกสาร", "รหัสพนักงาน", "เครดิต(วัน)", "วันนัดรับชำระ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getReceiveMoneyByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['bill_date'] = date('d-m-Y', strtotime($x['bill_date']));
						$x['receive_date'] = date('d-m-Y', strtotime($x['receive_date']));
						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'bill_id' => $x['bill_id'],
							'employee_id' => $x['employee_id'],
							'unit_id' => $x['unit_id'],
							'bill_date' => $x['bill_date'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getReceiveMoneyByID($id);
				}
				$data['title'] = 'Receiving Money';
				$html = view('fn/pdf_receiving_money', $data);
				$filename = 'receiving_money_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('report');
			}
		} else
			return redirect()->to('/finance/list_receiving_money');
		// }
	}
	// -----------------------------------------------------------------
	public function list_receiving_money($startmon = null, $endmon = null, $search = null)
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'receiving_money_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่ใบเสร็จรับเงิน", "รหัสสมาชิก", "ชื่อสมาชิก", "เลขที่เอกสาร", "รหัสพนักงาน", "เครดิต(วัน)", "วันนัดรับชำระ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getReceiveMoneyByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['bill_date'] = date('d-m-Y', strtotime($x['bill_date']));
						$x['receive_date'] = date('d-m-Y', strtotime($x['receive_date']));
						$excel = [
							'id' 			=> $x['id'],
							'customer_id' 	=> 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name'	=> $debtor[0]['name'],
							'bill_id' 		=> $x['bill_id'],
							'employee_id' 	=> $x['employee_id'],
							'unit_id' 		=> $x['unit_id'],
							'bill_date' 	=> $x['bill_date'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('txt_search') ? $this->request->getPost('txt_search') : null;
		$data['data'] = $this->finance_model->getReceiveMoney($startmon, $endmon, $search);
		// $data['data'] = $this->finance_model->getReceiveMoney();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายการรับเงินสด']];

		$data['title'] = 'รายการรับเงินสด';
		echo view('header', $data);
		echo view('fn/list_receiving_money');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_receiving_money($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'รายการรับเงินสด'], ['link' => '#', 'title' => 'รายละเอียดรายการรับเงินสด']];

			$data['title'] = 'รายละเอียดรายการรับเงินสด';
			echo view('header', $data);
			echo view('fn/view_receiving_money');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_receiving_money');
	}
	// -----------------------------------------------------------------
	public function view_receiving_money_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);
			$data['title'] = 'รายละเอียดรายการรับเงินสด';
			echo view('fn/view_receiving_money_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function receiving_money()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'     		=> $this->request->getPost('customer_id'),
				'bill_id'      			=> $this->request->getPost('bill_id'),
				'employee_id'   		=> $this->request->getPost('employee_id'),
				'unit_id'    			=> $this->request->getPost('unit_id'),
				'bill_date'      		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('bill_date')))),
				'group_id'    			=> $this->request->getPost('group_id'),
				'receive_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('receive_date')))),
				'contact'      			=> $this->request->getPost('contact'),
				'status_id'   			=> $this->request->getPost('status_id'),
				'additional_conditions'	=> $this->request->getPost('additional_conditions'),
				'note'      			=> $this->request->getPost('note'),
				// 'cancel_bill'    		=> $this->request->getPost('cancel_bill') ? $this->request->getPost('cancel_bill') : 0
			];
			$this->finance_model->addReceiveMoney($add);
			$this->finance_model->addLog(1);
			// $data['title'] = 'รายการรับเงินสด';
			// $data['add']=$add;
			// echo view('header', $data);
			// echo view('fn/receiving_money');
			// echo view('footer');
			return redirect()->to('/finance/list_receiving_money');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'รายการรับเงินสด'], ['link' => '#', 'title' => 'รายการรับเงินสด']];

			$data['title'] = 'รายการรับเงินสด';
			echo view('header', $data);
			echo view('fn/receiving_money');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_receiving_money($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'     		=> $this->request->getPost('customer_id'),
				'bill_id'      			=> $this->request->getPost('bill_id'),
				'employee_id'   		=> $this->request->getPost('employee_id'),
				'unit_id'    			=> $this->request->getPost('unit_id'),
				'bill_date'      		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('bill_date')))),
				'group_id'    			=> $this->request->getPost('group_id'),
				'receive_date'     		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('receive_date')))),
				'contact'      			=> $this->request->getPost('contact'),
				'status_id'   			=> $this->request->getPost('status_id'),
				'additional_conditions'	=> $this->request->getPost('additional_conditions'),
				'note'      			=> $this->request->getPost('note'),
				// 'cancel_bill'    		=> $this->request->getPost('cancel_bill') ? $this->request->getPost('cancel_bill') : 0
			];
			$this->finance_model->editReceiveMoney($id, $add);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_receiving_money');
		} else {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);;
			$data['title'] = 'แก้ไขรายการรับเงินสด';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'รายการรับเงินสด'], ['link' => '#', 'title' => 'แก้ไขรายการรับเงินสด']];
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['bill_date'] = Date('d/m/Y', strtotime($data['data'][0]['bill_date']));
			$data['data'][0]['receive_date'] = Date('d/m/Y', strtotime($data['data'][0]['receive_date']));
			echo view('header', $data);
			echo view('fn/edit_receiving_money');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_receiving_money($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteReceiveMoneyByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_receiving_money');
		}
	}
	// -----------------------------------------------------------------
	public function actions_datepay()
	{
		if ($this->request->getPost('search')) {
			// $startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			// $endmon = $this->request->getPost('datepicker_to') ?  $this->request->getPost('datepicker_to') : null;

			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ?  $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon . ' ' . $endmon);
			// var_dump($data['data']);


			$data['data'] = $this->finance_model->getDatePayByDate($startmon, $endmon);
			$data['title'] = 'บันทึกวันนัดชำระ';

			echo view('header', $data);
			echo view('fn/list_datepay');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'datepay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "กำหนดนัดหมาย", "สถานะ", "เครดิต(วัน)", "รหัสพนักงาน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getDatePayByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));

						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'date' => $x['date'],
							'status_id' => $x['status_id'],
							'unit_id' => $x['unit_id'],
							'employee_id' => $x['employee_id'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getDatePayByID($id);
				}
				$data['title'] = 'Datepay';
				$html = view('fn/pdf_datepay', $data);
				$filename = 'datepay_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
			}
		} else

			return redirect()->to('/finance/list_datepay');
	}
	// -----------------------------------------------------------------
	public function list_datepay()
	{
		$data['data'] = $this->finance_model->getDatePay();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกวันนัดชำระ']];
		$data['title'] = 'บันทึกวันนัดชำระ';
		echo view('header', $data);
		echo view('fn/list_datepay');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_datepay($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getDatePayByID($id);
			$data['title'] = 'รายละเอียดบันทึกวันนัดชำระ';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_datepay'), 'title' => 'บันทึกวันนัดชำระ'], ['link' => '#', 'title' => 'รายละเอียดบันทึกวันนัดชำระ']];

			echo view('header', $data);
			echo view('fn/view_datepay');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_datepay');
	}
	// -----------------------------------------------------------------
	public function view_datepay_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getDatePayByID($id);
			$data['title'] = 'รายละเอียดบันทึกวันนัดชำระ';
			echo view('fn/view_datepay_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function datepay()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'	=> $this->request->getPost('customer_id'),
				'document_id'   => $this->request->getPost('document_id'),
				'date'      	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'status_id'   	=> $this->request->getPost('status_id'),
				'unit_id'    	=> $this->request->getPost('unit_id'),
				'employee_id'   => $this->request->getPost('employee_id'),
				'note'      	=> $this->request->getPost('note')
			];
			$this->finance_model->addDatePay($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_datepay');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_datepay'), 'title' => 'บันทึกวันนัดชำระ'], ['link' => '#', 'title' => 'บันทึกวันนัดชำระ']];

			$data['title'] = 'บันทึกวันนัดชำระ';
			echo view('header', $data);
			echo view('fn/datepay');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_datepay($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'   => $this->request->getPost('customer_id'),
				'document_id'   => $this->request->getPost('document_id'),
				'date'      	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'status_id'   	=> $this->request->getPost('status_id'),
				'unit_id'    	=> $this->request->getPost('unit_id'),
				'employee_id'   => $this->request->getPost('employee_id'),
				'note'      	=> $this->request->getPost('note')
			];
			$this->finance_model->editDatePay($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_datepay');
		} else {
			$data['data'] = $this->finance_model->getDatePayByID($id);
			$data['title'] = 'แก้ไขบันทึกวันนัดชำระ';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_datepay'), 'title' => 'บันทึกวันนัดชำระ'], ['link' => '#', 'title' => 'แก้ไขบันทึกวันนัดชำระ']];
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_datepay');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_datepay($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteDatePayByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_datepay');
		}
	}
	// -----------------------------------------------------------------
	public function actions_adddebt()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'adddebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัส", "รหัสสมาชิก", "Bill_TO", "แผนก", "วันที่กำหนด", "ที่อยู่", "โทร", "เลขที่เอกสาร", "เลขที่ใบเพิ่มหนี้", "ประเภท", "หมายเหตุ", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAddDebtByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						fputcsv($file, $x);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getAddDebtByID($id);
				}
				$data['title'] = 'Adddebt';
				$html = view('fn/pdf_adddebt', $data);
				$filename = 'datepay_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
			}
		} else

			return redirect()->to('/finance/list_adddebt');
	}
	// -----------------------------------------------------------------
	public function list_adddebt()
	{
		$data['data'] = $this->finance_model->getAddDebt();
		$data['title'] = 'ใบเพิ่มหนี้';
		echo view('header', $data);
		echo view('fn/list_adddebt');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_adddebt($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getAddDebtByID($id);
			$data['title'] = 'รายละเอียดใบเพิ่มหนี้';
			echo view('header', $data);
			echo view('fn/view_adddebt');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_adddebt');
	}
	// -----------------------------------------------------------------
	public function adddebt()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount')
			];
			$this->finance_model->addDebt($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_adddebt');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'ใบเพิ่มหนี้';
			echo view('header', $data);
			echo view('fn/adddebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_adddebt($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount')
			];
			$this->finance_model->editaddDebt($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_adddebt');
		} else {
			$data['data'] = $this->finance_model->getAddDebtByID($id);
			$data['title'] = 'แก้ไขใบเพิ่มหนี้';
			$data['debtor'] = $this->account_model->getDebtor();
			echo view('header', $data);
			echo view('fn/edit_adddebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_adddebt($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteaddDebtByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_adddebt');
		}
	}
	// -----------------------------------------------------------------
	public function actions_reducedebt()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'reducedebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัส", "รหัสลูกหนี้", "Bill_TO", "แผนก", "วันที่กำหนด", "ที่อยู่", "โทร", "เลขที่เอกสาร", "เลขที่ใบเพิ่มหนี้", "ประเภท", "หมายเหตุ", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getReduceDebtByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						fputcsv($file, $x);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getReduceDebtByID($id);
				}
				$data['title'] = 'Reducedebt';
				$html = view('fn/pdf_reducedebt', $data);
				$filename = 'datepay_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
			}
		} else

			return redirect()->to('/finance/list_reducedebt');
	}
	// -----------------------------------------------------------------
	public function list_reducedebt()
	{
		$data['data'] = $this->finance_model->getReduceDebt();
		$data['title'] = 'ใบลดหนี้ / รับคืนสินค้า';
		echo view('header', $data);
		echo view('fn/list_reducedebt');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_reducedebt($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getReduceDebtByID($id);
			$data['title'] = 'รายละเอียดใบลดหนี้ / รับคืนสินค้า';
			echo view('header', $data);
			echo view('fn/view_reducedebt');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_reducedebt');
	}
	// -----------------------------------------------------------------
	public function reducedebt()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount')
			];
			$this->finance_model->reduceDebt($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_reducedebt');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'ใบลดหนี้ / รับคืนสินค้า';
			echo view('header', $data);
			echo view('fn/reducedebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_reducedebt($id = null)
	{
		if ($id == null)
			return false;

		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount')
			];
			$this->finance_model->editreduceDebt($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_reducedebt');
		} else {
			$data['data'] = $this->finance_model->getReduceDebtByID($id);
			$data['title'] = 'แก้ไขใบลดหนี้ / รับคืนสินค้า';
			$data['debtor'] = $this->account_model->getDebtor();
			echo view('header', $data);
			echo view('fn/edit_reducedebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_reducedebt($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deletereduceDebtByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_reducedebt');
		}
	}
	// -----------------------------------------------------------------
	public function actions_acceptpayment()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getAcceptPaymentByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายงานการรับชำระเงิน']];
			$data['title'] = 'รายงานการรับชำระเงิน';
			echo view('header', $data);
			echo view('fn/list_acceptpayment');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'acceptpayment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// $header = array("รหัส", "รหัสลูกหนี้", "Bill_TO", "แผนก", "วันที่กำหนด", "ที่อยู่", "โทร", "เลขที่เอกสาร", "เลขที่ใบเพิ่มหนี้", "ประเภท", "หมายเหตุ", "VAT(กรณีรับ)", "ดอกเบี้ย", "เงินสด", "ชำระโดยอื่นๆ", "ภาษี ณ ที่จ่าย", "ส่วนลดเงินสด", "ยอดชำระเงินจริง");
				$header = array("รหัสสมาชิก", "วันที่กำหนด", "ชื่อสมาชิก", "เลขที่เอกสาร", "ประเภท", "จำนวนเงิน(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAcceptPaymentByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						if ($x['type_id'] == 1) {
							$x['type_id'] = 'ชำระเงินแล้ว';
						} elseif ($x['type_id'] == 2) {
							$x['type_id'] = 'ยังไม่ชำระเงิน';
						} elseif ($x['type_id'] == 3) {
							$x['type_id'] = 'ระหว่างดำเนินการ';
						}
						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'date' => Date('d/m/Y', strtotime($x['date'])),
							'customer_name' => $debtor[0]['name'],
							'no_id' => $x['id'],
							'type_id' => $x['type_id'],
							'payment_amount' => $x['payment_amount'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getAcceptPaymentByID($id);
				}
				$data['title'] = 'Acceptpayment';
				$html = view('fn/pdf_acceptpayment', $data);
				$filename = 'acceptpayment_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->AddPage('L');

				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else

			return redirect()->to('/finance/list_acceptpayment');
	}
	// -----------------------------------------------------------------
	public function actions_acceptpayment_complete()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			// $data['data'] = $this->finance_model->getAcceptPaymentByDate($startmon, $endmon);
			$data['data'] = $this->finance_model->getmoneyreciev2ByDate($startmon, $endmon);
			$data['title'] = 'พิมพ์ใบเสร็จรับเงิน';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => '#', 'title' => 'พิมพ์ใบเสร็จรับเงิน']
			];
			echo view('header', $data);
			echo view('fn/list_acceptpayment_complete');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'acceptpayment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// $header = array("วันที่กำหนด", "รหัสสมาชิก", "ชื่อสมาชิก", "เลขที่เอกสาร", "สถานะ", "จำนวนเงิน(บาท)");
				$header = array("ID", "Record Type", "Sequence No.", "Bank Code", "Company Account", "Payment Date", "Payment Time", "Customer Name", "Customer No./Ref 1", "Ref 2", "Reg 3", "Branch No.", "Teller No.", "Kind of Transaction", "Transaction Code", "Cheque No.", "Amount", "Cheque Bank Code");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getmoneyreciev2ByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));

						// $excel = [
						// 	'id' => $x['id'],
						// 	'date' => $x['date'],
						// 	'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
						// 	'no_id' => $x['id'],
						// 	'type_id' => $x['type_id'],
						// 	'payment_amount' => $x['payment_amount'],
						// ];
						$excel = [
							'id' 					=> $x['id'],
							'record_type' 			=> $x['record_type'],
							'sequence_no' 			=> $x['sequence_no'],
							'bank_code' 			=> $x['bank_code'],
							'company_account' 		=> $x['company_account'],
							'payment_date' 			=> $x['payment_date'],
							'payment_time' 			=> $x['payment_time'],
							'customer_name' 		=> $x['customer_name'],
							'customer_ref1' 		=> $x['customer_ref1'],
							'customer_ref2' 		=> $x['customer_ref2'],
							'customer_ref3' 		=> $x['customer_ref3'],
							'branch_no' 			=> $x['branch_no'],
							'teller_no' 			=> $x['teller_no'],
							'kind_of_transaction'	=> $x['kind_of_transaction'],
							'transaction_code' 		=> $x['transaction_code'],
							'cheque_no' 			=> $x['cheque_no'],
							'amount' 				=> $x['amount'],
							'cheque_bank_code' 		=> $x['cheque_bank_code'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getAcceptPaymentByID($id);
				}
				$data['title'] = 'Acceptpayment';
				$html = view('fn/pdf_acceptpayment', $data);
				$filename = 'acceptpayment_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->AddPage('P');
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else

			return redirect()->to('/finance/list_acceptpayment_complete');
	}
	// -----------------------------------------------------------------
	public function acceptpayment()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  		=> $this->request->getPost('customer_id'),
				'bill_to'      		=> $this->request->getPost('bill_to'),
				'department_id' 	=> $this->request->getPost('department_id'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    		=> $this->request->getPost('address'),
				'telephone'   		=> $this->request->getPost('telephone'),
				'document_id'   	=> $this->request->getPost('document_id'),
				'add_debt_id'   	=> $this->request->getPost('add_debt_id'),
				'type_id'    		=> $this->request->getPost('type_id'),
				'note'   			=> $this->request->getPost('note'),
				'vat'      			=> $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
				'interest'      	=> $this->request->getPost('interest') ? (float)str_replace(",", "", $this->request->getPost('interest')) : 0,
				'cash'      		=> $this->request->getPost('cash') ? (float)str_replace(",", "", $this->request->getPost('cash')) : 0,
				'another'      		=> $this->request->getPost('another') ? (float)str_replace(",", "", $this->request->getPost('another')) : 0,
				'withholding_tax'   => $this->request->getPost('withholding_tax') ? (float)str_replace(",", "", $this->request->getPost('withholding_tax')) : 0,
				'discount'      	=> $this->request->getPost('discount') ? (float)str_replace(",", "", $this->request->getPost('discount')) : 0,
				'payment_amount'	=> $this->request->getPost('payment_amount') ? (float)str_replace(",", "", $this->request->getPost('payment_amount')) : 0
			];

			$this->finance_model->addAcceptPayment($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_acceptpayment');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'รับชำระ';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_acceptpayment'), 'title' => 'รายงานการรับชำระเงิน'],
				['link' => '#', 'title' => 'รับชำระ']
			];
			echo view('header', $data);
			echo view('fn/acceptpayment');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_acceptpayment($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  		=> $this->request->getPost('customer_id'),
				'bill_to'      		=> $this->request->getPost('bill_to'),
				'department_id' 	=> $this->request->getPost('department_id'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    		=> $this->request->getPost('address'),
				'telephone'   		=> $this->request->getPost('telephone'),
				'document_id'   	=> $this->request->getPost('document_id'),
				'add_debt_id'   	=> $this->request->getPost('add_debt_id'),
				'type_id'    		=> $this->request->getPost('type_id'),
				'note'   			=> $this->request->getPost('note'),
				'vat'      			=> $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
				'interest'      	=> $this->request->getPost('interest') ? (float)str_replace(",", "", $this->request->getPost('interest')) : 0,
				'cash'      		=> $this->request->getPost('cash') ? (float)str_replace(",", "", $this->request->getPost('cash')) : 0,
				'another'      		=> $this->request->getPost('another') ? (float)str_replace(",", "", $this->request->getPost('another')) : 0,
				'withholding_tax'   => $this->request->getPost('withholding_tax') ? (float)str_replace(",", "", $this->request->getPost('withholding_tax')) : 0,
				'discount'      	=> $this->request->getPost('discount') ? (float)str_replace(",", "", $this->request->getPost('discount')) : 0,
				'payment_amount'	=> $this->request->getPost('payment_amount') ? (float)str_replace(",", "", $this->request->getPost('payment_amount')) : 0
			];
			$this->finance_model->editAcceptPayment($id, $add);
			$this->finance_model->addLog(1);
			// $data['add'] = $add;
			// var_dump($add);
			// $data['title'] = 'รับชำระ';
			// echo view('header', $data);
			// echo view('fn/acceptpayment');
			// echo view('footer');

			return redirect()->to('/finance/list_acceptpayment');
		} else {
			$data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'แก้ไขรับชำระ';
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_acceptpayment');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_acceptpayment($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteAcceptPaymentByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_acceptpayment');
		}
	}
	// -----------------------------------------------------------------
	public function actions_overdue()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getOverdueByDate($startmon, $endmon);
			$data['title'] = 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => '#', 'title' => 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท']
			];
			echo view('header', $data);
			echo view('fn/list_overdue');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'overdue_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "วันที่", "ชื่อสมาชิก", "ประเภท", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getOverdueByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;

						$excel = [
							// 'id' => $x['id'],
							// 'date' 			=> Date('d/m/y', strtotime($x['date'])),
							'customer_id' 	=> 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'date' 			=> $x['date'],
							'customer_name'	=> $debtor[0]['name'],
							'type_id' 		=> $x['type_id'],
							'amount' 		=> $x['amount'],
							'vat' 			=> $vat,
							'total' 		=> $x['amount'] + $vat,

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getOverdueByID($id);
				}
				$data['title'] = 'Overdue';
				$html = view('fn/pdf_overdue', $data);
				$filename = 'overdue_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_overdue');
	}
	// -----------------------------------------------------------------
	public function list_overdue()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'overdue_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				$ty = [
					'1' => 'ไม่อนุมัติ',
					'2' => 'อนุมัติ',
					'3' => 'ดำเนินการ',
					'4' => 'จ่ายเงินทายาท',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPayoffDebtByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;

						$excel = [
							// 'id' => $x['id'],
							// 'date' 			=> Date('d/m/y', strtotime($x['date'])),
							'customer_id' 	=> 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name'	=> $debtor[0]['name'],
							'date' 			=> $x['date'],
							'day' 			=> $x['day'],
							'amount' 		=> $x['amount'],
							'vat' 			=> $vat,
							'total' 		=> $x['amount'] + $vat,
							'add_debt_id' 	=> $ty[$x['add_debt_id']],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}

		$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		// $search = $this->request->getPost('txt_search') ? $this->request->getPost('txt_search') : null;
		// $data['data'] = $this->finance_model->getPayoffDebtByAdddeptid();
		$data['data'] = $this->finance_model->getPayoffDebt($startmon, $endmon, 2, 1);
		$data['title'] = 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
		$data['pages'] = [
			['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
			['link' => '#', 'title' => 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท']
		];
		echo view('header', $data);
		echo view('fn/list_overdue');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_overdue()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'overdue_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				$ty = [
					'1' => 'ไม่อนุมัติ',
					'2' => 'อนุมัติ',
					'3' => 'ดำเนินการ',
					'4' => 'จ่ายเงินทายาท',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPayoffDebtByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;

						$excel = [
							// 'id' => $x['id'],
							// 'date' 			=> Date('d/m/y', strtotime($x['date'])),
							'customer_id' 	=> 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name'	=> $debtor[0]['name'],
							'date' 			=> $x['date'],
							'day' 			=> $x['day'],
							'amount' 		=> $x['amount'],
							'vat' 			=> $vat,
							'total' 		=> $x['amount'] + $vat,
							'add_debt_id' 	=> $ty[$x['add_debt_id']],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}

		$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('txt_search') ? $this->request->getPost('txt_search') : null;
		// $data['data'] = $this->finance_model->getPayoffDebtByAdddeptid();
		$data['data'] = $this->finance_model->getPayoffDebt($startmon, $endmon, 2, 1, $search);
		$data['title'] = 'รายงานเรื่องค้างจ่ายเป็นรายบุคคล';
		$data['pages'] = [
			['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
			['link' => '#', 'title' => $data['title']]
		];
		echo view('header', $data);
		echo view('fn/report_overdue');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_overdue_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายงานเรื่องค้างจ่ายเป็นรายบุคคล';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/report_overdue_pdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/report_overdue');
	}
	// -----------------------------------------------------------------
	public function view_overdue($id = null)
	{
		if ($id != null) {
			// $data['data'] = $this->finance_model->getOverdueByID($id);
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดบันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
			// $data['title'] = 'รายละเอียดรายการลูกหนี้ค้าง';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_overdue'), 'title' => 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท'],
				['link' => '#', 'title' => 'รายละเอียดรายการลูกหนี้ค้าง']
			];
			echo view('header', $data);
			echo view('fn/view_overdue');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_overdue');
	}
	// -----------------------------------------------------------------
	public function view_overdue_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดบันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
			echo view('fn/view_overdue_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function overdue()
	{
		// if ($this->request->getPost('save') != null) {
		// 	$add = [
		// 		'customer_id'  	=> $this->request->getPost('customer_id'),
		// 		'bill_to'      	=> $this->request->getPost('bill_to'),
		// 		'department_id' => $this->request->getPost('department_id'),
		// 		'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
		// 		'address'    	=> $this->request->getPost('address'),
		// 		'telephone'   	=> $this->request->getPost('telephone'),
		// 		'document_id'   => $this->request->getPost('document_id'),
		// 		'add_debt_id'   => $this->request->getPost('add_debt_id'),
		// 		'type_id'    	=> $this->request->getPost('type_id'),
		// 		'day'    		=> $this->request->getPost('unit_id'),
		// 		'note'   		=> $this->request->getPost('note'),
		// 		'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
		// 	];
		// 	// var_dump($add);
		// 	$this->finance_model->addOverdue($add);
		// 	$this->finance_model->addLog(1);

		// 	return redirect()->to('/finance/list_overdue');
		// } else {
		// 	$data['debtor'] = $this->account_model->getDebtor();
		// 	$data['title'] = 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
		// 	$data['pages'] = [
		// 		['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
		// 		['link' => base_url('/finance/list_overdue'), 'title' => 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท'],
		// 		['link' => '#', 'title' => 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท']
		// 	];
		// 	echo view('header', $data);
		// 	echo view('fn/overdue');
		// 	echo view('footer');
		// }

		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			$this->finance_model->addPayoffDebt($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_overdue');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'บันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
			echo view('header', $data);
			echo view('fn/overdue');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_overdue($id = null)
	{
		// if ($id == null)
		// 	return false;
		// if ($this->request->getPost('save') != null) {
		// 	$add = [
		// 		'customer_id'  	=> $this->request->getPost('customer_id'),
		// 		'bill_to'      	=> $this->request->getPost('bill_to'),
		// 		'department_id' => $this->request->getPost('department_id'),
		// 		'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
		// 		'address'    	=> $this->request->getPost('address'),
		// 		'telephone'   	=> $this->request->getPost('telephone'),
		// 		'document_id'   => $this->request->getPost('document_id'),
		// 		'add_debt_id'   => $this->request->getPost('add_debt_id'),
		// 		'type_id'    	=> $this->request->getPost('type_id'),
		// 		'day'    		=> $this->request->getPost('unit_id'),
		// 		'note'   		=> $this->request->getPost('note'),
		// 		'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
		// 	];
		// 	$this->finance_model->editOverdue($id, $add);
		// 	$this->finance_model->addLog(1);

		// 	return redirect()->to('/finance/list_overdue');
		// } else {
		// 	$data['data'] = $this->finance_model->getOverdueByID($id);
		// 	$data['title'] = 'แก้ไขบันทึกเงินสงเคราะห์ค้างจ่ายทายาท';
		// 	$data['debtor'] = $this->account_model->getDebtor();
		// 	$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
		// 	echo view('header', $data);
		// 	echo view('fn/edit_overdue');
		// 	echo view('footer');
		// }

		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			$this->finance_model->editPayoffDebt($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_overdue');
		} else {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'แก้ไขบันทึกจ่ายเงินสงเคราะห์ทายาท';
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_overdue');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_overdue($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deletePayoffDebtByID($id);
			// $this->finance_model->deleteOverdueByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_overdue');
		}
	}
	// -----------------------------------------------------------------
	public function actions_billing()
	{
		// if ($this->request->getPost('import')) {
		// 	if (isset($_FILES["file"]["name"])) {
		// 		$path = $_FILES["file"]["tmp_name"];
		// 		$object = PHPExcel_IOFactory::load($path);
		// 		foreach ($object->getWorksheetIterator() as $worksheet) {
		// 			$highestRow = $worksheet->getHighestRow();
		// 			$highestColumn = $worksheet->getHighestColumn();
		// 			for ($row = 2; $row <= $highestRow; $row++) {
		// 				$customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
		// 				$address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
		// 				$city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
		// 				$postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
		// 				$country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
		// 				$data[] = array(
		// 					'CustomerName'  => $customer_name,
		// 					'Address'   => $address,
		// 					'City'    => $city,
		// 					'PostalCode'  => $postal_code,
		// 					'Country'   => $country
		// 				);
		// 			}
		// 		}
		// 		$this->excel_import_model->insert($data);
		// 		echo 'Data Imported successfully';
		// 	}
		// } else
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getBillingByDate($startmon, $endmon);
			$data['title'] = 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก']];
			echo view('header', $data);
			echo view('fn/list_billing');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'billing_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getBillingByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;

						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'date' => $x['date'],
							'day' => $x['day'],
							'amount' => $x['amount'],
							'vat' => $vat,
							'total' => $x['amount'] + $vat,
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getBillingByID($id);
				}
				$data['title'] = 'Billing';
				$html = view('fn/pdf_billing', $data);
				$filename = 'billing_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_billing');
	}
	// -----------------------------------------------------------------
	public function list_billing()
	{
		$data['data'] = $this->finance_model->getBilling();
		$data['title'] = 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก']];
		echo view('header', $data);
		echo view('fn/list_billing');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_billing()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			$data['data'] = $this->finance_model->getBillingByDate($startmon, $endmon);
			$data['title'] = 'รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/report_billing');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'billing_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getBillingByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;

						$excel = [
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'date' => $x['date'],
							'day' => $x['day'],
							'amount' => $x['amount'],
							'vat' => $vat,
							'total' => $x['amount'] + $vat,
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$data['data'] = $this->finance_model->getBilling();
		$data['title'] = 'รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/report_billing');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_billing_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['title'] = 'รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/report_billing_pdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/report_billing');
	}
	// -----------------------------------------------------------------
	public function view_billing($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_billing'), 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก'], ['link' => '#', 'title' => 'รายละเอียดรายการเรียกเก็บเงินสงเคราะห์สมาชิก']];
			$data['title'] = 'รายละเอียดรายการเรียกเก็บเงินสงเคราะห์สมาชิก';
			echo view('header', $data);
			echo view('fn/view_billing');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_billing');
	}
	// -----------------------------------------------------------------
	public function view_billing_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['title'] = 'รายละเอียดรายการเรียกเก็บเงินสงเคราะห์สมาชิก';
			echo view('fn/view_billing_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function report_billing_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['title'] = 'รายงานการค้างจ่ายของสมาชิกเป็นรายบุคคล';
			echo view('fn/view_billing_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function billing()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			$this->finance_model->addBilling($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_billing');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_billing'), 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก'], ['link' => '#', 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก']];
			$data['title'] = 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก';
			echo view('header', $data);
			echo view('fn/billing');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_billing($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			// var_dump($add);
			$this->finance_model->editBilling($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_billing');
		} else {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_billing'), 'title' => 'รายการเรียกเก็บเงินสงเคราะห์สมาชิก'],
				['link' => '#', 'title' => 'แก้ไขรายการเรียกเก็บเงินสงเคราะห์สมาชิก']
			];
			$data['title'] = 'แก้ไขรายการเรียกเก็บเงินสงเคราะห์สมาชิก';
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_billing');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_billing($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteBillingByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_billing');
		}
	}
	// -----------------------------------------------------------------
	public function actions_payoffdebt()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getPayoffDebtByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกจ่ายเงินสงเคราะห์ทายาท']];
			$data['title'] = 'บันทึกจ่ายเงินสงเคราะห์ทายาท';
			echo view('header', $data);
			echo view('fn/list_payoffdebt');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'payoffdebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)", "อนุมัติ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPayoffDebtByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;
						if ($x['add_debt_id'] == 1) {
							$x['add_debt_id'] = 'ไม่อนุมัติ';
						} elseif ($x['add_debt_id'] == 2) {
							$x['add_debt_id'] = 'อนุมัติ';
						} elseif ($x['add_debt_id'] == 3) {
							$x['add_debt_id'] = 'ดำเนินการ';
						} elseif ($x['add_debt_id'] == 4) {
							$x['add_debt_id'] = 'จ่ายเงินทายาท';
						}

						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'date' => $x['date'],
							'day' => $x['day'],
							'amount' => $x['amount'],
							'vat' => $vat,
							'total' => $x['amount'] + $vat,
							'add_debt_id' => $x['add_debt_id'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getPayoffDebtByID($id);
				}
				$data['title'] = 'Payoffdebt';
				$html = view('fn/pdf_payoffdebt', $data);
				$filename = 'payoffdebt_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_payoffdebt');
	}
	// -----------------------------------------------------------------
	public function list_payoffdebt()
	{
		$data['data'] = $this->finance_model->getPayoffDebt(null, null, 2);
		$data['title'] = 'บันทึกจ่ายเงินสงเคราะห์ทายาท';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/list_payoffdebt');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_payoffdebt()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);
			$data['data'] = $this->finance_model->getPayoffDebtByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
			$data['title'] = 'รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี';
			echo view('header', $data);
			echo view('fn/report_payoffdebt');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'payoffdebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รหัสสมาชิก", "ชื่อสมาชิก", "วันที่", "เครดิต(วัน)", "จำนวนเงิน(บาท)", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)", "อนุมัติ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPayoffDebtByID($id);
					$debtor = $this->account_model->getDebtorByID($data[0]['customer_id']);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$vat = $x['amount'] * 0.07;
						if ($x['add_debt_id'] == 1) {
							$x['add_debt_id'] = 'ไม่อนุมัติ';
						} elseif ($x['add_debt_id'] == 2) {
							$x['add_debt_id'] = 'อนุมัติ';
						} elseif ($x['add_debt_id'] == 3) {
							$x['add_debt_id'] = 'ดำเนินการ';
						} elseif ($x['add_debt_id'] == 4) {
							$x['add_debt_id'] = 'จ่ายเงินทายาท';
						}

						$excel = [
							// 'id' => $x['id'],
							'customer_id' => 'MOPH-' . sprintf('%07d', $x['customer_id']),
							'customer_name' => $debtor[0]['name'],
							'date' => $x['date'],
							'day' => $x['day'],
							'amount' => $x['amount'],
							'vat' => $vat,
							'total' => $x['amount'] + $vat,
							'add_debt_id' => $x['add_debt_id'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$data['data'] = $this->finance_model->getPayoffDebt(null, null, 2);
		$data['title'] = 'รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/report_payoffdebt');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_payoffdebt_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายงานสรุปยอดการจ่ายเงินสงเคราะห์แบบรายเดือนและรายปี';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/report_payoffdebt_pdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/report_payoffdebt');
	}
	// -----------------------------------------------------------------
	public function view_payoffdebt($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดบันทึกจ่ายเงินสงเคราะห์ทายาท';
			echo view('header', $data);
			echo view('fn/view_payoffdebt');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_payoffdebt');
	}
	// -----------------------------------------------------------------

	public function view_payoffdebtid($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดบันทึกจ่ายเงินสงเคราะห์ทายาท';
			//echo view('header', $data);
			echo view('fn/view_payoffdebt_id', $data);
			//echo view('footer');
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------
	public function payoffdebt()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			$this->finance_model->addPayoffDebt($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payoffdebt');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'บันทึกจ่ายเงินสงเคราะห์ทายาท';
			echo view('header', $data);
			echo view('fn/payoffdebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_payoffdebt($id)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0
			];
			$this->finance_model->editPayoffDebt($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payoffdebt');
		} else {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'แก้ไขบันทึกจ่ายเงินสงเคราะห์ทายาท';
			$data['debtor'] = $this->account_model->getDebtor();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_payoffdebt');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_payoffdebt($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deletePayoffDebtByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_payoffdebt');
		}
	}
	// -----------------------------------------------------------------
	public function actions_payment()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'payment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Amount", "Day");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						fputcsv($file, $x);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getPaymentByID($id);
				}
				$data['title'] = 'Payment';
				$html = view('fn/pdf_payment', $data);
				$filename = 'payment_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_payment');
	}
	// -----------------------------------------------------------------
	public function list_payment()
	{
		$data['data'] = $this->finance_model->getPayment();
		$data['title'] = 'จ่ายชำระเงิน';
		echo view('header', $data);
		echo view('fn/list_payment');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_payment($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPaymentByID($id);
			$data['title'] = 'รายละเอียดจ่ายชำระเงิน';
			echo view('header', $data);
			echo view('fn/view_payment');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_payment');
	}
	// -----------------------------------------------------------------
	public function payment()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			if ($this->request->getFile('file')) {
				$file = $this->request->getFile('file');
				$newName = $file->getRandomName();
				$file->move(WRITEPATH . 'uploads/test', $newName);
				$add['file'] = $file->getName();
			}
			$this->finance_model->addPayment($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payment');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'จ่ายชำระเงิน';
			echo view('header', $data);
			echo view('fn/payment');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_payment($id = null)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			if ($this->request->getFile('file')) {

				$fine = $this->finance_model->getPaymentByID($id);
				$oldfile = $fine[0]['file'];
				$file = $this->request->getFile('file');
				$path = WRITEPATH . 'uploads/test/' . $oldfile;
				if ($oldfile != null) {
					unlink($path);
				}
				$newName = $file->getRandomName();
				$file->move(WRITEPATH . 'uploads/test', $newName);
				$add['file'] = $file->getName();
			}
			$this->finance_model->editPayment($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payment');
		} else {
			$data['data'] = $this->finance_model->getPaymentByID($id);
			$data['title'] = 'แก้ไขจ่ายชำระเงิน';
			$data['debtor'] = $this->account_model->getDebtor();
			echo view('header', $data);
			echo view('fn/edit_payment');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_payment($id = null)
	{
		if ($id == null)
			return false;
		else {
			$fine = $this->finance_model->getPaymentByID($id);
			$oldfile = $fine[0]['file'];
			$path = WRITEPATH . 'uploads/test/' . $oldfile;
			if ($oldfile != null)
				unlink($path);
			$this->finance_model->deletePaymentByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_payment');
		}
	}
	// -----------------------------------------------------------------
	public function actions_check()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getCheckByDate($startmon, $endmon);
			$data['title'] = 'บันทึกเช็ครับ';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเช็ครับ']];
			echo view('header', $data);
			echo view('fn/list_check');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'check_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เข้าบัญชี", "ใบที่นำฝาก", "วันที่นำฝาก", "วันที่ผ่าน", "วันที่ดำเนินการ", "ภาษี 7% (บาท)", "จำนวนทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getCheckByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = $x['amount'] * 0.07;
						$x['deposit_date'] = date('d-m-Y', strtotime($x['deposit_date']));
						$x['passed_date'] = date('d-m-Y', strtotime($x['passed_date']));
						$x['implementation_date'] = date('d-m-Y', strtotime($x['implementation_date']));
						$excel = [
							'into_account' => $x['into_account'],
							'deposit_id' => $x['deposit_id'],
							'deposit_date' => $x['deposit_date'],
							'passed_date' => $x['passed_date'],
							'implementation_date' => $x['implementation_date'],
							'vat' => $vat,
							'amount' => $x['amount'] + $vat,

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getCheckByID($id);
				}
				$data['title'] = 'Check';
				$html = view('fn/pdf_check', $data);
				$filename = 'check_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_check');
	}
	// -----------------------------------------------------------------
	public function list_check()
	{
		$data['data'] = $this->finance_model->getCheck();
		$data['title'] = 'บันทึกเช็ครับ';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเช็ครับ']];
		echo view('header', $data);
		echo view('fn/list_check');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_check($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckByID($id);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_check'), 'title' => 'บันทึกเช็ครับ'], ['link' => '#', 'title' => 'รายละเอียดบันทึกเช็ครับ']];
			$data['title'] = 'รายละเอียดบันทึกเช็ครับ';
			echo view('header', $data);
			echo view('fn/view_check');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_check');
	}
	// -----------------------------------------------------------------
	public function view_check_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckByID($id);
			$data['title'] = 'รายละเอียดบันทึกเช็ครับ';
			echo view('fn/view_check_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function check()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'into_account'  		=> $this->request->getPost('into_account'),
				'department_id'      	=> $this->request->getPost('department_id'),
				'comment' 				=> $this->request->getPost('comment'),
				'deposit_id'   			=> $this->request->getPost('deposit_id'),
				'deposit_date'    		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('deposit_date')))),
				'passed_date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
				'implementation_date'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('implementation_date')))),
				'note'   				=> $this->request->getPost('note'),
				'amount'      			=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'fee'      				=> $this->request->getPost('fee') ? (float)str_replace(",", "", $this->request->getPost('fee')) : 0,
				'vat'      				=> $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
				'tax'      				=> $this->request->getPost('tax') ? (float)str_replace(",", "", $this->request->getPost('tax')) : 0,
				'total'      			=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			$this->finance_model->addCheck($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_check');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'บันทึกเช็ครับ';
			echo view('header', $data);
			echo view('fn/check');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_check($id)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'into_account'  		=> $this->request->getPost('into_account'),
				'department_id'      	=> $this->request->getPost('department_id'),
				'comment' 				=> $this->request->getPost('comment'),
				'deposit_id'   			=> $this->request->getPost('deposit_id'),
				'deposit_date'    		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('deposit_date')))),
				'passed_date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
				'implementation_date'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('implementation_date')))),
				'note'   				=> $this->request->getPost('note'),
				'amount'      			=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'fee'      				=> $this->request->getPost('fee') ? (float)str_replace(",", "", $this->request->getPost('fee')) : 0,
				'vat'      				=> $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
				'tax'      				=> $this->request->getPost('tax') ? (float)str_replace(",", "", $this->request->getPost('tax')) : 0,
				'total'      			=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			// var_dump($add);
			$this->finance_model->editCheck($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_check');
		} else {
			$data['data'] = $this->finance_model->getCheckByID($id);
			$data['title'] = 'แก้ไขบันทึกเช็ครับ';
			$data['data'][0]['deposit_date'] = Date('d/m/Y', strtotime($data['data'][0]['deposit_date']));
			$data['data'][0]['passed_date'] = Date('d/m/Y', strtotime($data['data'][0]['passed_date']));
			$data['data'][0]['implementation_date'] = Date('d/m/Y', strtotime($data['data'][0]['implementation_date']));
			echo view('header', $data);
			echo view('fn/edit_check');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_check($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteCheckByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_check');
		}
	}
	// -----------------------------------------------------------------
	public function actions_pettycash()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getPettyCashByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเบิกเงินสดย่อย']];
			$data['title'] = 'บันทึกเบิกเงินสดย่อย';
			echo view('header', $data);
			echo view('fn/list_pettycash');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'pettycash_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ประเภท", "สถานะ", "เลขที่", "วันที่", "ใบที่เบิก", "จำนวนเงิน(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPettyCashByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'type_id' => $x['type_id'],
							'status_id' => $x['status_id'],
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'withdrawal_slip' => $x['withdrawal_slip'],
							'amount' => $x['amount'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getPettyCashByID($id);
				}
				$data['title'] = 'Pettycash';
				$html = view('fn/pdf_pettycash', $data);
				$filename = 'pettycash_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_pettycash');
	}
	// -----------------------------------------------------------------
	public function list_pettycash()
	{
		$data['data'] = $this->finance_model->getPettyCash();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเบิกเงินสดย่อย']];
		$data['title'] = 'บันทึกเบิกเงินสดย่อย';
		echo view('header', $data);
		echo view('fn/list_pettycash');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_pettycash($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPettyCashByID($id);
			$data['title'] = 'รายละเอียดเบิกเงินสดย่อย';
			echo view('header', $data);
			echo view('fn/view_pettycash');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_pettycash');
	}
	// -----------------------------------------------------------------

	public function view_pettycash_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPettyCashByID($id);
			$data['title'] = 'รายละเอียดเบิกเงินสดย่อย';
			echo view('fn/view_pettycash_id', $data);
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------
	public function pettycash()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'type_id'  			=> $this->request->getPost('type_id'),
				'status_id'      	=> $this->request->getPost('status_id'),
				'no_id' 			=> $this->request->getPost('no_id'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'withdrawal_slip'	=> $this->request->getPost('withdrawal_slip'),
				'note'   			=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->addPettyCash($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_pettycash');
		} else {
			$data['title'] = 'บันทึกเบิกเงินสดย่อย';
			echo view('header', $data);
			echo view('fn/pettycash');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_pettycash($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'type_id'  			=> $this->request->getPost('type_id'),
				'status_id'      	=> $this->request->getPost('status_id'),
				'no_id' 			=> $this->request->getPost('no_id'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'withdrawal_slip'	=> $this->request->getPost('withdrawal_slip'),
				'note'   			=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->editPettyCash($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_pettycash');
		} else {
			$data['data'] = $this->finance_model->getPettyCashByID($id);
			$data['title'] = 'บันทึกเบิกเงินสดย่อย';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_pettycash');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_pettycash($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deletePettyCashByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_pettycash');
		}
	}
	// -----------------------------------------------------------------
	public function actions_checkpay()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getCheckPayByDate($startmon, $endmon);
			$data['title'] = 'บันทึกเช็คจ่าย';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเช็คจ่าย']];
			echo view('header', $data);
			echo view('fn/list_checkpay');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'checkpay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ตัดบัญชี", "วันที่เช็คเข้า", "วันที่เช็คออก",  "จำนวนเงิน", "จ่ายให้", "สถานะเช็ค", "ยอดเหลือ", "วันที่ผ่านเช็ค", "ยอดค่าใช้จ่าย");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getCheckPayByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['check_date'] = date('d/m/Y', strtotime($x['check_date']));
						$x['check_issue'] = date('d-m-Y', strtotime($x['check_issue']));
						$x['passed_date'] = date('d-m-Y', strtotime($x['passed_date']));
						$excel = [
							'debit_id' => $x['debit_id'],
							'check_date' => $x['check_date'],
							'check_issue' => $x['check_issue'],
							'amount' => $x['amount'],
							'pay_for' => $x['pay_for'],
							'check_status' => $x['check_status'],
							'balance' => $x['balance'],
							'passed_date' => $x['passed_date'],
							'cost' => $x['cost'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getCheckPayByID($id);
				}
				$data['title'] = 'Checkpay';
				$html = view('fn/pdf_checkpay', $data);
				$filename = 'checkpay_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_checkpay');
	}
	// -----------------------------------------------------------------
	public function list_checkpay()
	{
		$data['data'] = $this->finance_model->getCheckPay();
		$data['title'] = 'บันทึกเช็คจ่าย';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/list_checkpay');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_checkpay()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			$data['data'] = $this->finance_model->getCheckPayByDate($startmon, $endmon);
			$data['title'] = 'บันทึกเช็คจ่าย';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกเช็คจ่าย']];
			echo view('header', $data);
			echo view('fn/list_checkpay');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'checkpay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ตัดบัญชี", "วันที่เช็คเข้า", "วันที่เช็คออก",  "จำนวนเงิน", "จ่ายให้", "สถานะเช็ค", "ยอดเหลือ", "วันที่ผ่านเช็ค", "ยอดค่าใช้จ่าย");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getCheckPayByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['check_date'] = date('d/m/Y', strtotime($x['check_date']));
						$x['check_issue'] = date('d-m-Y', strtotime($x['check_issue']));
						$x['passed_date'] = date('d-m-Y', strtotime($x['passed_date']));
						$excel = [
							'debit_id' => $x['debit_id'],
							'check_date' => $x['check_date'],
							'check_issue' => $x['check_issue'],
							'amount' => $x['amount'],
							'pay_for' => $x['pay_for'],
							'check_status' => $x['check_status'],
							'balance' => $x['balance'],
							'passed_date' => $x['passed_date'],
							'cost' => $x['cost'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$data['data'] = $this->finance_model->getCheckPay();
		$data['title'] = 'รายงานทะเบียนเช็คจ่ายตามรอบระยะการจ่าย';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/report_checkpay');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_checkpay_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckPayByID($id);
			$data['title'] = 'รายงานทะเบียนเช็คจ่ายตามรอบระยะการจ่าย';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/report_checkpay_pdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/report_checkpay');
	}
	// -----------------------------------------------------------------
	public function view_checkpay($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckPayByID($id);
			$data['title'] = 'รายละเอียดบันทึกเช็คจ่าย';
			echo view('header', $data);
			echo view('fn/view_checkpay');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_checkpay');
	}
	// -----------------------------------------------------------------

	public function view_checkpay_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckPayByID($id);
			$data['title'] = 'รายละเอียดบันทึกเช็คจ่าย';
			echo view('fn/view_checkpay_id', $data);
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------
	public function checkpay()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'check_date'  	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('check_date')))),
				'check_issue'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('check_issue')))),
				'cheack_id' 	=> $this->request->getPost('cheack_id'),
				'type_id'   	=> $this->request->getPost('type_id'),
				'debit_id'		=> $this->request->getPost('debit_id'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'pay_for'		=> $this->request->getPost('pay_for'),
				'check_status'	=> $this->request->getPost('check_status'),
				'balance'      	=> $this->request->getPost('balance') ? (float)str_replace(",", "", $this->request->getPost('balance')) : 0,
				'passed_date'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
				'cost'      	=> $this->request->getPost('cost') ? (float)str_replace(",", "", $this->request->getPost('cost')) : 0,
				'note'   		=> $this->request->getPost('note'),
			];
			$this->finance_model->addCheckPay($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_checkpay');
		} else {
			$data['title'] = 'บันทึกเช็คจ่าย';
			echo view('header', $data);
			echo view('fn/checkpay');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_checkpay($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'check_date'  	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('check_date')))),
				'check_issue'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('check_issue')))),
				'cheack_id' 	=> $this->request->getPost('cheack_id'),
				'type_id'   	=> $this->request->getPost('type_id'),
				'debit_id'		=> $this->request->getPost('debit_id'),
				'amount'      	=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'pay_for'		=> $this->request->getPost('pay_for'),
				'check_status'	=> $this->request->getPost('check_status'),
				'balance'      	=> $this->request->getPost('balance') ? (float)str_replace(",", "", $this->request->getPost('balance')) : 0,
				'passed_date'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
				'cost'      	=> $this->request->getPost('cost') ? (float)str_replace(",", "", $this->request->getPost('cost')) : 0,
				'note'   		=> $this->request->getPost('note'),
			];
			$this->finance_model->editCheckPay($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_checkpay');
		} else {
			$data['data'] = $this->finance_model->getCheckPayByID($id);
			$data['title'] = 'แก้ไขบันทึกเช็คจ่าย';
			$data['data'][0]['check_date'] = Date('d/m/Y', strtotime($data['data'][0]['check_date']));
			$data['data'][0]['check_issue'] = Date('d/m/Y', strtotime($data['data'][0]['check_issue']));
			$data['data'][0]['passed_date'] = Date('d/m/Y', strtotime($data['data'][0]['passed_date']));
			echo view('header', $data);
			echo view('fn/edit_checkpay');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_checkpay($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteCheckPayByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_checkpay');
		}
	}
	// -----------------------------------------------------------------
	public function actions_transfer()
	{
		if ($this->request->getPost('search')) {
			$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;

			// var_dump($startmon.' '.$endmon);


			$data['data'] = $this->finance_model->getTransferByDate($startmon, $endmon);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'โอนเงินระหว่างบัญชี']];
			$data['title'] = 'โอนเงินระหว่างบัญชี';
			echo view('header', $data);
			echo view('fn/list_transfer');
			echo view('footer');
		} elseif (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'transfer_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "เพื่อ", "โอนจากบัญชี", "เข้าบัญชี", "เงินโอน(บาท)", "ค่าธรรมเนียม(บาท)", "จำนวนเงินทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getTransferByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no' => $x['no'],
							'date' => $x['date'],
							'reason' => $x['reason'],
							'transfer_from' => $x['transfer_from'],
							'transfer_to' => $x['transfer_to'],
							'amount' => $x['amount'],
							'fee' => $x['fee'],
							'total' => $x['amount'] + $x['fee'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->finance_model->getTransferByID($id);
				}
				$data['title'] = 'Transfer';
				$html = view('fn/pdf_transfer', $data);
				$filename = 'transfer_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/finance/list_transfer');
	}
	// -----------------------------------------------------------------
	public function list_transfer()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'transfer_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่เอกสาร", "วันที่", "หมายเหตุ", "โอนจากบัญชี", "เข้าบัญชี", "เงินโอน(บาท)", "ค่าธรรมเนียม(บาท)", "จำนวนเงินทั้งสิ้น(บาท)");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getTransferByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no' 			=> $x['no'],
							'date' 			=> $x['date'],
							'reason' 		=> $x['reason'],
							'transfer_from'	=> $x['transfer_from'],
							'transfer_to' 	=> $x['transfer_to'],
							'amount'		=> $x['amount'],
							'fee' 			=> $x['fee'],
							'total' 		=> $x['amount'] + $x['fee'],

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$startmon = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$endmon = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->finance_model->getTransferByDate($startmon, $endmon);
		// $data['data'] = $this->finance_model->getTransfer();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'โอนเงินระหว่างบัญชี']];
		$data['title'] = 'โอนเงินระหว่างบัญชี';
		echo view('header', $data);
		echo view('fn/list_transfer');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_transfer($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getTransferByID($id);
			$data['title'] = 'รายละเอียดโอนเงินระหว่างบัญชี';
			echo view('header', $data);
			echo view('fn/view_transfer');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_transfer');
	}
	// -----------------------------------------------------------------

	public function view_transfer_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getTransferByID($id);
			$data['title'] = 'รายละเอียดโอนเงินระหว่างบัญชี';
			echo view('fn/view_transfer_id', $data);
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------
	public function transfer()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'department_id' => $this->request->getPost('department_id'),
				'no'   			=> $this->request->getPost('no'),
				'date' 			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reason'   		=> $this->request->getPost('reason'),
				'transfer_from'	=> $this->request->getPost('transfer_from'),
				'transfer_to'	=> $this->request->getPost('transfer_to'),
				'amount'      	=> $this->request->getPost('amount') ? (float)$this->request->getPost('amount') : 0,
				'fee'      		=> $this->request->getPost('fee') ? (float)$this->request->getPost('fee') : 0
			];
			// var_dump($add);
			$this->finance_model->addTransfer($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_transfer');
		} else {
			$data['title'] = 'โอนเงินระหว่างบัญชี';
			$data['data'] = $this->finance_model->getSetting();

			echo view('header', $data);
			echo view('fn/transfer');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_transfer($id = null)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'department_id' => $this->request->getPost('department_id'),
				'no'   			=> $this->request->getPost('no'),
				'date' 			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reason'   		=> $this->request->getPost('reason'),
				'transfer_from'	=> $this->request->getPost('transfer_from'),
				'transfer_to'	=> $this->request->getPost('transfer_to'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0,
				'fee'      		=> $this->request->getPost('fee') ? $this->request->getPost('fee') : 0
			];
			$this->finance_model->editTransfer($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_transfer');
		} else {
			$data['data'] = $this->finance_model->getTransferByID($id);
			$data['title'] = 'แก้ไขโอนเงินระหว่างบัญชี';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('fn/edit_transfer');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_transfer($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteTransferByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_transfer');
		}
	}
	// -----------------------------------------------------------------
	public function list_acceptpayment()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'subscription_fee_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "Record Type", "Sequence No.", "ชื่อธนาคาร", "Company Account", "วันที่ชำระ", "เวลาที่ชำระ", "ชื่อลูกค้า", "เลขบัตรประชาชน", "เบอร์โทร", "Reg 3", "Branch No.", "Teller No.", "Kind of Transaction", "ช่องทางการชำระ", "Cheque No.", "จำนวนทั้งสิ้น", "Cheque Bank Code");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'NET' => 'ATM',
					'CSH' => 'เคาท์เตอร์'
				];
				$bk = [
					'0' => '',
					'1' => '',
					'2' => '',
					'3' => '',
					'4' => '',
					'5' => '',
					'6' => 'ธนาคารกรุงไทย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getmoneyreciev2ByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
						$excel = [
							'id' 					=> $x['id'],
							'record_type' 			=> $x['record_type'],
							'sequence_no' 			=> $x['sequence_no'],
							'bank_code'				=> $bk[$x['bank_code']],
							'company_account' 		=> $x['company_account'],
							'payment_date'			=> $x['payment_date'],
							'payment_time' 			=> $x['payment_time'],
							'customer_name' 		=> $x['customer_name'],
							'customer_ref1'			=> $x['customer_ref1'],
							'customer_ref2' 		=> '0' . $x['customer_ref2'],
							'customer_ref3' 		=> $x['customer_ref3'],
							'branch_no' 			=> $x['branch_no'],
							'teller_no' 			=> $x['teller_no'],
							'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
							'transaction_code' 		=> $x['transaction_code'],
							'cheque_no' 			=> $x['cheque_no'],
							'amount' 				=> $x['amount'],
							'cheque_bank_code' 		=> $x['cheque_bank_code'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/list_acceptpayment');
			}
		}
		$from1 = $this->request->getPost('datepicker_from1') ? $this->request->getPost('datepicker_from1') : null;
		$to1 = $this->request->getPost('datepicker_to1') ? $this->request->getPost('datepicker_to1') : null;
		$data['all'] 		= $this->finance_model->getmoneyreciev2($from1, $to1);
		// $data['data'] = $this->finance_model->getAcceptPayment();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'รายงานการรับชำระเงิน']];
		$data['title'] = 'รายงานการรับชำระเงิน';
		echo view('header', $data);
		echo view('fn/list_acceptpayment');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_acceptpaymentpdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getmoneyreciev2ByID($id);
			// $data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'รายละเอียดการรับชำระเงิน';

			/*$dompdf = new \Dompdf\Dompdf(); 
			$dompdf->loadHtml(view('fn/view_acceptpayment_pdf', $data));
			$dompdf->setPaper('A4');
			$dompdf->render();
			$pdf = $dompdf->output();
			$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			*/


			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_acceptpayment_pdf', $data);
			$filename = 'receiving_money_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));


			//echo view('fn/view_acceptpayment_pdf', $data);


		} else
			return redirect()->to('/finance/list_acceptpayment');
	}
	// -----------------------------------------------------------------

	public function view_acceptpaymentpdftest($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'รายละเอียดการรับชำระเงิน';

			/*$dompdf = new \Dompdf\Dompdf(); 
			$dompdf->loadHtml(view('fn/view_acceptpayment_pdf', $data));
			$dompdf->setPaper('A4');
			$dompdf->render();
			$pdf = $dompdf->output();
			$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			*/


			echo view('fn/view_acceptpayment_pdf2', $data);


			//echo view('fn/view_acceptpayment_pdf', $data);


		} else
			return redirect()->to('/finance/list_acceptpayment');
	}

	// -----------------------------------------------------------------

	public function view_receiving_moneypdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);
			// $data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'พิมพ์ใบเสร็จ';

			/*$dompdf = new \Dompdf\Dompdf(); 
			$dompdf->loadHtml(view('fn/view_acceptpayment_pdf', $data));
			$dompdf->setPaper('A4');
			$dompdf->render();
			$pdf = $dompdf->output();
			$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			*/


			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_receiving_moneypdf', $data);
			$filename = 'receiving_money_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/list_receiving_money');
	}
	// -----------------------------------------------------------------

	public function view_depositpdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getDeposit(null, null, $id);
			// $data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'พิมพ์ใบเสร็จ';

			/*$dompdf = new \Dompdf\Dompdf(); 
			$dompdf->loadHtml(view('fn/view_acceptpayment_pdf', $data));
			$dompdf->setPaper('A4');
			$dompdf->render();
			$pdf = $dompdf->output();
			$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			*/


			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_depositpdf', $data);
			$filename = 'deposit_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/list_deposit');
	}
	// -----------------------------------------------------------------

	public function view_withdrawpdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getWithdraw(null, null, $id);
			// $data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'พิมพ์ใบเสร็จ';

			/*$dompdf = new \Dompdf\Dompdf(); 
			$dompdf->loadHtml(view('fn/view_acceptpayment_pdf', $data));
			$dompdf->setPaper('A4');
			$dompdf->render();
			$pdf = $dompdf->output();
			$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
			*/


			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_withdrawpdf', $data);
			$filename = 'withdraw_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/list_withdraw');
	}
	// -----------------------------------------------------------------
	public function view_acceptpayment($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'รายละเอียดการรับชำระเงิน';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_acceptpayment'), 'title' => 'รายงานการรับชำระเงิน'],
				['link' => '#', 'title' => 'รายละเอียดการรับชำระเงิน']
			];
			echo view('header', $data);
			echo view('fn/view_acceptpayment');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_acceptpayment');
	}
	// -----------------------------------------------------------------

	public function list_acceptpayment_mon()
	{
		//$data['data'] = $this->finance_model->getAcceptPayment();;
		$data['data'] = $this->finance_model->getDatePay();
		$data['title'] = 'รายงานการรับชำระเงินประจำเดือน';
		echo view('header', $data);
		echo view('fn/list_acceptpayment_mon');
		// echo view('fn/list_datepay');
		echo view('footer');
	}

	public function list_acceptpayment_complete()
	{
		$data['data'] = $this->finance_model->getmoneyreciev2();
		// $data['data'] = $this->finance_model->getAcceptPayment();
		$data['title'] = 'พิมพ์ใบเสร็จรับเงิน';
		$data['pages'] = [
			['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
			['link' => '#', 'title' => 'พิมพ์ใบเสร็จรับเงิน']
		];
		echo view('header', $data);
		echo view('fn/list_acceptpayment_complete');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function api_test($id = null, $test = null)
	{
		if ($id != null) {
			$data = $this->finance_model->getReceiveMoneyByID($id);
		} else {
			$data = $this->finance_model->getReceiveMoney();
		}
		if (!empty($data))
			return json_encode(array([$data, 'test' => $test]));
		else
			return json_encode(array(["massage" => "No data found"]));
	}
	// -----------------------------------------------------------------
	public function api_acceptpayment_present($startmon = null, $endmon = null)
	{
		if ($startmon == null && $endmon == null) {
			return json_encode(array(["massage" => "please enter date api_acceptpayment_present(YYYY-mm-dd ,YYYY-mm-dd)"]));
		} else {
			$startmon = date('Y-m-01', strtotime($startmon));
			if ($endmon == null)
				$endmon = date("Y-m-t", strtotime($startmon));
			$data = $this->finance_model->getAcceptPaymentPresentByDate($startmon, $endmon);

			if (!empty($data))
				return json_encode($data);
			else
				return json_encode(array(["massage" => "No data found"]));
		}
	}
	// -----------------------------------------------------------------
	public function api_acceptpayment_overdue($startmon = null, $endmon = null)
	{
		if ($startmon == null && $endmon == null) {
			return json_encode(array(["massage" => "please enter date api_acceptpayment_present(YYYY-mm-dd ,YYYY-mm-dd)"]));
		} else {
			$startmon = date('Y-m-01', strtotime($startmon));
			if ($endmon == null)
				$endmon = date("Y-m-t", strtotime($startmon));
			$data = $this->finance_model->getAcceptPaymentOverdueByDate($startmon, $endmon);

			if (!empty($data))
				return json_encode($data);
			else
				return json_encode(array(["massage" => "No data found"]));
		}
	}
	// -----------------------------------------------------------------
	public function import_billing()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'subscription_fee_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "Record Type", "Sequence No.", "ชื่อธนาคาร", "Company Account", "วันที่ชำระ", "เวลาที่ชำระ", "ชื่อลูกค้า", "เลขบัตรประชาชน", "เบอร์โทร", "Reg 3", "Branch No.", "Teller No.", "Kind of Transaction", "ช่องทางการชำระ", "Cheque No.", "จำนวนทั้งสิ้น", "Cheque Bank Code");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'NET' => 'ATM',
					'CSH' => 'เคาท์เตอร์'
				];
				$bk = [
					'0' => '',
					'1' => '',
					'2' => '',
					'3' => '',
					'4' => '',
					'5' => '',
					'6' => 'ธนาคารกรุงไทย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getmoneyreciev2ByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
						$excel = [
							'id' 					=> $x['id'],
							'record_type' 			=> $x['record_type'],
							'sequence_no' 			=> $x['sequence_no'],
							'bank_code'				=> $bk[$x['bank_code']],
							'company_account' 		=> $x['company_account'],
							'payment_date'			=> $x['payment_date'],
							'payment_time' 			=> $x['payment_time'],
							'customer_name' 		=> $x['customer_name'],
							'customer_ref1'			=> $x['customer_ref1'],
							'customer_ref2' 		=> '0' . $x['customer_ref2'],
							'customer_ref3' 		=> $x['customer_ref3'],
							'branch_no' 			=> $x['branch_no'],
							'teller_no' 			=> $x['teller_no'],
							'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
							'transaction_code' 		=> $x['transaction_code'],
							'cheque_no' 			=> $x['cheque_no'],
							'amount' 				=> $x['amount'],
							'cheque_bank_code' 		=> $x['cheque_bank_code'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/import_billing');
			}
		}
		if ($this->request->getPost('save') != null) {
			if ($this->request->getFile('fn_moneyreciev_bank2')->getpath() != "") {
				$file = $_FILES['fn_moneyreciev_bank2']['tmp_name'];
				$handle = fopen($file, "r");
				$c = 0;
				$count_t = 0;
				$item = [];

				while (($filesop = fgetcsv($handle, 2000, ",")) !== false) {
					setlocale(LC_ALL, 'Thai');

					for ($j = 0; $j < 18; $j++) {
						$item[$count_t][$j] = $filesop[$j];
					}
					$count_t++;
					if ($c <> 0) {
						//$this->Crud_model->saverecords($fname,$lname);
					}

					$c = $c + 1;
					var_dump($filesop);
					$this->finance_model->addBillingCsvFile($filesop);
				}
				$this->finance_model->addLog(1);
			}
			return redirect()->to('/finance/import_billing');
		} else {
			// if ($this->request->getPost()) {
			// 	$from = $this->request->getPost("datepicker_from");
			// 	$to = $this->request->getPost("datepicker_to");
			// 	$data['data'] = $this->finance_model->getmoneyreciev2ByDate($from, $to);
			// } else {
			// 	$data['data'] = $this->finance_model->getmoneyreciev2();
			// }
			if ($this->request->getPost('search')) {
				$from1 = $this->request->getPost('datepicker_from1') ? $this->request->getPost('datepicker_from1') : null;
				$to1 = $this->request->getPost('datepicker_to1') ? $this->request->getPost('datepicker_to1') : null;
				$from2 = $this->request->getPost('datepicker_from2') ? $this->request->getPost('datepicker_from2') : null;
				$to2 = $this->request->getPost('datepicker_to2') ? $this->request->getPost('datepicker_to2') : null;
				$from3 = $this->request->getPost('datepicker_from3') ? $this->request->getPost('datepicker_from3') : null;
				$to3 = $this->request->getPost('datepicker_to3') ? $this->request->getPost('datepicker_to3') : null;
				$from4 = $this->request->getPost('datepicker_from4') ? $this->request->getPost('datepicker_from4') : null;
				$to4 = $this->request->getPost('datepicker_to4') ? $this->request->getPost('datepicker_to4') : null;
				$from5 = $this->request->getPost('datepicker_from5') ? $this->request->getPost('datepicker_from5') : null;
				$to5 = $this->request->getPost('datepicker_to5') ? $this->request->getPost('datepicker_to5') : null;
				$data['all'] 		= $this->finance_model->getmoneyreciev2($from1, $to1);
				$data['atm'] 		= $this->finance_model->getmoneyreciev2($from2, $to2, 'NET');
				$data['counter']	= $this->finance_model->getmoneyreciev2($from3, $to3, 'CSH');
				// $data['check']	= $this->finance_model->getmoneyreciev2($from4,$to4,'CSH');
				// $data['cash']	= $this->finance_model->getmoneyreciev2($from5,$to5,'CSH');
			} else {
				$data['all'] 		= $this->finance_model->getmoneyreciev2();
				$data['atm'] 		= $this->finance_model->getmoneyreciev2(null, null, 'NET');
				$data['counter']	= $this->finance_model->getmoneyreciev2(null, null, 'CSH');
				// $data['check']	= $this->finance_model->getmoneyreciev2(null,null,'CSH');
				// $data['cash']	= $this->finance_model->getmoneyreciev2(null,null,'CSH');
			}
			$data['title'] = 'รายการรับชำระเงินสงเคราะห์สมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/import_billing');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------

	public function view_import_billingid($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getmoneyreciev2ByID($id);
			$data['title'] = 'รายละเอียดรายการรับชำระเงินสงเคราะห์สมาชิก';
			//echo view('header', $data);
			echo view('fn/view_import_billingid', $data);
			//echo view('footer');
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------

	public function view_import_billing_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getmoneyreciev2ByID($id);
			$data['title'] = 'รายงานการรับชำระเงิน';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_import_billing_pdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/list_acceptpayment');
	}
	// -----------------------------------------------------------------
	public function print_check_pay()
	{
		if ($this->request->getPost('save')) {
			$add = [
				'no' 				=> $this->request->getPost('no'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'out_date' 			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('out_date')))),
				'recipient_name'	=> $this->request->getPost('recipient_name'),
				'amount_th'   		=> $this->request->getPost('amount_th') ? $this->request->getPost('amount_th') : 'ศูนย์บาทถ้วน',
				'amount_int'      	=> $this->request->getPost('amount_int') ? (float)str_replace(",", "", $this->request->getPost('amount_int')) : 0,
				'note'				=> $this->request->getPost('note'),
				'bank'				=> $this->request->getPost('bank'),
			];
			var_dump($add);
			$this->finance_model->addPrintcheckpay($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/print_check_pay');
		}
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'print_check_pay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// $header = array("ลำดับ", "รหัส", "เลขที่เช็ค", "วันที่เขียนเช็ค", "วันที่เช็คครบกำหนด", "ชื่อผู้รับ", "จำนวนเงิน(ภาษาไทย)", "จำนวนเงิน", "หมายเหตุการจ่าย");
				$header = array("ลำดับ", "วันที่เขียนเช็ค", "เลขที่เช็ค", "วันที่เช็คครบกำหนด", "ชื่อธนาคาร", "สาขา", "รหัสสาขา", "ประเภทเช็ค", "จำนวนเงิน");
				fputcsv($file, $header);
				$no = 1;
				$bk_name = [
					null => 'ข้อมูลผิดพลาด',
					'1' => 'ธนาคารกรุงไทย',
					'2' => 'ธนาคารไทยพาณิชย์',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPrintcheckpayByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$x['out_date'] = date('d/m/Y', strtotime($x['out_date']));
						$excel = [
							'no' 			=> $no,
							'date' 			=> $x['date'],
							'no_pcp' 		=> $x['no'],
							'out_date' 		=> $x['out_date'],
							'bank_name'		=> $bk_name[$x['bank']],
							'branch' 		=> $x[''],
							'branch_id' 	=> $x[''],
							'chechk_type'	=> $x[''],
							'note' 			=> $x['amount_int'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/print_check_pay');
			}
		}
		if ($this->request->getPost('search')) {
			$from = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
			$to = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
			$data['data'] = $this->finance_model->getPrintcheckpayByDate($from, $to);

			// set_cookie('tab','data',time()+10);
		} else {
			$data['data'] = $this->finance_model->getPrintcheckpay();
		}

		$data['title'] = 'พิมพ์เช็คจ่าย';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/print_check_pay');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function edit_print_check_pay($id)
	{
		if ($this->request->getPost('save')) {
			$add = [
				'no' 				=> $this->request->getPost('no'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'out_date' 			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('out_date')))),
				'recipient_name'	=> $this->request->getPost('recipient_name'),
				'amount_th'   		=> $this->request->getPost('amount_th') ? $this->request->getPost('amount_th') : 'ศูนย์บาทถ้วน',
				'amount_int'      	=> $this->request->getPost('amount_int') ? (float)str_replace(",", "", $this->request->getPost('amount_int')) : 0,
				'note'				=> $this->request->getPost('note'),
			];
			var_dump($add);
			$this->finance_model->editPrintcheckpay($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/print_check_pay');
		}
		$data['data'] = $this->finance_model->getPrintcheckpayByID($id);
		$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
		$data['data'][0]['out_date'] = Date('d/m/Y', strtotime($data['data'][0]['out_date']));
		$data['title'] = 'แก้ไขพิมพ์เช็คจ่าย';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('finance/print_check_pay'), 'title' => 'พิมพ์เช็คจ่าย'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/edit_print_check_pay');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function delete_print_check_pay($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->finance_model->deleteTPrintcheckpayByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/print_check_pay');
		}
	}
	// -----------------------------------------------------------------
	public function view_print_check_pay($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPrintcheckpayByID($id);
			$data['title'] = 'รายละเอียดพิมพ์เช็คจ่าย';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/print_check_pay'), 'title' => 'พิมพ์เช็คจ่าย'],
				['link' => '#', 'title' => $data['title']]
			];
			echo view('header', $data);
			echo view('fn/view_print_check_pay');
			echo view('footer');
		} else
			return redirect()->to('/finance/print_check_pay');
	}
	// -----------------------------------------------------------------
	public function view_print_check_payid($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPrintcheckpayByID($id);
			$data['title'] = 'รายละเอียดพิมพ์เช็คจ่าย';
			echo view('fn/view_print_check_payid', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------

	public function view_print_check_paypdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->finance_model->getPrintcheckpayByID($id);
			$data['title'] = 'พิมพ์เช็คจ่าย';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('fn/view_print_check_paypdf', $data);
			$filename = 'print_check_pay_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/finance/print_check_pay');
	}
	// -----------------------------------------------------------------
	public function list_deposit()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'deposit_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ผู้นำฝาก", "วันที่นำฝาก", "ผู้ดำเนินการ", "จำนวนเงิน", "ค่าบริการ", "จำนวนเงินทั้งสิ้น");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getDeposit(null, null, $id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$excel = [
							'no' 				=> $no,
							'depositor' 		=> $x['depositor'],
							'date' 				=> $x['date'],
							'operator'			=> $x['operator'],
							'amount' 			=> $x['amount'],
							'service_charge'	=> $x['service_charge'],
							'total' 			=> $x['total'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/list_deposit');
			}
		}
		$from = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] 		= $this->finance_model->getDeposit($from, $to);
		$data['title'] 		= 'ฝากเงินสด';
		$data['pages'] 		= [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/list_deposit');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function deposit()
	{
		if ($this->request->getPost('save')) {
			$add = [
				'depositor' 		=> $this->request->getPost('depositor'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'operator'			=> $this->request->getPost('operator'),
				'agency'   			=> $this->request->getPost('agency'),
				'deposit_items'     => $this->request->getPost('deposit_items'),
				'no'				=> $this->request->getPost('no'),
				'note'				=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'service_charge'	=> $this->request->getPost('service_charge') ? (float)str_replace(",", "", $this->request->getPost('service_charge')) : 0,
				'total'      		=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			var_dump($add);
			$this->finance_model->addDeposit($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_deposit');
		} else {
			$data['title'] = 'เพิ่มฝากเงินสด';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_deposit'), 'title' => 'ฝากเงินสด'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/deposit');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_deposit($id)
	{
		if ($this->request->getPost('save')) {
			$add = [
				'depositor' 		=> $this->request->getPost('depositor'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'operator'			=> $this->request->getPost('operator'),
				'agency'   			=> $this->request->getPost('agency'),
				'deposit_items'     => $this->request->getPost('deposit_items'),
				'no'				=> $this->request->getPost('no'),
				'note'				=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'service_charge'	=> $this->request->getPost('service_charge') ? (float)str_replace(",", "", $this->request->getPost('service_charge')) : 0,
				'total'      		=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			var_dump($add);
			$this->finance_model->editDeposit($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_deposit');
		} else {
			$data['data']	= $this->finance_model->getDeposit(null, null, $id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] 	= 'แก้ไขฝากเงินสด';
			echo view('header', $data);
			echo view('fn/edit_deposit');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function view_deposit($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getDeposit(null, null, $id);
			$data['title'] = 'รายละเอียดฝากเงินสด';
			$data['pages'] 	= [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_deposit'), 'title' => 'ฝากเงินสด'], ['link' => '#', 'title' => $data['title']]];

			echo view('header', $data);
			echo view('fn/view_deposit');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_deposit');
	}
	// -----------------------------------------------------------------
	public function view_deposit_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getDeposit(null, null, $id);
			$data['title'] = 'รายละเอียดฝากเงินสด';
			echo view('fn/view_deposit_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function delete_deposit($id = null)
	{
		if ($id == null)
			return redirect()->to('/finance/list_deposit');
		else {
			$this->finance_model->deletetDepositByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_deposit');
		}
	}
	// -----------------------------------------------------------------
	public function list_withdraw()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'withdraw_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ผู้ถอน", "วันที่ถอนเงิน", "ผู้ดำเนินการ", "จำนวนเงิน", "ค่าบริการ", "จำนวนเงินทั้งสิ้น");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getWithdraw(null, null, $id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d/m/Y', strtotime($x['date']));
						$excel = [
							'no' 				=> $no,
							'withdrawal' 		=> $x['withdrawal'],
							'date' 				=> $x['date'],
							'operator'			=> $x['operator'],
							'amount' 			=> $x['amount'],
							'service_charge'	=> $x['service_charge'],
							'total' 			=> $x['total'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/list_withdraw');
			}
		}
		$from = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] 		= $this->finance_model->getWithdraw($from, $to);
		$data['title'] 		= 'ถอนเงินสด';
		$data['pages'] 		= [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/list_withdraw');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function withdraw()
	{
		if ($this->request->getPost('save')) {
			$add = [
				'withdrawal' 		=> $this->request->getPost('withdrawal'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'operator'			=> $this->request->getPost('operator'),
				'agency'   			=> $this->request->getPost('agency'),
				'no'				=> $this->request->getPost('no'),
				'note'				=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'service_charge'	=> $this->request->getPost('service_charge') ? (float)str_replace(",", "", $this->request->getPost('service_charge')) : 0,
				'total'      		=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			var_dump($add);
			$this->finance_model->addWithdraw($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_withdraw');
		} else {
			$data['title'] = 'เพิ่มถอนเงินสด';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_withdraw'), 'title' => 'ถอนเงินสด'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/withdraw');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_withdraw($id = null)
	{
		if ($this->request->getPost('save')) {
			$add = [
				'withdrawal' 		=> $this->request->getPost('withdrawal'),
				'date' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'operator'			=> $this->request->getPost('operator'),
				'agency'   			=> $this->request->getPost('agency'),
				'no'				=> $this->request->getPost('no'),
				'note'				=> $this->request->getPost('note'),
				'amount'      		=> $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				'service_charge'	=> $this->request->getPost('service_charge') ? (float)str_replace(",", "", $this->request->getPost('service_charge')) : 0,
				'total'      		=> $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
			];
			var_dump($add);
			$this->finance_model->editWithdraw($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_withdraw');
		} else {
			$data['data']	= $this->finance_model->getWithdraw(null, null, $id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] = 'แก้ไขถอนเงินสด';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_withdraw'), 'title' => 'ถอนเงินสด'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/edit_withdraw');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function view_withdraw($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getWithdraw(null, null, $id);
			$data['title'] = 'รายละเอียดถอนเงินสด';
			$data['pages'] 	= [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_withdraw'), 'title' => 'ถอนเงินสด'], ['link' => '#', 'title' => $data['title']]];

			echo view('header', $data);
			echo view('fn/view_withdraw');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_withdraw');
	}
	// -----------------------------------------------------------------

	public function view_withdraw_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getWithdraw(null, null, $id);
			$data['title'] = 'รายละเอียดถอนเงินสด';
			echo view('fn/view_withdraw_id', $data);
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------
	public function delete_withdraw($id = null)
	{
		if ($id == null)
			return redirect()->to('/finance/list_withdraw');
		else {
			$this->finance_model->deletetWithdrawByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_withdraw');
		}
	}
	// -----------------------------------------------------------------
	public function list_subscription_fee()
	{

		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'subscription_fee_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array(
					"ลำดับ", "เขียนที่", "วันที่", "ชื่อสมาชิก", "เกิดวันที่", "อายุ(ปี)", "เลขบัตรประจำตัวประชาชน", "อาชีพ", "ตำแหน่ง", "ปฎิบัติงานที่", "สถานที่รับเงินเดือนหรือค่าจ้าง", "บ้านเลขที่", "หมู่ที่", "ซอย/ตรอก", "ถนน", "ตำบล/แขวง", "อำเภอ/เขต", "จังหวัด", "รหัสไปรษณีย์", "โทรศัพท์", "ไปรษณีย์อิเล็กทรอนิกส์ (E-mail)", "ประเภทสมาชิก", "โดยเป็น", "ของสมาชิกสามัญเลขทะเบียน", "ชำระเงินสงเคราะห์โดย", "หักเงินจาก", "ชื่อบัญชี", "บัญชีเลขที่", "ชื่อผู้จัดการศพ", "เกี่ยวข้องเป็น", "ที่อยู่", "โทรศัพท์", "ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 1", "เกี่ยวข้องเป็น", "ที่อยู่", "โทรศัพท์", "ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 2", "เกี่ยวข้องเป็น", "ที่อยู่", "โทรศัพท์", "ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 3", "เกี่ยวข้องเป็น", "ที่อยู่", "โทรศัพท์", "ชื่อผู้มีสิทธิ์รับเงินสงเคราะห์ 4", "เกี่ยวข้องเป็น", "ที่อยู่", "โทรศัพท์"
				);
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'NET' => 'ATM',
					'CSH' => 'เคาท์เตอร์'
				];
				$bk = [
					'0' => '',
					'1' => '',
					'2' => '',
					'3' => '',
					'4' => '',
					'5' => '',
					'6' => 'ธนาคารกรุงไทย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getSubscriptionfee($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));

					$cr = [
						'1' => 'ข้าราชการ',
						'2' => 'พนักงานราชการ',
						'3' => 'พนักงานกระทรวง',
						'4' => 'ลูกจ้างชั่วคราว',
						'5' => 'อื่นๆ',
					];
					$mb_t = [
						'1' => 'สามัญ',
						'2' => 'สมทบ',
					];
					$sf = [
						'1' => 'บุตร',
						'2' => 'คู่สมรส',
						'3' => 'บิดา',
						'4' => 'มารดา',
						'5' => 'พี่น้องร่วมบิดามารดาเดียวกัน',
					];
					$ym = [
						// null => 'เทส',
						// '0' => 'เทส',
						'1' => 'รายปี',
						'2' => 'รายเดือน',
					];
					$tp = [
						// null => 'เทส',
						// '0' => 'เทส',
						'1' => 'หักเงินเดือนจากผู้สมัครสมาชิก',
						'2' => 'หักเงินจากธนาคาร',
					];
					foreach ($data as $x) {
						$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
						$excel = [
							'id' 					=> $x['id'],
							'write_at' 				=> $x['write_at'],
							'date' 					=> $x['date'],
							'sub_name' 				=> $x['sub_name'],
							'birthday'				=> $x['birthday'],
							'age' 					=> $x['age'],
							'id_card' 				=> $x['id_card'],
							'career'				=> $cr[$x['career']],
							'position' 				=> $x['position'],
							'at_work' 				=> $x['at_work'],
							'payroll_location' 		=> $x['payroll_location'],
							'house_number'			=> $x['house_number'],
							'swine' 				=> $x['swine'],
							'alley' 				=> $x['alley'],
							'street' 				=> $x['street'],
							'canton' 				=> $x['canton'],
							'district' 				=> $x['district'],
							'province' 				=> $x['province'],
							'postal_code' 			=> $x['postal_code'],
							'phone'					=> "=\"" . $x["phone"] . "\"",
							'email' 				=> $x['email'],
							'sub_type' 				=>  $mb_t[$x['sub_type']],
							'sub_for' 				=> $sf[$x['sub_for']],
							'sub_relationships' 	=> $x['sub_relationships'],
							'yearly_monthly' 		=> $ym[$x['yearly_monthly']],
							'type_payment' 			=> $tp[$x['type_payment']],
							'account_name' 			=> $x['account_name'],
							'account_number' 		=> $x['account_number'],
							'funeral_name' 			=> $x['funeral_name'],
							'funeral_concerned' 	=> $x['funeral_concerned'],
							'funeral_address' 		=> $x['funeral_address'],
							'funeral_tel'			=> "=\"" . $x["funeral_tel"] . "\"",
							'recipient_name1' 		=> $x['recipient_name1'],
							'recipient_concerned1' 	=> $x['recipient_concerned1'],
							'recipient_address1' 	=> $x['recipient_address1'],
							'recipient_tel1'		=> "=\"" . $x["recipient_tel1"] . "\"",
							'recipient_name2' 		=> $x['recipient_name2'],
							'recipient_concerned2' 	=> $x['recipient_concerned2'],
							'recipient_address2' 	=> $x['recipient_address2'],
							'recipient_tel2'		=> "=\"" . $x["recipient_tel2"] . "\"",
							'recipient_name3' 		=> $x['recipient_name3'],
							'recipient_concerned3' 	=> $x['recipient_concerned3'],
							'recipient_address3' 	=> $x['recipient_address3'],
							'recipient_tel3'		=> "=\"" . $x["recipient_tel3"] . "\"",
							'recipient_name4' 		=> $x['recipient_name4'],
							'recipient_concerned4' 	=> $x['recipient_concerned4'],
							'recipient_address4' 	=> $x['recipient_address4'],
							'recipient_tel4'		=> "=\"" . $x["recipient_tel4"] . "\"",


						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/statement');
			}
		}
		$from1 = $this->request->getPost('datepicker_from1') ? $this->request->getPost('datepicker_from1') : null;
		$to1 = $this->request->getPost('datepicker_to1') ? $this->request->getPost('datepicker_to1') : null;
		// $from2 = $this->request->getPost('datepicker_from2') ? $this->request->getPost('datepicker_from2') : null;
		// $to2 = $this->request->getPost('datepicker_to2') ? $this->request->getPost('datepicker_to2') : null;
		// $from3 = $this->request->getPost('datepicker_from3') ? $this->request->getPost('datepicker_from3') : null;
		// $to3 = $this->request->getPost('datepicker_to3') ? $this->request->getPost('datepicker_to3') : null;
		// $from4 = $this->request->getPost('datepicker_from4') ? $this->request->getPost('datepicker_from4') : null;
		// $to4 = $this->request->getPost('datepicker_to4') ? $this->request->getPost('datepicker_to4') : null;
		// $from5 = $this->request->getPost('datepicker_from5') ? $this->request->getPost('datepicker_from5') : null;
		// $to5 = $this->request->getPost('datepicker_to5') ? $this->request->getPost('datepicker_to5') : null;
		$data['all'] 		= $this->finance_model->getSubscriptionfee(null, $from1, $to1);
		// $data['atm'] 		= $this->finance_model->getmoneyreciev2($from2, $to2, 'NET');
		// $data['counter']	= $this->finance_model->getmoneyreciev2($from3, $to3, 'CSH');
		// $data['check']	= $this->finance_model->getmoneyreciev2($from4,$to4,'CSH');
		// $data['cash']	= $this->finance_model->getmoneyreciev2($from5,$to5,'CSH');
		$data['title'] 		= 'ค่าสมัครสมาชิก';
		$data['pages'] 		= [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/list_subscription_fee');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function subscription_fee()
	{
		if ($this->request->getPost('save')) {
			$add = [
				'write_at' 				=> $this->request->getPost('write_at'),
				'date' 					=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'sub_name' 				=> $this->request->getPost('sub_name'),
				'birthday' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('birthday')))),
				'age'					=> $this->request->getPost('age'),
				'id_card'   			=> $this->request->getPost('id_card'),
				'career'				=> $this->request->getPost('career'),
				'position'				=> $this->request->getPost('position'),
				'at_work'				=> $this->request->getPost('at_work'),
				'payroll_location'		=> $this->request->getPost('payroll_location'),
				'house_number'			=> $this->request->getPost('house_number'),
				'swine'					=> $this->request->getPost('swine'),
				'alley'					=> $this->request->getPost('alley'),
				'street'				=> $this->request->getPost('street'),
				'canton'				=> $this->request->getPost('canton'),
				'district'				=> $this->request->getPost('district'),
				'province'				=> $this->request->getPost('province'),
				'postal_code'			=> $this->request->getPost('postal_code'),
				'phone'					=> $this->request->getPost('phone'),
				'email'					=> $this->request->getPost('email'),
				'sub_type'				=> $this->request->getPost('sub_type'),
				'sub_for'				=> $this->request->getPost('sub_for'),
				'sub_relationships'		=> $this->request->getPost('sub_relationships'),
				'yearly_monthly'		=> $this->request->getPost('yearly_monthly'),
				'type_payment'			=> $this->request->getPost('type_payment'),
				'account_name'			=> $this->request->getPost('account_name'),
				'account_number'		=> $this->request->getPost('account_number'),
				'funeral_name'			=> $this->request->getPost('funeral_name'),
				'funeral_concerned'		=> $this->request->getPost('funeral_concerned'),
				'funeral_address'		=> $this->request->getPost('funeral_address'),
				'funeral_tel'			=> $this->request->getPost('funeral_tel'),
				'recipient_name1'		=> $this->request->getPost('recipient_name1'),
				'recipient_concerned1'	=> $this->request->getPost('recipient_concerned1'),
				'recipient_address1'	=> $this->request->getPost('recipient_address1'),
				'recipient_tel1'		=> $this->request->getPost('recipient_tel1'),
				'recipient_name2'		=> $this->request->getPost('recipient_name2'),
				'recipient_concerned2'	=> $this->request->getPost('recipient_concerned2'),
				'recipient_address2'	=> $this->request->getPost('recipient_address2'),
				'recipient_tel2'		=> $this->request->getPost('recipient_tel2'),
				'recipient_name3'		=> $this->request->getPost('recipient_name3'),
				'recipient_concerned3'	=> $this->request->getPost('recipient_concerned3'),
				'recipient_address3'	=> $this->request->getPost('recipient_address3'),
				'recipient_tel3'		=> $this->request->getPost('recipient_tel3'),
				'recipient_name4'		=> $this->request->getPost('recipient_name4'),
				'recipient_concerned4'	=> $this->request->getPost('recipient_concerned4'),
				'recipient_address4'	=> $this->request->getPost('recipient_address4'),
				'recipient_tel4'		=> $this->request->getPost('recipient_tel4'),
			];
			// var_dump($add);
			$this->finance_model->addSubscriptionfee($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_subscription_fee');
		} else {
			$data['title'] = 'เพิ่มค่าสมัครสมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_subscription_fee'), 'title' => 'ค่าสมัครสมาชิก'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/subscription_fee');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_subscription_fee($id = null)
	{
		if ($id == null)
			return redirect()->to('/finance/list_subscription_fee');
		if ($this->request->getPost('save')) {
			$add = [
				'write_at' 				=> $this->request->getPost('write_at'),
				'date' 					=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'sub_name' 				=> $this->request->getPost('sub_name'),
				'birthday' 				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('birthday')))),
				'age'					=> $this->request->getPost('age'),
				'id_card'   			=> $this->request->getPost('id_card'),
				'career'				=> $this->request->getPost('career'),
				'position'				=> $this->request->getPost('position'),
				'at_work'				=> $this->request->getPost('at_work'),
				'payroll_location'		=> $this->request->getPost('payroll_location'),
				'house_number'			=> $this->request->getPost('house_number'),
				'swine'					=> $this->request->getPost('swine'),
				'alley'					=> $this->request->getPost('alley'),
				'street'				=> $this->request->getPost('street'),
				'canton'				=> $this->request->getPost('canton'),
				'district'				=> $this->request->getPost('district'),
				'province'				=> $this->request->getPost('province'),
				'postal_code'			=> $this->request->getPost('postal_code'),
				'phone'					=> $this->request->getPost('phone'),
				'email'					=> $this->request->getPost('email'),
				'sub_type'				=> $this->request->getPost('sub_type'),
				'sub_for'				=> $this->request->getPost('sub_for'),
				'sub_relationships'		=> $this->request->getPost('sub_relationships'),
				'yearly_monthly'		=> $this->request->getPost('yearly_monthly'),
				'type_payment'			=> $this->request->getPost('type_payment'),
				'account_name'			=> $this->request->getPost('account_name'),
				'account_number'		=> $this->request->getPost('account_number'),
				'funeral_name'			=> $this->request->getPost('funeral_name'),
				'funeral_concerned'		=> $this->request->getPost('funeral_concerned'),
				'funeral_address'		=> $this->request->getPost('funeral_address'),
				'funeral_tel'			=> $this->request->getPost('funeral_tel'),
				'recipient_name1'		=> $this->request->getPost('recipient_name1'),
				'recipient_concerned1'	=> $this->request->getPost('recipient_concerned1'),
				'recipient_address1'	=> $this->request->getPost('recipient_address1'),
				'recipient_tel1'		=> $this->request->getPost('recipient_tel1'),
				'recipient_name2'		=> $this->request->getPost('recipient_name2'),
				'recipient_concerned2'	=> $this->request->getPost('recipient_concerned2'),
				'recipient_address2'	=> $this->request->getPost('recipient_address2'),
				'recipient_tel2'		=> $this->request->getPost('recipient_tel2'),
				'recipient_name3'		=> $this->request->getPost('recipient_name3'),
				'recipient_concerned3'	=> $this->request->getPost('recipient_concerned3'),
				'recipient_address3'	=> $this->request->getPost('recipient_address3'),
				'recipient_tel3'		=> $this->request->getPost('recipient_tel3'),
				'recipient_name4'		=> $this->request->getPost('recipient_name4'),
				'recipient_concerned4'	=> $this->request->getPost('recipient_concerned4'),
				'recipient_address4'	=> $this->request->getPost('recipient_address4'),
				'recipient_tel4'		=> $this->request->getPost('recipient_tel4'),
			];
			// var_dump($add);
			$this->finance_model->editSubscriptionfee($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_subscription_fee');
		} else {
			$data['data']	= $this->finance_model->getSubscriptionfee($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['data'][0]['birthday'] = Date('d/m/Y', strtotime($data['data'][0]['birthday']));
			$data['title'] = 'แก้ไขค่าสมัครสมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_subscription_fee'), 'title' => 'ค่าสมัครสมาชิก'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('fn/edit_subscription_fee');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function view_subscription_fee($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getSubscriptionfee($id);
			$data['title'] = 'รายละเอียดค่าสมัครสมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_subscription_fee'), 'title' => 'ค่าสมัครสมาชิก'], ['link' => '#', 'title' => $data['title']]];

			echo view('header', $data);
			echo view('fn/view_subscription_fee');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_subscription_fee');
	}
	// -----------------------------------------------------------------
	public function view_subscription_fee_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getSubscriptionfee($id);
			$data['title'] = 'รายละเอียดค่าสมัครสมาชิก';
			echo view('fn/view_subscription_fee_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function delete_subscription_fee($id = null)
	{
		if ($id == null)
			return redirect()->to('/finance/list_subscription_fee');
		else {
			$this->finance_model->deletetSubscriptionfeeByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_subscription_fee');
		}
	}
	// -----------------------------------------------------------------
	public function statement()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'statement_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "Record Type", "Sequence No.", "ชื่อธนาคาร", "Company Account", "วันที่ชำระ", "เวลาที่ชำระ", "ชื่อลูกค้า", "เลขบัตรประชาชน", "เบอร์โทร", "Reg 3", "Branch No.", "Teller No.", "Kind of Transaction", "ช่องทางการชำระ", "Cheque No.", "จำนวนทั้งสิ้น", "Cheque Bank Code");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'NET' => 'ATM',
					'CSH' => 'เคาท์เตอร์'
				];
				$bk = [
					'0' => '',
					'1' => '',
					'2' => '',
					'3' => '',
					'4' => '',
					'5' => '',
					'6' => 'ธนาคารกรุงไทย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data	= $this->finance_model->getmoneyreciev2ByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
						$excel = [
							'id' 					=> $x['id'],
							'record_type' 			=> $x['record_type'],
							'sequence_no' 			=> $x['sequence_no'],
							'bank_code'				=> $bk[$x['bank_code']],
							'company_account' 		=> $x['company_account'],
							'payment_date'			=> $x['payment_date'],
							'payment_time' 			=> $x['payment_time'],
							'customer_name' 		=> $x['customer_name'],
							'customer_ref1'			=> $x['customer_ref1'],
							'customer_ref2' 		=> '0' . $x['customer_ref2'],
							'customer_ref3' 		=> $x['customer_ref3'],
							'branch_no' 			=> $x['branch_no'],
							'teller_no' 			=> $x['teller_no'],
							'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
							'transaction_code' 		=> $x['transaction_code'],
							'cheque_no' 			=> $x['cheque_no'],
							'amount' 				=> $x['amount'],
							'cheque_bank_code' 		=> $x['cheque_bank_code'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
					$no = $no + 1;
				}
				exit;
			} else {
				return redirect()->to('/finance/statement');
			}
		}
		$data = [
			'title' 			=> 'กระทบยอดการเงิน',
			'sumpayoffdebt' 	=> $this->finance_model->sumPayoffDebt(),
			'sumcheckpay' 		=> $this->finance_model->sumCheckPay(),
			'sumimportbilling'	=> $this->finance_model->sumImportBilling(),
			'sumdebtor' 		=> $this->account_model->countDebtor(),
		];
		$from1 = $this->request->getPost('datepicker_from1') ? $this->request->getPost('datepicker_from1') : null;
		$to1 = $this->request->getPost('datepicker_to1') ? $this->request->getPost('datepicker_to1') : null;
		$data['all'] 		= $this->finance_model->getmoneyreciev2($from1, $to1);

		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/statement'), 'title' => 'การเงิน'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('fn/statement', $data);
		echo view('footer');
	}
}
