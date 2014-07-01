<?php
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
?>
		<a href="#top" class="top-link">top</a>
	</section>
	<!-- end content -->
<!-- footer -->  
  <footer id="footer" class="cf">
    <aside class="sidebar-footer cf">
		  <div class="widget-footer-pic">
			  <p><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_01.png" alt=" "></a></p>
			</div>

			<div class="widget-footer-form">
			  <h3>Receive Our Free Brochure</h3>
			  	<?php echo do_shortcode('[contact-form-7 id="71" title="Receive Our Free Brochure"]'); ?>				
			</div>
		</aside>

		<div class="copyright-box cf">
		  <div class="left">
			  <p><?php echo $theme_settings_copyright_text; ?></p>
			</div>

			<div class="right">
				<p>Site by <a href="<?php echo $theme_settings_site_by_url; ?>" target="_blank"><?php echo $theme_settings_site_by; ?></a></p>			  	
			</div>
		</div>
  </footer>
  <!-- end footer -->
</div>
	<?php wp_footer(); ?>
	</body>
</html>