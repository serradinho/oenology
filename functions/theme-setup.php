<?php

add_action( 'after_setup_theme', 'oenology_setup', 10 );

if ( ! function_exists( 'oenology_setup' ) ):

	function oenology_setup() {

		/*****************************************************************************************
		* Add theme support for various WordPress features
		*******************************************************************************************/

		// Automatically add RSS feed links to document header (since WP 2.9.0)
		add_theme_support('automatic-feed-links');

		// Post Thumbnails (since WP 2.9.0)
		add_theme_support('post-thumbnails'); 

		// Custom Backgrounds (since WP 3.0.0)
		add_custom_background();

		// Custom Header Image (since WP 3.0.0)
		add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );

		// Custom WYSIWIG Editor Style (since WP 3.0.0)
		add_editor_style();

		// Post Formats (since WP 3.1.0)
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		

		/*****************************************************************************************
		* Define content_width, to keep images from overflowing.
		*******************************************************************************************/

		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 640;
		}
		

		/*****************************************************************************************
		* Define Custom Image sizes (since WordPress 2.9)
		*******************************************************************************************/
		
		set_post_thumbnail_size( 150, 150, true ); // default dimensions for "thumbnail" image size
		add_image_size( 'post-title-thumbnail', 55, 55, true ); // Post Title thumbnail size (55px x 55px)
		add_image_size( 'attachment-nav-thumbnail', 45, 45, true ); // Gallery Navigation image thumbnail size (55px x 55px)


		/*****************************************************************************************
		* Define Custom Headers (since WordPress 3.0)
		*******************************************************************************************/

		// Hex color value, without leading octothorpe (#)
		define( 'HEADER_TEXTCOLOR', '000000' ); 
		// Default header image to use
		define('HEADER_IMAGE', get_stylesheet_directory_uri() . '/images/headers/pxwhite.jpg'); 
		// Width to which WordPress will crop uploaded header images
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'oenology_header_image_width', 1000 ) ); 
		// Height to which WordPress will crop uploaded header images
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'oenology_header_image_height', 198 ) ); 
		// Allow text inside the header image.
		define( 'NO_HEADER_TEXT', false ); 

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See oenology_admin_header_style(), below.
	
		// Default custom headers packaged with the theme. 
		// %s is a placeholder for the theme template directory URI.
		// Auto-magically registers the headers included with TwentyTen if it is installed
		if ( file_exists( get_theme_root() . '/twentyten/style.css' ) ) {
			register_default_headers( array(
				'berries' => array(
					'url' => '%s/../twentyten/images/headers/berries.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/berries-thumbnail.jpg',
					'description' => 'Berries'
				),
				'cherryblossom' => array(
					'url' => '%s/../twentyten/images/headers/cherryblossoms.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/cherryblossoms-thumbnail.jpg',
					'description' => 'Cherry Blossoms'
				),
				'concave' => array(
					'url' => '%s/../twentyten/images/headers/concave.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/concave-thumbnail.jpg',
					'description' => 'Concave'
				),
				'fern' => array(
					'url' => '%s/../twentyten/images/headers/fern.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/fern-thumbnail.jpg',
					'description' => 'Fern'
				),
				'forestfloor' => array(
					'url' => '%s/../twentyten/images/headers/forestfloor.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/forestfloor-thumbnail.jpg',
					'description' => 'Forest Floor'
				),
				'inkwell' => array(
					'url' => '%s/../twentyten/images/headers/inkwell.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/inkwell-thumbnail.jpg',
					'description' => 'Inkwell', 'oenology'
				),
				'path' => array(
					'url' => '%s/../twentyten/images/headers/path.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/path-thumbnail.jpg',
					'description' => 'Path'
				),
				'sunset' => array(
					'url' => '%s/../twentyten/images/headers/sunset.jpg',
					'thumbnail_url' => '%s/../twentyten/images/headers/sunset-thumbnail.jpg',
					'description' => 'Sunset'
				)
			) );
		}
	
		if ( ! function_exists( 'oenology_header_style' ) ) :

			function oenology_header_style() {
			?>
			<style type="text/css">
			/* Sets header image as background for div#header */
			#header {
				background:url('<?php header_image(); ?>') no-repeat left top;
				overflow: hidden;
			}
			<?php 
				$oenology_options = get_option('theme_oenology_options');
				if ( 'above' == $oenology_options['header_nav_menu_position'] ) { ?>
					.navmenu {
						background-color: transparent;
					}
					.navmenu li {
						padding-top: 1px;
					}
				<?php }
			?>
			</style>
			<?php
			}

		endif;

		if ( ! function_exists( 'oenology_admin_header_style' ) ) :

			function oenology_admin_header_style() {
			?>
			<style type="text/css">
					#headimg {
						width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
						height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
					}
			</style>
			<?php
			}
	
		endif;

		/*****************************************************************************************
		* Define Nav Menus (since WordPress 3.0)
		*******************************************************************************************/

		// This theme uses wp_nav_menu() in two locations: main site navigation, and left-colum page navigation.
		register_nav_menus( array(
			'nav-header' => 'Header Navigation',
			'nav-sidebar' => 'Sidebar Navigation',
		) );

	
	} // function oenology_setup()

endif; // function_exists('oenology_setup')

/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:


***********************
oenology_setup()
----------------------------------
oenology_setup() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup() is used to define and setup all of the custom Theme features, including
Theme support for optional WordPress features. This function is designed to be over-ridden
by a Child Theme, if necessary.

oenology_setup() hooks into the after_setup_theme action hook


=============================================================================
*/
?>