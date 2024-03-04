<?php get_header(); ?>
<?php
if(have_posts()):
   while(have_posts()):the_post();
?>
<div id="product-area">
  <section class="product-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p6.jpg" />
    <div>
      <h2>SOLO UNOのプロダクト</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <?php if(have_rows('プロダクト')): ?>
  <?php while(have_rows('プロダクト')): the_row(); ?>
    <section class="ordermade-area">
      <h2><span><?php the_sub_field('タイトル英語表記'); ?></span><?php the_sub_field('タイトル日本語表記'); ?><br />
      <?php
      $fruits = get_field('取扱い種別');
      if( $fruits ): ?>
      <?php foreach( $fruits as $fruit ): ?>
        <?php if($fruit == 'EC取り扱い'):?>
        <span class="ec"><?php echo $fruit; ?></span>
        <?php elseif($fruit == '店舗取り扱い'): ?>
          <span class="info"><?php echo $fruit; ?></span>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php endif; ?>
      </h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
      <?php $img = get_sub_field('サムネイル画像'); ?>
      <img src="<?php echo $img['url']; ?>" class="thumbnail" />
      <div class="text-contents">
        <?php echo nl2br(get_sub_field('説明文')); ?>
      </div>
      <?php if(have_rows('links')): ?>
      <?php while(have_rows('links')): the_row(); ?>
      <?php if(get_sub_field('新規ウィンドウで開く')):?>
        <a href="<?php the_sub_field('url'); ?>" class="om-link" target="_blank"><?php the_sub_field('タイトル'); ?></a>
      <?php else: ?>
        <a href="<?php the_sub_field('url'); ?>" class="flow-link"><?php the_sub_field('タイトル'); ?></a>
      <?php endif; ?>
      <?php endwhile; ?>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
  <?php endif; ?>
  
  <section class="ordermade-area">
    <h2><span>CUSTOME-MADE</span>オーダーメイドランドセル<br /><span class="ec">EC取り扱い</span><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <a href="https://sim.solouno-ordermade.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ordermade.jpg" class="om-p1" /></a>
    <p>SOLO UNOのオーダーメイドランドセルは メインカラーやコンビカラー、デザインなど、806,400通りの 組み合わせから選んでつくるランドセルです。</p>
    <p>シミュレーターでたくさんの組み合わせの中から [たったひとつ]の自分だけのランドセルを探し出さしてください。</p>
    <a href="https://sim.solouno-ordermade.com" class="om-link" target="_blank">オーダーメイドを選んでみよう<br />【シミュレーター】</a>
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
    <a href="https://sim.shibuya-randsel.com/" class="om-link" target="_blank">ディズニーオーダーを選んでみよう<br />【シミュレーター】</a>
    <a href="<?php echo home_url('/')?>disney" class="flow-link">ディズニーオーダーメイドランドセル</a>
  </section>

  <section class="sports-area" id="sports">
    <h2><span>SPORTS BLAND</span>スポーツブランドランドセル<br /><span class="ec">EC取り扱い</span><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sports-p1.png" class="sports-p1" />
    <p>現在スポーツブランドランドセルページは準備中です。<br />
    ホームページへの商品情報掲載は〇月上旬、販売開始は〇月頃を予定しております。</p>
    <a href="<?php echo home_url('/')?>sports" class="flow-link">スポーツブランドランドセル</a>
  </section>

  <section class="marty-area" id="etc">
    <h2><span>MARTY</span>マーティ<br /><span class="ec">EC取り扱い</span><span class="info">店舗取り扱い</span></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/marty.jpg" class="marty-p1" />
    <p>神戸、芦屋のオリジナルデザインのレザーショップ「Marty」関東での取り扱い店舗はSOLO UNOだけ！</p>
    <p>本革、国内生産にこだわったパーツを組み合わせてオリジナルのランドセルカバーがつくれます。</p>
    <a href="https://marty.solouno-ordermade.com" class="om-link" target="_blank">オーダーを選んでみよう<br />【シミュレーター】</a>
    <a href="<?php echo home_url('/')?>marty" class="flow-link">Marty</a>
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
<?php endwhile; endif; ?>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
