# useful code for wordpress
Enable classic editor
```
add_filter('use_block_editor_for_post','__return_false');
```
Disable auto udpate
```
define( 'WP_AUTO_UPDATE_CORE', false );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
```
Limit post revision
```
define('WP_POST_REVISIONS', 2);
```
