<?php

class Controllers{
    public $actions;
    public $action;
    public $model;
    public $login;
    public $user;
    public $ajax;
    
    public function __construct( $actions ) {
        //$action = array_unique($action);
        $this->login = $this->getModel("Login");
        $this->user = $this->login->is_user();
        $this->action = $actions;        
        //print_r($this->action);
        //exit; 
    }
    //==============================================================================
    public function init() {
        return $this->action;
    }
    //==============================================================================
	public function is_ajax_request() {
		if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
            $this->ajax = array(
                'POST'=>$_POST,
                'GET'=>$_GET,
                'PUT'=>$_PUT,
                'DELETE'=>$_DELETE
            );
            return true;  
		} else {
            return false;
		}
	}
    //==============================================================================
    public function getModel( $model_name=NULL ) {
        if( !isset( $model_name ) || empty( $model_name ) ) {
            //$model_name = $this->action[0];
        }
        $this->model = $model_name;
        
        include_once ( MODELS.mb_convert_case( $this->model, MB_CASE_TITLE )."_Model.php" );
        $_model = mb_convert_case( $this->model, MB_CASE_TITLE )."_Model";
        $_model = new $_model;
        return $_model;
    }
    //==============================================================================
    public function tmpl( $name, $data, $layout=NULL ){
		//if(!is_array($data) || !is_array($data['user'])){
			$data['user'] = $this->user;
		//}
        $data['route'] = $this->action[0];
        $layout = new Views( $layout );
        return $layout->render( VIEWS.$name.".php", $data );
    }
    //==============================================================================
    public function tmpl_ajax( $path_name, $data ){
        $ajax_tmpl = new Views();
        return $ajax_tmpl->tmpl_ajax( VIEWS.$path_name.".php", $data );
    }
    //==============================================================================
    public function __404(){
        header("HTTP/1.0 404 Not Found");
        $layout = new Views();
        return $layout->render( VIEWS."page/page404.php", $data );
    }

}