<?php

global $post;
$schedule = carbon_get_post_meta($post->ID, 'schedule');
$packages = carbon_get_post_meta($post->ID, 'pricing');

if(get_associated($post->ID, 'conferences') && get_associated($post->ID, 'exhibitorslist')):
?>
  <div class="statistic-wrapper alignfull bg-secondary text-white mb-0">
    <div class="statistic">
      <div>
        <span class="big-number">
          <?=count_days($post->ID)?>
        </span>
      </div>
      <h4>Jours</h4>
    </div>
    <div class="statistic">
      <span class="big-number">
        <div><?=count_exhibitors($post->ID)?></div>
      </span>
      <h4>Exposants</h4?>
    </div>
    <div class="statistic">
      <div>
        <span class="big-number">
          <?=count_conferences($post->ID)?>
        </span>
      </div>
      <h4>Conférences</h4>
    </div>
  </div>
<?php endif; ?>
<div class="alignfull bg-light py-3 mb-3">
  <div class="text-center">
    <h3>Venez nous voir</h3>
    <div class="conv-info mt-3">
        <div class>
        <h4>Horaire</h4>
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
      <div>
        <h4>Tarifs</h4>
        <ul class="list-unstyled">
            <?php
              foreach($packages as $package){
                echo "<li>".$package['package_name'].": ".$package['package_price']."$</li>";
              }
            ?>
        </ul>
      </div>
    </div>
  </div>
</div>
