<?php if(!is_page('simulator')):?>
<section class="request-link">
  <h2><span>REQUEST</span>カタログ請求</h2>
  <p>【SOLOUNOオーダーメイドランドセルのカタログ2025】を無料でお送りいたします。<br />2025年4月御入学のお子さまに向けたカタログです。10日ほどでお届けします。</p>
  <a href="/request">カタログ請求はこちら</a>
</section>

<footer>
  <h1><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/solouno-logo.svg" alt="SOLO UNO"><span>ソロウーノ</span></h1>
  <address>〒330-8564 埼玉県さいたま市大宮区桜木町 1-9-1 三谷ビル1階</address>
  <span class="time"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/clock.svg"> 10:00~17:00 [火・水定休]</span>
  <div>
    <span>【電話でのお問い合わせ】</span>
    <a href="tel:048-658-3900">048-658-3900</a>
  </div>
  <span class="copyrights">©2023 SOLO UNO.</span>
</footer>
<div class="release-msg">
  <div>
    近日公開
    <span class="release-msg-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close.svg" /></span>
  </div>
</div>
<?php endif; ?>
<script>
  $(function() {
    $('.release-open').on('click', function() {
      event.preventDefault();
      $('.release-msg').fadeIn();
      $('.release-msg').css('display', 'flex');
    });
    $('.release-msg-close').on('click', function() {
      $('.release-msg').fadeOut();
    });
  });
</script>
<?php wp_footer();?>
</body>
</html>