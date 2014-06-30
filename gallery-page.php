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
			<aside class="sidebar-gallery">
				<header>
					<h1>Gallery</h1>
				</header>
				
				<ul class="cat-gallery">
				  <li><a href="#">Main</a> (24)</li>
				  <li><a href="#">Views (11)</a></li>
				  <li><a href="#">Construction (27)</a></li>
				</ul>
			</aside>
		
		  <div class="gallery-post">
		    <ul class="list-images cf">
				  <li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_16.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_17.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_18.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_19.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_20.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_21.jpg" alt=" "></a></figure></li>
				</ul>
				
				<nav class="pagenav-gallery cf">
				  <a href="#" class="prev">prev</a>
					<span>01</span>
					<a href="#">02</a>
					<a href="#">03</a>
					<a href="#">04</a>
					<a href="#" class="next">next</a>
				</nav>
		  </div>
		</div>
		<?php endwhile; ?>

<?php get_footer(); ?>