<?php
/**
 * Title: Frequently asked questions
 * Slug: seed-of-hope/faq
 * Categories: seed-of-hope, text
 * Keywords: faq, questions, answers, accordion
 * Description: Accessible questions and answers that open with a click or the keyboard, no JavaScript needed.
 *
 * @package SeedOfHope
 */

$seed_of_hope_questions = array(
	__( 'Who can take part in the programmes?', 'seed-of-hope' ),
	__( 'Do I need to know how to read to join?', 'seed-of-hope' ),
	__( 'Is there a fee?', 'seed-of-hope' ),
	__( 'How do I sign up?', 'seed-of-hope' ),
	__( 'How can I volunteer?', 'seed-of-hope' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Frequently asked questions', 'seed-of-hope' ); ?></h2>
<!-- /wp:heading -->
<?php foreach ( $seed_of_hope_questions as $seed_of_hope_question ) : ?>

<!-- wp:details -->
<details class="wp-block-details"><summary><?php echo esc_html( $seed_of_hope_question ); ?></summary>
<!-- wp:paragraph -->
<p><?php echo esc_html( seed_of_hope_tbc() ); ?></p>
<!-- /wp:paragraph -->
</details>
<!-- /wp:details -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
