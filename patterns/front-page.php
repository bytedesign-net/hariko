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
                    href="#content">Get started</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"tagName":"main","anchor":"content","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<main id="content" class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
    <!-- wp:group {"backgroundColor":"base-2"} -->
    <div class="wp-block-group has-base-2-background-color has-background"><!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:heading -->
            <h2 class="wp-block-heading">Hariko: A Minimalist WordPress Block Theme for Customization</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p><strong>Hariko</strong> is a WordPress block editor theme designed with a minimalist aesthetic and built
                for customization.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p>It includes ten font-size presets from xs (12px) to xxxxxxl (57px), with a default medium size of
                16px, making it an ideal starter theme.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading -->
            <h2 class="wp-block-heading">User-Friendly and Versatile Templates</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Hariko provides a 980px content width and an 1180px wide layout, along with standard, full-width, and
                sidebar layouts for pages and posts.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading -->
            <h2 class="wp-block-heading">Usage</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>For general styling, you can use the style settings (typography, colors, layout, blocks) in the site
                editor. For more specific customization, you can add or modify templates as needed.</p>
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
