<?php

require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$jobs = get_field('career_list', $post->ID);
$page_h1 = get_field('section_h1', $post->ID);
$page_cover = $api->getPageCover();

$aplikuj = get_field('aplikuj-head', $post->ID);
$aplikuj_tag = get_field('aplikuj-tag', $post->ID);

?>

<section id="page-content" class="sb-section sb-page">
 <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
  <div class="sb-header-single">
   <h1><?php echo $page_h1; ?></h1>
   <h2 class="job-headline"><?php echo $aplikuj ?></h2>
   <h3 class="job-tagline"><?php echo $aplikuj_tag ?></h3>
  </div>
 </div>
 <div class="jobs-page">
  <div class="jobs-list">
   <h4><?php echo get_field('section_h2', $post->ID); ?></h4>
   <div class="career-selector">
    <?php foreach ($jobs as $jk => $jv): ?>
    <a href="javascript:sb.showJobOffer(<?php echo $jk+1; ?>);"
     class="cta-btn job-select <?php echo ($jk == 0) ? 'on-air' : ''; ?>" data-id="<?php echo $jk+1; ?>">
     <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 311.811 76.69293">
      <polygon points="1.499 55.193 1 1.5 310.311 1.5 310.311 76.193 1.499 76.193" />
     </svg>
     <span><?php echo $jv['job_title']; ?></span>
    </a>
    <?php endforeach; ?>
   </div>
  </div>
  <div class="career-offers">
   <?php foreach( $jobs as $jk => $jv ): ?>
   <div class="job-offer <?php echo ($jk == 0) ? 'on-air' : ''; ?>" id="job-<?php echo $jk+1; ?>">
    <h2><?php echo $jv['job_title']; ?></h2>
    <?php echo $jv['job_desc']; ?>
   </div>
   <?php endforeach; ?>
  </div>
 </div>
</section>

<?php

require templatepath . '/footer.php';
?>