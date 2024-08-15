<section id="side-l">
  <script>
    $(function(){
      $('.toggleLmene').on('click', function(){
        $(this).next().slideToggle();
        $(this).toggleClass('open');
      });
    });
  </script>
  <div class="bg-area">
    <div class="menu-area">
      <ul>
        <li><a href="<?php echo home_url('/')?>">HOME</a></li>
        <li>
          <span class="toggleLmene open">SOLO UNOについて</span>
          <ul class="sub-menu">
            <li><a href="<?php echo home_url('/')?>aboutus">SOLO UNOについて</a></li>
            <li><a href="<?php echo home_url('/')?>guide">ご利用案内</a></li>
            <li><a href="<?php echo home_url('/')?>commitment">こだわり</a></li>
            <li><a href="<?php echo home_url('/')?>parts">素材・パーツの名称について</a></li>
            <li><a href="<?php echo home_url('/')?>warranty">保証について</a></li>
          </ul>
        <li><a href="<?php echo home_url('/')?>showroom">店舗情報</a></li>
        <li><a href="<?php echo home_url('/')?>news">お知らせ</a></li>
        <li><a href="<?php echo home_url('/')?>exhibit">展示会情報</a></li>
        <li><a href="<?php echo home_url('/')?>column">コラム</a></li>
        <li><a href="<?php echo home_url('/')?>request">カタログ請求</a></li>
        <li>
          <span class="toggleLmene open">PRODUCT</span>
            <ul class="sub-menu">
              <li><a href="<?php echo home_url('/')?>product">PRODUCT一覧</a></li>
              <li><a href="<?php echo home_url('/')?>flow/">オーダーメイドランドセル</a></li>
              <li><a href="<?php echo home_url('/')?>disney">ディズニーオーダーランドセル</a></li>
              <li><a href="<?php echo home_url('/')?>sports">スポーツブランドランドセル</a></li>
              <li><a href="<?php echo home_url('/')?>marty">Marty オーダーメイドランドセルカバー</a></li>
              <li><a href="<?php echo home_url('/')?>category/item/">ストア</a></li>
          </ul>
        </li>
        <li><a href="<?php echo home_url('/')?>law">特定商取引法に基づく表記</a></li>
        <li><a href="<?php echo home_url('/')?>privacy">プライバシーポリシー</a></li>
      </ul>
    </div>
  </div>
  <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/sbmto.svg" class="sbmto">
</section>