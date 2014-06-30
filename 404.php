<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

		<articlee id="post-<?php the_ID(); ?>" class="page-post cf">
		  <header class="tit-page">
			  <h1><?php _e( 'Not found', 'twentythirteen' ); ?></h1>
			</header>

			<div class="entry">
			  <h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentythirteen' ); ?></h2>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

				<?php get_search_form(); ?>
			</div>
		</article><!-- #post -->
		
<?php get_footer(); ?>