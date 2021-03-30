<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
	public function __construct()
	{
		$this->test_model = model('test_model');
		$this->finance_model = model('finance_model');
		$this->account_model = model('account_model');
		$this->supplie_model = model('supplie_model');
		$this->noti_model = model('noti_model');

		$session = session();
		if (!$session->has('login')) {
			return redirect()->to('/login');
		}
	}
	public function index()
	{
		$data = [
			'title' 			=> 'ภาพรวมระบบ',
			'sumpayoffdebt' 	=> $this->finance_model->sumPayoffDebt(),
			'sumcheckpay' 		=> $this->finance_model->sumCheckPay(),
			'sumimportbilling'	=> $this->finance_model->sumImportBilling(),
			// 'sumoverdue' 	=> $this->finance_model->sumOverdue(),
			'sumdebtor' 		=> $this->account_model->countDebtor(),
		];

		$data['pages'] = [['link' => '#', 'title' => 'บริหารจัดการ: แสดงข้อมูลโดยรวมของระบบ']];
		// if ($this->request->getPost('search')) {
		$from 			= $this->request->getPost("datepicker_from") ? $this->request->getPost("datepicker_from") : null;
		$to 			= $this->request->getPost("datepicker_to") ? $this->request->getPost("datepicker_to") : null;
		$txt_search 	= $this->request->getPost("txt_search") ? $this->request->getPost("txt_search") : ($this->request->getPost("txt_search") == '0' ? '0' : null);
		$data['data'] 	= $this->finance_model->getPayoffDebtByDate($from, $to, $txt_search);
		// } else {
		// 	$data['data'] = $this->finance_model->getPayoffDebt();
		// }
		// var_dump($this->request->getPost("txt_search"));
		// var_dump($txt_search);
		echo view('header', $data);
		echo view('index');
		echo view('footer');
	}

	//--------------------------------------------------------------------
	public function notifications()
	{
		$data['borrow'] 	= $this->noti_model->get_noti($id = null,$close = false);
		$data['title'] = 'แจ้งเตือนทั้งหมด';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('notifications');
		echo view('footer');
	}

	public function notifications_test()
	{
		$data['borrow'] 	= $this->noti_model->get_noti($id = null,$close = false);
		echo "<pre>";
		var_dump($data['borrow']);
		echo "</pre>";
	}

	//--------------------------------------------------------------------
	public function permissions()
	{
		// $data['borrow'] 	= $this->supplie_model->get_noti();
		$data['group'] 	= $this->supplie_model->getPermissionsGroup();
		$data['title'] = 'กำหนดสิทธิ์';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('permissions');
		echo view('footer');
	}

	//--------------------------------------------------------------------
	public function view_group($id = null)
	{
		if ($id == null)
			return false;
		// $data['data'] 	= $this->noti_model->get_noti();
		$data['title'] = 'แสดงรายละเอียด';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('view_group');
		echo view('footer');
	}

	//--------------------------------------------------------------------
	public function edit_group($id = null)
	{
		if ($id == null)
			return false;
		// $data['data'] 	= $this->noti_model->get_noti();
		$data['title'] = 'แก้ไข';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('edit_group');
		echo view('footer');
	}

	//--------------------------------------------------------------------
    public function delete_group($id = null)
    {
        if ($id == null)
            return false;
        else {
            // $this->supplie_model->deleteTaxRateByID($id);
            // $this->supplie_model->addLog(1);
            return redirect()->to('/permissions');
        }
    }
    // -----------------------------------------------------------------
	public function view_user($id = null)
	{
		if ($id == null)
			return false;
		// $data['data'] 	= $this->noti_model->get_noti();
		$data['title'] = 'แสดงรายละเอียด';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('view_user');
		echo view('footer');
	}

	//--------------------------------------------------------------------
	public function edit_user($id = null)
	{
		if ($id == null)
			return false;
		// $data['data'] 	= $this->noti_model->get_noti();
		$data['title'] = 'แก้ไข';
		$data['pages'] = [['link' => '#', 'title' => $data['title']]];
		echo view('header', $data);
		echo view('edit_user');
		echo view('footer');
	}

	//--------------------------------------------------------------------
    public function delete_user($id = null)
    {
        if ($id == null)
            return false;
        else {
            // $this->supplie_model->deleteTaxRateByID($id);
            // $this->supplie_model->addLog(1);
            return redirect()->to('/permissions');
        }
    }
    // -----------------------------------------------------------------
	public function save()
	{
		$data = [
			'no_id'     => $this->request->getPost('no'),
			'date'      => $this->request->getPost('date'),
			'refer'   	=> $this->request->getPost('refer'),
			'detail'    => $this->request->getPost('detail'),
			'note'      => $this->request->getPost('note'),
			'amount'    => $this->request->getPost('amount')
		];
		$this->test_model->addPayJournal($data);

		// $data['customer_name'] = $this->request->getPost('name');
		// $this->test_model->addCustomer($data);

		// print_r($this->request->getPost());
		// print_r($data);
		return redirect()->to('/');
	}

	public function pdf()
	{

		require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';

		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('pdf'));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream();
	}
}
