<?php

global $post;
$schedule = carbon_get_post_meta($post->ID, 'schedule');
$packages = carbon_get_post_meta($post->ID, 'pricing');
?>
<div class="d-flex flex-wrap p-5 alignwide">
  <?php if (count($schedule) > 0):?>
  <div class="d-flex text-white mr-lg-3 mb-3 flex-samezise">
    <div class="p-5 bg-dark-primary d-flex align-items-center justify-content-center flex-samezise">
      <i class="far fa-clock icon-giganormous"></i>
    </div>
    <div class="p-5 bg-primary flex-bigger">
      <h3>Horaire d'ouverture</h3>
      <ul class="list-unstyled">
        <?php
        foreach ($schedule as $day) {
          echo "<li>".__($day['day_start']);
          if ($day['day_start'] !== $day['day_end']){
            echo " au ".__($day['day_end']);
          }
          if($day['closed']){
            echo " - Fermé";
          } else {
            echo " de " . $day['opens_at']  ." à ".$day['closes_at'] . "</li>";
          }
        }
        ?>
      </ul>
    </div>
  </div>
<?php endif;?>
<?php if (count($packages) > 0):?>
  <div class="d-flex text-white flex-samezise mb-3">
    <div class="p-5 bg-dark-secondary d-flex align-items-center justify-content-center flex-samezise">
      <i class="fas fa-dollar-sign icon-giganormous"></i>
    </div>
    <div class="p-5 bg-secondary flex-bigger">
      <h3>Prix d'entrée</h3>
      <ul class="list-unstyled">
      <?php
        foreach($packages as $package){
          echo "<li>".$package['package_name'].": ".$package['package_price']."</li>";
        }
       ?>
      </ul>
    </div>
  </div>
<?php endif;?>
</div>
