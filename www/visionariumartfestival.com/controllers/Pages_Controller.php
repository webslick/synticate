<?php
class Pages_Controller extends Controllers {
    public $admin;
   
    public function __construct($action) {
        parent::__construct($action);
        if( $this->user['admin'] || $this->user['moder'] ){
            $this->admin = true;
        }
    }
	// Concept ==============================================================================
    public function concept() {
        $model = $this->getModel("Pages");
        $items = $model->get_items( $this->action[0], $this->admin );
        $data = array(
            'user'=>$this->user,
            'items'=>$items,
            'link'=>$this->action[0]
        );
        $this->tmpl( "page/".$this->action[0], $data );
    }
    // Location ==============================================================================
    public function location() {
        $this->tmpl( "page/".$this->action[0], $data );
    }
    // Artists ===============================================================================
    public function artists() {
        $model = $this->getModel("Pages");
        $items = $model->get_items( $this->action[0], $this->admin );
        $data = array(
            'user'=>$this->user,
            'items'=>$items,
            'link'=>$this->action[0]
        );
        $this->tmpl( "page/".$this->action[0], $data );
    }
    // Music ================================================================================
    public function music() {
        $model = $this->getModel("Pages");
        $items = $model->get_items( $this->action[0], $this->admin );
        $data = array(
            'user'=>$this->user,
            'items'=>$items,
            'link'=>$this->action[0]
        );
        $this->tmpl( "page/".$this->action[0], $data );
    }
    // Workshops ============================================================================
    public function workshops() {
        $this->tmpl( "page/".$this->action[0], $data );
    }
    // Gallery ==============================================================================
    public function gallery() {
        $_GET['section'] = 'main_gallery';
        $model = $this->getModel("Pages");
        $data = $model->get_gallery_section( $_GET, $this->admin );
        if( $data ) {
            $this->tmpl( "page/".$this->action[0], $data );
        } else {
            $this->__404();
        }
    }
    // Gallery_users ========================================================================
    public function gallery_users( $action ) {
        if( $action == 'main_gallery' || $action == '' ) {
            header( 'Location: /gallery', true, 303 );
        } else {
            $_GET['section'] = $action;
            $model = $this->getModel("Pages");        
            $data = $model->get_gallery_section( $_GET, $this->admin );
            if( $data ) {
                $this->tmpl( "page/gallery", $data );    
            } else {
                $this->__404();
            }
        }
    }
    // Partners ============================================================================
    public function partners() {
        $this->tmpl( "page/".$this->action[0], $data );    
    }
    // Contact =============================================================================
    public function contact() {
        $this->tmpl( "page/".$this->action[0], $data );    
    }
    // Test =============================================================================
    public function test() {
        $this->tmpl( "page/".$this->action[0], $data );    
    }
    //==============================================================================    
}