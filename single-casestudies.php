<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$prod = $api->getCase($post->ID);
$page_cover = $api->getPageCover();
?>

<section id="case-page" class="sb-section sb-page">
    <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
        <div class="sb-section-intro">
            <div class="sb-section-info">
                <h1><?php echo $prod['title']; ?></h1>
            </div>
            <div class="header-gfx">
                <picture alt="<?php echo $prod['title']; ?>">
                <?php 
                    $image = get_field('case_logo');
                    $size = 'case_single';
                        if( $image ) {
                            echo wp_get_attachment_image( $image, $size );
                        }
                ?>
            </picture>
            </div>
        </div>
    </div>
    <div class="sb-page-content">
        <?php if (is_array($prod['case_icons'])): ?>
        <div class="sb-page-icons">
            <?php foreach ($prod['case_icons'] as $pk => $pv): ?>
            <div class="sb-icon-item">
                <strong class="icon-val" data-value="<?php echo $pv['ico_value']; ?>"><?php echo $pv['ico_value']; ?></strong>
                <?php if (!empty($pv['ico_gfx'])): ?>
                <em class="icon-<?php echo $pv['ico_gfx']; ?>"></em>
                <?php endif; ?>
                <span><?php echo $pv['ico_name']; ?></span>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="sb-page-info">
            <div class="sb-page-desc">
                <?php echo $prod['case_excerpt']; ?>
            </div>
            <?php if (is_array($prod['case_photos'])): ?>
            <div class="sb-page-photos">
                <div class="photos-wrapper">
                    <?php foreach ($prod['case_photos'] as $fk => $fv): ?>
                        <img src="<?php echo $fv['url']; ?>" 
                        alt="<?php echo $prod['name']; ?>"
                        data-jslghtbx="<?php echo $fv['url']; ?>"
                        data-jslghtbx-group="case_photos" />
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="sb-page-desc">
                <?php echo $prod['case_description']; ?>
            </div>
            <div class="sb-page-video">
                <?php echo $prod['case_video']; ?>
            </div>
        </div>
    </div>
    <div class="sb-page-bot-nav">
        <a href="<?php site_url() ?>/case-studies/">
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
      next_post_link('%link', '← Poprzedni Case');
      } else { 
        $last = new WP_Query('post_type=casestudies&posts_per_page=1&order=ASC'); $last->the_post();
        echo '<a href="' . get_permalink() . '">← Poprzedni Case</a>';
        wp_reset_query();
      }; 
      if( get_adjacent_post(false, '', true) ) { 
      previous_post_link('%link', 'Następny Case →');
      } else { 
        $first = new WP_Query('post_type=casestudies&posts_per_page=1&order=DESC'); $first->the_post();
        echo '<a href="' . get_permalink() . '">Następny Case →</a>';
        wp_reset_query();
      };
    ?>
  </div>
    </div>
</section>

<?php
require templatepath . '/footer.php';
?>