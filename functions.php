<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;
/**
 * Adds support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';
/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'left', __( 'Main Menu Left', 'twentythirteen' ) );
	register_nav_menu( 'right', __( 'Main Menu Right', 'twentythirteen' ) );
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );
/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );
	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );
	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();
		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';
		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}
	return $fonts_url;
}
/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );
	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );
	// Add Open Sans and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );
/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );
/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );
if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
	global $post;
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">
			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;
if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';
	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	if ( $echo )
		echo $date;
	return $date;
}
endif;
if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );
		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}
	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;
/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';
	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';
	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );
/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;
	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );
/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

//     __  _____  __   __________  ____  ______
//    /  |/  /\ \/ /  / ____/ __ \/ __ \/ ____/
//   / /|_/ /  \  /  / /   / / / / / / / __/   
//  / /  / /   / /  / /___/ /_/ / /_/ / /___   
// /_/  /_/   /_/   \____/\____/_____/_____/   

// =========================================================
// CONSTANTS
// =========================================================
define('TDU', get_bloginfo('template_url'));
// =========================================================
// REQUIRE
// =========================================================
require_once 'includes/helper.php';                                            
require_once 'includes/widget_latestnews.php';
// =========================================================
// USE
// =========================================================
use Factory\Page;
use Factory\PostType;
use Factory\MetaBox;
use Factory\Taxonomy;
use Factory\LoremPosts;
use Factory\Controls\ControlsCollection;
use Factory\Controls\Text;
use Factory\Controls\Textarea;
use Factory\Controls\Select;
use Factory\Controls\Checkbox;
use Factory\Controls\Table;
use Factory\Controls\Image;

// =========================================================
// HOOKS
// =========================================================
add_action('widgets_init', 'widgetsInit');
add_action('wp_enqueue_scripts', 'scriptsMethod');
add_image_size('gallery-photo', 220, 206, true);
add_image_size('life-image', 216, 132, true);
add_image_size('design-article-image', 275, 220, true);
add_image_size('gallery-header-image', 861, 9999, true);
add_image_size('slider-front-page', 861, 331, true);
add_image_size('slider-design-page', 418, 279, true);
add_image_size('location-img', 509, 357, true);
add_filter('image_size_names_choose', 'imageSizeNamesChose');
add_shortcode('design_slider' , 'displayDesignSlider');
add_shortcode('home_slider' , 'displayHomeSlider');
add_shortcode('design_article' , 'displayDesignArticle');
add_action('wpcf7_before_send_mail', 'cf7');

// =========================================================
// THEME SETTINGS [PAGE]
// =========================================================
$theme_settings = new Page('Theme settings', 
	array(
		'icon_code' => 'f085'
	)
);

$section_home_page_ctrls = new ControlsCollection(
	array(	
		new Textarea('Title'),
		new Textarea('Sub title'),
		new Text('Facebook link'),
		new Text('Phone'),
		new Text('Register for a priority reservation now!', array('name' => 'priority_reservation')),	
		new Text('Site by'),
		new Text('Site by url'),		
		new Textarea('Copyright text'),
		new Checkbox('Enable slide show', array('name' => 'home_slideshow')),
		new Text('Slide show speed (seconds)', array('name' => 'home_slideshow_speed')),
		new Text('Slides count', array('name' => 'home_slides_count')),
		new Text('Slider title')
	)
);

$section_gallery_page_ctrls = new ControlsCollection(
	array(
		new Text('Photos per page')
	)
);

$section_design_page_ctrls = new ControlsCollection(
	array(
		new Checkbox('Enable slide show', array('name' => 'design_slideshow')),
		new Text('Slide show speed (seconds)', array('name' => 'design_slideshow_speed')),
		new Text('Slides count', array('name' => 'design_slides_count')),
		new Textarea('slogan')
	)
);

$section_location_page_ctrls = new ControlsCollection(
	array(
		new Checkbox('Enable slide show', array('name' => 'location_slideshow')),
		new Text('Slide show speed (seconds)', array('name' => 'location_slideshow_speed'))
	)
);

$section_contact_page_ctrls = new ControlsCollection(
	array(
		new Textarea('Address'),
		new Text('Phone', array('name' => 'contact_phone')),
		new Text('Fax'),
		new Text('Email', array('input_type' => 'email')),
		new Text('Map shortcode')
	)
);

$theme_settings->addControls('Home page', $section_home_page_ctrls);
$theme_settings->addControls('Gallery page', $section_gallery_page_ctrls);
$theme_settings->addControls('Design page', $section_design_page_ctrls);
$theme_settings->addControls('Contact page', $section_contact_page_ctrls);
$theme_settings->addControls('Location page', $section_location_page_ctrls);
$theme_settings->initPage();

$GLOBALS['theme_settings'] = $theme_settings;

// =========================================================
// ADDITIONAL INFO [MATA BOX]
// =========================================================
$additional_options_ctrls = new ControlsCollection(
	array(
		new Textarea('Text on the picture', array('name' => 'text_pic'))
	)
);
$additional_options = new MetaBox('page', 'Additional options', $additional_options_ctrls);

// =========================================================
// FLOOR PLAN [META BOX]
// =========================================================
// $floorplan_controls = new ControlsCollection(array(
// 	new Checkbox('Zoom'),
// 	new Checkbox('Print'),
// 	new Checkbox('Share'),
// 	new Image('Floor plan')
// 	));
// $floorplan_metabox = new MetaBox('post', 'Floor Plan options', $floorplan_controls);
// =========================================================
// PHOTO POST TYPE
// =========================================================
$photo = new PostType('photo', array('icon_code' => 'f083'));

// =========================================================
// DESIGN POST TYPE
// =========================================================
$photo = new PostType('design', 
	array(
		'label'     => 'Design articles', 
		'icon_code' => 'f043',
		'supports'  => array('title', 'editor', 'thumbnail', 'excerpt')
	)
);
// =========================================================
// DESIGN METABOX
// =========================================================
$additional_design_ctrls = new ControlsCollection(
	array(
		new Select('PicturePosition', array('name' => 'pic_position', 'options' => array('Top', 'Bottom')))
	)
);
$additional_design = new MetaBox('design', 'Additional options', $additional_design_ctrls);
// =========================================================
// SLIDE POST TYPE
// =========================================================
$slide = new PostType('slide', array('label' => 'Slider images', 'icon_code' => 'f03e'));
// =========================================================
// SLIDER TAXONOMY
// =========================================================
$slider = new Taxonomy('slide', 'Slider');
// =========================================================
// LIFEIMAGE POST TYPE
// =========================================================
$lifeimage = new PostType('lifeimage', array('label' => 'Life images', 'icon_code' => 'f118'));
// =========================================================
// LIFESTYLE TAXONOMY
// =========================================================
$lifestyle = new Taxonomy('lifeimage', 'Lifestyle');
// =========================================================
// GALLERTY TAXONOMY
// =========================================================
$gallery_controls = new ControlsCollection(array(
	new Textarea('Text on the picture', array('name' => 'text_pic')),
	new Image('Header image'),
	new Text('Order')
));
$gallery = new Taxonomy('photo', 'Gallery', array('label' => 'Galleries'), $gallery_controls);
$GLOBALS['gallery_tax'] = $gallery;
// =========================================================
// LOCATION
// =========================================================
$loc_group_controls = new ControlsCollection(
	array(
		new Textarea('Address'),
		new Image('Icon')
	)
);

$location           = new PostType('location', array('icon_code' => 'f041'));
$loc_group          = new Taxonomy('location', 'Location Group', array('label' => 'Location groups'), $loc_group_controls);
$GLOBALS['loc_group'] = $loc_group;

$location_options_ctrls = new ControlsCollection(
	array(
		new Image('Large image')
	)
);
$additional_options_location = new MetaBox('location', 'Additional options', $location_options_ctrls);


function scriptsMethod() 
{
	wp_enqueue_style('fancybox', TDU.'/fancybox/source/jquery.fancybox.css?v=2.1.5');
	wp_enqueue_style('fancybox-buttons', TDU.'/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5');
	wp_enqueue_style('fancybox-thumbs', TDU.'/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7');
	wp_enqueue_style('flexslider', TDU.'/css/flexslider.css');

	wp_enqueue_script('main', TDU.'/js/main.js', array('jquery'));
	wp_enqueue_script('flexslider', TDU.'/js/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('flexslider', TDU.'/js/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('mousewheel', TDU.'/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'));
	wp_enqueue_script('fancybox', TDU.'/fancybox/source/jquery.fancybox.pack.js?v=2.1.5', array('jquery'));
	wp_enqueue_script('fancybox-buttons', TDU.'/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5', array('jquery'));
	wp_enqueue_script('fancybox-media', TDU.'/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6', array('jquery'));
	wp_enqueue_script('fancybox-thumbs', TDU.'/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7', array('jquery'));
	wp_enqueue_script('facebook', 'http://connect.facebook.net/en_US/all.js', array('jquery'));
	wp_enqueue_script('styler', TDU.'/js/jquery.formstyler.js', array('jquery'));
	wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp');	
	wp_enqueue_script('google-map-utility', 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js');	

	wp_localize_script('main', 'defaults', array($GLOBALS['theme_settings']->getAll()));
}

/**
 * Add image sizes to "Upload photo modal"
 * @param  array $image_sizes --- image sizes array
 * @return array              --- image sizes array with my custom sizes
 */
function imageSizeNamesChose($image_sizes) 
{
	$image_sizes['gallery-header-image'] = __('Gallery header image');
	return $image_sizes;
}

/**
 * Register widgets
 */
function widgetsInit()
{	
	register_widget("LatestNews");
}


/**
 * Fill array 
 * @param  array $fields --- field list
 * @param  array $arr    --- array with values
 * @return array         --- filled array
 */
function fillArray($fields, $arr)
{
	if(!$fields) return null;
	foreach ($fields as &$field) 
	{
		$out[$field] = isset($arr[$field]) ? $arr[$field] : '';
	}
	return $out;
}

/**
 * Get gallery terms
 * @return string --- html code
 */
function getGalleryTerms()
{
	$taxonomies = array('gallery');
	$li   = array();
	$args = array(
	    'orderby'       => 'name', 
	    'order'         => 'ASC',
	    'hide_empty'    => true, 
	    'exclude'       => array(), 
	    'exclude_tree'  => array(), 
	    'include'       => array(),
	    'number'        => '', 
	    'fields'        => 'all', 
	    'slug'          => '', 
	    'parent'         => '',
	    'hierarchical'  => true, 
	    'child_of'      => 0, 
	    'get'           => '', 
	    'name__like'    => '',
	    'pad_counts'    => false, 
	    'offset'        => '', 
	    'search'        => '', 
	    'cache_domain'  => 'core'); 
	$terms = $GLOBALS['gallery_tax']->getTerms();
	$out   = '';
	$qo    = get_queried_object();

	if($terms)
	{
		$out.= '<ul class="cat-gallery">';		
		foreach ($terms as $term) 
		{
			if($qo->term_id == $term->term_id)
			{
				$li[$term->meta['photo_order']] = sprintf(
					'<li><span>%1$s (%2$s)</span></li>', 					
					$term->name, 
					$term->count);	
			}
			else
			{
				$li[$term->meta['photo_order']] = sprintf(
					'<li><a href="%1$s">%2$s (%3$s)</a></li>', 
					get_term_link($term, $term->taxonomy), 
					$term->name, 
					$term->count);
			}
						
		}
		ksort($li);
		$out.= implode(' ', $li);
		$out.= '</ul>';
	}
	return $out;
}

/**
 * Get photos to gallery page
 * @return string --- html code
 */
function getPhotos($page = 1)
{		
	$options = $GLOBALS['theme_settings']->getAll();
	extract($options);
	$qo = get_queried_object();
	
	$page--;
	$offset = intval($theme_settings_photos_per_page)*$page;
	$args = array(
		'posts_per_page'   => $theme_settings_photos_per_page,
		'offset'           => $offset,		
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'photo',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'tax_query'        => array(
			array(
				'taxonomy' => 'gallery',
				'field'    => 'id',
				'terms'    => array($qo->term_id)
			)
		)
	);
	$photos = get_posts($args);
	$out    = '';
	if($photos)
	{
		$out.= '<ul class="list-images cf">';
		foreach ($photos as $photo) 
		{
			if(has_post_thumbnail($photo->ID))
			{
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($photo->ID), 'full');
				$url   = $thumb['0'];
				$out  .= sprintf(
					'<li><figure><a href="%s" class="fancybox" data-fancybox-group="group">%s</a></figure></li>',
					$url,
					get_the_post_thumbnail($photo->ID, 'gallery-photo'));				
			} 
			
		}
		$out.= '</ul>';
	}
	return $out;
}

function getGalleryNavs($page = 1)
{
	$options = $GLOBALS['theme_settings']->getAll();
	extract($options);

	$qo = get_queried_object();
	$pages = ceil($qo->count/$theme_settings_photos_per_page);
	if($pages <= 1) return '';
	$out = '';

	if($pages)
	{
		$out.= '<nav class="pagenav-gallery cf">';
		// =========================================================
		// PREV
		// =========================================================
		if($page > 1)
		{
			$out.= sprintf('<a href="%s" class="prev">prev</a>', get_pagenum_link($page-1));
		}
		else
		{
			$out.= '<span class="prev">prev</span>';
		}

		for ($i=1; $i <= $pages; $i++) 
		{ 
			// =========================================================
			// NUMBERS
			// =========================================================
			if($page == $i)
			{
				$out.= sprintf('<span>%02d</span>', $i);
			}
			else
			{
				$out.= sprintf('<a href="%s">%02d</a>', get_pagenum_link($i), $i);
			}
			
			
		}
		// =========================================================
		// NEXT
		// =========================================================
		if($page < $pages)
		{
			$out.= sprintf('<a class="next" href="%s">next</a>', get_pagenum_link($page+1));
		}
		else
		{
			$out.= '<span class="next">next</span>';
		}
		$out.= '</nav>';
	}
	return $out;
}

/**
 * Get Lifestyle terms
 * @return string --- html code
 */
function getLifestyleTerms()
{
	$taxonomies = array('lifestyle');

	$args = array(
	    'orderby'       => 'name', 
	    'order'         => 'ASC',
	    'hide_empty'    => true, 
	    'exclude'       => array(), 
	    'exclude_tree'  => array(), 
	    'include'       => array(),
	    'number'        => '', 
	    'fields'        => 'all', 
	    'slug'          => '', 
	    'parent'         => '',
	    'hierarchical'  => true, 
	    'child_of'      => 0, 
	    'get'           => '', 
	    'name__like'    => '',
	    'pad_counts'    => false, 
	    'offset'        => '', 
	    'search'        => '', 
	    'cache_domain'  => 'core'); 
	$terms = get_terms($taxonomies, $args);	

	if($terms)
	{		
		foreach ($terms as $term) 
		{
			$args = array(
				'posts_per_page'   => -1,
				'offset'           => 0,
                'taxonomy'         => 'lifestyle',
                'term'             => $term->slug,
				/*'lifestyle'        => $term->term_id,*/
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'include'          => '',
				'exclude'          => '',
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'lifeimage',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true);
			$lifeimages = get_posts($args);            	
			?>
			<article class="lifestyle-post cf">
				<header class="tit-lifestyle"><h2><?php echo $term->name; ?></h2></header>

				<div class="entry">
					<p><?php echo $term->description; ?></p>
				</div>

				<footer class="slide-lifestyle cf">
					<aside class="flexslider-carousel" id="<?php echo $term->slug.$term->term_id; ?>">
						<ul class="slides">
						<?php
						foreach ($lifeimages as $li) 
						{
							if(has_post_thumbnail($li->ID))
							{
								$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($li->ID), 'full');
								$url   = $thumb['0'];
								?>
								<li>
									<figure>
										<?php echo get_the_post_thumbnail($li->ID, 'life-image'); ?>
										<a href="<?php echo $url; ?>" data-fancybox-group="<?php echo $term->slug.$term->term_id; ?>" class="more fancybox"><span>more</span></a>			
									</figure>
								</li>
								<?php	
							}
						}
						?>
						</ul>
					</aside>

					<nav class="flexslider-controls">
						<a href="prev" class="prev" data-id="<?php echo $term->slug.$term->term_id; ?>">prev</a>
						<a href="next" class="next" data-id="<?php echo $term->slug.$term->term_id; ?>">next</a>
					</nav>
				</footer>
			</article>
			<?php			
		}		
	}	
}

/**
 * Display design type slider [SHORTCODE]
 * @return string --- html code
 */
function displayDesignSlider($atts)
{
	$defaults = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'slider'           => 12,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'slide',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true);
	$args   = array_merge($defaults, $atts);
	$args['tax_query'] = array(    
		array(
			'taxonomy'         => 'slider',
			'field'            => 'id',
			'terms'            => $args['slider'],
			'include_children' => false)
		);
	unset($args['slider']);	
	$slides = get_posts($args);	
	$nav    = '';
	$index  = 0;
	if($slides)
	{
		ob_start();
		?>
		<div class="slider-design">
			<aside>
				<ul class="slides">
		<?php
		foreach ($slides as $slide) 
		{
			if(has_post_thumbnail($slide->ID))
			{	
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'full');
				$url   = $thumb['0'];			
				?>
				<li>
					<figure>
						<a href="<?php echo $url; ?>" class="fancybox">
							<?php echo get_the_post_thumbnail($slide->ID, 'slider-design-page'); ?>
						</a>
					</figure>
					<a href="<?php echo $url; ?>" class="fancybox zoom">zoom</a>
				</li>
				<?php
				$index++;
				$nav.= sprintf('<li> <a href="#">%s</a> </li>', $index);
			}
			
		}
		?>
				</ul>
			</aside>

			<nav class="slider-design-nav">
				<ol>
					<?php echo $nav; ?>
				</ol>
			</nav>
		</div>
		<?php
		$var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}
	return '';
}

/**
 * Display home type slider [SHORTCODE]
 * @return string --- html code
 */
function displayHomeSlider($atts)
{
	$content = '';
	$defaults = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'slider'           => 12,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'slide',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true);
	$args   = array_merge($defaults, $atts);
	$args['tax_query'] = array(    
		array(
			'taxonomy'         => 'slider',
			'field'            => 'id',
			'terms'            => $args['slider'],
			'include_children' => false)
		);
	unset($args['slider']);	
	$slides = get_posts($args);	
	$nav    = '';
	$index  = 0;
	if($slides)
	{
		ob_start();
		?>
		<div class="slider-home cf">
			<aside>
				<ul class="slides">
		<?php
		foreach ($slides as $slide) 
		{
			if(has_post_thumbnail($slide->ID))
			{	
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'full');
				$url   = $thumb['0'];			
				?>
				<li data-title="<?php echo $slide->post_title; ?>">
					<figure>
						<a href="<?php echo $url; ?>" class="fancybox">
							<?php echo get_the_post_thumbnail($slide->ID, 'slider-front-page'); ?>
						</a>
					</figure>					
				</li>
				<?php
				$index++;
				$nav.= sprintf('<li> <a href="#">%s</a> </li>', $index);
				$content = $content == '' ? $slide->post_title : $content;
			}
			
		}
		?>
				</ul>
			</aside>
			
			<div class="bottom-slider">
				<nav class="slider-design-nav">
					<ol>
						<?php echo $nav; ?>
					</ol>
				</nav>

				<p>
					<?php echo $content; ?>
				</p>
			</div>
		</div>
		<?php
		$var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}
	return '';
}

/**
 * Display home type slider [SHORTCODE]
 * @return string --- html code
 */
function displayDesignArticle($atts, $content)
{	
	if(!is_array($atts)) $atts = array();
	$defaults = array(
		'posts_per_page'   => 3,
		'offset'           => 0,		
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'design',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true);
	$args     = array_merge($defaults, $atts);
	$articles = get_posts($args);
	if(!$articles) return '';
	ob_start();
	?>
	<div class="image-module-design">
	<ul>
	<?
	foreach ($articles as $article) 
	{
		$position = get_post_meta($article->ID, 'design_pic_position', true); 
		if(strtolower($position) == 'top')
		{
			?>
			<li>
				<article>
					<figure>
						<?php if(has_post_thumbnail($article->ID)) echo get_the_post_thumbnail($article->ID, 'design-article-image'); ?>						
					</figure>
					<div class="entry">
						<header>
							<h2>
								<a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a>
							</h2>
						</header>
						<p>
							<?php echo $article->post_excerpt; ?>
						</p>
					</div>
				</article>
			</li>
			<?php	
		}
		else
		{
			?>
			<li class="bottom-img">
				<article>
					<div class="entry">
						<header>
							<h2>
								<a href="<?php echo get_permalink($article->ID); ?>"><?php echo $article->post_title; ?></a>
							</h2>
						</header>
						<p>
							<?php echo $article->post_excerpt; ?>
						</p>
					</div>
					<figure>
						<?php if(has_post_thumbnail($article->ID)) echo get_the_post_thumbnail($article->ID, 'design-article-image'); ?>
					</figure>				
				</article>
			</li>
			<?php
		}
		
	}
	?>
	</ul>
	</div>
	<?php
	$var = ob_get_contents();
    ob_end_clean();
    return $var;
}

function cf7( $cf7 )
{
	if($cf7->id == 71)
	{		
		$email = $_POST['email-field'];
		wp_mail($email, 'Download our Brochure', 'http://vueson48th.com/wp-content/uploads/2014/07/brochure_sm.pdf');
	}	
}