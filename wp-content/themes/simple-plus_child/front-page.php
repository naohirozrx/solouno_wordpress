<?php get_header();?>
<script>
  $(window).on('load', function() {
    const fadeInUpAll = document.querySelectorAll('.inview');
    intersectAction(fadeInUpAll, function (element, isIntersecting) {
      if(isIntersecting){
        element.classList.add('isInview');
      }
    })
  });
</script>
<div id="home-area">
  <section class="top">
    <h1 class="inview"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/home-top_p1.jpg" /></h1>
    <p><span class="inview">キ</span><span class="inview">ミ</span><span class="inview">だ</span><span class="inview">け</span><span class="inview">の</span><span class="inview">、</span><span class="inview">た</span><span class="inview">っ</span><span class="inview">た</span><span class="inview">一</span><span class="inview">つ</span><span class="inview">の</span><span class="inview">。</span></p>
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/scroll.svg" class="scroll" />
  </section>

  <section id="aboutus-enjoy">
    <h2 class="inview">選ぶことの楽しさ</h2>
    <p class="inview">お名前が入ることの特別感を</p>
    <p class="inview">よりスペシャルなものに</p>
    <p class="inview">「キミだけのたったひとつ」の</p>
    <img class="bg1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-midium.svg" />
    <img class="bg2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-large.svg" />
    <p class="inview">ランドセルを手にとってもらいたい</p>
    <p class="inview">お子さまの</p>
    <p class="inview">「可愛い！欲しい！のわくわく感」と</p>
    <p class="inview">大人の求める「丈夫さや機能性」を</p>
    <p class="inview">併せ持つランドセルを</p>
    <p class="inview">ソロウーノは目指しています</p>
    <p class="inview">ぜひ、</p>
    <p class="inview">”選んで楽しい、使いごこちのよいランドセル”</p>
    <p class="inview">を体感してください</p>
    <img class="bg3 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-small.svg" />
    <a href="/about" class="inview">SOLO UNOについて</a>
  </section>

  <section class="product">
    <h2><span>PRODUCT</span>SOLO UNOのプロダクト</h2>
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <a href="/product" class="product-custome">
      <h3><span>CUSTOME-MADE</span>オーダーメイド</h3>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <a href="/product#disney" class="product-disney">
      <h3><span>DISNEY</span>ディズニー<br />ランドセル</h3>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <a href="/product#etc" class="product-online">
      <h3><span>ONLINE STORE</span>商品一覧</h3>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
  </section>

  <section class="showroom">
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/showroom_p1.jpg" />
    <div class="area">
      <h2><span>SHOWROOM</span>店舗情報</h2>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/map.png" class="map" />
      <div>
        <span class="moyori">【大宮駅西口徒歩4分】<br />ソニックシティ向かい新生銀行となり</span>
        <span class="open-close">
          <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/clock.svg" />10:00〜17:00  [火・水曜定休]
        </span>
        <address>〒330-0854<br />埼玉県さいたま市大宮区桜木町1-9-1 三谷ビル1階</address>
        <span class="tell"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/tell.svg" />048-658-3900</span>
        <a href="https://goo.gl/maps/eoRcmGMziU8eKetU8" target="_blank">Google Mapsを開く</a>
      </div>
    </div>
  </section>

  <section class="news">
    <h2><span>NEWS</span>お知らせ</h2>
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />

    <?php
      $args = array (
        'post_type'      => 'news',
        'posts_per_page' => 3,
      );
      $myposts = get_posts( $args );
      foreach( $myposts as $post ):
        setup_postdata($post);
    ?>
    <figure>
      <a href="<?php echo get_permalink( $id );?>">
        <?php the_post_thumbnail();?>
        <figcaption>
          <span><?php echo get_the_date(); ?></span>
          <p><?php the_title(); ?></p>
        </figcaption>
      </a>
    </figure>
    <?php
      endforeach;
      wp_reset_postdata();
    ?>

    <a href="<?php echo home_url('/')?>news">and more</a>
  </section>

  <section class="exhibition">
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/exhibition-image.jpg" />
    <div class="exhibition-inner">
      <h2><span>EXHIBITION</span>展示会情報</h2>
      <p>各地で開催される展示会情報です。</p>
      <a href="exhibit">and more</a>
    </div>
  </section>

  <section class="column">
    <h2><span>Column</span>コラム</h2>
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />

    <?php
			$args = array( 'post_type' => 'column', );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
		?>
    <figure>
      <a href="<?php echo get_permalink( $id );?>">
        <?php the_post_thumbnail();?>
        <figcaption>
          <span><?php echo get_the_date(); ?></span>
          <p><?php the_title(); ?></p>
        </figcaption>
      </a>
    </figure>
    <?php
			endforeach; 
			wp_reset_postdata();
    ?>
    <a href="<?php echo home_url('/')?>column">and more</a>
  </section>

</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer();?>
