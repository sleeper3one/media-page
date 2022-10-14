<?php 
$img = get_field('case_logo'); 
$case_cat = get_field('case_category');
?>

 
 <div class="case-list-item cases-item">
            <a href="<?php echo get_permalink($iitem['id']); ?>" class="case-card" 
            style="background-image: url('<?php echo $img['url']; ?>');">
                <span class="card-img"></span>
                <span class="case-title"><?php echo the_title(); ?></span>
                <div class="case-type"><?php echo $case_cat; ?></div>
            </a>
        </div>

