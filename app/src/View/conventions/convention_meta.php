<?php
global $post;
$conv_meta = get_convention_data($post);
$conf = get_associated($post->ID, 'conferences');
$exhibitors = get_associated($post->ID, 'exhibitorslist');
?>
<div class="article__meta">
    <h5 class="text-light"><?=sprintf(__('Du %s au %s'),$conv_meta['date_start'], $conv_meta['date_end'])?></h4>
    <span class="d-block text-light"><i class="fas fa-map-marker-alt"></i> <?=$conv_meta['location_name']?></span>
		<?php if($conf): ?>
			<a class="btn btn-info card-link my-4" href="<?=get_post_permalink($conf->ID)?>">Les conférences</a>
		<?php endif; ?>
		<?php if($exhibitors): ?>
			<a class="btn btn-info card-link my-4" href="<?=get_post_permalink($exhibitors->ID)?>">Les exposants</a>
		<?php endif; ?>
</div>
