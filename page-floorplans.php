<?php
/**
 * Template name: Floor Plans Page
 */
get_header(); ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="page-post cf">
		  <header class="tit-page">
			  <h1><?php the_title(); ?></h1>
			</header>
			<div class="entry">
			  <?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>
		</article><!-- #post -->
		<?php endwhile; ?>
		<?php get_footer(); ?>