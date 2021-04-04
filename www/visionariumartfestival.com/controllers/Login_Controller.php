<?
class Login_Controller extends Controllers {
    public function login() {
        if( $this->is_ajax_request() ) {            
            echo $this->login->auth( $this->ajax['POST'] );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function login_exit() {
        $_SESSION['auth_key'] = NULL;
        unset($_SESSION);
    }
    //==============================================================================
	public function login_forgot() {
		if( $this->is_ajax_request() ) {
			$email = $this->ajax['POST']['email'];
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$array['status'] = 'ok';
			}elseif($email==''){
				$array['status'] = 'error';
				$array['error'] = 'empty';
			}else{
				$array['status'] = 'error';
				$array['error'] = 'novalid';
			}
			//******************************
			echo $this->login->forgot($email);
			
			$json = json_encode($array);
			echo $json;
        } else {
            $this->__404();
        }
	}
	//==============================================================================
	public function login_forgot_accept(){		
		$array = $this->login->getUserByHash($_GET['hash']);
		if($array['status']=='error'){
			if($array['error']=='nohash'){
				$this->__404();
			}elseif($array['error']=='undefined'){
				$this->__404();
			}
		}elseif($array['status']=='ok'){
            $_SESSION['auth_key'] = $_GET['hash'];
			$this->tmpl('page/index', $array);
		}
	}
    //==============================================================================
	public function login_new_password(){
		if( $this->is_ajax_request() ) {
			$array = $this->login->setUserNewPassowrd($this->ajax['POST']['pass'], $this->ajax['POST']['pass2']);
			$json = json_encode($array);
			echo $json;
		}
	}
    //==============================================================================    
}
?>