<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Mpdf\Mpdf;
use CodeIgniter\HTTP\Files\UploadedFile;


// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Finance extends Controller
{
	public function __construct()
	{
		$this->account_model = model('account_model');
		$this->finance_model = model('finance_model');
	}
	// -----------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'บริหารจัดการ';
		echo view('header', $data);
		echo view('fn/index');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function setting()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'rate'     => $this->request->getPost('rate'),
				'maintenance'      => $this->request->getPost('maintenance'),
				'vat'   	=> $this->request->getPost('vat'),
			];
			$this->finance_model->editSetting($add);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/setting');
		} else {
			// $data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'บันทึกรับเงินสมาชิก'], ['link' => '#', 'title' => 'บันทึกรับเงินสมาชิก']];

			// $data['title'] = 'บันทึกรับเงินสมาชิก';
			// echo view('header', $data);
			// echo view('fn/receiving_money');
			// echo view('footer');

			$data['setting'] = $this->finance_model->getSetting();

			$data['title'] = 'ตั้งค่าการเงิน';
			echo view('header', $data);
			echo view('fn/setting');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function actions_receiving_money()
	{
		if ($this->request->getPost('search')) {
			$from = $this->request->getPost('datepicker_from');
			$to = $this->request->getPost('datepicker_to');

			$data['from'] = $from;
			$data['to'] = $to;
			$data['txt'] = $this->request->getPost('txt');

			$data['data'] = $this->finance_model->getReceiveMoney($from, $to, $txt);
			$data['title'] = 'บันทึกรับเงินสมาชิก';
			echo view('header', $data);
			echo view('fn/list_receiving_money');
			echo view('footer');
		} else {

			if (!empty($_POST['val'])) {
				if ($this->request->getPost('excell')) {

					// file name 
					$filename = 'receiving_money_' . date('Y_m_d_H_i_s') . '.csv';
					header("Content-Description: File Transfer");
					header("Content-Disposition: attachment; filename=$filename");
					header("Content-Type: application/csv; ");
					$file = fopen('php://output', 'w');
					$header = array("ID", "Customer_ID", "Bill_ID", "Employee_ID", "Unit_ID", "Bill_Date", "Group_ID", "Receive_Date", "Contact", "Status_ID", "Additional_Conditions", "Note", "Cancel_Bill");
					fputcsv($file, $header);
					foreach ($_POST['val'] as $id) {
						// get data 
						$data = $this->finance_model->getReceiveMoneyByID($id);
						// file creation 
						$file = fopen('php://output', 'w');
						foreach ($data as $x) {
							fputcsv($file, $x);
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
		}
	}
	// -----------------------------------------------------------------
	public function list_receiving_money()
	{
		$data['data'] = $this->finance_model->getReceiveMoney();
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'บันทึกรับเงินสมาชิก']];

		$data['title'] = 'บันทึกรับเงินสมาชิก';
		echo view('header', $data);
		echo view('fn/list_receiving_money');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_receiving_money($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'บันทึกรับเงินสมาชิก'], ['link' => '#', 'title' => 'รายละเอียดบันทึกรับเงินสมาชิก']];

			$data['title'] = 'รายละเอียดบันทึกรับเงินสมาชิก';
			echo view('header', $data);
			echo view('fn/view_receiving_money');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_receiving_money');
	}
	// -----------------------------------------------------------------
	public function receiving_money()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'     => $this->request->getPost('customer_id'),
				'bill_id'      => $this->request->getPost('bill_id'),
				'employee_id'   	=> $this->request->getPost('employee_id'),
				'unit_id'    => $this->request->getPost('unit_id'),
				'bill_date'      => $this->request->getPost('bill_date'),
				'group_id'    => $this->request->getPost('group_id'),

				'receive_date'     => $this->request->getPost('receive_date'),
				'contact'      => $this->request->getPost('contact'),
				'status_id'   	=> $this->request->getPost('status_id'),
				'additional_conditions'    => $this->request->getPost('additional_conditions'),
				'note'      => $this->request->getPost('note'),
				'cancel_bill'    => $this->request->getPost('cancel_bill') ? $this->request->getPost('cancel_bill') : 0
			];
			$this->finance_model->addReceiveMoney($add);
			$this->finance_model->addLog(1);
			// $data['title'] = 'บันทึกรับเงินสมาชิก';
			// $data['add']=$add;
			// echo view('header', $data);
			// echo view('fn/receiving_money');
			// echo view('footer');
			return redirect()->to('/finance/list_receiving_money');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'บันทึกรับเงินสมาชิก'], ['link' => '#', 'title' => 'บันทึกรับเงินสมาชิก']];

			$data['title'] = 'บันทึกรับเงินสมาชิก';
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
				'customer_id'     => $this->request->getPost('customer_id'),
				'bill_id'      => $this->request->getPost('bill_id'),
				'employee_id'   	=> $this->request->getPost('employee_id'),
				'unit_id'    => $this->request->getPost('unit_id'),
				'bill_date'      => $this->request->getPost('bill_date'),
				'group_id'    => $this->request->getPost('group_id'),
				'receive_date'     => $this->request->getPost('receive_date'),
				'contact'      => $this->request->getPost('contact'),
				'status_id'   	=> $this->request->getPost('status_id'),
				'additional_conditions'    => $this->request->getPost('additional_conditions'),
				'note'      => $this->request->getPost('note'),
				'cancel_bill'    => $this->request->getPost('cancel_bill') ? $this->request->getPost('cancel_bill') : 0
			];
			$this->finance_model->editReceiveMoney($id, $add);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_receiving_money');
		} else {
			$data['data'] = $this->finance_model->getReceiveMoneyByID($id);;
			$data['title'] = 'แก้ไขบันทึกรับเงินสมาชิก';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_receiving_money'), 'title' => 'บันทึกรับเงินสมาชิก'], ['link' => '#', 'title' => 'แก้ไขบันทึกรับเงินสมาชิก']];
			$data['debtor'] = $this->account_model->getDebtor();
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'datepay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Document_ID", "Date", "Status_ID", "Unit_Date", "Employee_ID", "Note");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getDatePayByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
	public function datepay()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'     => $this->request->getPost('customer_id'),
				'document_id'      => $this->request->getPost('document_id'),
				'date'      => $this->request->getPost('date'),
				'status_id'   	=> $this->request->getPost('status_id'),
				'unit_id'    => $this->request->getPost('unit_id'),
				'employee_id'   	=> $this->request->getPost('employee_id'),
				'note'      => $this->request->getPost('note')
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
				'customer_id'     => $this->request->getPost('customer_id'),
				'document_id'      => $this->request->getPost('document_id'),
				'date'      => $this->request->getPost('date'),
				'status_id'   	=> $this->request->getPost('status_id'),
				'unit_id'    => $this->request->getPost('unit_id'),
				'employee_id'   	=> $this->request->getPost('employee_id'),
				'note'      => $this->request->getPost('note')
			];
			$this->finance_model->editDatePay($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_datepay');
		} else {
			$data['data'] = $this->finance_model->getDatePayByID($id);
			$data['title'] = 'แก้ไขบันทึกวันนัดชำระ';
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_datepay'), 'title' => 'บันทึกวันนัดชำระ'], ['link' => '#', 'title' => 'แก้ไขบันทึกวันนัดชำระ']];
			$data['debtor'] = $this->account_model->getDebtor();
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
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'adddebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAddDebtByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
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
				'date'   		=> $this->request->getPost('date'),
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
				'date'   		=> $this->request->getPost('date'),
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
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'reducedebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getReduceDebtByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
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
				'date'   		=> $this->request->getPost('date'),
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
				'date'   		=> $this->request->getPost('date'),
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'acceptpayment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Vat", "Interest", "Cash", "Another", "Withholding_Tax", "Discount", "Payment_Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAcceptPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'acceptpayment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Vat", "Interest", "Cash", "Another", "Withholding_Tax", "Discount", "Payment_Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAcceptPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
				'date'   			=> $this->request->getPost('date'),
				'address'    		=> $this->request->getPost('address'),
				'telephone'   		=> $this->request->getPost('telephone'),
				'document_id'   	=> $this->request->getPost('document_id'),
				'add_debt_id'   	=> $this->request->getPost('add_debt_id'),
				'type_id'    		=> $this->request->getPost('type_id'),
				'note'   			=> $this->request->getPost('note'),
				'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				'interest'      	=> $this->request->getPost('interest') ? $this->request->getPost('interest') : 0,
				'cash'      		=> $this->request->getPost('cash') ? $this->request->getPost('cash') : 0,
				'another'      		=> $this->request->getPost('another') ? $this->request->getPost('another') : 0,
				'withholding_tax'   => $this->request->getPost('withholding_tax') ? $this->request->getPost('withholding_tax') : 0,
				'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				'payment_amount'	=> $this->request->getPost('payment_amount') ? $this->request->getPost('payment_amount') : 0
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
				'date'   			=> $this->request->getPost('date'),
				'address'    		=> $this->request->getPost('address'),
				'telephone'   		=> $this->request->getPost('telephone'),
				'document_id'   	=> $this->request->getPost('document_id'),
				'add_debt_id'   	=> $this->request->getPost('add_debt_id'),
				'type_id'    		=> $this->request->getPost('type_id'),
				'note'   			=> $this->request->getPost('note'),
				'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				'interest'      	=> $this->request->getPost('interest') ? $this->request->getPost('interest') : 0,
				'cash'      		=> $this->request->getPost('cash') ? $this->request->getPost('cash') : 0,
				'another'      		=> $this->request->getPost('another') ? $this->request->getPost('another') : 0,
				'withholding_tax'   => $this->request->getPost('withholding_tax') ? $this->request->getPost('withholding_tax') : 0,
				'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				'payment_amount'	=> $this->request->getPost('payment_amount') ? $this->request->getPost('payment_amount') : 0
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'overdue_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Day", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getOverdueByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		$data['data'] = $this->finance_model->getPayoffDebtByAdddeptid();
		// $data['data'] = $this->finance_model->getOverdue();
		$data['title'] = 'บันทึกเงินค้างจ่ายสมาชิก';
		$data['pages'] = [
			['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
			['link' => '#', 'title' => 'บันทึกเงินค้างจ่ายสมาชิก']
		];
		echo view('header', $data);
		echo view('fn/list_overdue');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_overdue($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getOverdueByID($id);
			$data['title'] = 'รายละเอียดรายการลูกหนี้ค้าง ยกมา';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_overdue'), 'title' => 'บันทึกเงินค้างจ่ายสมาชิก'],
				['link' => '#', 'title' => 'รายละเอียดรายการลูกหนี้ค้าง']
			];
			echo view('header', $data);
			echo view('fn/view_overdue');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_overdue');
	}
	// -----------------------------------------------------------------
	public function overdue()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->addOverdue($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_overdue');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'บันทึกเงินค้างจ่ายสมาชิก';
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_overdue'), 'title' => 'บันทึกเงินค้างจ่ายสมาชิก'],
				['link' => '#', 'title' => 'บันทึกเงินค้างจ่ายสมาชิก']
			];
			echo view('header', $data);
			echo view('fn/overdue');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_overdue($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->editOverdue($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_overdue');
		} else {
			$data['data'] = $this->finance_model->getOverdueByID($id);
			$data['title'] = 'แก้ไขบันทึกเงินค้างจ่ายสมาชิก';
			$data['debtor'] = $this->account_model->getDebtor();
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
			$this->finance_model->deleteOverdueByID($id);
			$this->finance_model->addLog(1);
			return redirect()->to('/finance/list_overdue');
		}
	}
	// -----------------------------------------------------------------
	public function actions_billing()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'billing_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Day", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getBillingByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		$data['title'] = 'เรียกเก็บค่าสมาชิก';
		$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => '#', 'title' => 'เรียกเก็บค่าสมาชิก']];
		echo view('header', $data);
		echo view('fn/list_billing');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_billing($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_billing'), 'title' => 'เรียกเก็บค่าสมาชิก'], ['link' => '#', 'title' => 'รายละเอียดเรียกเก็บค่าสมาชิก']];
			$data['title'] = 'รายละเอียดเรียกเก็บค่าสมาชิก';
			echo view('header', $data);
			echo view('fn/view_billing');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_billing');
	}
	// -----------------------------------------------------------------
	public function billing()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'customer_id'  	=> $this->request->getPost('customer_id'),
				'bill_to'      	=> $this->request->getPost('bill_to'),
				'department_id' => $this->request->getPost('department_id'),
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->addBilling($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_billing');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['pages'] = [['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'], ['link' => base_url('/finance/list_billing'), 'title' => 'เรียกเก็บค่าสมาชิก'], ['link' => '#', 'title' => 'เรียกเก็บค่าสมาชิก']];
			$data['title'] = 'เรียกเก็บค่าสมาชิก';
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
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->editBilling($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_billing');
		} else {
			$data['data'] = $this->finance_model->getBillingByID($id);
			$data['pages'] = [
				['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
				['link' => base_url('/finance/list_billing'), 'title' => 'เรียกเก็บค่าสมาชิก'],
				['link' => '#', 'title' => 'แก้ไขเรียกเก็บค่าสมาชิก']
			];
			$data['title'] = 'แก้ไขเรียกเก็บค่าสมาชิก';
			$data['debtor'] = $this->account_model->getDebtor();
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'payoffdebt_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Amount", "Day");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPayoffDebtByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		$data['data'] = $this->finance_model->getPayoffDebt();
		$data['title'] = 'จ่ายเงินค่าสมาชิก';
		echo view('header', $data);
		echo view('fn/list_payoffdebt');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_payoffdebt($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดจ่ายเงินค่าสมาชิก';
			echo view('header', $data);
			echo view('fn/view_payoffdebt');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_payoffdebt');
	}

	public function view_payoffdebtid($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'รายละเอียดจ่ายเงินค่าสมาชิก';
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
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->addPayoffDebt($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payoffdebt');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'จ่ายเงินค่าสมาชิก';
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
				'date'   		=> $this->request->getPost('date'),
				'address'    	=> $this->request->getPost('address'),
				'telephone'   	=> $this->request->getPost('telephone'),
				'document_id'   => $this->request->getPost('document_id'),
				'add_debt_id'   => $this->request->getPost('add_debt_id'),
				'type_id'    	=> $this->request->getPost('type_id'),
				'day'    		=> $this->request->getPost('unit_id'),
				'note'   		=> $this->request->getPost('note'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->editPayoffDebt($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_payoffdebt');
		} else {
			$data['data'] = $this->finance_model->getPayoffDebtByID($id);
			$data['title'] = 'แก้ไขจ่ายเงินค่าสมาชิก';
			$data['debtor'] = $this->account_model->getDebtor();
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
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'payment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Amount", "Day");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
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
				'date'   		=> $this->request->getPost('date'),
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
				'date'   		=> $this->request->getPost('date'),
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'check_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "INTO_Account", "Deparment_id", "Comment", "Deposit_Date", "Passed_Date", "Implementaion_Date", "Note", "Amount", "Deposit_ID");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getCheckByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		$data['title'] = 'บันทึกผ่านเช็ค';
		echo view('header', $data);
		echo view('fn/list_check');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_check($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getCheckByID($id);
			$data['title'] = 'บันทึกผ่านเช็ค';
			echo view('header', $data);
			echo view('fn/view_check');
			echo view('footer');
		} else
			return redirect()->to('/finance/list_check');
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
				'deposit_date'    		=> $this->request->getPost('deposit_date'),
				'passed_date'   		=> $this->request->getPost('passed_date'),
				'implementation_date'   => $this->request->getPost('implementation_date'),
				'note'   				=> $this->request->getPost('note'),
				'amount'      			=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->addCheck($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_check');
		} else {
			$data['debtor'] = $this->account_model->getDebtor();
			$data['title'] = 'บันทึกผ่านเช็ค';
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
				'deposit_date'    		=> $this->request->getPost('deposit_date'),
				'passed_date'   		=> $this->request->getPost('passed_date'),
				'implementation_date'   => $this->request->getPost('implementation_date'),
				'note'   				=> $this->request->getPost('note'),
				'amount'      			=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->finance_model->editCheck($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_check');
		} else {
			$data['data'] = $this->finance_model->getCheckByID($id);
			$data['title'] = 'แก้ไขบันทึกผ่านเช็ค';
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'pettycash_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Type_ID", "Status_ID", "No_ID", "Date", "Withdrawal_Slip", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getPettyCashByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
	public function pettycash()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'type_id'  			=> $this->request->getPost('type_id'),
				'status_id'      	=> $this->request->getPost('status_id'),
				'no_id' 			=> $this->request->getPost('no_id'),
				'date'   			=> $this->request->getPost('date'),
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
				'date'   			=> $this->request->getPost('date'),
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'checkpay_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Check_Date", "Check_Issue", "Check_ID", "Type_ID", "Debit_ID", "Amount", "Pay_For", "Check_Status", "Balance", "Passed_Date", "Cost", "Note");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getCheckPayByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		echo view('header', $data);
		echo view('fn/list_checkpay');
		echo view('footer');
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
	public function checkpay()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'check_date'  	=> $this->request->getPost('check_date'),
				'check_issue'   => $this->request->getPost('check_issue'),
				'cheack_id' 	=> $this->request->getPost('cheack_id'),
				'type_id'   	=> $this->request->getPost('type_id'),
				'debit_id'		=> $this->request->getPost('debit_id'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0,
				'pay_for'      	=> $this->request->getPost('pay_for') ? $this->request->getPost('pay_for') : 0,
				'check_status'	=> $this->request->getPost('check_status'),
				'balance'      	=> $this->request->getPost('balance') ? $this->request->getPost('balance') : 0,
				'passed_date'   => $this->request->getPost('passed_date'),
				'cost'      	=> $this->request->getPost('cost') ? $this->request->getPost('cost') : 0,
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
				'check_date'  	=> $this->request->getPost('check_date'),
				'check_issue'   => $this->request->getPost('check_issue'),
				'cheack_id' 	=> $this->request->getPost('cheack_id'),
				'type_id'   	=> $this->request->getPost('type_id'),
				'debit_id'		=> $this->request->getPost('debit_id'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0,
				'pay_for'      	=> $this->request->getPost('pay_for') ? $this->request->getPost('pay_for') : 0,
				'check_status'	=> $this->request->getPost('check_status'),
				'balance'      	=> $this->request->getPost('balance') ? $this->request->getPost('balance') : 0,
				'passed_date'   => $this->request->getPost('passed_date'),
				'cost'      	=> $this->request->getPost('cost') ? $this->request->getPost('cost') : 0,
				'note'   		=> $this->request->getPost('note'),
			];
			$this->finance_model->editCheckPay($id, $add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_checkpay');
		} else {
			$data['data'] = $this->finance_model->getCheckPayByID($id);
			$data['title'] = 'แก้ไขบันทึกเช็คจ่าย';
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
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell')) {

				// file name 
				$filename = 'transfer_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				$header = array("ID", "Department_ID", "No", "Date", "Reason", "Transfer_From", "Transfer_To", "Amount", "Fee");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getTransferByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					foreach ($data as $x) {
						fputcsv($file, $x);
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
		$data['data'] = $this->finance_model->getTransfer();
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
	public function transfer()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'department_id' => $this->request->getPost('department_id'),
				'no'   			=> $this->request->getPost('no'),
				'date' 			=> $this->request->getPost('date'),
				'reason'   		=> $this->request->getPost('reason'),
				'transfer_from'	=> $this->request->getPost('transfer_from'),
				'transfer_to'	=> $this->request->getPost('transfer_to'),
				'amount'      	=> $this->request->getPost('amount') ? $this->request->getPost('amount') : 0,
				'fee'      		=> $this->request->getPost('fee') ? $this->request->getPost('fee') : 0
			];
			$this->finance_model->addTransfer($add);
			$this->finance_model->addLog(1);

			return redirect()->to('/finance/list_transfer');
		} else {
			$data['title'] = 'โอนเงินระหว่างบัญชี';
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
				'date' 			=> $this->request->getPost('date'),
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
		$data['data'] = $this->finance_model->getAcceptPayment();;
		$data['title'] = 'รายงานการรับชำระเงิน';
		echo view('header', $data);
		echo view('fn/list_acceptpayment');
		echo view('footer');
	}

	public function view_acceptpaymentpdf($id = null)
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


			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));

			$html = view('fn/view_acceptpayment_pdf', $data);
			$filename = 'receiving_money_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));


			//echo view('fn/view_acceptpayment_pdf', $data);


		} else
			return redirect()->to('/finance/list_acceptpayment');
	}

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
		//echo view('fn/list_acceptpayment_mon');
		echo view('fn/list_datepay');
		echo view('footer');
	}

	public function list_acceptpayment_complete()
	{
		$data['data'] = $this->finance_model->getAcceptPayment();;
		$data['title'] = 'พิมพ์ใบเสร็จ';
		$data['pages'] = [
			['link' => 'http://chapanakit.airtimes.co', 'title' => 'Dashboard'],
			['link' => '#', 'title' => 'พิมพ์ใบเสร็จ']
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
}
