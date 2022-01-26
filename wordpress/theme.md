###Sample code for wordpress

Add contact button 
```
add_action('wp_footer',function(){
	?>
  <meta name="theme-color" content="#38b565" >

<div id="contact-tool" class="fvn-nav contact-nav">
	<div style="position:relative">
		<div  class="toggle-icon toggle-remove" onclick="jQuery('#contact-tool .toggle-icon').hide(); jQuery('#contact-tool .toggle-icon.mobile-toggle').show();"><i class="fa fa-remove"></i></div>
			
		<div  class="toggle-icon contact-item"><a href="https://zalo.me/0932098007" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/social/zalo.png" /></a></div>
		<div  class="toggle-icon contact-item"><a href="https://www.messenger.com/t/107459168218630" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/social/message.png" /></a></div>
		<div  class="toggle-icon contact-item"><a href="tel:0932098007" rel="nofollow" target="_blank">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/contact/phone-green.png" /></a></div>
		<div class="toggle-icon contact-item mobile-toggle"><a href="javascript:void(0)" onclick="jQuery('#contact-tool .toggle-icon').show();jQuery('#contact-tool .toggle-icon.mobile-toggle').hide();">
			<img src="https://raw.githubusercontent.com/hixbotay/icon/master/contact/chat-right.png" />
		</a></div>
	</div>
</div>

<style>
.fvn-nav {
    position: fixed;
    right: 16px;
    border-radius: 5px;
    width: auto;
    z-index: 9999;
    bottom: 12px;
    padding: 5px 0 0 0;
}

.fvn-nav .contact-item a {
    border: none;
    padding: 3px;
    display: block;
    border-radius: 5px;
    text-align: center;
    font-size: 10px;
    line-height: 15px;
    color: #515151;
    font-weight: 700;
    max-width: 72.19px;
    max-height: 54px;
    text-decoration: none;
}
.fvn-nav .contact-item img{
    max-width: 40px;
    max-height: 40px;
    display: block;
}

.fvn-nav {
  -webkit-animation: glowing 1500ms infinite;
  -moz-animation: glowing 1500ms infinite;
  -o-animation: glowing 1500ms infinite;
  animation: glowing 1500ms infinite;
}
#contact-tool .mobile-toggle img{
  animation: slideup 1s ease-in-out infinite;
}
@keyframes slideup {
  0%,
  100% {
    max-width:35px
  }

  50% {
    max-width:37px
  }
}
#contact-tool .mobile-toggle{display:none}
#contact-tool .toggle-icon.toggle-remove{
	    display: none;
    position: absolute;
    top: -4px;
    right: -4px;
    border: 1px solid #ccc !important;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    font-size: 9px;
    line-height: 16px;
    padding: 0;
    text-align: center;
    color: white;
    background: red;
}
.back-to-top {
    bottom: 152px;
    right: 18px;
}
@media (max-width: 740px){
	#contact-tool .toggle-icon{display:none}
	#contact-tool .mobile-toggle{display:block}
	
}
</style>
	<?php
});
```
