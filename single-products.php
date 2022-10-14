<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$prod = $api->getProduct($post->ID);
$page_cover = $api->getPageCover();
?>

<section id="products-page" class="sb-section sb-page">
  <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
    <div class="sb-section-intro">
      <div class="sb-section-info">
        <h1><?php echo $prod['title']; ?></h1>
      </div>
    </div>
  </div>
 
  <div class="sb-page-content">
  <?php if (is_array($prod['product_icons'])): ?>
  <div class="sb-page-icons">
    <?php foreach ($prod['product_icons'] as $pk => $pv): ?>
    <a href="<?php echo ((!$pv['ico_link']) ? 'javascript:void(0);' : ($pv['ico_link'] . '" target="_blank')); ?>"
    class="sb-icon-item">
    <strong class="icon-val" data-value="<?php echo $pv['ico_value']; ?>"><?php echo $pv['ico_value']; ?></strong>
    <em class="icon-<?php echo $pv['ico_gfx']; ?>"></em>
    <span><?php echo $pv['ico_name']; ?></span>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <div class="sb-page-info">
   <div class="sb-page-desc">
    <?php echo $prod['product_description']; ?>
   </div>
   <div class="sb-page-col">
    <?php if (is_array($prod['product_photos'])): ?>
    <div class="sb-page-photos">
     <div class="photos-wrapper">
      <img src="<?php echo $prod['product_logo']['url']; ?>" alt="<?php echo $prod['title']; ?>" />
     </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($prod['product_pdf'])): ?>
    <div class="sb-offer-pdf">
     <a class="presentation-btn" href="<?php echo $prod['product_pdf']['url']; ?>"><span>POBIERZ PREZENTACJĘ</span></a>
    </div>
    <?php endif; ?>
   </div>
  </div>
 </div>
 <div class="sb-page-bot-nav">
  <a href="<?php site_url() ?>/portfolio/">
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
      next_post_link('%link', '← Poprzedni Produkt');
      } else { 
        $last = new WP_Query('post_type=products&posts_per_page=1&order=ASC'); $last->the_post();
        echo '<a href="' . get_permalink() . '">← Poprzedni Produkt</a>';
        wp_reset_query();
      }; 
      if( get_adjacent_post(false, '', true) ) { 
      previous_post_link('%link', 'Następny Produkt →');
      } else { 
        $first = new WP_Query('post_type=products&posts_per_page=1&order=DESC'); $first->the_post();
        echo '<a href="' . get_permalink() . '">Następny Produkt →</a>';
        wp_reset_query();
      };
    ?>
  </div>
 </div>
</section>

<?php
require templatepath . '/footer.php';
?>