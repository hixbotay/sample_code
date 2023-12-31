<?php
add_shortcode('fvn-category', function ($atts) {
	if (!$atts['cat']) {
		return '';
	}

	$term = $atts['term'] ? $atts['term'] : 'category';
	$cats = (new WP_Term_Query([
		'taxonomy' => $term,
		'slug' => explode(',', $atts['cat']),
		'hide_empty' => false,
		'fields' => 'all'
	]))->get_terms();

	ob_start();
?>
	<div class="menu-sidebar-article-category-container">
		<ul id="menu-sidebar-article-category" class="menu">
			<?php foreach($cats as $cat){?>
			<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1079 d-flex justify-content-between"><a href="<?=get_term_link($cat->term_id)?>"><?=$cat->name?></a><span class="cat-counter"><?=(int)$cat->count?></span></li>
			<?php }?>
		</ul>
	</div>
	<style>
		.cat-counter{
			display: inline-block;
			background-color: var(--primary-color);
			text-align: center;
			font-size: 12px;
			padding: 0 5px;
			min-width: 24px;
			height: 22px;
			line-height: 22px;
			color: white;
			border-radius: 2px;
			transition: box-shadow .6s cubic-bezier(.165, .84, .44, 1);
		}
	</style>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});
