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
/**
 * Template Name: Gallery Page
 */
get_header(); ?>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="gallery-page cf">
    <?php the_content(); ?>
	<?php //echo do_shortcode('[sk_grid_categories menu_background_col_selected="d2b46b" menu_text_col_selected="6e6053" categories_slug="portfolio-cat-1, portfolio-cat-2"]'); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>