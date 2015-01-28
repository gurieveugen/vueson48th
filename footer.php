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
			  <p><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/img_01.png" alt=" "></p>
			</div>

			<div class="widget-footer-form">
			  <h3>Receive Our Free Brochure</h3>
			  	<?php echo do_shortcode('[contact-form-7 id="71" title="Receive Our Free Brochure"]'); ?>				
			</div>
		</aside>

		<div class="copyright-box cf">
		  <div class="left">
		  		<span class="disclaimer">
		  			All renderings, maps, landscaping, elevations and plans are based on artist conceptions or computer generations for illustration purposes.  They are not to scale and are not guaranteed. The Developer/Builder reserves the right at its sole discretion to make changes or modifications to maps, plans, specifications, materials, features and colors without notice. Product type is subject to availability.
		  		</span>
			  <p><?php echo $theme_settings_copyright_text; ?></p>
			</div>

			<div class="right">
				<p>Site by <a href="<?php echo $theme_settings_site_by_url; ?>" target="_blank"><?php echo $theme_settings_site_by; ?></a></p>			  	
			</div>
		</div>
  </footer>
  <!-- end footer -->  
</div>
	<div id="inline" style="display:none;">
		<?php echo do_shortcode('[contact-form-7 id="1024" title="Register"]'); ?>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>