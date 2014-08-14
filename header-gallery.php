<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$options = $GLOBALS['theme_settings']->getAll();
extract($options);
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<!--[if IE]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
	<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
<div class="global-box" id="top">
<!-- header -->
  <header id="header" class="cf">
		<div class="left-header"><a href="<?php echo $theme_settings_priority_reservation; ?>">Register for a priority reservation now!</a></div>

		<h1 class="logo-header"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

		<div class="right-header">
		  <div class="contact">Now pre-selling! Contact at: <strong><?php echo $theme_settings_phone; ?></strong></div>
			<div class="share"><a href="<?php echo $theme_settings_facebook_link; ?>" target="_blank">facebook</a></div>
		</div>

		<nav class="main-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'left', 'container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'right', 'container' => false ) ); ?>
		</nav>
  </header>
  <!-- end header -->
<!-- content -->
  <section id="content-section" class="cf">  
  <?php if(is_home()){?>
    <div class="slider-home cf">
		  <aside>
			  <ul>
				  <li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/slide_01.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/slide_01.jpg" alt=" "></a></figure></li>
					<li><figure><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/uploade/slide_01.jpg" alt=" "></a></figure></li>
				</ul>
			</aside>

			<div class="bottom-slider">
			  <nav>
			    <ol>
				    <li class="active"><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
				  </ol>
				</nav>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
			</div>
		</div>
		<?php } else {?>
    <figure class="header-image cf">
		<?php		
		$qo   = get_queried_object();
		$term = $GLOBALS['gallery_tax']->getTerm($qo->term_id);		
		?>	
		<img src="<?php echo $term->meta['photo_header_image']; ?>" alt="<?php echo $term->name; ?>">
		<figcaption><p><?php echo $term->meta['photo_text_pic']; ?></p></figcaption>
	</figure>
	<?php } ?>
