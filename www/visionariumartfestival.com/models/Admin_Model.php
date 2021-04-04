<?
class Admin_Model extends Models {
    public function make_item( $ajax_GET ) {
        $page = $ajax_GET['page'];
        $type = $ajax_GET['type'];
        $r = $this->query("SELECT `Id` FROM `pages` WHERE `name`='$page' LIMIT 0,1")->fetch_assoc();
        $page_id = $r['Id'];
        $q = "
            INSERT INTO 
            	`items`
            SET 
            	`pages_id`='$page_id',
                `type`='$type',
            	`name`='new item',
            	`content`='new content', 
            	`sort`='0'
        ";
        if( $this->query( $q ) ) {
            return $this->insert_id;            
        } else {
            return 0;
        }
    }
    //==============================================================================
    public function remove_item( $id ) {
        $q = "DELETE FROM `items` WHERE `Id`=$id";
        if( $this->query( $q ) ) {
            return 'remove_'.$id;           
        } else {
            return 0;
        }        
    }
    //==============================================================================
    public function get_item_edit( $id ) {
        $item = $this->query("
            SELECT
                `items`.*,
                `pages`.name as link
            FROM
                `items`,
                `pages`
            WHERE
                `items`.Id = $id
            AND 
                `items`.pages_id = `pages`.Id
        ")->fetch_assoc();
        
        $q_img = $this->query("
            SELECT 
                `file_name` AS img
            FROM 
                `images` 
            WHERE 
                `items_id`=$id 
            ORDER BY 
                `Id` 
            DESC
        ");
        if( $q_img->num_rows > 0 ) {
            while($images = $q_img->fetch_assoc() ) {
                $item['img'][] = '/images/'.$item['link'].'/'.$images['img'];    
            }            
        } else {
            //$item['img'][] = '/images/no_img.jpg';    
        }
        return $item;
    }
    //==============================================================================
    public function load_img( $id, $array_files ) {
        $_type = $array_files['fileUpload']['name'];
        preg_match( "/\..*$/", $_type, $m );
        $type = $m[0];
                
        $newname = date('YmdHis',time()).mt_rand().$type;
        $dir = $_SERVER['DOCUMENT_ROOT'].'/web/images/'.$newname;        
        $file_name = $array_files['fileUpload']['tmp_name'];        
        
        if( is_uploaded_file( $file_name ) && !empty( $id ) ) {
            if( move_uploaded_file( $file_name, $dir ) ) {
                $this->query("
                    INSERT INTO 
                        `images` 
                    SET 
                        `items_id`=$id,
                        `file_name`='$newname'
                ");
            }                        
        }
    }
    //==============================================================================
    public function save_item( $ajax_POST ) {
        
        $item_id = $ajax_POST['Id'];
        $type = $ajax_POST['type'];
        $img = $ajax_POST['img'];
        $item_name = urldecode($ajax_POST['name']);
        $item_content = urldecode($ajax_POST['content']);
        $content_href = urldecode($ajax_POST['content_href']); //youtube
        $gallery_href = urldecode($ajax_POST['gallery_href']); //gallery
        
        $published = 0;
        if( $ajax_POST['published'] == 'true' ) {
            $published = 1;    
        }
        
        $q = "
            UPDATE 
                `items` 
            SET 
                `name`='$item_name',
                `type`='$type',
                `published`=$published,
                `content`='$item_content',
                `content_href`='$content_href',
                `gallery_href`='$gallery_href'
            WHERE 
                `Id`=$item_id
        ";
        
        $q_link = $this->query("
            SELECT 
                `pages`.name AS link 
            FROM 
                `items`,
                `pages` 
            WHERE 
                `items`.pages_id=`pages`.Id AND`items`.Id=$item_id
            ");
        $link = $q_link->fetch_assoc()['link'];
        
        if( preg_match( "#base64#", $img ) ) {
            $img_saved = $this->base64ToImage(
                WEB.'images/'.$link.'/',
                $img
            );
            $this->query("
                INSERT INTO 
                    `images` 
                SET 
                    `items_id`=$item_id,
                    `file_name`='$img_saved'
            ");
        }
        
        if( $this->query( $q ) ) {
            return $link;
        } else {
            return false;
        }
    }
    //==============================================================================
    public function save_items_sort( $ajax_POST ) {
        $list = $ajax_POST['items_list'];
        foreach( $list as $sort=>$id ) {
            $q = "
                UPDATE 
                    `items` 
                SET 
                    `sort`=$sort
                WHERE 
                    `Id`=$id
            ";
            if( $this->query( $q ) ) {
                echo $sort.'=>'.$id.'; ';
            }
        }
    }
    //==============================================================================
    //===============================    USERS   ===================================
    //==============================================================================
    public function list_admin() {
        $users = array();
        $q_users = $this->query("
            SELECT * FROM
                `users`
            ORDER BY
                `Id`
            DESC
        ");
        if( $q_users->num_rows > 0 ) {
            while( $r = $q_users->fetch_assoc() ) {
                $_tmp = $r;
                if( empty( $_tmp['img'] ) ) {
                    $_tmp['img'] = 'no_avatar.jpg';
                }
                $users[] = $_tmp;
            }            
        }
        return $users;
    }
    //==============================================================================
    public function isset_user( $email ) {
        $q_user = $this->query("SELECT * FROM `users` WHERE `email`='$email'");
        if( $q_user->num_rows > 0 ) {
            return false;
        } else {
            return true;
        }
        
    }
    //==============================================================================
    public function save_user_data( $ajax_POST ) {
        $security = new Security();
       
        $id = false;
        $err = false;
        $data = array();
        
        if( isset( $ajax_POST['Id'] ) ) {
            $id = $ajax_POST['Id'];
            unset( $ajax_POST['Id'] );
        }
        
        foreach( $ajax_POST as $field=>$v ) {
            $v = urldecode( $v );
            switch( $field ) {
                case 'email':
                    if( $this->valid_email( $v, $id ) ) {
                        $data['email'] = $v;
                    } else {
                        $err[] = 'email';
                    }
                continue;
                    
                case 'name':
                    if( $this->check_length( $v, 2, 50 ) ) {
                        $data['name'] = $v;
                    } else {
                        $err[] = 'name';
                    }
                continue;

                case 'phone':
                    if( $this->check_length( $v, 10, 25 ) ) {
                        $data['phone'] = $v;
                    } else {
                        $err[] = 'phone';
                    }
                continue;
                
                case 'pass':
                    if( !$id || !empty( $v ) ) {
                        if( $this->check_length( $v, 5, 25 ) ) {
                            $data['pass'] = $v;
                        } else {
                            $err[] = 'pass';
                        }
                    }
                continue;
            }
        }        

        $data = compact( 'data', 'err' );
        
        $fields = '';
        if( empty( $data['err'] ) ) {
            foreach( $ajax_POST as $field=>$v ) {
                if( !empty( $v ) && $field != 'pass' && $field != 'img' ) {
                    $v = urldecode( $v );
                    $fields .= "`$field`='$v',";
                } else if( $field === 'pass' && !empty( $v ) ) {
                    //$2y$09$L1AY5i5LbZKkb.I7FtTNG.djntcc3GuMAK.RfBHbiUlLXDdcmtkmW - 1234567                    
                    $security = new Security();
                    $pass = $security->password_generate( $v );
                    $fields .= "`$field`='$pass',";
                } else if( $field === 'img' ) {
                    $v = urldecode( $v );
                    if( preg_match("#data:image/png;base64#", $v) ) {
                        if( $id ) {
                            $img = $this->query("SELECT `img` FROM `users` WHERE `Id`=$id")->fetch_assoc();
                            if( !empty( $img['img'] ) ){
                                unlink( WEB.'images/users/'.$img['img'] );    
                            }
                        }
                        $img = $this->base64ToImage(
                            WEB.'images/users/',
                            $v
                        );
                        $fields .= "`$field`='$img',";
                    }
                }
            }
            $fields = trim( $fields, "," );
            
            if( $id ){
                $q = $this->query("UPDATE `users` SET $fields WHERE `Id`=$id");
                if( $q ){ $data['success'] = 'ok'; }
            } else {
                $q = $this->query("INSERT INTO `users` SET `access`=1,$fields");
                if( $q ){ $data['success'] = 'ok'; }
            }
        }
        echo json_encode( $data );
    }
    //==============================================================================
    public function removeuser( $user_id ) {
        $img = $this->query("SELECT `img` FROM `users` WHERE `Id`=$user_id")->fetch_assoc();
        $q = $this->query("DELETE FROM `users` WHERE `Id`=$user_id");
        if( $q ) {
            if( !empty( $img['img'] ) ) {
                unlink( WEB.'images/users/'.$img['img'] );    
            }
            echo json_encode( array( 'success'=>'ok' ) );    
        }
    }
    //==============================================================================
    public function toggleroot( $user_id ) {
        $r = $this->query("SELECT `access` FROM `users` WHERE `Id`=$user_id")->fetch_assoc();
        if( $r['access'] ){
            $this->query("UPDATE `users` SET `access`=0 WHERE `Id`=$user_id");
        } else {
            $this->query("UPDATE `users` SET `access`=1 WHERE `Id`=$user_id");
        }
        echo json_encode( array( 'success'=>'ok' ) );
    }
    
    //==============================================================================
    //=============================     GALLERY     ================================
    //==============================================================================
    
    public function load_drop( $id=1, $array_files, $section ) {
        $single = true;
        if( is_array( $array_files['fileUpload']['name'] ) ) {
            $single = false;
        }        
        if( $single ) {
            $dir = $_SERVER['DOCUMENT_ROOT'].'/web/images/gallery/'.$section;
            $file_name = $array_files['fileUpload']['tmp_name'];

            if( is_uploaded_file( $file_name ) ) {  
                $file_type = explode( "/", $array_files['fileUpload']['type'] )[1];
                $image_type = getimagesize($file_name)[2];
                
                if( !is_dir( $dir.'/' ) ) {
				    mkdir( $dir.'/' );                    
                }
                if( !is_dir( $dir.'/thumbs_img/' ) ) {
                    mkdir( $dir.'/thumbs_img/' );
                }
                
                $this->query("INSERT INTO `images` SET `published`=1, `gallery_id`=$id ");
                $insert_id = $this->insert_id;
                $file_tmp_name = $insert_id;
                
                $f_name = $section.'_'.$file_tmp_name.'.'.$file_type;
                                
                //$file_name = $section.'_'.$file_tmp_name.'.'.$file_type;                
                //$img->save($dir.'/'.$file_name, $image_type, 100 );
                if( move_uploaded_file( $file_name, $dir.'/'.$f_name ) ) {
                    $img = new SimpleImage();
                    $img->load( $dir.'/'.$f_name );                
                    //Размер обрезки thumbs img                
                    $img->scale(50);                
                    $thumbs_file_name = $section.'_thumbs_'.$file_tmp_name.'.jpeg';
                    //Качество thumbs img
                    $img->save($dir.'/thumbs_img/'.$thumbs_file_name, 2, 100 );                    
                }
                if( file_exists( $dir.'/thumbs_img/'.$thumbs_file_name ) ) {
                    //if( !empty( $thumbs_file_name ) && !empty( $f_name ) ) {
                        if( $this->query("
                            UPDATE 
                                `images` 
                            SET 
                                `file_name`='$f_name', 
                                `thumbs`='$thumbs_file_name' 
                            WHERE 
                                `Id`=$file_tmp_name 
                        ") ) {
                            
                        } else {
                            echo "
                                UPDATE 
                                    `images` 
                                SET 
                                    `file_name`='$f_name', 
                                    `thumbs`='$thumbs_file_name' 
                                WHERE 
                                    `Id`=$file_tmp_name 
                            ";
                        }
                        
                    //}
                } else {
                    $this->query("DELETE FROM `images` WHERE `Id`=$insert_id");
                    unlink( $dir.'/'.$f_name );
                }
                
                return $section;
            } else {
                echo 'err_save_tmp';
            }
        } else {
            //print_r($array_files);
            echo 'multpl';
        }
    }
    //==============================================================================
	public function gallery_save_image( $post ) {
        //print_r($post);
        //exit;
        
		$id = $post['Id'];
        $img = $post['img'];
		$section = urldecode($post['section']);        
		$published = $post['published'];		
		$name = urldecode($post['name']);        
		
        $section = $this->real_escape_string($section);
		$r = $this->query("SELECT * FROM `gallery` WHERE `name`='$section'")->fetch_assoc();
		$section_id = $r['Id'];
        
        $file_name = false;		
		if( preg_match("#data:image/#", $img) ) {
			if( !is_dir( WEB.'images/gallery/'.$section.'/' ) ) {
				mkdir( WEB.'images/gallery/'.$section.'/' );
			}
			$img_name = $this->base64ToImage(
				WEB.'images/gallery/'.$section.'/',
				$img
			);            
            
            $img = new SimpleImage();
            $img->load( WEB.'images/gallery/'.$section.'/'.$img_name );
            
            $r_img = $this->query("SELECT * FROM `images` WHERE `Id`=$id")->fetch_assoc();            
            
            $image_type = getimagesize(WEB.'images/gallery/'.$section.'/'.$img_name)[2];
            $img->save( WEB.'images/gallery/'.$section.'/'.$r_img['file_name'], $image_type, 100 );
            
            $img->scale(35);
            $img->save( WEB.'images/gallery/'.$section.'/thumbs_img/'.$r_img['thumbs'], 2, 80 );
            
            unlink( WEB.'images/gallery/'.$section.'/'.$img_name );
            
            $img_name = $r_img['file_name'];
            $file_name = " `file_name`='$img_name', ";
            sleep(1);
		}
        
        if( ( (int)$id < 0 ) && $file_name ) {
    		$q = $this->query("
    			INSERT INTO 
    				`images` 
    			SET 
    				`name`='$name',
    				`published`=$published,
                    $file_name
    				`gallery_id`='$section_id'
    		");            
        } else {
    		$q = $this->query("
    			UPDATE 
    				`images` 
    			SET 
    				`name`='$name',
    				`published`=$published,
                    $file_name
    				`gallery_id`='$section_id'
                WHERE
                    `Id`=$id
    		");    
        }
        if( $q ) {
            return $section;    
        } else {
            return 'Err Admin_Model:360';
        }
		 
	}
    //==============================================================================
    public function gallery_save_gallery( $ajax_POST ) {
       
        (int)$id = (int)$ajax_POST['Id'];
        
        $users_id = '';
        if( isset( $ajax_POST['users_id'] ) ) {
            $users_id = $ajax_POST['users_id'];            
            $id_list = '';
            foreach( $users_id as $uid ) {
                $id_list .= $uid.',';
            }
            $id_list = trim( $id_list, ',' );
            $users_id = " `users_id`='$id_list', ";
        }

        $section = urldecode( $ajax_POST['section'] );
        $section = preg_replace( "/\s/", "_", $section );
        $section = $this->real_escape_string( $section );
        if( empty( $section ) ) {
            $last_id = $this->query("SELECT `Id` FROM `gallery` ORDER BY `Id` DESC LIMIT 0,1")->fetch_assoc();
            $section = 'new_gallery'.( (int)$last_id['Id'] + 1 );
        }
        (int)$published = $ajax_POST['published'];
        $gallery = $this->query("SELECT * FROM `gallery` WHERE `name`='$section'");
        
        if( $gallery->num_rows < 1 && $id < 1 ) {
    		$q = $this->query("
    			INSERT INTO 
    				`gallery` 
    			SET 
    				`name`='$section',
                    $users_id
    				`published`=$published
    		");             
        } else {            
            if( ( $id > 0 && $gallery->num_rows < 1 ) || (int)$gallery->fetch_assoc()['Id'] == $id ) {
                $old_section = $this->query("SELECT * FROM `gallery` WHERE `Id`=$id")->fetch_assoc()['name'];
                if( is_dir( WEB.'images/gallery/'.$old_section ) ) {
                    rename(
                        WEB.'images/gallery/'.$old_section,
                        WEB.'images/gallery/'.$section
                    );
                }
        		$q = $this->query("
        			UPDATE 
        				`gallery` 
        			SET 
        				`name`='$section',
                        $users_id
        				`published`=$published
                    WHERE
                        `Id`=$id
        		");
            } else {
                $q = true;
                //$section = 'Err Admin_Model:496';
                $section = 'duplicated';                
            }
        }
        if( $q ) {
            return $section;    
        } else {
            return 'Err Admin_Model:532';
        }
    }
	//==============================================================================
    public function editimage( $id ) {        
        $img = $this->query("SELECT * FROM `images` WHERE `Id`=$id")->fetch_assoc();
        $gallery_id = $img['gallery_id'];
        $gallery = $this->query("SELECT * FROM `gallery` WHERE `Id`=$gallery_id")->fetch_assoc();        
        $_img = 'images/gallery/'.$gallery['name'].'/'.$img['file_name'];
        $data = $img;
        $data['img'] = array( $_img );
        
        return $data;
    }
    //==============================================================================
    public function remove_gallery_items( $id ) {        
        $img = $this->query("SELECT * FROM `images` WHERE `Id`=$id")->fetch_assoc();
        $gallery_id = $img['gallery_id'];
        $gallery = $this->query("SELECT * FROM `gallery` WHERE `Id`=$gallery_id")->fetch_assoc();
        
        $count = $this->query("SELECT * FROM `images` WHERE `gallery_id`=$gallery_id");
        $count = $count->num_rows;
        
        if( $this->query("DELETE FROM `images` WHERE `Id`=$id") ) {
            $thumbs_file = $gallery['name'].'_thumbs_'.$id.'.jpeg';
            unlink( WEB.'images/gallery/'.$gallery['name'].'/'.$img['file_name'] );
            unlink( WEB.'images/gallery/'.$gallery['name'].'/thumbs_img/'.$thumbs_file );

            if( $count <= 1 ) {
                if( rmdir( WEB.'images/gallery/'.$gallery['name'].'/thumbs_img/' ) ) {
                    rmdir( WEB.'images/gallery/'.$gallery['name'].'/' );
                }
            }
            return array( 'section'=>$gallery['name'] );
        } else {
            return false;
        }
    }
    //==============================================================================
    public function removegallery( $id ) {        
        $id = $this->real_escape_string( $id );        
        if( is_numeric( $id ) ) {
            $section = $this->query("SELECT * FROM `gallery` WHERE `Id`=$id")->fetch_assoc();
        } else {
            $section = $this->query("SELECT * FROM `gallery` WHERE `name`='$id'")->fetch_assoc();
            $id = $section['Id'];
        }
        $section = $section['name'];
        
        $q = $this->query("DELETE FROM `gallery` WHERE `Id`=$id");                
        if( $q ) {
            $q = $this->query("
                SELECT 
                    `file_name`, 
                    `Id` 
                FROM
                    `images`
                WHERE
                    `gallery_id`=$id
            ");
            $c=0;
            $rows = $q->num_rows;
            while( $img = $q->fetch_assoc() ) {
                if( unlink( WEB.'images/gallery/'.$section.'/'.$img['file_name'] ) ) {
                    
                    $thumbs_file = $section.'_thumbs_'.$img['Id'].'.jpeg';
                    unlink( WEB.'images/gallery/'.$section.'/thumbs_img/'.$thumbs_file );
                    
                    $this->query("DELETE FROM `images` WHERE `Id`=$img[Id]");
                }
                if( $c == ( $rows-1 ) ) {
                    rmdir( WEB.'images/gallery/'.$section.'/thumbs_img/' );
                    rmdir( WEB.'images/gallery/'.$section.'/' );
                }
                $c++;
            }
            return true;
        } else {
            return false;
        }
    }
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
}
?>