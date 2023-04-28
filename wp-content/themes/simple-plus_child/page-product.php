<?php get_header(); ?>

<div id="product-area">
  <section class="product-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p6.jpg" />
    <div>
      <h2>SOLO UNOのプロダクト</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <section class="ordermade-area">
    <h2><span>CUSTOME-MADE</span>オーダーメイドランドセル<br /><span class="ec">EC取り扱い</span><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <a href="https://sim.solouno-ordermade.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ordermade.jpg" class="om-p1" /></a>
    <p>SOLO UNOのオーダーメイドランドセルは メインカラーやコンビカラー、デザインなど、806,400通りの 組み合わせから選んでつくるランドセルです。</p>
    <p>シミュレーターでたくさんの組み合わせの中から [たったひとつ]の自分だけのランドセルを探し出さしてください。</p>
    <a href="https://sim.solouno-ordermade.com" class="om-link">オーダーメイドを選んでみよう<br />【シミュレーター】</a>
    <a href="<?php echo home_url('/')?>flow" class="flow-link">オーダーメイドランドセル</a>
    <a href="<?php echo home_url('/')?>flow#gallery" class="flow-link">GALLERY</a>
    <a href="<?php echo home_url('/')?>flow#change" class="flow-link">組み合わせのご変更はこちら</a>
  </section>
  <section class="disney-area" id="disney">
    <h2><span>DISNEY</span>ディズニーランドセル<br /><span class="ec">EC取り扱い</span><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney-p1.jpg" class="disney-p1" />
    <p>大好きなキャラクターと毎日一緒に。<br />ミッキーマウスとミニーマウスの選べるランドセルが新登場。</p>
    <p>ミッキーとミニーのディズニーランドセルは、色の組み合わせが選べるオーダーメイドのランドセルです。<br />
    店舗には、手に取り背負い心地や色味をお確かめいただけるサンプルをご用意しています。</p>
    <a href="https://disneysim.solouno-ordermade.com" class="om-link">ディズニーオーダーを選んでみよう<br />【シミュレーター】</a>
    <a href="<?php echo home_url('/')?>disney" class="flow-link">ディズニーオーダーメイドランドセル</a>
  </section>
  <section class="marty-area" id="etc">
    <h2><span>MARTY</span>マーティ<br /><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/marty.jpg" class="marty-p1" />
    <p>神戸、芦屋のレザーショップ「Marty」の本革パーツを組み合わせてランドセルカバーをデコレーション。</p>
    <!-- <a href="#">商品を見る</a> -->
  </section>
  <section class="totebag-area">
    <h2><span>TOTE BAG</span>トートバッグ<br /><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/totebag.jpg" class="totebag-p1" />
    <p>イニシャルやマークをワンポイントで刺繍。<br />オリジナルデザインのトートバッグがつくれます。</p>
    <!-- <a href="#">商品を見る</a> -->
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
