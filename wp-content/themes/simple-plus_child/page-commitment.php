<?php get_header(); ?>

<div id="commitment-area">
  <section class="commitment-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p2.jpg" />
    <div>
      <h2>こだわり</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <section class="text-area">
  <h2><span>PART NAMES</span>SOLO UNOの<br />オーダーメイドランドセル</h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot" />

  <p>SOLO UNOのオーダーメイドランドセルは、 素材・デザイン・お子さまの安全をとことん考えたこだわりの機能が満載です。<br />
    製作は老舗ランドセルメーカー(株)榮伸に依頼し、職人さんの手でひとつひとつ丁寧に縫製されています。<br />
    お子さまの通学が毎日たのしく、ご家族さまが安心してお見送りできるようにという想いを込めてつくっています。</p>
  </section>

  <section class="text-area" id="kodawari">
    <ul>
      <li><a href="#warranty">
        <span>素材</span>
      </a><li>
      <li><a href="#materials">
        <span>背カン</span>
      </a><li>
      <li><a href="#materials">
        <span>背中</span>
      </a><li>
      <li><a href="#materials">
        <span>錠前</span>
      </a><li>
      <li><a href="#weight">
        <span>W補強</span>
      </a><li>
      <li><a href="#weight">
        <span>収納力</span>
      </a><li>
      <li><a href="#weight">
        <span>360°反射板</span>
      </a><li>
      <li><a href="#weight">
        <span>ナスカン</span>
      </a><li>
      <li><a href="#weight">
        <span>底板</span>
      </a><li>
    </ul>
    <div>
      <section id="material">
        <h3 class="subtitle" style="justify-content: flex-start;">
          <span style="display:block; line-height:1.3;">素材</span>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
        </h3>
        <h4>クラリーノ・エフ</h4>
        <h5>優美な外観、 軽くてしなやか<br />
        豊富なカラーからお気に入りを</h5>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kodawari/kodawari01.jpg" />
        <p>ランドセル専用の人工皮革で、軽くて柔らかいのが特徴のクラリーノ・エフを使用。<br />
        表面の撥水加工で雨にも強く、濡れても乾いた布でサッとふくだけとお手入れしやすい点も選ばれるポイントです。</p>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kodawari/kodawari02.jpg" />
        <h4>クラリーノ・タフロックNEO</h4>
        <h5>更に丈夫で傷にも強い</h5>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kodawari/kodawari03.jpg" />
        <p>厚い高密度ウレタン層の最表面に特殊処理を施すことで、クラリーノが持つ丈夫さと防水性を更に高めた材質です。<br />
        また、表面は滑らかで柔らかく、光沢を抑えたマットで落ち着いた印象となります。</p>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kodawari/kodawari04.jpg" />
      </section>
    </div>
</section>
  <span class="pagetop"><a href="#warranty-area"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="21" cy="21" r="20.5" fill="white" stroke="#BAA280"/>
  <path d="M8.49769 19.9832L20.4294 11.1914C20.7776 10.9362 21.2233 10.9362 21.5715 11.1914L33.5032 19.9832C33.8143 20.2151 34 20.6141 34 21.0549V28.7332C34 29.2435 33.7447 29.7028 33.35 29.8977C33.0193 30.0661 32.6496 30.0228 32.3519 29.7956L20.9773 21.1801L9.6398 29.5358C8.8821 30.0989 7.96631 29.3569 8.00095 28.4641C8.00092 28.4641 8.00092 21.0549 8.00092 21.0549C8.00092 20.6141 8.18663 20.2151 8.49769 19.9832Z" fill="#AC7746"/>
  </svg></a>
  </span>
</div>
<script>
  $(document).ready(function() {
    var ul = $('#kodawari > ul'); // 対象のul要素
    var div = $('#kodawari > div'); // 対象のul要素
    var ulOffset = ul.offset().top; // ulの初期位置

    $(window).scroll(function() {
      if ($(window).scrollTop() >= ulOffset) {
        ul.addClass('sticky'); // 画面の上に来たらstickyクラスを追加
        div.addClass('sticky');
      } else {
        ul.removeClass('sticky'); // それ以外の場合はstickyクラスを削除
        div.removeClass('sticky');
      }
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    var observer;
    var ul = document.querySelector('#kodawari > ul'); // 監視対象のul要素
    var target = document.querySelector('#material'); // 監視対象のsection要素

    var callback = function(entries, observer) { 
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // section#materialがビューポートに入った時
          ul.classList.add('active1');
        } else {
          // section#materialがビューポートから出た時
          ul.classList.remove('active1');
        }
      });
    };

    observer = new IntersectionObserver(callback);
    observer.observe(target); // section#materialの監視を開始
  });
</script>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
