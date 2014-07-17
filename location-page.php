<?php
/**
 * Template Name: Location Page
 */
$options = $GLOBALS['theme_settings']->
getAll();
extract($options);

$google_map = new GoogleMap($GLOBALS['loc_group']);
$markers   = $google_map->getMarkers();

get_header(); ?>
<script>
	<?php echo $markers; ?>
</script>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<article class="location-post cf">
	<header class="tit-page">
		<h1>
			<?php the_title(); ?></h1>
	</header>

	<div class="entry">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' =>
		'
		<div class="page-links">
			<span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>
			', 'after' => '
		</div>
		', 'link_before' => '
		<span>', 'link_after' => '</span>
		' ) ); ?>
	</div>

</article>
<div class="bottom-location cf">
	<h3>Discover The Vues on 48th</h3>
	<div class="map-location">
		<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/uploade/map.gif" alt=" "> -->
		<div id="map-canvas" style="width: 292px; height: 477px;"></div>
	</div>
	<?php echo $google_map->getSliders(); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>