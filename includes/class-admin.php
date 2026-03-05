<?php

if (!defined('ABSPATH')) {
    exit;
}

class DeskLeap_Admin {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function add_menu() {
        add_options_page(
            'DeskLeap Settings',
            'DeskLeap',
            'manage_options',
            'deskleap',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {
        register_setting('deskleap_settings', 'deskleap_organization_id', [
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        register_setting('deskleap_settings', 'deskleap_widget_color', [
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        register_setting('deskleap_settings', 'deskleap_widget_position', [
            'sanitize_callback' => function ($value) {
                return in_array($value, ['bottom-right', 'bottom-left']) ? $value : 'bottom-right';
            },
        ]);
        register_setting('deskleap_settings', 'deskleap_widget_enabled', [
            'sanitize_callback' => function ($value) {
                return $value ? '1' : '0';
            },
        ]);
        register_setting('deskleap_settings', 'deskleap_widget_greeting', [
            'sanitize_callback' => 'sanitize_text_field',
        ]);
    }

    public function enqueue_styles($hook) {
        if ($hook !== 'settings_page_deskleap') {
            return;
        }
        wp_enqueue_style(
            'deskleap-admin',
            DESKLEAP_PLUGIN_URL . 'admin/css/admin.css',
            [],
            DESKLEAP_VERSION
        );
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        include DESKLEAP_PLUGIN_DIR . 'admin/settings-page.php';
    }
}
