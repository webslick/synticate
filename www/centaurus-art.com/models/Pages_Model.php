<?
class Pages_Model extends Models {
    
    public function get_items( $page, $published=false ) {
        $items = array();
        $q_published = NULL;
        if( $published != true ) {
            $q_published = " AND `published`=1 ";
        }
        $q_item = $this->query("
            SELECT
                `items`.Id,
                `items`.type,
                `items`.name,
                `items`.content,
                `items`.content_href,
                `items`.gallery_href
            FROM
                `pages`,
                `items`
            WHERE
                `items`.pages_id = `pages`.Id
            $q_published
            AND
                `pages`.name='$page'
            ORDER BY
                `items`.sort
            ASC, 
                `items`.Id 
            DESC 
        ");
        while( $item = $q_item->fetch_assoc() ) {
            $q_img = $this->query("
                SELECT 
                    `file_name` AS img
                FROM 
                    `images` 
                WHERE 
                    `items_id`=$item[Id] 
                ORDER BY 
                    `Id` 
                DESC
            ");
            if( $q_img->num_rows > 0 ) {
                while( $images = $q_img->fetch_assoc() ) {
                    $item['img'][] = $images['img'];
                }                
            } else {
                $item['img'][] = 'no_img.jpg';    
            }
            $match = preg_match_all( "#{(.*)}#", $item['content'], $m );
            if( is_array( $m[1] ) ) {
                $c = 0;
                foreach( $m[1] as $k=>$v ) {
                    $str = $m[1][$c];
                    $arr = explode( "=", $str );
                    $item['content'] = str_replace( $m[0][$c], '<div class="art-text-block"><img class="scl-icon" src="/img/soundcloud-icon.png" alt="soundcloud-icon"><a class="scl-link" href="'.$arr[1].'" target="_blank">'.$arr[0].'</a></div>', $item['content'] );
                    $c++;        
                }                
            }
            $items[] = $item;
        }
        return $items;
    }
    //==============================================================================
    public function get_item( $id ) {
        $item = $this->query("
            SELECT
                `items`.Id,
                `items`.type,
                `items`.name,
                `items`.content
            FROM
                `items`
            WHERE
                `items`.Id = $id                
        ")->fetch_assoc();
        
        $q_img = $this->query("
            SELECT 
                `file_name` AS img
            FROM 
                `images` 
            WHERE 
                `items_id`=$item[Id] 
            ORDER BY 
                `Id` 
            DESC
        ");
        if( $q_img->num_rows > 0 ) {
            while( $images = $q_img->fetch_assoc() ) {
                $item['img'][] = $images['img'];
            }                
        } else {
            $item['img'][] = 'no_img.jpg';    
        }
        $items[] = $item;
        
        return $items;
    }
    //==============================================================================
    public function get_gallery_section( $GET, $show=false ) {
        $section = $this->real_escape_string( $GET['section'] );
        $sql = '';
        if( !$show ) {            
            $sql = " AND `published`=1 ";    
        }
        if( $this->query("SELECT * FROM `gallery` WHERE `name`='$section' $sql ")->num_rows > 0 ) {
            $q = $this->query("
                SELECT * FROM 
                    `images`
                WHERE 
                    `gallery_id` IN(
                        SELECT 
                            `Id`
                        FROM 
                            `gallery` 
                        WHERE 
                            `name`='$section'
                    )
                $sql
                ORDER BY 
                    `Id`
                DESC
            ");
            if( $q->num_rows > 0 ) {
                while( $r = $q->fetch_assoc() ) {
                    //$thmb = explode( "_", $r['file_name'] );
                    //$thumbs = $section.'_thumbs_'.$r['Id'].'.jpeg';
                    //$r['thumbs'] = $thumbs;
                    $out[] = $r;
                }
            } else {
                $out = array();
            }
            $out['images'] = $out;
            $out['gallery'] = $this->get_gallery( false, $show );
            $out['name'] = preg_replace( "/_/", " ", $section );
            $out['href'] = $section;
             
            return $out;
        } else {
            return false;
        }
    }
    //==============================================================================
    public function get_gallery($id=false, $show=false) {
        $sql = '';        
        if( $id ) {
            if( is_numeric( $id ) ) {
                $sql = " WHERE `Id`='$id' ";    
            } else {
                $sql = " WHERE `name`='$id' ";
            }
        }
        if( !$show && !$id ) {
            if( !empty( $sql ) ) {
                $sql = $sql." AND `published`=1 ";
            } else {
                $sql = " WHERE `published`=1 ";
            }   
        }
                
        $out = array();
        $q = $this->query("
            SELECT * FROM
                `gallery`
            $sql            
            ORDER BY
                `Id`
            DESC
        ");
        while( $r = $q->fetch_assoc() ) {
            $name = explode( "_", $r['name'] );
            if( is_array( $name ) ) {
                $r['href'] = $r['name'];
                $r['name'] = preg_replace( "/_/", " ", $r['href'] );
            }
            $out[] = $r;
        }
        return $out;
    }
    //==============================================================================
    //==============================================================================
    //==============================================================================
    //==============================================================================
}
?>