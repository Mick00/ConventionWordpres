<?php
global $post;
 ?>
 <div class="d-flex flex-wrap flex-md-nowrap my-5 justify-content-between">
   <div class="">
     <h2><?=carbon_get_post_meta($post->ID,'firstname')?> <?=carbon_get_post_meta($post->ID,'lastname')?></h2>
     <?php if (!empty(carbon_get_post_meta($post->ID,'city'))):?>
     <span class="text-muted"><i class="fas fa-map-marker-alt"></i> <?=carbon_get_post_meta($post->ID,'city')?></span>
   <?php endif;?>
     <p><?=carbon_get_post_meta($post->ID,'bio')?></p>
   </div>
   <div class="card">
     <div class="card-header bg-primary text-white">
       Contact
     </div>
     <div class="card-body">
       <div class="">
         <h4>Par téléphone</h4>
         <ul class="no-decoration">
           <?php foreach (carbon_get_post_meta($post->ID,'phones') as $phone) :?>
             <li> <a href="tel:<?=$phone['number']?>">
               <i class="fas fa-phone-alt"></i> <?=$phone['number']?>
             </a></li>
           <?php endforeach;?>
         </ul>
       </div>
       <div class="">
         <h4>Par courriel</h4>
         <ul class="no-decoration">
           <?php foreach (carbon_get_post_meta($post->ID,'emails') as $adress) :?>
             <li><?=$adress['email']?></li>
           <?php endforeach;?>
         </ul>
       </div>
       <div class="Sur leur site">
         <h4>Site web</h4>
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
