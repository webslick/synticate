<?
class Models extends Database {

    public function __construct(){        
        parent::__construct();
        session_start();
    }
    //==============================================================================
    public function init(){
        return true;
    }
    //==============================================================================
    public function base64ToImage( $path=false, $imageData ) {
        list( $type, $imageData ) = explode( ';', $imageData );
        list(, $extension ) = explode( '/', $type );
        list(, $imageData ) = explode( ',', $imageData );
        $fileName = uniqid().'.'.$extension;
        $imageData = base64_decode( $imageData );
        file_put_contents( $path.$fileName, $imageData );
        return $fileName;
    }
    //==============================================================================
    public function check_length($value = "", $min, $max) {
        if( strlen($value) < $min || strlen($value) > $max ) {
            return 0;
        } else {
            return 1;
        }
    }
    //==============================================================================
    public function valid_email( $email, $user_id=NULL ) {        
        if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $r = $this->query("SELECT * FROM `users` WHERE `email`='$email' LIMIT 0,1");
            if( $r->num_rows > 0 ) {
                $u = $r->fetch_assoc();
                if( $u['Id'] === $user_id ) {
                    return true;
                } else {
                    return false;    
                }
            } else {
                return true;
            }
        } else {
            return false;
        }        
    }
    //==============================================================================
    //==============================================================================
    //==============================================================================
    
}
?>