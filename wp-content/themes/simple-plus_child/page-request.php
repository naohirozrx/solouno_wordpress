<?php get_header(); ?>

<div id="request-area">
  <section class="request-top">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-top_p1small.jpg" />
    <div>
      <h2>カタログ請求</h2>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot-white.svg" />
    </div>
  </section>

  <section id="home-d-r">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <section id="request-page">
      <h2 id="request" class="textAnimation">カタログ請求フォーム</h2>
      <p>2024カタログのご請求は終了いたしました。<p>
      
      <p>2025年4月ご入学のお子さまに向けた2025カタログのご請求を承ります。</br >
      2024年2月ごろの発送開始予定です。</p>
    <?php the_content();?>
  <section>
</div>

<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<script>
  $(function() {
    $('input[name="zip"]').on('keyup', function() {
      AjaxZip3.zip2addr(this, '', 'pref', 'address1');
      //AjaxZip3.zip2addr( '〒上3桁', '〒下4桁', '都道府県', '市区町村', '町域大字', '丁目番地' );
      var input = $(this).val();

      //削除キーではハイフン追加処理が働かないように制御（8がBackspace、46がDelete)
      var key = event.keyCode || event.charCode;
      if( key == 8 || key == 46 ){
        return false;
      }

      //３桁目に値が入ったら発動
      if(input.length === 3){
        $(this).val(insertStr(input));
      }
    });

    function insertStr(input){
      return input.slice(0, 3) + '-' + input.slice(3,input.length);
    }

    function is_postcode( postcode ) {
      if ( postcode.match(/^\d{3}-?\d{4}$/) ) {
          return true;
      } else {
          return false;
      }
    }

    $('input[name="zip"]').on('blur',function(e){
      var input = $(this).val();

      //４桁目が'-(ハイフン)’かどうかをチェックし、違ったら挿入
      if(input.length >= 3 && input.substr(3,1) !== '-'){
        $(this).val(insertStr(input));
      }

      if ( is_postcode( $(this).val() ) ) {
        return true;
      } else {
        return false;
      }
    });

    $('input[type="submit"]').on('click', function () {
      if ( is_postcode( $('input[name="zip"]').val() ) ) {
        return true;
      } else {
        alert('郵便番号が正しくありません。')
        return false;
      }
    });

    $('.mail-notice').on('click', function() {
      $('.notice-wrap').fadeIn();
      $('.notice-wrap').css('display', 'flex')
    });

    $('.notice-close').on('click', function() {
      $('.notice-wrap').fadeOut();
    });
  });

</script>

<?php get_footer(); ?>
