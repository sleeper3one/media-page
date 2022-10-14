<?php
$page_cover = $api->getPageCover();
$influencers = $api->getWelcomeInfluencers();
$footer = $api->getSiteFooter(); 


?>
<style>
#page-welcome h1::after {
 content: "<?php echo $page_cover['h1']; ?>";
}
</style>
<section id="cover" class="sb-section sb-cover">
 <div class="sb-cover-bg" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');"></div>
 <?php if (!ismobile()): ?>
 <video src="<?php echo $page_cover['video']['url']; ?>" autoplay muted loop class="sb-cover-video"
  poster="<?php echo $page_cover['bg']['url']; ?>" playsinline></video>
 <?php endif; ?>

 <div id="page-welcome">
  <h1 class="sb-gradient-tr3">
   <?php echo $page_cover['h1']; ?>
  </h1>
  <h2>
   <?php echo $page_cover['h2']; ?>
  </h2>
  <a class="cta-btn" href="<?php echo get_permalink($page_cover['link']); ?>">
   <span><?php echo $page_cover['bttn']; ?></span>
  </a>
 </div>

 <div id="sb-influencer-selector">
  <?php foreach ($influencers as $k => $v): ?>
  <a href="<?php echo get_permalink($v['id']); ?>" class="sb-person" id="sb-person-<?php echo $k+1; ?>">
   <img src="<?php echo $v['person_silhouette']['url']; ?>" class="person-avatar" alt="" />
   <span
    class="person-name sb-element-bevel-no"><?php echo $v['person_first_name'] . ' ' . $v['person_last_name']; ?></span>
   <em class="person-position"><?php echo $v['person_position']; ?></em>
   <strong class="person-company"><?php echo $v['person_company']; ?></strong>
  </a>
  <?php endforeach; ?>

  <div class="sb-fog"></div>
 </div>

 <div id="sb-welcome-boxes">
  <div class="text-shadow-home"></div>
  <?php foreach ($page_cover['boxes'] as $bk => $bv): ?>
  <div class="sb-welcome-box">
   <h3><?php echo $bv['home_box_title']; ?></h3>
   <p>
    <?php echo $bv['home_box_txt']; ?>
   </p>
   <a class="cta-btn" href="<?php echo get_permalink($bv['home_box_link']); ?>">
    <span><?php echo $bv['home_box_bttn']; ?></span>
   </a>
  </div>
  <?php endforeach; ?>
 </div>
</section>




<script>
var sbInitInfluencers = 1;
</script>