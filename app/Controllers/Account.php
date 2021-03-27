<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use DateTime;


class Account extends Controller
{
	public function __construct()
	{
		$this->account_model = model('account_model');
		$this->finance_model = model('finance_model');

		$session = session();
		if (!$session->has('login')) {
			return redirect()->to('/login');
		}
	}
	// -----------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'บริหารจัดการ';
		echo view('header', $data);
		echo view('ac/index');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function setting()
	{
		$data['title'] = 'ตั้งค่าบัญชี';
		echo view('header', $data);
		echo view('ac/setting');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function actions_generaljournal()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'generaljournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getGeneralJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"" ? $x['amount'] : '0',

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getGeneralJournalByID($id);
				}
				$data['title'] = 'Generaljournal';
				$html = view('ac/pdf_generaljournal', $data);
				$filename = 'generaljournal_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_generaljournal');
	}
	// -----------------------------------------------------------------
	public function view_generaljournal_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getGeneralJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันทั่วไป';
			echo view('ac/view_generaljournal_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_generaljournal()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {

				// file name
				$filename = 'generaljournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data
					$data = $this->account_model->getGeneralJournalByID($id);
					// file creation
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"" ? $x['amount'] : '0',

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$data['data'] = $this->account_model->getGeneralJournal($search, $from, $to);
		$data['title'] = 'สมุดรายวันทั่วไป';
		echo view('header', $data);
		echo view('ac/list_generaljournal');
		echo view('footer');
		// var_dump($data['data']);

	}
	// -----------------------------------------------------------------
	public function view_generaljournal($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getGeneralJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันทั่วไป';
			echo view('header', $data);
			echo view('ac/view_generaljournal');
			echo view('footer');
		} else
			return redirect()->to('/account/list_generaljournal');
	}
	// -----------------------------------------------------------------
	public function generaljournal()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
			];
			$this->account_model->addGeneralJournal($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_generaljournal');
		} else {
			$data['title'] = 'สมุดรายวันทั่วไป';
			echo view('header', $data);
			echo view('ac/generaljournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_generaljournal($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->editGeneralJournal($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_generaljournal');
		} else {
			$data['data'] = $this->account_model->getGeneralJournalByID($id);
			$data['title'] = 'แก้ไขสมุดรายวันทั่วไป';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_generaljournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_generaljournal($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteGeneralJournalByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_generaljournal');
		}
	}
	// -----------------------------------------------------------------
	public function actions_payjournal()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'payjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getPayJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getPayJournalByID($id);
				}
				$data['title'] = 'Payjournal';
				$html = view('ac/pdf_payjournal', $data);
				$filename = 'payjournal_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_payjournal');
	}
	// -----------------------------------------------------------------
	public function view_payjournal_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getPayJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันจ่าย';
			echo view('ac/view_payjournal_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_payjournal()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {

				// file name 
				$filename = 'payjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getPayJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$data['data'] = $this->account_model->getPayJournal($search, $from, $to);
		$data['title'] = 'สมุดรายวันจ่าย';
		echo view('header', $data);
		echo view('ac/list_payjournal');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_payjournal($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getPayJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันจ่าย';
			echo view('header', $data);
			echo view('ac/view_payjournal');
			echo view('footer');
		} else
			return redirect()->to('/account/list_payjournal');
	}
	// -----------------------------------------------------------------
	public function payjournal()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
			];
			$this->account_model->addPayJournal($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_payjournal');
		} else {
			$data['title'] = 'สมุดรายวันจ่าย';
			echo view('header', $data);
			echo view('ac/payjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_payjournal($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->editPayJournal($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_payjournal');
		} else {
			$data['data'] = $this->account_model->getPayJournalByID($id);
			$data['title'] = 'แก้ไขสมุดรายวันจ่าย';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_payjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_payjournal($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deletePayJournalByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_payjournal');
		}
	}
	// -----------------------------------------------------------------
	public function actions_receiptjournal()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'receiptjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getReceiptJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getReceiptJournalByID($id);
				}
				$data['title'] = 'Receiptjournal';
				$html = view('ac/pdf_receiptjournal', $data);
				$filename = 'receiptjournal_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('pdf')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_receiptjournal');
	}
	// -----------------------------------------------------------------
	public function view_receiptjournal_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getReceiptJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันรับ';
			echo view('ac/view_receiptjournal_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_receiptjournal()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {

				// file name 
				$filename = 'receiptjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getReceiptJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$data['data'] = $this->account_model->getReceiptJournal($search, $from, $to);
		$data['title'] = 'สมุดรายวันรับ';
		echo view('header', $data);
		echo view('ac/list_receiptjournal');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_receiptjournal($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getReceiptJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันรับ';
			echo view('header', $data);
			echo view('ac/view_receiptjournal');
			echo view('footer');
		} else
			return redirect()->to('/account/list_receiptjournal');
	}
	// -----------------------------------------------------------------
	public function receiptjournal()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->addReceiptJournal($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_receiptjournal');
		} else {
			$data['title'] = 'สมุดรายวันรับ';
			echo view('header', $data);
			echo view('ac/receiptjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_receiptjournal($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->editReceiptJournal($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_receiptjournal');
		} else {
			$data['data'] = $this->account_model->getReceiptJournalByID($id);
			$data['title'] = 'แก้ไขสมุดรายวันรับ';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_receiptjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_receiptjournal($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteReceiptJournalByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_receiptjournal');
		}
	}
	// -----------------------------------------------------------------
	public function actions_salesjournal()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'salesjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getSalesJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getSalesJournalByID($id);
				}
				$data['title'] = 'Salesjournal';
				$html = view('ac/pdf_salesjournal', $data);
				$filename = 'salesjournal_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('pdf')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_salesjournal');
	}
	// -----------------------------------------------------------------
	public function view_salesjournal_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getSalesJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันขาย';
			echo view('ac/view_salesjournal_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_salesjournal()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {

				// file name 
				$filename = 'salesjournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getSalesJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$data['data'] = $this->account_model->getSalesJournal($search, $from, $to);
		$data['title'] = 'สมุดรายวันขาย';
		echo view('header', $data);
		echo view('ac/list_salesjournal');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_salesjournal($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getSalesJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันขาย';
			echo view('header', $data);
			echo view('ac/view_salesjournal');
			echo view('footer');
		} else
			return redirect()->to('/account/list_salesjournal');
	}
	// -----------------------------------------------------------------
	public function salesjournal()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->addSalesJournal($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_salesjournal');
		} else {
			$data['title'] = 'สมุดรายวันขาย';
			echo view('header', $data);
			echo view('ac/salesjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_salesjournal($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->editSalesJournal($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_salesjournal');
		} else {
			$data['data'] = $this->account_model->getSalesJournalByID($id);
			$data['title'] = 'แก้ไขสมุดรายวันขาย';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_salesjournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_salesjournal($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteSalesJournalByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_salesjournal');
		}
	}
	// -----------------------------------------------------------------
	public function actions_purchasejournal()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'purchasejournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getPurchaseJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getPurchaseJournalByID($id);
				}
				$data['title'] = 'Purchasejournal';
				$html = view('ac/pdf_purchasejournal', $data);
				$filename = 'purchasejournal_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('pdf')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_purchasejournal');
	}
	// -----------------------------------------------------------------
	public function view_purchasejournal_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getPurchaseJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันซื้อ';
			echo view('ac/view_purchasejournal_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_purchasejournal()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {

				// file name 
				$filename = 'purchasejournal_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("เลขที่", "วันที่", "อ้างอิง", "รายละอียด", "จำนวนเงิน");
				// $header = array("ID", "No_ID", "Date", "Refer", "Detail", "Note", "Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getPurchaseJournalByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'no_id' => $x['no_id'],
							'date' => $x['date'],
							'refer' => $x['refer'],
							'detail' => strip_tags($x['detail']),
							'amount' => "=\"" . $x["amount"] . ".00\"",

						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$data['data'] = $this->account_model->getPurchaseJournal($search, $from, $to);
		$data['title'] = 'สมุดรายวันซื้อ';
		echo view('header', $data);
		echo view('ac/list_purchasejournal');
		echo view('footer');
	}
	// -----------------------------------------------------------------	
	public function view_purchasejournal($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getPurchaseJournalByID($id);
			$data['title'] = 'รายละเอียดสมุดรายวันซื้อ';
			echo view('header', $data);
			echo view('ac/view_purchasejournal');
			echo view('footer');
		} else
			return redirect()->to('/account/list_purchasejournal');
	}
	// -----------------------------------------------------------------
	public function purchasejournal()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->addPurchaseJournal($add);

			$this->account_model->addLog(1);
			return redirect()->to('/account/list_purchasejournal');
		} else {
			$data['title'] = 'สมุดรายวันซื้อ';
			echo view('header', $data);
			echo view('ac/purchasejournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_purchasejournal($id = null)
	{
		if ($id == null)
			return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'no_id'     => $this->request->getPost('no_id'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'refer'   	=> $this->request->getPost('refer'),
				'detail'    => $this->request->getPost('detail'),
				'note'      => $this->request->getPost('note'),
				'amount'    => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
				// 'amount'    => $this->request->getPost('amount') ? $this->request->getPost('amount') : 0
			];
			$this->account_model->editPurchaseJournal($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_purchasejournal');
		} else {
			$data['data'] = $this->account_model->getPurchaseJournalByID($id);
			$data['title'] = 'แก้ไขสมุดรายวันซื้อ';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_purchasejournal');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_purchasejournal($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deletePurchaseJournalByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_purchasejournal');
		}
	}
	// -----------------------------------------------------------------
	public function actions_creditor()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'creditor_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ชื่อผู้ติดต่อ", "เลขที่บัญชี", "วันที่", "ยอดคงเหลือ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getCreditorByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'follower_name' => $x['follower_name'],
							'account_number' => $x['account_number'],
							'date' => $x['date'],
							'balance' => $x['balance'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getCreditorByID($id);
				}
				$data['title'] = 'Creditor';
				$html = view('ac/pdf_creditor', $data);
				$filename = 'creditor_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->AddPage('L');
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('pdf')) {
				// echo $this->request->getPost('pdf');
				exit;
			}
		} else
			return redirect()->to('/account/list_creditor');
	}
	// -----------------------------------------------------------------
	public function view_creditor_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getCreditorByID($id);
			$data['title'] = 'รายละเอียดข้อมูลเจ้าหนี้';
			echo view('ac/view_creditor_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function list_creditor()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'creditor_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ชื่อผู้ติดต่อ", "เลขที่บัญชี", "วันที่", "ยอดคงเหลือ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->account_model->getCreditorByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							'follower_name' => $x['follower_name'],
							'account_number' => $x['account_number'],
							'date' => $x['date'],
							'balance' => $x['balance'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->account_model->getCreditor($from, $to);
		$data['title'] = 'บันทึกข้อมูลเจ้าหนี้';
		echo view('header', $data);
		echo view('ac/list_creditor');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_creditor($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getCreditorByID($id);
			$data['title'] = 'รายละเอียดข้อมูลเจ้าหนี้';
			echo view('header', $data);
			echo view('ac/view_creditor');
			echo view('footer');
		} else
			return redirect()->to('/account/list_creditor');
	}
	// -----------------------------------------------------------------
	public function creditor()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'address'     		=> $this->request->getPost('address'),
				'postal_code'      	=> $this->request->getPost('postal_code') ? $this->request->getPost('postal_code') : NULL,
				'telephone'   		=> $this->request->getPost('telephone'),
				'email'    			=> $this->request->getPost('email'),
				'follower_name'     => $this->request->getPost('follower_name'),
				'note'      		=> $this->request->getPost('note'),
				'taxpayer_number'   => $this->request->getPost('taxpayer_number'),
				'branch'      		=> $this->request->getPost('branch'),
				'payout_type'      	=> $this->request->getPost('payout_type'),
				'tax_rate'      	=> $this->request->getPost('tax_rate'),
				'tax_type'      	=> $this->request->getPost('tax_type'),
				'tax_conditions'    => $this->request->getPost('tax_conditions'),
				'payer_type'      	=> $this->request->getPost('payer_type'),
				'account_number'    => $this->request->getPost('account_number'),
				'unit'      		=> $this->request->getPost('unit') ? $this->request->getPost('unit') : 0,
				'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				'approval_limit'    => $this->request->getPost('approval_limit') ? $this->request->getPost('approval_limit') : 0,
				'total_early_year'	=> $this->request->getPost('total_early_year') ? $this->request->getPost('total_early_year') : 0,
				'date'      		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'balance'    		=> $this->request->getPost('balance') ? (float)str_replace(",", "", $this->request->getPost('balance')) : 0,
				'prepaid_checks'    => $this->request->getPost('prepaid_checks') ? (float)str_replace(",", "", $this->request->getPost('prepaid_checks')) : 0,
			];
			$this->account_model->addCreditor($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_creditor');
		} else {
			$data['title'] = 'บันทึกข้อมูลเจ้าหนี้';
			echo view('header', $data);
			echo view('ac/creditor');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_creditor($id = null)
	{
		if ($id == null) return false;
		if ($this->request->getPost('save') != null) {
			$add = [
				'address'     		=> $this->request->getPost('address'),
				'postal_code'      	=> $this->request->getPost('postal_code') ? $this->request->getPost('postal_code') : NULL,
				'telephone'   		=> $this->request->getPost('telephone'),
				'email'    			=> $this->request->getPost('email'),
				'follower_name'     => $this->request->getPost('follower_name'),
				'note'      		=> $this->request->getPost('note'),
				'taxpayer_number'   => $this->request->getPost('taxpayer_number'),
				'branch'      		=> $this->request->getPost('branch'),
				'payout_type'      	=> $this->request->getPost('payout_type'),
				'tax_rate'      	=> $this->request->getPost('tax_rate'),
				'tax_type'      	=> $this->request->getPost('tax_type'),
				'tax_conditions'    => $this->request->getPost('tax_conditions'),
				'payer_type'      	=> $this->request->getPost('payer_type'),
				'account_number'    => $this->request->getPost('account_number'),
				'unit'      		=> $this->request->getPost('unit') ? $this->request->getPost('unit') : 0,
				'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				'approval_limit'    => $this->request->getPost('approval_limit') ? $this->request->getPost('approval_limit') : 0,
				'total_early_year'	=> $this->request->getPost('total_early_year') ? $this->request->getPost('total_early_year') : 0,
				'date'      		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'balance'    		=> $this->request->getPost('balance') ? (float)str_replace(",", "", $this->request->getPost('balance')) : 0,
				'prepaid_checks'    => $this->request->getPost('prepaid_checks') ? (float)str_replace(",", "", $this->request->getPost('prepaid_checks')) : 0,
			];
			$this->account_model->editCreditor($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/list_creditor');
		} else {
			$data['data'] = $this->account_model->getCreditorByID($id);
			$data['title'] = 'แก้ไขข้อมูลเจ้าหนี้';
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			echo view('header', $data);
			echo view('ac/edit_creditor');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_creditor($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteCreditorByID($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_creditor');
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
			echo view('ac/list_debtor');
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
			} elseif ($this->request->getPost('pdf') || $this->request->getPost('report')) {
				$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
				foreach ($_POST['val'] as $id) {
					$data['data'][] = $this->account_model->getDebtorByID($id);
				}
				$data['title'] = 'Bebtor';
				$html = view('ac/pdf_debtor', $data);
				$filename = 'debtor_' . date("Y_m_d_H_i_s") . '.pdf';
				$mpdf->AddPage('L');
				$mpdf->WriteHTML($html);
				return redirect()->to($mpdf->Output($filename, 'I'));
			} elseif ($this->request->getPost('report')) {
				// echo $this->request->getPost('pdf'); 
				exit;
			}
		} else
			return redirect()->to('/account/list_debtor');
	}
	// -----------------------------------------------------------------
	public function list_debtor()
	{
		$data['data'] = $this->account_model->getDebtor();
		$data['title'] = 'บันทึกข้อมูลสมาชิก';
		echo view('header', $data);
		echo view('ac/list_debtor');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_debtor($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->account_model->getDebtorByID($id);
			$data['title'] = 'รายละเอียดข้อมูลลูกหนี้';
			echo view('header', $data);
			echo view('ac/view_debtor');
			echo view('footer');
		} else
			return redirect()->to('/account/list_debtor');
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

			return redirect()->to('/account/list_debtor');

			// var_dump($add);
		} else {
			$data['title'] = 'บันทึกข้อมูลสมาชิก';
			$data['id'] = $this->account_model->getDebtorLastID();
			echo view('header', $data);
			echo view('ac/debtor');
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
			return redirect()->to('/account/list_debtor');
		} else {
			$data['data'] = $this->account_model->getDebtorByID($id);
			$data['title'] = 'แก้ไขข้อมูลลูกหนี้';

			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['data'][0]['follower_date'] = Date('d/m/Y', strtotime($data['data'][0]['follower_date']));
			$data['data'][0]['emergency_date'] = Date('d/m/Y', strtotime($data['data'][0]['emergency_date']));
			echo view('header', $data);
			echo view('ac/edit_debtor');
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
			return redirect()->to('/account/list_debtor');
		}
	}
	// -----------------------------------------------------------------
	public function actions_acceptpayment()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'acceptpayment_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รายการ", "ผู้นำฝาก", "เจ้าหน้าที่ดำเนินการ", "วันที่", "จำนวนเงิน");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAcceptPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							// 'id' => $x['id'],
							'document_id' => $x['document_id'],
							'customer_id' => $x['customer_id'],
							'customer_id_2' => $x['customer_id'],
							'date' => $x['date'],
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

			return redirect()->to('/account/list_acceptpayment');
	}
	// -----------------------------------------------------------------
	public function list_acceptpayment()
	{
		$data['data'] = $this->finance_model->getAcceptPayment();
		$data['title'] = 'รายงานการรับชำระเงินประจำวัน';
		echo view('header', $data);
		echo view('ac/list_acceptpayment');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function view_acceptpayment($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'รายละเอียดการรับชำระเงินประจำวัน';
			echo view('header', $data);
			echo view('ac/view_acceptpayment');
			echo view('footer');
		} else
			return redirect()->to('/account/list_acceptpayment');
	}
	// -----------------------------------------------------------------	
	public function actions_acceptpayment_mon()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell_x')) {

				// file name 
				$filename = 'acceptpayment_mon_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รายการ", "ผู้นำฝาก", "เจ้าหน้าที่ดำเนินการ", "วันที่", "จำนวนเงิน");
				// $header = array("ID", "Customer_ID", "Bill_TO", "Deparment_id", "Date", "Address", "Telephone", "Document_ID", "Add_Debt_ID", "Type_ID", "Note", "Vat", "Interest", "Cash", "Another", "Withholding_Tax", "Discount", "Payment_Amount");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->finance_model->getAcceptPaymentByID($id);
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$x['date'] = date('d-m-Y', strtotime($x['date']));
						$excel = [
							// 'id' => $x['id'],
							'document_id' => $x['document_id'],
							'customer_id' => $x['customer_id'],
							'customer_id_2' => $x['customer_id'],
							'date' => $x['date'],
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

			return redirect()->to('/account/list_acceptpayment_mon');
	}
	// -----------------------------------------------------------------	

	public function list_acceptpayment_mon()
	{
		$data['data'] = $this->finance_model->getAcceptPayment();
		$data['title'] = 'รายงานสรุปการรับชำระเงินประจำเดือน';
		echo view('header', $data);
		echo view('ac/list_acceptpayment_mon');
		echo view('footer');
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
				'vat'      			=> $this->request->getPost('vat') ? $this->request->getPost('vat') : 0,
				'interest'      	=> $this->request->getPost('interest') ? $this->request->getPost('interest') : 0,
				'cash'      		=> $this->request->getPost('cash') ? $this->request->getPost('cash') : 0,
				'another'      		=> $this->request->getPost('another') ? $this->request->getPost('another') : 0,
				'withholding_tax'   => $this->request->getPost('withholding_tax') ? $this->request->getPost('withholding_tax') : 0,
				'discount'      	=> $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
				'payment_amount'	=> $this->request->getPost('payment_amount') ? $this->request->getPost('payment_amount') : 0
			];
			$this->finance_model->editAcceptPayment($id, $add);
			$this->account_model->addLog(1);
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
			$this->account_model->addLog(1);
			return redirect()->to('/account/list_acceptpayment');
		}
	}
	// -----------------------------------------------------------------
	public function view_acceptpayment_mon($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->finance_model->getAcceptPaymentByID($id);
			$data['title'] = 'รายละเอียดการรับชำระเงินประจำเดือน';
			echo view('header', $data);
			echo view('ac/view_acceptpayment');
			echo view('footer');
		} else
			return redirect()->to('/account/list_acceptpayment');
	}
	// -----------------------------------------------------------------

	public function account_book($id = null)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'account_number'     	=> $this->request->getPost('account_number'),
				'th_name'      			=> $this->request->getPost('th_name'),
				'en_name'   			=> $this->request->getPost('en_name'),
				'supervisory_account'	=> $this->request->getPost('separate_department') ? 0 : $this->request->getPost('supervisory_account'),
				// 'account_level'     	=> $this->request->getPost('account_level'),
				'account_category'      => $this->request->getPost('account_category'),
				'type'   				=> $this->request->getPost('type'),
				// 'separate_department'   => $this->request->getPost('separate_department') ? $this->request->getPost('separate_department') : 0
			];
			if ($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 5)
				$add['supervisory_account'] = 0;

			if ($id != null) {
				$this->account_model->updateAccountBook($add, $id);
				$this->account_model->addLog(1);
				// return redirect()->to('/account/getfancytree/'.$id);
			} else {
				$this->account_model->addAccountBook($add);
				$this->account_model->addLog(1);

				// return redirect()->to('/account/getfancytree');
			}
			return redirect()->to('/account/account_book');
		} elseif ($this->request->getPost('delete') != null) {
			if ($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 5)
				return redirect()->to('/account/account_book');

			if ($id != null) {
				$this->account_model->deleteAccountBook($id);
				$this->account_model->addLog(1);
				// return redirect()->to('/account/getfancytree/'.$id);
			}
			return redirect()->to('/account/account_book');
		} else {
			$data['account_category'] = $this->account_model->getAccountCategory();
			$data['title'] = 'ผังบัญชี';
			echo view('header', $data);
			echo view('ac/account_book');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------

	public function getsupervisoryaccount($id = NULL)
	{
		$data['data'] = $this->account_model->getAccountCategoryByID($id);
		$new = $this->response->setJSON($data['data']);
		return $new;
	}
	// -----------------------------------------------------------------

	public function getfancytree($id = NULL)
	{
		$data = $this->account_model->getFancyTree($id);
		if ($data != false) {
			$i = 1;
			$new = "[";
			// echo "[";

			foreach ($data as $row) {
				$new .= '{"title": "' 					. $row['account_number'] . ' ' . $row['th_name'] . '" ';
				$new .= ',"key": ' 						. $row['id'];
				$new .= ',"ab_account_number": "' 		. $row['account_number'] . '"';
				$new .= ',"ab_th_name": "' 				. $row['th_name'] . '"';
				$new .= ',"ab_en_name": "' 				. $row['en_name'] . '"';
				$new .= ',"ab_account_category": "' 	. $row['account_category'] . '"';
				$new .= ',"ab_supervisory_account": "' 	. $row['supervisory_account'] . '"';
				$new .= ',"ab_type": "' 				. $row['type'] . '"';
				$new .= ',"ab_separate_department": "' 	. $row['separate_department'] . '"';
				// echo '{"key": "'.$row['id'].'","title": "' . $row['account_number'] . ' ' . $row['th_name'] . '" ';
				if ($row['type'] == 't') {
					$new .= ',"folder": true';
					// echo ',"folder": true';
				}
				if ($this->account_model->getFancyTree($row['id']) != false) {
					$new .= ',"children":';
					// echo ',"children":';
					$new .= $this->getfancytree($row['id']);
				}

				if (count($data) == $i) {
					$new .= '}';
					// echo '}';
				} else {
					$new .= '},';
					// echo '},';
				}
				$i++;
			}
			$new .= "]";
			// echo "]";
			return $new;
		}
		return false;
	}
	// -----------------------------------------------------------------
	public function budget()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'budget_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รายการ", "ได้รับจัดสรรปี 2561", "ตั้งคำขอปี 2562", "ประมาณการจ่านล่วงหน้า 2563", "ประมาณการจ่านล่วงหน้า 2564", "ประมาณการจ่านล่วงหน้า 2565", "ระบุคำชี้แจงและเหตุผลความจำเป็น");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/budget');
			}
		}
		$data['project']		= $this->account_model->getCostestimate();
		$data['data']		= $this->account_model->getBudget();
		$data['title'] 		= 'งบประมาณโครงการ';
		$data['pages'] 		= [['link' =>  base_url('/account/index'), 'title' => 'บริหารจัดการ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/budget');
		echo view('footer');
	}
	// -----------------------------------------------------------------	
	public function cost_estimate($id = null)
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'cost_estimate_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รายการ", "ได้รับจัดสรรปี 2561", "ตั้งคำขอปี 2562", "ประมาณการจ่านล่วงหน้า 2563", "ประมาณการจ่านล่วงหน้า 2564", "ประมาณการจ่านล่วงหน้า 2565", "ระบุคำชี้แจงและเหตุผลความจำเป็น");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/cost_estimate');
			}
		}
		$data['project']		= $this->account_model->getCostestimate();
		$data['data']		= $this->account_model->getCostestimateAPI($id);
		$data['title'] = 'ประมาณการค่าใช้จ่าย';
		$data['pages'] 		= [['link' =>  base_url('/account/index'), 'title' => 'บริหารจัดการ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/cost_estimate');
		echo view('footer');
	}
	// -----------------------------------------------------------------	
	public function budget_disbursement()
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'budget_disbursement_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("งบรายการจ่าย", "งบประมาณที่ได้รับ", "เบิกจ่ายจำนวน", "เบิกจ่าย%", "คงเหลือ", "หมายเหตุ");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/budget_disbursement');
			}
		}
		$data['data']		= $this->account_model->getBudget();
		$data['title'] = 'รายงานการเบิกจ่ายงบประมาณ';
		$data['pages'] 		= [['link' =>  base_url('/account/index'), 'title' => 'บริหารจัดการ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/budget_disbursement');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function money_source($year = null)
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'money_source_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รายจ่ายงบประมาณ", "ลำดับ", "แสดงผล", "งบขั้นต่ำ");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/money_source');
			}
		}
		$data['data']		= $this->account_model->getMoneysource(null, $year);
		$data['project']		= $this->account_model->getCostestimate();
		$data['title'] = 'ประเภทแหล่งเงิน';
		$data['pages'] 		= [['link' =>  base_url('/account/index'), 'title' => 'บริหารจัดการ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/money_source');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function add_money_source()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'operator'	=> $this->request->getPost('operator'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'year'    	=> $this->request->getPost('year'),
				'show'     	=> $this->request->getPost('show'),
				'budget'    => $this->request->getPost('budget'),
				'note'      => $this->request->getPost('note'),
			];

			$path = ROOTPATH . 'public/files/money_source_files/';
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			$this->account_model->addMoneysource($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/money_source');
		} else {
			$data['cost']		= $this->account_model->getCostestimate();
			$data['title'] 		= 'เพิ่มประเภทแหล่งเงิน';
			$data['pages'] 		= [['link' =>  base_url('/account/money_source'), 'title' => 'ประเภทแหล่งเงิน'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('ac/add_money_source');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_money_source($id = null)
	{
		if ($id ==  null)
			return redirect()->to('/account/money_source');
		if ($this->request->getPost('save') != null) {
			$add = [
				'operator'	=> $this->request->getPost('operator'),
				'date'      => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'year'    	=> $this->request->getPost('year'),
				'show'     	=> $this->request->getPost('show'),
				'budget'    => $this->request->getPost('budget'),
				'note'      => $this->request->getPost('note'),
			];

			$path = ROOTPATH . 'public/files/money_source_files/';
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			$this->account_model->editMoneysource($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/money_source');
		} else {
			$data['cost']		= $this->account_model->getCostestimate();
			$data['data']		= $this->account_model->getMoneysource($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] 		= 'แก้ไขประเภทแหล่งเงิน';
			$data['pages'] 		= [['link' =>  base_url('/account/money_source'), 'title' => 'ประเภทแหล่งเงิน'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('ac/edit_money_source');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function add_cost_estimate()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'operator'				=> $this->request->getPost('operator'),
				'department'   			=> $this->request->getPost('department'),
				'implementation_date'	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('implementation_date')))),
				'main_item'    			=> $this->request->getPost('main_item'),
				'sub_item'     			=> $this->request->getPost('sub_item'),
				'allocate_year'    		=> $this->request->getPost('allocate_year'),
				'request_year'      	=> $this->request->getPost('request_year'),
				'estimate_year1'      	=> $this->request->getPost('estimate_year1'),
				'estimate_year2'      	=> $this->request->getPost('estimate_year2'),
				'estimate_year3'      	=> $this->request->getPost('estimate_year3'),
				'note'      			=> $this->request->getPost('note'),
			];
			$path = ROOTPATH . 'public/files/cost_estimate_files/';
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}

			$this->account_model->addCostestimate($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/cost_estimate');
		} else {
			$data['title'] 		= 'เพิ่มประมาณการค่าใช้จ่าย';
			$data['pages'] 		= [['link' =>  base_url('/account/cost_estimate'), 'title' => 'ประมาณการค่าใช้จ่าย'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('ac/add_cost_estimate');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_cost_estimate($id = null)
	{
		if ($id == null) {
			return redirect()->to('/account/cost_estimate');
		}
		if ($this->request->getPost('save') != null) {
			$add = [
				'operator'				=> $this->request->getPost('operator'),
				'department'   			=> $this->request->getPost('department'),
				'implementation_date'	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('implementation_date')))),
				'main_item'    			=> $this->request->getPost('main_item'),
				'sub_item'     			=> $this->request->getPost('sub_item'),
				'allocate_year'    		=> $this->request->getPost('allocate_year'),
				'request_year'      	=> $this->request->getPost('request_year'),
				'estimate_year1'      	=> $this->request->getPost('estimate_year1'),
				'estimate_year2'      	=> $this->request->getPost('estimate_year2'),
				'estimate_year3'      	=> $this->request->getPost('estimate_year3'),
				'note'      			=> $this->request->getPost('note'),
			];
			$path = ROOTPATH . 'public/files/cost_estimate_files/';
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}

			$this->account_model->editCostestimate($id, $add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/cost_estimate');
		} else {
			$data['title'] 		= 'แก้ไขประมาณการค่าใช้จ่าย';
			$data['data'] 		= $this->account_model->getCostestimate($id);
			$data['data'][0]['implementation_date'] = Date('d/m/Y', strtotime($data['data'][0]['implementation_date']));
			$data['pages'] 		= [['link' =>  base_url('/account/cost_estimate'), 'title' => 'ประมาณการค่าใช้จ่าย'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('ac/edit_cost_estimate');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_cost_estimate($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->account_model->deleteCostestimate($id);
			$this->account_model->addLog(1);
			return redirect()->to('/account/cost_estimate');
		}
	}
	// -----------------------------------------------------------------
	public function view_cost_estimate($id = null)
	{
		if ($id == null) {
			return redirect()->to('/account/cost_estimate');
		}
		$data['title'] 		= 'รายละเอียดประมาณการค่าใช้จ่าย';
		$data['data'] 		= $this->account_model->getCostestimate($id);
		$data['pages'] 		= [['link' =>  base_url('/account/cost_estimate'), 'title' => 'ประมาณการค่าใช้จ่าย'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/view_cost_estimate');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function add_budget()
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'operator'			=> $this->request->getPost('operator'),
				'date'				=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'type'   			=> $this->request->getPost('type'),
				'approve'    		=> $this->request->getPost('approve'),
				'central_percent'   => $this->request->getPost('central_percent'),
				'central_amount'    => $this->request->getPost('central_amount') ? (float)str_replace(",", "", $this->request->getPost('central_amount')) : 0,
				'allocated'      	=> $this->request->getPost('allocated') ? (float)str_replace(",", "", $this->request->getPost('allocated')) : 0,
				'approved_budget'   => $this->request->getPost('approved_budget') ? (float)str_replace(",", "", $this->request->getPost('approved_budget')) : 0,
				'note'      		=> $this->request->getPost('note'),
			];

			$path = ROOTPATH . 'public/files/budget_files/';
			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			$this->account_model->addBudget($add);
			$this->account_model->addLog(1);

			return redirect()->to('/account/budget');
		} else {
			$data['main']		= $this->account_model->getCostestimate();
			$data['title'] 		= 'เพิ่มงบประมาณโครงการ';
			$data['pages'] 		= [['link' =>  base_url('/account/budget'), 'title' => 'งบประมาณโครงการ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('ac/add_budget');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------	

	public function getCost_estimate_api($id = NULL)
	{
		$data['data'] = $this->account_model->getCostestimateAPI($id);
		$new = $this->response->setJSON($data['data']);
		return $new;
	}
	// -----------------------------------------------------------------
	public function report_budget_disbursement($id = null)
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'budget_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รายการ", "ได้รับจัดสรรปี 2561", "ตั้งคำขอปี 2562", "ประมาณการจ่านล่วงหน้า 2563", "ประมาณการจ่านล่วงหน้า 2564", "ประมาณการจ่านล่วงหน้า 2565", "ระบุคำชี้แจงและเหตุผลความจำเป็น");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/budget');
			}
		}
		$data['project']		= $this->account_model->getCostestimate();
		$data['data']		= $this->account_model->getBudget();
		$data['title'] = 'รายงานการเบิกจ่ายงบประมาณ';
		$data['pages'] 		= [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/report_budget_disbursement');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_budget_disbursement_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->account_model->getBudget($id);
			$data['title'] = 'รายงานการเบิกจ่ายงบประมาณ';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('ac/report_budget_disbursement_pdf', $data);
			$filename = 'report_budget_disbursement_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/account/report_budget_disbursement');
	}
	// -----------------------------------------------------------------
	public function report_cost_estimate($id = null)
	{
		if ($this->request->getPost('excell_x')) {
			if (!empty($_POST['val'])) {
				// file name 
				$filename = 'cost_estimate_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("รายการ", "ได้รับจัดสรรปี 2561", "ตั้งคำขอปี 2562", "ประมาณการจ่านล่วงหน้า 2563", "ประมาณการจ่านล่วงหน้า 2564", "ประมาณการจ่านล่วงหน้า 2565", "ระบุคำชี้แจงและเหตุผลความจำเป็น");
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
				// foreach ($_POST['val'] as $id) {
				// 	// get data 
				// 	$data	= $this->finance_model->getmoneyreciev2ByID($id);
				// 	// file creation 
				// 	$file = fopen('php://output', 'w');
				// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				// 	foreach ($data as $x) {
				// 		$x['payment_date'] = date('d/m/Y', strtotime($x['payment_date']));
				// 		$excel = [
				// 			'id' 					=> $x['id'],
				// 			'record_type' 			=> $x['record_type'],
				// 			'sequence_no' 			=> $x['sequence_no'],
				// 			'bank_code'				=> $bk[$x['bank_code']],
				// 			'company_account' 		=> $x['company_account'],
				// 			'payment_date'			=> $x['payment_date'],
				// 			'payment_time' 			=> $x['payment_time'],
				// 			'customer_name' 		=> $x['customer_name'],
				// 			'customer_ref1'			=> $x['customer_ref1'],
				// 			'customer_ref2' 		=> '0' . $x['customer_ref2'],
				// 			'customer_ref3' 		=> $x['customer_ref3'],
				// 			'branch_no' 			=> $x['branch_no'],
				// 			'teller_no' 			=> $x['teller_no'],
				// 			'kind_of_transaction'	=> $ar[$x['kind_of_transaction']],
				// 			'transaction_code' 		=> $x['transaction_code'],
				// 			'cheque_no' 			=> $x['cheque_no'],
				// 			'amount' 				=> $x['amount'],
				// 			'cheque_bank_code' 		=> $x['cheque_bank_code'],
				// 		];
				// 		fputcsv($file, $excel);
				// 	}
				// 	fclose($file);
				// 	$no = $no + 1;
				// }
				exit;
			} else {
				return redirect()->to('/account/report_cost_estimate');
			}
		}
		$data['project']		= $this->account_model->getCostestimate();
		$data['data']		= $this->account_model->getCostestimateAPI($id);
		$data['title'] = 'รายงานประมาณการค่าใช้จ่าย';
		$data['pages'] 		= [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('ac/report_cost_estimate');
		echo view('footer');
		// var_dump($data['data']);

	}
	// -----------------------------------------------------------------
	public function report_cost_estimate_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->account_model->getCostestimateAPI($id);
			$data['title'] = 'รายงานประมาณการค่าใช้จ่าย';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('ac/report_cost_estimate_pdf', $data);
			$filename = 'report_cost_estimate_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/account/report_cost_estimate');
	}
	// -----------------------------------------------------------------
}
