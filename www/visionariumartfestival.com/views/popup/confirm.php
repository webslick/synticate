<div id="confirm_popup" class="confirm-popap-wrap dn">
	<div class="confirm-popap">
		<div class="conf-title">Message</div>
		<div class="conf-btn flex sb">
			<span class="conf-ok">Yes</span>
			<span class="conf-no">Cancel</span>
		</div>
	</div>
</div><!-- END Confirm popap -->
<script>
function confirm_popup( title, callback ) {
    var obj = $("#confirm_popup").removeClass("dn");
    $(obj).find(".conf-title").html( title );
    $(obj).find(".conf-ok").on("click", function() {
        $(obj).addClass("dn");
        callback(true);
    });
    $(obj).find(".conf-no").on("click", function() {
        $(obj).addClass("dn");
    });
}
</script>	