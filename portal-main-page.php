<?php
/**
 * Template Name: Partner Portal - Main Template
 *
 * @package Shoreditch
 */

get_header(); ?>

<?php if ( is_user_logged_in() ) { ?>

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'hero' );

	endwhile; // End of the loop.
	?>
	
<?php get_template_part( 'portal', 'nav' ); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>
		</div>
	</div>
</div>

<?php } else { ?>

	<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>

<?php } ?>

<?php
get_sidebar( 'footer' );
get_footer();
