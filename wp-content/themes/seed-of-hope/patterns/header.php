<?php
/**
 * Title: Header
 * Slug: seed-of-hope/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Site identity and responsive main navigation. WordPress adds the "Skip to content" link before the header.
 *
 * @package SeedOfHope
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"var:preset|color|surface","style":"solid","width":"3px"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="border-bottom-color:var(--wp--preset--color--surface);border-bottom-style:solid;border-bottom-width:3px;padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">
<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide">
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group">
<!-- wp:site-logo {"width":56,"shouldSyncIcon":false} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group">
<!-- wp:site-title {"level":0} /-->

<!-- wp:site-tagline /-->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"mobile","hasIcon":false,"overlayBackgroundColor":"base","overlayTextColor":"contrast","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} /-->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
