    

<div class="swpm-yellow-box">    
    <p>
        <?php echo SwpmUtils::_('「メンバーシップレベル」を選択して、該当する会員レベルに閲覧を許可するカテゴリを選択してください。'); ?>
    </p>
</div>

<form id="category_list_form" method="post">
    <input type="hidden" name="swpm_category_prot_update_nonce" value="<?php echo wp_create_nonce('swpm_category_prot_update_nonce_action'); ?>" />
    
    <p class="swpm-select-box-left">
        <label for="membership_level_id"><?php SwpmUtils::e('Membership Level:'); ?></label>
        <select id="membership_level_id" name="membership_level_id">
            <option <?php echo $category_list->selected_level_id == 1 ? "selected" : "" ?> value="1"><?php echo SwpmUtils::_('General Protection'); ?></option>
            <?php echo SwpmUtils::membership_level_dropdown($category_list->selected_level_id); ?>
        </select>                
    </p>
    <p class="swpm-select-box-left">
        <input type="submit" class="button-primary" name="update_category_list" value="<?php SwpmUtils::e('Update'); ?>">
    </p>
        <?php $category_list->prepare_items(); ?>   
        <?php $category_list->display(); ?>
</form>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#membership_level_id').change(function() {
            $('#category_list_form').submit();
        });
    });
</script>