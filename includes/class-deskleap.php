<?php

if (!defined('ABSPATH')) {
    exit;
}

class DeskLeap {
    private static $instance = null;

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Initialize admin
        if (is_admin()) {
            new DeskLeap_Admin();
        }

        // Initialize widget injection
        new DeskLeap_Widget();
    }
}
