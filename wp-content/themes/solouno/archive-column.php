<?php get_header(); ?>

<div id="column-area">
  <section class="column-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>コラム</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="column-area">
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          <span>2023.01.01</span>
          <p>コラムのタイトルコラムのタイトルコラムのタイトルコラムのタイトルコラ...</p>
        </figcaption>
      </a>
    </figure>
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          <span>2023.01.01</span>
          <p>コラムのタイトルコラムのタイトルコラムのタイトルコラムのタイトルコラ...</p>
        </figcaption>
      </a>
    </figure>
    <figure>
      <a href="#">
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-sample.svg" />
        <figcaption>
          <span>2023.01.01</span>
          <p>コラムのタイトルコラムのタイトルコラムのタイトルコラムのタイトルコラ...</p>
        </figcaption>
      </a>
    </figure>
  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
