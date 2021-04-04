<?
if( empty( $this->data['route'] ) ) {
    $this->data['route'] = 'main';
}
$route = preg_replace( "/\?.*/", "", $this->data['route'] );
${$this->data['route']} = true;
//var_dump($main);
?>

<!-- Head -->
<?php include (VIEWS."include/head.php"); ?>

<!-- Header -->
<?php include (VIEWS."include/header_main.php"); ?>
<?php //include (VIEWS."include/header_page.php"); ?>

<?=$this->render_content();?>	

<!-- footer -->
<?php include (VIEWS."include/footer.php"); ?>