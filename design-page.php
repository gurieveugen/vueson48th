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

		<div class="image-module-design">
		  <ul>
				<li>
					<article>
						<figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_02.jpg" alt=" "></figure>
						<div class="entry">
							<header>
								<h2><a href="#">exterior features</a></h2>
							</header>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
						</div>
					</article>
				</li>

				<li class="bottom-img">
					<article>
						<div class="entry">
							<header>
								<h2><a href="#">interior finishes</a></h2>
							</header>
							<p>Duis aute irure dolor in sit ametesd reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat Est qui exerci cum nulla feugait.</p>
						</div>
						<figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_03.jpg" alt=" "></figure>
					</article>
			  </li>

				<li>	
					<article>
						<figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_04.jpg" alt=" "></figure>
						<div class="entry">
							<header>
								<h2><a href="#">your vue</a></h2>
							</header>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.</p>
						</div>
					</article>
				</li>
			</ul>
		</div>
		<?php endwhile; ?>
		<?php get_footer(); ?>