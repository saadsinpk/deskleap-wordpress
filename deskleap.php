<?php
/**
 * Plugin Name: DeskLeap
 * Plugin URI: https://deskleap.io
 * Description: Add DeskLeap live chat widget to your WordPress site with automatic visitor identification.
 * Version: 1.0.0
 * Author: DeskLeap
 * Author URI: https://deskleap.io
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: deskleap
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DESKLEAP_VERSION', '1.0.0' );
define( 'DESKLEAP_PLUGIN_FILE', __FILE__ );
define( 'DESKLEAP_WIDGET_URL', 'https://widget.deskleap.io/widget.js' );
define( 'DESKLEAP_PORTAL_URL', 'https://portal.deskleap.io' );
define( 'DESKLEAP_DASHBOARD_URL', 'https://app.deskleap.io/dashboard' );

/**
 * ─── Admin Settings ───
 */

add_action( 'admin_menu', 'deskleap_admin_menu' );

function deskleap_admin_menu() {
	// Top-level menu: Agent Dashboard.
	add_menu_page(
		__( 'DeskLeap', 'deskleap' ),
		__( 'DeskLeap', 'deskleap' ),
		'edit_posts',
		'deskleap-dashboard',
		'deskleap_dashboard_page',
		'dashicons-format-chat',
		30
	);

	// Sub-menu: Dashboard (same as parent).
	add_submenu_page(
		'deskleap-dashboard',
		__( 'Dashboard', 'deskleap' ),
		__( 'Dashboard', 'deskleap' ),
		'edit_posts',
		'deskleap-dashboard',
		'deskleap_dashboard_page'
	);

	// Sub-menu: Settings.
	add_submenu_page(
		'deskleap-dashboard',
		__( 'Settings', 'deskleap' ),
		__( 'Settings', 'deskleap' ),
		'manage_options',
		'deskleap-settings',
		'deskleap_settings_page'
	);
}

add_action( 'admin_init', 'deskleap_register_settings' );

function deskleap_register_settings() {
	register_setting( 'deskleap-settings', 'deskleap_organization_id', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'deskleap-settings', 'deskleap_site_id', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'deskleap-settings', 'deskleap_identity_secret', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'deskleap-settings', 'deskleap_widget_color', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#6366f1',
	) );
	register_setting( 'deskleap-settings', 'deskleap_widget_position', array(
		'type'              => 'string',
		'sanitize_callback' => 'deskleap_sanitize_position',
		'default'           => 'bottom-right',
	) );
	register_setting( 'deskleap-settings', 'deskleap_portal_slug', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'deskleap-settings', 'deskleap_portal_menu', array(
		'type'              => 'boolean',
		'sanitize_callback' => 'rest_sanitize_boolean',
		'default'           => false,
	) );
}

function deskleap_sanitize_position( $value ) {
	return in_array( $value, array( 'bottom-right', 'bottom-left' ), true ) ? $value : 'bottom-right';
}

function deskleap_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'deskleap-settings' ); ?>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="deskleap_organization_id"><?php esc_html_e( 'Organization ID', 'deskleap' ); ?></label>
					</th>
					<td>
						<input type="text" id="deskleap_organization_id" name="deskleap_organization_id"
							value="<?php echo esc_attr( get_option( 'deskleap_organization_id', '' ) ); ?>"
							class="regular-text" placeholder="org_xxxxxxxxxx" />
						<p class="description">
							<?php esc_html_e( 'Find this in your DeskLeap dashboard under Settings > Widget.', 'deskleap' ); ?>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="deskleap_site_id"><?php esc_html_e( 'Site ID', 'deskleap' ); ?></label>
					</th>
					<td>
						<input type="text" id="deskleap_site_id" name="deskleap_site_id"
							value="<?php echo esc_attr( get_option( 'deskleap_site_id', '' ) ); ?>"
							class="regular-text" placeholder="site_xxxxxxxxxx" />
						<p class="description">
							<?php esc_html_e( 'Find this in your DeskLeap dashboard under Sites.', 'deskleap' ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th scope="row" colspan="2">
						<h2 class="title"><?php esc_html_e( 'Widget Appearance', 'deskleap' ); ?></h2>
					</th>
				</tr>
				<tr>
					<th scope="row">
						<label for="deskleap_widget_color"><?php esc_html_e( 'Widget Color', 'deskleap' ); ?></label>
					</th>
					<td>
						<input type="color" id="deskleap_widget_color" name="deskleap_widget_color"
							value="<?php echo esc_attr( get_option( 'deskleap_widget_color', '#6366f1' ) ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="deskleap_widget_position"><?php esc_html_e( 'Widget Position', 'deskleap' ); ?></label>
					</th>
					<td>
						<?php $position = get_option( 'deskleap_widget_position', 'bottom-right' ); ?>
						<select id="deskleap_widget_position" name="deskleap_widget_position">
							<option value="bottom-right" <?php selected( $position, 'bottom-right' ); ?>>
								<?php esc_html_e( 'Bottom Right', 'deskleap' ); ?>
							</option>
							<option value="bottom-left" <?php selected( $position, 'bottom-left' ); ?>>
								<?php esc_html_e( 'Bottom Left', 'deskleap' ); ?>
							</option>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row" colspan="2">
						<h2 class="title"><?php esc_html_e( 'Identity Verification', 'deskleap' ); ?></h2>
					</th>
				</tr>
				<tr>
					<th scope="row">
						<label for="deskleap_identity_secret"><?php esc_html_e( 'Identity Secret', 'deskleap' ); ?></label>
					</th>
					<td>
						<input type="password" id="deskleap_identity_secret" name="deskleap_identity_secret"
							value="<?php echo esc_attr( get_option( 'deskleap_identity_secret', '' ) ); ?>"
							class="regular-text" autocomplete="off" />
						<p class="description">
							<?php esc_html_e( 'Optional. Generate this in DeskLeap > Settings > Widget > Identity Verification. When set, logged-in WordPress users are automatically identified in the chat widget with HMAC verification.', 'deskleap' ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th scope="row" colspan="2">
						<h2 class="title"><?php esc_html_e( 'Customer Portal', 'deskleap' ); ?></h2>
					</th>
				</tr>
				<tr>
					<th scope="row">
						<label for="deskleap_portal_slug"><?php esc_html_e( 'Portal Slug', 'deskleap' ); ?></label>
					</th>
					<td>
						<input type="text" id="deskleap_portal_slug" name="deskleap_portal_slug"
							value="<?php echo esc_attr( get_option( 'deskleap_portal_slug', '' ) ); ?>"
							class="regular-text" placeholder="your-company" />
						<p class="description">
							<?php
							printf(
								/* translators: %s: example portal URL */
								esc_html__( 'Your portal URL slug. Example: if your portal is at %s, enter "your-company".', 'deskleap' ),
								'<code>portal.deskleap.io/your-company</code>'
							);
							?>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Add Support Link to Menu', 'deskleap' ); ?></th>
					<td>
						<label for="deskleap_portal_menu">
							<input type="checkbox" id="deskleap_portal_menu" name="deskleap_portal_menu"
								value="1" <?php checked( get_option( 'deskleap_portal_menu', false ) ); ?> />
							<?php esc_html_e( 'Add a "Support" link to the primary navigation menu that links to your DeskLeap portal.', 'deskleap' ); ?>
						</label>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>

		<hr />
		<h2><?php esc_html_e( 'Shortcodes', 'deskleap' ); ?></h2>
		<table class="form-table" role="presentation">
			<tr>
				<th scope="row"><?php esc_html_e( 'Embed Portal', 'deskleap' ); ?></th>
				<td>
					<code>[deskleap_portal]</code>
					<p class="description">
						<?php esc_html_e( 'Embed the customer portal (knowledge base, tickets) directly in any page or post. Requires Portal Slug to be configured above.', 'deskleap' ); ?>
					</p>
					<p class="description" style="margin-top:4px;">
						<?php esc_html_e( 'Optional attributes:', 'deskleap' ); ?>
						<code>height="800"</code>
						<code>slug="your-company"</code>
					</p>
				</td>
			</tr>
		</table>
	</div>
	<?php
}

/**
 * ─── Agent Dashboard (iframe in wp-admin) ───
 */

function deskleap_dashboard_page() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	?>
	<div class="wrap" style="margin: 0; padding: 0;">
		<iframe
			id="deskleap-dashboard-frame"
			src="<?php echo esc_url( DESKLEAP_DASHBOARD_URL ); ?>"
			style="width: 100%; height: calc(100vh - 32px); border: none; display: block;"
			allow="clipboard-write; notifications"
			loading="eager"
		></iframe>
	</div>
	<style>
		/* Remove WP admin padding when viewing DeskLeap dashboard */
		#wpcontent { padding-left: 0 !important; }
		#wpbody-content { padding-bottom: 0 !important; }
		.wrap { margin: 0 !important; }
		#wpfooter { display: none; }
	</style>
	<?php
}

/**
 * ─── Full-width layout for DeskLeap dashboard page ───
 */

add_action( 'admin_head', 'deskleap_dashboard_styles' );

function deskleap_dashboard_styles() {
	$screen = get_current_screen();
	if ( ! $screen || $screen->id !== 'toplevel_page_deskleap-dashboard' ) {
		return;
	}
	echo '<style>#adminmenuwrap { z-index: 9999; }</style>';
}

/**
 * ─── Portal Shortcode [deskleap_portal] ───
 *
 * Embeds the DeskLeap customer portal inline via iframe.
 * Usage: [deskleap_portal] or [deskleap_portal height="800"]
 */

add_shortcode( 'deskleap_portal', 'deskleap_portal_shortcode' );

function deskleap_portal_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'height' => '800',
		'slug'   => '',
	), $atts, 'deskleap_portal' );

	$slug = ! empty( $atts['slug'] ) ? $atts['slug'] : get_option( 'deskleap_portal_slug', '' );
	if ( empty( $slug ) ) {
		if ( current_user_can( 'manage_options' ) ) {
			return '<p style="color:#dc2626;font-weight:600;">' . esc_html__( '[DeskLeap] Portal slug not configured. Go to Settings > DeskLeap to set it up.', 'deskleap' ) . '</p>';
		}
		return '';
	}

	$url    = DESKLEAP_PORTAL_URL . '/' . rawurlencode( $slug );
	$height = max( 400, (int) $atts['height'] );

	return sprintf(
		'<iframe src="%s" style="width:100%%;height:%dpx;border:none;border-radius:8px;" loading="lazy" allow="clipboard-write"></iframe>',
		esc_url( $url ),
		$height
	);
}

/**
 * ─── Frontend Widget Embed ───
 */

add_action( 'wp_footer', 'deskleap_embed_widget' );

function deskleap_embed_widget() {
	$org_id = get_option( 'deskleap_organization_id', '' );
	if ( empty( $org_id ) ) {
		return;
	}

	$site_id  = get_option( 'deskleap_site_id', '' );
	$color    = get_option( 'deskleap_widget_color', '#6366f1' );
	$position = get_option( 'deskleap_widget_position', 'bottom-right' );
	$secret   = get_option( 'deskleap_identity_secret', '' );

	// Build visitor identity for logged-in users.
	$visitor_attrs = '';
	if ( is_user_logged_in() && ! empty( $secret ) ) {
		$user  = wp_get_current_user();
		$email = $user->user_email;
		$name  = trim( $user->display_name );
		$hash  = hash_hmac( 'sha256', $email, $secret );

		$visitor_attrs .= ' data-visitor-email="' . esc_attr( $email ) . '"';
		$visitor_attrs .= ' data-visitor-name="' . esc_attr( $name ) . '"';
		$visitor_attrs .= ' data-visitor-user-id="' . esc_attr( (string) $user->ID ) . '"';
		$visitor_attrs .= ' data-visitor-hash="' . esc_attr( $hash ) . '"';
	} elseif ( is_user_logged_in() ) {
		// No secret — pass identity without HMAC (unverified).
		$user = wp_get_current_user();
		$visitor_attrs .= ' data-visitor-email="' . esc_attr( $user->user_email ) . '"';
		$visitor_attrs .= ' data-visitor-name="' . esc_attr( trim( $user->display_name ) ) . '"';
		$visitor_attrs .= ' data-visitor-user-id="' . esc_attr( (string) $user->ID ) . '"';
	}

	printf(
		'<script src="%s" data-organization-id="%s"%s%s%s%s async></script>',
		esc_url( DESKLEAP_WIDGET_URL ),
		esc_attr( $org_id ),
		! empty( $site_id ) ? ' data-site-id="' . esc_attr( $site_id ) . '"' : '',
		' data-color="' . esc_attr( $color ) . '"',
		' data-position="' . esc_attr( $position ) . '"',
		$visitor_attrs
	);
}

/**
 * ─── Portal Menu Link ───
 */

add_filter( 'wp_nav_menu_items', 'deskleap_add_portal_menu_link', 10, 2 );

function deskleap_add_portal_menu_link( $items, $args ) {
	if ( ! get_option( 'deskleap_portal_menu', false ) ) {
		return $items;
	}

	// Only add to primary/main menu.
	$primary_locations = array( 'primary', 'main', 'header', 'menu-1', 'primary-menu' );
	$theme_location    = isset( $args->theme_location ) ? $args->theme_location : '';

	if ( ! in_array( $theme_location, $primary_locations, true ) ) {
		return $items;
	}

	$slug = get_option( 'deskleap_portal_slug', '' );
	if ( empty( $slug ) ) {
		return $items;
	}

	$url   = 'https://portal.deskleap.io/' . rawurlencode( $slug );
	$label = __( 'Support', 'deskleap' );
	$items .= '<li class="menu-item deskleap-support-link"><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $label ) . '</a></li>';

	return $items;
}

/**
 * ─── Settings Link on Plugins Page ───
 */

add_filter( 'plugin_action_links_' . plugin_basename( DESKLEAP_PLUGIN_FILE ), 'deskleap_plugin_action_links' );

function deskleap_plugin_action_links( $links ) {
	$settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=deskleap-settings' ) ) . '">' . __( 'Settings', 'deskleap' ) . '</a>';
	$dashboard_link = '<a href="' . esc_url( admin_url( 'admin.php?page=deskleap-dashboard' ) ) . '">' . __( 'Dashboard', 'deskleap' ) . '</a>';
	array_unshift( $links, $dashboard_link, $settings_link );
	return $links;
}
