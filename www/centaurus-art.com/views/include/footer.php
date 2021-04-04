    <!-- Ajax modal loading -->
    <div id="ajax_modal_content"></div>
    
	<!-- Ajax Preloader gallery img  -->
    <div id="ajax_progress" class="preloader-wrap" style="display:none">
        <span>100%</span>        
	    <!-- loader -->
        <div class='cssload-loader main-preloader'>
			<div class='cssload-inner cssload-one'></div>
			<div class='cssload-inner cssload-two'></div>
			<div class='cssload-inner cssload-three'></div>
		</div>    
		<!-- <div class="main-preloader"></div> -->
	</div>
    
    <!-- Ajax Preloader modal window -->
    <div id="ajax_preloader" class="preloader-wrap" style="display:none"> 
        <span style="display:none"></span>
        <!-- loader -->
        <div class='cssload-loader main-preloader'>
			<div class='cssload-inner cssload-one'></div>
			<div class='cssload-inner cssload-two'></div>
			<div class='cssload-inner cssload-three'></div>
		</div>    
   <!-- <div class="main-preloader"></div> -->
    </div>
    
    <!-- Confirm -->
    <? require_once (VIEWS."popup/confirm.php"); ?>
    
	<footer>
		<div class="footer-wrap">
			<span class="footer-contact flex">
				<a class="partners-btn f-btn" href="/partners">Partners</a>
				<a class="f-contact-btn f-btn" href="/contact">Contact</a>
<!-- 				<a class="donate-btn f-btn" href="/donate">Donate</a> -->
				<a class="donate-btn f-btn" href="https://coingate.com/pay/visionariumfestival" rel="noopener noreferrer nofollow" target="_blank"><img alt="CoinGate Payment Button" src="/img/bitcoin-donation-button.png"></a>
			</span>
		</div>			
	</footer>
	
	<!-- Background iamage -->
	<div id="bg_fixed" class="bg-img-wrap c-page" data-speed="5" data-type="background">
		<img class="main-bg-img" src="/img/centaurus_bg.jpg" alt="Visionarium">
	</div>
   
	<!-- Icon fonts styles -->
	<link rel="stylesheet" href="/fonts/fontello/css/fontello.css">	
	   
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<!-- All scripts js -->
	<script src="/js/main.js"></script>  
		
	<!-- Schema -->
	<div class="dn" itemscope="" itemtype="https://schema.org/Organization">
		<meta itemprop="name" content=" «Centaurus Art»">
		<meta itemprop="description" content="We would like to invite you to a magnificent art event Visionarium  art festival">
		<img itemprop="logo" src="/img/logo.png" alt="Logo">
		<link itemprop="url" href="/">	
		<meta itemprop="telephone" content="+7(495) 510-97-83">
		<meta itemprop="email" content="visionariumartfestival@gmail.com">			 
		<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
			<meta itemprop="streetAddress" content="Diseminado Afueras Torrelles de Foix">
			<meta itemprop="postalCode" content="111111">
			<meta itemprop="addressLocality" content="Russia Vyazma">
		</div>		
	</div>		
	
</body>
</html>