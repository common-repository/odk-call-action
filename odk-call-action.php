<?php
/**
 * Plugin Name: ODK Call Action
 * Plugin URI: http://themeforseo.com/
 * Description: ODK Call Action
 * Version: 1.0.1
 * Author: Hien Nguyen Duy
 * Author URI: https://www.facebook.com/duyhienplus/
 * License: GPLv2 or later
 */

define( 'ODK_URI', plugins_url( '', __FILE__ ) );

function odk_call_action_styles() {
    wp_enqueue_style( 'odk-call-action-style', plugins_url( 'css/style.css', __FILE__ ), array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'odk_call_action_styles' );

function odk_call_action_scripts() {
    wp_enqueue_script( 'odk-call-action-script', plugins_url( 'js/js.js', __FILE__ ), array(), '1.0', true );
}
add_action('wp_print_scripts', 'odk_call_action_scripts');

function odk_call_action_load() {
    if ( !is_admin() ) {
        if ( wp_is_mobile() ) {
?>
            <!-- Code for Mobile -->
            <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="right: -40px; top: 120px; display: block;">
                <div class="phonering-alo-ph-circle"></div>
                <div class="phonering-alo-ph-circle-fill"></div>

                <div class="phonering-alo-ph-img-circle">
                    <a href="tel:<?php echo str_replace('.', '', get_option('wp_call_action_option_mobile')); ?>" class="odk-call-action" title="">
                        <img src="<?php echo ODK_URI . '/img/anh-nen.png'; ?>" alt="" width="50"
                        onmouseover="this.src='<?php echo ODK_URI . '/img/anh-nen.png'; ?>';"
                        onmouseout="this.src='<?php echo ODK_URI . '/img/anh-nen.png'; ?>';">
                    </a>
                </div>
            </div>
<?php
        } else {
?>
            <!-- Code popup for Desktop -->
            <div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="right: -40px; top: 120px; display: block;">
                <div class="phonering-alo-ph-circle"></div>
                <div class="phonering-alo-ph-circle-fill"></div>
                
                <div class="phonering-alo-ph-img-circle">
                    <img src="<?php echo ODK_URI . '/img/anh-nen.png'; ?>" alt="" width="50"
                    onmouseover="this.src='<?php echo ODK_URI . '/img/anh-nen.png'; ?>';"
                    onmouseout="this.src='<?php echo ODK_URI . '/img/anh-nen.png'; ?>';">
                </div>
            </div>

            <div class="odk-wrap-call-action" style="display: none;">
                <div class="odk-wrap-call-content">
                    <span class="odk-wrap-call-close">X</span>
                    <?php echo get_option('wp_call_action_option_desktop') ?>
                </div>
            </div>
            <div class="odk-wrap-call-action-backgroup" style="display: none;"></div>
<?php
        }
    }
}
add_action( 'wp_footer', 'odk_call_action_load' );

function odk_call_action_settings() {
    register_setting( 'wp-call-action-settings-group', 'wp_call_action_option_desktop' );
    register_setting( 'wp-call-action-settings-group', 'wp_call_action_option_mobile' );
}

function odk_call_action_create_menu() {
    add_menu_page( 'ODK Call Action', 'ODK Call Action', 'administrator', __FILE__, 'odk_call_action_settings_page','dashicons-megaphone', 85 );

    add_action( 'admin_init', 'odk_call_action_settings' );
}
add_action( 'admin_menu', 'odk_call_action_create_menu' );

function odk_call_action_settings_page() {
?>
    <div class="wrap">
        <h2>Settings ODK Call Action</h2>
        <?php if( isset($_GET['settings-updated']) ) { ?>
            <div id="message" class="updated">
                <p><strong><?php _e('Save Changed') ?></strong></p>
            </div>
        <?php } ?>
        <form method="post" action="options.php">
            <?php settings_fields( 'wp-call-action-settings-group' ); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Popup for Desktop</th>
                    <td>
                        <textarea rows="14" cols="40" name="wp_call_action_option_desktop"><?php echo get_option('wp_call_action_option_desktop'); ?></textarea>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Phone number for Mobile</th>
                    <td><input size="60" type="tel" name="wp_call_action_option_mobile" placeholder="" value="<?php echo get_option('wp_call_action_option_mobile'); ?>"/>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>

