<?php get_header();?>

<div id="home-area">
  <section class="top">
    <h1><img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1.jpg" /></h1>
    <p>キミだけの、たった一つの。</p>
    <img src="<?php echo get_template_directory_uri(); ?>/images/scroll.svg" class="scroll" />
  </section>

  <div id="aboutus-area">
    <script>
      $(function() {
        $('.accordion .more').on('click', function() {
          $('.accordion').toggleClass('show');
        });

        $('.accordion2 .more').on('click', function() {
          $('.accordion2').toggleClass('show');
        });
      });
    </script>
    <div class="accordion">
      <div>
        <section class="text-area">
          <h2><span>CONCEPT</span>ランドセルに、オーダーメイドという選択を。</h2>
          <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
          <p>『想像力』が必要なオーダーメイドには、好みが明確になっている大人向けのアイテムが多く存在します。</p>
          <p>しかし、私たちは子どもにも”オーダーメイドを選ぶ体験”をしてほしいと思っています。</p>
          <p>イメージする力を伸ばすと想像力や社会性が豊かになります。</p>
          <p>リモコンを携帯に見立てたり、テーブルの下を秘密基地にしたりと、<br />遊びの中で社会性やコミュニケーション能力を高めていきます。</p>
          <p>『イメージしたものが形になるオーダーメイドに触れることは、子供の成長を見守るものになる』<br />と私たちは考えます。</p>
          <p>ぼくだけ、わたしだけのたった一つの組み合わせを想像してください。<br />そこにはたくさんの笑顔が生まれます。</p>
        </section>
        <button class="more"><img src="<?php echo get_template_directory_uri(); ?>/images/slide-toggle-arrow.svg" /></button>
      </div>
    </div>
    <section class="photo">
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p3.jpg" class="p3"/>
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p4.jpg" class="p4"/>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p5.jpg" />
    </section>

    <div class="accordion2">
      <div>
        <section class="about-area">
          <h2><span>ABOUT US</span>こだわりを、カタチに。</h2>
          <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
          <p>せっかく買うなら『気に入ったもの』を、<br />とことん『こだわったもの』をじっくり選んで、大切に長く愛用してほしい。</p>
          <p>そんな思いで、オーダーメイドのセレクトショップ<br />SOLO UNOはスタートしました。</p>
          <p>SOLO UNOとは[たったひとつの]というイタリア語。</p>
          <p>オーダーメイドでSOLO UNOなお気に入りをつくってください。</p>
          <p>それは、たくさんの想い出のそばに、いつまでも...<br />6年間の相棒もSOLO UNO[たったひとつの]宝物になりますように。</p>
        </section>
        <button class="more"><img src="<?php echo get_template_directory_uri(); ?>/images/slide-toggle-arrow.svg" /></button>
      </div>
    </div>
  </div>

  <section class="product">
    <h2><span>PRODUCT</span>SOLO UNOのプロダクト</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <a href="/product" class="product-custome">
      <h3><span>CUSTOME-MADE</span>オーダーメイド</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <a href="/product#disney" class="product-disney">
      <h3><span>DISNEY</span>ディズニー<br />ランドセル</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
    <a href="/product#etc" class="product-online">
      <h3><span>ONLINE STORE</span>商品一覧</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" class="dot-white" />
      <span>and more<img src="<?php echo get_template_directory_uri(); ?>/images/angle-right-white.svg" class="angle" /></span>
    </a>
  </section>

  <section class="showroom">
    <img src="<?php echo get_template_directory_uri(); ?>/images/showroom_p1.jpg" />
    <div class="area">
      <h2><span>SHOWROOM</span>店舗情報</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
      <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" class="map" />
      <div>
        <span class="moyori">【大宮駅西口徒歩4分】<br />ソニックシティ向かい新生銀行となり</span>
        <span class="open-close">
          <img src="<?php echo get_template_directory_uri(); ?>/images/clock.svg" />10:00〜17:00  [火・水曜定休]
        </span>
        <address>〒330-0854<br />埼玉県さいたま市大宮区桜木町1-9-1 三谷ビル1階</address>
        <span class="tell"><img src="<?php echo get_template_directory_uri(); ?>/images/tell.svg" />048-658-3900</span>
        <a href="https://goo.gl/maps/eoRcmGMziU8eKetU8" target="_blank">Google Mapsを開く</a>
      </div>
    </div>
  </section>

  <section class="news">
    <h2><span>NEWS</span>お知らせ</h2>
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
      <h2><span>EXHIBITION</span>展示会情報</h2>
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
