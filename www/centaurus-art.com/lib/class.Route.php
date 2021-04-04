<?php
class Route {

    public function run( $route ) {

        $url = trim( $route, "/" );
        $segments_url = explode( "/", $url );
        $conf = null;

        $request_method = $_SERVER['REQUEST_METHOD'];
        if($request_method == 'POST') {
            // Method is POST
        } else if ($request_method == 'GET') {
            $segments_url = preg_replace( "/\?.*/", "", $segments_url );
            $segments_url = array_diff( $segments_url, array('') );
        } else if ($request_method == 'PUT') {
            // Method is PUT
        } else if ($request_method == 'DELETE') {
            // Method is DELETE
        } else {
            // Method unknown
        }
        if ( !isset( $segments_url[0] )) {
            $segments_url[0] = '';
        }
        
        switch ( $segments_url[0] ) {
            case '':
                $conf = 'index';
                break;
            case 'concept':
                $conf = 'concept/pages';
                break;
            case 'location':
                $conf = 'location/pages';
                break;
            case 'artists':
                $conf = 'artists/pages';
                break;
            case 'music':
                $conf = 'music/pages';
                break;
            case 'workshops':
                $conf = 'workshops/pages';
                break;
            case 'gallery':
                $conf = 'gallery/pages';
                break;
            case 'login':
                $conf = 'login/login';
                break;
            case 'admin':
                $conf = 'admin/admin';
                break;
            case 'partners':
                 $conf = 'partners/pages';
                break;
            case 'contact':
                $conf = 'contact/pages';
                break;
            case 'test':
                 $conf = 'test/pages';
                break;          
        }
        
        $segments_conf = explode("/", $conf );
        
        if( !empty( $segments_conf[0] )) {            
            $actions = array_merge(
                array_reverse( $segments_conf ),
                $segments_url
            );

            $controller_name_shift = array_shift( $actions );
            $controller_name = mb_convert_case( $controller_name_shift, MB_CASE_TITLE )."_Controller";

            include ( CONTROLLERS.$controller_name.".php" );
            $controller = new $controller_name( $actions );
            
            array_shift( $actions );
            if( !empty( $actions[0] ) ) {
                if( count( $actions ) > 1 ) {
                    $method = $actions[0].'_'.end( $actions );
                    if( $actions[0] == 'gallery' ) {
                        $method = 'gallery_users';    
                    }
                } else {
                    $method = $actions[0];
                }
                if( method_exists( $controller, $method ) ) {
                    $act = end( $actions );
                    $controller->$method( $act, $actions );
                } else {
                    header("HTTP/1.0 404 Not Found");
                    echo 'Err method: <strong>function '.$method.'(){}</strong> in <strong>'.$controller_name.'.php</strong>';                    
                    $layout = new Views();
                    $data = compact( 'route', 'action', 'actions' );
                    return $layout->render( VIEWS."page/page404.php", $data );
                }
            } else {
                $controller->init();
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            $layout = new Views();
            $data = compact( 'route', 'action' );
            return $layout->render( VIEWS."page/page404.php", $data );
        }
    }
}