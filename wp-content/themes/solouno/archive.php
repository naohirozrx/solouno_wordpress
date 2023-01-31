<?php get_header(); ?>

<div id="archive-area">
  <section class="archive-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>お知らせ</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="news-area">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <figure>
      <a href="<?php the_permalink();?>">
        <?php the_post_thumbnail();?>
        <figcaption>
          <span><?php echo get_the_date(); ?></span>
          <p><?php the_title(); ?></p>
        </figcaption>
      </a>
    </figure>
    <?php endwhile; ?>
    <?php endif; ?>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
