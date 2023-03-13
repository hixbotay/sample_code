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
Disable update notification for plugin
```
add_filter( 'site_transient_update_plugins', function ( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
} );
```
Query
```
$args = array(
	'post_type'  => 'my_custom_post_type',
	'meta_key'   => 'age',
	'orderby'    => 'meta_value_num',
	'order'      => 'ASC',
    's' => 'keyword',
    'posts_per_page' => 10,
	'meta_query' => array(
		array(
			'key'     => 'age',
			'value'   => array( 3, 4 ),
			'compare' => 'IN',
		),
	),
    'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => array( 'quotes' ),
		),
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote' ),
		),
	),
);
$items = (new WP_Query( $args ))->get_posts();
```
