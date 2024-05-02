Popup
```
[button text="Lightbox button" link="#test"][lightbox id="test" width="600px" padding="20px"]Add lightbox content here...[/lightbox]
```
Auto popup
```
[lightbox id="test" width="500px" padding="0px" auto_open="true" auto_timer="3000" auto_show="once"]Add lightbox content here..[/lightbox]
```
Register key
```
if($_REQUEST['flatsome_active']){
	update_option( 'flatsome_wup_purchase_code', '99dcbf02-cd62-41d2-bf60-bf0d62d95d62' );
	update_option( 'flatsome_wup_supported_until', '01.01.2050' );
	update_option( 'flatsome_wup_buyer', 'Licensed' );
	update_option( 'flatsome_wup_sold_at', time() );
	delete_option( 'flatsome_wup_errors', '' );
	delete_option( 'flatsome_wupdates', '');
}
```
