<?php get_header();?>

<div id="home-area">
  <section class="top">
    <h1><img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1.jpg" /></h1>
    <p>キミだけの、たった一つの。</p>
    <img src="<?php echo get_template_directory_uri(); ?>/images/scroll.svg" class="scroll" />
  </section>

  <div id="aboutus-area">
    <section class="aboutus-top">
      <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p2.jpg" />
      <div>
        <h2>SOLO UNOについて</h2>
        <img src="<?php echo get_template_directory_uri(); ?>/images/dot-mini.svg" />
      </div>
    </section>
    <section class="text-area">
      <h2><span>Concept</span>キミだけの、たった一つの。</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
      <p>イメージする力を伸ばすと想像力や社会性が豊かになります。</p>
      <p>リモコンを携帯に見立てたり、テーブルの下を秘密基地にしたりと遊びの中で社会性にコミュニケーション能力を高めていきます。</p>
      <p>イメージしたものが形になるオーダーメイドに触れることは子供の成長を見守るものになると私たちは考えます。</p>
      <p>ぼくだけ、わたしだけのたった一つの組み合わせを想像してください。<br />そこにはたくさんの笑顔が生まれます。</p>
    </section>
    <section class="photo">
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p3.jpg" class="p3"/>
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p4.jpg" class="p4"/>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p5.jpg" />
    </section>
    <section class="about-area">
      <h2><span>About Us</span>こだわりをカタチに。</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
      <p>せっかく買うなら『気に入ったもの』を、とことん『こだわったもの』をじっくり選んで、大切に長く愛用してほしい。</p>
      <p>そんな思いで、オーダーメイドのセレクトショップSOLO UNOはスタートしました。</p>
      <p>SOLO UNOとは[たったひとつの]というイタリア語。</p>
      <p>オーダーメイドでSOLO UNOなお気に入りを作ってください。</p>
      <p>それは、たくさんの想い出のそばに、いつまでも...<br />6年間の相棒もSOLO UNO[たったひとつの]宝物になりますように。</p>
    </section>

  </div>

  <section class="aboutus">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p2.jpg" />
    <div class="area">
      <h2><span>About US</span>SOLO UNOについて</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
      <p>テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。</p>
      <a href="<?php echo home_url('/')?>aboutus">and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right.svg" class="angle" /></a>
    </div>
  </section>

  <section class="product">
    <h2><span>PRODUCT</span>SOLO UNOのプロダクト</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <a href="" class="product-custome">
      <h3><span>CUSTOME-MADE</span>オーダーメイド</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <a href="" class="product-online">
      <h3><span>Other</span>その他商品</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <!-- <a href="" class="product-disney">
      <h3><span>DISNEY</span>ディズニー<br />ランドセル</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>-->
  </section>

  <section class="showroom">
    <img src="<?php echo get_template_directory_uri(); ?>/images/showroom_p1.jpg" />
    <div class="area">
      <h2><span>SHOWROOM</span>店舗情報</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
      <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" class="map" />
      <p class="open-close">10:00〜17:00<br />[火・水曜定休] </p>
      <p class="address">〒330-0854<br />埼玉県さいたま市大宮区桜木町1-9-1 三谷ビル1階</p>
      <a href="">Google Mapsを開く</a>
    </div>
  </section>

  <section class="news">
    <h2><span>News</span>お知らせ</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />

    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <figure>
      <a href="<?php echo get_permalink( $id );?>">
        <?php the_post_thumbnail();?>
        <figcaption>
          <span><?php echo get_the_date(); ?></span>
          <p><?php the_title(); ?></p>
        </figcaption>
      </a>
    </figure>
    <?php endwhile; ?>
    <?php endif; ?>

    <a href="<?php echo home_url('/')?>news">and more</a>
  </section>

  <section class="exhibition">
    <img src="<?php echo get_template_directory_uri(); ?>/images/exhibition-image.jpg" />
    <div class="exhibition-inner">
      <h2><span>Exhibition</span>展示会情報</h2>
      <p>各地で開催される展示会情報です。</p>
      <a href="exhibit">and more</a>
    </div>
  </section>

  <!--
  <section class="column">
    <h2><span>Column</span>コラム</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          コラムのタイトルですコラムのタイトルですコラムのタイトルですコラムのタイトル...
        </figcaption>
      </a>
    </figure>
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          コラムのタイトルですコラムのタイトルですコラムのタイトルですコラムのタイトル...
        </figcaption>
      </a>
    </figure>
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          コラムのタイトルですコラムのタイトルですコラムのタイトルですコラムのタイトル...
        </figcaption>
      </a>
    </figure>
    <a href="<?php echo home_url('/')?>column">and more</a>
  </section>
-->
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer();?>
