<?php get_header(); ?>

<div id="aboutus-area">
<script>
  $(window).on('load', function() {
    const fadeInUpAll = document.querySelectorAll('.inview');
    intersectAction(fadeInUpAll, function (element, isIntersecting) {
      if(isIntersecting){
        element.classList.add('isInview');
      }
    })
  });
</script>
  <section id="aboutus-header" class="inview">
    <h2 class="inview">キミだけの、たったひとつの。</h2>
    <img  class="inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-header.jpg" />
  </section>
  <section id="aboutus-enjoy">
    <h2 class="inview">選ぶことの楽しさ</h2>
    <p class="inview">お名前が入ることの特別感を</p>
    <p class="inview">よりスペシャルなものに</p>
    <p class="inview">「キミだけのたったひとつ」の</p>
    <img class="bg1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-midium.svg" />
    <img class="bg2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-large.svg" />
    <p class="inview">ランドセルを手にとってもらいたい</p>
    <p class="inview">お子さまの</p>
    <p class="inview">「可愛い！欲しい！のわくわく感」と</p>
    <p class="inview">大人の求める「丈夫さや機能性」を</p>
    <p class="inview">併せ持つランドセルを</p>
    <p class="inview">ソロウーノは目指しています</p>
    <p class="inview">ぜひ、</p>
    <p class="inview">”選んで楽しい、使いごこちのよいランドセル”</p>
    <p class="inview">を体感してください</p>
    <img class="bg3 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-small.svg" />
  </section>

  <section id="aboutus-solouno">
    <h2 class="inview">シブヤランドセル×オーダーメイド<br />
    ＝SOLO UNO</h2>
    <p class="inview">創業74周年の株式会社シブヤがこの度、新ブランド「SOLO UNO」を立ち上げました。</p>
    <p class="inview">街の文房具屋さんから始まったシブヤは2007年よりランドセルの取り扱い開始し、お客様のお声にお応えするため、自社ブランドの「シブヤランドセル」を開始。</p>
    <p class="inview">現在も数多くのランドセルを取り扱いながら、お客様に愛されるランドセルを毎年作製。楽天市場ではランドセル販売月間ランキングNo.1に度々、選ばれています。</p>
    <img class="bg1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-midium2.svg" />
    <img class="bg2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-large2.svg" />
    <p class="inview">　</p>
    <p class="inview">オーダーメイドランドセル誕生の背景には、ランドセルづくりや販売に長きにわたり携わってきたスタッフのノウハウがあります。</p>
    <p class="inview">ランドセルの形状や人気カラーの移り変わりを見てきた経験豊富なスタッフがランドセル選びのお手伝いをします。</p>
    <img class="bg3 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-small.svg" />

    <img class="img1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-img01.jpg" />
  </section>

  <section id="aboutus-fullorder">
    <h2 class="inview">ランドセルに、<br />
    フルオーダーメイドという選択を</h2>
    <p class="inview">『想像力』 が必要なオーダーメイドには、好みが明確になっている大人向けのアイテムが多く存在します。</p>
    <p class="inview">しかし、私たちは子どもにも“オーダーメイドを選ぶ体験”をしてほしいと思っています。 UNO」を立ち上げました。</p>
    <p class="inview">　</p>
    <p class="inview">イメージする力を伸ばすと想像力や社会性が豊かになります。子どもはリモコンを携帯に見立てたり、テーブルの下を秘密基地にしたりと、遊びの中で社会性やコミュニケーション能力を高めていきます。 『イメージしたものが形になるオーダーメイドに触れることは、子どもの成長を見守るものになる』と私たちは考えます。</p>
    <img class="bg1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-midium2.svg" />
    <img class="bg2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-large2.svg" />
    <p class="inview">ぼくだけ、わたしだけのたった一つの組み合わせを想像してください。</p>
    <p class="inview">そこにたくさんの笑顔が生まれます。</p>
    <img class="bg3 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/maru-small.svg" />

    <figure>
      <img class="img2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-img02.jpg" />
      <figcaption class="inview">こだわって選ぶ<br />“たったひとつの、じぶんだけの。”</figcaption>
    </figure>

    <div>
      <img class="img1 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg01.jpg" />
      <img class="img2 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg02.jpg" />
      <img class="img3 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg03.jpg" />
      <img class="img7 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-img16.jpg" />
      <img class="img8 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-img16-ob.svg" />
      <img class="img4 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg04.jpg" />
      <img class="img5 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg05.jpg" />
      <img class="img6 inview" src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/about-orderimg06.jpg" />
      <div class="text inview">
        <h3>こだわりをカタチに。</h3>
        <p>イタリア語で『たったひとつの』を<br />
          意味するSOLO UNOは<br />
          オーダーメイドのランドセルをはじめ、<br />
          様々なセレクト商品を扱うブランドです。<br />
          お客様にとって長く愛用したくなる、<br />
          特別な『たったひとつ』<br />
          が見つかりますように。</p>
      </div>
    </div>
  </section>
  <section id="aboutus-links">
    <a href="/product">商品一覧を見る</a>
    <a href="/product">オーダーメイドを選んでみよう！<br />
【シミュレーター】</a>
  </section>
</div>
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
