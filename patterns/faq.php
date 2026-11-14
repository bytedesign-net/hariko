<?php
/**
 * Title: faq
 * Slug: hariko/faq
 * Categories: featured
 * Viewport Width: 1280
 * Description: Frequently asked questions built with the core/accordion blocks from WordPress 6.9. The first question opens by default, every question is a real heading and the answers are keyboard accessible without any custom JavaScript.
 */
?>
<!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size"><?php esc_html_e( 'Frequently Asked Questions', 'hariko' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:accordion {"headingLevel":3,"style":{"spacing":{"blockGap":"0"}}} -->
<div role="group" class="wp-block-accordion"><!-- wp:accordion-item {"openByDefault":true} -->
<div class="wp-block-accordion-item is-open"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php esc_html_e( 'What is the Hariko theme?', 'hariko' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Hariko is a block theme with fluid typography, ten font-size presets and nine color style variations. It is intentionally minimal, so it works as a starter theme for your own projects.', 'hariko' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php esc_html_e( 'Do I need to edit theme.json to customize it?', 'hariko' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'No. Colors, typography and layout are editable in the Site Editor, and the style variations let you switch the whole appearance with one click. theme.json is only there when you want to change the defaults for the entire site.', 'hariko' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php esc_html_e( 'How does this accordion work?', 'hariko' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph -->
<p><?php esc_html_e( 'It is the core accordion block, shipped with WordPress 6.9. WordPress loads a small accessibility script only on pages that use the block, and the open state also works without JavaScript.', 'hariko' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion -->
