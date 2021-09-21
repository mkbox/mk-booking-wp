<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://mkbox.org
 * @since      1.0.0
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/admin/partials
 */
?>

<div class="wrap">
    <h1>Настройки онлайн записи на замер</h1>
    <p>Для отображения формы используйте шорткод [display-mkmeasapp]</p>
<?php
    //$this->send_sms('79059488212', 'Test');
?>
    <form method="post" enctype="multipart/form-data">
    <?php settings_fields( 'mk_wpbk_settings' ); ?>
    <?php do_settings_sections( 'mk_wpbk_settings' ); ?>
    <?php submit_button(); ?>
    </form>
</div>
