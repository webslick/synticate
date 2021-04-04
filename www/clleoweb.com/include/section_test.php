<style>
	/* Test */
	.section-test {
		background: #eee;
		min-height: 300px;
	}
	.world {
		left: -20px;
		position: relative;
		margin: auto;
		-webkit-transform: rotateY(30deg) rotate(-45deg) translate(-100px,100px);
		transform: rotateY(30deg) rotate(-45deg) translate(-100px,100px);
		-webkit-transform-origin: center center;
		transform-origin: center center;
		transform-style: preserve-3d
	}
	
	.world,.world .container {
		text-align: center;
		-webkit-transform-style: preserve-3d
	}
	
	.world .container {
		width: 100%;
		transform-style: preserve-3d;
		-webkit-animation: b 12s linear infinite;
		animation: b 12s linear infinite;
		font-size: 90px;
	}
	
	.world .container:nth-of-type(20) {
		-webkit-animation-duration: 160s;
		animation-duration: 160s
	}
	
	.world .container:nth-of-type(19) {
		-webkit-animation-duration: 152s;
		animation-duration: 152s
	}
	
	.world .container:nth-of-type(18) {
		-webkit-animation-duration: 144s;
		animation-duration: 144s
	}
	
	.world .container:nth-of-type(17) {
		-webkit-animation-duration: 136s;
		animation-duration: 136s
	}
	
	.world .container:nth-of-type(16) {
		-webkit-animation-duration: 128s;
		animation-duration: 128s
	}
	
	.world .container:nth-of-type(15) {
		-webkit-animation-duration: 120s;
		animation-duration: 120s
	}
	
	.world .container:nth-of-type(14) {
		-webkit-animation-duration: 112s;
		animation-duration: 112s
	}
	
	.world .container:nth-of-type(13) {
		-webkit-animation-duration: 104s;
		animation-duration: 104s
	}
	
	.world .container:nth-of-type(12) {
		-webkit-animation-duration: 96s;
		animation-duration: 96s
	}
	
	.world .container:nth-of-type(11) {
		-webkit-animation-duration: 88s;
		animation-duration: 88s
	}
	
	.world .container:nth-of-type(10) {
		-webkit-animation-duration: 80s;
		animation-duration: 80s
	}
	
	.world .container:nth-of-type(9) {
		-webkit-animation-duration: 72s;
		animation-duration: 72s
	}
	
	.world .container:nth-of-type(8) {
		-webkit-animation-duration: 64s;
		animation-duration: 64s
	}
	
	.world .container:nth-of-type(7) {
		-webkit-animation-duration: 56s;
		animation-duration: 56s
	}
	
	.world .container:nth-of-type(6) {
		-webkit-animation-duration: 48s;
		animation-duration: 48s
	}
	
	.world .container:nth-of-type(5) {
		-webkit-animation-duration: 40s;
		animation-duration: 40s
	}
	
	.world .container:nth-of-type(4) {
		-webkit-animation-duration: 32s;
		animation-duration: 32s
	}
	
	.world .container:nth-of-type(3) {
		-webkit-animation-duration: 24s;
		animation-duration: 24s
	}
	
	.world .container:nth-of-type(2) {
		-webkit-animation-duration: 16s;
		animation-duration: 16s
	}
	
	.world .container:first-of-type {
		-webkit-animation-duration: 8s;
		animation-duration: 8s
	}
	
	.world .container>* {
		position: absolute;
		left: 0
	}
	
	.world .container>:nth-of-type(20) {
		-webkit-transform: rotateY(1turn) translateZ(180px);
		transform: rotateY(1turn) translateZ(180px)
	}
	
	.world .container>:nth-of-type(19) {
		-webkit-transform: rotateY(342deg) translateZ(180px);
		transform: rotateY(342deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(18) {
		-webkit-transform: rotateY(324deg) translateZ(180px);
		transform: rotateY(324deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(17) {
		-webkit-transform: rotateY(306deg) translateZ(180px);
		transform: rotateY(306deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(16) {
		-webkit-transform: rotateY(288deg) translateZ(180px);
		transform: rotateY(288deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(15) {
		-webkit-transform: rotateY(270deg) translateZ(180px);
		transform: rotateY(270deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(14) {
		-webkit-transform: rotateY(258deg) translateZ(190px);
		transform: rotateY(258deg) translateZ(190px)
	}
	
	.world .container>:nth-of-type(13) {
		-webkit-transform: rotateY(234deg) translateZ(180px);
		transform: rotateY(234deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(12) {
		-webkit-transform: rotateY(216deg) translateZ(180px);
		transform: rotateY(216deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(11) {
		-webkit-transform: rotateY(200deg) translateZ(182px);
		transform: rotateY(200deg) translateZ(182px)
	}
	
	.world .container>:nth-of-type(10) {
		-webkit-transform: rotateY(190deg) translateZ(180px);
		transform: rotateY(190deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(9) {
		-webkit-transform: rotateY(160deg) translateZ(171px);
		transform: rotateY(160deg) translateZ(171px)
	}
	
	.world .container>:nth-of-type(8) {
		-webkit-transform: rotateY(141deg) translateZ(175px);
		transform: rotateY(141deg) translateZ(175px)
	}
	
	.world .container>:nth-of-type(7) {
		-webkit-transform: rotateY(125deg) translateZ(169px);
		transform: rotateY(125deg) translateZ(169px)
	}
	
	.world .container>:nth-of-type(6) {
		-webkit-transform: rotateY(104deg) translateZ(172px);
		transform: rotateY(104deg) translateZ(172px)
	}
	
	.world .container>:nth-of-type(5) {
		-webkit-transform: rotateY(87deg) translateZ(187px);
		transform: rotateY(87deg) translateZ(187px)
	}
	
	.world .container>:nth-of-type(4) {
		-webkit-transform: rotateY(72deg) translateZ(180px);
		transform: rotateY(72deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(3) {
		-webkit-transform: rotateY(54deg) translateZ(180px);
		transform: rotateY(54deg) translateZ(180px)
	}
	
	.world .container>:nth-of-type(2) {
		-webkit-transform: rotateY(34deg) translateZ(180px);
		transform: rotateY(34deg) translateZ(180px)
	}
	
	.world .container>:first-of-type {
		-webkit-transform: rotateY(12deg) translateZ(180px);
		transform: rotateY(12deg) translateZ(180px)
	}
	@-webkit-keyframes b {
		0% {
			-webkit-transform: rotateY(0deg);
			transform: rotateY(0deg)
		}
	
		to {
			-webkit-transform: rotateY(-1turn);
			transform: rotateY(-1turn)
		}
	}
	
	@keyframes b {
		0% {
			-webkit-transform: rotateY(0deg);
			transform: rotateY(0deg)
		}
	
		to {
			-webkit-transform: rotateY(-1turn);
			transform: rotateY(-1turn)
		}
	}
</style>
<section class="section-test">
	<div class="section-test--content flex jc">
		<!-- Test -->
		<div class="world">
			<div class="f-medium container">
				<span>S</span>
				<span>y</span>
				<span>n</span>
				<span>t</span>
				<span>i</span>
				<span>k</span>
				<span>a</span>
				<span>t</span>
				<span>e</span>
				<span> </span>
				<span>T</span>
				<span>e</span>
				<span>a</span>
				<span>m</span>
				<span> </span>
			</div>
		</div>
	</div>
</section>
