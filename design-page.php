<?php
/**
 * Template Name: Design Page
 */
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
get_header(); ?>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<article class="design-post">
  <header>
	  <h1><?php the_title(); ?></h1>
	</header>

	<div class="entry">
	  <?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>

	<?php echo do_shortcode('[design_slider posts_per_page="'.$theme_settings_design_slides_count.'" slider="13"][/design_slider]' ); ?>
	<footer><p><strong>The Architect:</strong>  Mozingo & Wallace have a long standing commitment to the design of high-quality architecture</p></footer>
</article>
<?php echo do_shortcode('[design_article]'); ?>		
<?php endwhile; ?>
<?php get_footer(); ?>