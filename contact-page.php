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
		<div class="info-contact cf">
			<div class="column">
				<h3>The Vues on 48th</h3>
				<p class="address">
					<?php echo $theme_settings_address; ?>
				</p>
				<p class="phone">Toll Free: <?php echo $theme_settings_contact_phone; ?></p>
				<p class="office">Office:  <?php echo $theme_settings_office_phone; ?></p>
				<!-- <p class="office">Office:  843-839-5200</p> -->
				<p class="fax">Fax: <?php echo $theme_settings_fax; ?></p>
				<p class="email">Email: <a href="mailto:<?php echo $theme_settings_email; ?>"><?php echo $theme_settings_email; ?></a></p>
			</div>
			<div class="column">
				<?php echo do_shortcode($theme_settings_map_shortcode); ?>
				<!-- <img src="<?php echo $theme_settings_map; ?>" alt="map" width="400" height="223" class="alignnone size-full wp-image-1013" /> -->
			</div>
		</div>
		<div class="form-contact cf">
			<h3>Send us a message</h3>
			<?php echo do_shortcode('[contact-form-7 id="1012" title="Contact Form"]'); ?>
		</div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>
	</article>
<?php endwhile; ?>
<?php get_footer(); ?>