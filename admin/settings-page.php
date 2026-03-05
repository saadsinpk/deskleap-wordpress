<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap deskleap-settings">
    <h1>
        <span class="deskleap-logo">
            <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="32" height="32" rx="8" fill="#0ea5e9"/>
                <path d="M8 12a4 4 0 014-4h8a4 4 0 014 4v4a4 4 0 01-4 4h-2l-4 4v-4h-2a4 4 0 01-4-4v-4z" fill="white"/>
            </svg>
        </span>
        DeskLeap Settings
    </h1>

    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields('deskleap_settings'); ?>

        <div class="deskleap-card">
            <h2>Connection</h2>
            <p class="description">Connect your DeskLeap account to enable the chat widget.</p>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="deskleap_organization_id">Organization ID</label>
                    </th>
                    <td>
                        <input type="text"
                               id="deskleap_organization_id"
                               name="deskleap_organization_id"
                               value="<?php echo esc_attr(get_option('deskleap_organization_id')); ?>"
                               class="regular-text"
                               placeholder="Your DeskLeap Organization ID" />
                        <p class="description">
                            Find your Organization ID in <a href="https://deskleap.io/settings/widget" target="_blank">DeskLeap Settings &rarr; Widget</a>.
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="deskleap-card">
            <h2>Widget Settings</h2>
            <p class="description">Customize the appearance of your chat widget.</p>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="deskleap_widget_enabled">Enable Widget</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox"
                                   id="deskleap_widget_enabled"
                                   name="deskleap_widget_enabled"
                                   value="1"
                                   <?php checked(get_option('deskleap_widget_enabled', '1'), '1'); ?> />
                            Show the chat widget on your site
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="deskleap_widget_color">Widget Color</label>
                    </th>
                    <td>
                        <input type="color"
                               id="deskleap_widget_color"
                               name="deskleap_widget_color"
                               value="<?php echo esc_attr(get_option('deskleap_widget_color', '#0ea5e9')); ?>" />
                        <input type="text"
                               value="<?php echo esc_attr(get_option('deskleap_widget_color', '#0ea5e9')); ?>"
                               class="small-text"
                               readonly />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="deskleap_widget_position">Position</label>
                    </th>
                    <td>
                        <select id="deskleap_widget_position" name="deskleap_widget_position">
                            <option value="bottom-right" <?php selected(get_option('deskleap_widget_position'), 'bottom-right'); ?>>Bottom Right</option>
                            <option value="bottom-left" <?php selected(get_option('deskleap_widget_position'), 'bottom-left'); ?>>Bottom Left</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="deskleap_widget_greeting">Greeting Message</label>
                    </th>
                    <td>
                        <input type="text"
                               id="deskleap_widget_greeting"
                               name="deskleap_widget_greeting"
                               value="<?php echo esc_attr(get_option('deskleap_widget_greeting')); ?>"
                               class="regular-text"
                               placeholder="Hi! How can we help you today?" />
                        <p class="description">Optional message shown when the widget opens.</p>
                    </td>
                </tr>
            </table>
        </div>

        <?php submit_button('Save Settings'); ?>
    </form>
</div>
