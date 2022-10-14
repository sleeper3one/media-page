<?php
$page_sections = $api->getHomeSections();
?>

<section id="portfolio-slider" class="sb-section">
 <div class="lines-top sb-lines">
  <div class="sb-line sb-line-1"></div>
  <div class="sb-line sb-line-2 sb-gradient-tr1"></div>
 </div>
 <div class="lines-bot sb-lines">
  <div class="sb-line sb-line-1"></div>
  <div class="sb-line sb-line-2 sb-gradient-tr2"></div>
 </div>


 <div class="section-wrapper">
  <div class="section-nav">
   <h3>Filary <span class="strong-h3">Agencji Arskom<span></h3>
  </div>

<div class="swiper">
  <div class="swiper-wrapper">
    <!-- slide #1 -->
    <div class="swiper-slide">
     <a class="" href="<?php site_url(); ?>/products/kanalsportowy">
     <div class="influencer-card home-width-card"> 
      <div class="card-img">
       <img class="influencer-img" src="<?php site_url(); ?>wp-content/themes/sportbrokers/assets/kanal-sportowy.png" />
      </div>
      <span class="card-name">
       KANAŁ<br />
       SPORTOWY</span>
      <span class="card-bottom"></span>
     </div>
     </a>
    </div>
    <!-- slide #2 -->
    <div class="swiper-slide">
     <a class="" href="<?php site_url(); ?>/o-nas/#media-sportowe">
     <div class="influencer-card home-width-card"> 
      <div class="card-img">
       <img class="influencer-img" src="<?php site_url(); ?>wp-content/themes/sportbrokers/assets/media-sportowe.png" />
      </div>
      <span class="card-name">
       MEDIA<br />
       SPORTOWE
      </span>
      <span class="card-bottom"></span>
     </div>
     </a>
    </div>
    <!-- slide #3 -->
    <div class="swiper-slide">
     <a class="" href="<?php site_url(); ?>/o-nas/#ambasadorzy-i-influencerzy">
     <div class="influencer-card home-width-card"> 
      <div class="card-img">
       <img class="influencer-img" src="<?php site_url(); ?>wp-content/themes/sportbrokers/assets/a_i_f.png" />
      </div>
      <span class="card-name">
       AMBASADORZY<br />
       I INFLUENCERZY
      </span>
      <span class="card-bottom"></span>
     </div>
     </a>
    </div>
    <!-- slide #4 -->
    <div class="swiper-slide"><a class="" href="<?php site_url(); ?>/o-nas/#projekty-specjalne">
     <div class="influencer-card home-width-card"> 
      <div class="card-img">
       <img class="influencer-img" src="<?php site_url(); ?>wp-content/themes/sportbrokers/assets/projekty-specjalne.png" />
      </div>
      <span class="card-name">
       PROJEKTY<br />
       SPECJALNE
      </span>
      <span class="card-bottom"></span>
     </div>
     </a>
    </div>
    <!-- slide #5 -->
    <div class="swiper-slide">
     <a class="" href="<?php site_url(); ?>/o-nas/#licensing">
     <div class="influencer-card home-width-card"> 
      <div class="card-img">
       <img class="influencer-img" src="<?php site_url(); ?>wp-content/themes/sportbrokers/assets/licensing.png" />
      </div>
      <span class="card-name">
       LICENSING
      </span>
      <span class="card-bottom"></span>
     </div>
     </a>
    </div>
</div>
  
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
    </div>


 </div>
</section>
<script>
    const swiper = new Swiper('.swiper', {
        speed: 1200,
        spaceBetween: 10,
        direction: 'horizontal',
        mousewheel: {
            invert: true,
        },
        preloadImages: false,
        lazy: true,
        lazy: {
            loadPrevNext: true,
        },
        breakpoints: {
         520: {
          slidesPerView: 1,
         },
         640: {
          slidesPerView: 2,
         },
         820: {
          slidesPerView: 3,
         },
         1060: {
          slidesPerView: 4,
         },
         1280: {
          slidesPerView: 5,
         }
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>