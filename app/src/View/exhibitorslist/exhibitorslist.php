<?php
global $post;
$kioks = carbon_get_post_meta($post->ID, 'exhibitors');
usort($kioks, function($a, $b) {
    return $a['kiosk'] <=> $b['kiosk'];
});
?>
<div class="kiosk-wrapper">
<?php
foreach ($kioks as $kiosk):
  ?>
  <div class="kiosk my-5 bg-light rounded wow slideInLeft" id="kiosk<?=$kiosk['kiosk']?>">
    <div class="kiosk-exhibitor text-center p-5 bg-gradient rounded">
      <?php foreach ($kiosk['exposants'] as $exhibitor):
        $exid = $exhibitor['id'];?>
        <?= wp_get_attachment_image(carbon_get_post_meta($exid, 'picture'))?>
        <h4 class="text-bold text-center my-3 text-white"><?=carbon_get_post_meta($exid,'firstname')?> <?=carbon_get_post_meta($exid,'lastname')?></h4>
        <a href="<?=get_post_permalink($exid)?>" class="btn btn-info btn-small">Rejoindre</a>
      <?php endforeach; ?>
    </div>
    <div class="kiosk-info p-4">
      <div class="text-center py-3 mt-3">
        <span class="text-secondary">Kiosque #<?=$kiosk['kiosk']?></span>
        <h2 class="text-primary"><?=$kiosk['kiosk_title']?></h2>
      </div>
      <p><?=$kiosk['kiosk_description']?></p>
    </div>
  </div>
<?php endforeach; ?>
</div>