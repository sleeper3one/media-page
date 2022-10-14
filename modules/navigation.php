<nav>
 <a href="<?php echo home_url(); ?>" class="sb-logo">
  <img src="<?php echo apppath; ?>/assets/sb-logo.png" alt="<?php echo $settings['global_name']; ?>" />
 </a>
 <ul class="page-navigation">
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
 </ul>
 <a href="javascript:sb.menuShow();" class="menu-button"><span></span></a>
</nav>