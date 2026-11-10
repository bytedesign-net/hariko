#!/usr/bin/env bash
# Regenerate the accessibility-test fixtures described in
# docs/accessibility-test-matrix.md section 1.
#
# Idempotent: existing posts/pages (matched by slug) are UPDATED in place, so
# assigned templates, dates and comments are preserved; missing ones created.
#
# Run from the host repo root (wp-env bind-mounts this repo as the theme dir):
#   npx wp-env run cli bash -c 'bash wp-content/themes/hariko/scripts/wp-cli-fixtures.sh'
#
# NOTE: created posts get BASE_DATE as post_date (canonical URLs are
# /BASE_DATE/test-post-N/). Existing posts keep their stored date.
set -euo pipefail

BASE_DATE="${BASE_DATE:-2026-11-08}"

# --- Permalinks: date-based ---------------------------------------------------
wp rewrite structure '/%year%/%monthnum%/%day%/%postname%/'
wp rewrite flush --hard

# --- Category -----------------------------------------------------------------
CAT_ID=$(wp term list category --slug=news --field=term_id | head -n1)
if [ -z "${CAT_ID}" ]; then
  CAT_ID=$(wp term create category News --slug=news --porcelain)
fi
echo "News category ID: ${CAT_ID}"

# --- Content templates ----------------------------------------------------------
# "Hariko" appears in every body so `/?s=hariko` returns fixture results.
BODY=$(
  cat <<'EOF'
<!-- wp:paragraph -->
<p>Hariko fixture paragraph with a <a href="/about-2/">test link</a> for keyboard, focus and contrast checks.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Fixture heading</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>First list item</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Second list item</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
EOF
)

P1_EXTRA=$(
  cat <<'EOF'

<!-- wp:search {"label":"Search","buttonText":"Search"} /-->
EOF
)

MEDIA_ID=$(wp post list --post_type=attachment --name=hariko-hero --field=ID --post_status=any | head -n1)
if [ -z "${MEDIA_ID}" ]; then
  MEDIA_ID=$(wp media import wp-content/themes/hariko/assets/images/hariko_hero.jpg --file_name=hariko-hero --title=hariko-hero --porcelain)
fi
MEDIA_URL=$(wp post get "${MEDIA_ID}" --field=guid)

PRODUCTS_BODY=$(
  cat <<EOF
<!-- wp:heading -->
<h2 class="wp-block-heading">Widget-test page</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p>Hariko columns fixture, left column.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p>Hariko columns fixture, right column.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:media-text {"mediaId":${MEDIA_ID},"mediaType":"image"} -->
<div class="wp-block-media-text alignwide is-stacked-on-mobile"><figure class="wp-block-media-text__media"><img src="${MEDIA_URL}" alt="Hariko hero image" class="wp-image-${MEDIA_ID} size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph -->
<p>Hariko media-text fixture text.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/about-2/">Primary button</a></div>
<!-- /wp:button -->

<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/category/news/">Secondary button</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
EOF
)

# --- Helpers --------------------------------------------------------------------
upsert_post() {
  # upsert_post <post_type> <slug> <title> <post_content> [extra wp args...]
  local pt="$1" slug="$2" title="$3" content="$4"
  shift 4
  local id
  id=$(wp post list --post_type="${pt}" --name="${slug}" --field=ID --post_status=any | head -n1)
  if [ -n "${id}" ]; then
    wp post update "${id}" --post_title="${title}" --post_content="${content}" --post_status=publish "$@" >/dev/null
  else
    id=$(wp post create --post_type="${pt}" --post_title="${title}" --post_name="${slug}" \
      --post_content="${content}" --post_status=publish --post_date="${BASE_DATE} 22:20:49" "$@" --porcelain)
  fi
  printf '%s' "${id}"
}

# --- Posts: test-post-1 … test-post-12 (category: News) ---------------------------
for n in 1 2 3 4 5 6 7 8 9 10 11 12; do
  extra=""
  [ "${n}" = "1" ] && extra="${P1_EXTRA}"
  id=$(upsert_post post "test-post-${n}" "Test Post ${n}" "${BODY}${extra}" --post_category="${CAT_ID}")
  echo "test-post-${n}: ${id}"
  case "${n}" in
    1) # P1: sidebar template + open comments + 1 approved comment
      wp post update "${id}" --comment_status=open >/dev/null
      wp post meta update "${id}" _wp_page_template single-with-sidebar
      cid=$(wp comment list --post__in="${id}" --status=approve --number=1 --field=comment_ID | head -n1)
      if [ -z "${cid}" ]; then
        # flag is --comment_post_ID (not --post_id) or the comment ends up orphaned
        wp comment create --comment_post_ID="${id}" \
          --comment_author="Test Commenter" \
          --comment_content="Approved test comment for accessibility review." \
          --comment_approved=1 --porcelain
      fi
      ;;
    2) # P2: no-sidebar via full-width single template
      wp post meta update "${id}" _wp_page_template single-fullwidth
      ;;
    3) # P3: sticky
      wp option update sticky_posts "[${id}]" --format=json
      ;;
  esac
done

# --- Pages --------------------------------------------------------------------------
about=$(upsert_post page about-2 "About" "${BODY}")
psb=$(upsert_post page page-with-sidebar "Page With Sidebar" "${BODY}")
wp post meta update "${psb}" _wp_page_template page-with-sidebar
pfw=$(upsert_post page page-fullwidth "Page Fullwidth" "${BODY}")
wp post meta update "${pfw}" _wp_page_template page-fullwidth
products=$(upsert_post page products "Products" "${PRODUCTS_BODY}")
widget=$(upsert_post page widget "Widget" "${BODY}" --post_parent="${products}")

# --- Summary -------------------------------------------------------------------------
wp rewrite flush --hard
echo "--- fixture URLs ---"
for id in 1844 1845 1846 "${about}" "${psb}" "${pfw}" "${products}" "${widget}"; do
  wp post url "${id}" 2>/dev/null || true
done | sort -u
echo "Done. Fixtures ready."
