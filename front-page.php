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

get_header(); ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<section class="mid-section cf">
		  <header>
			  <h2>Modern Elegance Meets Marsh-Front Living.<br>Redefining Coastal Living.</h2>
				<h6>Mozingo & Wallace ARCHITECTS</h6>
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
			  <div class="widget-news-home cf">
				  <h3>Latest News</h3>
					<ul>
					  <li>
						  <h2><a href="#">Construction Progress Aerial Photos: June</a></h2>
							<div class="entry">
							  <p>Usile din sticla au devenit cea mai atractiva alternativa la usile clasice, gratie designului si inovatiei lor tehnice.</p>
							  <a href="#" class="more">more</a>							
							</div>
						</li>
						
						<li>
						  <h2><a href="#">Get move-in ready now with an online lease application</a></h2>
							<div class="entry">
							  <p>Usile din sticla au devenit cea mai atractiva alternativa la usile clasice, gratie designului si inovatiei lor tehnice.</p>
							  <a href="#" class="more">more</a>							
							</div>
						</li>
					</ul>
				</div>
			</aside>
		</div>
		<?php endwhile; ?>
<?php get_footer(); ?>