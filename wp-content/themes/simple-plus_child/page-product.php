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

  </section>
</div>
<?php endwhile; endif; ?>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
