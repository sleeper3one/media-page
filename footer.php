</div>
<?php
    $footer = $api->getSiteFooter(); 
?>
<footer>
 <?php wp_footer(); ?>
 <div class="footer-cont">
  <div class="footer-info">
   <ul class="page-navigation footer-navigation">
    <?php
        foreach ($settings['menu'] as $sk => $sv):
            if ($sv['menu_type'] == "link"):
        ?>
    <li>
     <a href="<?php echo get_permalink($sv['menu_section']); ?>" class="nav-link"><?php echo $sv['menu_title']; ?></a>
    </li>
    <?php 
            endif;
        endforeach;
        ?>
    <li>
     <a href="<?php echo $footer['gdpr']['privacy']; ?>" class="nav-link">Polityka prywatności</a>
    </li>
  </div>

  <div class="footer-social">
   <a href="<?php echo $footer['li_link']; ?>" class="social-li" target="_blank">
    <img src="<?php echo apppath; ?>/assets/icon-linkedin-bold.png"
     alt="<?php echo $settings['global_name']; ?> | LinkedIn" />
   </a>
   <a href="<?php echo $footer['tt_link']; ?>" class="social-tt" target="_blank">
    <img src="<?php echo apppath; ?>/assets/icon-twitter-bold.png"
     alt="<?php echo $settings['global_name']; ?> | Twitter" />
   </a>
   <a href="<?php echo $footer['fb_link']; ?>" class="social-fb" target="_blank">
    <img src="<?php echo apppath; ?>/assets/icon-fb-bold.png"
     alt="<?php echo $settings['global_name']; ?> | Facebook" />
   </a>
   <a href="<?php echo $footer['ig_link']; ?>" class="social-ig" target="_blank">
    <img src="<?php echo apppath; ?>/assets/icon-ig-bold.png"
     alt="<?php echo $settings['global_name']; ?> | Instagram" />
   </a>
   <a href="<?php echo $footer['yt_link']; ?>" class="social-yt" target="_blank">
    <img src="<?php echo apppath; ?>/assets/icon-youtube-bold.png"
     alt="<?php echo $settings['global_name']; ?> | YouTube" />
   </a>
  </div>
 </div>
</footer>
<script>
const actionUrl = '<?php echo home_url(); ?>/kontakt/send/';
const lightboxObj = {
 prevImg: '<?php echo apppath; ?>/assets/icon-arrow-lightbox.svg',
 nextImg: '<?php echo apppath; ?>/assets/icon-arrow-lightbox.svg',
};
</script>
<script src="<?php echo apppath; ?>/scripts/lightbox.min.js?<?php echo appversion; ?>"></script>
<script src="<?php echo apppath; ?>/scripts/scripts.js?<?php echo appversion; ?>"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>