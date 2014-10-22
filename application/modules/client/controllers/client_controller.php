<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Rest rest
 */
class Client_controller extends CI_Controller
{
    public function index()
    {
        // Load the library
        $this->load->library('rest');

        // Set config options (only 'server' is required to work)
        /* 		$config = array('server'            => 'http://localhost/CI_RESTserver/index.php/api/example/',
                        //'api_key'         => 'Setec_Astronomy'
                        //'api_name'        => 'X-API-KEY'
                        //'http_user'       => 'admin',
                        //'http_pass'       => '123456',
                        //'http_auth'       => 'basic',
                        //'ssl_verify_peer' => TRUE,
                        //'ssl_cainfo'      => '/certs/cert.pem'
                ); */
        $config = array('server' => 'http://localhost/irbs-ams/index.php/api/api_controller/',

        );
        // Run some setup
        $this->rest->initialize($config);

//        $uri = 'account';
//        $method = 'put';
//        $params = array(
//            'account_name' => 'test_rest',
//            'staff_name' => 'test_rest_staff_name',
//            'password' => '123456',
//            'address' => 'abc123'
//        );
        $method = 'get';
        $uri = 'children';
        $params = array(
            'id' => '8'
        );
        //$method is putted in {} to vary method name instead of calling a fixed name function
        $request = $this->rest->{$method}($uri, $params);
        var_dump($request);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */