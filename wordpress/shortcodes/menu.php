<?php
add_shortcode('fvn-menu', function ($atts) {
	$menu_name = $atts['menu'] ? $atts['menu'] : 'footer';
	if(!$menu_name){return 'Please add a menu with attribue menu="your-menu-slug"';}
	//if(get_locale() == 'en_GB')$menu_name = 'footer___en';
	$menu = wp_get_nav_menu_object($menu_name);
	$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'ASC' ) );
	//debug($menuitems);
	
	ob_start(); ?>
		<ul class="d-flex nav fvn-menu-<?=$menu_name?>">
			<?php foreach( $menuitems as $item ){
			if($item->menu_item_parent!=0){
			}?>
			<li id="menu-item-1398" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-1398 menu-item-design-default <?=implode(' ',$item->classes)?>"><a href="<?=$item->url?>" class="nav-top-link"><?= $item->title?></a></li>
			<?php }?>
		</ul>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});
