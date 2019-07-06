<?php
global $post;
$rooms = carbon_get_post_meta($post->ID, 'rooms');

?>
<div class="">

  <table class="table mx-auto">
    <tr>
      <th></th>
      <?php foreach ($rooms[0]['days'] as $day): ?>
        <th>
          <h2>
            <?=date_i18n('j M', strtotime($day['date']))?>
          </h2>
        </th>
      <?php endforeach; ?>
    </tr>
    <?php foreach($rooms as $room): ?>
      <tr>
        <th scope="row"><h3><?=$room['room_name']?></h3></th>
        <?php foreach ($room['days'] as $day): ?>
          <td class="conferences">
            <ul class="list-group list-group-flush no-decoration">
              <?php foreach ($day['conferences'] as $conference):
                $convid = carbon_get_post_meta( $post->ID,'convention')[0]['id'];
                $url = get_post_permalink(get_associated($convid,'exhibitorslist'));
                $url .= "#kiosk".get_exhibitor_kiosk($convid,$conference['conferencier'][0]['id']);
                ?>
                <li class="list-group-item">
                  <h4><span class="hour"><?=date('H\Hi',strtotime($conference['starts_at']))?></span><?=$conference['title']?></h4>
                  <a class="name" href="<?=$url?>">
                    <h5>Par
                      <?=carbon_get_post_meta($conference['conferencier'][0]['id'],'firstname')?>
                      <?=carbon_get_post_meta($conference['conferencier'][0]['id'],'lastname')?>
                    </h5>
                  </a>
                <p><?=$conference['description']?></p>
              </li>
              <?php endforeach; ?>
            </ul>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach;?>
  </table>
</div>
