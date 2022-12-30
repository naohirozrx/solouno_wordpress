<?php
/* * ***************************************************************
 * Render the new PayPal Buy now payment button creation interface
 * ************************************************************** */
add_action('swpm_create_new_button_for_pp_buy_now', 'swpm_create_new_pp_buy_now_button');

function swpm_create_new_pp_buy_now_button() {
    ?>
    
    <!--
    <div class="swpm-orange-box">
        View the <a target="_blank" href="https://simple-membership-plugin.com/create-paypal-buy-now-button-inside-the-simple-membership-plugin/">documentation</a>&nbsp;
        to learn how to create a PayPal Buy Now payment button and use it.
    </div>
    -->

    <div class="postbox">
        <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('PayPal Buy Now Button Configuration'); ?></label></h3>
        <div class="inside">

            <form id="pp_button_config_form" method="post">
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
                            <p class="description">販売金額を入力してください。</p>
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
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="" />
                            <p class="description">支払いが成功した後にユーザーがリダイレクトされるURLです。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('PayPal Email'); ?></th>
                        <td>
                            <input type="text" size="50" name="paypal_email" value="" required />
                            <p class="description">支払先のPayPalメールアドレスを入力してください。</p>
                        </td>
                    </tr>                    

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Image URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="button_image_url" value="" />
                            <p class="description">画像を使用してボタンの外観をカスタマイズする場合は、画像のURLを入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Custom Checkout Page Logo Image'); ?></th>
                        <td>
                            <input type="text" size="100" name="checkout_logo_image_url" value="" />
                            <p class="description">PayPal決済画面の左上に表示する画像URLを設定します。<br>URLはhttps://で始まる必要があります。</p>
                        </td>
                    </tr>
                    
                </table>

                <p class="submit">
                    <?php wp_nonce_field('swpm_admin_add_edit_pp_buy_now_btn','swpm_admin_create_pp_buy_now_btn') ?>
                    <input type="submit" name="swpm_pp_buy_now_save_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
                </p>

            </form>

        </div>
    </div>
    <?php
}

/*
 * Process submission and save the new PayPal Buy now payment button data
 */
add_action('swpm_create_new_button_process_submission', 'swpm_save_new_pp_buy_now_button_data');

function swpm_save_new_pp_buy_now_button_data() {
    if (isset($_REQUEST['swpm_pp_buy_now_save_submit'])) {
        //This is a PayPal buy now button save event. Process the submission.
        //Check nonce first
        check_admin_referer( 'swpm_admin_add_edit_pp_buy_now_btn', 'swpm_admin_create_pp_buy_now_btn' );
        //TODO - Do some extra validation check?
        
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
        add_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));
        add_post_meta($button_id, 'paypal_email', trim(sanitize_email($_REQUEST['paypal_email'])));
        add_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));
        add_post_meta($button_id, 'checkout_logo_image_url', trim(sanitize_text_field($_REQUEST['checkout_logo_image_url'])));

		add_post_meta($button_id, 'button_text', trim(sanitize_text_field($_REQUEST['button_text'])));

        //Redirect to the edit interface of this button with $button_id        
        //$url = admin_url() . 'admin.php?page=simple_wp_membership_payments&tab=edit_button&button_id=' . $button_id . '&button_type=' . $button_type;
        //Redirect to the manage payment buttons interface
        $url = admin_url() . 'admin.php?page=simple_wp_membership_payments&tab=payment_buttons';
        SwpmMiscUtils::redirect_to_url($url);
    }
}

/* * **********************************************************************
 * End of new PayPal Buy now payment button stuff
 * ********************************************************************** */


/* * ***************************************************************
 * Render edit PayPal Buy now payment button interface
 * ************************************************************** */
add_action('swpm_edit_payment_button_for_pp_buy_now', 'swpm_edit_pp_buy_now_button');

function swpm_edit_pp_buy_now_button() {

    //Retrieve the payment button data and present it for editing.    

    $button_id = sanitize_text_field($_REQUEST['button_id']);
    $button_id = absint($button_id);
    $button_type = sanitize_text_field($_REQUEST['button_type']);

    $button = get_post($button_id); //Retrieve the CPT for this button

    $membership_level_id = get_post_meta($button_id, 'membership_level_id', true);
    $payment_amount = get_post_meta($button_id, 'payment_amount', true);
    $payment_currency = get_post_meta($button_id, 'payment_currency', true);
    $return_url = get_post_meta($button_id, 'return_url', true);
    $paypal_email = get_post_meta($button_id, 'paypal_email', true);
    $button_image_url = get_post_meta($button_id, 'button_image_url', true);
    $checkout_logo_image_url = get_post_meta($button_id, 'checkout_logo_image_url', true);
    
	$button_text = get_post_meta($button_id, 'button_text', true); // kayama add 2019/12/25
    ?>
    <div class="postbox">
        <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('PayPal Buy Now Button Configuration'); ?></label></h3>
        <div class="inside">

            <form id="pp_button_config_form" method="post">
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
                            <p class="description">このボタンタイトルは相手への請求名となります。</p>
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
                            <p class="description">請求額を設定してください。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Currency'); ?></th>
                        <td>                            
                            <select id="payment_currency" name="payment_currency">
                                <option value="JPY" <?php echo ($payment_currency == 'JPY') ? 'selected="selected"' : ''; ?>>日本円(¥)</option>
                                <option value="USD" <?php echo ($payment_currency == 'USD') ? 'selected="selected"' : ''; ?>>米ドル($)</option>
                                <option value="EUR" <?php echo ($payment_currency == 'EUR') ? 'selected="selected"' : ''; ?>>ユーロ(€)</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="<?php echo $return_url; ?>" />
                            <p class="description">支払いが成功した後にユーザーがリダイレクトされるURLです。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('PayPal Email'); ?></th>
                        <td>
                            <input type="text" size="50" name="paypal_email" value="<?php echo $paypal_email; ?>" required />
                            <p class="description">支払先のPayPalメールアドレスを入力してください。</p>
                        </td>
                    </tr>                    

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Image URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="button_image_url" value="<?php echo $button_image_url; ?>" />
                            <p class="description">画像を使用してボタンの外観をカスタマイズする場合は、画像のURLを入力します。</p>
                        </td>
                    </tr> 

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Custom Checkout Page Logo Image'); ?></th>
                        <td>
                            <input type="text" size="100" name="checkout_logo_image_url" value="<?php echo $checkout_logo_image_url; ?>" />
                            <p class="description">PayPal決済画面の左上に表示するロゴ画像URLを設定します。<br>URLはhttps://で始まる必要があります。</p>
                        </td>
                    </tr>
                    
                </table>

                <p class="submit">
                <?php wp_nonce_field('swpm_admin_add_edit_pp_buy_now_btn','swpm_admin_edit_pp_buy_now_btn') ?>
                <input type="submit" name="swpm_pp_buy_now_edit_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
                </p>

            </form>

        </div>
    </div>
    <?php
}

/*
 * Process submission and save the edited PayPal Buy now payment button data
 */
add_action('swpm_edit_payment_button_process_submission', 'swpm_edit_pp_buy_now_button_data');

function swpm_edit_pp_buy_now_button_data() {
    if (isset($_REQUEST['swpm_pp_buy_now_edit_submit'])) {
        //This is a PayPal buy now button edit event. Process the submission.
        //Check nonce first
        check_admin_referer( 'swpm_admin_add_edit_pp_buy_now_btn', 'swpm_admin_edit_pp_buy_now_btn' );
        
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
        update_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));
        update_post_meta($button_id, 'paypal_email', trim(sanitize_email($_REQUEST['paypal_email'])));
        update_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));
        update_post_meta($button_id, 'checkout_logo_image_url', trim(sanitize_text_field($_REQUEST['checkout_logo_image_url'])));

		update_post_meta($button_id, 'button_text', sanitize_text_field($_REQUEST['button_text'])); // kayama add 2019/12/25

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
 * End of edit PayPal Buy now payment button stuff
 ************************************************************************/