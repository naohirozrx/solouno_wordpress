<?php get_header(); ?>

<div id="exhibit-area">
  <section class="exhibit-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/exhibit-top.jpg" />
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="exhibit-area">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
      <dl class="<?php echo get_field('cancel') ? 'cancel' : ''; ?>">
        <dt>
        <?php echo get_field('addition') ? '<span>追加開催</span>' : ''; ?>
          <?php the_title();?>
        </dt>
        <dd>
          <div><img src="<?php echo get_template_directory_uri(); ?>/images/calendar-icon.svg" /><?php echo get_field('date');?></div>
          <?php if(get_field('time') != ''):?>
            <div><img src="<?php echo get_template_directory_uri(); ?>/images/clock-ex.svg" /><?php echo get_field('time');?></div>
          <?php endif; ?>
          <div><img src="<?php echo get_template_directory_uri(); ?>/images/reserve-icon.svg" />予約：<?php echo get_field('reserve') ? '必要' : '不要'; ?></div>
          <div><img src="<?php echo get_template_directory_uri(); ?>/images/spot-icon.svg" />開催エリア：<?php echo get_field('area');?></div>
          <a href="<?php the_permalink();?>">詳細を見る</a>
        </dd>
      </dl>
      <?php endwhile; ?>
    <?php endif; ?>

  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
