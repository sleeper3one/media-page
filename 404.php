<?php
require templatepath . '/header.php';
?>
    <div class="error-404">
        <a href="<?php echo home_url(); ?>" class="error-logo">
            <img src="<?php echo apppath; ?>/assets/sb-logo-black.png" />
        </a>
        <div class="error-404-content">
            <?php echo get_field('error_404', 1); ?>
        </div>
    </div>
</div>
</html>