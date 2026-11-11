=== Hariko ===
Contributors: (your_wp_org_username)
Tags: accessibility-ready, block-styles, full-site-editing, one-column, translation-ready
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.2
Stable tag: 1.0.12
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An accessible block theme designed to WCAG 2.2 AA: visible focus indicators, keyboard skip links, sufficient color contrast and reduced-motion support.

== Description ==

Hariko is an accessible WordPress block theme designed to WCAG 2.2 AA. It includes preset colors, typography, content and wide layout sizes, reusable template parts, and standard, full-width and sidebar templates for pages and posts.

Built as a base for custom-made sites, Hariko includes the accessibility groundwork that every project would otherwise have to re-create:

* A clearly visible focus indicator (outline plus halo) on every interactive element, working on both light and dark backgrounds
* A keyboard "skip to content" link, provided by WordPress core and revealed on focus by the theme
* A colour palette checked for AA colour contrast (text and non-text elements), including a focus-safe meta-grey pairing
* `prefers-reduced-motion` support that disables carousels, hero transitions and smooth scrolling for visitors who request it
* Accessible navigation: the dropdown menus open on keyboard focus as well as hover, and the active page is announced with `aria-current`
* Comments forms and archives that follow the standard WordPress template hierarchy

= Colours =

Nine hand-tuned colour palettes are included: Slate, Amber, Cocoa, Crimson, Forest, Lemon, Olive, Plum and Rose. Each palette carries AA-contrast text, link and button combinations. Nine additional tint ramps are available in the editor for backgrounds, borders and subtle decorations.

= Typography =

Font sizes from Small (0.875rem) to Huge (3.5rem) are available, with fluid display sizes for headings. Font weight presets make it easy to give headings extra emphasis.

= Templates and template parts =

* Templates: front page, blog, single post, page, full-width page, sidebar page, sidebar post, search results and 404
* Template parts: header, footer and comments

The sidebar and full-width templates let you vary the layout per page or per post from the editor, without any custom code.

= Patterns =

A front-page pattern set shows recent posts, featured posts, a services trio, a call-to-action band and a text-and-image section.

= Accessibility testing =

The theme was audited against WCAG 2.2 AA with axe-core and a manual keyboard, zoom and screen-reader pass. Every finding is recorded in `docs/accessibility-test-matrix.md` inside the theme download, together with the fixes applied.

== Installation ==

1. In your WordPress dashboard, go to Appearance > Themes and click "Add New".
2. Click "Upload Theme", choose the Hariko zip file, and click "Install Now".
3. Click "Activate" to activate the theme.
4. Visit Appearance > Editor to customise your site with the Site Editor.
5. Optionally activate "GenerateBlocks" for the most compatible page-building experience.

== Frequently Asked Questions ==

= Does Hariko work with GenerateBlocks? =

Yes. The theme's layout tokens and custom class names (hero-on-dark, hero-on-light, card-grid, with-sidebar, wp-block-query) were verified against GenerateBlocks in a real WordPress environment.

= How do I get the "skip to content" link? =

It is provided by WordPress core. It stays visually hidden until a keyboard user presses Tab on a page. Hariko reveals it automatically, so no extra markup is required.

= How do I add a dropdown menu? =

Add a Submenu to a Navigation block item. The dropdown opens on hover and on keyboard focus, closes with Escape or Tab past the last item, and each item carries `aria-current="page"` when it points to the page being viewed.

= How do I change the colour palette? =

Open the Site Editor, pick any of the nine palettes in Styles, or create your own. Colour combinations are checked for AA colour contrast, so stay within one palette for the strongest result.

= Is Hariko translation ready? =

Yes. All theme text uses the "hariko" text domain, and the theme includes a POT file. You can translate it with Loco Translate, Poedit, or GlotPress.

= How do I test colour contrast? =

Add or edit colours in the Site Editor and check the pairs with the free [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/). For an automated sweep of your pages, run the axe DevTools browser extension against the WCAG 2.2 AA ruleset.

= How do I change the theme version? =

Edit the "Version:" value in `style.css` and the "Stable tag:" value in `readme.txt`. Keep them in sync.

= How do I disable the carousel animation? =

The front-page carousel pauses automatically for visitors whose operating system requests reduced motion. To disable it for everyone, add this CSS in Appearance > Customize or in the Site Editor:

`.hariko-hero.is-animating { animation: none; }`

= Does the theme support WooCommerce? =

WooCommerce styling is not built in yet, and is planned for a future release. The theme's layout classes and content width are ready for it.

== Copyright ==

Hariko WordPress Theme, (C) 2026 TATIT Co., Ltd.
Hariko is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Changelog ==

= 1.0.12 =
* Added WCAG 2.2 AA test matrix with axe-core, keyboard, zoom and reduced-motion results.
* Added AA-contrast Slate, Amber and Cocoa palette variants and a contrast-safe focus pairing for meta text.
* Improved focus visibility with a dual-layer outline and halo that works on any background.
* Improved navigation dropdowns to open on keyboard focus, close on Escape, and announce the active page.
* Improved comments templates so shared comment styles live in theme.json.
* Changed the theme stylesheet to `assets/css/theme.css` so the root `style.css` stays free for end-user custom CSS.
* Changed `Tested up to` to the `major.minor` format for Theme Check compatibility.
* Removed unused template patterns and legacy code.

= 1.0.11 =
* Fixed sticky posts and hierarchical permalink regressions in template queries.
* Improved front page with a hero image section and clearer post excerpts.

= 1.0.10 =
* Added a front-page hero block pattern with fade animation.
* Fixed sidebar layout width and padding for wide and full-width alignments.

= 1.0.9 =
* Added full-width and sidebar templates for posts and pages.
* Added a custom carousel animation for the front-page hero.

= 1.0.8 =
* Added comments template support with password protection and previous/next post navigation.
* Improved screenshot.png with stronger Hariko doll imagery.

= 1.0.7 =
* Added text-domain and translation-ready headers for GlotPress compatibility.

= 1.0.6 =
* Added full-width template for pages.
* Improved theme.json with custom spacing and color variables.

= 1.0.5 =
* Added sidebar template for posts.
* Improved responsive breakpoints for mobile devices.

= 1.0.4 =
* Improved accessibility with skip-to-content link.
* Fixed font loading issue in Safari.

= 1.0.3 =
* Added custom template for front page.
* Fixed color contrast issues in the default palette.

= 1.0.2 =
* Added child theme compatibility.
* Added additional color palette options.

= 1.0.1 =
* Fixed theme.json schema version.
* Added support for block editor styles.

= 1.0.0 =
* Initial release.
