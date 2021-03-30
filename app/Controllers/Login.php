<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
	public function __construct()
	{
		$this->account_model = model('account_model');
        $this->finance_model = model('finance_model');
    
	}
	// -----------------------------------------------------------------
    public function index()
    {
        $data['title'] = 'Login';
        echo view('login', $data);
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    // -----------------------------------------------------------------
    public function validlogin()
    {
        // var_dump($this->request);

        // 	if($this->User_model->record_count($this->request->getPost('username'), $this->request->getPost('password')) == 1)
        // 	{
        // 		$result = $this->User_model->fetch_user_login($this->request->getPost('username'), $this->request->getPost('password'));
        // 		$this->session->set_userdata(array('login_id'    => $result->id,'username'    => $result->username,'display_name'=> $result->display_name));
        // 		redirect('order');
        // 	}
        // 	else
        // 	{
        // 		$this->session->set_flashdata(array('msgerr'=> '<p class="login-box-msg" style="color:red;">ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!</p>'));
        // 		redirect('user/login', 'refresh');
        // 	}

        $db = db_connect();
        $table = $db->prefixTable('users');
        $builder = $db->table($table);
        
        $user = $builder->where('username',$this->request->getPost('username'))
            ->where('password', $this->request->getPost('password'))
            ->get()->getRow();
        if ($user) {
            $session = session();
            $session->set('auth', $user->id);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login');
        }

        /*
        $builder->where('username', $this->request->getPost('username'))->update([
            'password' => $this->request->getPost('password')
        ]);*/


        //echo 'Username : '.$this->request->getPost('username').'<br>';
        //echo 'Password : '.$this->request->getPost('password');
        


    }
    // -----------------------------------------------------------------

}
