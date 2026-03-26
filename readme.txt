=== DeskLeap ===
Contributors: deskleap
Tags: live chat, customer support, helpdesk, chat widget, support tickets
Requires at least: 5.8
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add DeskLeap live chat and customer support to your WordPress site in one click.

== Description ==

DeskLeap is a modern customer support platform with live chat, ticketing, and a knowledge base. This plugin connects your WordPress site to DeskLeap in seconds.

**Features:**

* **Live Chat Widget** — Adds the DeskLeap chat widget to every page of your site. Visitors can start conversations instantly.
* **Automatic User Identification** — Logged-in WordPress users are automatically identified in the chat widget. Agents see the visitor's name and email without asking.
* **Identity Verification (HMAC-SHA256)** — Optionally verify visitor identity with cryptographic signatures to prevent spoofing.
* **Customizable** — Choose widget color and position (bottom-right or bottom-left) from the settings page.
* **Customer Portal Link** — Add a "Support" link to your navigation menu that opens your DeskLeap customer portal.
* **Portal Shortcode** — Use `[deskleap_portal]` to embed the full customer portal (knowledge base, submit tickets, track tickets) directly inside any WordPress page.
* **Agent Dashboard in WordPress** — Manage tickets, live chat, and reports directly from your WordPress admin area without leaving wp-admin.
* **Clean Uninstall** — All settings are removed when you delete the plugin.

**Getting Started:**

1. Install and activate the plugin.
2. Go to **DeskLeap > Settings** in the WordPress admin sidebar.
3. Enter your Organization ID (from your DeskLeap dashboard).
4. Save changes. The chat widget appears on your site immediately.

**Embed the Customer Portal:**

Add `[deskleap_portal]` to any page to embed your knowledge base and ticket system inline. Optional: `[deskleap_portal height="900"]` to adjust the height.

**Agent Dashboard:**

Click **DeskLeap > Dashboard** in the WordPress admin sidebar to access the full agent panel — tickets, live chat, reports, and settings — all without leaving WordPress.

== Installation ==

1. Upload the `deskleap` folder to `/wp-content/plugins/`.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Go to **DeskLeap > Settings** and enter your Organization ID.

== Frequently Asked Questions ==

= Where do I find my Organization ID? =

Log in to your DeskLeap dashboard at [app.deskleap.io](https://app.deskleap.io). Go to **Settings > Widget** to find your Organization ID.

= Does this plugin slow down my site? =

No. The widget script loads asynchronously and does not block page rendering.

= How does automatic user identification work? =

When a WordPress user is logged in and visits your site, the plugin passes their name and email to the DeskLeap widget. Your support agents will see who they are talking to without the visitor needing to introduce themselves.

= What is Identity Verification? =

Identity Verification uses HMAC-SHA256 to cryptographically sign the visitor's email address. This prevents anyone from impersonating another user in the chat. Generate your Identity Secret in DeskLeap under **Settings > Widget > Identity Verification**, then paste it into the plugin settings.

= Can I use this with a custom portal domain? =

Yes. If you have a custom domain for your DeskLeap portal (e.g., support.yoursite.com), enter that domain in the Portal Slug field.

= How do I embed the portal in a page? =

Create a new page (e.g., "Support") and add the shortcode `[deskleap_portal]`. This embeds the full customer portal including knowledge base articles, ticket submission, and ticket tracking directly inside your WordPress page.

= Can my agents use DeskLeap from WordPress? =

Yes. Go to **DeskLeap > Dashboard** in the WordPress admin sidebar. This opens the full DeskLeap agent dashboard — tickets, live chat, reports, and settings — all inside WordPress.

== Changelog ==

= 1.0.0 =
* Initial release.
* Live chat widget embed.
* Automatic identification of logged-in WordPress users.
* HMAC-SHA256 identity verification.
* Widget color and position settings.
* Customer portal menu link.
* Portal shortcode for inline embedding.
* Agent dashboard in WordPress admin.
* Clean uninstall.
