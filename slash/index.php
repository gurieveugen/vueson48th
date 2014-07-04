<?php 
  ob_start();
  session_start();
  $_SESSION['n1'] = rand(1, 10);
  $_SESSION['n2'] = rand(1, 10);
  $_SESSION['expect'] = $_SESSION['n1'] + $_SESSION['n2'];
  global $md_buzzcomi_init;
  $location_folder = $md_buzzcomi_init->location_folder;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Index</title>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $location_folder;?>/template/js/html5.js"></script>
<![endif]-->
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $location_folder;?>/template/style.css" />
<!--[if IE]><link rel="stylesheet" href="<?php echo $location_folder;?>/template/css/ie.css" type="text/css" media="screen" /><![endif]-->
<script charset="utf-8" type="text/javascript" src="<?php echo $location_folder;?>/template/js/css_browser_selector.js"></script>
<link rel="icon" href="<?php echo $md_buzzcomi_init->_settings['md-favicon']?>" />  
 
  <link rel="stylesheet" type="text/css" href="<?php echo $location_folder; ?>/template/css/grid.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $location_folder; ?>/template/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $location_folder;?>/template/js/supersized/css/supersized.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo $location_folder;?>/template/js/supersized/theme/supersized.shutter.css" type="text/css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans|Lato:400,300,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="<?php echo $location_folder;?>/template/css/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $location_folder;?>/template/css/responsive.css" />
  <style type="text/css">
  

  <?php if(isset($md_buzzcomi_init->_settings['md-logo']) &&  !empty($md_buzzcomi_init->_settings['md-logo']) ) : 
        $filename = $md_buzzcomi_init->_settings['md-logo'];
        $fileData = getimagesize("$filename");
        list($width, $height) = $fileData;
    ?>
      .md-logo h1 {
      background-image: url("<?php echo $md_buzzcomi_init->_settings['md-logo']?>");
    }
    .md-logo a {
      width: <?php echo ($width) . "px"?>;
      height: <?php echo ($height) . "px"?>;
    }
  <?php endif; ?>
  <?php if(isset($md_buzzcomi_init->_settings['md-retina-logo']) && !empty($md_buzzcomi_init->_settings['md-retina-logo'])) : 
      $filename = $md_buzzcomi_init->_settings['md-retina-logo'];
      $fileData = getimagesize("$filename");
      list($width, $height) = $fileData;
  ?>
    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
    .md-logo h1 {
      background-image: url("<?php echo $md_buzzcomi_init->_settings['md-retina-logo']?>");
      background-size: <?php echo ($width/2) . "px " . ($height/2) . "px" ?>;
      }
    }
  <?php endif; ?>
  <?php if( isset($md_buzzcomi_init->_settings['md-color-picker']) && !empty($md_buzzcomi_init->_settings['md-color-picker']) ) :  ?>
    a:hover,
    .md-footer .md-social-group a:hover [class^="icon-"] {
     color: <?php echo $md_buzzcomi_init->_settings['md-color-picker'] ?>;
    }
    .md-logo,
    .md-block-bottom {
     border-color: <?php echo $md_buzzcomi_init->_settings['md-color-picker'] ?>;
    }
  <?php endif; ?>

  <?php if( ($md_buzzcomi_init->_settings['md-enable-footer-region']) != 'enable-footer-region') : ?>
    .md-block-bottom {border: none;}
  <?php endif; ?>
    </style>
    <!--[if IE 7]>
      <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!--[if IE 8]>
      <link rel="stylesheet" type="text/css" href="css/ie8.css">
    <![endif]-->
    <!--[if lt IE 9]>
    
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
    <script type="text/javascript">var ajaxurl = "<?php echo get_option('siteurl') . '/wp-admin/admin-ajax.php'?>" </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?php if($md_buzzcomi_init->_settings['md-enable-countdown'] == 'enable-countdown') : ?>
    <script src="<?php echo $location_folder . '/template/js/jquery.lwtCountdown-1.0.js'?>" type="text/javascript"></script>
  <?php endif; ?>
  <script src="<?php echo $location_folder . '/template/js/misc.js'?>" type="text/javascript"></script>
    <script src="<?php echo $location_folder . '/template/js/jquery.form.js'?>" type="text/javascript"></script>
    <script src="<?php echo $location_folder . '/template/js/jquery.validate.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo $location_folder . '/template/js/jquery.cycle.all.js' ?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo $location_folder;?>/template/js/jquery.easing.min.js"></script>
  <script type="text/javascript" src="<?php echo $location_folder;?>/template/js/supersized/js/supersized.3.2.7.min.js"></script>
  <script type="text/javascript" src="<?php echo $location_folder;?>/template/js/supersized/theme/supersized.shutter.min.js"></script>
  <script src="<?php echo $location_folder . '/template/js/script.js' ?>" type="text/javascript"></script>
  <script type="text/javascript">
jQuery(function($){
        
        $.supersized({
        
          // Functionality
          slideshow               :   1,      // Slideshow on/off
          autoplay        : 1,      // Slideshow starts playing automatically
          start_slide             :   1,      // Start slide (0 is random)
          stop_loop       : 0,      // Pauses slideshow on last slide
          random          :   0,      // Randomize slide order (Ignores start slide)
          slide_interval          :   <?php print $md_buzzcomi_init->_settings["md-slide-transitions-timeout"];?>,    // Length between transitions
          transition              :   <?php print $md_buzzcomi_init->_settings["md-style-slideshow"];?>,      // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
          transition_speed    : 800,    // Speed of transition
          new_window        : 1,      // Image links open in new window/tab
          pause_hover             :   0,      // Pause slideshow on hover
          keyboard_nav            :   1,      // Keyboard navigation on/off
          performance       : 1,      // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
          image_protect     : 1,      // Disables image dragging and right click with Javascript
                                 
          //Size & Position              
          min_width           :   0,      // Min width allowed (in pixels)
          min_height            :   0,      // Min height allowed (in pixels)
          vertical_center         :   1,      // Vertically center background
          horizontal_center       :   1,      // Horizontally center background
          fit_always        : 0,      // Image will never exceed browser width or height (Ignores min. dimensions)
          fit_portrait          :   0,      // Portrait images will not exceed browser height
          fit_landscape     :   0,      // Landscape images will not exceed browser width
                               
          // Components             
          slide_links       : false,  // Individual links for each slide (Options: false, 'num', 'name', 'blank')
          thumb_links       : 0,      // Individual thumb links for each slide
          thumbnail_navigation    :   0,      // Thumbnail navigation
          slides          :   [     // Slideshow Images
                  <?php 
                  $getSlides = $md_buzzcomi_init->_settings['md-slide-images'];
                  $exSlides = explode(',', $getSlides);
                  //$numberImages = count($exSlides);
                  //foreach($exSlides as $slide) :
                  for ($i = 0; $i < count($exSlides); $i++):
                    if ($i == count($exSlides) - 1):
                  ?>
                    {image : '<?php echo wp_get_attachment_url($exSlides[$i])?>', title : ''}
                  <?php else: ?>
                    {image : '<?php echo wp_get_attachment_url($exSlides[$i])?>', title : ''},
                  <?php endif;?>
                  <?php endfor; ?>
                ],
                        
          // Theme Options         
          progress_bar      : 0,      // Timer for each slide             
          mouse_scrub       : 0
          
        });
        });
  </script>
</head>

<body>
<div class="center-splash">
  <header id="header-splash" class="cf">
    <h1 class="logo"><a href="/">vueson48th</a></h1>
    
    <h2 class="subtit-header"><?php echo $md_buzzcomi_init->_settings['md-slogan']?></h2>
  </header>
  
  <section id="content-section-splash" class="cf">
    <div id="myCarousel" class="carousel slide">
      <!-- Carousel items -->
      <!-- <div class="carousel-inner" id="carousel-inner">
        <div class="active item">
          <img src="<?php echo $location_folder; ?>/template/images/uploads/img_01.jpg" alt=" ">
          <div class="carousel-caption">
            <p>Located along the marsh across from Barefoot Landing in North Myrtle Beach, SC, lies a boutique community of 14 exceptional residences where location and quality bring a unique sense of style. </p>
          </div>
        </div>
        <div class="active item">
          <img src="<?php echo $location_folder; ?>/template/images/uploads/img_02.jpg" alt=" ">
          <div class="carousel-caption">
            <p>Located along the marsh across from Barefoot Landing in North Myrtle Beach, SC, lies a boutique community of 14 exceptional residences where location and quality bring a unique sense of style.</p>
          </div>
        </div>
      </div> -->
      <!-- Carousel nav -->
      <div class="nav-carousel">
        <a class="carousel-control left" href="#" onclick="api.prevSlide();" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#" onclick="api.nextSlide();" data-slide="next">&rsaquo;</a>
      </div>
      <div class="carousel-caption">
        <p>Located along the marsh across from Barefoot Landing in North Myrtle Beach, SC, lies a boutique community of 14 exceptional residences where location and quality bring a unique sense of style.</p>
      </div>
    </div>
    
    <div class="entry-splash cf">
      <header>
        <h1><?php echo $md_buzzcomi_init->_settings['md-header-countdown']?></h1>
      </header>
      
      <div class="md-block-bottom">
  
      <div class="md-btn-group wrap860" id="md-btn-group">      
        <div class="container_12 clearfix">
          
          <?php
            $buttons=array("md-enable-notify","md-enable-contact","md-enable-follow");
            $dem=0;
            foreach($buttons as $b){
              if(!isset($md_buzzcomi_init->_settings[$b]) || $md_buzzcomi_init->_settings[$b]!=1)
                $dem+=2;
            }
          ?>
          <div class="grid_<?php echo $dem;?>">&nbsp;</div>
          <?php if(isset($md_buzzcomi_init->_settings['md-enable-notify'])&&$md_buzzcomi_init->_settings['md-enable-notify']==1):?>
            <a href="#notify" class="grid_4 md-button notify"><?php $sButtonNo = $md_buzzcomi_init->_settings['md-button-notify'];if(isset($sButtonNo) && !empty($sButtonNo)) : echo $sButtonNo; else :  _e('Notify Me', self::LANG); endif; ?></a>
          <?php endif?>
          <?php if(isset($md_buzzcomi_init->_settings['md-enable-contact'])&&$md_buzzcomi_init->_settings['md-enable-contact']==1):?>
            <a href="#contact-us" class="grid_4 md-button contact-us"><?php  $sButtonCo = $md_buzzcomi_init->_settings['md-button-contactform'];if(isset($sButtonCo) && !empty($sButtonCo) ): echo $sButtonCo; else :_e('Contact Us', self::LANG) ; endif;  ?></a>
          <?php endif?>
          <?php if(isset($md_buzzcomi_init->_settings['md-enable-follow'])&&$md_buzzcomi_init->_settings['md-enable-follow']==1):?>
            <a href="#follow" class="grid_4 md-button follow"><?php  $sButtonFo = $md_buzzcomi_init->_settings['md-button-follow-us'];if(isset($sButtonFo) && !empty($sButtonFo)) : echo $sButtonFo; else : _e('Follow Us', self::LANG); endif;?></a>
          <?php endif?>
        </div>
      </div><!-- /BUTTON GROUP -->
      
      <div class="md-dialog contact" id="contact-us">
        <div class="wrap860">
          <div class="container_12">
              <form id="contact-form" class="clearfix" action="" method="post">

                      <h2 class="md-tilte-box"><?php echo $md_buzzcomi_init->_settings['md-header-contactform'] ?></h2>
                      <div class="md-desc-box"><?php echo $md_buzzcomi_init->_settings['md-description-contactform'] ?></div>
                      <div class="md-form clearfix" id="contact-content">
                          <div class="grid_6">
                              <input type="text" name="name" placeholder="<?php _e('Your name', self::LANG) ?>">
                              <input type="text" name="email" placeholder="<?php _e('Your email', self::LANG) ?>">
                          </div>
                          <div class="grid_6">
                              <textarea placeholder="<?php _e('Message', self::LANG) ?>" name="message"></textarea>
                              <input type='text'  name='capcha' placeholder="<?php echo __('The result of', self::LANG) . " " . $_SESSION['n1'] . '+' . $_SESSION['n2'] ?> " />
                              <input type="hidden" name="numo" value="<?php echo $_SESSION['n1']?>" />
                              <input type="hidden" name="numt" value="<?php echo $_SESSION['n2']?>" />
                              <button type="submit" class="md-button omega" id="submit-contact">
                                  <span class="md-btn-text"><?php $ssButtonCo = $md_buzzcomi_init->_settings['md-sbutton-contactform'];if(isset($ssButtonCo) && !empty($ssButtonCo)) : echo $ssButtonCo; else :  _e('Submit', self::LANG); endif; ?></span>
                              </button>
                          </div>
                      </div>
              </form>
              <a href="#" class="btn-close"></a>
          </div>
        </div>
      </div><!-- /CONTACT US -->
      
      <div class="md-dialog follow" id="follow">
        <div class="wrap860">
          <div class="container_12">
                  <h2 class="md-tilte-box"><?php echo $md_buzzcomi_init->_settings['md-header-follow-us'] ?></h2>
                  <div class="md-desc-box"><?php echo $md_buzzcomi_init->_settings['md-description-follow-us']?></div>
                  <div class="md-follow clearfix">
                    <?php $socials = array('icon-facebook-sign'=>'md-Facebook','icon-twitter-sign' => 'md-Twitter', 'icon-google-plus-sign' => 'md-Google+', 'icon-linkedin-sign' => 'md-Linkedin', 'icon-tumblr-sign' => 'md-Tumblr', 'icon-pinterest-sign' => 'md-Pinterest', 'icon-flickr' => 'md-Flickr', 'icon-dribbble' => 'md-Dribbble', 'icon-youtube-sign' => 'md-Youtube');
                        foreach ( $socials as $cSocial => $kSocial ) :
                          $kSocial = $kSocial .  "-follow"; 
                        if( $md_buzzcomi_init->_settings[$kSocial] != '' ) :  
                    ?>
                      <a href="<?php echo $md_buzzcomi_init->_settings[$kSocial]?>"><i class="<?php echo $cSocial; ?>"></i></a>
                    <?php 
                          endif;
                        endforeach;
                    ?>
                  </div>
              <a href="#" class="btn-close"></a>
          </div>
        </div>
      </div><!-- /FOLLOW -->
      
      <div class="md-dialog notify" id="notify">
        <div class="wrap860">
          <div class="container_16">
                  <h2 class="md-tilte-box"><?php echo $md_buzzcomi_init->_settings['md-header-notify']?></h2>
                  <div class="md-desc-box"><?php echo $md_buzzcomi_init->_settings['md-description-notify']?></div>
                  <div class="md-form clearfix" id="notify-content">
                      <!-- Use this HTML for MailChimp subscribe -->
                      <!--
                      <form action="MAICHIMPLINK" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                      
                      <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                      </div>
                        <div class=""><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                      </form>
                    -->
                      <?php 
                        // get action from select of admin 
            
                        $mailchimp = $md_buzzcomi_init->_settings['md-save-email-to'];

                        if(isset($md_buzzcomi_init->_settings['md-save-email-to']))
                          if($md_buzzcomi_init->_settings['md-save-email-to']=='MailChimp')
                            $sSaveMailTo = (isset($md_buzzcomi_init->_settings['md-mailchimp'])) ? $md_buzzcomi_init->_settings['md-mailchimp'] : '';
                          else
                            $sSaveMailTo = $md_buzzcomi_init->_settings['md-save-email-to'];
                      ?>
                      <form action="<?php echo $sSaveMailTo ?>" method="post" id="<?php if($mailchimp == 'MailChimp') echo "mc-embedded-subscribe-form"; else {echo "md-subscribe-form";} ?>" name="mc-embedded-subscribe-form" class="validate" <?php if($mailchimp == 'MailChimp') : ?> target="_blank" <?php endif;?> novalidate>
                          <div class="insert omega">
                              <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Insert your email here" required>
                          </div>
                          <div class="">
                              <input type="submit" value="<?php $ssButtonNo = $md_buzzcomi_init->_settings['md-sbutton-notify'];if(isset($ssButtonNo) && !empty($ssButtonNo)) : echo $ssButtonNo; else :  _e('Subscribe', self::LANG); endif; ?>" name="subscribe" id="md-subscribe" class="md-button notify-submit">
                          </div>
                      </form>
                    
                    
                  </div>
              <a href="#" class="btn-close"></a>
          </div>
        </div>
      </div><!-- /NOTIFY -->
      
    </div><!-- /BLOCK BOTTOM -->
      <!-- <nav class="links-splash cf">
        <ul>
          <li><a href="#">Notify me</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Follow us</a></li>
        </ul>
      </nav> -->


    </div>
  </section>
  
  <footer id="footer-splash" class="cf">
    <div class="left">
      <p>504 48th Avenue South<br>North Myrtle Beach, South Carolina 29582</p>
      <p>Tel.  843-267-7279<br><a href="mailto:info@vueson48th.com">info@vueson48th.com</a></p>
      <p style="font-size:11px;"><em>The developer reserves the right to make changes without notice.</em></p>
    </div>
    
    <div class="right">
      <ul class="share-footer">
      <?php
      if( $md_buzzcomi_init->_settings['md-Facebook-follow'] != '' )
      {
      ?>
      <li class="facebook"><a href="<?php echo $md_buzzcomi_init->_settings['md-Facebook-follow']?>">facebook</a></li>
      <?php
      }
      if( $md_buzzcomi_init->_settings['md-Twitter-follow'] != '' )
      {
      ?>
      <li class="tweet"><a href="<?php echo $md_buzzcomi_init->_settings['md-Twitter-follow']?>">tweet</a></li>
      <?php
      }
      ?>
        
        
      </ul>
      <p>made by <a href="http://www.inkhaus.com/" target="_blank">INKHAUS</a></p>

    </div>

  </footer>
</div>
</body>
</html>
<?php exit(); ?>
