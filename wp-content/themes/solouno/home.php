<html <?php language_attributes(); ?> class="no-js">
<?php if (is_single()) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php } else { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<?php } ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SRR7NPDJ2S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SRR7NPDJ2S');
</script>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="shortcut icon" href="<?php echo home_url( "/" );?>favicon.svg" type="image/svg+xml">
  <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/bxslider.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.matchHeight-min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.inview.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.0/lottie.min.js"></script>

  <link href="<?php echo get_template_directory_uri(); ?>/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/scss/style.css?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&family=Noto+Serif+JP:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">


  <?php if (is_single()): ?>
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
  <meta property="og:title" content="<?php echo get_post_meta($post->ID, "_aioseop_title", true); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php the_permalink(); ?>" />
  <?php
    $thumbnail_id = get_post_thumbnail_id();
    $img_url = wp_get_attachment_image_src( $thumbnail_id , 'full' );
  ?>
  <meta property="og:image" content="<?php echo $img_url[0]; ?>" />
  <meta property="og:site_name" content="HAUSS SUPPORT" />
  <meta property="og:description" content="<?php echo get_post_meta($post->ID, "_aioseop_description", true); ?>" />
  <meta property="og:image:width" content="840" />
  <meta property="og:image:height" content="560" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?php the_permalink(); ?>" />
  <meta name="twitter:title" content="<?php echo get_post_meta($post->ID, "_aioseop_title", true); ?>" />
  <meta name="twitter:description" content="<?php echo get_post_meta($post->ID, "_aioseop_description", true); ?>" />
  <meta name="twitter:image" content="<?php echo $img_url[0]; ?>" />
  <?php endwhile; endif; ?>
  <?php endif; ?>

  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.svg" type="image/svg+xml">

  <!--[if lt IE 9]>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <script>
    $(function(){
      $('.textAnimation').on('inview', function(event, isInView) {
        if (isInView) {
        //表示領域に入った時
          $(this).addClass('textAnimationIn');
        } else {
        }
      });

      $('.imgAnimation').on('inview', function(event, isInView) {
        if (isInView) {
        //表示領域に入った時
          $(this).addClass('imgAnimationIn');
        } else {
        }
      });
    });
  </script>

<section id="home">
  <h1>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://lottie.host/0e0894f6-8b7b-44e5-9f95-3f2ef8491532/vMfUYNWIIp.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  autoplay></lottie-player>
  </h1>
  <p>ホームページとシュミレーターは<br />現在準備中です。</p>
  <a href="/request" class="textAnimation">ランドセルオーダーメイドの<br />資料請求はこちら</a>
</section>
<?php wp_footer();?>
</body>
</html>