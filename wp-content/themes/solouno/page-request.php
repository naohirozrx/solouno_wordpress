<?php get_header(); ?>

<section id="request-page">
  <dl class="required">
    <dt>カタログタイプ</dt>
    <dd><select>
      <option>23年度ランドセルカタログ(男の子向け)</option>
      <option>23年度ランドセルカタログ(女の子向け)</option>
    </select></dd>
  </dl>
  <dl class="optional">
    <dt>お名前</dt>
    <dd><input type="text" /></dd>
  </dl>
  <dl class="required">
    <dt>電話番号</dt>
    <dd><input type="tel" /></dd>
  </dl>
  <dl class="required">
    <dt>メールアドレス</dt>
    <dd><input type="email" /></dd>
  </dl>
  <dl class="optional">
    <dt>備考</dt>
    <dd><textarea></textarea></dd>
  </dl>
  <input type="submit" value="カタログ請求する" />
</section>
<?php get_footer(); ?>