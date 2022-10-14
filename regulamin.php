<?php
require templatepath . '/header.php';
?>
    <div class="page-regulations">
        <a href="<?php echo home_url(); ?>" class="error-logo">
            <img src="<?php echo apppath; ?>/assets/breyers-logo-delight.svg" />
        </a>
        <div class="page-txt-content">
            <?php echo get_field('error_404', 1); ?>
        </div>
    </div>
</div>
</html>