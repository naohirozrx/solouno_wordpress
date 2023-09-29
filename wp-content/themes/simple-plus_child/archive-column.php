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
    <?php the_posts_pagination(
      array(
      'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
      'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
      'prev_text'     => __( '前へ'), // 「前へ」リンクのテキスト
      'next_text'     => __( '次へ'), // 「次へ」リンクのテキスト
      'type'          => 'list', // 戻り値の指定 (plain/list)
      )
    ); ?>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
