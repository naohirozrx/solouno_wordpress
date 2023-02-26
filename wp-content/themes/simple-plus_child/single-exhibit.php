<?php get_header(); ?>

<div id="exhibit-area-single">
  <section class="exhibit-top">
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/exhibit-top.jpg" />
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="exhibit-single-area">
    <dl class="<?php echo get_field('cancel') ? 'cancel' : ''; ?>">
      <dt>
        <?php echo get_field('addition') ? '<span>追加開催</span>' : ''; ?>
        <?php the_title(); ?>
      </dt>
      <dd>
        <?php the_content(); ?>
        <div class="venue-info"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />開催情報<img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" /></div>
        <div class="info-area"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/calendar-icon.svg" />開催日：<span><?php echo get_field('date');?></span></div>
        <?php if(get_field('time') != ''):?>
          <div class="info-area"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/clock-ex.svg" />時　間：<?php echo get_field('time');?></div>
        <?php endif; ?>
        <div class="info-area"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/reserve-icon.svg" />予約：<?php echo get_field('reserve') ? '必要' : '不要'; ?></div>
        <div class="info-area"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/spot-icon.svg" />開催エリア：<?php echo get_field('area');?></div>
        <div style="margin-left: 26px; line-height: 1.4;">会場：<?php echo get_field('venue');?></div>

        <p style="margin-left: 26px;">
          アクセス：<br />
          <?php echo nl2br(get_field('access'));?>
        </p>
        <?php if(get_field('reserve')): ?>
          <a href="<?php echo get_field('reserveurl');?>" target="_blank">ご予約はこちら</a>
        <?php endif; ?>
        <a href="<?php echo get_field('googlemapurl'); ?>" class="googlemaplink" target="_blank">GoogleMapsで見る</a>
      </dd>
    </dl>
    <a href="/exhibit/">展示会情報一覧に戻る</a>
  </section>

</div>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
