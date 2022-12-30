<?php
/* * ***************************************************************
 * Render the new PayPal Subscription payment button creation interface
 * ************************************************************** */
add_action('swpm_create_new_button_for_pp_subscription', 'swpm_create_new_pp_subscription_button');

function swpm_create_new_pp_subscription_button() {
    ?>


    <form id="pp_button_config_form" method="post">

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('PayPal Subscription Button Configuration'); ?></label></h3>
            <div class="inside">

                <input type="hidden" name="button_type" value="<?php echo sanitize_text_field($_REQUEST['button_type']); ?>">
                <input type="hidden" name="swpm_button_type_selected" value="1">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Title'); ?></th>
                        <td>
                            <input type="text" size="50" name="button_name" value="" required />
                            <p>このボタンタイトルは相手への請求名となります。</p>
                        </td>
                    </tr>

					<tr valign="top">
                        <th scope="row"><?php echo "ボタンラベル"; ?></th>
                        <td>
                            <input type="text" size="50" name="button_text" value="" required />
                            <p>ボタンラベル</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Membership Level'); ?></th>
                        <td>
                            <select id="membership_level_id" name="membership_level_id">
                                <?php echo SwpmUtils::membership_level_dropdown(); ?>
                            </select>
                            <p>決済が完了した後の会員ランクを設定してください。<br>決済が完了すると自動でこのランクに変更されます。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Currency'); ?></th>
                        <td>
                            <select id="payment_currency" name="payment_currency">
                                <option  value="USD">米ドル($)</option>
                                <option value="EUR">ユーロ(€)</option>
                                <option selected="selected" value="JPY">日本円(¥)</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('PayPal Email'); ?></th>
                        <td>
                            <input type="text" size="50" name="paypal_email" value="" required />
                            <p>支払いを送るPayPalのメールアドレスを入力して下さい。</p>
                        </td>
                    </tr>                    

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Amount Each Cycle'); ?></th>
                        <td>
                            <input type="text" size="6" name="billing_amount" value="" required />
                            <p>請求サイクルごとに請求される金額。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Cycle'); ?></th>
                        <td>
                            <input type="text" size="4" name="billing_cycle" value="" required />
                            <select id="billing_cycle_term" name="billing_cycle_term">
                                <option value="D">日ごと</option>
                                <option value="M">ヶ月ごと</option>
                                <option value="Y">年ごと</option>
                            </select>
                            <p>定期的な支払いの間隔を設定します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Cycle Count'); ?></th>
                        <td>
                            <input type="text" size="6" name="billing_cycle_count" value="" />
                            <p>何サイクル後に請求を停止するかを入力します。永続的に請求する場合は0を入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Re-attempt on Failure'); ?></th>
                        <td>
                            <input type="checkbox" name="billing_reattempt" value="1" />
                            <p>チェックすると、支払いが失敗した場合、支払いがさらに2回再試行されます。 3回目の失敗後、サブスクリプションはキャンセルされます。</p>
                        </td>
                    </tr>

                </table>

            </div>
        </div><!-- end of main button configuration box -->

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo('トライアル期間の設定'); ?></label></h3>
            <div class="inside">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Trial Billing Amount'); ?></th>
                        <td>
                            <input type="text" size="6" name="trial_billing_amount" value="" />
                            <p>トライアル期間中に請求される金額。 無料トライアル期間を提供する場合は0を入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Trial Billing Period'); ?></th>
                        <td>
                            <input type="text" size="4" name="trial_billing_cycle" value="" />
                            <select id="billing_cycle_term" name="trial_billing_cycle_term">
                                <option value="D">日間</option>
                                <option value="M">ヶ月間</option>
                                <option value="Y">年間</option>
                            </select>
                            <p>トライアル期間の長さを設定します。</p>
                        </td>
                    </tr>

                </table>
            </div>            
        </div><!-- end of trial billing details box -->   

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('Optional Details'); ?></label></h3>
            <div class="inside">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="" />
                            <p>支払いが成功した後にユーザーがリダイレクトされるURLです。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Image URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="button_image_url" value="" />
                            <p>画像を使用してボタンの外観をカスタマイズする場合は、画像のURLを入力します。</p>
                        </td>
                    </tr> 

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Custom Checkout Page Logo Image'); ?></th>
                        <td>
                            <input type="text" size="100" name="checkout_logo_image_url" value="" />
                            <p>PayPal決済画面の左上に表示するロゴ画像URLを設定します。<br>URLはhttps://で始まる必要があります。</p>
                        </td>
                    </tr>

                </table>
            </div>            
        </div><!-- end of optional details box -->        

        <p class="submit">
        <?php wp_nonce_field('swpm_admin_add_edit_pp_subs_btn','swpm_admin_create_pp_subs_btn') ?>
        <input type="submit" name="swpm_pp_subscription_save_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
        </p>

    </form>

    <?php
}

/*
 * Process submission and save the new PayPal Subscription payment button data
 */
add_action('swpm_create_new_button_process_submission', 'swpm_save_new_pp_subscription_button_data');

function swpm_save_new_pp_subscription_button_data() {
    if (isset($_REQUEST['swpm_pp_subscription_save_submit'])) {
        //This is a PayPal subscription button save event. Process the submission.

        check_admin_referer( 'swpm_admin_add_edit_pp_subs_btn', 'swpm_admin_create_pp_subs_btn' );

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
        add_post_meta($button_id, 'payment_currency', sanitize_text_field($_REQUEST['payment_currency']));
        add_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));
        add_post_meta($button_id, 'paypal_email', trim(sanitize_email($_REQUEST['paypal_email'])));
        add_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));
        add_post_meta($button_id, 'checkout_logo_image_url', trim(sanitize_text_field($_REQUEST['checkout_logo_image_url'])));

        //Subscription billing details
        add_post_meta($button_id, 'billing_amount', sanitize_text_field($_REQUEST['billing_amount']));
        add_post_meta($button_id, 'billing_cycle', sanitize_text_field($_REQUEST['billing_cycle']));
        add_post_meta($button_id, 'billing_cycle_term', sanitize_text_field($_REQUEST['billing_cycle_term']));
        add_post_meta($button_id, 'billing_cycle_count', sanitize_text_field($_REQUEST['billing_cycle_count']));
        add_post_meta($button_id, 'billing_reattempt', isset($_REQUEST['billing_reattempt']) ? '1' : '');

        //Trial billing details
        add_post_meta($button_id, 'trial_billing_amount', sanitize_text_field($_REQUEST['trial_billing_amount']));
        add_post_meta($button_id, 'trial_billing_cycle', sanitize_text_field($_REQUEST['trial_billing_cycle']));
        add_post_meta($button_id, 'trial_billing_cycle_term', sanitize_text_field($_REQUEST['trial_billing_cycle_term']));

		add_post_meta($button_id, 'button_text', sanitize_text_field($_REQUEST['button_text'])); // kayama add 2019/12/25

        //Redirect to the edit interface of this button with $button_id        
        $url = admin_url() . 'admin.php?page=simple_wp_membership_payments&tab=edit_button&button_id=' . $button_id . '&button_type=' . $button_type;
        SwpmMiscUtils::redirect_to_url($url);
    }
}

/* * **********************************************************************
 * End of new PayPal subscription payment button stuff
 * ********************************************************************** */


/* * ***************************************************************
 * Render edit PayPal Subscription payment button interface
 * ************************************************************** */
add_action('swpm_edit_payment_button_for_pp_subscription', 'swpm_edit_pp_subscription_button');

function swpm_edit_pp_subscription_button() {
    //Retrieve the payment button data and present it for editing.    

    $button_id = sanitize_text_field($_REQUEST['button_id']);
    $button_id = absint($button_id);
    $button_type = sanitize_text_field($_REQUEST['button_type']);

    $button = get_post($button_id); //Retrieve the CPT for this button

    $membership_level_id = get_post_meta($button_id, 'membership_level_id', true);
    //$payment_amount = get_post_meta($button_id, 'payment_amount', true);
    $payment_currency = get_post_meta($button_id, 'payment_currency', true);
    $return_url = get_post_meta($button_id, 'return_url', true);
    $paypal_email = get_post_meta($button_id, 'paypal_email', true);
    $button_image_url = get_post_meta($button_id, 'button_image_url', true);
    $checkout_logo_image_url = get_post_meta($button_id, 'checkout_logo_image_url', true);

    //Subscription billing details
    $billing_amount = get_post_meta($button_id, 'billing_amount', true);
    $billing_cycle = get_post_meta($button_id, 'billing_cycle', true);
    $billing_cycle_term = get_post_meta($button_id, 'billing_cycle_term', true);
    $billing_cycle_count = get_post_meta($button_id, 'billing_cycle_count', true);
    $billing_reattempt = get_post_meta($button_id, 'billing_reattempt', true);

    //Trial billing details
    $trial_billing_amount = get_post_meta($button_id, 'trial_billing_amount', true);
    $trial_billing_cycle = get_post_meta($button_id, 'trial_billing_cycle', true);
    $trial_billing_cycle_term = get_post_meta($button_id, 'trial_billing_cycle_term', true);

	$button_text = get_post_meta($button_id, 'button_text', true);
    ?>
    <form id="pp_button_config_form" method="post">

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('PayPal Subscription Button Configuration'); ?></label></h3>
            <div class="inside">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button ID'); ?></th>
                        <td>
                            <input type="text" size="10" name="button_id" value="<?php echo $button_id; ?>" readonly required />
                            <p>この支払いボタンのIDです。 これは自動的に生成され、変更することはできません。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Title'); ?></th>
                        <td>
                            <input type="text" size="50" name="button_name" value="<?php echo $button->post_title; ?>" required />
                        </td>
                    </tr>

					<tr valign="top">
                        <th scope="row"><?php echo "ボタンラベル"; ?></th>
                        <td>
                            <input type="text" size="50" name="button_text" value="<?php echo $button_text; ?>" required />
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Membership Level'); ?></th>
                        <td>
                            <select id="membership_level_id" name="membership_level_id">
                                <?php echo SwpmUtils::membership_level_dropdown($membership_level_id); ?>
                            </select>
                            <p>決済が完了した後の会員ランクを設定してください。<br>決済が完了すると自動でこのランクに変更されます。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Payment Currency'); ?></th>
                        <td>                            
                            <select id="payment_currency" name="payment_currency">
                                <option value="JPY" <?php echo ($payment_currency == 'JPY') ? 'selected="selected"' : ''; ?>>日本円(¥)</option>
                                <option value="USD" <?php echo ($payment_currency == 'USD') ? 'selected="selected"' : ''; ?>>米ドル($)</option>
                                <option value="EUR" <?php echo ($payment_currency == 'EUR') ? 'selected="selected"' : ''; ?>>ユーロ(€)</option>
                                <option value="CNY" <?php echo ($payment_currency == 'CNY') ? 'selected="selected"' : ''; ?>>中国人民元</option>
                                <option value="HKD" <?php echo ($payment_currency == 'HKD') ? 'selected="selected"' : ''; ?>>香港ドル($)</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('PayPal Email'); ?></th>
                        <td>
                            <input type="text" size="50" name="paypal_email" value="<?php echo $paypal_email; ?>" required />
                            <p>支払先のPayPalメールアドレスを入力してください。</p>
                        </td>
                    </tr>                    

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Amount Each Cycle'); ?></th>
                        <td>
                            <input type="text" size="6" name="billing_amount" value="<?php echo $billing_amount; ?>" required />
                            <p>一定期間ごとに請求する金額を入力してください。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Cycle'); ?></th>
                        <td>
                            <input type="text" size="4" name="billing_cycle" value="<?php echo $billing_cycle; ?>" required />
                            <select id="billing_cycle_term" name="billing_cycle_term">
                                <option value="D" <?php echo ($billing_cycle_term == 'D') ? 'selected="selected"' : ''; ?>>日ごとに請求</option>
                                <option value="M" <?php echo ($billing_cycle_term == 'M') ? 'selected="selected"' : ''; ?>>ヶ月ごとに請求</option>
                                <option value="Y" <?php echo ($billing_cycle_term == 'Y') ? 'selected="selected"' : ''; ?>>年ごとに請求</option>
                            </select>
                            <p>定期的な支払いの間隔を設定します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Billing Cycle Count'); ?></th>
                        <td>
                            <input type="text" size="6" name="billing_cycle_count" value="<?php echo $billing_cycle_count; ?>" />
                            <p>何回請求した後に請求を停止するかを設定します。無期限の場合は0を入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Re-attempt on Failure'); ?></th>
                        <td>
                            <input type="checkbox" name="billing_reattempt" value="1" <?php if ($billing_reattempt != '') {
                                    echo ' checked="checked"';
                                } ?> />
                            <p>支払いが失敗した場合、支払いがさらに2回再試行されます。 3回目の失敗後、サブスクリプションはキャンセルされます。</p>
                        </td>
                    </tr>

                </table>

            </div>
        </div><!-- end of main button configuration box -->

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo('トライアル期間の設定'); ?></label></h3>
            <div class="inside">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Trial Billing Amount'); ?></th>
                        <td>
                            <input type="text" size="6" name="trial_billing_amount" value="<?php echo $trial_billing_amount; ?>" />
                            <p>試用期間中に請求される金額。 無料試用期間を提供する場合は0を入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Trial Billing Period'); ?></th>
                        <td>
                            <input type="text" size="4" name="trial_billing_cycle" value="<?php echo $trial_billing_cycle; ?>" />
                            <select id="billing_cycle_term" name="trial_billing_cycle_term">
                                <option value="D" <?php echo ($trial_billing_cycle_term == 'D') ? 'selected="selected"' : ''; ?>>日</option>
                                <option value="M" <?php echo ($trial_billing_cycle_term == 'M') ? 'selected="selected"' : ''; ?>>ヶ月</option>
                                <option value="Y" <?php echo ($trial_billing_cycle_term == 'Y') ? 'selected="selected"' : ''; ?>>年</option>
                            </select>
                            <p>トライアル期間を設定します。</p>
                        </td>
                    </tr>

                </table>
            </div>            
        </div><!-- end of trial billing details box -->   

        <div class="postbox">
            <h3 class="hndle"><label for="title"><?php echo SwpmUtils::_('Optional Details'); ?></label></h3>
            <div class="inside">

                <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Return URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="return_url" value="<?php echo $return_url; ?>" />
                            <p>支払いが成功した後にユーザーがリダイレクトされるURLです。 サンキューページのURLをここに入力します。</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Button Image URL'); ?></th>
                        <td>
                            <input type="text" size="100" name="button_image_url" value="<?php echo $button_image_url; ?>" />
                            <p>画像を使用してボタンの外観をカスタマイズする場合は、画像のURLを入力します。</p>
                        </td>
                    </tr> 

                    <tr valign="top">
                        <th scope="row"><?php echo SwpmUtils::_('Custom Checkout Page Logo Image'); ?></th>
                        <td>
                            <input type="text" size="100" name="checkout_logo_image_url" value="<?php echo $checkout_logo_image_url; ?>" />
                            <p>ペイパルチェックアウトページを画像でカスタマイズする場合は、画像URLを指定します。 画像のURLは「https」URLである必要があります。</p>
                        </td>
                    </tr>

                </table>
            </div>            
        </div><!-- end of optional details box -->        

        <p class="submit">
            <?php wp_nonce_field('swpm_admin_add_edit_pp_subs_btn','swpm_admin_edit_pp_subs_btn') ?>
            <input type="submit" name="swpm_pp_subscription_save_submit" class="button-primary" value="<?php echo SwpmUtils::_('Save Payment Data'); ?>" >
        </p>

    </form>

    <?php
}

/*
 * Process submission and save the edited PayPal Subscription payment button data
 */
add_action('swpm_edit_payment_button_process_submission', 'swpm_edit_pp_subscription_button_data');

function swpm_edit_pp_subscription_button_data() {
    if (isset($_REQUEST['swpm_pp_subscription_save_submit'])) {
        //This is a PayPal subscription button edit event. Process the submission.

        check_admin_referer( 'swpm_admin_add_edit_pp_subs_btn', 'swpm_admin_edit_pp_subs_btn' );

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
        update_post_meta($button_id, 'payment_currency', sanitize_text_field($_REQUEST['payment_currency']));
        update_post_meta($button_id, 'return_url', trim(sanitize_text_field($_REQUEST['return_url'])));
        update_post_meta($button_id, 'paypal_email', trim(sanitize_email($_REQUEST['paypal_email'])));
        update_post_meta($button_id, 'button_image_url', trim(sanitize_text_field($_REQUEST['button_image_url'])));
        update_post_meta($button_id, 'checkout_logo_image_url', trim(sanitize_text_field($_REQUEST['checkout_logo_image_url'])));

        //Subscription billing details
        update_post_meta($button_id, 'billing_amount', sanitize_text_field($_REQUEST['billing_amount']));
        update_post_meta($button_id, 'billing_cycle', sanitize_text_field($_REQUEST['billing_cycle']));
        update_post_meta($button_id, 'billing_cycle_term', sanitize_text_field($_REQUEST['billing_cycle_term']));
        update_post_meta($button_id, 'billing_cycle_count', sanitize_text_field($_REQUEST['billing_cycle_count']));
        update_post_meta($button_id, 'billing_reattempt', isset($_REQUEST['billing_reattempt']) ? '1' : '');

        //Trial billing details
        update_post_meta($button_id, 'trial_billing_amount', sanitize_text_field($_REQUEST['trial_billing_amount']));
        update_post_meta($button_id, 'trial_billing_cycle', sanitize_text_field($_REQUEST['trial_billing_cycle']));
        update_post_meta($button_id, 'trial_billing_cycle_term', sanitize_text_field($_REQUEST['trial_billing_cycle_term']));

		update_post_meta($button_id, 'button_text', sanitize_text_field($_REQUEST['button_text']));

        echo '<div id="message" class="updated fade"><p>Payment button data successfully updated!</p></div>';
    }
}

/************************************************************************
 * End of edit PayPal Subscription payment button stuff
 ************************************************************************/
