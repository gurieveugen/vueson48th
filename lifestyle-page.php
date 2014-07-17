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
			Congue gothica formas nostrud decima hendrerit. Seacula diam decima modo notare legere. Accumsan etiam dolor etiam ut velit. Legere nam eu lectorum formas modo. Parum in elit feugait vel praesent. Littera parum qui formas eros seacula. Magna formas qui ad claritatem eros.
		</p>
	</footer>
</article>
<?php getLifestyleTerms(); ?>
<?php endwhile; ?>
<?php get_footer(); ?>