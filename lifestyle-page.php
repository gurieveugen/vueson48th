<?php
/**
 * Template Name: Lifestyle Page
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<article class="page-post cf">
	<header class="tit-page">
		<h1>
			<?php the_title(); ?></h1>
	</header>

	<div class="entry">
		<?php the_content(); ?>
		<?php wp_link_pages(array( 
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 
			'after'       => '</div>', 
			'link_before' => '<span>', 
			'link_after'  => '</span>')); ?>
	</div>

	<footer>
		<p>
			Admire the southern marsh view from your kitchen window before you step outside to smell the salty, ocean air from your private porch. Breathe in your new coastal lifestyle full of scenic views, morning runs on the beach, and quiet evenings in your comfortable home.
		</p>
	</footer>
</article>
<?php getLifestyleTerms(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>