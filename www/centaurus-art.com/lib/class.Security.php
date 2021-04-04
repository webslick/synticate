<?php
class Security {
    private function cost( $cost = 8 ) {
        $timeTarget = 0.05; //50 миллисекунд.
        do {
            $cost++;
            $start = microtime(true );
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost] );
            $end = microtime(true );
        } while ( ($end - $start) < $timeTarget );

        return $cost;
    }
    //==============================================================================
    public function password_generate( $string_password ) {
        return password_hash( $string_password, PASSWORD_BCRYPT, ["cost" => $this->cost()] );
    }
    //==============================================================================
    public function verify_password( $password ,$hash ) {
        if ( password_verify( $password, $hash ) ) {
            return 1;
        } else {
            return 0;
        }
    }
    //==============================================================================
    public function email_test( $email ){
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            return 1;
        } else {
            return 0;
        }
    }
    //==============================================================================
    public function auth_user( $login, $password, $hash ) {
        if( password_verify( $password, $hash ) ) {
            if( password_needs_rehash( $hash, PASSWORD_DEFAULT, ["cost" => $this->cost()] ) ) {
                $newHash = password_hash($password, PASSWORD_DEFAULT, ["cost" => $this->cost()] );
            }
            //Авторизуем пользователя
            return 1;
        } else {
            return 0;
        }
    }
    //==============================================================================
    public function valid_user( $data ) {
        $args = array(
            /*'name' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[a-zA-Zа-яА-Я\'][a-zA-Zа-яА-Я-\' ]+[a-zA-Zа-яА-Я\']{2,}$/u',
                    'default' => 'ERR_NAME'
                )
            ),*/
            'pass' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^.{5,}$/',
                    'default' => 'err_pass'
                )
            ),
            'email' => array(
                'filter' => FILTER_VALIDATE_EMAIL,
                'options' => array(
                    'default' => 'err_email'
                )
            )
        );
        $filter = filter_var_array( $data, $args );
        $err_flags = array();
        foreach( $filter as $item ) {
            if( preg_match( "/^err/", $item ) ) {
                $err_flags['e'][] = $item;
            }
        }
        if( count( $err_flags ) > 0 ) {
            return $err_flags;
        } else {
            $pass = $this->password_generate( $data['pass'] );
            return array(
                //'name' => $data['name'],
                'email' => $data['email'],
                'pass' => $pass
            );
        }
    }
    // ==============================================================================
    public function getBrowser() { 
     
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
    
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
        
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
        
        // Finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        
        // See how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }
        
        // check if we have a number
        if ($version==null || $version=="") {$version="?";}
        
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern
        );
    }
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
}