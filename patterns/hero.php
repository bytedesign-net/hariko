<?php
/**
 * Title: hero
 * Slug: hariko/hero
 * Categories: banner
 * Description: A call-to-action banner whose heading, text and button label can be edited directly, without opening the block settings. The values are stored as pattern overrides, so they persist even when the theme or another plugin registers a pattern with the same slug.
 * Viewport Width: 1280
 * Block Types: core/cover
 *
 * The `hariko/hero` heading, text and button use pattern overrides with
 * Block Bindings (WordPress 6.9+): click the text in the editor and type,
 * the typed value is saved into the block's `metadata.bind` attribute via
 * the core/pattern-overrides source, so no post meta is created.
 */

// Fallbacks used when the pattern is previewed outside of an instance,
// e.g. in the pattern explorer sidebar of the editor.
$hariko_hero_title       = esc_html__( 'Build something people remember', 'hariko' );
$hariko_hero_description = esc_html__(
	'Hariko ships with fluid typography, nine color style variations and responsive block styles, so you can focus on the content.',
	'hariko'
);
$hariko_hero_button      = esc_html__( 'Get started', 'hariko' );
?>
<!-- wp:cover {"dimRatio":100,"backgroundColor":"primary","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|3-xl","bottom":"var:preset|spacing|3-xl","left":"var:preset|spacing|m","right":"var:preset|spacing|m"},"margin":{"top":"0"}}}} -->
<div class="wp-block-cover alignfull has-primary-background-color has-background" style="margin-top:0;padding-top:var(--wp--preset--spacing--3-xl);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--3-xl);padding-left:var(--wp--preset--spacing--m)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"level":1,"textAlign":"center","fontSize":"5-xl","textColor":"base-2","metadata":{"bindings":{"content":{"source":"core/pattern-overrides"}},"patternOverridesProps":{"heroTitle":{}}}} -->
		<h1 class="wp-block-heading has-text-align-center has-base-2-color has-text-color" style="font-size:var(--wp--preset--font-size--5-xl)"><?php echo $hariko_hero_title; // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"l","textColor":"base-2","metadata":{"bindings":{"content":{"source":"core/pattern-overrides"}},"patternOverridesProps":{"heroDescription":{}}}} -->
		<p class="has-text-align-center has-base-2-color has-text-color" style="font-size:var(--wp--preset--font-size--l)"><?php echo $hariko_hero_description; // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"base-2","textColor":"primary","metadata":{"bindings":{"text":{"source":"core/pattern-overrides"}},"patternOverridesProps":{"heroButton":{}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-base-2-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $hariko_hero_button; // phpcs:ignore WordPress.Security.EscapeOutput ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
</div>
<!-- /wp:cover -->
