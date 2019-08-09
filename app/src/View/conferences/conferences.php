<?php
global $post;
$dates = carbon_get_post_meta($post->ID, 'dates');

?>
<div class="d-flex justify-content-center p-5">
  <button class="btn btn-primary mr-2" type="button" name="prev-day"><i class="fas fa-chevron-left"></i> Jour précédent</button>
  <?php for($i =0; count($dates) > $i; $i++):?>
    <button class="btn btn-primary mr-2" type="button" name="prev-day" onclick="gotoDay(<?=$i?>)"><?=date_i18n('j M', strtotime($dates[$i]['date']))?></button>
  <?php endfor;?>
  <button class="btn btn-primary" type="button" name="next-day">Jour suivant <i class="fas fa-chevron-right"></i></button>
</div>
<div class="conferences-wrapper">
  <?php foreach ($dates as $date) :?>
      <div class="conference-day">
        <h2 class="bg-primary text-light p-2 text-center mb-0 mx-3 rounded-top"><?=date_i18n('j M', strtotime($date['date']))?></h3>
        <?php foreach ($date['rooms'] as $room): ?>
          <h3 class="bg-secondary text-light p-2 text-center"><?=$room['room_name']?></h3>

            <?php foreach ($room['conferences'] as $conference):
              $convid = carbon_get_post_meta( $post->ID,'convention')[0]['id'];
              ?>
              <div class="conference d-flex align-items-center p-3">
                <?php echo wp_get_attachment_image(carbon_get_post_meta($conference['conferencier'][0]['id'], 'picture'), 'thumbnail', 'false',['class' => 'd-block'])?>
                <div class="confenrece-data ml-3">
                  <h4><span class="hour"><?=date('H\hi',strtotime($conference['starts_at']))?></span><?=$conference['title']?></h4>
                  <h5>Par
                    <?php
                    $url;
                    foreach($conference['conferencier'] as $conferencier):
                      $exhibitorKiosk = get_exhibitor_kiosk($convid, $conferencier['id']);
                      if ($exhibitorKiosk) {
                        $linkedConvList = get_post_permalink(get_associated($convid,'exhibitorslist'));
                        $url = $linkedConvList."#kiosk".$exhibitorKiosk;
                      } else {
                        $url = get_post_permalink($conferencier['id']);
                      }
                      ?>
                      <a class="name" href="<?=$url?>">
                        <?=carbon_get_post_meta($conferencier['id'],'firstname')?>
                        <?=carbon_get_post_meta($conferencier['id'],'lastname')?>
                      </a>
                      <?php
                      if(next($conference['conferencier'])){
                        echo ", ";
                      }
                    endforeach;?>
                  </h5>
                  <p><?=$conference['description']?></p>
                </div>
              </div>
            <?php endforeach; ?>
        <?php endforeach;?>
      </div>

  <?php endforeach; ?>
</div>
