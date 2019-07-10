<?php
global $post;
$rooms = carbon_get_post_meta($post->ID, 'rooms');

?>
<div class="conferences-wrapper my-4 alignfull px-5">

  <table class="conferences-table mx-auto">
    <tr class="date-row">
      <?php foreach ($rooms[0]['days'] as $day): ?>
        <th>
          <div class="bg-light rounded-top mx-1">
            <h2 class="text-center text-bold mb-0 p-3">
              <?=date_i18n('j M', strtotime($day['date']))?>
            </h2>
          </div>
        </th>
      <?php endforeach; ?>
    </tr>
    <?php foreach($rooms as $room): ?>
      <tr>
        <td colspan="<?=count($room)?>" class="room-name-row bg-secondary text-white rounded mx-n3 py-3">
          <h3 class="ml-5 mb-0"><?=$room['room_name']?></h3></tr>
        </td>
      <tr>
        <?php foreach ($room['days'] as $day): ?>
          <td class="conferences py-0">
            <ul class="list-group list-group-flush no-decoration bg-light mx-1">
              <?php foreach ($day['conferences'] as $conference):
                $convid = carbon_get_post_meta( $post->ID,'convention')[0]['id'];
                $url = get_post_permalink(get_associated($convid,'exhibitorslist'));
                $url .= "#kiosk".get_exhibitor_kiosk($convid,$conference['conferencier'][0]['id']);
                ?>
                <li class="list-group-item bg-light">
                  <h4><span class="hour"><?=date('H\hi',strtotime($conference['starts_at']))?></span><?=$conference['title']?></h4>
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
