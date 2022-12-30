<?php
/* * ***************************************************************
 * Render the new Stripe Buy Now payment button creation interface
 * ************************************************************** */
add_action('swpm_create_new_button_for_stripe_buy_now', 'swpm_create_new_stripe_buy_now_button');

function swpm_create_new_stripe_buy_now_button() {

    //Test for PHP v5.3.3 or show error and don't show the remaining interface.
    if (version_compare(PHP_VERSION, '5.3.3') >= 0) {
        //The server is using at least PHP version 5.3.3
        //Can use Stripe gateway library
    } else {
        //This server can't handle Stripe library
        echo '<div class="swpm-red-box">';
        echo '<p>The Stripe payment gateway libary requires at least PHP 5.3.3. Your server is using a very old version of PHP that Stripe does not support.</p>';
        echo '<p>Request your hosting provider to upgrade your PHP to a more recent version then you will be able to use the Stripe gateway.<p>';
        echo '</div>';
        return;
    }
    ?>

    <!--
    <div class="swpm-orange-box">
        View the <a target="_blank" href="https://simple-membership-plugin.com/create-stripe-buy-now-button-for-membership-payment/">documentation</a>&nbsp;
        to learn how to create a Stripe Buy Now payment button and use it.
    </div>
    -->

    <div class="postbox">
        <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('Stripe Buy Now Button Configuration'); ?></label></h3>
        <div class="inside">

            <form id="stripe_button_config_form" method="post">
                <input type="hidden" name="button_type" value="<?php echo sanitize_text_field($_REQUEST['button_type']); ?>">
                <input type="hidden" name="swpm_button_type_selected" value="1">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Title'); ?></th>
                        <td>
                            <input type="text" size="50" name="button_name" value="" required />
                            <p class="description">このボタンタイトルは相手への請求名となります。</p>
                        </td>
                    </tr>

					<tr valign="top">
                        <th scope="row"><?php echo "ボタンラベル"; ?></th>
                        <td>
                            <input type="text" size="50" name="button_text" value="" required />
                            <p class="description">ボタンラベル</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Membership Level'); ?></th>
                        <td>
                            <select id="membership_level_id" name="membership_level_id">
                                <?php echo SwpmUtils::membership_level_dropdown(); ?>
                            </select>
                            <p class="description">決済が完了した後の会員ランクを設定してください。<br>決済が完了すると自動でこのランクに変更されます。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Amount'); ?></th>
                        <td>
                            <input type="text" size="6" name="payment_amount" value="" required />
                            <p class="description">請求金額を設定してください。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Currency'); ?></th>
                        <td>
                            <select id="payment_currency" name="payment_currency">
                                <option value="USD">米ドル($)</option>
                                <option value="EUR">ユーロ(€)</option>
                                <option selected="selected" value="JPY">日本円(¥)</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th colspan="2"><div class="swpm-grey-box"><?php echo('StripeのAPIキーを以下で設定してください。'); ?></div></th>
                    </tr>

                   <tr valign="top">
                        <th scope="row"><?php echo('テスト公開キー'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_test_publishable_key" value="" required />
                            <p class="description">テスト公開キーを入力します。</p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <th scope="row"><?php echo('テストシークレットキー'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_test_secret_key" value="" required />
                            <p class="description">テストシークレットキーを入力します。</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Live Publishable Key'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_live_publishable_key" value="" required />
                            <p class="description">live publishableキーを入力します。</p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Live Secret Key'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_live_secret_key" value="" required />
                            <p class="description">live secretキーを入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th colspan="2"><div class="swpm-grey-box"><?php echo SwpmUtils::_('The following details are optional.'); ?></div></th>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Collect Customer Address'); ?></th>
                        <td>
                            <input type="checkbox" name="collect_address" value="1"/>
                            <p class="description">Stripeチェックアウト中に顧客の住所を収集する場合は、このオプションを有効にします。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="" />
                            <p class="description">支払いが成功した後にユーザーがリダイレクトされるURLです。</p>
                        </td>
                    </tr>

                </table>

                <p class="submit">
                    <?php wp_nonce_field('swpm_admin_add_edit_stripe_buy_now_btn','swpm_admin_create_stripe_buy_now_btn') ?>
                    <input type="submit" name="swpm_stripe_buy_now_save_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
                </p>

            </form>

        </div>
    </div>
    <?php
}

/*
 * Process submission and save the new Stripe Buy now payment button data
 */
add_action('swpm_create_new_button_process_submission', 'swpm_save_new_stripe_buy_now_button_data');

function swpm_save_new_stripe_buy_now_button_data() {
    if (isset($_REQUEST['swpm_stripe_buy_now_save_submit'])) {
        //This is a Stripe buy now button save event. Process the submission.
        check_admin_referer( 'swpm_admin_add_edit_stripe_buy_now_btn', 'swpm_admin_create_stripe_buy_now_btn' );

        //Save the button data
        $button_id = wp_insert_post(
                array(
                    'post_title' => sanitize_text_field($_REQUEST['button_name']),
                    'post_type' => 'swpm_payment_button',
                    'post_content' => '',
                    'post_status' => 'publish'
                )
        );

        $button_type = sanitize_text_field($_REQUEST['button_type']);
        add_post_meta($button_id, 'button_type', $button_type);
        add_post_meta($button_id, 'membership_level_id', sanitize_text_field($_REQUEST['membership_level_id']));
        add_post_meta($button_id, 'payment_amount', trim(sanitize_text_field($_REQUEST['payment_amount'])));
        add_post_meta($button_id, 'payment_currency', sanitize_text_field($_REQUEST['payment_currency']));

        add_post_meta($button_id, 'stripe_test_secret_key', trim(sanitize_text_field($_REQUEST['stripe_test_secret_key'])));
        add_post_meta($button_id, 'stripe_test_publishable_key', trim(sanitize_text_field($_REQUEST['stripe_test_publishable_key'])));
        add_post_meta($button_id, 'stripe_live_secret_key', trim(sanitize_text_field($_REQUEST['stripe_live_secret_key'])));
        add_post_meta($button_id, 'stripe_live_publishable_key', trim(sanitize_text_field($_REQUEST['stripe_live_publishable_key'])));

        add_post_meta($button_id, 'stripe_collect_address', isset($_POST['collect_address']) ? '1' : '');

        add_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));

		add_post_meta($button_id, 'button_text', trim(sanitize_text_field($_REQUEST['button_text']))); // kayama add 

        //add_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));
        //Redirect to the edit interface of this button with $button_id        
        //$url = admin_url() . 'admin.php?page=simple_wp_membership_payments&tab=edit_button&button_id=' . $button_id . '&button_type=' . $button_type;
        //Redirect to the manage payment buttons interface
        $url = admin_url() . 'admin.php?page=simple_wp_membership_payments&tab=payment_buttons';
        SwpmMiscUtils::redirect_to_url($url);
    }
}

/* * **********************************************************************
 * End of new Stripe Buy now payment button stuff
 * ********************************************************************** */


/* * ***************************************************************
 * Render edit Stripe Buy now payment button interface
 * ************************************************************** */
add_action('swpm_edit_payment_button_for_stripe_buy_now', 'swpm_edit_stripe_buy_now_button');

function swpm_edit_stripe_buy_now_button() {

    //Retrieve the payment button data and present it for editing.    

    $button_id = sanitize_text_field($_REQUEST['button_id']);
    $button_id = absint($button_id);
    $button_type = sanitize_text_field($_REQUEST['button_type']);

    $button = get_post($button_id); //Retrieve the CPT for this button

    $membership_level_id = get_post_meta($button_id, 'membership_level_id', true);
    $payment_amount = get_post_meta($button_id, 'payment_amount', true);
    $payment_currency = get_post_meta($button_id, 'payment_currency', true);

    $stripe_test_secret_key = get_post_meta($button_id, 'stripe_test_secret_key', true);
    $stripe_test_publishable_key = get_post_meta($button_id, 'stripe_test_publishable_key', true);
    $stripe_live_secret_key = get_post_meta($button_id, 'stripe_live_secret_key', true);
    $stripe_live_publishable_key = get_post_meta($button_id, 'stripe_live_publishable_key', true);

    $collect_address = get_post_meta($button_id, 'stripe_collect_address', true);
    if ($collect_address == '1') {
        $collect_address = ' checked';
    } else {
        $collect_address = '';
    }

    $return_url = get_post_meta($button_id, 'return_url', true);

	$button_text = get_post_meta($button_id, 'button_text', true);

    //$button_image_url = get_post_meta($button_id, 'button_image_url', true);
    ?>
    <div class="postbox">
        <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('Stripe Buy Now Button Configuration'); ?></label></h3>
        <div class="inside">

            <form id="stripe_button_config_form" method="post">
                <input type="hidden" name="button_type" value="<?php echo $button_type; ?>">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button ID'); ?></th>
                        <td>
                            <input type="text" size="10" name="button_id" value="<?php echo $button_id; ?>" readonly required />
                            <p class="description">このIDは変更できません。</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Title'); ?></th>
                        <td>
                            <input type="text" size="50" name="button_name" value="<?php echo $button->post_title; ?>" required />
                            <p class="description">このボタン名は相手への請求名になります。</p>
                        </td>
                    </tr>

					<tr valign="top">
                        <th scope="row"><?php echo "ボタンラベル"; ?></th>
                        <td>
                            <input type="text" size="50" name="button_text" value="<?php echo $button_text; ?>" required />
                            <p class="description">ボタンラベル</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Membership Level'); ?></th>
                        <td>
                            <select id="membership_level_id" name="membership_level_id">
                                <?php echo SwpmUtils::membership_level_dropdown($membership_level_id); ?>
                            </select>
                            <p class="description">決済が完了した後の会員ランクを設定してください。<br>決済が完了すると自動でこのランクに変更されます。</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Amount'); ?></th>
                        <td>
                            <input type="text" size="6" name="payment_amount" value="<?php echo $payment_amount; ?>" required />
                            <p class="description">請求額を入力してください。</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Currency'); ?></th>
                        <td>                            
                            <select id="payment_currency" name="payment_currency">
                                <option value="USD" <?php echo ($payment_currency == 'USD') ? 'selected="selected"' : ''; ?>>米ドル($)</option>
                                <option value="EUR" <?php echo ($payment_currency == 'EUR') ? 'selected="selected"' : ''; ?>>ユーロ(€)</option>
                                <option value="JPY" <?php echo ($payment_currency == 'JPY') ? 'selected="selected"' : ''; ?>>日本円(¥)</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th colspan="2"><div class="swpm-grey-box"><?php echo SwpmUtils::_('StripeのAPIキーを以下で設定します。'); ?></div></th>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo('テスト公開キー'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_test_publishable_key" value="<?php echo $stripe_test_publishable_key; ?>" required />
                            <p class="description">テスト公開キーを入力してください。</p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <th scope="row"><?php echo('テストシークレットキー'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_test_secret_key" value="<?php echo $stripe_test_secret_key; ?>" required />
                            <p class="description">テストシークレットキーを入力します。</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Live Publishable Key'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_live_publishable_key" value="<?php echo $stripe_live_publishable_key; ?>" required />
                            <p class="description">live publishableキーを入力します。</p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Live Secret Key'); ?></th>
                        <td>
                            <input type="text" size="50" name="stripe_live_secret_key" value="<?php echo $stripe_live_secret_key; ?>" required />
                            <p class="description">live secretキーを入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th colspan="2"><div class="swpm-grey-box"><?php echo SwpmUtils::_('The following details are optional.'); ?></div></th>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Collect Customer Address'); ?></th>
                        <td>
                            <input type="checkbox" name="collect_address" value="1"<?php echo $collect_address; ?>/>
                            <p class="description">Stripeチェックアウト中に顧客の住所を収集する場合は、このオプションを有効にします。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="<?php echo $return_url; ?>" />
                            <p class="description">支払いが成功した後にユーザーがリダイレクトされるURLです。</p>
                        </td>
                    </tr>

                </table>

                <p class="submit">
                <?php wp_nonce_field('swpm_admin_add_edit_stripe_buy_now_btn','swpm_admin_edit_stripe_buy_now_btn') ?>
                <input type="submit" name="swpm_stripe_buy_now_edit_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
                </p>

            </form>

        </div>
    </div>
    <?php
}

/*
 * Process submission and save the edited Stripe Buy now payment button data
 */
add_action('swpm_edit_payment_button_process_submission', 'swpm_edit_stripe_buy_now_button_data');

function swpm_edit_stripe_buy_now_button_data() {
    if (isset($_REQUEST['swpm_stripe_buy_now_edit_submit'])) {
        //This is a Stripe buy now button edit event. Process the submission.
        check_admin_referer( 'swpm_admin_add_edit_stripe_buy_now_btn', 'swpm_admin_edit_stripe_buy_now_btn' );
        //Update and Save the edited payment button data
        $button_id = sanitize_text_field($_REQUEST['button_id']);
        $button_id = absint($button_id);
        $button_type = sanitize_text_field($_REQUEST['button_type']);
        $button_name = sanitize_text_field($_REQUEST['button_name']);

        $button_post = array(
            'ID' => $button_id,
            'post_title' => $button_name,
            'post_type' => 'swpm_payment_button',
        );
        wp_update_post($button_post);

        update_post_meta($button_id, 'button_type', $button_type);
        update_post_meta($button_id, 'membership_level_id', sanitize_text_field($_REQUEST['membership_level_id']));
        update_post_meta($button_id, 'payment_amount', trim(sanitize_text_field($_REQUEST['payment_amount'])));
        update_post_meta($button_id, 'payment_currency', sanitize_text_field($_REQUEST['payment_currency']));

        update_post_meta($button_id, 'stripe_test_secret_key', trim(sanitize_text_field($_REQUEST['stripe_test_secret_key'])));
        update_post_meta($button_id, 'stripe_test_publishable_key', trim(sanitize_text_field($_REQUEST['stripe_test_publishable_key'])));
        update_post_meta($button_id, 'stripe_live_secret_key', trim(sanitize_text_field($_REQUEST['stripe_live_secret_key'])));
        update_post_meta($button_id, 'stripe_live_publishable_key', trim(sanitize_text_field($_REQUEST['stripe_live_publishable_key'])));

        update_post_meta($button_id, 'stripe_collect_address', isset($_POST['collect_address']) ? '1' : '');

        update_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));
        //update_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));

		update_post_meta($button_id, 'button_text', trim(sanitize_text_field($_REQUEST['button_text']))); // kayama add

        echo '<div id="message" class="updated fade"><p>Payment button data successfully updated!</p></div>';
    }
}
?>
<style>
    p.description{
        font-style: normal;
    }
</style>
<?PHP
/************************************************************************
 * End of edit Stripe Buy now payment button stuff
 ************************************************************************/