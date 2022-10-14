<?php
get_header();
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';
$author_id=$post->post_author;
$bpost = $api->getPost($post->ID);
$page_cover = $api->getPageCover();

$rposts = $api->getRelatedPostsList();
?>

<div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
</div>

<div class="post-page">
 <section class="arrow-back">
  <a href="/blog" class="take-back">
   <svg width="24" height="24" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
    viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
    <path
     d="m9.474 5.209s-4.501 4.505-6.254 6.259c-.147.146-.22.338-.22.53s.073.384.22.53c1.752 1.754 6.252 6.257 6.252 6.257.145.145.336.217.527.217.191-.001.383-.074.53-.221.293-.293.294-.766.004-1.057l-4.976-4.976h14.692c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.692l4.978-4.979c.289-.289.287-.761-.006-1.054-.147-.147-.339-.221-.53-.221-.191-.001-.38.071-.525.215z"
     fill-rule="nonzero" />
   </svg>
  </a>
 </section>
 <section class="post-content">

  <div class="post-header">
   <div class="author-avatar">
    <?php echo $bpost['avatar']; ?>
   </div>
   <div class="post-data">
    <div class="post-author">
     <?php the_author_meta( 'display_name' , $author_id ); ?><span class="author-icon"><svg
       xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
       <path
        d="M9.963 8.261c-.566-.585-.536-1.503.047-2.07l5.948-5.768c.291-.281.664-.423 1.035-.423.376 0 .75.146 1.035.44l-8.065 7.821zm-9.778 14.696c-.123.118-.185.277-.185.436 0 .333.271.607.607.607.152 0 .305-.057.423-.171l.999-.972-.845-.872-.999.972zm8.44-11.234l-3.419 3.314c-1.837 1.781-2.774 3.507-3.64 5.916l1.509 1.559c2.434-.79 4.187-1.673 6.024-3.455l3.418-3.315-3.892-4.019zm9.97-10.212l-8.806 8.54 4.436 4.579 8.806-8.538c.645-.626.969-1.458.969-2.291 0-2.784-3.373-4.261-5.405-2.29z" />
      </svg></span>
    </div>
    <div class="post-date"><?php echo $bpost['data']; ?>
    </div>

   </div>
  </div><!-- post-header -->

  <div class="post-title">
   <h2>
    <a href="<?php echo get_permalink($bpost['id']); ?>" class="post-link">
     <?php echo $bpost['title']; ?>
    </a>
   </h2>
  </div>
  <div class="post-text">
   <?php echo $bpost['post']; ?>
  </div>


 </section><!-- post-content -->

 <section class="after-post-navigation">
  <span>
   <p>Ostatnie posty</p>
  </span>
  <span class="see-all">
   <p><a href="/blog">Zobacz wszytskie</a></p>
  </span>
 </section>

 <section class="related-posts">


  <?php foreach ($rposts as $pk => $pv): ?>
  <?php $iitem = $pv; ?>

  <div class="single-related-post">

   <a href="<?php echo get_permalink($iitem['id']); ?>">
    <div class="related-post-photo">
     <img src="<?php echo $iitem['zdjecie_mini']['url']; ?>" alt="">
    </div>
    <div class="post-title">
     <h3>
      <?php echo $iitem['title']; ?>
     </h3>
    </div><!-- post-title -->
   </a>

   <div class="related-bottom-part">
    <div class="hr-line-related"></div>
    <div class="on-bottom-excerpt">
     <span><?php do_shortcode('[post-views]'); ?></span>
     <span>
      <a href="<?php echo get_permalink($iitem['id']); ?>" class="link-arrow">
       <svg width="24" height="24" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
        viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
        <path
         d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z"
         fill-rule="nonzero" />
       </svg>
      </a>
     </span>
    </div>
   </div><!-- bottom-part -->
  </div><!-- single-related-post -->
  <?php endforeach; ?>
 </section><!-- related-posts -->

 <section class="comments-section">
  <?php comments_template('', true); ?>
 </section>

</div><!-- post-page -->
<?php
require templatepath . '/footer.php';
get_footer();
?>