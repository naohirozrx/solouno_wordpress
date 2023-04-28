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
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/mickey-header.jpg" alt="ディズニーオーダーメイドランドセル（ミッキーマウス・ミニーマウス）70,000円" />
  </section>
  <section class="schoolbag-area">
    <nav>
      <ul style="line-height: 1.3;">
        <li style="margin-bottom: 0.5em;">〇<a href="#simlink" style="text-decoration: underline;">シミュレーター</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#flow" style="text-decoration: underline;">選べるポイントStep1〜5</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#design" style="text-decoration: underline;">デザイン紹介</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#howtoorder" style="text-decoration: underline;">HOW TO ORDER</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#function" style="text-decoration: underline;">ディズニーランドセルの便利機能</a></li>
      </ul>
    </nav>
  </section>

  <section class="disney-flow">
    <a href="https://disneysim.solouno-ordermade.com/" id="simlink" class="simlink">オーダーを選んでみよう！<br />【シミューレーター】</a>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/flow-img.jpg" id="flow" />
    <div>
      <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />オーダーの手順<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step1.svg" class="step1" />
      <h3>キャラクターを選ぶ</h3>
      <p class="chara-choise-txt">ミッキーまたはミニー</p>
      <figure class="chara">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step1-1.png" />
        <span>or</span>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step1-2.png" />
      </figure>
    </div>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step2.svg" class="step1" />
      <h3>メインカラーを選ぶ</h3>
      <h4>生地色1 - カブセ/前締めベルト</h4>
      <ul class="colorList">
        <?php foreach ($color as $k => $v): ?>
          <li>
            <figure>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/main<?php echo $v['id'];?>.png" />
              <figcaption><?php echo $v['name'];?></figcaption>
            </figure>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step3.svg" class="step1" />
      <h3>コンビカラーを選ぶ</h3>
      <h4>生地色2 - 大マチ/前ポケット/肩ベルト</h4>
      <ul class="colorList">
        <?php foreach ($color as $k => $v): ?>
          <li>
            <figure>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/combi<?php echo $v['id'];?>.png" />
              <figcaption><?php echo $v['name'];?></figcaption>
            </figure>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step4.svg" class="step1" />
      <h3>カブセ柄を選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step4.jpg" />
    </div>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step5.svg" class="step1" />
      <h3>箔のカラーを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step5.jpg" />
    </div>

    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step6.svg" class="step1" />
      <h3>背カンを選ぶ</h3>
      <h4>ペガサスの翼</h4>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step4-1.png" />
      <span>ペーシックな従来の左右可動式背カン</span>
      <h4>ペガサスの翼α</h4>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step4-2.png" />
      <span>左右可動式の機能に加えて、ロッカーに入れる時などベルトを畳める便利な折りたたみ機能付き！</span>
    </div>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step7.svg" class="step1" />
      <h3>名前を入れる</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/step7.jpg" />
      <span>「Yベロ」裏側部分へお名前入れができます。</span>
      <span><a href="#ybero" style="text-decoration: underline;">※詳しくはこちら</a></span>
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
    }); 
  </script>

  <section class="spec-area">
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

  <section class="howtoorder">
  <h2 id="howtoorder"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />HOW TO ORDER<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
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
      <dl>
        <dt>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-2.jpg" />1. お申し込み
        </dt>
        <dd>
          <h3>組み合わせが決まりましたらお申し込みください。<br />
          ■ <a href="https://sim.solouno-ordermade.com/">WEBサイトのシミュレーションから</a><br />
          ■ <a href="<?php echo home_url('/')?>showroom">店舗で</a></h3>
          <p class="text2">※お申し込み時にお支払いください。</p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/gentei.svg" />
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
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/yotei.svg" />
        </dd>
      </dl>
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
      <a href="https://disneysim.solouno-ordermade.com/" class="">オーダーメイドを選んでみよう！<br />【シミューレーター】</a>
    </div>
  </section>



  <section class="spec-area">
    <h2 id="function"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />機能紹介<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <h3>大容量</h3>
    <div style="margin-bottom: 20px;">大マチ12.5cm・中マチ最大4.5cm「デカポケ」横幅はA4フラットファイルサイズ対応の23.5cm</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function01.png" />
    <h3 style="margin-top:60px;">ワンタッチオートロック</h3>
    <div style="margin-bottom: 20px;">錠前は押すとかんたんに閉まります。</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function1-1.png" />
    <h3 style="margin-top:60px;">反射材</h3>
    <div style="margin-bottom: 20px;">前締めベルト・肩ベルト・かぶせ鋲に反射材を使用しています。<br />車などのライトに反射し、安全に通学。</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function1-2.png" />
    <h3 style="margin-top:60px;">そのほか使いやすい機能</h3>
    <div style="margin-bottom: 20px;">大マチ・右ベルトの「ナスカン」<br />左肩ベルト・前段ポケット内部の「Dカン」<br />「持ち手」</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function02.png" />
    <h3 style="margin-top:60px;">生地</h3>
    <div style="margin-bottom: 20px;">本体生地には軽量で丈夫な人工皮革、コードレ®︎を採用。</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function03.png" />
    <h2 style="margin-top:60px; margin-bottom:20px;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />品質へのこだわり<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <div style="margin-bottom: 20px;">6年間使用するものだからこそ品質にもこだわります。当ランドセルは国内の工場で生産されています。</div>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function04.png" />
    <h2 style="margin-top:60px;margin-bottom:20px;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />保証<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <h4>6年間しっかりサポートいたします。</h4>
    <p style="margin-bottom:40px;">御入学日より有効な修理対応保証で6年間のランドセル生活をしっかりサポート。<br />ランドセルの通常使用状態で保証期間内に不良箇所が生じた場合に修理を行います。<br /><span style="font-size: 12px;">※内容・箇所によっては有償となる場合がございます。</span></p>
    <h3 id="ybero" style="margin-top:80px;">ランドセルに刻印・お名前入れ</h3>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function05.png" />
    <h4>STEP1　文字色を選択</h4>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function06.png" />
    <h4>STEP2　フォントを選択</h4>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function07.png" />
    <h4>STEP2　お名前を入力</h4>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/disney/function08.png" />
    <h3>SPEC</h3>

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
        ・時間割表<br />
        ・ネームカード<br />
        ・連絡袋<br />
        ・雨カバー<br />
        ・取り替え鋲（4個、内2個はランドセルに装着された状態でお送りいたします）
      </dd>
    </dl>


    <div class="present">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/solouno-logo.svg" />
      <p>
        <span>”時間割が書き込める”</span><br />
        <span>オリジナルクリアファイル</span><br />
        をプレゼント！
      </p>
    </div>
  </section>

    <span class="pagetop"><a href="#flow-area"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
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
