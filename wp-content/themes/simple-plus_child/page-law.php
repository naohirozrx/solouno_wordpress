<?php get_header(); ?>

<div id="law-area">
  <section class="law-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/law-title-bg.jpg" />
    <div>
      <h2>特定商取引法に基づく表記</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-mini.svg" />
    </div>
  </section>

  <section class="law-contents">
    <dl>
      <dt>販売業者</dt>
      <dd>ソロウーノ</dd>
    </dl>
    <dl>
      <dt>代表責任者</dt>
      <dd>相川　亜希乃</dd>
    </dl>
    <dl>
      <dt>所在地</dt>
      <dd>
        〒330-0854<br />
        埼玉県さいたま市大宮区桜木町1-9-1 三谷ビル1階
      </dd>
    </dl>
    <dl>
      <dt>電話番号</dt>
      <dd>048-658-3900</dd>
    </dl>
    <dl>
      <dt>電話受付時間</dt>
      <dd>10:00〜17:00 [火・水曜定休]</dd>
    </dl>
    <dl>
      <dt>サイトURL</dt>
      <dd>https://solouno-ordermade.com/</dd>
    </dl>
    <dl>
      <dt>注文方法</dt>
      <dd>
        <ul>
          <li>ご購入されたい商品の[カゴに入れる]をクリックします。</li>
          <li>ショッピングカート画面で[購入手続きへ]をクリックします。</li>
          <li>お届け先を選択し、[選択したお届け先に送る]を押してください。</li>
          <li>お支払方法を選択し、[次へ]をクリックします。</li>
          <li>ご注文内容を確認して頂き[ご注文完了ページへ]を押してください。</li>
          <li>買い物完了後、 ご注文確認メールが届きますのでご確認ください。</li>
        </ul>
      </dd>
    </dl>
    <dl>
      <dt>商品等の引き渡し時期および発送方法</dt>
      <dd>
        オーダーメイドアイテムについては商品ごとに異なりますので商品ページ記載のお届け目安にて発送いたします。<br />
        <br />
        通常商品についてはご注文代金の入金確認後、7営業日以内に発送いたします。<br />
        <span class="notice">※商品欠品については発送に時間のかかる場合がございますので、あらかじめご了承くださいませ。</span>
      </dd>
    </dl>
    <dl>
      <dt>代金の支払時期および支払方法</dt>
      <dd>
        当店よりご注文確認通知後、７日以内にお支払ください。<br />
        期日内にお支払いの確認が取れない場合はキャンセルとさせていただきます。<br />
        <br />
        <strong>クレジットカード</strong><br />
        VISA、MASTER、DINERS、AMEX、JCBがご利用いただけます。<br />
        お支払い回数は分割払いもご利用頂けます。<br />
        <br />
        <strong>銀行振込（前払い）</strong><br />
        弊社口座にお振込いただきます。通常、入金確認後の商品手配となります。<br />
        <span class="notice">※ご注文確認通知後、７日以内にお支払ください。<br />
        期日内にお支払いの確認が取れない場合はキャンセルとさせていただきます。</span>
        <br />
        <dl>
          <dt>銀行名</dt>
          <dd>三菱UFJ銀行(0005)</dd>
        </dl>
        <dl>
          <dt>支店名</dt>
          <dd>淡路支店(028)</dd>
        </dl>
        <dl>
          <dt>口座番号</dt>
          <dd>普通 0316799</dd>
        </dl>
        <dl>
          <dt>口座名義</dt>
          <dd>ソロウーノ</dd>
        </dl>
      </dd>
    </dl>
    <dl>
      <dt>商品代金以外に必要な費用<br />（送料、手数料、消費税等）</dt>
      <dd>
        お支払い方法によって支払手数料が商品代金とは別途発生します。<br />
        商品代金以外に下記料金が別途かかります。<br />
        <ul>
          <li>消費税</li>
          <li>送料　￥700<br />
          ※1回のご注文で商品代金1万円以上の場合、全国送料無料にて発送いたします。</li>
          <li>振込手数料　　銀行振り込みをお選びで、商品代金合計が1万円未満の場合は振込手数料をご負担くださいますようお願いいたします。</li>
        </ul>
      </dd>
    </dl>
    <dl>
      <dt>返品の取扱条件<br />(返品期限、返品時の送料負担または解約や退会条件)</dt>
      <dd>
        オーダーメイドアイテムは、お申し込み後のキャンセル、返品を承れません。<br />
        <br />
        通常商品につきまして返品・交換をご希望される場合は、商品到着後７日以内にご連絡ください。<br />
        お客様のご都合による返品の場合、送料はお客様でご負担ください。<br />
        なお、一度ご利用された商品、到着後8日以上経過した商品、お客様のお手元で傷や汚れが発生した商品などの返品・交換はご容赦ください。
      </dd>
    </dl>
    <dl>
      <dt>不良品の取扱条件</dt>
      <dd>商品が異なるものや不具合のあるものは、当店の送料負担にて交換または返金いたします。<br />
      オーダーメイドアイテムはお直しにて対応させていただきます。なお、商品製作工程上、不具合ではないと判断させていただくこともございます。</dd>
    </dl>
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
