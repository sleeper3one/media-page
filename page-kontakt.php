<?php

$state = $wp_query->query_vars['state'];
if (!empty($state) && $state == 'send') {
    $post = file_get_contents('php://input');
    $arr = json_decode($post, TRUE);
    $api->mailer->add_lead($arr);
    die();
}


require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$page_h1 = get_field('section_h1', $post->ID);
$page_content = $api->getPageContact();
$page_cover = $api->getPageCover();
$footer = $api->getSiteFooter(); 
?>

<section id="page-contact" class="sb-section sb-page">

 <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
  <div class="sb-header-single">
   <h1><?php echo $page_h1; ?></h1>
  </div>
 </div>

 <div class="sb-page-content">
  <div class="page-contact-cont">
   <h2><?php echo $page_content['company']; ?></h2>
   <div class="page-contact-desc">
    <?php echo $page_content['desc']; ?>
   </div>
   <a href="mailto:<?php echo $page_content['email']; ?>" class="page-contact-email">
    <?php echo $page_content['email']; ?>
   </a>

   <div class="page-contact-socials">
    <h2>SOCIAL MEDIA</h2>
    <a href="<?php echo $footer['li_link']; ?>" class="social-li" target="_blank">
     <img src="<?php echo apppath; ?>/assets/icon-linkedin-bold.png"
      alt="<?php echo $settings['global_name']; ?> | LinkedIn" />
     <span>@<?php echo $footer['li_nick']; ?></span>
    </a>
    <a href="<?php echo $footer['fb_link']; ?>" class="social-fb" target="_blank">
     <img src="<?php echo apppath; ?>/assets/icon-fb-bold.png"
      alt="<?php echo $settings['global_name']; ?> | Facebook" />
     <span>@<?php echo $footer['fb_nick']; ?></span>
    </a>
    <a href="<?php echo $footer['ig_link']; ?>" class="social-ig" target="_blank">
     <img src="<?php echo apppath; ?>/assets/icon-ig-bold.png"
      alt="<?php echo $settings['global_name']; ?> | Instagram" />
     <span>@<?php echo $footer['ig_nick']; ?></span>
    </a>
    <a href="<?php echo $footer['tt_link']; ?>" class="social-tt" target="_blank">
     <img src="<?php echo apppath; ?>/assets/icon-twitter-bold.png"
      alt="<?php echo $settings['global_name']; ?> | Twitter" />
     <span>@<?php echo $footer['tt_nick']; ?></span>
    </a>
      <a href="<?php echo $footer['yt_link']; ?>" class="social-yt" target="_blank">
     <img src="<?php echo apppath; ?>/assets/icon-youtube-bold.png"
      alt="<?php echo $settings['global_name']; ?> | YouTube" />
     <span>@<?php echo $footer['yt_nick']; ?></span>
    </a>
   </div>
  </div>
  <div class="page-contact-form">
   <h3>Napisz do nas!</h3>
   <h4>Odpowiemy na każde pytanie dotyczące naszej oferty.</h4>
   <form id="contact-form" data-action="addlead">
    <span class="form-fields-error">Wypełnij wszystkie pola</span>
    <div class="form-field-row">
     <input type="text" name="contact_first_name" id="contact-first_name" placeholder="Imię" class="form-field req" />
     <input type="text" name="contact_last_name" id="contact-last_name" placeholder="Nazwisko" class="form-field req" />
    </div>
    <div class="form-field-row">
     <input type="email" name="contact_email" id="contact-email" placeholder="E-mail" class="form-field req" />
    </div>
    <div class="form-field-row">
     <input type="text" name="contact_telephone" id="contact-telephone" placeholder="Telefon (opcjonalnie)"
      class="form-field" />
    </div>
    <div class="form-field-row">
     <textarea name="contact_content" id="contact-content" placeholder="Treść wiadomości"
      class="form-field req"></textarea>
    </div>
    <span class="form-agree-error">Zgoda musi być zanaczona</span>
    <div class="field-checkbox check-req" id="form-agreement">
     <div><?php echo get_field('agree_contact', 1); ?></div>
    </div>
    <div class="field-checkbox-caption">
     <?php echo get_field('agree_info', 1); ?>
    </div>
    <div class="form-success-msg"></div>
    <a href="#contact-form" class="cta-btn btn-cta-form">
     <span>wyślij</span>
    </a>
   </form>
  </div>
 </div>

</section>

<?php

require templatepath . '/footer.php';
?>