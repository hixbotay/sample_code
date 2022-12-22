<?php
add_shortcode('fvn-donate', function ($atts) {
	ob_start();
    ?>
	<div id="contact-tool" class="fvn-nav contact-nav">
	<div style="position:relative">
		<div  class="toggle-icon toggle-remove" onclick="jQuery('#contact-tool .toggle-icon').hide(); jQuery('#contact-tool .toggle-icon.mobile-toggle').show();"><i class="fa fa-remove"></i></div>
			
		<?php if($atts['zalo']){?>
			<div  class="toggle-icon contact-item"><a href="https://zalo.me/<?=$atts['zalo']?>" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/social/zalo.png" /></a></div>
		<?php }?>
		<?php if($atts['facebook']){?>
		<div  class="toggle-icon contact-item"><a href="<?=$atts['facebook']?>" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/social/message.png" /></a></div>
		<?php }?>
		<?php if($atts['phone']){?>
		<div  class="toggle-icon contact-item"><a href="tel:<?=$atts['phone']?>" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/contact/phone-green.png" /></a></div>
		<?php }?>
		
		<div class="toggle-icon contact-item mobile-toggle"><a href="javascript:void(0)" onclick="jQuery('#contact-tool .toggle-icon').show();jQuery('#contact-tool .toggle-icon.mobile-toggle').hide();">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/contact/chat-right.png" />
		</a></div>
		
	</div>
</div>

</style>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});
