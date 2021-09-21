<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       mkbox.org
 * @since      1.0.0
 *
 * @package    Mkmeasapp
 * @subpackage Mkmeasapp/admin/partials
 */
?>

<div class="wrap">
    <h1>Настройки онлайн записи на замер</h1>
    <p>Для отображения формы используйте шорткод [display-mkmeasapp]</p>
<?php
    //$this->send_sms('79059488212', 'Test');
?>
    <form method="post" enctype="multipart/form-data">
    <?php settings_fields( 'mkmeasapp_settings' ); ?>
    <?php do_settings_sections( 'mkmeasapp_settings' ); ?>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
    </p>
    </form>
</div>
