<?php 
if (!$api) {
  $api = new neatApi();
}
$settings = $api->getSiteSettings();
?>
<!doctype html>
<html lang="en">

<head>
 <!-- Google Tag Manager -->
 <script>
 (function(w, d, s, l, i) {
  w[l] = w[l] || [];
  w[l].push({
   'gtm.start': new Date().getTime(),
   event: 'gtm.js'
  });
  var f = d.getElementsByTagName(s)[0],
   j = d.createElement(s),
   dl = l != 'dataLayer' ? '&l=' + l : '';
  j.async = true;
  j.src =
   'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
  f.parentNode.insertBefore(j, f);
 })(window, document, 'script', 'dataLayer', 'GTM-W5Q8BBR');
 </script>
 <!-- End Google Tag Manager -->
 <meta charset="utf-8" />
  <title><?php echo $settings['title']; ?></title>
  <meta name="description" content="<?php echo $settings['desc']; ?>" />
  <meta name="keywords" content="<?php echo $settings['keywords']; ?>" />
  <meta name="author" content="NeatCreations" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta property="og:title" content="<?php echo $settings['title']; ?>" />
  <meta property="og:description" content="<?php echo $settings['desc']; ?>" />
  <meta property="og:image" content="<?php echo $settings['og_img']['url']; ?>" />
 
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;subset=latin-ext" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="<?php echo apppath; ?>/css/lightbox.css?<?php echo appversion; ?>" />
  <link rel="stylesheet" href="<?php echo apppath; ?>/style.css?<?php echo appversion; ?>" />
  <link rel="shortcut icon" type="image/png" href="<?php echo apppath; ?>/favicon.png" />
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $settings['api_analytics']; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?php echo $settings['api_analytics']; ?>');
  </script>
 
  <meta name="facebook-domain-verification" content="09hrm4mgemf121y7d68ql3a56k6kz9" />

 <!-- Facebook Pixel Code -->
 <script>
 ! function(f, b, e, v, n, t, s) {
  if (f.fbq) return;
  n = f.fbq = function() {
   n.callMethod ?
    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
  };
  if (!f._fbq) f._fbq = n;
  n.push = n;
  n.loaded = !0;
  n.version = '2.0';
  n.queue = [];
  t = b.createElement(e);
  t.async = !0;
  t.src = v;
  s = b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t, s)
 }(window, document, 'script',
  'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '790104195106378');
 fbq('track', 'PageView');
 </script>
 <noscript>
  <img height="1" width="1" src="https://www.facebook.com/tr?id=790104195106378&ev=PageView
&noscript=1" />
 </noscript>
 <!-- End Facebook Pixel Code -->
 <?php wp_head(); ?>
</head>

<body <?php body_class('arskom'); ?>>
 <!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W5Q8BBR" height="0" width="0"
   style="display:none;visibility:hidden"></iframe></noscript>
 <!-- End Google Tag Manager (noscript) -->
 <div id="page-wrapper">