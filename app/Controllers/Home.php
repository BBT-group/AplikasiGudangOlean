<?php

namespace App\Controllers;
use App\Models\ModelLogin;

class Home extends BaseController
{

    protected $db;

    public function __construct()
    {
        $this->db = new ModelLogin();
    }
    public function index(): string
    {
        return view('v_login');
    }

    public function login()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('ms_user')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();
        if($user) {
            if(password_verify($post['password'], $user->password)) {
                $params = ['id_ms_user' => $user->id_ms_user, 'role' => $user->role];
                session()->set($params);
                return redirect()->to(site_url('beranda'));
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak sesuai');
        }
    }

    public function logout()
    {
        session()->remove('id_ms_user');
        return redirect()->to(site_url('/'));
    }

}
