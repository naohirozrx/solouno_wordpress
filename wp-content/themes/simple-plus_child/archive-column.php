<?php get_header(); ?>

<div id="column-area">
  <section class="column-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>コラム</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="column-area">
    <?php
			$args = array(
        'post_type' => 'column',
        'posts_per_page' => -1
      );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) :
					setup_postdata( $post );
		?>
    <figure>
      <a href="<?php the_permalink();?>">
        <?php the_post_thumbnail();?>
        <figcaption>
          <span><?php echo get_the_date(); ?></span>
          <p><?php the_title(); ?></p>
        </figcaption>
      </a>
    </figure>
    <?php
			endforeach; 
			wp_reset_postdata();
    ?>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
