<?php
/**
 * DeskLeap Uninstall
 *
 * Removes all plugin options from the database when the plugin is deleted
 * via the WordPress admin.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$options = array(
	'deskleap_organization_id',
	'deskleap_site_id',
	'deskleap_identity_secret',
	'deskleap_widget_color',
	'deskleap_widget_position',
	'deskleap_portal_slug',
	'deskleap_portal_menu',
);

foreach ( $options as $option ) {
	delete_option( $option );
}
