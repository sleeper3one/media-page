<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$profil = $api->getInfluencer($post->ID);
$page_cover = $api->getPageCover();
?>

<section id="portfolio-influencer" class="sb-section sb-page">
 <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
  <div class="sb-section-intro">
   <div class="sb-section-info">
    <h1><?php echo $profil['name']; ?></h1>
    <div class="influencer-position"><?php echo $profil['person_position']; ?></div>
    <div class="influencer-company"><?php echo $profil['person_company']; ?></div>
   </div>
   <div class="header-gfx">
    <img src="<?php echo $profil['person_avatar']['url']; ?>" alt="<?php echo $profil['name']; ?>" />
   </div>
   <a class="cta-btn header-cta-btn" href="<?php echo get_permalink(16) . $post->ID; ?>/">
    <span>zapytaj o ofertę</span>
   </a>
  </div>
 </div>
 <div class="sb-page-content">
  <?php if (is_array($profil['person_icons'])): ?>
  <div class="sb-page-icons">
   <?php foreach ($profil['person_icons'] as $pk => $pv): ?>
   <a href="<?php echo $pv['ico_link']; ?>" class="sb-icon-item" target="_blank">
    <strong class="icon-val" data-value="<?php echo $pv['ico_value']; ?>"><?php echo $pv['ico_value']; ?></strong>
    <em class="icon-<?php echo $pv['ico_gfx']; ?>"></em>
    <span><?php echo $pv['ico_name']; ?></span>
   </a>
   <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <div class="sb-page-info">
   <div class="sb-page-desc">
    <?php echo $profil['person_description']; ?>
   </div>
   <div class="sb-page-col">
    <?php if (is_array($profil['person_photos'])): ?>
    <div class="sb-page-photos">
     <div class="photos-wrapper">
      <?php foreach ($profil['person_photos'] as $fk => $fv): ?>
      <img src="<?php echo $fv['url']; ?>" alt="<?php echo $profil['name']; ?>"
       data-jslghtbx="<?php echo $fv['url']; ?>" data-jslghtbx-group="person_photos" />
      <?php endforeach; ?>
     </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($profil['person_pdf'])): ?>
                <div class="sb-offer-pdf">
                    <a class="presentation-btn" href="<?php echo $profil['person_pdf']['url']; ?>">
                      <span>POBIERZ PREZENTACJĘ</span>
                    </a>
                </div>
            <?php endif; ?>
   </div>
  </div>
 </div>
 <div class="sb-page-bot-nav">
  <a href="<?php site_url() ?>/portfolio/#ambasadorzy">
   <svg xmlns="https://www.w3.org/2000/svg" width="12px" height="17px" viewBox="0 0 12 17" version="1.1"
    xmlns:xlink="https://www.w3.org/1999/xlink">
    <path stroke-width="2px" stroke-linecap="butt" stroke-linejoin="miter" fill="none"
     d="M7.750,1.250 L1.000,8.000 L7.750,14.750 " />
   </svg>
   powrót
  </a>
  <div class="prev-next">
    <?php
      if( get_adjacent_post(false, '', false) ) { 
      next_post_link('%link', '← Poprzedni Influencer');
      } else { 
        $last = new WP_Query('post_type=influencer&posts_per_page=1&order=ASC'); $last->the_post();
        echo '<a href="' . get_permalink() . '">← Poprzedni Influencer</a>';
        wp_reset_query();
      }; 
      if( get_adjacent_post(false, '', true) ) { 
      previous_post_link('%link', 'Następny Influencer →');
      } else { 
        $first = new WP_Query('post_type=influencer&posts_per_page=1&order=DESC'); $first->the_post();
        echo '<a href="' . get_permalink() . '">Następny Influencer →</a>';
        wp_reset_query();
      };
    ?>
  </div>
 </div>
</section>

<?php
require templatepath . '/footer.php';
?>