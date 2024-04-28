<?php
/**
 * Title: front-page
 * Slug: hariko/front-page
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header","area":"header"} /-->

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hariko_hero.jpg","dimRatio":0,"style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover" style="margin-top:0"><span aria-hidden="true"
        class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img
        class="wp-block-cover__image-background" alt=""
        src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hariko_hero.jpg"
        data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:site-title {"isLink":false,"fontSize":"xxxxxxl"} /-->

        <!-- wp:site-tagline /-->

        <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m"}}}} -->
        <div class="wp-block-buttons"
            style="margin-top:var(--wp--preset--spacing--m);margin-bottom:var(--wp--preset--spacing--m)">
            <!-- wp:button {"backgroundColor":"base-2","textColor":"tertiary","style":{"elements":{"link":{"color":{"text":"var:preset|color|tertiary"}}}},"className":"is-style-fill"} -->
            <div class="wp-block-button is-style-fill"><a
                    class="wp-block-button__link has-tertiary-color has-base-2-background-color has-text-color has-background has-link-color wp-element-button"
                    href="https://hariko.bytedesign.net/?p=257">Get started</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
    <!-- wp:group {"backgroundColor":"base-2"} -->
    <div class="wp-block-group has-base-2-background-color has-background"><!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:heading -->
            <h2 class="wp-block-heading">Hariko: A Minimalist WordPress Block Editor Theme for Customization</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p><strong>Hariko</strong> is a WordPress block editor theme designed with a minimalist aesthetic and built
                for customization.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p>It features a base font size of 16px, adjustable from xs (12px) to xxxxxxxl (57px) in 10 increments,
                making it an ideal starter theme.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading -->
            <h2 class="wp-block-heading">User-Friendly and Versatile Templates</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Hariko comes with preset content widths of up to 980px and full-width layouts of up to 1180px. It also
                includes templates for two-column layouts with or without sidebars.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading -->
            <h2 class="wp-block-heading">Usage</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>For general styling, you can use the style settings (typography, colors, layout, blocks) in the <a
                    href="https://wordpress.com/ja/support/using-styles/">site editor</a>. For more specific
                customization, you can add or modify templates as needed. See the <a
                    href="https://hariko.bytedesign.net/?p=288">Customization Guide</a>.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading -->
            <h2 class="wp-block-heading">Posts</h2>
            <!-- /wp:heading -->

            <!-- wp:template-part {"slug":"posts","area":"uncategorized"} /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->