<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$page_h1 = get_field('section_h1', $post->ID);
$page_cover = $api->getPageCover();
$products = $api->getProducts();
$portfolio = $api->getPortfolio();
$page_sections = $api->getHomeSections();
?>

<section id="portfolio-page" class="sb-section sb-page">

 <div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
  <div class="sb-header-single">
   <h1><?php echo $page_h1; ?></h1>
  </div>

 <div class="products-list">
  <?php foreach ($products as $pk => $pv): ?>
  <?php $iitem = $pv; ?>
  <div class="case-list-item product-item">
   <a href="<?php echo get_permalink($iitem['id']); ?>" class="case-card product-card">
    <div class="product-photo-skew-box">
     <div class="product-anti-skew-box">
      <img class="product-skew-photo" src="<?php echo $iitem['product_logo']['url']; ?>'" alt="<?php echo $iitem['title']; ?>">
     </div>
    </div>
    <span class="product-case-title white"><?php echo $iitem['title']; ?></span>
   </a>
  </div>
  <?php endforeach; ?>
 </div>
 </div>
</section>

<section id="portfolio-products" class="sb-section">

 <h3 id="ambasadorzy">AMBASADORZY</h3>
<div class="portfolio-list">
            <?php foreach ($portfolio as $pk => $pv): ?>
            <?php $iitem = $pv; ?>
            <a class="portfolio-item" href="<?php echo get_permalink($iitem['id']); ?>">
                <div class="influencer-card">
                    <span class="card-top"></span>
                    <div class="card-img">
                        <img src="<?php echo $iitem['person_avatar']['url']; ?>" />
                    </div>
                    <span class="card-name">
                        <?php echo $iitem['person_first_name']; ?><br/>
                        <?php echo $iitem['person_last_name']; ?>
                    </span>
                    <span class="card-bottom"></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
</section>

<?php
require templatepath . '/footer.php';
?>