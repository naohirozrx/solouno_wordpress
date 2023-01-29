<?php get_header(); ?>

<div id="exhibit-area">
  <section class="exhibit-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="exhibit-single-area">
    <dl>
      <dt>
      <img src="<?php echo get_template_directory_uri(); ?>/images/showroom_p1.jpg" />
      </dt>
      <dd>
        <div class="info-area"><img src="<?php echo get_template_directory_uri(); ?>/images/calendar-icon.svg" />2023.10.10　10:00-17:00</div>
        <h3>展示会タイトルがこちらに入ります。展示会タイトルがこちらに入...</h3>
        <div><img src="<?php echo get_template_directory_uri(); ?>/images/spot-icon.svg" />東京都立産業貿易センター 台東館 展示室７階</div>
        <hr />
        <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        <div class="venue-info"><img src="<?php echo get_template_directory_uri(); ?>/images/dot-mini.svg" />会場情報<img src="<?php echo get_template_directory_uri(); ?>/images/dot-mini.svg" /></div>
        <h3 class="spot">東京都立産業貿易センター 台東館 展示室７階</h3>
        <p>
          東京都台東区花川戸2-6-5<br />
          地下鉄銀座線・浅草線、東部スカイツリーライン［浅草駅］ より徒歩５分<br />
          つくばエクスプレス［浅草駅］ より徒歩９分
        </p>
      </dd>
    </dl>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
