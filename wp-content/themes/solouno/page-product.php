<?php get_header(); ?>

<div id="product-area">
  <section class="product-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p6.jpg" />
    <div>
      <h2>SOLO UNOのプロダクト</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <section class="ordermade-area">
    <h2><span>CUSTOME-MADE</span>オーダーメイドランドセル</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/ordermade.jpg" class="om-p1" />
    <p>テキストがこちらに入ります。テキストがこちらに入ります。<br />テキストがこちらに入ります。テキストがこちらに入ります。テキストがこちらに入ります。</p>
    <a href="<?php echo home_url('/')?>flow">便利機能・ランドセルができるまで</a>
  </section>
  <section class="disney-area">
    <h2><span>DISNEY</span>ディズニーランドセル</h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/disney-p1.jpg" class="disney-p1" />
    <p>大好きなキャラクターと毎日一緒に。<br />ミッキーマウスとミニーマウスの選べるランドセルが新登場。</p>
    <!-- <a href="#">商品を見る</a> -->
  </section>
  <section class="marty-area">
    <h2><span>MARTY</span>マーティ<span class="info">店舗限定</span></h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/marty.jpg" class="marty-p1" />
    <p>神戸、芦屋のレザーショップ「Marty」の本革パーツを組み合わせてランドセルカバーをデコレーション。</p>
    <!-- <a href="#">商品を見る</a> -->
  </section>
  <section class="totebag-area">
    <h2><span>TOTE BAG</span>トートバッグ<span class="info">店舗限定</span></h2>
    <img src="<?php echo get_template_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/totebag.jpg" class="totebag-p1" />
    <p>イニシャルやマークをワンポイントで刺繍。<br />オリジナルデザインのトートバッグがつくれます。</p>
    <!-- <a href="#">商品を見る</a> -->
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
