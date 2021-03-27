<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Supplies extends Controller
{
	public function __construct()
	{
		$this->account_model = model('account_model');
		$this->finance_model = model('finance_model');
		$this->supplie_model = model('supplie_model');

		$session = session();
		if (!$session->has('login')) {
			return redirect()->to('/login');
		}
	}
	// -----------------------------------------------------------------

	public function getcategorysub($id = NULL)
	{
		$data['data'] = $this->supplie_model->getCategoryBySubID($id);
		$new = $this->response->setJSON($data['data']);
		return $new;
	}
	// -----------------------------------------------------------------
	public function index()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "จำนวนเงิน (บาท)", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$ar = [
					'0' => '',
					'1' => 'ครุภัณฑ์ที่ใช้งานได้',
					'2' => 'ครุภัณฑ์เสื่อมสภาพ',
					'3' => 'ครุภัณฑ์ที่รอจำหน่าย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		$from 		= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 		= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['sumproduct'] 	= $this->supplie_model->sumProductByStatus();
		$data['sumapurchase']	= $this->supplie_model->sumPurchase();
		$data['sumhire'] 		= $this->supplie_model->sumHire();
		$data['sumbudget']		= $this->account_model->sumBudget();
		// $data['data'] 			= $this->supplie_model->getProduct();
		$data['data'] 			= $this->supplie_model->getProduct(null, $from, $to);
		$data['title'] 			= 'ภาพรวมงานพัสดุ';
		$data['pages'] 			= [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/index');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_product($status = null)
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "จำนวนเงิน (บาท)", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$ar = [
					'0' => '',
					'1' => 'ครุภัณฑ์ที่ใช้งานได้',
					'2' => 'ครุภัณฑ์เสื่อมสภาพ',
					'3' => 'ครุภัณฑ์ที่รอจำหน่าย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		// $search = $this->request->getPost('search') ? $this->request->getPost('search') : null;

		$from 		= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 		= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$type_id 	= $this->request->getPost('type_id') ? $this->request->getPost('type_id') : null;

		$data['type'] = $this->supplie_model->getType();
		$data['sumproduct'] = $this->supplie_model->sumProductByStatus();
		$data['sumactive'] = $this->supplie_model->sumProductByStatus(1);
		$data['suminactive'] = $this->supplie_model->sumProductByStatus(2);
		$data['sumother'] = $this->supplie_model->sumProductByStatus(3);
		$data['data'] = $this->supplie_model->getProduct($status, $from, $to, $type_id);
		$data['title'] = 'จัดการคลังครุภัณฑ์/วัสดุภัณฑ์';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_product');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function product()
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'name'     			=> $this->request->getPost('name'),
				'product_code' 		=> $this->request->getPost('product_code'),
				'type_id'   		=> $this->request->getPost('type_id'),
				'status'   			=> $this->request->getPost('status'),
				'category_main_id'  => $this->request->getPost('category_main_id'),
				'category_minor_id'	=> $this->request->getPost('category_minor_id2') ? $this->request->getPost('category_minor_id2') : null,
				'unit'   			=> $this->request->getPost('unit'),
				'responsible'   	=> $this->request->getPost('responsible'),
				'price'   			=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'vat'   			=> $this->request->getPost('vat'),
				'pr'   				=> $this->request->getPost('pr'),
				'po'   				=> $this->request->getPost('po'),
				'note'   			=> $this->request->getPost('note'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'noti'   			=> $this->request->getPost('noti'),
				// 'group'   			=> $this->request->getPost('group'),
			];
			$path = ROOTPATH . 'public/files';

			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			if ($this->request->getFile('image1')->getpath() != "") {
				$image1 = $this->request->getFile('image1');
				$newName = $image1->getRandomName();
				$image1->move($path, $newName);
				$add['image1'] = $newName;
			}
			if ($this->request->getFile('image2')->getpath() != "") {
				$image2 = $this->request->getFile('image2');
				$newName = $image2->getRandomName();
				$image2->move($path, $newName);
				$add['image2'] = $newName;
			}

			// var_dump($add);
			$this->supplie_model->addProduct($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_product');
		} else {
			$data['category'] = $this->supplie_model->getCategoryMain();
			// $data['category'] = $this->supplie_model->getCategory();
			// $data['subcategory'] = $this->supplie_model->getSubCategory();/* sub */
			$data['type'] = $this->supplie_model->getType();
			$data['unit'] = $this->supplie_model->getUnit();
			$data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['po'] = $this->supplie_model->getFormpurchase();
			$data['pr'] = $this->supplie_model->getBuySupplies();
			$data['title'] = 'เพิ่มครุภัณฑ์/วัสดุภัณฑ์';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_product'), 'title' => 'จัดการคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/product');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_product($id)
	{
		$path = ROOTPATH . 'public/files/';
		if ($this->request->getPost('del_image1') != null) {
			// helper('filesystem');

			// $data = $this->supplie_model->getProductByID($id);
			// delete_files($path . $data[0]['image1']);

			$add = [
				'name'     			=> $this->request->getPost('name'),
				'product_code' 		=> $this->request->getPost('product_code'),
				'type_id'   		=> $this->request->getPost('type_id'),
				'status'   			=> $this->request->getPost('status'),
				'category_main_id'  => $this->request->getPost('category_main_id'),
				'category_minor_id'	=> $this->request->getPost('category_minor_id2') ? $this->request->getPost('category_minor_id2') : null,
				'unit'   			=> $this->request->getPost('unit'),
				'responsible'   	=> $this->request->getPost('responsible'),
				'price'   			=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'vat'   			=> $this->request->getPost('vat'),
				'pr'   				=> $this->request->getPost('pr'),
				'po'   				=> $this->request->getPost('po'),
				'note'   			=> $this->request->getPost('note'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'noti'   			=> $this->request->getPost('noti'),
				// 'group'   			=> $this->request->getPost('group'),
			];
			$add['image1'] = null;

			$this->supplie_model->editProduct($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_product');
		} else if ($this->request->getPost('del_image2') != null) {
			// helper('filesystem');

			// $data = $this->supplie_model->getProductByID($id);
			// delete_files($path . $data[0]['image2']);

			$add = [
				'name'     			=> $this->request->getPost('name'),
				'product_code' 		=> $this->request->getPost('product_code'),
				'type_id'   		=> $this->request->getPost('type_id'),
				'status'   			=> $this->request->getPost('status'),
				'category_main_id'  => $this->request->getPost('category_main_id'),
				'category_minor_id'	=> $this->request->getPost('category_minor_id2') ? $this->request->getPost('category_minor_id2') : null,
				'unit'   			=> $this->request->getPost('unit'),
				'responsible'   	=> $this->request->getPost('responsible'),
				'price'   			=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'vat'   			=> $this->request->getPost('vat'),
				'pr'   				=> $this->request->getPost('pr'),
				'po'   				=> $this->request->getPost('po'),
				'note'   			=> $this->request->getPost('note'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				// 'group'   			=> $this->request->getPost('group'),
			];
			$add['image2'] = null;

			$this->supplie_model->editProduct($id, $add);
			$this->supplie_model->addLog(1);
		} else if ($this->request->getPost('save') != null) {

			$add = [
				'name'     			=> $this->request->getPost('name'),
				'product_code' 		=> $this->request->getPost('product_code'),
				'type_id'   		=> $this->request->getPost('type_id'),
				'status'   			=> $this->request->getPost('status'),
				'category_main_id'  => $this->request->getPost('category_main_id'),
				'category_minor_id'	=> $this->request->getPost('category_minor_id2') ? $this->request->getPost('category_minor_id2') : null,
				'unit'   			=> $this->request->getPost('unit'),
				'responsible'   	=> $this->request->getPost('responsible'),
				'price'   			=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'vat'   			=> $this->request->getPost('vat'),
				'pr'   				=> $this->request->getPost('pr'),
				'po'   				=> $this->request->getPost('po'),
				'note'   			=> $this->request->getPost('note'),
				'date'   			=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				// 'group'   			=> $this->request->getPost('group'),
			];
			// $path = ROOTPATH . 'public/files/';

			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			if ($this->request->getFile('image1')->getpath() != "") {
				$image1 = $this->request->getFile('image1');
				$newName = $image1->getRandomName();
				$image1->move($path, $newName);
				$add['image1'] = $newName;
			}
			if ($this->request->getFile('image2')->getpath() != "") {
				$image2 = $this->request->getFile('image2');
				$newName = $image2->getRandomName();
				$image2->move($path, $newName);
				$add['image2'] = $newName;
			}
			$this->supplie_model->editProduct($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_product');
		} else {
			$data['category'] = $this->supplie_model->getCategoryMain();
			// $data['category'] = $this->supplie_model->getCategory();
			// $data['subcategory'] = $this->supplie_model->getSubCategory();/* sub */
			$data['type'] = $this->supplie_model->getType();
			$data['unit'] = $this->supplie_model->getUnit();
			$data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['po'] = $this->supplie_model->getFormpurchase();
			$data['pr'] = $this->supplie_model->getBuySupplies();
			$data['data'] = $this->supplie_model->getProductByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] = 'แก้ไขครุภัณฑ์/วัสดุภัณฑ์';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_product'), 'title' => 'จัดการคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_product');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_product($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteProductByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_product');
		}
	}
	// -----------------------------------------------------------------
	public function view_product($id = null)
	{
		$data['data'] = $this->supplie_model->getProductByID($id);
		$data['category'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_main_id']);
		$data['category_sub'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_minor_id']);
		$data['type'] = $this->supplie_model->getTypeByID($data['data'][0]['type_id']);
		$data['unit'] = $this->supplie_model->getUnitByID($data['data'][0]['unit']);
		$data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['vat']);
		$data['title'] = 'รายละเอียดครุภัณฑ์/วัสดุภัณฑ์';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_product'), 'title' => 'จัดการคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_product');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_product_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getProductByID($id);
			$data['category'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_main_id']);
			$data['category_sub'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_minor_id']);
			$data['type'] = $this->supplie_model->getTypeByID($data['data'][0]['type_id']);
			$data['unit'] = $this->supplie_model->getUnitByID($data['data'][0]['unit']);
			$data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['vat']);
			$data['title'] = 'รายละเอียดครุภัณฑ์/วัสดุภัณฑ์';
			echo view('sp/view_product_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------

	public function view_supplies_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getProductByID($id);
			$data['purchase'] = $this->supplie_model->getPurchaseByID($data['data'][0]['supplies_purchase_id']);
			$data['title'] = 'รายละเอียดออกพัสดุ';
			echo view('sp/view_supplies_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function actions_product()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "จำนวนเงิน (บาท)", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$ar = [
					'0' => '',
					'1' => 'ครุภัณฑ์ที่ใช้งานได้',
					'2' => 'ครุภัณฑ์เสื่อมสภาพ',
					'3' => 'ครุภัณฑ์ที่รอจำหน่าย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		} else
			return redirect()->to('/supplies');
	}
	// -----------------------------------------------------------------
	public function list_supplies()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "จำนวนเงิน (บาท)", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$ar = [
					'0' => '',
					'1' => 'ครุภัณฑ์ที่ใช้งานได้',
					'2' => 'ครุภัณฑ์เสื่อมสภาพ',
					'3' => 'ครุภัณฑ์ที่รอจำหน่าย',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
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
		$data['data'] = $this->supplie_model->getProduct(null, $from, $to);
		// $data['data'] = $this->supplie_model->getProduct();
		// $data['data'] = $this->supplie_model->getSupplies();
		$data['title'] = 'ออกเลขพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_supplies');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function supplies($id = null)
	{
		if ($id == null)
			return redirect()->to('/supplies/list_supplies');
		if ($this->request->getPost('save') != null) {
			$add = [
				'supplies_purchase_id'  => $this->request->getPost('supplies_purchase_id'),
				'supplies_responsible'	=> $this->request->getPost('supplies_responsible'),
				'supplies_department'	=> $this->request->getPost('supplies_department'),
				'supplies_supplies'		=> $this->request->getPost('supplies_supplies'),
				'supplies_date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('supplies_date')))),
				'supplies_note'			=> $this->request->getPost('supplies_note'),
			];
			$this->supplie_model->editProduct($id, $add);
			// $this->supplie_model->addSupplies($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_supplies');
		} else {
			// $data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['purchase'] = $this->supplie_model->getPurchase();
			$data['data'] = $this->supplie_model->getProductByID($id);
			$data['data'][0]['supplies_date'] = Date('d/m/Y', strtotime($data['data'][0]['supplies_date']));
			$data['title'] = 'ออกเลขพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_supplies'), 'title' => 'ออกเลขพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/supplies');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_supplies($id)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'supplie_name'  => $this->request->getPost('supplie_name'),
				'responsible'   => $this->request->getPost('responsible'),
				'department'	=> $this->request->getPost('department'),
				'supplies'		=> $this->request->getPost('supplies'),
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'note'			=> $this->request->getPost('note'),
			];
			$this->supplie_model->editSupplies($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_supplies');
		} else {
			$data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['data'] = $this->supplie_model->getSuppliesByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] = 'แก้ไขการออกเลขพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_supplies'), 'title' => 'ออกเลขพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_supplies');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_supplies($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteSuppliesByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_supplies');
		}
	}
	// -----------------------------------------------------------------
	public function view_supplies($id = null)
	{
		$data['data'] = $this->supplie_model->getSuppliesByID($id);
		$data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['vat']);
		$data['title'] = 'รายละเอียดออกเลขพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_supplies'), 'title' => 'ออกเลขพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_supplies');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function actions_supplies()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'supplies_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "โครงการจัดซื้อจัดจ้าง", "ผู้รับผิดชอบ", "แผนก", "งบประมาณ(บาท)", "ภาษี(บาท)", "จำนวนทั้งสิ้น(บาท)", "วันที่");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getSuppliesByID($id);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'supplie_name'	=> $x['supplie_name'],
							'responsible'  	=> $x['responsible'],
							'department'    => $x['department'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat,
							'total'        	=> $total,
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		} else

			return redirect()->to('/supplies/list_supplies');
	}
	// -----------------------------------------------------------------
	public function list_check_stock()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'check_stock_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัสโกดังสินค้า", "วันที่", "เลขอ้างอิง", "ชนิด");
				fputcsv($file, $header);
				$no = 1;
				$ar = ['1' => 'Full', '2' => 'บางส่วน'];

				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getCheckStockByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'id'            => $x['id'],
							'supplie_name'	=> $x['warehouse_id'],
							'responsible'  	=> $x['date'],
							'department'    => $x['reference'],
							'price'        	=> $ar[$x['type']],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->supplie_model->getCheckStock($from, $to);
		$data['title'] = 'นับสต๊อก';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_check_stock');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function check_stock()
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'warehouse_id'  => $this->request->getPost('warehouse_id') ? $this->request->getPost('warehouse_id') : 1,
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'   	=> $this->request->getPost('reference'),
				'type'			=> $this->request->getPost('type'),
			];
			$this->supplie_model->addCheckStock($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_check_stock');
		} else {
			$data['warehouse'] = $this->supplie_model->getWarehouse();
			$data['title'] = 'เพิ่มนับสต๊อก';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_check_stock'), 'title' => 'นับสต๊อก'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/check_stock');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_check_stock($id = null)
	{
		if ($this->request->getPost('save') != null) {
			$add = [
				'warehouse_id'  => $this->request->getPost('warehouse_id') ? $this->request->getPost('warehouse_id') : 1,
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'   	=> $this->request->getPost('reference'),
				'type'			=> $this->request->getPost('type'),
			];
			$this->supplie_model->editCheckStock($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_check_stock');
		} else {
			$data['warehouse'] = $this->supplie_model->getWarehouse();
			$data['data'] = $this->supplie_model->getCheckStockByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] = 'แก้ไขนับสต๊อก';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_check_stock'), 'title' => 'นับสต๊อก'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_check_stock');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_check_stock($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteCheckStockByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_check_stock');
		}
	}
	// -----------------------------------------------------------------
	public function view_check_stock($id = null)
	{
		$data['data'] = $this->supplie_model->getCheckStockByID($id);
		$data['title'] = 'รายละเอียดนับสต๊อก';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_check_stock'), 'title' => 'นับสต๊อก'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_check_stock');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_check_stock_id($id = null, $no = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getCheckStockByID($id);
			$data['title'] = 'รายละเอียดนับสต๊อก';
			$data['no'] = $no;
			echo view('sp/view_check_stock_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function actions_check_stock()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'check_stock_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "รหัสโกดังสินค้า", "วันที่", "เลขอ้างอิง", "ชนิด");
				fputcsv($file, $header);
				$no = 1;
				$ar = ['1' => 'Full', '2' => 'บางส่วน'];

				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getCheckStockByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'supplie_name'	=> $x['warehouse_id'],
							'responsible'  	=> $x['date'],
							'department'    => $x['reference'],
							'price'        	=> $ar[$x['type']],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		} else

			return redirect()->to('/supplies/list_check_stock');
	}
	// -----------------------------------------------------------------

	public function view_receive_supplies_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getReceiveSuppliesByID($id);
			$data['title'] = 'รายละเอียดรายการรับพัสดุเข้าคลังสินค้า';
			echo view('sp/view_receive_supplies_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------

	public function receive_supplies()
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'   	=> $this->request->getPost('reference'),
				'importer'		=> $this->request->getPost('importer'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'   	=> $this->request->getPost('department'),
				'warehouse_id'	=> $this->request->getPost('warehouse_id'),
				'status'		=> $this->request->getPost('status'),
				'note'			=> $this->request->getPost('note'),
			];
			$path = ROOTPATH . 'public/files/receive_supplies_files';

			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			$this->supplie_model->addReceiveSupplies($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_receive_supplies');
		} else {
			$data['warehouse'] = $this->supplie_model->getWarehouse();
			$data['title'] = 'รับพัสดุเข้าคลังสินค้า';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/receive_supplies');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------

	public function edit_receive_supplies($id = null)
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'   	=> $this->request->getPost('reference'),
				'importer'		=> $this->request->getPost('importer'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'   	=> $this->request->getPost('department'),
				'warehouse_id'	=> $this->request->getPost('warehouse_id'),
				'status'		=> $this->request->getPost('status'),
				'note'			=> $this->request->getPost('note'),
			];
			$path = ROOTPATH . 'public/files/receive_supplies_files';

			if ($this->request->getFile('document')->getpath() != "") {
				$document = $this->request->getFile('document');
				$newName = $document->getRandomName();
				$document->move($path, $newName);
				$add['document'] = $newName;
			}
			$this->supplie_model->editReceiveSupplies($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_receive_supplies');
		} else {
			$data['data'] = $this->supplie_model->getReceiveSuppliesByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['warehouse'] = $this->supplie_model->getWarehouse();
			$data['title'] = 'รับพัสดุเข้าคลังสินค้า';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_receive_supplies');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_receive_supplies($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteReceiveSuppliesByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_receive_supplies');
		}
	}
	// -----------------------------------------------------------------
	public function view_receive_supplies($id = null)
	{
		$data['data'] = $this->supplie_model->getReceiveSuppliesByID($id);
		$data['title'] = 'รายละเอียดรายการรับพัสดุเข้าคลังสินค้า';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_receive_supplies'), 'title' => 'รายการรับพัสดุเข้าคลังสินค้า'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_receive_supplies');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_receive_supplies()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'receive_supplies_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "วันที่รับเข้า", "เลขที่ใบPO", "ผู้นำเข้า",  "รหัสพนักงาน", "แผนก/ฝ่าย", "นำเข้าคลัง", "สถานะ", "อื่นๆ");
				fputcsv($file, $header);
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getReceiveSuppliesByID($id);

					$ar = [
						'0' => '',
						'1' => 'รับเรียบร้อย',
						'2' => 'ระหว่างดำเนินการ',
						'3' => 'ยังไม่ได้รับ',
						'4' => 'ยกเลิก',
					];
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'id'            => $x['id'],
							'date'			=> $x['date'],
							'reference'  	=> $x['reference'],
							'importer'   	=> $x['importer'],
							'employees_id'	=> $x['employees_id'],
							'department'    => $x['department'],
							'name'        	=> $x['name'],
							'status'   		=>  $ar[$x['status']],
							'note'    		=> strip_tags($x['note']),
							// 'note'    		=> $x['note'],

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
		$data['data'] = $this->supplie_model->getReceiveSupplies($from, $to);
		$data['title'] = 'รายการรับพัสดุเข้าคลังสินค้า';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_receive_supplies');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_requisition()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'requisition_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ",  "วันที่", "เลขที่เอกสาร",  "เลขที่พัสดุ", "ผู้เบิก", "แผนก/ฝ่าย", "สภานะ", "Return note", "Staff note");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getRequisitionByID($id);

					$ar = [
						'0' => '',
						'1' => 'จ่ายแล้ว',
						'2' => 'ระหว่างดำเนินการ',
						'3' => 'ยกเลิก',
						// '4' => 'เรียบร้อย',
					];
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'id'            => $x['id'],
							'date'			=> $x['date'],
							'reference'  	=> $x['reference'],
							'supplies_id'   => $x['supplies_id'],
							'employees_id'	=> $x['employees_id'],
							'department'    => $x['department'],
							'status'        => $ar[$x['status']],
							'return_note'   => strip_tags($x['return_note']),
							'staff_note'    => strip_tags($x['staff_note']),
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


		$data['data'] = $this->supplie_model->getRequisition($from, $to);
		// $data['data'] = $this->supplie_model->getRequisition();
		$data['title'] = 'ประวัติการเบิกจ่ายพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_requisition');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function requisition()
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'  	=> $this->request->getPost('reference'),
				'supplies_id'   => $this->request->getPost('supplies_id'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'	=> $this->request->getPost('department'),
				'status'		=> $this->request->getPost('status') ? $this->request->getPost('status') : 1,
				'return_note'	=> $this->request->getPost('return_note'),
				'staff_note'	=> $this->request->getPost('staff_note'),
				'name'			=> $this->request->getPost('name'),
				'price'   		=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'tax_rate'		=> $this->request->getPost('tax_rate'),
			];
			$this->supplie_model->addRequisition($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_requisition');
		} else {
			$data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['title'] = 'เบิกจ่ายพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_requisition'), 'title' => 'ประวัติการเบิกจ่ายพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/requisition');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_requisition($id = null)
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'reference'  	=> $this->request->getPost('reference'),
				'supplies_id'   => $this->request->getPost('supplies_id'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'	=> $this->request->getPost('department'),
				'status'		=> $this->request->getPost('status') ? $this->request->getPost('status') : 1,
				'return_note'	=> $this->request->getPost('return_note'),
				'staff_note'	=> $this->request->getPost('staff_note'),
				'name'			=> $this->request->getPost('name'),
				'price'   		=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'tax_rate'		=> $this->request->getPost('tax_rate'),
			];
			$this->supplie_model->editRequisition($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_requisition');
		} else {
			$data['data'] = $this->supplie_model->getRequisitionByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['taxrate'] = $this->supplie_model->getTaxRate();
			$data['title'] = 'แก้ไขเบิกพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_requisition'), 'title' => 'ประวัติการเบิกจ่ายพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_requisition');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_requisition($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteRequisitionByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_requisition');
		}
	}
	// -----------------------------------------------------------------
	public function view_requisition($id = null)
	{
		$data['data'] = $this->supplie_model->getRequisitionByID($id);
		$data['title'] = 'รายละเอียดเบิกพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_requisition'), 'title' => 'ประวัติการเบิกจ่ายพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_requisition');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_requisition_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getRequisitionByID($id);
			$data['title'] = 'รายละเอียดเบิกพัสดุ';
			echo view('sp/view_requisition_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function actions_requisition()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'requisition_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "วันที่", "เลขที่เอกสาร",  "เลขที่พัสดุ", "ผู้เบิก", "แผนก", "สภานะ", "Return note", "Staff note");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getRequisitionByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'date'			=> $x['date'],
							'reference'  	=> $x['reference'],
							'supplies_id'   => $x['supplies_id'],
							'employees_id'	=> $x['employees_id'],
							'department'    => $x['department'],
							'status'        => $x['status'],
							'return_note'   => $x['return_note'],
							'staff_note'    => $x['staff_note'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		} else

			return redirect()->to('/supplies/list_requisition');
	}
	// -----------------------------------------------------------------
	public function list_borrow()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'borrow_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "วันที่ยืม", "วันที่คืน", "เลขที่เอกสาร", "ผู้เบิก", "แผนก/ฝ่าย", "สถานะ", "Return note", "Staff note");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getBorrowByID($id);

					$st = [
						'1' => 'ยืมพัสดุ',
						'2' => 'ระหว่างดำเนินการ',
						'3' => 'คืนแล้ว',
						'4' => 'ยกเลิก',
					];
					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'id'            => $x['id'],
							'date'			=> $x['date'],
							'date_return'	=> $x['date_return'],
							'reference'  	=> $x['reference'],
							'employees_id'	=> $x['employees_id'],
							'department'    => $x['department'],
							'status'        => $st[$x['status']],
							'return_note'   => strip_tags($x['return_note']),
							'staff_note'    => strip_tags($x['staff_note']),
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


		$data['data'] = $this->supplie_model->getBorrow($from, $to);
		// $data['data'] = $this->supplie_model->getBorrow();
		$data['title'] = 'ยืมคืนพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_borrow');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function borrow()
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'date_return'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date_return')))),
				'reference'  	=> $this->request->getPost('reference'),
				'supplies_id'   => $this->request->getPost('supplies_id'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'	=> $this->request->getPost('department'),
				'status'		=> $this->request->getPost('status'),
				'return_note'	=> $this->request->getPost('return_note'),
				'staff_note'	=> $this->request->getPost('staff_note'),
			];
			$add['status'] = ($add['status'] == "") ? 0 : $add['status'];
			$this->supplie_model->addBorrow($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_borrow');
		} else {
			$data['title'] = 'เพิ่มยืมคืนพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_borrow'), 'title' => 'ยืมคืนพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/borrow');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function edit_borrow($id = null)
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'date'   		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'date_return'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date_return')))),
				'reference'  	=> $this->request->getPost('reference'),
				'supplies_id'   => $this->request->getPost('supplies_id'),
				'employees_id'	=> $this->request->getPost('employees_id'),
				'department'	=> $this->request->getPost('department'),
				'status'		=> $this->request->getPost('status'),
				'return_note'	=> $this->request->getPost('return_note'),
				'staff_note'	=> $this->request->getPost('staff_note'),
			];
			$this->supplie_model->editBorrow($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_borrow');
		} else {
			$data['data'] = $this->supplie_model->getBorrowByID($id);
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['data'][0]['date_return'] = Date('d/m/Y', strtotime($data['data'][0]['date_return']));
			$data['title'] = 'แก้ไขยืมคืนพัสดุ';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_borrow'), 'title' => 'ยืมคืนพัสดุ'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_borrow');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function delete_borrow($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteBorrowByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/list_borrow');
		}
	}
	// -----------------------------------------------------------------
	public function view_borrow($id = null)
	{
		$data['data'] = $this->supplie_model->getBorrowByID($id);
		$data['title'] = 'รายละเอียดยืมคืนพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_borrow'), 'title' => 'ยืมคืนพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_borrow');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_borrow_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getBorrowByID($id);
			$data['title'] = 'รายละเอียดยืมคืนพัสดุ';
			echo view('sp/view_borrow_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function actions_borrow()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'borrow_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "วันที่ยืม", "เลขที่เอกสาร", "ผู้เบิก", "แผนก", "สถานะ", "Return note", "Staff note");
				fputcsv($file, $header);
				$no = 1;
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getBorrowByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'date'			=> $x['date'],
							'reference'  	=> $x['reference'],
							'supplies_id'   => $x['supplies_id'],
							'employees_id'	=> $x['employees_id'],
							'department'    => $x['department'],
							'status'        => $x['status'],
							'return_note'   => $x['return_note'],
							'staff_note'    => $x['staff_note'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		} else

			return redirect()->to('/supplies/list_borrow');
	}
	// -----------------------------------------------------------------
	public function cost_appraisal()
	{
		// $data['data'] = $this->supplie_model->getRequisition();
		$data['title'] = 'ตรวจสอบราคากลางพัสดุ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/cost_appraisal');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_depreciation()
	{
		// $data['data'] = $this->supplie_model->getDepreciation();
		$data['title'] = 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_depreciation');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function cal_amount_first_year($date)
	{
		$Ad_date = date("Y-m-d", strtotime("-543 years", strtotime($date)));
		$AdDateYear = date('Y', strtotime($Ad_date));
		$date1 = date_create($Ad_date);
		$date2 = date_create($AdDateYear . "-12-31");
		$diff = date_diff($date1, $date2);
		$amount_first_year = $diff->format("%a");
		return $amount_first_year;
	}

	public function depreciation()
	{
		if (!empty($_POST['val'])) {
			if ($this->request->getPost('excell1_x')) {
				// file name 
				$filename = 'asset_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ",  "คำนวนค่าเสื่อมแบบ", "หมวดสินทรัพย์", "วันที่เริ่มคิดค่าเสื่อม", "ราคาที่ใช้คิดค่าเสื่อม", "ราคาซาก", "อัตราค่าเสื่อม");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'เส้นตรง',
					'2' => '',
					'3' => '',

				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getAsset($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						if ($x['rate_type'] == 1) {
							$rate_type = 'ปี';
						} else if ($x['rate_type'] == 2) {
							$rate_type = '%';
						}
						$excel = [
							'id'        	=> $x['id'],
							'type'			=> $ar[$x['type']],
							'category_name'	=> $x['category_name'],
							'date'  		=> date('d/m/Y', strtotime($x['date'])),
							'price'    		=> $x['price'],
							'carcass'		=> $x['carcass'],
							'rate_value'	=> $x['rate_value'] . $rate_type,
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
			if ($this->request->getPost('excell2_x')) {
				// file name 
				$filename = 'depreciation_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ",  "คิดค่าเสื่อม", "คิดค่าเสื่อมสะสมยกมา", "ค่าเสื่อมคำนวณ", "คำนวณเองถึงวันที่", "ค่าเสื่อมเบื้องต้น", "วันที่ขาย", "ราคาขาย", "กำไร/ขาดทุน");
				fputcsv($file, $header);
				$ty = [
					'1' => 'รายปี'
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getDepreciationByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'id'        		=> $x['id'],
							'type'				=> $ty[$x['type']],
							'charged'			=> $x['charged'],
							'calculated'    	=> $x['calculated'],
							'calculated_date'	=> date('d/m/Y', strtotime($x['calculated_date'])),
							'initial'			=> $x['initial'],
							'sale_date'  		=> date('d/m/Y', strtotime($x['sale_date'])),
							'sale_price'		=> $x['sale_price'],
							'profit_loss'		=> $x['profit_loss'],
						];
						fputcsv($file, $excel);
					}
					fclose($file);
				}
				exit;
			}
		}
		if ($this->request->getPost('asset') != null) {
			$amount_first_year = $this->cal_amount_first_year(Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))));
			$add = [
				'type'   		=> $this->request->getPost('type'),
				'category'		=> $this->request->getPost('category'),
				'date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'price'   		=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'carcass'   	=> $this->request->getPost('carcass') ? (float)str_replace(",", "", $this->request->getPost('carcass')) : 0,
				'rate_type'		=> $this->request->getPost('rate_type'),
				'rate_value'	=> intval($this->request->getPost('rate_type')) == 1 ? (intval($this->request->getPost('rate_value')) != 0 ? $this->request->getPost('rate_value') : 1) : $this->request->getPost('rate_value'),
				'amount_first_year'	=> $amount_first_year,
			];

			// $add['year_end'] = date("Y-12-t", strtotime($add['date']));
			// $year_start = date("Y-1-1", strtotime($add['date']));
			// $daytotal = date_diff(date_create($year_start), date_create($add['year_end']));
			// $dayofyear = intval($daytotal->format("%a"));
			// $dif = date_diff(date_create($add['date']), date_create($add['year_end']));
			// $day_dif = intval($dif->format("%a"));
			// $add['cal'] = ($add['price'] - $add['carcass']) / $add['year'] * $day_dif / $dayofyear;
			// // var_dump($add);
			$this->supplie_model->addAsset($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		} else if ($this->request->getPost('depreciation') != null) {

			$add = [
				'type'				=> $this->request->getPost('type'),
				'charged'   		=> $this->request->getPost('charged') ? (float)str_replace(",", "", $this->request->getPost('charged')) : 0,
				'calculated'   		=> $this->request->getPost('calculated') ? (float)str_replace(",", "", $this->request->getPost('calculated')) : 0,
				'calculated_date'	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('calculated_date')))),
				'initial'   		=> $this->request->getPost('initial') ? (float)str_replace(",", "", $this->request->getPost('initial')) : 0,
				'sale_date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('sale_date')))),
				'sale_price'   		=> $this->request->getPost('sale_price') ? (float)str_replace(",", "", $this->request->getPost('sale_price')) : 0,
				'profit_loss'   	=> $this->request->getPost('profit_loss') ? (float)str_replace(",", "", $this->request->getPost('profit_loss')) : 0,
				'category'		=> $this->request->getPost('category'),
			];

			// $add['year_end'] = date("Y-12-t", strtotime($add['date']));
			// $year_start = date("Y-1-1", strtotime($add['date']));
			// $daytotal = date_diff(date_create($year_start), date_create($add['year_end']));
			// $dayofyear = intval($daytotal->format("%a"));
			// $dif = date_diff(date_create($add['date']), date_create($add['year_end']));
			// $day_dif = intval($dif->format("%a"));
			// $add['cal'] = ($add['price'] - $add['carcass']) / $add['year'] * $day_dif / $dayofyear;
			// // var_dump($add);
			$this->supplie_model->addDepreciation($add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		} else {
			$category_search1 = $this->request->getPost('category_search1') ? $this->request->getPost('category_search1') : null;
			$data['asset'] = $this->supplie_model->getAsset(null, $category_search1);
			$data['depreciation'] = $this->supplie_model->getDepreciation();
			$data['category'] = $this->supplie_model->getCategory();
			$data['title'] = 'คิดค่าเสื่อม';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_depreciation'), 'title' => 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/depreciation');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------

	public function edit_depreciation($id = null)
	{
		if ($this->request->getPost('save') != null) {

			$add = [
				'type'				=> $this->request->getPost('type'),
				'charged'   		=> $this->request->getPost('charged') ? (float)str_replace(",", "", $this->request->getPost('charged')) : 0,
				'calculated'   		=> $this->request->getPost('calculated') ? (float)str_replace(",", "", $this->request->getPost('calculated')) : 0,
				'calculated_date'	=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('calculated_date')))),
				'initial'   		=> $this->request->getPost('initial') ? (float)str_replace(",", "", $this->request->getPost('initial')) : 0,
				'sale_date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('sale_date')))),
				'sale_price'   		=> $this->request->getPost('sale_price') ? (float)str_replace(",", "", $this->request->getPost('sale_price')) : 0,
				'profit_loss'   	=> $this->request->getPost('profit_loss') ? (float)str_replace(",", "", $this->request->getPost('profit_loss')) : 0,
				'category'		=> $this->request->getPost('category'),
			];

			// $add['year_end'] = date("Y-12-t", strtotime($add['date']));
			// $year_start = date("Y-1-1", strtotime($add['date']));
			// $daytotal = date_diff(date_create($year_start), date_create($add['year_end']));
			// $dayofyear = intval($daytotal->format("%a"));
			// $dif = date_diff(date_create($add['date']), date_create($add['year_end']));
			// $day_dif = intval($dif->format("%a"));
			// $add['cal'] = ($add['price'] - $add['carcass']) / $add['year'] * $day_dif / $dayofyear;
			// // var_dump($add);
			$this->supplie_model->editDepreciation($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		} else {
			$data['category'] = $this->supplie_model->getCategory();
			$data['data'] = $this->supplie_model->getDepreciationByID($id);
			$data['data'][0]['calculated_date'] = Date('d/m/Y', strtotime($data['data'][0]['calculated_date']));
			$data['data'][0]['sale_date'] = Date('d/m/Y', strtotime($data['data'][0]['sale_date']));
			$data['title'] = 'แก้ไขคิดค่าเสื่อม';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_depreciation'), 'title' => 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_depreciation');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function view_depreciation($id = null)
	{
		$data['data'] = $this->supplie_model->getDepreciationByID($id);
		$data['title'] = 'รายละเอียดคิดค่าเสื่อม';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_depreciation'), 'title' => 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_depreciation');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_depreciation_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getDepreciationByID($id);
			$data['title'] = 'รายละเอียดคิดค่าเสื่อม';
			echo view('sp/view_depreciation_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function actions_depreciation()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'depreciation_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "คำนวนค่าเสื่อมแบบ", "วันที่เริ่มคิดค่าเสื่อม", "อัตราค่าเสื่อม", "ปี", "ราคาที่ใช้คิดค่าเสื่อม", "ราคาซาก", "ค่าเสื่อม");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'เส้นตรง',
					'2' => '',
					'3' => '',

				];
				$ra = [
					'0' => '',
					'1' => 'อายุการใช้งาน',
					'2' => '',
					'3' => '',

				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getDepreciationByID($id);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$excel = [
							'no'        => $no,
							'id'        => $x['id'],
							'type'		=> $ar[$x['type']],
							'date'  	=> date('d/m/Y', strtotime($x['date'])),
							'rate'   	=> $ra[$x['rate']],
							'year'		=> $x['year'],
							'price'    	=> $x['price'],
							'carcass'	=> $x['carcass'],
							'cal'   	=> $x['cal'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		} else

			return redirect()->to('/supplies/list_depreciation');
	}
	// -----------------------------------------------------------------
	public function delete_depreciation($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteDepreciationByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		}
	}
	// -----------------------------------------------------------------

	public function edit_asset($id = null)
	{
		if ($this->request->getPost('save') != null) {
			$amount_first_year = $this->cal_amount_first_year(Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))));
			$add = [
				'type'   		=> $this->request->getPost('type'),
				'category'		=> $this->request->getPost('category'),
				'date'  		=> Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
				'price'   		=> $this->request->getPost('price') ? (float)str_replace(",", "", $this->request->getPost('price')) : 0,
				'carcass'   	=> $this->request->getPost('carcass') ? (float)str_replace(",", "", $this->request->getPost('carcass')) : 0,
				'rate_type'		=> $this->request->getPost('rate_type'),
				'rate_value'	=> intval($this->request->getPost('rate_type')) == 1 ? (intval($this->request->getPost('rate_value')) != 0 ? $this->request->getPost('rate_value') : 1) : $this->request->getPost('rate_value'),
				'amount_first_year'	=> $amount_first_year,
			];

			// $add['year_end'] = date("Y-12-t", strtotime($add['date']));
			// $year_start = date("Y-1-1", strtotime($add['date']));
			// $daytotal = date_diff(date_create($year_start), date_create($add['year_end']));
			// $dayofyear = intval($daytotal->format("%a"));
			// $dif = date_diff(date_create($add['date']), date_create($add['year_end']));
			// $day_dif = intval($dif->format("%a"));
			// $add['cal'] = ($add['price'] - $add['carcass']) / $add['year'] * $day_dif / $dayofyear;
			// // var_dump($add);
			$this->supplie_model->editAsset($id, $add);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		} else {
			$data['data'] = $this->supplie_model->getAsset($id);
			$data['category'] = $this->supplie_model->getCategory();
			$data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
			$data['title'] = 'แก้ไขคิดค่าเสื่อม';
			$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_depreciation'), 'title' => 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา'], ['link' => '#', 'title' => $data['title']]];
			echo view('header', $data);
			echo view('sp/edit_asset');
			echo view('footer');
		}
	}
	// -----------------------------------------------------------------
	public function view_asset($id = null)
	{
		$data['data'] = $this->supplie_model->getAsset($id);
		$data['title'] = 'รายละเอียดบันทึกสินทรัพย์';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => base_url('supplies/list_depreciation'), 'title' => 'รายงานคำนวนค่าเสื่อมราคาตามช่วงเวลา'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/view_asset');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function view_asset_id($id = null)
	{
		if ($id != null) {
			$data['data'] = $this->supplie_model->getAsset($id);
			$data['title'] = 'รายละเอียดบันทึกสินทรัพย์';
			echo view('sp/view_asset_id', $data);
		} else {
			echo 'no data';
		}
	}
	// -----------------------------------------------------------------
	public function delete_asset($id = null)
	{
		if ($id == null)
			return false;
		else {
			$this->supplie_model->deleteAssetByID($id);
			$this->supplie_model->addLog(1);
			return redirect()->to('/supplies/depreciation');
		}
	}
	// -----------------------------------------------------------------
	public function getProduct()
	{
		$data = $this->supplie_model->getProductForSelect();
		if (!empty($data))
			return json_encode(array($data), JSON_UNESCAPED_UNICODE);
		else
			return json_encode(array(["massage" => "No data found"]));
	}
	// -----------------------------------------------------------------
	public function list_registration_responsible()
	{
		// if (!empty($_POST['val'])) {
		// 	if ($this->request->getPost('excell_x')) {
		// 		// var_dump($_POST['val']);
		// 		// file name 
		// 		$filename = 'registration_responsible_' . date('Y_m_d_H_i_s') . '.csv';
		// 		header("Content-Description: File Transfer");
		// 		header("Content-Disposition: attachment; filename=$filename");
		// 		header("Content-Type: application/csv; ");
		// 		$file = fopen('php://output', 'w');
		// 		fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
		// 		$header = array("ลำดับ", "รหัส", "คำนวนค่าเสื่อมแบบ", "วันที่เริ่มคิดค่าเสื่อม", "อัตราค่าเสื่อม", "ปี", "ราคาที่ใช้คิดค่าเสื่อม", "ราคาซาก", "ค่าเสื่อม");
		// 		fputcsv($file, $header);
		// 		$no = 1;
		// 		$ar = [
		// 			'0' => '',
		// 			'1' => 'เส้นตรง',
		// 			'2' => '',
		// 			'3' => '',

		// 		];
		// 		$ra = [
		// 			'0' => '',
		// 			'1' => 'อายุการใช้งาน',
		// 			'2' => '',
		// 			'3' => '',

		// 		];
		// 		foreach ($_POST['val'] as $id) {
		// 			// get data 
		// 			$data = $this->supplie_model->getDepreciationByID($id);

		// 			// file creation 
		// 			$file = fopen('php://output', 'w');
		// 			fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
		// 			foreach ($data as $x) {
		// 				$excel = [
		// 					'no'        => $no,
		// 					'id'        => $x['id'],
		// 					'type'		=> $ar[$x['type']],
		// 					'date'  	=> date('d/m/Y', strtotime($x['date'])),
		// 					'rate'   	=> $ra[$x['rate']],
		// 					'year'		=> $x['year'],
		// 					'price'    	=> $x['price'],
		// 					'carcass'	=> $x['carcass'],
		// 					'cal'   	=> $x['cal'],
		// 				];
		// 				fputcsv($file, $excel);
		// 				$no++;
		// 			}
		// 			fclose($file);
		// 		}
		// 		exit;
		// 	}
		// }
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "ราคา", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'active',
					'2' => 'inactive',
					'3' => 'other',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->supplie_model->getProduct(null, $from, $to);
		$data['title'] = 'รายงานทะเบียนสินทรัพย์ แยกชื่อผู้รับผิดชอบ';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_registration_responsible');
		echo view('footer');
	}
	// -----------------------------------------------------------------

	public function list_registration_bring_forward()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "ราคา", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'active',
					'2' => 'inactive',
					'3' => 'other',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->supplie_model->getFormpurchase(null, $from, $to);
		// $data['data'] = $this->supplie_model->getProduct(null, $from, $to);
		$data['title'] = 'รายงานทะเบียนสินทรัพย์ที่แสดงยอดยกมาต้นปี';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_registration_bring_forward');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_registration_depreciation()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "ราคา", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'active',
					'2' => 'inactive',
					'3' => 'other',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$data['data'] = $this->supplie_model->getProduct(null, $from, $to);
		$data['title'] = 'รายงานทะเบียนสินทรัพย์และค่าเสื่อมราคา';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_registration_depreciation');
		echo view('footer');
	}
	public function func_lorem()
	{
		$cur_date =  date("Y-m-d", strtotime("+543 years", strtotime(date("Y-m-d"))));
		$get_date =  date("Y-m-d", strtotime("+543 years", strtotime('2019-03-15')));
		echo $cur_date;
		echo "<br>";
		echo $get_date;
		echo "<br>";
		$cur_year =  date('Y', strtotime($cur_date));
		$get_year =  date('Y', strtotime($get_date));
		echo $cur_year;
		echo "<br>";
		echo $get_year;
		echo "<br>";
	}
	// -----------------------------------------------------------------
	public function list_registration_transfer_repair()
	{
		if (!empty($_POST['val'])) {

			// if ($this->request->getPost('excell_x')) {
			// 	// var_dump($_POST['val']);
			// 	// file name 
			// 	$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
			// 	header("Content-Description: File Transfer");
			// 	header("Content-Disposition: attachment; filename=$filename");
			// 	header("Content-Type: application/csv; ");
			// 	$file = fopen('php://output', 'w');
			// 	fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
			// 	$header = array("ลำดับ", "รหัส", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "ราคา", "รวมภาษี", "หมายเหตุ", "วันที่");
			// 	fputcsv($file, $header);
			// 	$no = 1;
			// 	$ar = [
			// 		'0' => '',
			// 		'1' => 'active',
			// 		'2' => 'inactive',
			// 		'3' => 'other',
			// 	];
			// 	foreach ($_POST['val'] as $id) {
			// 		// get data 
			// 		$data = $this->supplie_model->getProductByID($id);
			// 		$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
			// 		$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
			// 		$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
			// 		$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
			// 		$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

			// 		// file creation 
			// 		$file = fopen('php://output', 'w');
			// 		fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
			// 		foreach ($data as $x) {
			// 			$vat = 0;
			// 			if ($tax[0]['type'] == 1) {
			// 				$vat = $tax[0]['tax_rate'];
			// 			} elseif ($tax[0]['type'] == 2) {
			// 				$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
			// 			}
			// 			$vat = 0;
			// 			if ($tax[0]['type'] == 1) {
			// 				$vat = $tax[0]['tax_rate'];
			// 			} elseif ($tax[0]['type'] == 2) {
			// 				$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
			// 			}
			// 			$total = $x['price'] - $vat;
			// 			$excel = [
			// 				'no'            => $no,
			// 				'id'            => $x['id'],
			// 				'name'			=> $x['name'],
			// 				'product_code'  => $x['product_code'],
			// 				'type'    		=> $type[0]['name'],
			// 				'status'        => $ar[$x['status']],
			// 				'category'      => $category[0]['category_name'],
			// 				'category_sub'	=> $category_sub[0]['category_name'],
			// 				'unit'        	=> $unit[0]['unit_name'],
			// 				'responsible'   => $x['responsible'],
			// 				'price'        	=> $x['price'],
			// 				'vat'        	=> $vat + $x['price'],
			// 				'note'        	=> $x['note'],
			// 				'date'        	=> $x['date'],
			// 			];
			// 			fputcsv($file, $excel);
			// 			$no++;
			// 		}
			// 		fclose($file);
			// 	}
			// 	exit;
			// }
		}

		$from 	= $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
		$to 	= $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
		$from 	= $this->request->getPost('datepicker_from2') ? $this->request->getPost('datepicker_from2') : null;
		$to 	= $this->request->getPost('datepicker_to2') ? $this->request->getPost('datepicker_to2') : null;
		$from 	= $this->request->getPost('datepicker_from3') ? $this->request->getPost('datepicker_from3') : null;
		$to 	= $this->request->getPost('datepicker_to3') ? $this->request->getPost('datepicker_to3') : null;
		$data['product'] = $this->supplie_model->getProduct(null, $from, $to);
		$data['repair'] = $this->supplie_model->getRepairNew($from, $to);
		$data['title'] = 'รายงานทะเบียนสินทรัพย์/โอนย้ายสินทรัพย์/ประวัติการซ่อมแซม';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_registration_transfer_repair');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function report_registration_pdf($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';



		if ($id != null) {
			$data['data'] = $this->supplie_model->getProductByID($id);
			$data['title'] = 'รายงานจำหน่ายสินทรัพย์';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('sp/report_registration_pdf', $data);
			$filename = 'report_registration_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/supplies/list_registration_transfer_repair');
	}
	// -----------------------------------------------------------------
	public function report_list_registration_depreciation($id = null,$date = null,$product_code = null,$product_code2 = null
	,$name = null,$asset_price = null,$price2_before = null
	,$ResidualCurYearFixPer = null,$asset_rate_value = null
	,$ResidualCurYear = null,$price1_before = null,$price1_after = null
	,$price2_after = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';

		if ($id != null) {

			$data = [
				"id" => $id,
				"date" => $date,
				"product_code" => $product_code,
				"product_code2" => $product_code2,
				"name" => $name,
				"asset_price" => $asset_price,
				"price2_before" => $price2_before,
				"ResidualCurYearFixPer" => $ResidualCurYearFixPer,
				"asset_rate_value" => $asset_rate_value,
				"ResidualCurYear" => $ResidualCurYear,
				"price1_before" => $price1_before,
				"price1_after" => $price1_after,
				"price2_after" => $price2_after
			];
			// $data['data'] = $this->supplie_model->getProductByID($id);
			$data['title'] = 'รายงานทะเบียนสินทรัพย์และค่าเสื่อมราคา';

			$mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			$html = view('sp/report_list_registration_depreciation', $data);
			$filename = 'report_list_registration_depreciation_' . date("Y_m_d_H_i_s") . '.pdf';
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/supplies/list_registration_depreciation');
	}
	// -----------------------------------------------------------------

	public function barcode()
	{
		if (!empty($_POST['val'])) {

			if ($this->request->getPost('excell_x')) {
				// var_dump($_POST['val']);
				// file name 
				$filename = 'product_' . date('Y_m_d_H_i_s') . '.csv';
				header("Content-Description: File Transfer");
				header("Content-Disposition: attachment; filename=$filename");
				header("Content-Type: application/csv; ");
				$file = fopen('php://output', 'w');
				fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
				$header = array("ลำดับ", "รหัส", "ชื่อครุภัณฑ์/วัสดุภัณฑ์", "รหัสครุภัณฑ์/วัสดุภัณฑ์", "ประเภท", "สถานะ", "หมวดหมู่หลัก", "หมวดหมู่ย่อย", "หน่วยนับ", "ผู้รับผิดชอบ", "ราคา", "รวมภาษี", "หมายเหตุ", "วันที่");
				fputcsv($file, $header);
				$no = 1;
				$ar = [
					'0' => '',
					'1' => 'active',
					'2' => 'inactive',
					'3' => 'other',
				];
				foreach ($_POST['val'] as $id) {
					// get data 
					$data = $this->supplie_model->getProductByID($id);
					$category = $this->supplie_model->getCategoryByID($data[0]['category_main_id']);
					$category_sub = $this->supplie_model->getCategoryByID($data[0]['category_minor_id']);
					$type = $this->supplie_model->getTypeByID($data[0]['type_id']);
					$unit = $this->supplie_model->getUnitByID($data[0]['unit']);
					$tax = $this->supplie_model->getTaxRateByID($data[0]['vat']);

					// file creation 
					$file = fopen('php://output', 'w');
					fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
					foreach ($data as $x) {
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$vat = 0;
						if ($tax[0]['type'] == 1) {
							$vat = $tax[0]['tax_rate'];
						} elseif ($tax[0]['type'] == 2) {
							$vat = ($x['price'] * $tax[0]['tax_rate']) / 100;
						}
						$total = $x['price'] - $vat;
						$excel = [
							'no'            => $no,
							'id'            => $x['id'],
							'name'			=> $x['name'],
							'product_code'  => $x['product_code'],
							'type'    		=> $type[0]['name'],
							'status'        => $ar[$x['status']],
							'category'      => $category[0]['category_name'],
							'category_sub'	=> $category_sub[0]['category_name'],
							'unit'        	=> $unit[0]['unit_name'],
							'responsible'   => $x['responsible'],
							'price'        	=> $x['price'],
							'vat'        	=> $vat + $x['price'],
							'note'        	=> $x['note'],
							'date'        	=> $x['date'],
						];
						fputcsv($file, $excel);
						$no++;
					}
					fclose($file);
				}
				exit;
			}
		}
		// $data['data'] = $this->supplie_model->getProduct();
		$data['data'] = $this->supplie_model->getProduct();
		$data['title'] = 'พิมพ์ Barcode / label';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/barcode');
		echo view('footer');
	}

	// -----------------------------------------------------------------
	public function print_barcodes()
	{
		$data['data'] = $this->supplie_model->getProduct();
		$data['title'] = 'พิมพ์ Barcode / label';
		$data['pages'] = [['link' => base_url('supplies/index'), 'title' => 'ภาพรวมงานพัสดุ'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/print_barcodes');
		echo view('footer');
	}

	// -----------------------------------------------------------------
	public function modal_barcode($id = null)
	{
		if ($id != null) {
			$data['id'] = $id;
			// $data['data'] = $this->supplie_model->getProductByID($id);
			$data['title'] = 'รายละเอียด Barcode';
			echo view('sp/modal_barcode', $data);
		} else {
			echo 'nodata';
		}
	}
	// -----------------------------------------------------------------

	public function print_barcode($id = null)
	{
		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';
		require_once APPPATH . '/ThirdParty/php-barcode-generator/src/BarcodeGenerator.php';
		require_once APPPATH . '/ThirdParty/php-barcode-generator/src/BarcodeGeneratorHTML.php';
		if ($id != null) {
			// $data['num'] = $this->request->getPost('num') ? $this->request->getPost('num') : 0;
			// $data['data'] = $this->supplie_model->getProductByID($id);

			$code = "000001"; //รหัส Barcode ที่ต้องการสร้าง

			$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			$border = 2; //กำหนดความหน้าของเส้น Barcode
			$height = 50; //กำหนดความสูงของ Barcode

			echo $generator->getBarcode($code, $generator::TYPE_CODE_128, $border, $height);
			echo $code;
			echo "<hr>";

			// $data['title'] = 'พิมพ์ Barcode / label';
			// $mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
			// $html = view('sp/print_barcode', $data);
			// $filename = 'barcode_' . date("Y_m_d_H_i_s") . '.pdf';
			// $mpdf->WriteHTML($html);
			// return redirect()->to($mpdf->Output($filename, 'I'));
		} else
			return redirect()->to('/supplies/barcode');
	}
	// -----------------------------------------------------------------

	public function getsupcategory($id = NULL)
	{
		$data['data'] = $this->supplie_model->getCategoryByCategorysub($id);
		$new = $this->response->setJSON($data['data']);
		return $new;
	}
	// -----------------------------------------------------------------
	public function transfer()
	{
		$data['product'] = $this->supplie_model->getProduct();
		$data['title'] = 'บันทึกโอนย้ายสินทรัพย์';
		$data['pages'] = [['link' => base_url('supplies/list_transfer'), 'title' => 'บันทึกโอนย้ายสินทรัพย์'], ['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/transfer');
		echo view('footer');
	}
	// -----------------------------------------------------------------
	public function list_transfer()
	{
		// $data['data'] = $this->supplie_model->getDepreciation();
		$data['title'] = 'บันทึกโอนย้ายสินทรัพย์';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('sp/list_transfer');
		echo view('footer');
	}
	// -----------------------------------------------------------------
}
