<?php
//if (!defined('FVN_AJAX_BLOG_URL')) define('FVN_AJAX_BLOG_URL', site_url('/wp-content/themes/web-khoi-nghiep/shortcodes'));

add_shortcode('fvn-latest-blog', function ($atts) {
	$offset = (int)$atts['offset'];
	$limit = $atts['limit'] ? $atts['limit'] : 8;
	$popular = $atts['popular'];
	$get_user = $atts['get_user'];
	$get_comment = $atts['comment'];
	
	
	if(is_singular()){
		$categories = get_the_category();
	}else{
		$categories = [get_category( get_query_var( 'cat' ) )];
	}
	
	
	if(!$categories || ($categories && $categories[0]->slug!='blog')){
		$exclude_category = get_category_by_slug('blog');
	}
	


	$args = array(
		'posts_per_page' => $limit,
		'offset' => $offset
	);
	if($exclude_category){
		$args['category__not_in'] = [$exclude_category->term_id];
	}else{
		$args['cat'] = $categories[0]->term_id;
	}
	if($popular){
		$args['orderby'] = 'desc';
		$args['meta_key'] = 'count_view';
	}
	$posts = get_posts($args);

	if (count($posts) == 0) {
		return '';
	}
	//$postCats = FvnLatestBlogShortcode::getTermsFromPost($postIds);
	//$postCats = FvnLatestBlogShortcode::mapCatWPost($postCats, $cats);
	$users = FvnLatestBlogShortcode::getUser($posts);	
	$column = $atts['column'] ? $atts['column'] : 1;
	$space = 'xsmall';
	$childStyle = 'vertical';
	
	ob_start();
?>
	
		<div class="fvn-ajax-blog" >

			<div class="fvn-blog-content row large-columns-1 medium-columns-1 small-columns-1 row-medium">

			
			<div class="col">
				<div class="row large-columns-<?= $column ?> medium-columns-<?= $column ?> small-columns-1 row-<?= $space ?>">
					<?php for ($i = 0; $i < count($posts); $i++) {
						$post = FvnLatestBlogShortcode::convertPost($posts[$i]);
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
														<?php if($get_user){?>
															<span href="<?= get_author_posts_url($post->post_author) ?>" class=" mr-1"><i class="icon-user"></i><?= $users[$post->post_author]->user_nicename ?></span>
														<?php }?>
														<span><i class="icon-clock"></i><?= get_the_date(null, $post) ?></span>
													</div>
													<?php if($get_comment){?>
														<span><i class="icon-chat mr-1"></i><span class="commentcount" data-id="<?=$post->ID?>">0</span></span>
													<?php }?>
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
		</div>
		</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});


class FvnLatestBlogShortcode
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


