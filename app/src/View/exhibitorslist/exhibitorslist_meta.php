<?php
global $post;
$conf_id = carbon_get_post_meta($post->ID, 'convention')[0]['id'];
?>
<div class="article__meta">
		<?php if(!empty($conf_id)): ?>
			<a class="btn btn-info my-4" href="<?=get_post_permalink($conf_id)?>">Voir le salon</a>
		<?php endif; ?>
</div>
