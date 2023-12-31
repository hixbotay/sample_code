# Sample code theme
```
if(!defined('FVN_THEME_URL')) define('FVN_THEME_URL', site_url('/wp-content/themes/freelancerviet.net/'));
if(!defined('FVN_THEME_PATH')) define('FVN_THEME_PATH', __DIR__);

if(isset($_GET['error_detail'])){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
}else{
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
}
//short code
foreach (glob(FVN_THEME_PATH.'/shortcodes/*.php') as $filename)
{
	require_once $filename;
}
//disable new editor
add_filter('use_block_editor_for_post','__return_false');
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'pre_site_transient_update_core', '__return_null' );
```
