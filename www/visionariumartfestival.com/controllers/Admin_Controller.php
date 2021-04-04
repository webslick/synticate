<?
class Admin_Controller extends Controllers {
    
    public function __construct() {
        parent::__construct( $this->action );
        $this->model = $this->getModel("Admin");
    }
    //==============================================================================
    public function admin_edit() {
        if( $this->is_ajax_request() && $this->user['admin'] || $this->user['moder'] ) {
            $id = $this->ajax['GET']['id'];
            $data = $this->model->get_item_edit( $id );
            $this->tmpl_ajax( "popup/content_add", $data );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function admin_make() {
        if( $this->is_ajax_request() && $this->user['admin'] || $this->user['moder'] ) {
            $last_id = $this->model->make_item( $this->ajax['GET'] );
            if( $last_id ) {
                $last_page = array(
                    'user'=>$this->user,
                    'items'=>$this->getModel("Pages")->get_item( $last_id )
                );
            }
            $this->tmpl_ajax( "page/".$this->ajax['GET']['page'], $last_page );            
        } else {
            $this->__404();
        }    
    }
    //==============================================================================
    public function admin_remove() {
        if( $this->is_ajax_request() && $this->user['admin'] || $this->user['moder'] ) {
            echo $this->model->remove_item( $this->ajax['GET']['id'] );
        } else {
            $this->__404();
        }    
    }
    //==============================================================================
    public function admin_loadimage() {
        if( isset( $_FILES ) && $this->user['admin'] || $this->user['moder'] ) {
            $this->model->load_img( $_POST['item_id'], $_FILES );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function admin_save() {
        if( $this->is_ajax_request() && $this->user['admin'] || $this->user['moder'] ) {

            $link = $this->model->save_item( $this->ajax['POST'] );
            $pages = $this->getModel("Pages");
            $items = $pages->get_items( $link, true );
            $data = array(
                'user'=>$this->user,
                'items'=>$items,
                'link'=>$link
            );
            $this->tmpl_ajax( "page/".$link, $data );
        } else {
            $this->__404();
        }
                    
    }
    //==============================================================================
    public function admin_sort() {
        if( $this->is_ajax_request() && $this->user['admin'] || $this->user['moder'] ) {
            echo $this->model->save_items_sort( $this->ajax['POST'] );
        } else {
            $this->__404();
        }    
    }
    //==============================================================================
    //===============================    USERS   ===================================
    //==============================================================================
    public function admin_users() {
        if( $this->is_ajax_request() && $this->user['admin'] ) {
            $this->tmpl_ajax( "popup/list_admin", $this->model->list_admin() );
        } else {
            $this->__404();
        }
    }    
    //==============================================================================
    public function admin_saveuser() {
        if( $this->is_ajax_request() && $this->user['admin'] ) {            
            $this->model->save_user_data( $this->ajax['POST'] );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function admin_removeuser() {
        if( $this->is_ajax_request() && $this->user['admin'] ) {            
            $this->model->removeuser( $this->ajax['POST']['Id'] );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function admin_toggleroot() {
        if( $this->is_ajax_request() && $this->user['admin'] ) {
            $this->model->toggleroot( $this->ajax['POST']['Id'] );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    //===============================    GALLERY ===================================
    //==============================================================================
	public function admin_addimage(){
		if( $this->is_ajax_request() ) {
			$this->tmpl_ajax( "popup/gallery", $data );
		} else {
			$this->__404();
		}
	}
    //==============================================================================
    public function admin_editimage(){
		if( $this->is_ajax_request() ) {
            $data = $this->model->editimage( $this->ajax['POST']['id'] );
            $this->tmpl_ajax( "popup/gallery", $data );
		} else {
			$this->__404();
		}     
    }
	//==============================================================================
	public function admin_gallery_save_image(){
		if( $this->is_ajax_request() ) {
			$section = $this->model->gallery_save_image( $this->ajax['POST'] );
			$g_model = $this->getModel('Pages');
			$data = $g_model->get_gallery_section( array('section'=>$section), true );
			$this->tmpl_ajax( "page/gallery", $data );
		} else {
			$this->__404();
		}	
	}
    //==============================================================================
    public function admin_gallery_save_gallery(){
		if( $this->is_ajax_request() ) {
            echo $this->model->gallery_save_gallery( $this->ajax['POST'] ); 
		} else {
			$this->__404();
		}        
    }
	//==============================================================================
    public function admin_remove_gallery_items() {
		if( $this->is_ajax_request() ) {
            $res = $this->model->remove_gallery_items( $this->ajax['POST']['id'] );
            if( $res ) {
                $data = $this->getModel('Pages')->get_gallery_section( $res, true );
                $this->tmpl_ajax( "page/gallery", $data );
            }
		} else {
			$this->__404();
		}        
    }
    //==============================================================================
	public function admin_addgallery() {
		if( $this->is_ajax_request() ) {
		    $data = array();
            $data['gallery'] = true;            
            //$login = $this->getModel('Login');
            //$data['users'] = $login->get_allUsers();
            //$data['current_user'] = $this->user;

			$this->tmpl_ajax( "popup/gallery", $data );
		} else {
			$this->__404();
		}
	}
    //==============================================================================
	public function admin_editgallery() {
		if( $this->is_ajax_request() ) {
            $data['data'] = $this->getModel('Pages')->get_gallery( $this->ajax['POST']['id'] );
            $data = $data['data'][0];
            $data['gallery'] = true;
            
            //$login = $this->getModel('Login');
            //$users = $login->get_allUsers();
            
            /*$c = 0;
            $this_user_id = array_column( $this->user, 'Id' )[0];
            foreach( $users as $user ) {
                if( $user['Id'] != $this_user_id ){
                    $data['users'][$c] = $user;
                }
                $used = explode( ",", $data['users_id'] );
                foreach( $used as $id ) {
                    if( $id == $user['Id'] ) {
                        $data['users'][$c]['used'] = true;
                    }
                }
                $c++;
            }
            
            $data['current_user'] = $this->user;*/
		
            $this->tmpl_ajax( "popup/gallery", $data );
		} else {
			$this->__404();
		}
	}
    //==============================================================================
    public function admin_removegallery() {
        if( $this->is_ajax_request() ) {
            echo $this->model->removegallery( $this->ajax['POST']['id'] );
        } else {
            $this->__404();
        }
    }
    //==============================================================================
    public function admin_drop() {
        $section = $_POST['gallery'];
        if( empty( $section ) || $section=='undefined' ) {
            $section = 'main_gallery';
        }
        $id = $_POST['id'];
        
			$section = $this->model->load_drop( $id, $_FILES, $section );
			$g_model = $this->getModel('Pages');
			$data = $g_model->get_gallery_section( array('section'=>$section), true );
			$this->tmpl_ajax( "page/gallery", $data );
        //if( $this->is_ajax_request() ) {
            //print_r($_FILES);
            //echo json_encode($_FILES, true);
        //} else {
            //$this->__404();
        //}        
    }
    //==============================================================================
    //==============================================================================
    //==============================================================================
}
?>