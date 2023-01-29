<?php get_header(); ?>

<div id="exhibit-area">
  <section class="exhibit-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/showroom_p1.jpg" />
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo get_template_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>
  <section class="exhibit-area">
    <dl>
      <dt>
      <img src="<?php echo get_template_directory_uri(); ?>/images/showroom_p1.jpg" />
      </dt>
      <dd>
      <img src="<?php echo get_template_directory_uri(); ?>/images/clock.svg" />2023.10.10　10:00-17:00
      </dd>
    </dl>

  </section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
