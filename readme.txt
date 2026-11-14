=== Hariko ===
Tags: accessibility-ready, block-styles, translation-ready
Requires at least: 6.9
Tested up to: 7.1
Requires PHP: 7.2
Stable tag: 1.0.13
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Hariko is a minimalist WordPress block theme designed for flexibility and customization. It includes preset colors, typography, content and wide layout sizes, reusable template parts, and standard, full-width, and sidebar templates for pages and posts. All theme text is translatable through the `hariko` text domain, and translations into Japanese, Simplified and Traditional Chinese, Korean, Spanish, French, German and Italian are bundled in the download.

== Changelog ==
= 1.0.13 =
* Added interactive state styles to `theme.json`: `:hover`, `:focus`, `:focus-visible` and `:active` for buttons, links and navigation links, plus the `-current` custom state that highlights the active item in the navigation block.
* Declared the responsive viewport breakpoints used by the new `@mobile` / `@tablet` block styles explicitly in `settings.viewport` (`480px` / `782px`, matching the WordPress core defaults), and added responsive styles to the front page intro heading and the navigation links.
* Added the `hariko/hero` banner pattern: heading, text and button label are edited inline through pattern overrides and Block Bindings (`core/pattern-overrides`), with gettext fallbacks for older WordPress versions.
* Added the `hariko/faq` pattern: a frequently asked questions section built with the `core/accordion` blocks introduced in WordPress 6.9, with theme styles for the item separators, heading weight and hover state added to `theme.json`.
* Fixed the hidden `hariko/front-page` pattern rendering a whole page (header template part, duplicate hero cover and footer) inside the front page content; it now provides only the intro text and the post list, since the `front-page` template supplies the header, hero and content wrappers.
* Added bundled translations for Simplified and Traditional Chinese, Korean, Spanish, French, German and Italian, and updated the Japanese catalogue.
* Raised `Requires at least` to 6.9, the first release with Block Bindings.
* Changed the size preset slugs to a clearer numeric scale: font sizes `xxl` through `xxxxxxl` are now `2-xl` through `6-xl`, spacing sizes `xxl` and `xxxl` are now `2-xl` and `3-xl`, and every font size preset now carries a label (`XS` through `6XL`) in the editor picker. Legacy CSS variables and classes are aliased to the new presets in `theme.json`, so content and templates built with earlier Hariko versions render unchanged.

= 1.0.12 =
* Added multilingual support: theme text now runs through gettext, with a `languages/hariko.pot` catalogue and a bundled Japanese translation (`languages/hariko-ja.mo`).
* Added a search form to the footer template part.
* Changed the front page, home and index templates to render the page content and the post list directly instead of the front-page pattern; the front page keeps its hero cover.
* Moved the theme stylesheet to `assets/css/theme.css` and removed unused scripts and images.
* Fixed default block spacing (background groups, quote, code) that was lost when `wp-block-styles` theme support was dropped.
* Fixed undefined spacing slugs in the posts template part.
* Added a WCAG 2.2 AA test matrix with axe-core, keyboard, zoom and reduced-motion results.
* Improved color palette contrast, focus visibility and navigation dropdown behavior.
* Changed `Tested up to` to the `major.minor` format for Theme Check compatibility.

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

== Copyright ==

Hariko WordPress Theme, (C) 2024
Hariko is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
