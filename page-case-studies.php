<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$page_h1 = get_field('section_h1', $post->ID);
$page_cover = $api->getPageCover(); 
$cases = $api->getCasesList();
?>

<section id="cases-page" class="sb-section sb-page">
   <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
      <div class="sb-header-single">
         <h1><?php echo $page_h1; ?></h1>
      </div>
   </div>

   <div class="home-case-list cases-full-list">

      <div class="dropdown-filter-list filter js-filter">
         <div>
            <div class="js-filter-form">
               <ul name="categories" class="js-filter-select">
               <?php
                  $cat_args = array(
                  'order'   => 'DESC',
                  );

                  $categories = get_categories($cat_args);
      
                  foreach($categories as $cat) : ?>
                  
                  <li class="js-filter-item"><a href="<?= $cat->term_id; ?>"><?= $cat->name; ?></a></li>
                  
                  <?php endforeach;
                  wp_reset_postdata(); 
                  ?>
               </ul>
   
            </div>
         </div>
   
         <main class="home-case-list cases-full-list">

               <?php 
                  foreach ($cases as $pk => $pv):
                  $iitem = $pv;
               ?>
         
              <div class="case-list-item cases-item">
               <a href="<?php echo get_permalink($iitem['id']); ?>" class="case-card" 
               style="background-image: url('<?php echo $img['url']; ?>');">
                  <span class="card-img"></span>
                  <span class="case-title"><?php echo the_title(); ?></span>
               </a>
         </div>

            <?php 
               endforeach;
               wp_reset_postdata();
            ?>

            </main>
      </div><!-- .dropdown-filter-list .filter .js-filter -->
   </div><!-- .home-case-list .cases-full-list -->
   <div class="load_more_section">
      <a href="" class="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
         <span class="loading-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 3c-1.613 0-3.122.437-4.432 1.185l1.65 2.445-6.702-.378 2.226-6.252 1.703 2.522c1.633-.959 3.525-1.522 5.555-1.522 4.406 0 8.197 2.598 9.953 6.34l-1.642 1.215c-1.355-3.258-4.569-5.555-8.311-5.555zm13 12.486l-2.375-6.157-5.307 3.925 3.389.984c-.982 3.811-4.396 6.651-8.488 6.75l.891 1.955c4.609-.461 8.373-3.774 9.521-8.146l2.369.689zm-18.117 3.906c-2.344-1.625-3.883-4.33-3.883-7.392 0-1.314.29-2.56.799-3.687l-2.108-.12c-.439 1.188-.691 2.467-.691 3.807 0 3.831 1.965 7.192 4.936 9.158l-1.524 2.842 6.516-1.044-2.735-6.006-1.31 2.442z"/></svg></span>
         <span class="text">Pokaż więcej</span>
      </a>
   </div>
</section>

<?php
require templatepath . '/footer.php';
?>