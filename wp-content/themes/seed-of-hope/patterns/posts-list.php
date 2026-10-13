<?php
/**
 * Title: Posts list
 * Slug: seed-of-hope/posts-list
 * Inserter: no
 * Description: List of posts for the news page, archives and search results.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:query {"queryId":10,"query":{"inherit":true,"perPage":10},"layout":{"type":"default"}} -->
<div class="wp-block-query">
<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<!-- wp:post-title {"level":2,"isLink":true,"fontSize":"x-large"} /-->

<!-- wp:post-date /-->

<!-- wp:post-excerpt {"excerptLength":35} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Nothing has been published here yet.', 'seed-of-hope' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
