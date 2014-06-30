<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
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
				<div class="line-form cf">
				  <div class="fild-form">
					  <label>NAME</label>
						<input type="text" class="txt">
					</div>
					
					<div class="fild-form">
					  <label>phone</label>
						<input type="text" class="txt">
					</div>
				</div>
				
				<div class="line-form cf">
				  <div class="fild-form big">
					  <label>Address</label>
						<input type="text" class="txt">
					</div>
					
					<div class="submit">
						<input type="submit" value="SEND" class="submit">
					</div>
				</div>
			</div>
		</aside>
		
		<div class="copyright-box cf">
		  <div class="left">
			  <p>&copy; 2014 Vues on 48th All Rights Reserved. The developer reserves the right to make changes without notice.</p>
			</div>
			
			<div class="right">
			  <p>Site by <a href="http://www.inkhaus.com/" target="_blank">INKHAUS</a></p>
			</div>
		</div>
  </footer>
<!-- end footer -->
</div>

	<?php wp_footer(); ?>
</body>
</html>