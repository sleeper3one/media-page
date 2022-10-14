<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

wp_head();

$page_h1 = get_field('section_h1', $post->ID);
$page_content = get_field('page_content_area', $post->ID);
$page_cover = $api->getPageCover();
?>
<section id="page-content" class="sb-section sb-page">
 <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
  <div class="sb-header-single">
   <h1><?php echo $page_h1; ?></h1>
  </div>
 </div>
 <div class="sb-page-content">
  <?php echo $page_content; ?>
 </div>
</section>

<?php
wp_footer();
require templatepath . '/footer.php';
?>