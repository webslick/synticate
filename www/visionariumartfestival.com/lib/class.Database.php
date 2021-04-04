<?php
class Database extends Mysqli {
    public function __construct( $db_host = HOST, $db_user = USERNAME, $db_pass = PASS, $db_name = DB ) {
        parent::__construct( $db_host, $db_user, $db_pass, $db_name );
    }
}