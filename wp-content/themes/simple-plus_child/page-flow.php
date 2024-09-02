<?php get_header(); ?>
<script>
  $(function() {
    $('#order-side-menu').on('click', function() {
      $(this).toggleClass('open');
    });
  });
</script>
<div id="flow-area">
  <section class="flow-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p6.jpg" />
    <div>
      <h2>オーダーメイドランドセル</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>
  <section class="schoolbag-area">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-end.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-2.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-3.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-2-end.svg" style="margin-bottom: 10px" />
    <ul class="note">
      <li>クラリーノタフロックNEO素材をお選びの場合は5,000円の追加料金がかかります。</li>
      <li>サイドデザインでアラベスク、クローバーをお選びの場合は3,000円、レースをお選びの場合は5,000円の追加料金がかかります。</li>
      <li>価格はすべて税込みです。</li>
    </ul>
    <nav>
      <ul style="line-height: 1.3;">
        <li style="margin-bottom: 0.5em;">〇<a href="#step" style="text-decoration: underline;">オーダーの手順</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#spec" style="text-decoration: underline;">PRICE＆SPEC</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#gallery" style="text-decoration: underline;">GALLERY</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#howtoorder" style="text-decoration: underline;">HOW TO ORDER</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#function" style="text-decoration: underline;">SOLO UNOの便利機能</a></li>
        <li style="margin-bottom: 0.5em;">〇<a href="#change" style="text-decoration: underline;">組み合わせご変更受付方法のご案内</a></li>
      </ul>
    </nav>
  </section>

  <nav id="order-side-menu">
    <h3 class="menuToggle">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right.svg" class="arrow" />
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/sidemenu-icon.svg" />
    </h3>
    <div class="side-menu-inner">
      <ul>
        <li><a href="#step"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />オーダーの手順</a></li>
        <li><a href="#spec"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />PRICE＆SPEC</a></li>
        <li><a href="#gallery"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />GALLERY</a></li>
        <li><a href="#howtoorder"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />HOW TO ORDER</a></li>
        <li><a href="#function"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />SOLO UNOの便利機能</a></li>
        <li><a href="#change"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow/arrow-right-black.svg" class="arrow" />組み合わせご変更受付方法のご案内</a></li>
      </ul>
      <a target="_blank" href="https://sim.solouno-ordermade.com/">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon1.png" />
        <span>
        ランドセルデザインを<br />シミュレーションして<br />早速購入！
        </span>
      </a>
    </div>
  </nav>

  <section class="order-flow">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_p1.jpg" />
    <div>
      <h2 id="step"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />オーダーの手順<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step1.svg" class="step1" />
      <h3>メインカラーを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon1.png" class="icon1" />
      <span class="font18">Deep</span>
      <p>性別の枠にとらわれず、好きな色を選べるように。黒や赤などの定番色を中心に、落ち着いた色味のカラー展開。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <span class="font16">クラリーノ エフ</span>
      <span class="font14">69,800円</span>
      <div class="maincolor">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-1black.png" /></dt>
          <dd>
            <span>ブラック</span>
            <p>重厚感のあるカラーがシックで高級感のある印象。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-2navy.png" /></dt>
          <dd>
            <span>ネイビー</span>
            <p>知的で洗練され、落ち着いたシックなカラー。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-3blue.png" /></dt>
          <dd>
            <span>ブルー</span>
            <p>あざやかなカラーで元気で活発な印象。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-4olive.png" /></dt>
          <dd>
            <span>オリーブ</span>
            <p>安らぎと安心感のある自然に溶け込む優しいカラー。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-5vividpink.png" /></dt>
          <dd>
            <span>ビビッドピンク</span>
            <p>シャープで凛としたカラーが情熱的で華やか。</p>
          </dd>
        </dl>
      </div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <span class="font16">クラリーノ タフロックNEO</span>
      <span class="font14">74,800円</span>
      <div class="maincolor">
      <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-6tnblack.png" /></dt>
          <dd>
            <span>タフネオブラック</span>
            <p>定番とは一味違う黒は上品か洗練された印象。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-7tnnavy.png" /></dt>
          <dd>
            <span>ラフネオネイビー</span>
            <p>青海のあるマットな紺は気品と優しさを兼ね備えたカラー。</p>
          </dd>
        </dl>
      </div>
      <span class="font18">Smoky</span>
      <p>肌なじみが良く、優しく大人らしい印象を醸し出してくれるくすみカラー。優しい色味のカラー展開。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <span class="font16">クラリーノ エフ</span>
      <span class="font14">69,800円</span>
      <div class="maincolor bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-9mistyrose.png" /></dt>
          <dd>
            <span>ミスティローズ</span>
            <p>華やかなのに甘すぎない大人な雰囲気のくすみカラー。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-10marshmallowpink.png" /></dt>
          <dd>
            <span>マシュマロピンク</span>
            <p>心が弾むような明るいカラーは元気でピュアな印象に。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-11iris.png" /></dt>
          <dd>
            <span>アイリス</span>
            <p>気品のあるカラーで高級感のあるおしゃれさ。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-12marshmallowblue.png" /></dt>
          <dd>
            <span>マシュマロブルー</span>
            <p>柔らかで優しいカラーは爽やかで清潔な印象に。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-13mintgreen.png" /></dt>
          <dd>
            <span>ミントグリーン</span>
            <p>シャーベットのようなカラーではじけるような爽やかさ。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-14ivory.png" /></dt>
          <dd>
            <span>アイボリー</span>
            <p>温かみのある柔らかい雰囲気で優しい印象。</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-15cinnamon.png" /></dt>
          <dd>
            <span>シナモン</span>
            <p>温もりのある落ち着いたカラーはナチュラルな印象</p>
          </dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-16greige.png" /></dt>
          <dd>
            <span>グレージュ</span>
            <p>落ち着きのある淡いカラーは上品で誠実な印象。</p>
          </dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_p2.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step2.svg" class="step1" />
      <h3>コンビカラーを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon2.png" class="icon1" />
      <p>メインカラーとの組み合わせでイメージが変化します。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="combicolor bottom">
        <dl>
          <dt class="black"></dt>
          <dd>ブラック</dd>
        </dl>
        <dl>
          <dt class="navy"></dt>
          <dd>ネイビー</dd>
        </dl>
        <dl>
          <dt class="blue"></dt>
          <dd>ブルー</dd>
        </dl>
        <dl>
          <dt class="olive"></dt>
          <dd>オリーブ</dd>
        </dl>
        <dl>
          <dt class="viviedpink"></dt>
          <dd>ビビットピンク</dd>
        </dl>
        <dl>
          <dt class="tnblack"></dt>
          <dd>タフネオブラック</dd>
        </dl>
        <dl>
          <dt class="tnnavy"></dt>
          <dd>タフネオネイビー</dd>
        </dl>
        <dl>
          <dt class="mistyrose"></dt>
          <dd>ミスティローズ</dd>
        </dl>
        <dl>
          <dt class="marshmallowpink"></dt>
          <dd>マシュマロピンク</dd>
        </dl>
        <dl>
          <dt class="iris"></dt>
          <dd>アイリス</dd>
        </dl>
        <dl>
          <dt class="marshmallowblue"></dt>
          <dd>マシュマロブルー</dd>
        </dl>
        <dl>
          <dt class="mintgreen"></dt>
          <dd>ミントグリーン</dd>
        </dl>
        <dl>
          <dt class="ivory"></dt>
          <dd>アイボリー</dd>
        </dl>
        <dl>
          <dt class="cinnamon"></dt>
          <dd>シナモン</dd>
        </dl>
        <dl>
          <dt class="gureige"></dt>
          <dd>グレージュ</dd>
        </dl>
        <dl>
          <dt class="brown"></dt>
          <dd>ブラウン</dd>
        </dl>
        <dl>
          <dt class="red"></dt>
          <dd>レッド</dd>
        </dl>
        <dl>
          <dt class="silver"></dt>
          <dd>シルバー</dd>
        </dl>
      </div>
      <div style="display: flex; justify-content: end; margin-top: -80px;">
      <p style="text-align: left;">※ブラックとネイビーは<br />
      メインカラーと同じ素材となります。</p>
      </div>

    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p3.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step3.svg" class="step1" />
      <h3>バックカラーを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon3.png" class="icon1" />
      <p>ショルダーベルトの裏も同じ色になります。メインカラーの次に大きく目立つ色味です。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="backcolor bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-17black.png" /></dt>
          <dd>ブラック</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-18blue.png" /></dt>
          <dd>ブルー</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-19ivory.png" /></dt>
          <dd>アイボリー</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-20beige.png" /></dt>
          <dd>ベージュ</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-21pink.png" /></dt>
          <dd>ピンク</dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p4.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step4.svg" class="step1" />
      <h3>カブセステッチを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon4.png" class="icon1" />
      <p>カブセのデザインでランドセルの印象が決まります。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="kabusestitch bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-22chain.png" /></dt>
          <dd>チェーン</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-23wing.png" /></dt>
          <dd>ウイング</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-24nostitch.png" /></dt>
          <dd>ノーステッチ</dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p5.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step5.svg" class="step1" />
      <h3>カブセ鋲＆ファスナー引手の<br />デザインを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon5.png" class="icon1" />
      <p>オーダーメイドだからこそ、細部にまでこだわって選べます。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="fastener bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-25standard.png" /></dt>
          <dd>スタンダード</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-26dia.png" /></dt>
          <dd>ダイヤ</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-27ribbon.png" /></dt>
          <dd>リボン</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-28emblem.png" /></dt>
          <dd>エンブレム</dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_p6.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step6.svg" class="step1" />
      <h3>インナーデザインを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon6.png" class="icon1" />
      <p>好きな色で、好きな柄で。<br />開けないと見えない内装は、自分らしさとこだわりをアピール</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="inner bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-29princess.png" /></dt>
          <dd>プリンセス</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-30flower.png" /></dt>
          <dd>フラワーガーデン</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-31majorica.png" /></dt>
          <dd>マジョリカ</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-32keycharm.png" /></dt>
          <dd>キーチャーム</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-33planet.png" /></dt>
          <dd>プラネット</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-34stripe.png" /></dt>
          <dd>ストライプ</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-35sports.png" /></dt>
          <dd>スポーツ</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-36solidblack.png" /></dt>
          <dd>ソリッドブラック</dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_p7.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step7.svg" class="step1" />
      <h3>サイドのデザインを選ぶ</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon7.png" class="icon1" />
      <p>シンプルにも、かわいらしくも。好みのイメージに仕上がります。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <div class="side bottom">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-37square.png" /></dt>
          <dd>スクエア</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-38wing.png" /></dt>
          <dd>ウイング</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-39flower.png" /></dt>
          <dd>フラワー</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-40emblem.png" /></dt>
          <dd>エンブレム</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-41arabesque.png" /></dt>
          <dd>アラベスク</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-42clover.png" /></dt>
          <dd>クローバー</dd>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-43lace.png" /></dt>
          <dd>レース</dd>
        </dl>
      </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_p8.jpg" />
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_step8.svg" class="step1" />
      <h3>名前を入れる</h3>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon8.png" class="icon1" />
      <p>ヌメ革にレザー彫刻で名前を刻印します。</p>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-line.svg" class="dot-line" />
      <h3 class="sample">刻印可能な文字のサンプル</h3>
      <div class="name">
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-44.png" /></dt>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-45.png" /></dt>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-46.png" /></dt>
        </dl>
        <dl>
          <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-47.png" /></dt>
        </dl>
      </div>
      <p>推奨は13文字程度です。<br />文字数が多い場合、文字が小さくなります。</p>
    </div>
  </section>

  <section class="spec-area">
    <h2 id="spec"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />ORDER PRICE & SPEC<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-end.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-2.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-1-3.svg" style="margin-bottom:27px;" />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/price2024-2-end.svg" style="margin-bottom: 10px" />

    <ul class="note">
      <li>クラリーノタフロックNEO素材をお選びの場合は5,000円の追加料金がかかります。</li>
      <li>サイドデザインでアラベスク、クローバーをお選びの場合は3,000円、レースをお選びの場合は5,000円の追加料金がかかります。</li>
      <li>価格はすべて税込みです。</li>
    </ul>
    <h3>クラリーノ エフ 69,800円</h3>
    <ul class="price-list">
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-1black.png" />
          <figcaption>ブラック</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-2navy.png" />
          <figcaption>ネイビー</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-3blue.png" />
          <figcaption>ブルー</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-4olive.png" />
          <figcaption>オリーブ</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-5vividpink.png" />
          <figcaption>ビビッド<br />ピンク</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-9mistyrose.png" />
          <figcaption>ミスティ<br />ローズ</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-10marshmallowpink.png" />
          <figcaption>マシュマロ<br />ピンク</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-11iris.png" />
          <figcaption>アイリス</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-12marshmallowblue.png" />
          <figcaption>マシュマロ<br />ブルー</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-13mintgreen.png" />
          <figcaption>ミント<br />グリーン</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-14ivory.png" />
          <figcaption>アイボリー</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-15cinnamon.png" />
          <figcaption>シナモン</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-16greige.png" />
          <figcaption>グレージュ</figcaption>
        </figure>
      </li>
    </ul>

    <h3>クラリーノ タフロックNEO 74,800円</h3>
    <ul class="price-list2">
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-6tnblack.png" />
          <figcaption>タフネオブラック</figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-7tnnavy.png" />
          <figcaption>タフネオネイビー</figcaption>
        </figure>
      </li>
    </ul>

    <h3>サイドのデザイン</h3>

    <ul class="price-list3">
      <li>
        <h4>アラベスク / クローバー</h4>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/priceside-1.jpg" />
        <p>上記の金額に<br />＋3,000円</p>
      </li>
      <li>
        <h4>レース</h4>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/priceside-2.jpg" />
        <p>上記の金額に<br />＋5,000円</p>
      </li>
    </ul>

    <h3>お申し込み特典</h3>
    <div style="padding-bottom: 30px; margin-bottom: 30px; border-bottom: 1px dotted #000000;">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/present.png" style="width:100%; height: auto;"/>
    </div>

    <h3>
      <span style="font-size: 12px; background-color: #AC7746; color: #fff; font-weight:bold; border-radius: 100px; padding:4px 12px;">店舗・展示会申し込み限定！</span><br />
      メンテナンス&クリーニング特典
    </h3>
    <div style="padding-bottom: 30px; margin-bottom: 30px; border-bottom: 1px dotted #000000;">
      <img src="<?php echo get_stylesheet_directory_uri();?>/images/shoponly-present.png" style="width:100%; height: auto;"/>
    </div>


    <h3>SPEC</h3>

    <dl>
      <dt>本体素材</dt>
      <dd>クラリーノ エフまたはクラリーノ タフロック ネオ</dd>
    </dl>

    <dl>
      <dt>かぶせ裏</dt>
      <dd>クラリーノ</dd>
    </dl>

    <dl>
      <dt>背中/ベルト裏</dt>
      <dd>人工皮革</dd>
    </dl>
    <dl>
      <dt>内張り</dt>
      <dd>合成皮革</dd>
    </dl>
    <dl>
      <dt>大マチ内寸</dt>
      <dd>ヨコ23.0×マチ幅12.5× 高さ31cm</dd>
    </dl>
    <dl>
      <dt>重量</dt>
      <dd>約1200g</dd>
    </dl>
  </section>

  <section class="eishin">
    <h2><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
      <span>SOLO UNO<br />
      ✖️<br />
      ランドセルメーカー<br />
      （株）栄伸コラボ<br />
      の安心機能
      </span>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />
    </h2>
    <p>SOLO UNOのオーダーメイドランドセルは、老舗ランドセルメーカー<a href="https://www.kk-eishin.com/" target="_blank">（株）栄伸</a>に製作を依頼してます。</p>
    <p>SOLO UNOオリジナルデザインで、こだわりの便利機能満載のランドセルを職人さんの手で丁寧に縫製されます。もちろん安心の日本製です。</p>
    <figure>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/eishin-factory-img.jpg" alt="（株）栄伸" />
      <figcaption>（株）栄伸の工場</figcaption>
    </figure>

    <h3>ランドセルの機能</h3>
    <h4>フィットちゃん®︎搭載</h4>
    <figure class="fitchan-img">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fitchan.png" alt="フィットちゃん" />
    </figure>
    <p>体感荷重を軽減する背カン、フィットちゃんを搭載。自然に起き上がる肩ベルトの構造により、背中にフィット。肩と背中で重みを分散し、軽く感じます。また、肩ベルトが左右別々に動き着脱をサポートします。</p>

    <h4>ミラくるっロック</h4>
    <figure>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mirakururock.png" alt="ミラくるっロック" />
    </figure>
    <p>錠前を合わせるだけで鍵がかかるワンタッチロックと、お子様の成長に合わせて固定金具が左右に広がるスライドロックを合体した『ミラくるっロック』搭載</p>

    <h4>しっかりくん®︎搭載</h4>
    <figure>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/shikkarikun.png" alt="しっかりくん" />
    </figure>
    <p>ランドセルで最も負担のかかる開口部を補強する「しっかりくん®︎」搭載。<br />
    形状補正樹脂とその中央に鉄芯を内蔵した構造で型崩れや変形を防ぎます。</p>

    <h4>大マチ２重補強</h4>
    <figure>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/oomachi-hokyou.png" alt="大マチ２重補強" />
    </figure>
    <p>ランドセルの左右側面と底面をコの字型の補強材（タフテル芯材）で強化。<br />
    側面にはさらに補強材を重ね貼り合わせ、２重にすることで強度をアップしています。</p>

    <h4>360度の反射機能</h4>
    <figure>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hansha.png" alt="360度の反射機能" />
    </figure>
    <p>車のライトに反射して光る反射素材を４カ所、全方向に搭載。<br />
    持ち手に縫い込まれた反射素材は、ランドセルカバーをつけても隠れないので、黄色いカバーの１年生も安心です。</p>

    <h4>ヘリなしですっきり</h4>
    <figure>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/herinashi.png" alt="ヘリなしですっきり" />
    </figure>
    <p>特殊な縫製技術でヘリ部分のないすっきりとした形状の”E-QBU”<br />
    従来の学習院型ランドセルに比べ、内容量そのままに、外寸がコンパクトな仕様になりました。</p>
  </section>

  <section class="gallery-area">
    <div class="text-area">
      <h2 id="gallery"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />GALLERY<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
      <p>SOLO UNOのオーダーメイドランドセルは<br />
      このためだけに考えられたオリジナルデザインです。</p>

      <p>このギャラリーに並ぶ組み合わせサンプルは、806,400通りの組み合わせのほんの一部です。</p>

      <p>シンプルにもスポーティにもデコラティブにもお選びいただけますので大好きな組み合わせをみつけてください。</p>
    </div>
    <div class="photo-area">
      <?php
        $args = array (
          'post_type'      => 'gallery', // 投稿タイプ
          'posts_per_page' => -100, // 取得する投稿数
        );
        $myposts = get_posts( $args );
        foreach( $myposts as $post ):
          setup_postdata($post); //　グローバル変数$postを書き換え
      ?>
        <div>
          <?php the_post_thumbnail('full'); ?>
          <div class="gallery-modal">
            <span class="close"></span>
            <div>
              <figure>
                <img src="<?php echo get_field('img1')['url']?>" class="thumbnail" />
                <a target="_blank" href="https://sim.solouno-ordermade.com/?type=gallery&maincolor=<?php echo get_field('maincolorid');?>&combicolor=<?php echo get_field('combicolorid');?>&backcolor=<?php echo get_field('backcolorid');?>&stitch=<?php echo get_field('kabuseid');?>&tack=<?php echo get_field('byouid');?>&inner=<?php echo get_field('innercolorid');?>&side=<?php echo get_field('sidedesignid');?>">このパターンで<br />シミュレーションする</a>
              </figure>
              <div>
                <ul>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon1.png" />
                    <span>メインカラー</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('maincolortxt');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon2.png" />
                    <span>コンビカラー</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('combicolortext');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon3.png" />
                    <span>バックカラー</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('backcolortext');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon4.png" />
                    <span>カブセステッチ</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('kabusetext');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon5.png" />
                    <span>カブセ鋲＆<br />
                    ファスナー引手</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('byoutext');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon6.png" />
                    <span>インナーデザイン</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('innercolortext');?></span>
                  </li>
                  <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/order-flow_icon7.png" />
                    <span>サイドデザイン</span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" />
                    <span><?php echo get_field('sidedesigntest');?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php
        endforeach;
        wp_reset_postdata(); // postをグローバル変数に戻す
      ?>

    </div>
    <span class="pagetop"><a href="#flow-area"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="21" cy="21" r="20.5" fill="white" stroke="#BAA280"/>
<path d="M8.49769 19.9832L20.4294 11.1914C20.7776 10.9362 21.2233 10.9362 21.5715 11.1914L33.5032 19.9832C33.8143 20.2151 34 20.6141 34 21.0549V28.7332C34 29.2435 33.7447 29.7028 33.35 29.8977C33.0193 30.0661 32.6496 30.0228 32.3519 29.7956L20.9773 21.1801L9.6398 29.5358C8.8821 30.0989 7.96631 29.3569 8.00095 28.4641C8.00092 28.4641 8.00092 21.0549 8.00092 21.0549C8.00092 20.6141 8.18663 20.2151 8.49769 19.9832Z" fill="#AC7746"/>
</svg></a>
</span>
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
        <dt style="line-height: 1.3;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-2.jpg" />お申し込みと<br />お支払い方法
        </dt>
        <dd>
          <h3>■販売店/展示会でお申し込み</h3>
          <ul class="howtolist">
            <li>・SOLO UNO店舗</li>
            <li>・<span>姉妹店</span>シブヤ大阪ショールーム</li>
            <li>・<span>姉妹店</span>シブヤランドセル名古屋店</li>
            <li>・<a href="/exhibit/">各展示会場</a></li>
          </ul>

          <h3>■WEBサイトのシミュレーションからお申し込み</h3>
          <a href="https://sim.solouno-ordermade.com/" target="_blank" class="simlink">シミュレーターを開く</a>

          <div class="pay">
            <h3>お支払い方法</h3>
            <div>
              <h4>店舗</h4>
              <ul class="list" style="margin-bottom:20px">
                <li>クレジットカード</li>
                <li>現金</li>
                <li>コード決済</li>
              </ul>
              <h4>展示会</h4>
              <ul class="list">
                <li>クレジットカード</li>
                <li>銀行振込み</li>
              </ul>
              <ul class="note">
                <li>一部、お申込みを承れない展示会場がございます。</li>
                <li>展示会会場によっては、お支払い方法が異なる場合もございます。</li>
                <li>お支払いはお申し込み時にお願いします。</li>
              </ul>
            </div>
          </div>
        </dd>
      </dl>
      <dl>
        <dt>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-4.jpg" />製作/お届け
        </dt>
        <dd>
          <h3>■申し込みから2週間<span>※1</span>は<br />組み合わせの変更が可能です。</h3>
          <p class="notice">※1 お申し込みブロックによっては、変更締切日が設定されている場合があり、2週間に満たない場合があります。<br />
          詳しくは<a href="#spec">こちら</a>をご確認ください</p>
          <p class="fixmail">WEBサイトの<a href="">メールフォーム</a>よりお手続きください。</p>
          <h4 class="fixtext">お申し込みから２週間（組み合わせ確定）後、部材準備、製作を開始いたします。<br />
          出来上がり次第発送いたします。</h4>
          <ul class="fixnote">
            <li>製作の都合上、お申し込み順でのお届けではありません。</li>
            <li>出来上がり時期を早めたり、ご指定いただくことは出来かねます。</li>
            <li>お申し込み後のキャンセル、返金は承れません。ご了承の上お申し込みください。</li>
          </ul>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fix-limit.svg" class="limit" />
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
      <a href="https://sim.solouno-ordermade.com" target="_blank" class="">オーダーメイドを選んでみよう！<br />【シミュレーター】</a>
    </div>
  </section>

  <section class="convenience-area">
    <h2 id="function"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />SOLO UNOの便利機能<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-convenience.svg" />
    <dl>
      <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-quality1.svg" /></dt>
      <dd>
        <p>SOLO UNOのオーダーメイドランドセルは<br />
        60年の歴史のある老舗国内工場に製作をお願いしています。<br />
        職人さんの手により一つひとつ丁寧に縫製されます。</p>
        <p>ランドセルの色、デザイン形はもちろん、形状や機能、安全性に至るまで何度も打ち合わせをし、サンプルを製作してもらいつくりあげたランドセルです。</p>
        <p>6年間安心してご使用ください。</p>
      </dd>
    </dl>
    <dl>
      <dt><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-quality2.svg" /></dt>
      <dd>
        <p>SOLO UNOのオーダーメイドランドセルには<br />
        ご入学からご卒業までの6年間の修理保証サービスがございます。</p>
        <p>万が一、不具合が発生した場合はご連絡ください。国内工場の職人の手により迅速にお直しいたします。</p>
        <p>糸ほつれや金具の破損などの通常利用時の不具合は無償にてお直しいたします。<br />
        キズやらくがき、使用による擦れなど故障ではないお直しは、有償にて承らせていただきます。</p>
        <p>お直し中にご使用いただく代替えランドセルのご用意がございます。無料でお貸出しいたしますが、お戻しいただく際の片道送料のみご負担をお願いいたします。</p>
      </dd>
    </dl>
  </section>

  <section class="change-combi">
    <h2 id="change"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" />組み合わせご変更<br />受付方法のご案内<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini2.svg" /></h2>
    <p>お申し込みから2週間<em>※1</em>はオーダーメイドランドセルの組み合わせのご変更が可能です。</p>
    <p class="notice">※1 お申し込みブロックによっては、変更締切日が設定されている場合があり、2週間に満たない場合があります。<br />
詳しくは<a href="#spec">こちら</a>をご確認ください。</p>
    <p>下記手順にてお手続きをお願いいたします</p>
    <dl>
      <dt>●お申し込み時の受付メールをお持ちの方</dt>
      <dd>⇒受付メールに変更内容を返信してください。</dd>
    </dl>
    <dl>
      <dt>●お申し込み時の受付メールから返信できない方</dt>
      <dd>
        ⇒<a href="mailto:change@solouno-ordermade.com">こちら</a>からメールをお送りください。<br />
        その際、下記内容もご記入ください。<br />
        ・ご使用者さまのお名前<br />
        ・お電話番号<br />
        ・お申し込み方法（WEBサイト/店舗/展示会）<br />
      </dd>
    </dl>
    <span>組み合わせのご変更により<br />お支払金額がご変更になる場合</span>
    <dl>
      <dt>・WEBサイトからクレジットカードにてご注文</dt>
      <dd>⇒金額を訂正して決済いたします。</dd>
    </dl>
    <dl>
      <dt>・店舗でお支払い</dt>
      <dd>
      ⇒差額返金：銀行振込にてご返金いたします。<br />
      　ご返金先をご記載ください。<br />
      ⇒差額お支払い：店舗にご来店いただくか、<br />
      　銀行振込にてお支払いをお願いいたします。<br />
      ※振込手数料はご負担くださいますようお願いいたします。
      </dd>
    </dl>
    <div class="bank">
    振込先口座<br />
    三菱東京UFJ銀行　淡路支店（028）<br />
    普通　口座番号0316799<br />
    ソロウーノ<br />
    </div>

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
