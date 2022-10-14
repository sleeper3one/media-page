<?php
$page_sections = $api->getHomeSections();
?>
<section id="home-case" class="sb-section">
 <h3>Case studies</h3>
 <div class="home-case-list">
  <?php foreach ($page_sections['cases'] as $pk => $pv): ?>
  <?php $iitem = $api->getCase($pv['home_case_item']); ?>
  <div class="case-list-item">
   <a href="<?php echo get_permalink($iitem['id']); ?>" class="case-card"
    style="background-image: url('<?php echo $iitem['case_logo']['url']; ?>');">
    <span class="card-img"></span>
   </a>
  </div>
  <?php endforeach; ?>
 </div>
 <div class="case-btn-cont">
  <a class="cta-btn caseslist-btn" href="<?php echo get_permalink(17); ?>">
   <span>zobacz więcej</span>
  </a>
 </div>
</section>