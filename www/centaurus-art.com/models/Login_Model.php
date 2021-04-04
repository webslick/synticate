<?
class Login_Model extends Models {
        public function __construct(){
            parent::__construct();
        }
        public function auth( $data ) {
        $flag = false;
        $security = new Security();
        $valid = $security->valid_user( $data );
        
        if( isset( $valid['pass'] ) ) {    
            $email = $this->real_escape_string( $data['email'] );
            $pass = $this->real_escape_string( $data['pass'] );            
            $r = $this->query("
                SELECT 
                    `pass` 
                FROM 
                    `users` 
                WHERE 
                    `email`='$email' 
                LIMIT 0,1
            ")->fetch_assoc();
            
            if( isset( $r['pass'] ) ) {
                if( $security->verify_password( $data['pass'], $r['pass'] ) ) {
                    $key = md5( md5( $data['email'].md5( $r['pass'] ) ) );
                    $this->query("UPDATE `users` SET `key`='$key' WHERE `email`='$email'");
                    setcookie("auth_key", $key, time()+3600, "/" );
                    $_SESSION['auth_key'] = $key;
                    $flag = array('e'=>array('auth'));
                } else {
                    setcookie("auth_key", "", time()-3600, "/" );
                    unset( $_SESSION['auth_key'] );
                    $flag = array('e'=>array('err_pass'));
                }    
            } else {
                setcookie("auth_key", "", time()-3600, "/" );
                unset( $_SESSION['auth_key'] );
                $flag = array('e'=>array('err_pass'));
            }
        } else {
            setcookie("auth_key", "", time()-3600, "/" );
            unset( $_SESSION['auth_key'] );
            $flag = $valid;
        }        
        if( $data['exit'] == 1 ) {
            setcookie("auth_key", "", time()-3600, "/" );
            unset( $_SESSION['auth_key'] );
            $flag = array('e'=>array('exit'));
        }
        return json_encode( $flag, true );
    }
    //==============================================================================
    public function is_user() {
        if( isset( $_COOKIE['auth_key'] ) || isset( $_SESSION['auth_key'] ) ) {
            $key = $this->real_escape_string( $_SESSION['auth_key'] /*$_COOKIE['auth_key']*/ );
            $user = $this->query("
                SELECT * FROM 
                    `users` 
                WHERE 
                    `key`='$key'
                LIMIT 0,1
            ")->fetch_assoc();
            
            if( count( (array)$user ) > 0 ) {
                $access = array();
                switch( $user['access'] ) {
                    case 0:
                        $access = array( 'admin'=>$user );
                    break;
                    //=====
                    case 1:
                        $access = array( 'moder'=>$user );
                    break;
                    //=====
                    case 2:
                        $access = array( 'user'=>$user );
                    break;
                }
                return $access;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    //==============================================================================
    public function get_allUsers() {
        $users = array();
        $q = $this->query("SELECT * FROM `users` WHERE `access` > 0  ORDER BY `Id` DESC");
        while( $r = $q->fetch_assoc() ) {
            $users[] = $r;
        }
        return $users;
    }
    //==============================================================================
	public function forgot($email) {
		//echo "forgot\n\n";
		$user = $this->query("SELECT * FROM `users` WHERE `email`='$email' LIMIT 0,1")->fetch_assoc();
		//print_r($user);
		if($user){
			$key = $user['key'];
			$q = "UPDATE `users` SET `hash`='$key' WHERE `email`='$email'";
			//echo $q."\n\n";
			$this->query($q);
		}else{
			return false;
		}
		//*********************
		$link  = SITE."/login/forgot_accept?hash=".$user['key'];
		$html  = "<h1>Password Recovery</h1>\r\n";
		$html .= "<p>Follow link to recover your password</p>\r\n";
		$html .= "<a href='$link'>$link</a>\r\n";
		//*********************
		$e = new Email();
		$e->sendEmail(
			$email,
			"rotot@visariya.com",
			"Робот",
			"Запрос на восстановление пароля",
			$html
		);
		//*********************
		
		//*********************
		
		//$q = "UPDATE `users` SET `hash`='$uer[key]' WHERE `email`='$email'";
		//echo $q."\n\n";
		//$user = $this->query($q)->fetch_assoc();
		//print_r($user);
	}
    //==============================================================================
	public function getUserByHash($hash, $retUser=false){
		$user = $this->query("SELECT * FROM `users` WHERE `hash`='$hash' LIMIT 0,1")->fetch_assoc();
		if($user['key']){
			if($retUser){
				$array['user'] = $user;
			}else{
				$q = "UPDATE `users` SET `hash`='' WHERE `hash`='$hash'";
				//echo $q."\n\n";
				$this->query($q);
			}
			$array['status'] = 'ok';
			return $array;
		}else{
			$array['status'] = 'error';
			$array['error']  = 'nohash';
			return $array;
		}
		$array['status'] = 'error';
		$array['error']  = 'undefined';
		return $array;
	}
    //==============================================================================
	public function setUserNewPassowrd($pass, $pass2){
		//echo "pass=$pass pass2=$pass2";
		if($pass==$pass2 && $pass!=''){
			$security = new Security();
			
			$newPass = $security->password_generate( $pass );
			
			$oldKey = $_SESSION['auth_key'];			
			$user = $this->getUserByHash($oldKey, true);
						
			$key = md5( md5( $user['email'].md5( $pass ) ) );
			$_SESSION['auth_key'] = $key;
			
			
			
			$q = "UPDATE `users` SET `pass`='$newPass', `key`='$key' WHERE `key`='$oldKey'";
			//echo $q;
			$this->query($q);
			
			$array['status'] = 'ok';
			return $array;
		}elseif($pass!=$pass2 && $pass!=''){
			$array['status'] = 'error';
			$array['error']  = 'noalignment';
			return $array;
		}elseif($pass!=$pass2 && $pass!=''){
			$array['status'] = 'error';
			$array['error']  = 'empty';
			return $array;
		}
		$array['status'] = 'error';
		$array['error']  = 'undefined';
		return $array;
	}
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
}
?>