<?php get_header(); ?>

<div id="showroom-area">
  <section class="showroom-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1small2.jpg" />
    <div>
      <h2>店舗紹介</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <section class="showroom-grandopen">
    <h2>Showroom</h2>
    <p>2023.2.10 GRAND OPEN</p>
    <img src="<?php echo get_template_directory_uri(); ?>/images/showroom-img.jpg" />
    <div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" />
      <span class="open-close">
        <img src="<?php echo get_template_directory_uri(); ?>/images/clock.svg" />10:00〜17:00  [火・水曜定休] 
      </span>
      <address>〒330-0854<br />埼玉県さいたま市大宮区桜木町1-9-1 三谷ビル1階</address>
      <a href="#">Google Mapsを開く</a>
      <span class="tell"><img src="<?php echo get_template_directory_uri(); ?>/images/tell.svg" />048-658-3900</span>
      <span class="moyori">【大宮駅西口徒歩4分】<br />ソニックシティ向かい新生銀行となり</span>
    </div>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>