<?php get_header('gallery'); ?>
<div class="gallery-page cf">
	<aside class="sidebar-gallery">
		<header>
			<h1>Gallery</h1>
		</header>
		<?php echo getGalleryTerms(); ?>		
	</aside>

  	<div class="gallery-post">
  		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>  		
	  	<?php echo getPhotos($paged); ?>	    
		<?php echo getGalleryNavs($paged); ?>		
  	</div>
</div>
<?php get_footer(); ?>