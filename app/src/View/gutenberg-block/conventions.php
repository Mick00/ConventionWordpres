<?php

$upcoming_conventions = get_posts([
  'numberposts'       => 4,
  'post_type'         => 'convention',
  'post_status'       => 'publish',
  'meta_query'        =>[
    [
      'compare'      => '>=',
      'key'          => '_start',
      'value'        => date('Y-m-d',time()-610800),
    ]
  ],
  'order'         => 'DESC',
  'order_by'      => 'meta_query',
]);
$conv_meta = get_convention_data($upcoming_conventions[0]);
$conv = $upcoming_conventions[0];
$conf = get_associated($conv->ID, 'conferences');
$exhibitors = get_associated($conv->ID, 'exhibitorslist');
?>

<div class="conventions-bloc d-flex flex-sm-column flex-md-row flex my-4">
  <div class="convention-main card">
    <?php if (!empty($conv_meta['thumbnail_url'])):?>
    <div class="card-img-top" style="background-image: url('<?=$conv_meta['thumbnail_url']?>')">
    </div>
    <?php endif;?>
    <div class="card-body">
      <h3 class="text-primary"> <a href="<?=get_post_permalink($conv)?>"><?=$conv->post_title?></a></h3>
      <h5><?=sprintf(__('Du %s au %s'),$conv_meta['date_start'], $conv_meta['date_end'])?></h4>
      <p class="card-text"><?=$conv->post_excerpt?></p>
      <span class="text-muted d-block"><i class="fas fa-map-marker-alt"></i> <?=$conv_meta['location_name']?></span>
      <?php if($conf): ?>
        <a class="btn btn-primary card-link my-4" href="<?=get_post_permalink($conf->ID)?>">Voir les conférences</a>
      <?php endif; ?>
      <?php if($exhibitors): ?>
        <a class="btn btn-secondary card-link my-4" href="<?=get_post_permalink($exhibitors->ID)?>">Voir les exposants</a>
      <?php endif; ?>
    </div>
  </div>

  <?php
  if (count($upcoming_conventions)>1):?>
  <div class="card convention-secondary ml-sm-0 mt-sm-4 mt-md-0 ml-md-4">
    <div class="card-header bg-primary text-light">
      <span class="text-bold">Aussi à venir</span>
    </div>
    <ul class="list-group list-group-flush">
      <?php for( $i = 1; $i < count($upcoming_conventions); $i++):
        $conv = $upcoming_conventions[$i];
        $conv_meta = get_convention_data($conv);
        $conf = get_associated($conv->ID, 'conferences');
        $exhibitors = get_associated($conv->ID, 'exhibitors');
        ?>
        <li class="list-group-item">
          <h3 class="text-primary"> <a href="<?=get_post_permalink($conv)?>"><?=$conv->post_title?></a></h3>
          <h5><?=sprintf(__('Du %s au %s'),$conv_meta['date_start'], $conv_meta['date_end'])?></h4>
          <p class="card-text"><?=$conv->post_excerpt?></p>
          <span class="text-muted d-block"><i class="fas fa-map-marker-alt"></i><?=$conv_meta['location_name']?></span>
        </li>
      <?php endfor;?>
    </ul>
  </div>
  <?php endif; ?>
</div>
