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
 * Template Name: Lifestyle Page
 */
get_header(); ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article class="page-post cf">
		  <header class="tit-page">
			  <h1><?php the_title(); ?></h1>
			</header>
			
			<div class="entry">
			  <?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>
			
			<footer>
			  <p>Congue gothica formas nostrud decima hendrerit. Seacula diam decima modo notare legere. Accumsan etiam dolor etiam ut velit. Legere nam eu lectorum formas modo. Parum in elit feugait vel praesent. Littera parum qui formas eros seacula. Magna formas qui ad claritatem eros. </p>
			</footer>
		</article>
		
		<article class="lifestyle-post cf">
		  <header class="tit-lifestyle">
			  <h2>Coastal Living</h2>
			</header>
			
			<div class="entry">
			  <p>Congue gothica formas nostrud decima hendrerit. Seacula diam decima modo notare legere. Accumsan etiam dolor etiam ut velit. Legere nam eu lectorum formas modo. Parum in elit feugait vel praesent. Littera parum qui formas eros seacula. Magna formas qui ad claritatem eros. </p>
			</div>
			
			<footer class="slide-lifestyle cf">
			  <aside>
				  <ul>
					  <li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_06.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
					</ul>
				</aside>
				
				<nav>
				  <a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</nav>
			</footer>
		</article>
		
		<article class="lifestyle-post cf">
		  <header class="tit-lifestyle">
			  <h2>shopping</h2>
			</header>
			
			<div class="entry">
			  <p>Lorem littera per ii assum dolor. Quod non illum illum quam hendrerit. Esse elit cum possim diam te. Consectetuer ex per in dolore clari. Quinta gothica saepius possim odio aliquip. Lobortis decima ut iusto demonstraverunt dolore. Doming ea vel placerat facit est.</p>
				<p>Insitam claram qui assum dolore amet. Feugait nam nunc iusto vel dignissim. Sit claritas eu soluta placerat littera. Anteposuerit nulla etiam diam aliquam erat. Qui facer et dolore quod vel. Claram demonstraverunt accumsan consectetuer augue habent. Blandit parum quam aliquip nunc lorem. </p>
			</div>
			
			<footer class="slide-lifestyle cf">
			  <aside>
				  <ul>
					  <li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_07.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_08.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_09.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
					</ul>
				</aside>
				
				<nav>
				  <a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</nav>
			</footer>
		</article>
		
		<article class="lifestyle-post cf">
		  <header class="tit-lifestyle">
			  <h2>attractions</h2>
			</header>
			
			<div class="entry">
			  <p>Et quis etiam legere ad erat. Accumsan habent ex eros lorem nonummy. Demonstraverunt typi possim commodo nunc anteposuerit. Saepius demonstraverunt dynamicus et assum et. Sequitur volutpat videntur dolore sollemnes minim. Modo usus delenit veniam qui sed. Liber ut putamus diam modo lorem.</p>
				<p>Nobis sollemnes dolor lobortis me ut. Eu tempor vulputate suscipit ex aliquip. Erat placerat etiam vel ii nisl. Humanitatis saepius claritatem lius iusto nunc. Mirum eum wisi magna in anteposuerit. Cum videntur per eleifend dolor qui. Delenit vulputate nihil nonummy feugait quinta. </p>
			</div>
			
			<footer class="slide-lifestyle cf">
			  <aside>
				  <ul>
					  <li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_10.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_11.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_12.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
					</ul>
				</aside>
				
				<nav>
				  <a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</nav>
			</footer>
		</article>
		
		<article class="lifestyle-post cf">
		  <header class="tit-lifestyle">
			  <h2>Dinning</h2>
			</header>
			
			<div class="entry">
			  <p>Eorum adipiscing mutationem possim claritatem exerci. Praesent doming aliquip cum ii liber. Futurum id in consuetudium sed odio. Quarta nonummy mirum habent gothica nunc. Formas non claritas illum claritas erat. Consequat mutationem demonstraverunt per commodo facit. Per videntur magna odio hendrerit claritatem.</p>
				<p>Minim accumsan sed dignissim claram tempor. Eorum formas dolore anteposuerit et enim. Lorem ii sollemnes seacula exerci sequitur. Consuetudium facilisis demonstraverunt seacula placerat habent. Claritatem vero parum wisi tempor nonummy. Zzril lectores anteposuerit nihil usus humanitatis. Et lobortis te accumsan quis ii. </p>
			</div>
			
			<footer class="slide-lifestyle cf">
			  <aside>
				  <ul>
					  <li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_13.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_14.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_15.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
						<li><figure><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_05.jpg" alt=" "><a href="#" class="more"><span>more</span></a></figure></li>
					</ul>
				</aside>
				
				<nav>
				  <a href="#" class="prev">prev</a>
					<a href="#" class="next">next</a>
				</nav>
			</footer>
		</article>
		<?php endwhile; ?>

<?php get_footer(); ?>