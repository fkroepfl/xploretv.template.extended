<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

/**
 * Search for a pattern in a string and replace it with the home URL of the website.
 *
 * @param string  $url
 * @param string  $search_pattern   Defaults is '#homeurl#'
 * @return string
 */
function parseLink($url, $search_pattern = '#homeurl#') {
  $replace = get_home_url();
  if (strpos($url, $search_pattern) !== false) {
    $url = str_replace($search_pattern, $replace, $url);
  }
  return $url;
}

// Section A - Full width card with optional background image
function content_element_section_a($all_data) {
    $class = $all_data['full-height'] ? 'a1xploretv-c' : 'a1xploretv-a';
    ?>

    <section id="a1xploretv-c" class="<?= $class ?> " style="background-image:url('<?= $all_data['background-image']['url'] ?>');">
        <div class="w-50 mx-auto d-flex flex-column justify-content-center align-items-center text-center h-100">
            <div class="h1 text-white h-bold"><?= $all_data['headline'] ?></div>
            <div class="mt-1">
                <h3 class="text-white mb-5">
                    <?= $all_data['copytext'] ?>
                </h3>
                <?php if ($all_data['button-label']) { ?>
                  <a id="a1xploretv-c-btn1" href="<?= parseLink($all_data['button-href']) ?>" class="button a1xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
}

// Section B - Slider Big
function content_element_section_b($all_data) {
    ?>
    <section class="a1xploretv-k px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
            <h3><?= $all_data['copytext'] ?></h3>
        </div>
        <div id="js-a1xploretv-k-slider" class="a1xploretv-k-slider js-a1xploretv-k-slider">
          <?php foreach ($all_data['cards'] as $card) { ?>
            <a href="<?= parseLink($card['card-href']) ?>" class="focusable">
                <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
                <?= $card['copytext'] ?>
            </a>
          <?php } ?>
        </div>
    </section>
    <?php
}

// Section C - 2 Column Text an Image
function content_element_section_c($all_data) {
    ?>
    <section id="a1xploretv-g" class="a1xploretv-g bg-white">
        <div class="a1xploretv-g-container h-100">
            <div class="d-flex align-items-center text-center h-100">
                <div id="a1xploretv-g-btn1" class="a1xploretv-g-left focusable">
                    <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                    <?= $all_data['copy'] ?>

                    <?php
                      if ($all_data['button-href'] && false) {
                    ?>
                    <p>
                      <a href="<?= parseLink($all_data['button-href']) ?>" class="button a1xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
                    </p>
                    <?php
                      }
                    ?>

                    <p class="mt-5 mb-4">Finden Sie unsere App </p>
                    <div class="d-flex justify-content-center">
                        <a id="a1xploretv-g-btn1" href="javascript:void(0)" onclick="alert('tst')" class="mr-3" alt="Google Play">
                            <img src="/wp-content/themes/<?php echo get_template(); ?>/images/google-play-smarthome.png" alt="Google Play">
                        </a>
                        <a id="a1xploretv-g-btn2" href="javascript:void(0)" onclick="alert('tst')" class="">
                            <img src="/wp-content/themes/<?php echo get_template(); ?>/images/apple-app-smarthome.png" alt="">
                        </a>
                    </div>

                </div>
                <div class="a1xploretv-g-right">
                    <img src="<?= $all_data['image']['url'] ?>" alt="<?= $all_data['image']['alt'] ?>">
                </div>
            </div>
        </div>
    </section>

    <?php
}

// Section D - Full width video
function content_element_section_d($all_data) {
    ?>
    <section class="a1xploretv-d a1xploretv-video-section">
        <?php
          if ($all_data['video-provider'] == 'local-video') {
        ?>
          <video class="js-a1xploretv-d-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-source'] ?>" type="video/mp4">
          </video>
        <?php
          } else if ($all_data['video-provider'] == 'stream') {
        ?>
          <video class="js-a1xploretv-d-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-stream'] ?>" type="video/mp4">
          </video>
        <?php
          } else if ($all_data['video-provider'] == 'youtube' || $all_data['video-provider'] == 'vimeo') {
        ?>
            <div class="a1xploretv-video-frame">
                <?php $base_url = ($all_data['video-provider'] == 'youtube') ? 'https://www.youtube.com/embed/' : 'https://player.vimeo.com/video/'; ?>
                <iframe width="100%" frameborder="0" allowfullscreen allow="autoplay" data-type="<?=$all_data['video-provider']?>"  data-src="<?= $base_url . $all_data['video-id'] ?>" src="<?= $base_url . $all_data['video-id'] ?>"></iframe>
            </div>
        <?php
          }
        ?>

        <div class="js-a1xploretv-d-content position-relative d-flex flex-column justify-content-center align-items-center text-center h-100 ">
            <div class="h1 text-white h-bold"><?= $all_data['headline'] ?></div>
            <div class="mt-1">
                <h3 class="text-white mb-5">
                    <?= $all_data['copytext'] ?>
                </h3>
                <a href="javascript:void(0)"  class="a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start"></a>
            </div>
        </div>
    </section>
    <?php
}

// Section E - Image Slider with Detail Card
function content_element_section_e($all_data) {
    ?>
    <section class="a1xploretv-l px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
        </div>
        <div id="js-a1xploretv-l-slider" class="a1xploretv-l-slider js-a1xploretv-l-slider">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>

            <div class="product" id="<?= $num ?>" >
                <img <?php if ($num === 0) { ?> id="set-first"<?php } ?> class="focusable" src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
            </div>

            <?php
                $num++;
              }
            ?>
        </div>
        <div id="productInfo" class="productInfo">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>
            <div id='<?= $num ?>'>
                <div class="productInfo-title"><?= $card['headline'] ?></div>
                <?= $card['copytext'] ?>
            </div>
            <?php
                $num++;
              }
            ?>
        </div>

    </section>

    <?php
}

// Section F - Selection/Decision Element
function content_element_section_f($all_data) {
    $class_div = $all_data['full-width'] ? '' : 'full-width';
    $class_section = $all_data['full-width'] ? '' : 'h-auto';
    ?>
    <section id="a1xploretv-f" class="a1xploretv-f <?= $class_section ?>">
        <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
            <?php if ($all_data['headline']) { ?>
              <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
            <?php } ?>
            <?php if ($all_data['copytext']) { ?>
              <h3><?= $all_data['copytext'] ?></h3>
            <?php } ?>
            <div class="a1xploretv-f-container <?= $class_div ?>">
                <div class="d-flex justify-content-between align-items-center text-center h-100">
                  <?php
                    $center_card = floor(count($all_data['cards']) / 2);
                    $num = 0;
                  ?>
                  <?php foreach ($all_data['cards'] as $card) { ?>
                    <?php
                      $my_id = '';
                      if ($num == $center_card) $my_id = 'a1xploretv-f-f-first';
                    ?>

                    <a id="<?= $my_id ?>" href="<?= parseLink($card['href']) ?>" class="a1xploretv-f-box focusable h-100">
                      <span>
                        <?php if (isset($card['image'])) { ?>
                          <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['url'] ?>">
                        <?php } ?>
                        <span class="a1xploretv-f-title h3"><?= $card['headline'] ?></span>
                        <p><?= $card['copytext'] ?></p>
                      </span>
                    </a>
                    <?php $num++; ?>
                  <?php } ?>
                </div>
            </div>
        </div>
    </section>
  <?php
}

// Section G - Form
function content_element_section_g($all_data) {
?>
<section class="a1xploretv-e">
  <div class="a1xploretv-e-textblock text-center w-75">
      <h2 class="h1 h-bold"><?= $all_data['headline'] ?></h2>
      <h3><?= $all_data['copytext'] ?></h3>
  </div>
  <form name="a1xploretv-e-form" method="POST" action="<?= get_template_directory_uri(); ?>/ajax_form_contact.php" autocomplete="off" class="myForm">
    <input name="status_message_success" type="hidden" value="<?= $all_data['status_message_success'] ?>">
    <input name="status_message_receiver" type="hidden" value="<?= seso_encrypt($all_data['receiver']) ?>">
    <div class="a1xploretv-e-inner mx-auto">
        <div class="a1xploretv-e-form">
                <div class="form-group">
                    <input type="text" name="vorname" class="form-control focusable" placeholder="Vorname *" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="nachname" class="form-control focusable" placeholder="Nachname *" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" name="e-email" class="form-control focusable" placeholder="E-Mail *" autocomplete="off">
                </div>
                <div class="a1xploretv-e-radio-group">
                    <p class="a1xploretv-e-radio-label">Wo möchten Sie Ihr unverbindliches Beratungsgespräch vereinbaren?</p>
                    <div class="a1xploretv-e-radios">
                        <label class="a1xploretv-e-radio ">
                            <input type="radio" value="bei mir zuhause" name="consult-radio" checked>
                            <span class="a1xploretv-e-radio-ui focusable" ></span>
                            <span class="a1xploretv-e-radio-text">Bei mir zuhause</span>
                        </label>
                        <label class="a1xploretv-e-radio "  >
                            <input type="radio" value="im A1 Shop">
                            <span class="a1xploretv-e-radio-ui focusable"></span>
                            <span class="a1xploretv-e-radio-text">Im A1 Shop</span>
                        </label>
                    </div>
                </div>
        </div>
        <div class="response">
        </div>
    </div>
    <div class="a1xploretv-e-form-btns ">
        <button type="submit" class="btn btn-outline-primary focusable mr-3">
            <span>Absenden</span>
            <span class="a1xploretv-icon arrow-right"></span>
        </button>
        <a href="#" class="btn btn-outline-primary focusable mt-0">
            <span>Konnte nicht absenden, Daten stimmen nicht</span>
            <span class="a1xploretv-icon arrow-right"></span>
        </a>
    </div>
    </form>
</section>

<?php
}

// Section I - Survey
function content_element_section_h($all_data) {
?>
  <section class="a1xploretv-e">
        <div class="a1xploretv-e-textblock text-center mb-60px w-75">
            <h2 class="h1 h-bold"><?= $all_data['headline'] ?></h2>
            <h3><?= $all_data['copytext'] ?></h3>
        </div>
        <div class="a1xploretv-e-inner">
          <div class="a1xploretv-e-form">
              <form name="a1xploretv-e-form" method="POST" action="<?= get_template_directory_uri(); ?>/ajax_form_survey.php" autocomplete="off" class="myForm">
                  <input name="status_message_success" type="hidden" value="<?= $all_data['status_message_success'] ?>">
                  <input name="status_message_receiver" type="hidden" value="<?= seso_encrypt($all_data['receiver']) ?>">
                  <?php
                    $num = 0;
                    foreach ($all_data['question-blocks'] as $question_block) {
                  ?>
                      <h4 style="margin-top: 30px;"><?= $question_block['question'] ?></h4>
                      <input name="questions[]" type="hidden" value="<?= $question_block['question'] ?>">
                  <?php
                    foreach ($question_block['answers'] as $answer) {
                  ?>
                  <div class="a1xploretv-e-checkbox-group">
                      <div class="a1xploretv-e-checkboxes">
                          <label class="a1xploretv-e-checkbox focusable" tabindex="-1">
                              <input type="checkbox" value="<?= $answer['answer'] ?>" name="answers_<?= $num ?>[]">
                              <span class="a1xploretv-e-checkbox-ui-bg" ></span>
                              <span class="a1xploretv-e-checkbox-ui "></span>
                              <span class="a1xploretv-e-checkbox-text "><?= $answer['answer'] ?></span>
                          </label>
                      </div>
                  </div>
                  <?php
                      }
                      $num++;
                    }
                  ?>
                  <div class="response">
                  </div>
                  <div class="a1xploretv-e-form-btns">
                      <button type="submit" class="btn a1xploretv-icon arrowright btn-block btn-outline-primary focusable">
                          <span>Absenden</span>
                          <span class="a1xploretv-icon arrow-right"></span>
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </section>
<?php
}
