<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Monstroid2
 */

$is_author_block_enabled = monstroid2_theme()->customizer->get_value( 'single_author_block' );

?>

<div class="single-header-9">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 col-lg-push-2">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title h2-style">', '</h1>' ); ?>
					<div class="entry-meta">
						<?php
							if ( ! $is_author_block_enabled ) {
								monstroid2_posted_by();
							}
							monstroid2_posted_in( array(
								'prefix'  => __( 'In', 'monstroid2' ),
							) );
							monstroid2_posted_on( array(
								'prefix'  => __( 'Posted', 'monstroid2' ),
							) );
							monstroid2_post_comments( array(
								'postfix' => __( 'Comment(s)', 'monstroid2' ),
							) );
						?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
			</div>
		</div>
	</div>
	<?php monstroid2_post_thumbnail( 'monstroid2-thumb-xl', array( 'link' => false ) ); ?>
</div>

