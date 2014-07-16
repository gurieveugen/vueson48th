<?php
/**
 * Template Name: Location Page
 */
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
get_header(); ?>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
		<article class="location-post cf">
			<header class="tit-page">
				<h1><?php the_title(); ?></h1>
			</header>
		
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>
		
		</article>

		<div class="bottom-location cf">
		  <h3>Discover The Vues on 48th</h3>
		  <div class="map-location"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/map.gif" alt=" "></div>
			
			<div class="slider-location">
			  <nav>
				  <a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</nav>
				
				<aside>
				  <div class="border-top">&nbsp;</div>
					<div class="border-left">&nbsp;</div>
					<div class="border-right">&nbsp;</div>
					<div class="border-bottom">&nbsp;</div>
				  <ul>
					  <li>
						  <figure>
							  <a href="#" class="zoom">zoom</a>
								<img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_location_01.jpg" alt=" ">
							</figure>
							<div class="txt">
							  <h2>North Beach Plantation</h2>
								<p>Located on a 7 1/2 acre "island" between the Atlantic Ocean and White Point Swash, and providing a magnificent oceanfront presence, The Towers at North Beach Plantation provides for a rising masterpiece that is sure to awe. </p>
							</div>
						</li>
					</ul>
				</aside>
			</div>
		</div>	
<?php endwhile; ?>
<?php get_footer(); ?>