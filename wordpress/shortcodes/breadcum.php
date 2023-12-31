<?php
add_shortcode('fvn-breadcum',function ($atts) {	
	ob_start();?>
	<div class="intro hidden-phone mt-3 non-print">
        <div class="row">
            <div class="col small-12 red">
                <div class="box intro-bg">
					<img class="img" src="<?= FVN_THEME_URL?>/images/bg-intro-border-2.png" alt="">
					<div class="text ">
						<a class="red" href="<?=$atts['l1']?>"><?= __($atts['t1'],'flatsome-child')?> <?php if($atts['t2']){?>/<?php }?> </a>
						<?php if($atts['t2']){?><a href="<?=$atts['l2']?>" class="orange"><?= __($atts['t2'],'flatsome-child')?> <?php if($atts['t3']){?>/<?php }?> </a><?php }?>
						<?php if($atts['t3']){?><a href="#" class="light-orange"><?= __($atts['t3'],'flatsome-child')?></a><?php }?>
					</div>
                </div>
            </div>
        </div>

    </div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

});
