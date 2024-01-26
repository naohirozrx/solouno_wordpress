<?php get_header(); ?>

<div id="exhibit-area">
  <section class="exhibit-top">
    <div>
      <h2>展覧会情報</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" />

      <ul class="exhibit-list">
        <li>
          <h3>ミニランフェス</h3>
          <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sample.jpg" /></figure>
          <p>SOLO UNO のオーダーメイドランドセルとシブヤランドセル・コクヨランドセルの各種ランドセルがまとめて見れる、背負える、写真が撮れる展示会『ミニ・ランフェス』を開催します。</p>
          <p>『ランフェス』こと『ランドセルわくわくフェスティバル』のミニver.となります。</p>
          <p>『ミニ・ランフェス』はご予約不要で、お時間制限なくゆっくりご覧いただけます。</p>
          <p>ご家族皆さまでご来場ください。</p>
        </li>
        <li>
          <h3>ランドセルわくわくフェスティバル</h3>
          <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sample.jpg" /></figure>
          <p>ランドセルメーカー、ブランドが集まる展示会『ランフェス』に参加します。</p>
          <p>オーダーメイドランドセルの組み合わせサンプルや選べるパーツのサンプルを展示します。背負い比べたり、写真を撮ったりと、組み合わせ選びをお楽しみいただけます。</p>
          <p>事前予約制となりますので、ランフェスHPからご予約の上、ご来場ください。</p>
        </li>
      </ul>



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
