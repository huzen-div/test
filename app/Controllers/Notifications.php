<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Jwt;

class Notifications extends Controller
{
	public function __construct()
	{
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
	// public function notifications()
	// {
	// 	$data['title'] = 'แจ้งเตือนทั้งหมด';
	// 	echo view('header',$data);
	// 	echo view('notifications');
	// 	echo view('footer');
	// }
	// public function delete($id = null, $type = null)
	public function delete()
	{
		$id_noti = $_POST['id_noti'];

		$id_noti = json_decode($id_noti);
		$type = $_POST['type'];
		// $stack = [];
		for($i = 0;$i < count($id_noti);$i++){
			// array_push($stack, 22);
			$result = $this->noti_model->delNotifications($id_noti[$i], $type);
		}
		echo json_encode($result);
		
		// $id_noti = $_POST['id_noti'];
		// $type = $_POST['type'];
		// // $id_noti = 17;
		// // $type = "1";
		// $result = $this->noti_model->delNotifications($id_noti, $type);
		// // echo "<pre>";
		// // var_dump($result);
		// // echo "</pre>";
		
		// // echo $id."-".$type;
		// // $data['data'] = $this->noti_model->delNotifications($id, $type);
		// // return json_encode(array($data['data']));
	}

	public function create_hide()
	{
		$id_noti = $_POST['id_noti'];
		$type = $_POST['type'];
		$result = $this->noti_model->hideNotifications($id_noti, $type);
	}

	public function create_read()
	{
		$id_noti = $_POST['id_noti'];

		// $id_noti = json_decode($id_noti);
		$type = $_POST['type'];
		// for($i = 0;$i < count($id_noti);$i++){
			$result = $this->noti_model->readNotifications($id_noti, $type);
		// }
		// echo json_encode($result);
	}

	public function lorem_token()
	{
		// echo \CodeIgniter\CodeIgniter::CI_VERSION;
		$this->Jwt = new Jwt();
		// $this->load->library('jwt');
		
		$privateKey = <<<EOD
		-----BEGIN RSA PRIVATE KEY-----
		MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
		vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
		5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
		AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
		bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
		Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
		cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
		5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
		ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
		k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
		qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
		eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
		B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
		-----END RSA PRIVATE KEY-----
		EOD;

		$publicKey = <<<EOD
		-----BEGIN PUBLIC KEY-----
		MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
		4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
		0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
		ehde/zUxo6UvS7UrBQIDAQAB
		-----END PUBLIC KEY-----
		EOD;

		$jwt1 = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDB9.bZnUvnS9syeH8nAMNgNDwqcqMvIZBXC_j3RyWjwHylU";
		// $decoded1 = $this->Jwt->decode($jwt1, 'ffff', array('HS256'));
		$decoded1 = Jwt::decode($jwt1, 'ffff', array('HS256'));
		echo "<pre>";
		var_dump($decoded1);
		echo "<pre>";
		
		// $jwt2 = "eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MTYxMjQyOTcsImlhdCI6MTYxNTg2NTA5NywiaXNzIjoiY2hhcGFuYWtpai5vci50aCIsInN1YiI6IjEiLCJocl9yb2xlIjoiIiwiZW1wX2NvZGUiOiIiLCJwZXJtaXNzaW9ucyI6eyJhcHByb3ZhbCI6WyJyZWFkIiwiZWRpdCIsImFwcHJvdmUiXSwiYXR0ZW5kYW5jZSI6WyJyZWFkIiwiZWRpdCJdLCJjb21wYW55X3NldHRpbmciOlsiZWRpdCIsInJlYWQiXSwiY29tcGVuc2F0aW9uX3JlcG9ydCI6WyJlZGl0IiwicmVhZCJdLCJkZWR1Y3Rpb25fYXR0YWNoX2ZpbGUiOlsicmVhZCJdLCJkb2N1bWVudF9mb3JtXzEiOlsicmVhZCIsImVkaXQiXSwiZG9jdW1lbnRfZm9ybV8xXzAzIjpbImVkaXQiLCJyZWFkIl0sImRvY3VtZW50X2Zvcm1fMV8xIjpbImVkaXQiLCJyZWFkIl0sImRvY3VtZW50X2Zvcm1fMV8xMCI6WyJlZGl0IiwicmVhZCJdLCJkb2N1bWVudF9mb3JtXzFfMTBfMSI6WyJyZWFkIiwiZWRpdCJdLCJkb2N1bWVudF9mb3JtXzZfMDkiOlsicmVhZCIsImVkaXQiXSwiZWR1Y2F0aW9uX2hpc3RvcnkiOlsicmVhZCJdLCJlbXBsb3llZSI6WyJyZWFkIl0sImVtcGxveWVlX2F0dGVuZGFuY2UiOlsicmVhZCJdLCJlbXBsb3llZV9sZWF2ZV9yZXBvcnQiOlsiZWRpdCIsInJlYWQiXSwiZW1wbG95ZWVfbWFuYWdlIjpbInJlYWQiLCJlZGl0Il0sImVtcGxveWVlX3R5cGVfbWFuYWdlIjpbImVkaXQiLCJyZWFkIl0sImhlaXJfaGlzdG9yeSI6WyJyZWFkIl0sImpvYl9wb3NpdGlvbl9tYW5hZ2UiOlsiZWRpdCIsInJlYWQiXSwibGVhdmVfYXBwcm92YWwiOlsicmVhZCIsImVkaXQiLCJhcHByb3ZlIiwiY2FuY2VsIl0sImxlYXZlX3F1b3RhIjpbImVkaXQiLCJyZWFkIl0sImxlYXZlX3JlcG9ydCI6WyJyZWFkIl0sImxlYXZlX3JlcXVlc3QiOlsicmVhZCIsImVkaXQiXSwibGVhdmVfdHlwZSI6WyJyZWFkIiwiZWRpdCJdLCJtZWRpY2FsX3JlcXVlc3QiOlsicmVhZCIsImVkaXQiXSwibW9kaWZpY2F0aW9uX2hpc3RvcnkiOlsicmVhZCJdLCJteV9hdHRhY2hfZmlsZSI6WyJyZWFkIl0sIm5vbl9yZXNpZGVudF93aXRoaG9sZGluZ190YXhfY2VydGlmaWNhdGUiOlsicmVhZCIsImVkaXQiXSwib3JnYW5pemF0aW9uX21hbmFnZSI6WyJyZWFkIiwiZWRpdCJdLCJvcmdhbml6YXRpb25hbF9zdHJ1Y3R1cmUiOlsiZWRpdCIsInJlYWQiXSwib3RoZXJfaGlzdG9yeSI6WyJyZWFkIl0sIm90aGVyaW5jb21lX2RlZHVjdGlvbiI6WyJyZWFkIl0sIm90aGVyaW5jb21lX2RlZHVjdGlvbl9zZXR0aW5nIjpbInJlYWQiLCJlZGl0Il0sIm90aGVyaW5jb21lX3RheF9hbGxvd2FuY2UiOlsiZWRpdCIsInJlYWQiXSwicGFyZW50c19oaXN0b3J5IjpbInJlYWQiXSwicGF5cm9sbCI6WyJlZGl0IiwicmVhZCJdLCJwYXlyb2xsX3ByaW50IjpbInJlYWQiXSwicGF5cm9sbF9yZXBvcnQiOlsicmVhZCIsImVkaXQiXSwicHVuaXNobWVudF9oaXN0b3J5IjpbInJlYWQiXSwicmVsb2NhdGVfcG9zaXRpb25faGlzdG9yeSI6WyJyZWFkIl0sInJlbG9jYXRlX3Bvc2l0aW9uX21hbmFnZSI6WyJyZWFkIiwiZWRpdCJdLCJyZXF1ZXN0IjpbInJlYWQiLCJlZGl0Il0sInJlcXVlc3RfYXBwcm92YWwiOlsiZWRpdCIsInJlYWQiLCJhcHByb3ZlIl0sInJlc2lnbiI6WyJyZWFkIiwiZWRpdCJdLCJyZXRpcmUiOlsiZWRpdCIsInJlYWQiXSwic3BvdXNlX2hpc3RvcnkiOlsicmVhZCJdLCJ0YWxlbnQiOlsicmVhZCJdLCJ0YXhfYWxsb3dhbmNlIjpbInJlYWQiLCJlZGl0Il0sInRyYWluaW5nX2hpc3RvcnkiOlsicmVhZCJdLCJ0dWl0aW9uX3JlcXVlc3QiOlsiZWRpdCIsInJlYWQiXSwidW5kZWZpbmVkIjpbInJlYWQiLCJlZGl0Il0sIndvcmtfaGlzdG9yeSI6WyJyZWFkIl19fQ.8W9AXY7Z8YQM165S73QH06zEIShzTQy4FLtDcb65Oeg40Kf0irl_TIwqLbrJF7ugE_8N2JgXi3_t76eU18Hzlg";
		// $decoded2 = $this->Jwt->decode($jwt2, $publicKey, array('HS256'));
		// echo "<pre>";
		// var_dump($decoded2);
		// echo "<pre>";
	}
	public function lorem_token_check()
	{
		$this->Jwt = new Jwt();
		$token_test = $_POST['token_test'];
		// $jwt_test = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmxpbmUgSldUIEJ1aWxkZXIiLCJpYXQiOjE2MTU4OTIxMDMsImV4cCI6MTY0NzQyODEwMywiYXVkIjoid3d3LmV4YW1wbGUuY29tIiwic3ViIjoianJvY2tldEBleGFtcGxlLmNvbSIsIkdpdmVuTmFtZSI6IkpvaG5ueSIsIlN1cm5hbWUiOiJSb2NrZXQiLCJFbWFpbCI6Impyb2NrZXRAZXhhbXBsZS5jb20iLCJSb2xlIjpbIk1hbmFnZXIiLCJQcm9qZWN0IEFkbWluaXN0cmF0b3IiXX0.v8-KmHGBf2ZENqfnCjbkG3jYXhB7dcHeGZM2_H45O1E";
		$decoded1 = Jwt::decode($token_test, 'test_key', array('HS256'));
		return json_encode($decoded1);
	}

	public function lorem_token_check2()
	{
		$this->Jwt = new Jwt();
		$publicKey3 = <<<EOD
		-----BEGIN PUBLIC KEY-----
		MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEkAdDsIKrukx/Qi1fVoKQfYFVylbY
		oZ5Ol9lbxEyrHYm+4KNYvox+W/KN6TMC1dGD+qFOpVNSUcwppEIsumkH1A==
		-----END PUBLIC KEY-----		
		EOD;
		
		$jwt2 = "eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MTYxMjQyOTcsImlhdCI6MTYxNTg2NTA5NywiaXNzIjoiY2hhcGFuYWtpai5vci50aCIsInN1YiI6IjEiLCJocl9yb2xlIjoiIiwiZW1wX2NvZGUiOiIiLCJwZXJtaXNzaW9ucyI6eyJhcHByb3ZhbCI6WyJyZWFkIiwiZWRpdCIsImFwcHJvdmUiXSwiYXR0ZW5kYW5jZSI6WyJyZWFkIiwiZWRpdCJdLCJjb21wYW55X3NldHRpbmciOlsiZWRpdCIsInJlYWQiXSwiY29tcGVuc2F0aW9uX3JlcG9ydCI6WyJlZGl0IiwicmVhZCJdLCJkZWR1Y3Rpb25fYXR0YWNoX2ZpbGUiOlsicmVhZCJdLCJkb2N1bWVudF9mb3JtXzEiOlsicmVhZCIsImVkaXQiXSwiZG9jdW1lbnRfZm9ybV8xXzAzIjpbImVkaXQiLCJyZWFkIl0sImRvY3VtZW50X2Zvcm1fMV8xIjpbImVkaXQiLCJyZWFkIl0sImRvY3VtZW50X2Zvcm1fMV8xMCI6WyJlZGl0IiwicmVhZCJdLCJkb2N1bWVudF9mb3JtXzFfMTBfMSI6WyJyZWFkIiwiZWRpdCJdLCJkb2N1bWVudF9mb3JtXzZfMDkiOlsicmVhZCIsImVkaXQiXSwiZWR1Y2F0aW9uX2hpc3RvcnkiOlsicmVhZCJdLCJlbXBsb3llZSI6WyJyZWFkIl0sImVtcGxveWVlX2F0dGVuZGFuY2UiOlsicmVhZCJdLCJlbXBsb3llZV9sZWF2ZV9yZXBvcnQiOlsiZWRpdCIsInJlYWQiXSwiZW1wbG95ZWVfbWFuYWdlIjpbInJlYWQiLCJlZGl0Il0sImVtcGxveWVlX3R5cGVfbWFuYWdlIjpbImVkaXQiLCJyZWFkIl0sImhlaXJfaGlzdG9yeSI6WyJyZWFkIl0sImpvYl9wb3NpdGlvbl9tYW5hZ2UiOlsiZWRpdCIsInJlYWQiXSwibGVhdmVfYXBwcm92YWwiOlsicmVhZCIsImVkaXQiLCJhcHByb3ZlIiwiY2FuY2VsIl0sImxlYXZlX3F1b3RhIjpbImVkaXQiLCJyZWFkIl0sImxlYXZlX3JlcG9ydCI6WyJyZWFkIl0sImxlYXZlX3JlcXVlc3QiOlsicmVhZCIsImVkaXQiXSwibGVhdmVfdHlwZSI6WyJyZWFkIiwiZWRpdCJdLCJtZWRpY2FsX3JlcXVlc3QiOlsicmVhZCIsImVkaXQiXSwibW9kaWZpY2F0aW9uX2hpc3RvcnkiOlsicmVhZCJdLCJteV9hdHRhY2hfZmlsZSI6WyJyZWFkIl0sIm5vbl9yZXNpZGVudF93aXRoaG9sZGluZ190YXhfY2VydGlmaWNhdGUiOlsicmVhZCIsImVkaXQiXSwib3JnYW5pemF0aW9uX21hbmFnZSI6WyJyZWFkIiwiZWRpdCJdLCJvcmdhbml6YXRpb25hbF9zdHJ1Y3R1cmUiOlsiZWRpdCIsInJlYWQiXSwib3RoZXJfaGlzdG9yeSI6WyJyZWFkIl0sIm90aGVyaW5jb21lX2RlZHVjdGlvbiI6WyJyZWFkIl0sIm90aGVyaW5jb21lX2RlZHVjdGlvbl9zZXR0aW5nIjpbInJlYWQiLCJlZGl0Il0sIm90aGVyaW5jb21lX3RheF9hbGxvd2FuY2UiOlsiZWRpdCIsInJlYWQiXSwicGFyZW50c19oaXN0b3J5IjpbInJlYWQiXSwicGF5cm9sbCI6WyJlZGl0IiwicmVhZCJdLCJwYXlyb2xsX3ByaW50IjpbInJlYWQiXSwicGF5cm9sbF9yZXBvcnQiOlsicmVhZCIsImVkaXQiXSwicHVuaXNobWVudF9oaXN0b3J5IjpbInJlYWQiXSwicmVsb2NhdGVfcG9zaXRpb25faGlzdG9yeSI6WyJyZWFkIl0sInJlbG9jYXRlX3Bvc2l0aW9uX21hbmFnZSI6WyJyZWFkIiwiZWRpdCJdLCJyZXF1ZXN0IjpbInJlYWQiLCJlZGl0Il0sInJlcXVlc3RfYXBwcm92YWwiOlsiZWRpdCIsInJlYWQiLCJhcHByb3ZlIl0sInJlc2lnbiI6WyJyZWFkIiwiZWRpdCJdLCJyZXRpcmUiOlsiZWRpdCIsInJlYWQiXSwic3BvdXNlX2hpc3RvcnkiOlsicmVhZCJdLCJ0YWxlbnQiOlsicmVhZCJdLCJ0YXhfYWxsb3dhbmNlIjpbInJlYWQiLCJlZGl0Il0sInRyYWluaW5nX2hpc3RvcnkiOlsicmVhZCJdLCJ0dWl0aW9uX3JlcXVlc3QiOlsiZWRpdCIsInJlYWQiXSwidW5kZWZpbmVkIjpbInJlYWQiLCJlZGl0Il0sIndvcmtfaGlzdG9yeSI6WyJyZWFkIl19fQ.8W9AXY7Z8YQM165S73QH06zEIShzTQy4FLtDcb65Oeg40Kf0irl_TIwqLbrJF7ugE_8N2JgXi3_t76eU18Hzlg";
		$decoded2 = Jwt::decode($jwt2, $publicKey3, array('ES256'));
		echo "<pre>";
		var_dump($decoded2);
		echo "<pre>";
	}

	public function test_session()
	{
		$data['pages'] = [['link' => '#', 'title' => 'test_session']];
		echo view('header', $data);
		echo view('test_session');
		echo view('footer');
	}
}
