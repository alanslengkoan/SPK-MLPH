<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['users']);
    }

    public function index()
    {
        $data = [
            'assessment' => $this->_get_assessment()
        ];
        // untuk load view
        $this->template->load('users', 'Assessment', 'assessment', 'view', $data);
    }
}
