# DeskLeap – Live Chat, Help Desk & Customer Support Plugin for WordPress

Add **live chat**, **help desk ticketing**, and a **knowledge base** to your WordPress site with the official DeskLeap plugin. Connect your WordPress site to [DeskLeap](https://deskleap.io) in under 2 minutes — no coding required.

[![WordPress Plugin Version](https://img.shields.io/badge/WordPress-v1.0.0-blue)](https://wordpress.org/plugins/deskleap/)
[![License: GPL v2](https://img.shields.io/badge/License-GPLv2-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![PHP 7.4+](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://www.php.net/)

---

## What is DeskLeap?

[DeskLeap](https://deskleap.io) is a modern customer support platform that helps businesses manage customer conversations through **live chat**, **support tickets**, and a **self-service knowledge base** — all from one dashboard.

This WordPress plugin integrates DeskLeap into your WordPress site so you can:

- Chat with visitors in real time
- Let customers submit and track support tickets
- Provide a searchable knowledge base
- Manage everything from your WordPress admin panel

## Features

### Live Chat Widget
Automatically adds the DeskLeap chat widget to every page of your WordPress site. Visitors can start a conversation with your support team instantly. The widget loads asynchronously and does not affect page speed.

### Agent Dashboard in WordPress
Access the full DeskLeap agent dashboard directly from your WordPress admin sidebar. Manage tickets, respond to live chats, view reports, and configure settings — all without leaving WordPress.

### Customer Portal Shortcode
Embed the full customer portal (knowledge base articles, ticket submission, ticket tracking) directly inside any WordPress page using:

```
[deskleap_portal]
```

Your customers get a seamless support experience without leaving your site.

### Automatic User Identification
When a WordPress user is logged in and visits your site, the plugin automatically passes their name and email to the chat widget. Your agents instantly see who they are talking to — no need for visitors to identify themselves.

### Identity Verification (HMAC-SHA256)
Optionally enable cryptographic identity verification to prevent visitors from impersonating other users. The plugin signs each visitor's identity server-side using HMAC-SHA256, and DeskLeap verifies the signature. This is the industry-standard approach used by leading support platforms.

### Customer Portal Menu Link
Optionally add a "Support" link to your WordPress navigation menu that directs visitors to your DeskLeap customer portal.

### Customizable Widget
Choose your brand color and widget position (bottom-right or bottom-left) from the plugin settings page.

### Clean Uninstall
All plugin settings are removed from the database when you delete the plugin. No leftover data.

---

## Getting Started

### Step 1: Create a DeskLeap Account

1. Visit [deskleap.io](https://deskleap.io) and click **Get Started Free**
2. Create your account at [app.deskleap.io/register](https://app.deskleap.io/register)
3. Follow the setup wizard to create your **Organization**

### Step 2: Add Your Website

1. In the DeskLeap dashboard, go to **Sites** in the left sidebar
2. Click **Add Site** and enter your WordPress site URL
3. Note your **Site ID** — you'll need it for the plugin

### Step 3: Get Your Organization ID

1. Go to **Settings > Widget** in the DeskLeap dashboard
2. Copy your **Organization ID** (looks like `clxx...`)
3. Optionally, copy the embed code to verify the format

### Step 4: Install the WordPress Plugin

**Option A: Upload (Recommended)**

1. Download this plugin as a ZIP file
2. In WordPress admin, go to **Plugins > Add New > Upload Plugin**
3. Upload the ZIP and click **Install Now**
4. Click **Activate**

**Option B: Manual Installation**

1. Download or clone this repository
2. Upload the `deskleap` folder to `/wp-content/plugins/`
3. Go to **Plugins** in WordPress admin and activate **DeskLeap**

### Step 5: Configure the Plugin

1. In WordPress admin, go to **DeskLeap > Settings**
2. Enter your **Organization ID** and **Site ID**
3. Choose your preferred widget color and position
4. Click **Save Changes**

The chat widget will now appear on every page of your WordPress site.

---

## Plugin Settings

| Setting | Description |
|---------|-------------|
| **Organization ID** | Your DeskLeap organization identifier. Found in Settings > Widget. |
| **Site ID** | Your site identifier. Found in the Sites section. |
| **Widget Color** | Brand color for the chat widget button and header. |
| **Widget Position** | Bottom-right or bottom-left corner of the page. |
| **Identity Secret** | HMAC-SHA256 secret for verified user identification. Found in Settings > Widget > Identity Verification. |
| **Portal Slug** | Your portal URL slug for the customer portal shortcode and menu link. |
| **Add Support Link to Menu** | Adds a "Support" link to your primary navigation menu. |

---

## Shortcode Reference

### `[deskleap_portal]`

Embeds the DeskLeap customer portal inline on any page or post.

**Basic usage:**
```
[deskleap_portal]
```

**With custom height:**
```
[deskleap_portal height="900"]
```

**With explicit slug (overrides settings):**
```
[deskleap_portal slug="your-company"]
```

**Attributes:**

| Attribute | Default | Description |
|-----------|---------|-------------|
| `height` | `800` | Height of the embedded portal in pixels (minimum 400). |
| `slug` | *(from settings)* | Portal slug. Overrides the value in plugin settings. |

**Tip:** Create a dedicated WordPress page called "Support" or "Help Center" and add the shortcode to embed the full portal experience.

---

## Identity Verification Setup

Identity verification prevents users from spoofing someone else's identity in the chat widget. When enabled, the plugin generates an HMAC-SHA256 signature for each logged-in WordPress user and passes it to the widget. DeskLeap verifies this signature server-side.

### How to Enable

1. In DeskLeap, go to **Settings > Widget > Identity Verification**
2. Click **Generate Secret** to create your HMAC secret key
3. Copy the secret key
4. In WordPress, go to **DeskLeap > Settings**
5. Paste the secret into the **Identity Secret** field
6. Save changes

That's it. Logged-in WordPress users will now be verified automatically.

---

## Agent Dashboard

The plugin adds a **DeskLeap** menu item to your WordPress admin sidebar. Click **DeskLeap > Dashboard** to access the full agent panel:

- **Tickets** — View, reply to, and manage support tickets
- **Live Chat** — Real-time chat with website visitors
- **Knowledge Base** — Create and manage help articles
- **Reports** — View support metrics and analytics
- **Settings** — Configure your DeskLeap workspace

Agents with the `edit_posts` WordPress capability can access the dashboard. Only administrators (`manage_options`) can change plugin settings.

---

## FAQ

**Do I need a DeskLeap account?**
Yes. The plugin connects your WordPress site to DeskLeap. Sign up for free at [deskleap.io](https://deskleap.io).

**Does this plugin slow down my website?**
No. The chat widget script loads asynchronously and does not block page rendering or affect your Core Web Vitals.

**Is the plugin free?**
The plugin itself is free and open source. DeskLeap offers a free plan and paid plans with additional features. See [deskleap.io/pricing](https://deskleap.io/#pricing) for details.

**Can I customize the chat widget appearance?**
Yes. You can set the widget color and position from the plugin settings. Additional customization (welcome messages, pre-chat forms, business hours) is available in the DeskLeap dashboard.

**Does it work with WooCommerce?**
Yes. The chat widget appears on all pages including WooCommerce product pages, cart, and checkout. Logged-in WooCommerce customers are automatically identified.

**Can I embed the portal on multiple pages?**
Yes. Use the `[deskleap_portal]` shortcode on as many pages as you like.

**What data does the plugin send to DeskLeap?**
The plugin loads the DeskLeap widget script and passes your Organization ID, Site ID, and widget preferences. For logged-in users, it also passes the user's display name, email address, and WordPress user ID. If identity verification is enabled, an HMAC-SHA256 hash is generated server-side and sent to verify the user's identity.

**How do I uninstall?**
Deactivate and delete the plugin from WordPress. All plugin settings are automatically removed from the database.

---

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- A DeskLeap account ([sign up free](https://deskleap.io))

## Support

- **Documentation:** [deskleap.io](https://deskleap.io)
- **Issues:** [GitHub Issues](https://github.com/sidtechno/deskleap-wordpress/issues)
- **Email:** support@deskleap.io

## License

This plugin is licensed under the [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.html).
