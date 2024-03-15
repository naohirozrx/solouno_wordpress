<?php get_header(); ?>
<?php
  $color = array(
    array('id' => '01', 'name' => 'キャメル'),
    array('id' => '02', 'name' => 'ホワイト'),
    array('id' => '03', 'name' => 'ミントグリーン'),
    array('id' => '04', 'name' => 'カーマイン'),
    array('id' => '05', 'name' => 'ビビッドピンク'),
    array('id' => '06', 'name' => 'パールパープル'),
    array('id' => '07', 'name' => 'パープル'),
    array('id' => '08', 'name' => 'パールサックス'),
    array('id' => '09', 'name' => 'ブラウン'),
    array('id' => '10', 'name' => 'パールピンク'),
    array('id' => '11', 'name' => 'ベージュ'),
    array('id' => '12', 'name' => 'ベビーピンク'),
    array('id' => '13', 'name' => 'サーモンピンク'),
    array('id' => '14', 'name' => 'スカイ'),
    array('id' => '15', 'name' => 'ブラック'),
    array('id' => '16', 'name' => 'ネイビー')
  );
?>

<div id="disney-area">
  <section class="flow-top">
  <script>
    $(document).ready(function(){
      $('#slider').bxSlider({
        pagerCustom: '#bx-pager',
        auto: true,

      });
    });
  </script>
  <div id="slider">
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-mickey.jpeg" alt="ミッキー" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-minnie.jpeg" alt="ミニー" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-rapun.jpeg" alt="ラプンツェル" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-mermade.jpg" alt="マーメイド" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-cinderera.jpeg" alt="シンデレラ" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-princess.jpg" alt="プリンセス" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-anayuki.jpeg" alt="アナと雪の女王" /></div>
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-beast.jpg" alt="美女と野獣" /></div>
  </div>
  <div class="disney-price">
    <h3>
      <span>ディズニーオーダーメイドランドセル</span>
      <span>73,000円</span>
    </h3>
    <p>カブセ柄・本体色・箔の色・背カンが選べて、<br />
    お名入れができるランドセルです。</p>
  </div>
  <div id="bx-pager">
    <a data-slide-index="0" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-mickey.jpeg" alt="ミッキー" /></a>
    <a data-slide-index="1" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-minnie.jpeg" alt="ミニー" /></a>
    <a data-slide-index="2" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-rapun.jpeg" alt="ラプンツェル" /></a>
    <a data-slide-index="3" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-mermade.jpg" alt="マーメイド" /></a>
    <a data-slide-index="4" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-cinderera.jpeg" alt="シンデレラ" /></a>
    <a data-slide-index="5" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-princess.jpg" alt="プリンセス" /></a>
    <a data-slide-index="6" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-anayuki.jpeg" alt="アナと雪の女王" /></a>
    <a data-slide-index="7" href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider/slider-beast.jpg" alt="美女と野獣" /></a>
  </div>

  </section>
  <!--<section class="disney-info">
    <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />重要なお知らせ<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <div>
      <h3>■店舗での展示・ご注文受付</h3>
      <p>・7キャラクター　2月1日～<br />
        　（ミッキーマウス、ミニーマウス、アナと雪の女王、リトル・マーメイド、塔の上のラプンツェル、ディズニープリンセス、シンデレラ）<br />
        ・新キャラクター［美女と野獣」3月上旬～
      </p>
      <h3>■webでのご注文受付</h3>
      <p>・7キャラクター　2月中旬から末予定<br />
      ・新キャラクター  3月上旬予定</p>

      <h3>■2025モデルシミュレーター開始</h3>
      <p>・7キャラクター　2月7日～<br />
      ・新キャラクター 　3月上旬～</p>
    </div>
  </section>-->
  
  <script>
    $(document).ready(function() {
      $('ul.tabs li').click(function() {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
      });
    });
  </script>
  <div class="tab-menu">
    <ul class="tabs">
      <li class="tab-link current" data-tab="tab-1">ラインナップ</li>
      <li class="tab-link" data-tab="tab-2">ご注文について</li>
      <li class="tab-link" data-tab="tab-3">共通機能</li>
      <li class="tab-link" data-tab="tab-4">品質・保証</li>
      <li class="tab-link" data-tab="tab-5">スペック</li>
    </ul>
  </div>
  <section style="background: #fff;">

    <div id="tab-1" class="tab-content current">
      <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />ラインナップ[全8種]<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
      <script>
        $(document).ready(function(){
          var slider2 = $('#slider2').bxSlider({
            pagerCustom: '#bx-pager2',
            auto: false,
            controls: false,
            touchEnabled: false,
            onSliderLoad: function(currentIndex) {
              // 初期ロード時に現在のスライドの高さを取得して設定
              var initialHeight = $('#slider2 > div').eq(1).outerHeight();
              $('#slider2').parent().css('height', initialHeight);
            },
            onSlideAfter: function($slideElement, oldIndex, newIndex) {
              // 新しいスライドの高さを取得
              var newHeight = $slideElement.outerHeight();
              // スライダーのコンテナの高さを新しいスライドの高さに設定
              $('#slider2').parent().css('height', newHeight);
              console.log('切り替えた')
            }
          });

        });

        $(document).ready(function() {
    var $slider = $('.disney-design-thum');
    var $slides = $('#bx-pager2 a');
    var slideWidth = 110; // 各スライドの幅
    var slideMargin = 8; // スライド間のマージン

    function centerSlide(index) {
        var slideOffset = (slideWidth + slideMargin * 2) * index; // スライドの左端からのオフセット
        var slideCenter = slideOffset - $slider.width() / 2 + slideWidth / 2; // スライダーの中央にスライドを配置
        $slider.animate({
            scrollLeft: slideCenter
        }, 300);
    }

    $slides.click(function(e) {
        e.preventDefault(); // デフォルトのアンカー動作を防ぐ
        var index = $slides.index(this);
        centerSlide(index);
    });

    $('#slideRight').click(function() {
        var currentIndex = $slides.index($slides.filter('.active'));
        if (currentIndex < $slides.length - 1) {
            currentIndex++;
            $slides.removeClass('active').eq(currentIndex).addClass('active').click();
        }
    });

    $('#slideLeft').click(function() {
        var currentIndex = $slides.index($slides.filter('.active'));
        if (currentIndex > 0) {
            currentIndex--;
            $slides.removeClass('active').eq(currentIndex).addClass('active').click();
        }
    });

    // 初期状態で最初のアイテムをアクティブにする
    $slides.eq(0).addClass('active').click();
        });
      </script>
      <div class="disney-design-thum-wrapper">
        <div class="slideButtons">
          <button id="slideLeft">←</button>
          <button id="slideRight">→</button>
        </div>
      <div class="disney-design-thum">
        <div id="bx-pager2" class="bx-pager2">
          <a data-slide-index="0" href="">
            <span>ミッキー</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-mickey.png" alt="ミッキー" /></figure>
          </a>

          <a data-slide-index="1" href="">
            <span>ミニー</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-minnie.png" alt="ミニー" /></figure>
          </a>

          <a data-slide-index="2" href="">
            <span>塔の上の<br />ラプンツェル</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-rapun.png" alt="ラプンツェル" /></figure>
          </a>

          <a data-slide-index="3" href="">
            <span>リトルマーメイド</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-mermade.png" alt="マーメイド" /></figure>
          </a>
      
          <a data-slide-index="4" href="">
            <span>シンデレラ</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-cinderera.png" alt="シンデレラ" /></figure>
          </a>
        
          <a data-slide-index="5" href="">
            <span>ディズニー<br />プリンセス</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-princess.png" alt="プリンセス" /></figure>
          </a>

          <a data-slide-index="6" href="">
            <span>アナと雪の女王</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-anayuki.png" alt="アナと雪の女王" /></figure>
          </a>

          <a data-slide-index="7" href="">
            <span>美女と野獣</span>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/tab/slider-beast.png" alt="美女と野獣" /></figure>
          </a>

        </div>
      </div>
      </div>
      <div class="chara">
      <div id="slider2">
        <div>
          <h2>ミッキー</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey01.jpg" alt="ミッキー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey02.jpg" alt="ミッキー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey03.jpg" alt="ミッキー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey04.jpg" alt="ミッキー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey05.jpg" alt="ミッキー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey06.jpg" alt="ミッキー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey07.jpg" alt="ミッキー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey08.jpg" alt="ミッキー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey09.jpg" alt="ミッキー">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey10.jpg" alt="ミッキー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            パーツ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>大マチにはミッキーマウス型のナスカン<br />細部までこだわりのデザイン。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mickey/mickey11.jpg" alt="ミッキー">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>ミニー</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie01.jpg" alt="ミニー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie02.jpg" alt="ミニー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie03.jpg" alt="ミニー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie04.jpg" alt="ミニー">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie05.jpg" alt="ミニー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie06.jpg" alt="ミニー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie07.jpg" alt="ミニー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie08.jpg" alt="ミニー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie09.jpg" alt="ミニー">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie10.jpg" alt="ミニー">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            可愛ささっぷりのパーツ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>ハートモチーフのパーツがさりげなくおしゃれ。<br />細部までこだわりのデザイン。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/minnie/minnie11.jpg" alt="ミニー">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>塔の上のラプンツェル</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun01.jpg" alt="塔の上のラプンツェル">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun02.jpg" alt="塔の上のラプンツェル">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun03.jpg" alt="塔の上のラプンツェル">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun04.jpg" alt="塔の上のラプンツェル">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun05.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun06.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun07.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun08.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun09.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            カブセ裏
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun10.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun11.jpg" alt="塔の上のラプンツェル">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            可愛ささっぷりのパーツ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>ハートモチーフのパーツがさりげなくおしゃれ。<br />細部までこだわりのデザイン。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/rapun/rapun12.jpg" alt="塔の上のラプンツェル">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>リトルマーメイド</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid01.jpg" alt="リトルマーメイド">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid02.jpg" alt="リトルマーメイド">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid03.jpg" alt="リトルマーメイド">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid04.jpg" alt="リトルマーメイド">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid05.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid06.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid07.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid08.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid09.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            カブセ裏
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid10.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid11.jpg" alt="リトルマーメイド">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            可愛ささっぷりのパーツ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>ハートモチーフのパーツがさりげなくおしゃれ。<br />細部までこだわりのデザイン。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/mermaid/mermaid12.jpg" alt="リトルマーメイド">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>シンデレラ</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella01.jpg" alt="シンデレラ">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella02.jpg" alt="シンデレラ">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella03.jpg" alt="シンデレラ">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella04.jpg" alt="シンデレラ">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella05.jpg" alt="シンデレラ">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella06.jpg" alt="シンデレラ">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella07.jpg" alt="シンデレラ">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella08.jpg" alt="シンデレラ">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella09.jpg" alt="シンデレラ">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella10.jpg" alt="シンデレラ">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            可愛ささっぷりのパーツ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>ハートモチーフのパーツがさりげなくおしゃれ。<br />細部までこだわりのデザイン。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/cinderella/cinderella11.jpg" alt="シンデレラ">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>ディズニープリンセス</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess01.jpg" alt="ディズニープリンセス">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess02.jpg" alt="ディズニープリンセス">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess03.jpg" alt="ディズニープリンセス">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess04.jpg" alt="ディズニープリンセス">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess05.jpg" alt="ディズニープリンセス">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess06.jpg" alt="ディズニープリンセス">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess07.jpg" alt="ディズニープリンセス">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess08.jpg" alt="ディズニープリンセス">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/princess/princess09.jpg" alt="ディズニープリンセス">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>アナと雪の女王</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki01.jpg" alt="アナと雪の女王">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki02.jpg" alt="アナと雪の女王">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki03.jpg" alt="アナと雪の女王">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki04.jpg" alt="アナと雪の女王">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki05.jpg" alt="アナと雪の女王">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki06.jpg" alt="アナと雪の女王">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki07.jpg" alt="アナと雪の女王">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki08.jpg" alt="アナと雪の女王">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki09.jpg" alt="アナと雪の女王">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            取り替え鋲
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>かぶせの鋲は気分によって気軽にお家で取り替え可能な仕様。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/anayuki/anayuki10.jpg" alt="アナと雪の女王">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
        <div>
          <h2>美女と野獣</h2>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast01.jpg" alt="美女と野獣">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast02.jpg" alt="美女と野獣">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast03.jpg" alt="美女と野獣">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast04.jpg" alt="美女と野獣">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast05.jpg" alt="美女と野獣">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            かぶせ柄
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast06.jpg" alt="美女と野獣">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色１
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜カブセ/前締めベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast07.jpg" alt="美女と野獣">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            生地色２
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>＜大マチ/前ポケット/肩ベルト＞</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast08.jpg" alt="美女と野獣">
          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            箔の色
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/character/beast/beast09.jpg" alt="美女と野獣">

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            背カン
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
          </h3>
          <div style="margin-bottom: 20px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼</h4>
            ベーシックな従来の左右可動式背カン
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
          <div style="margin-bottom: 20px; margin-top: 40px;">
            <h4 style="font-size: .14rem; font-weight: bold; text-align: center; margin: 0 auto 20px;">ペガサスの翼α</h4>
            左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
          </div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />

          <h3>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            名入れ
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
            <span>「Yベロベロ」裏側部分へお名前入れができます。</span>
          </h3>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s0.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s1.jpg" />
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/naire-s2.jpg" />
        </div>
      </div>
      </div>
    </div>
    <div id="tab-2" class="tab-content">
      <section class="howtoorder">
        <h2 id="howtoorder"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />ご注文について<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
        <div>
          <!--<dl>
            <dt>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-1.jpg" />組み合わせを選ぶ
            </dt>
            <dd>
              <h3>店舗、展示会にサンプルを見に行く</h3>
              <p class="text1">クラリーノエフ  64,800円<br />
              クラリーノタフロックNEO  69,800円</p>
              <p class="text2">※サイドのデザインに一部追加料金のかかるものがございます。</p>
              <h3>WEBページからシミュレーションをする</h3>
            </dd>
          </dl>-->
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/disney-order2024.png" style="width:100%; height: auto; margin-bottom: 40px;" />
          <!--<dl>
            <dt>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-2.jpg" />1. お申し込み
            </dt>
            <dd>
              <h3>組み合わせが決まりましたらお申し込みください。<br />
              ■ <a href="https://sim.solouno-ordermade.com/">WEBサイトのシミュレーションから</a><br />
              ■ <a href="<?php echo home_url('/')?>showroom">店舗で</a></h3>
              <p class="text2">※お申し込み時にお支払いください。</p>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/gentei3.svg" />
              <p class="text2" style="margin-top: 20px;">
                ※2024モデル最終受付です。
              </p>
            </dd>
          </dl>
          <dl>
            <dt>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-4.jpg" />2. 製作/お届け
            </dt>
            <dd>
              <h3>お申し込み後、部材準備、製作を開始。出来上がり次第順次お届けいたします。</h3>
              <p class="text2">※製作都合上、お申し込み順でのお届けではありません。<br />
              ※出来上がり時期を早めたり、ご指定いただくことは出来かねます。<br />
              ※お申し込み後のキャンセル、返金は承れません。ご了承の上お申し込みください。</p>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/yotei3.svg" />
            </dd>
          </dl>-->
          <!--<dl>
            <dt>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-4.jpg" />お届け
            </dt>
            <dd>
              <h3>2024年1月中旬〜3月中旬ごろ出来上がり次第お届けいたします。</h3>
              <h3>お申し込み後のキャンセル、返金は承れません。</h3>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gentei.svg" />
            </dd>
          </dl>-->

          <div class="present">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/solouno-logo.svg" />
            <p>
              <span>”時間割が書き込める”</span><br />
              <span>オリジナルクリアファイル</span><br />
              をプレゼント！
            </p>
          </div>
          <a href="https://sim.shibuya-randsel.com/" target="_blank" class="">オーダーメイドを選んでみよう！<br />【シミューレーター】</a>
        </div>
      </section>
    </div>
    <div id="tab-3" class="tab-content">
      <section class="spec-area">
        <h2 id="function"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />共通機能<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
        <h3>背カン</h3>
        <div style="margin-bottom: 20px;">
          <h4>ペガサスの翼</h4>
          ベーシックな従来の左右可動式背カン
        </div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan1.jpg" />
        <div style="margin-bottom: 20px;">
          <h4>ペガサスの翼α</h4>
          左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！
        </div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/sekan2.jpg" />
        <h3>大容量</h3>
        <div style="margin-bottom: 20px;">大マチ12.5cm・中マチ最大4.5cm「デカポケ」横幅はA4フラットファイルサイズ対応の23.5cm</div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function01.png" />
        <h3 style="margin-top:60px;">ワンタッチオートロック</h3>
        <div style="margin-bottom: 20px;">錠前は押すとかんたんに閉まります。</div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function1-1.png" />
        <h3 style="margin-top:60px;">反射材</h3>
        <div style="margin-bottom: 20px;">前締めベルト・肩ベルト・かぶせ鋲に反射材を使用しています。<br />車などのライトに反射し、安全に通学。</div>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function1-2.png" />
          <figcaption>※デザインはキャラクターによって異なります。</figcaption>
        </figure>
        <h3 style="margin-top:60px;">そのほか使いやすい機能</h3>
        <div style="margin-bottom: 20px;">大マチ・右ベルトの「ナスカン」<br />左肩ベルト・前段ポケット内部の「Dカン」<br />「持ち手」</div>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function02.png" />
          <figcaption>※デザインはキャラクターによって異なります。</figcaption>
        </figure>
        <h3 style="margin-top:60px;">生地</h3>
        <div style="margin-bottom: 20px;">本体生地には軽量で丈夫な人工皮革、コードレ®︎を採用。</div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function03.png" />
      </section>
    </div>
    <div id="tab-4" class="tab-content">
      <section class="spec-area">
        <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />品質へのこだわり<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
        <div style="margin-bottom: 20px;">6年間使用するものだからこそ品質にもこだわります。当ランドセルは国内の工場で生産されています。</div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function04.png" />
        <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />保証<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
        <h4>6年間しっかりサポートいたします。</h4>
        <p style="margin-bottom:40px;">御入学日より有効な修理対応保証で6年間のランドセル生活をしっかりサポート。<br />ランドセルの通常使用状態で保証期間内に不良箇所が生じた場合に修理を行います。<br /><span style="font-size: 12px;">※内容・箇所によっては有償となる場合がございます。</span></p>
      </section>
    </div>
    <div id="tab-5" class="tab-content">
      <section class="spec-area">
      <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />スペック<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
        <dl>
          <dt>型</dt>
          <dd>学習院型</dd>
        </dl>
        <dl>
          <dt>本体素材</dt>
          <dd>コードレ</dd>
        </dl>
        <dl>
          <dt>背中/ベルト裏</dt>
          <dd>エアリー</dd>
        </dl>

        <dl>
          <dt>内寸</dt>
          <dd>ヨコ23.5×マチ幅12.5× 高さ32cm</dd>
        </dl>
        <dl>
          <dt>重量</dt>
          <dd>約1240g〜1260g<br />※生地、箔、背カンなど仕様によって異なります。</dd>
        </dl>
        <dl>
          <dt>背カン</dt>
          <dd>
            ペガサスの翼<br />
            又は<br />
            ペガサスの翼α（折りたたみ背カン）<br />
            ※ペガサスの翼の根本の金具は本体色に合わせた色、ペガサスの翼α（折りたたみ背カン）の根元の金具はシルバーになります。
          </dd>
        </dl>
        <dl>
          <dt>錠前</dt>
          <dd>ワンタッチオートロック</dd>
        </dl>
        <dl>
          <dt>持ち手</dt>
          <dd>有り</dd>
        </dl>
        <dl>
          <dt>ナスカン</dt>
          <dd>大マチ左右／肩ベルト（右）</dd>
        </dl>
        <dl>
          <dt>Dカン</dt>
          <dd>肩ベルト（左）／ファスナーポケット内</dd>
        </dl>
        <dl>
          <dt>反射材</dt>
          <dd>前締めベルト、鋲、肩ベルトDカンパーツ</dd>
        </dl>
        <dl>
          <dt>保証</dt>
          <dd>6年修理保証</dd>
        </dl>
        <dl>
          <dt>付属品</dt>
          <dd>
            ・ネームカード<br />
            ・連絡袋<br />
            ・雨カバー<br />
            ・取り替え鋲（4個、内2個はランドセルに装着された状態でお送りいたします）
          </dd>
        </dl>


      </section>
    </div>

  </section>

  <script>
    $(function(){
      $('.tab-list-item').on('click', function(){
        let index = $('.tab-list-item').index(this);

        $('.tab-list-item').removeClass('is-btn-active');
        $(this).addClass('is-btn-active');
        $('.tab-contents').removeClass('is-contents-active');
        $('.tab-contents').eq(index).addClass('is-contents-active');
      });

      $('.nameInsert dt').on('click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('open');
      });
    });
  </script>

  <section class="spec-area" style="display:none;">
    <h2 id="design"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />デザイン紹介<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <div class="tab">
      <!-- タブを構成するブロック -->
      <div class="tab-list">
        <button class="tab-list-item is-btn-active">ミッキー</button>
        <button class="tab-list-item">ミニー</button>
      </div>

      <!-- コンテンツを構成するブロック -->
      <div class="tab-contents-wrap">
        <div class="tab-contents is-contents-active">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/mickey-design.jpg" />
        </div>
        <div class="tab-contents">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/minnie-design.jpg" />
        </div>
      </div>
    </div>
  </section>


  <div class="footerSticky">
    <a href="https://sim.shibuya-randsel.com/" target="_blank" class="ordermade disneybutton">ディズニーオーダーを選んでみよう！<br>【シミュレーター】</a>
    <a href="/category/item/disney/" class="buy">購入はこちら</a>
  </div>


  

    <span class="pagetop"><a href="#top"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="21" cy="21" r="20.5" fill="white" stroke="#BAA280"/>
<path d="M8.49769 19.9832L20.4294 11.1914C20.7776 10.9362 21.2233 10.9362 21.5715 11.1914L33.5032 19.9832C33.8143 20.2151 34 20.6141 34 21.0549V28.7332C34 29.2435 33.7447 29.7028 33.35 29.8977C33.0193 30.0661 32.6496 30.0228 32.3519 29.7956L20.9773 21.1801L9.6398 29.5358C8.8821 30.0989 7.96631 29.3569 8.00095 28.4641C8.00092 28.4641 8.00092 21.0549 8.00092 21.0549C8.00092 20.6141 8.18663 20.2151 8.49769 19.9832Z" fill="#AC7746"/>
</svg></a>
</span>
  </section>

</div>
<script>
  $(function() {
    $('.gallery-modal .close').on('click', function() {
      $('.gallery-modal').fadeOut();
    });

    $('.attachment-full').on('click', function() {
      $(this).next().fadeIn();
      $(this).next().css('display', 'flex')
    })
  });
</script>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
