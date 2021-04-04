<?php
class Index_Controller extends Controllers {
    public function init() {
		$data['user'] = $this->user;
        $this->tmpl("page/main", $data );
    }
}