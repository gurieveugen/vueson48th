<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
get_header(); ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class="mid-section cf">
		  <header>
			  <h2><?php echo $theme_settings_title; ?></h2>
				<h6><?php echo $theme_settings_sub_title; ?></h6>
			</header>
		</section>

		<div class="home-page cf">
		  <article class="home-post">
			  <header>
				  <h2><?php the_title(); ?></h2>
				</header>
				<div class="entry">
				  <?php the_content(); ?>
				  <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>
			<aside class="sidebar-home">
				<?php get_sidebar('main'); ?>
			</aside> 
			<!-- /.sidevar-home -->
		</div>
		<?php endwhile; ?>
		<?php get_footer(); ?>