=== Hariko ===
Tags: accessibility-ready, block-styles, translation-ready
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.2
Stable tag: 1.0.12
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An accessible block theme designed to WCAG 2.2 AA: visible focus indicators, keyboard skip links, sufficient color contrast and reduced-motion support.

== Description ==

Hariko is an accessible WordPress block theme designed to WCAG 2.2 AA. It includes preset colors, typography, content and wide layout sizes, reusable template parts, and standard, full-width, and sidebar templates for pages and posts.

Built as a base for custom-made sites, Hariko includes the accessibility groundwork that every project would otherwise have to re-create:

* A clearly visible focus indicator (outline plus halo) on every interactive element, working on both light and dark backgrounds
* A keyboard "skip to content" link, provided by WordPress core and revealed on focus by the theme
* A colour palette checked for AA colour contrast (text and non-text elements), including a darkened primary blue
* Nine additional AA-checked colour palettes (Amber, Cocoa, Crimson, Forest, Lemon, Olive, Plum, Rose, Slate) that can be switched with one click as colour style variations
* Fixed 16px base font size so small text never drops below 16px at common viewports
* Support for prefers-reduced-motion: animations and transitions are disabled for visitors who request it
* Visible labels and borders for form fields, so inputs are identifiable without relying on colour alone (search fields, forms)
* Underlined links with additional hover/focus feedback, so links are identifiable without relying on colour alone
* Semantic landmarks (header, main, footer, navigation regions with unique labels) and a logical heading structure

= Accessibility statement =

Hariko is designed and built with WCAG 2.2 AA as the target. Automated contrast checks are run against the default palette and every bundled colour style variation (Amber, Cocoa, Crimson, Forest, Lemon, Olive, Plum, Rose, Slate). We aim to provide the same experience to all users regardless of how they access the site.

Accessibility issues can be reported through the support forum on WordPress.org or via the issue tracker at https://github.com/munepo/hariko/issues . We aim to respond to accessibility reports within two weeks and to ship fixes in the next release.

= Known limitations =

* Colour, gradient and custom colour tools remain available on purpose so the theme can be used as a base for client sites. Customisations made with these tools can break the theme's default contrast, so contrast should be re-checked after customising (see the FAQ below).
* Third-party blocks and plugins can introduce their own accessibility issues that are outside the theme's control.

== Installation ==

1. In the WordPress dashboard, go to Appearance > Themes and click Add New.
2. Search for "Hariko", or upload the hariko zip file, then click Install and Activate.
3. Alternatively, upload the hariko folder to /wp-content/themes/ and activate it under Appearance > Themes.

== Frequently Asked Questions ==

= Does the theme support custom colours? =

Yes. The palette, gradients and custom colour pickers stay available so the theme can be used as a base for bespoke designs.

= Can I change the colour scheme without editing individual colours? =

Yes. Open Appearance > Editor > Styles > Colors and pick one of the bundled palettes: Amber, Cocoa, Crimson, Default, Forest, Lemon, Olive, Plum, Rose or Slate. Every bundled palette has been checked for AA colour contrast, so switching between them keeps the site accessible.

= How do I check contrast after customising colours? =

Use the free WCAG contrast checker bundled with the theme's repository (npm run contrast), or any tool such as the WebAIM Contrast Checker, for every foreground/background pair you introduce.

== Changelog ==

= 1.0.12 =
* Colour palette: darkened "Primary" to #0066b3 and "Tertiary" to #00428c so text and non-text contrast meet WCAG 2.2 AA; aligned "Secondary" (#0074f5) with the primary hue and marked it as accent-only; darkened "Gray" to #595959 (4.74:1 on white).
* Colour palette: the default (core) palette is no longer added to the picker to prevent selecting colours with insufficient contrast.
* Added nine AA-checked colour style variations, Amber, Cocoa, Crimson, Forest, Lemon, Olive, Plum, Rose and Slate, in styles/colors/. They share the theme palette slugs, so switching one (Appearance > Editor > Styles > Colors) recolours the whole site, including focus indicators and buttons, and all automated contrast checks pass for every variation.
* Typography: the "M" font size is fixed at 16px (no fluid minimum) so body text never renders below 16px.
* Focus indicator: added a universal visible focus ring (3px outline plus halo) for keyboard users on all interactive elements, on the front end and in the editor.
* Buttons: the outline button variant now uses the Primary color for border and text, with a darker hover tint for a clear hover state and AA contrast.
* Buttons and links: honour prefers-reduced-motion (front-end CSS and theme.json motion settings).
* Links: removed hover states that hid underlines; links keep their underline and gain it on hover/focus in the header and footer; underline offset improved.
* Forms: search and other input fields now have visible borders and background (non-text contrast 3:1) and remain recognisable without colour cues.
* Templates: added sidebar and posts template parts with properly labelled navigation regions (Categories, Archives), a corrected heading structure, and a single no-results message; navigation menus and regions carry unique accessible names.
* Front page pattern: heading text moved out of the background image alt text; added a proper call-to-action button.
* Added screen-reader text support and skip-link focus styling.
* Raised Requires PHP to 7.2 and Requires at least to 6.7.
* Note: sites that customised global styles with a previous version may need to reset or re-check Appearance > Editor > Styles after updating, because the default palette colours changed.

= 1.0.11 =
* Updated theme.json for WordPress 7.1 compatibility.
* Fixed template part area metadata and duplicate skip links.
* Updated front page content and removed external links.

= 1.0.10 =
** Fixed Description.

= 1.0.9 =
** Remove skip links in the editor.

= 1.0.8 =
** Update the required PHP version.

= 1.0.7 =
** Replace deprecated functions with recommended ones.

= 1.0.6 =
** I made some changes to the front page template configuration.

= 1.0.5 =
** Convert the remaining Japanese names to English.
** Fixed issue with page-with-sidebar, single-with-sidebar templates not loading.

= 1.0.4 =
** Convert Japanese name to English.

= 1.0.3 =
* Bug Fix
** Fixed issue with page-fullwidth template not loading.

= 1.0.2 =
* Bug Fix
** Fixed issue with custom templates not loading.

= 1.0.1 =
* Accessibility Improvements
** Text Links: Underlines are now displayed for text links to enhance visual distinction and improve accessibility for users with visual impairments.
** Skip Links: A skip link has been implemented to provide direct navigation to the main content area for screen reader users. This enhances keyboard navigation and accessibility for users who rely on assistive technologies.

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0.12 =
Palette colours were darkened and focus indicators changed to meet WCAG 2.2 AA. Nine new AA-checked colour variations (Amber, Cocoa, Crimson, Forest, Lemon, Olive, Plum, Rose, Slate) were added. Sites with customised global styles may need to reset or re-check their styles after updating.

== Copyright ==

hariko WordPress Theme, (C) 2024
hariko is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
