<?php
if (!defined('FVN_AJAX_BLOG_URL')) define('FVN_AJAX_BLOG_URL', site_url('/wp-content/themes/web-khoi-nghiep/shortcodes'));

wp_enqueue_style('fvn-ajax-blog-style', FVN_AJAX_BLOG_URL . '/ajax-blog.css?v=1.1.1');

add_shortcode('fvn-ajax-blog', function ($atts) {
	if (!defined('FVN_SC_AJAX_BLOG')) define('FVN_SC_AJAX_BLOG', true);
	$offset = (int)$atts['offset'];
	$limit = $atts['limit'] ? $atts['limit'] : 4;
	$catslug = $atts['cat'];
	if($atts['subcat']){		
		$catslug .= ','.$atts['subcat'];
	}
	
	if ($catslug) {
		$allCats = (new WP_Term_Query([
			'taxonomy' => 'category',
			'slug' => explode(',', $catslug),
			'hide_empty' => false,
			'fields' => 'all'
		]))->get_terms();
	}
	//debug($allCats);
	if ($allCats) {
		$mapCats = [];
		foreach($allCats as $cat){
			$mapCats[$cat->slug] = $cat;
		}
		$cats = [];
		if($atts['cat']){
			foreach(explode(',', $atts['cat']) as $slug){
				if($mapCats[$slug])
					$cats[] = $mapCats[$slug];
			}
		}
		$subCats = [];
		if($atts['subcat']){
			foreach(explode(',', $atts['subcat']) as $slug){
				if($mapCats[$slug])
					$subCats[] = $mapCats[$slug];
			}
		}
		if (!$atts['title']) {
			$atts['title'] = $cats[0]->name;
		}
		if (!$atts['link']) {
			$atts['link'] = get_term_link($cats[0]);
		}
	}

	$args = array(
		'posts_per_page' => $limit,
		'cat' => $cats ? array_map(function ($e) {
			return $e->term_id;
		}, $cats) : [],
		'offset' => $offset
	);
	$posts = get_posts($args);

	if (count($posts) == 0) {
		return '';
	}
	$postIds = array_map(function ($e) {
		return $e->ID;
	}, $posts);
	$postCats = FvnAjaxBlogShortcode::getTermsFromPost($postIds);
	$postCats = FvnAjaxBlogShortcode::mapCatWPost($postCats, $cats);
	$users = FvnAjaxBlogShortcode::getUser($posts);

	$post = FvnAjaxBlogShortcode::convertPost($posts[0]);
	
	$column = $atts['column'] ? $atts['column'] : 1;
	$space = $atts['space'] ? $atts['space'] : 'xsmall';
	$type = $atts['type'] ? $atts['type'] : 'big-left-shade';
	$parentColumn = $atts['parentcolumn'] ? $atts['parentcolumn'] : 2;
	$firstHeight = $atts['firstheight'] ? "height: {$atts['firstheight']}" : '';
	$firstStyle = $atts['firststyle'] ? $atts['firststyle'] : 'shade';
	$childStyle = $atts['childstyle'] ? $atts['childstyle'] : 'vertical';
	$firstPadding = $atts['firstpadding'] ? $atts['firstpadding'] : '0 15px 30px';
	$atts['paginate'] = isset($atts['paginate']) ? $atts['paginate'] : 1;
	$first = isset($atts['first']) ? $atts['first'] : 1;
	$i=0;
	ob_start();
?>
	<?php if (!$atts['raw']) { ?>
		<div class="fvn-ajax-blog" data-shortcode='<?=json_encode($atts)?>'>
			<div class="headline d-flex justify-content-between">
				<h3><a href="<?= $atts['link'] ?>"><?= $atts['title'] ?></a> </h3>
				<div class="d-flex toolbar <?= $atts['paginate'] ? '' : 'hidden' ?>">
					<div class="filter-links d-flex list-style-none position-relative">
						<a href="javascript:void(0)" data-id="<?=$catslug?>" class="block-ajax-term block-all-term active text-nobreak">All</a>
						<?php foreach ($cats as $cat) {?>
							<a href="javascript:void(0)" data-id="<?= $cat->slug ?>" class="block-ajax-term text-nobreak"><?= $cat->name ?></a>					
						<?php } ?>
						<?php if($subCats){?>	
							<a href="javascript:void(0)" class="fvn-border-light active-submenu" onclick="jQuery(this).parent().find('.fvn-sub-menu').toggle()"><i class="icon-angle-down"></i>
							</a>	
							<div class="fvn-sub-menu position-absolute" style="display:none">
							<?php foreach ($subCats as $cat) {?>						
							<a href="javascript:void(0)" data-id="<?= $cat->slug ?>" class="block-ajax-term text-nobreak"><?= $cat->name ?></a>
							<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="slider-arrow-nav d-flex list-style-none">
						<a class="block-pagination prev-posts disabled text-nobreak" href="javascript:void(0)">
							<svg class="" viewBox="0 0 100 100">
								<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path>
							</svg>
						</a>
						<a class="block-pagination next-posts text-nobreak" href="javascript:void(0)">
							<svg class="" viewBox="0 0 100 100">
								<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path>
							</svg>
						</a>
					</div>
				</div>
			</div>

			<div class="fvn-blog-content row large-columns-<?= $parentColumn ?> medium-columns-<?= $parentColumn ?> small-columns-1 row-medium <?=$first?'':'non-first'?>">
			<?php } ?>

			<?php if ($first) { ?>
				<div class="col post-item first-item" style="padding: <?=$firstPadding?>">
					<div class="col-inner">
						<a href="<?= $post->link ?>" class="plain">
							<div class="box box-<?= $firstStyle ?> <?= $firstStyle == 'shade' ? 'dark' : '' ?> box-text-bottom box-blog-post has-hover">
								<div class="box-image">
									<div class="image-cover" style="<?= $firstHeight?>">
										<img src="<?= $post->thumbnail ?>" class="attachment-medium size-medium wp-post-image max-w-100" alt="">
										<div class="shade"></div>
									</div>
								</div>
								<div class="box-text text-left is-large">
									<div class="box-text-inner blog-post-inner">
										<?php if (count($postCats[$post->ID])) { ?>
											<p class="cat-label tag-label is-xxsmall op-7 uppercase">
												<?php foreach ($postCats[$post->ID] as $postCat) { ?>
													<span><?= $postCat->name ?></span>
												<?php } ?>
											</p>
										<?php } ?>
										<?php if($firstStyle != 'shade'){?>
										<div class="d-flex meta-toolbox justify-content-between">
											<div>
												<span href="<?= get_author_posts_url($post->post_author) ?>" class=" mr-1"><i class="icon-user"></i><?= $users[$post->post_author]->user_nicename ?></span>
												<span><i class="icon-clock"></i><?= get_the_date(null, $post) ?></span>
											</div>
											<span><i class="icon-chat mr-1"></i><span class="commentcount" data-id="<?=$post->ID?>">0</span></span>
										</div>
										<?php }?>
										<h5 class="post-title is-large "><?= $post->title ?></h5>

										<?php if($firstStyle == 'shade'){?>
										<div class="d-flex meta-toolbox justify-content-between">
											<div>
												<span href="<?= get_author_posts_url($post->post_author) ?>" class=" mr-1"><i class="icon-user"></i><?= $users[$post->post_author]->user_nicename ?></span>
												<span><i class="icon-clock"></i><?= get_the_date(null, $post) ?></span>
											</div>
											<span><i class="icon-chat mr-1"></i><span class="commentcount" data-id="<?=$post->ID?>">0</span></span>
										</div>
										<?php }?>

										<p class="from_the_blog_excerpt show-on-hover hover-reveal"><?= $post->post_excerpt ?></p>
										<?php if($firstStyle != 'shade'){?>
											<div>
												<button class="more-link button" href="<?= $post->link ?>">Read More » </button>
											</div>
										<?php }?>

									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
			<div class="col">
				<div class="row large-columns-<?= $column ?> medium-columns-<?= $column ?> small-columns-1 row-<?= $space ?>">
					<?php for ($i = ($first ? 1 : 0); $i < count($posts); $i++) {
						$post = FvnAjaxBlogShortcode::convertPost($posts[$i]);
					?>
						<div class="col post-item">
							<div class="col-inner">
								<a href="<?= $post->link ?>" class="plain">
									<div class="box box-<?= $childStyle ?> box-text-bottom box-blog-post has-hover">
										<div class="box-image" <?= $childStyle == 'vertical' ?  'style="width:30%;"' : '' ?>>
											<div class="image-cover">
												<img src="<?= $post->thumbnail ?>" class="attachment-medium size-medium wp-post-image" alt="" decoding="async" loading="lazy">
											</div>
										</div>
										<div class="box-text text-left is-xsmall">
											<div class="box-text-inner blog-post-inner">
												
												<div class="d-flex meta-toolbox justify-content-between">
													<div>
														<span href="<?= get_author_posts_url($post->post_author) ?>" class=" mr-1"><i class="icon-user"></i><?= $users[$post->post_author]->user_nicename ?></span>
														<span><i class="icon-clock"></i><?= get_the_date(null, $post) ?></span>
													</div>
													<span><i class="icon-chat mr-1"></i><span class="commentcount" data-id="<?=$post->ID?>">0</span></span>
												</div>

												<h5 class="post-title is-large "><?= $post->title ?></h5>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if (!$atts['raw']) { ?>
			</div>
			<?php if($atts['loadmore']){?>
				<div class="d-flex justify-content-center">
					<a href="javascript:void(0)" class="block-pagination show-more-button bg-primary text-primary-2 bg-secondary-hover text-secondary-hover-2">Load More</a>
				</div>
			<?php }?>
		</div>
	<?php } ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});

add_action( 'init', function () {
	if ($_REQUEST['fvn_action'] == 'fvn_ajax_blog') {
		$shortCode = $_REQUEST['shortcode'];
		$shortcodeTxt = '';
		foreach($shortCode as $k => $v){
			$shortcodeTxt .= "{$k} = '{$v}' ";
		}
		echo do_shortcode("[fvn-ajax-blog raw='1' {$shortcodeTxt}]");
		exit();
	}
	if($_REQUEST['fvn_action'] == 'count_comment_post'){
		$post_ids = $_REQUEST['post_ids'];
		if(!$post_ids){
			echo json_encode(['status'=>0]);die;
		}
		$result = [];
		foreach($post_ids as $post_id){
			
			if(!isset($result[$post_id])){
				$result[$post_id] = [
					'post_id' => $post_id,
					'view_count' => get_post_meta($post_id, 'count_view', true ),
					'comment_count' => get_comments_number($post_id)
				];
			}
			
		}
		echo json_encode(['status'=>1,'data' => $result]);die;
	}	
});


class FvnAjaxBlogShortcode
{
	static function mapCatWPost($terms, $cats)
	{
		$result = [];
		foreach ($terms as $term) {
			$termFilters = array_filter($cats, function ($cat) use ($term) {
				return $term->term_taxonomy_id == $cat->term_id;
			});
			if (count($termFilters)) {
				$result[$term->object_id][] = reset($termFilters);
			}
		}
		return $result;
	}

	static function getTermsFromPost($postIds)
	{
		global $wpdb;
		$terms = $wpdb->get_results(
			"SELECT tr.*
			FROM {$wpdb->term_relationships} AS tr
			INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
			WHERE tr.object_id IN (" . implode(',', $postIds) . ") AND taxonomy ='category'"
		);

		return $terms;
	}

	static function convertPost($post)
	{
		$post->thumbnail = get_the_post_thumbnail_url($post);
		$post->link = get_permalink($post);
		$post->title = $post->post_title;
		return $post;
	}

	static function getUser($posts)
	{
		global $wpdb;
		$userIds = array_map(function ($e) {
			return $e->post_author;
		}, $posts);
		$users = $wpdb->get_results(
			"SELECT *
			FROM {$wpdb->users} AS u
			WHERE u.ID IN (" . implode(',', $userIds) . ")"
		);
		foreach ($users as $u) {
			$result[$u->ID] = $u;
		}
		return $result;
	}
}

add_action('wp_footer', function () {
	 ?>
		<script>
			var siteUrl = '<?=site_url()?>';
			function fvnAjaxPostGetData(shortcode, elm, callback, loadmore){
				elm.addClass('loading');
				jQuery.ajax({
					type: "POST",
					url: siteUrl+'/index.php?fvn_action=fvn_ajax_blog',
					dataType: 'html',
					data: {
						shortcode: shortcode
					},
					success: function(res) {
						elm.attr('data-shortcode',JSON.stringify(shortcode));
						if(loadmore){
							elm.find('.fvn-blog-content').append(res);
						}else{
							elm.find('.fvn-blog-content').html(res);
						}
						elm.removeClass('loading');
						if(callback){
							callback(res);
						}
					}
				});
			}
			jQuery(document).ready(function($) {
				jQuery(document).click(function(event){
					 var $target = $(event.target);
					  if(!$target.closest('.fvn-ajax-blog .fvn-sub-menu').length && !$target.closest('.fvn-ajax-blog .active-submenu').length) {
						$('.fvn-sub-menu').hide();
					  }    
				});
				let arr_post = [];
				jQuery('.commentcount').each(function() {
					let id_post = jQuery(this).attr('data-id');
					if (id_post) {
						arr_post.push(id_post);
					}
				});
				console.log('arr post', arr_post);
				if (arr_post.length > 0) {
					jQuery.ajax({
						type: "POST",
						url: siteUrl+'/index.php?fvn_action=count_comment_post',
						dataType: 'json',
						data: {
							post_ids: arr_post
						},
						success: function(res) {
							console.log(res);
							jQuery('.fvn-blog-content .post-item').each(function() {
								let id_post = jQuery(this).find('.commentcount').attr('data-id');
								//console.log(id_post);
								if (res.data.hasOwnProperty(id_post)) {
									jQuery(this).find('.viewcount').html(res.data[id_post].view_count);
									jQuery(this).find('.commentcount').html(res.data[id_post].comment_count);
								}
							});
						}
					});
				}
				jQuery('.fvn-ajax-blog .next-posts').click(function(){
					let parent = jQuery(this).parents('.fvn-ajax-blog');
					let shortcode = JSON.parse(parent.attr('data-shortcode'));
					let offset = shortcode['offset'] ? parseInt(shortcode['offset']) : 0;
					let limit = shortcode['limit']?parseInt(shortcode['limit']):4;
					shortcode['offset'] = offset + limit;
					fvnAjaxPostGetData(shortcode,parent,function(res){
						parent.find('.prev-posts').removeClass('disabled');
						if(res.length == 0 || jQuery(res).find('.post-item').length < limit){
							parent.find('.next-posts').addClass('disabled');
							if(res.length == 0){
								parent.find('.fvn-blog-content').html('Not found');
							}
						}else{
						}
					});
				});
				jQuery('.fvn-ajax-blog .block-ajax-term').click(function(){
					let parent = jQuery(this).parents('.fvn-ajax-blog');
					let shortcode = JSON.parse(parent.attr('data-shortcode'));
					let offset = shortcode['offset'] ? parseInt(shortcode['offset']) : 0;
					let limit = shortcode['limit']?parseInt(shortcode['limit']):4;
					let cat = jQuery(this).attr('data-id');
					shortcode['offset'] = 0;
					shortcode['cat'] = cat;
					parent.find('.block-ajax-term').removeClass('active');
					jQuery(this).addClass('active');
					fvnAjaxPostGetData(shortcode,parent,function(res){
						parent.find('.prev-posts').addClass('disabled');
						parent.find('.next-posts').removeClass('disabled');
						if(res.length == 0){
							parent.find('.next-posts').addClass('disabled');
							if(res.length == 0){
								parent.find('.fvn-blog-content').html('Not found');
							}
						}
					});
				});
				jQuery('.fvn-ajax-blog .show-more-button').click(function(){
					let parent = jQuery(this).parents('.fvn-ajax-blog');
					let shortcode = JSON.parse(parent.attr('data-shortcode'));
					let offset = shortcode['offset'] ? parseInt(shortcode['offset']) : 0;
					let limit = shortcode['limit']?parseInt(shortcode['limit']):4;
					shortcode['offset'] = offset + limit;
					fvnAjaxPostGetData(shortcode,parent,function(res){
						if(res.length == 0 || jQuery(res).find('.post-item').length < limit){
							parent.find('.show-more-button').remove();
						}
					},true);
				});
				jQuery('.fvn-ajax-blog .prev-posts').click(function(){
					let parent = jQuery(this).parents('.fvn-ajax-blog');
					let shortcode = JSON.parse(parent.attr('data-shortcode'));
					let offset = shortcode['offset'] ? parseInt(shortcode['offset']) : 0;
					let limit = shortcode['limit']?parseInt(shortcode['limit']):4;
					if(offset==0){return;}
					shortcode['offset'] = offset - limit;
					if(shortcode['offset'] == 0){
						parent.find('.prev-posts').addClass('disabled');
					}
					
					fvnAjaxPostGetData(shortcode,parent,function(res){
						parent.find('.next-posts').removeClass('disabled');
					});
				});
			});
		</script>
	<?php 
});
