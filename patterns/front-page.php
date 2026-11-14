<?php
/**
 * Title: front-page
 * Slug: hariko/front-page
 * Categories: hidden
 * Inserter: no
 *
 * Body content for the static front page. The `front-page` template already
 * renders the header, the hero cover and the content wrappers, so this
 * pattern provides page content only: an introduction and the post list.
 * Insert it into the page set as the static front page to reproduce the
 * theme demo without nesting a second page inside the content.
 */
?>
<!-- wp:heading {"style":{"@mobile":{"typography":{"fontSize":"var:preset|font-size|xl"}}}} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Hariko: A Minimalist WordPress Block Theme for Customization', 'hariko' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>Hariko</strong> <?php echo esc_html__( 'is a WordPress block editor theme designed with a minimalist aesthetic and built for customization.', 'hariko' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'It includes ten font-size presets from xs (12px) to 6-xl (57px), with a default medium size of 16px, making it an ideal starter theme.', 'hariko' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'User-Friendly and Versatile Templates', 'hariko' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'Hariko provides a 980px content width and an 1180px wide layout, along with standard, full-width, and sidebar layouts for pages and posts.', 'hariko' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Usage', 'hariko' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'For general styling, you can use the style settings (typography, colors, layout, blocks) in the site editor. For more specific customization, you can add or modify templates as needed.', 'hariko' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Posts', 'hariko' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:template-part {"slug":"posts","area":"uncategorized"} /-->
