<?php
global $post;
 ?>
 <div class="d-flex flex-wrap flex-lg-nowrap my-5 justify-content-between">
   <?php echo wp_get_attachment_image(carbon_get_post_meta($post->ID, 'picture'), 'thumbnail', false, ['class'=>'d-block flex-samesize']);?>
   <div class="flex-bigger mx-3 min-text-w">
     <h2><?=carbon_get_post_meta($post->ID,'firstname')?> <?=carbon_get_post_meta($post->ID,'lastname')?></h2>
     <?php if (!empty(carbon_get_post_meta($post->ID,'city'))):?>
     <span class="text-muted"><i class="fas fa-map-marker-alt"></i> <?=carbon_get_post_meta($post->ID,'city')?></span>
   <?php endif;?>
     <p><?=carbon_get_post_meta($post->ID,'bio')?></p>
   </div>
   <div class="flex-samesize card">
     <div class="card-header bg-primary text-white">
       Contact
     </div>
     <div class="card-body">
       <div>
         <h4 class="text-nowrap">Par téléphone</h4>
         <ul class="no-decoration">
           <?php foreach (carbon_get_post_meta($post->ID,'phones') as $phone) :?>
             <li> <a href="tel:<?=$phone['number']?>">
               <i class="fas fa-phone-alt"></i> <?=$phone['number']?>
             </a></li>
           <?php endforeach;?>
         </ul>
       </div>
       <div>
         <h4 class="text-nowrap">Par courriel</h4>
         <ul class="no-decoration">
           <?php foreach (carbon_get_post_meta($post->ID,'emails') as $adress) :?>
             <li><?=$adress['email']?></li>
           <?php endforeach;?>
         </ul>
       </div>
       <div>
         <h4 class="text-nowrap">Site web</h4>
         <ul class="no-decoration">
           <?php foreach (carbon_get_post_meta($post->ID,'sites') as $site) :?>
             <li><a href="<?=$site['url']?>">
               <?=$site['url']?>
             </a></li>
           <?php endforeach;?>
         </ul>
       </div>
     </div>
   </div>
 </div>
