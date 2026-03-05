<?php
/**
 * Plugin Name: DeskLeap
 * Plugin URI: https://deskleap.io
 * Description: Add DeskLeap live chat widget and support portal to your WordPress site.
 * Version: 1.0.0
 * Author: DeskLeap
 * Author URI: https://deskleap.io
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: deskleap
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DESKLEAP_VERSION', '1.0.0');
define('DESKLEAP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DESKLEAP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load plugin classes
require_once DESKLEAP_PLUGIN_DIR . 'includes/class-deskleap.php';
require_once DESKLEAP_PLUGIN_DIR . 'includes/class-admin.php';
require_once DESKLEAP_PLUGIN_DIR . 'includes/class-widget.php';

// Initialize
add_action('plugins_loaded', function () {
    DeskLeap::instance();
});

// Activation hook
register_activation_hook(__FILE__, function () {
    add_option('deskleap_organization_id', '');
    add_option('deskleap_widget_color', '#0ea5e9');
    add_option('deskleap_widget_position', 'bottom-right');
    add_option('deskleap_widget_enabled', '1');
    add_option('deskleap_widget_greeting', '');
});

// Deactivation hook
register_deactivation_hook(__FILE__, function () {
    // Keep settings on deactivation
});
