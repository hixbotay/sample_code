<?php
add_shortcode('fvn-product-table', function ($atts) {
	$products = explode(',', $atts['product']);
	$productIds = [];
	$productQuantities = [];
	foreach($products as $prd){
		$prd = explode('-', $prd);
		$productIds[] = $prd[0];
		$productQuantities[$prd[0]] = $prd[1];
	}
	if (!$atts['product']) {
		return '';
	}

	$args = array(
		'include' => $productIds
	);
	$posts = wc_get_products($args);

	if (count($posts) == 0) {
		return '';
	}

	$cart = $atts['cart'] ? $atts['cart'] : 1;
	ob_start();
?>
	<div class="table-is-responsive">
		<table id="tablepress-80" class="tablepress tablepress-id-80">
			<thead>
				<tr class="row-1 odd">
					<th class="column-1"><?= __('SN','flatsome')?></th>
					<th class="column-2"><?= __('Components Name','flatsome')?></th>
					<th class="column-3 text-nobreak"><?=__('Quantity','flatsome')?></th>
					<?php if($cart){?><th class="column-4"></th><?php }?>
				</tr>
			</thead>
			<tbody class="row-hover">
				<?php foreach ($posts as $i => $post) { 
					//debug($post);
					?>
					<tr class="row-2 even">
						<td class="column-1"><?= $i + 1 ?></td>
						<td class="column-2"><?= $post->name ?></td>
						<td class="column-3 text-center"><?= $productQuantities[$post->id]?></td>
						<?php if($cart){?>
						<td class="column-4">
							<a href="?add-to-cart=<?= $post->id ?>" data-quantity="<?=$productQuantities[$post->id]?>" class="add-to-cart-grid no-padding is-transparent product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart-btn mb-0" data-product_id="<?= $post->id ?>" data-product_sku="" aria-label="<?= $post->post_Title ?>" aria-describedby="" rel="nofollow"><?=__('Add to cart','flatsome')?></a>							
							
						</td>
						<?php }?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
});
