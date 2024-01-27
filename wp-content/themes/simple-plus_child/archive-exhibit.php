<?php get_header(); ?>

<div id="exhibit-area">
  <section class="exhibit-top">
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" />

      <ul class="exhibit-list">
      <?php
        $slug = '展示会情報';
        $page = get_page_by_path($slug);
        ?>
        <?php if(have_rows('展示会情報', $page->ID)): ?>
          <?php while(have_rows('展示会情報', $page->ID)): the_row(); ?>
            <li>
              <h3><?php the_sub_field('タイトル'); ?></h3>
              <figure><img src="<?php echo get_sub_field('画像')['url']; ?>" ></figure>
              <p><?php the_sub_field('説明文'); ?></p>
          <?php endwhile; ?>
        <?php endif; ?>
    </div>
  </section>
  <section class="exhibit-area">
    <h2>展覧会スケジュール</h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" style="width: 207px;" />
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
      <dl class="<?php echo get_field('cancel') ? 'cancel' : ''; ?> <?php echo get_field('終了') ? 'end' : ''; ?>">
        <dt>
        <?php echo get_field('addition') ? '<span>追加開催</span>' : ''; ?>
          <?php the_title();?>
          <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('full'); ?>
          <?php endif ; ?>
        </dt>
        <dd>
          <div><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon/marker.svg" />開催エリア</span><div><?php echo get_field('area');?></div></div>
          <div><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon/calendar-lines.svg" />日付</span><div><?php echo get_field('date');?></div></div>
          <div><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon/apartment.svg" />会場</span><div><?php echo  nl2br(get_field('venue'));?></div></div>
          <?php if(get_field('time') != ''):?>
            <div><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon/clock.svg" />時間</span><div><?php echo  nl2br(get_field('time'));?></div></div>
          <?php endif; ?>
          <div><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon/calendar-check.svg" />予約有無</span><div><?php echo get_field('reserve') ? '必要' : '不要'; ?></div></div>


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
