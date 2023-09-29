<?php get_header(); ?>

<div id="column-area">
  <section class="column-top">
    <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>コラム</h2>
      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="column-single-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_post_thumbnail();?>
    <div class="area">
      <h3><span><?php echo get_the_date(); ?></span><?php the_title(); ?></h3>
      <?php echo the_content(); ?>
    </div>
    <?php endwhile; endif; ?>
    <a href="/column/">コラム一覧に戻る</a>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
