<?php
/**
 * Title: front-page
 * Slug: hariko/front-page
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header","area":"header"} /-->

<!-- wp:group {"tagName":"main","anchor":"content","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<main id="content" class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
    <!-- wp:cover {"dimRatio":100,"backgroundColor":"primary","align":"full","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-cover alignfull" style="margin-top:0"><span aria-hidden="true"
            class="wp-block-cover__background has-background-dim-100 has-background-dim has-primary-background-color"></span>
        <div class="wp-block-cover__inner-container"><!-- wp:site-title {"isLink":false,"fontSize":"xxxxxxl","textColor":"base-2"} /-->

            <!-- wp:site-tagline {"textColor":"base-2"} /-->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
            <div class="wp-block-buttons"
                style="margin-top:var(--wp--preset--spacing--m);margin-bottom:var(--wp--preset--spacing--m)">
                <!-- wp:button {"backgroundColor":"base-2","textColor":"tertiary","style":{"elements":{"link":{"color":{"text":"var:preset|color|tertiary"}}}},"className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a
                        class="wp-block-button__link has-tertiary-color has-base-2-background-color has-text-color has-background has-link-color wp-element-button"
                        href="#hariko-intro"><?php echo esc_html__( 'Get started', 'hariko' ); ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
    </div>
    <!-- /wp:cover -->

    <!-- wp:group {"backgroundColor":"base-2","anchor":"hariko-intro"} -->
    <div id="hariko-intro" class="wp-block-group has-base-2-background-color has-background"><!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:heading -->
            <h2 class="wp-block-heading"><?php echo esc_html__( 'Hariko: A Minimalist WordPress Block Theme for Customization', 'hariko' ); ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p><strong>Hariko</strong> <?php echo esc_html__( 'is a WordPress block editor theme designed with a minimalist aesthetic and built for customization.', 'hariko' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p><?php echo esc_html__( 'It includes ten font-size presets from xs (12px) to xxxxxxl (57px), with a default medium size of 16px, making it an ideal starter theme.', 'hariko' ); ?></p>
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
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
