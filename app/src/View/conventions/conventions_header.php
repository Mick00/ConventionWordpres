<?php

$upcoming_conventions = get_posts([
  'numberposts'       => 3,
  'post_type'         => 'convention',
  'post_status'       => 'publish',
  'meta_query'        =>[
    [
      'compare'      => '>=',
      'key'          => '_start',
      'value'        => date('Y-m-d',time()-610800),
    ]
  ],
  'order'         => 'ASC',
  'orderby'      => 'meta_value',
  'meta_key'      => '_start',
  'meta_type'     => 'DATE',
]);
$conv = $upcoming_conventions[0];
$conv_data = get_convention_data($upcoming_conventions[0]);
$conf = get_associated($conv->ID, 'conferences');
$exhibitors = get_associated($conv->ID, 'exhibitorslist');
?>
<div class="fluid-container home-header p-3">
    <header class="is_home bg-primary rounded text-center mx-auto shadow wow fadeInRight">
        <?php if(has_post_thumbnail($conv)) :?>
            <div class="bg-secondary rounded">
                <div>
                    <a class="home-banner" href="<?=get_permalink($conv)?>">
                        <?php echo get_the_post_thumbnail($conv,"post_image",['class'=>""]);?>
                    </a>
                </div>
                <div class="p-2 home-link-wrapper">
                    <a href="<?=get_post_permalink($exhibitors->ID)?>" class="text-white home-link">Voir les exposants</a>
                </div>
            </div>
            <div class="p-2 home-link-wrapper">
                <a href="<?=get_post_permalink($conf->ID)?>" class="text-white home-link">Voir les conferences</a>
            </div>
            <?php else:?>
            <div class="gradient-overlay has-bg alignfull d-flex align-items-center mx-auto">
                <div class="container">
                    <h1>Allo</h1>
                </div>
            </div>
        <?php endif;?>
    </header>
    <?php
    if(count($upcoming_conventions)>= 2):
        $conv = $upcoming_conventions[1];
        $conf = get_associated($conv->ID, 'conferences');
        $exhibitors = get_associated($conv->ID, 'exhibitorslist');
        $conv_meta = get_convention_data($conv);
        ?>
    <div class="upcoming-conventions mx-auto mt-3">
        <div class="coming-soon text-center mb-3 shadow wow fadeIn" data-wow-delay="0.5s">
            <?= wp_get_attachment_image(carbon_get_theme_option('header_coming_soon_img'),"full")?>
            <h3 class="">Salons à venir</h3>
            <p>Abonnez-vous pour ne rien manquer</p>
            <a href="<?=carbon_get_theme_option('newsletter_subscription_link')?>" class="btn btn-primary">M'abonner</a>
        </div>
        <div class="bg-secondary rounded mb-3 shadow p-3 wow fadeIn" data-wow-delay="0.8s">
            <h3 class="text-center"> <a href="<?=get_post_permalink($conv)?>"><?=$conv->post_title?></a></h3>
            <span><i class="far fa-calendar-alt text-warning"></i> <?=sprintf(__('Du %s au %s'),$conv_meta['date_start'], $conv_meta['date_end'])?></span>
            <span class="d-block m"><i class="fas fa-map-marker-alt text-warning"></i> <?=$conv_meta['location_name']?></span>
            <div class="text-center my-2">
                <?php if($conf): ?>
                    <a class="btn btn-primary btn-sm" href="<?=get_post_permalink($conf->ID)?>">Conférences</a>
                <?php endif; ?>
                <?php if($exhibitors): ?>
                    <a class="btn btn-primary btn-sm" href="<?=get_post_permalink($exhibitors->ID)?>">Exposants</a>
                <?php endif; ?>
            </div>
        </div>
        <?php
        if (count($upcoming_conventions) >= 3):
            $conv = $upcoming_conventions[2];
            $conf = get_associated($conv->ID, 'conferences');
            $exhibitors = get_associated($conv->ID, 'exhibitorslist');
            $conv_meta = get_convention_data($conv);
            ?>
            <div class="bg-secondary rounded mb-3 shadow p-3 wow fadeIn" data-wow-delay="1.1s">
                <h3 class="text-center"> <a href="<?=get_post_permalink($conv)?>"><?=$conv->post_title?></a></h3>
                <span><i class="far fa-calendar-alt text-warning"></i> <?=sprintf(__('Du %s au %s'),$conv_meta['date_start'], $conv_meta['date_end'])?></span>
                <span class="d-block m"><i class="fas fa-map-marker-alt text-warning"></i> <?=$conv_meta['location_name']?></span>
                <?php if($conf): ?>
                    <a class="btn btn-primary btn-sm my-2" href="<?=get_post_permalink($conf->ID)?>">Conférences</a>
                <?php endif; ?>
                <?php if($exhibitors): ?>
                    <a class="btn btn-primary btn-sm" href="<?=get_post_permalink($exhibitors->ID)?>">Exposants</a>
                <?php endif; ?>
            </div>
        <?php endif;?>  
    </div>
    <?php endif;?>
</div>
