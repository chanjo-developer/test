<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Welcome extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
    	$data['module']="welcome";
        $data['view_file']="welcome_page";
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/welcome', $data);
    	
    }

}
