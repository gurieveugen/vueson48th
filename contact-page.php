<?php
/**
 * Template Name: Contact Page
 */
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
get_header(); ?>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<article class="contact-post">
  <header class="tit-page">
	  <h1><?php the_title(); ?></h1>
	</header>

	<div class="entry">
	  <?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>

</article>
<?php endwhile; ?>
<?php get_footer(); ?>