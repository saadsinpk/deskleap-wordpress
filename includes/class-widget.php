<?php

if (!defined('ABSPATH')) {
    exit;
}

class DeskLeap_Widget {
    public function __construct() {
        add_action('wp_footer', [$this, 'inject_widget']);
    }

    public function inject_widget() {
        // Don't inject in admin or if disabled
        if (is_admin()) {
            return;
        }

        $enabled = get_option('deskleap_widget_enabled', '1');
        if ($enabled !== '1') {
            return;
        }

        $org_id = get_option('deskleap_organization_id', '');
        if (empty($org_id)) {
            return;
        }

        $color = get_option('deskleap_widget_color', '#0ea5e9');
        $position = get_option('deskleap_widget_position', 'bottom-right');
        $greeting = get_option('deskleap_widget_greeting', '');

        $attrs = sprintf(
            'data-organization-id="%s" data-color="%s" data-position="%s"',
            esc_attr($org_id),
            esc_attr($color),
            esc_attr($position)
        );

        if (!empty($greeting)) {
            $attrs .= sprintf(' data-greeting="%s"', esc_attr($greeting));
        }

        printf(
            '<script src="https://widget.deskleap.io/widget.iife.js" %s></script>' . "\n",
            $attrs
        );
    }
}
