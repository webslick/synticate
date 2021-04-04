<?php

class Views
{
    public $layout;
    public $path_name;
    public $data;

    public function __construct( $layout=null, $path_name=null, $data=null ) {
        $this->layout = $layout;
        $this->path_name = $path_name;
        $this->data = $data;
    }

    public function render ($path_name = null, $data = null ){
        $this->path_name = $path_name;
        $this->data = $data;

        if( empty( $this->layout ) ){
            $this->layout = DEFAULT_LAYOUT;
            require_once $this->layout;
        } else {
            require_once $this->layout;
        }
    }

    public function render_content(){
        $data = $this->data;
        if( isset( $this->path_name ) ){
            require_once $this->path_name;
        }
    }

    public function tmpl_ajax( $path_name = null, $data = null ){
        if( isset( $path_name ) ){
            require_once $path_name;
        }
    }
}