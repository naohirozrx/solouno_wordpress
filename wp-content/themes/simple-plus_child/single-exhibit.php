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
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('full'); ?>
        <?php endif ; ?>
      </dt>
      <dd>
        <?php the_content(); ?>
        <div class="venue-info"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />開催情報<img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" /></div>
        <div class="info-area"><span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/marker.svg" />開催エリア</span><div><?php echo get_field('area');?></div></div>
        <div class="info-area"><span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/calendar-lines.svg" />開催日</span><div><?php echo get_field('date');?></div></div>
        <div>
          <span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/apartment.svg" />会場</span>
          <div>
            <?php echo  nl2br(get_field('venue'));?>
            <?php echo nl2br(get_field('venue_detail')) ? '<br />' : ''; ?>
            <?php echo nl2br(get_field('venue_detail')) ? nl2br(get_field('venue_detail')) : ''; ?>
          </div>
        </div>
        <?php if(get_field('time') != ''):?>
          <div class="info-area"><span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/clock.svg" />時間</span><div><?php echo  nl2br(get_field('time'));?></div></div>
        <?php endif; ?>
        <div class="info-area"><span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/calendar-check.svg" />予約</span><div><?php echo get_field('reserve') ? '必要' : '不要'; ?></div></div>


        <div class="info-access">
        <span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/icon/access.svg" />アクセス</span>
          <div><?php echo nl2br(get_field('access', $post->ID, false));?></div>
        </div>
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
