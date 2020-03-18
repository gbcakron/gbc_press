<?php
/**
 * gbc_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gbc_theme
 */

if ( ! function_exists( 'gbc_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gbc_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on gbc_theme, use a find and replace
		 * to change 'gbc_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gbc_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gbc_theme' ),
		) );

    function atg_menu_classes($classes, $item, $args) {
      if($args->theme_location == 'menu-1') {
        $classes[] = 'mdl-navigation__link';
      }
      return $classes;
    }
    add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gbc_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gbc_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gbc_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'gbc_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'gbc_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gbc_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gbc_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gbc_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gbc_theme_widgets_init' );
function add_material_design_light() {
  wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css?family=Raleway:300' );

  wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
  wp_enqueue_style( 'material-design-light-css', 'https://code.getmdl.io/1.3.0/material.grey-indigo.min.css' );
  wp_enqueue_script( 'material-design-light-js', 'https://code.getmdl.io/1.3.0/material.min.js' );

}
add_action( 'wp_enqueue_scripts', 'add_material_design_light' );

/**
 * Enqueue scripts and styles.
 */
function gbc_theme_scripts() {
	wp_enqueue_style( 'gbc_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gbc_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'gbc_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gbc_theme_scripts' );


function add_parallax() {
  wp_enqueue_style( 'parallax-style', get_template_directory_uri() . '/css/parallax.css' );
}
add_action( 'wp_enqueue_scripts', 'add_parallax' );

// function add_simplegrid() {
//   wp_enqueue_style( 'simplegrid-style', get_template_directory_uri() . '/css/simple-grid.min.css' );
// }
// add_action( 'wp_enqueue_scripts', 'add_simplegrid' );

function enqueue_load_fa() {
  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );





//*****  custom logo link */


function custom_get_custom_logo( $blog_id = 0 ) {
  $html          = '';
  $switched_blog = false;

  if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
      switch_to_blog( $blog_id );
      $switched_blog = true;
  }

  $custom_logo_id = get_theme_mod( 'custom_logo' );

  // We have a logo. Logo is go.
  if ( $custom_logo_id ) {
      $custom_logo_attr = array(
          'class' => 'custom-logo',
      );

      /*
       * If the logo alt attribute is empty, get the site title and explicitly
       * pass it to the attributes used by wp_get_attachment_image().
       */
      $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
      if ( empty( $image_alt ) ) {
          $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
      }

      /*
       * If the alt attribute is not empty, there's no need to explicitly pass
       * it because wp_get_attachment_image() already adds the alt attribute.
       */
      $html = sprintf(
          '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
          esc_url( home_url( '/' ) ),
          wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr )
      );
  } elseif ( is_customize_preview() ) {
      // If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
      $html = sprintf(
          '<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
          esc_url( home_url( '/' ) )
      );
  }

  if ( $switched_blog ) {
      restore_current_blog();
  }

  /**
   * Filters the custom logo output.
   *
   * @since 4.5.0
   * @since 4.6.0 Added the `$blog_id` parameter.
   *
   * @param string $html    Custom logo HTML output.
   * @param int    $blog_id ID of the blog to get the custom logo for.
   */
  return apply_filters( 'get_custom_logo', $html, $blog_id );
}

//***  end custom logo link */



//*** custom shortcodes ***
// [short_event_list events="5"]
function short_event_list_func( $atts ){
  $a = shortcode_atts( array(
    'events' => 3
  ), $atts );
  $short_event_list = '';
  $events = tribe_get_events(array('eventDisplay' => 'upcoming', 'posts_per_page' => $a['events']));
  if (!empty($events)) {
      $short_event_list .= $title ? $before_title . $title . $after_title : '';
      $short_event_list .= '<div class="upcoming-event-container">';
      foreach ($events as $event) {



          // $start_date = strtotime(tribe_get_start_date($event->ID));
          $start_date = strtotime(tribe_get_start_date( $event->ID, true, tribe_get_date_format( true ) ));

          $start_date_day = date('Y-m-d', $start_date);
          // $end_date = strtotime(tribe_get_end_date($event->ID));
          $end_date = strtotime(tribe_get_end_date( $event->ID, true, tribe_get_date_format( true ) ));

          $end_date_day = date('Y-m-d', $end_date);
          $all_day = tribe_event_is_all_day($event->ID);
          $time_format = get_option( 'time_format' );
          if ($all_day) {
              $date_format = date('F jS', $start_date) . '<span>&bullet;</span> <em>' . __('All day', 'espresso') . '</em>';
          } else {
              if ($end_date_day) {
                  if ($start_date_day == $end_date_day) {
                      $date_format = date('F jS', $start_date) . '<span>, </span> <em>' .  tribe_get_start_date( $event, false, $time_format ) . ' &ndash; ' . tribe_get_end_date( $event, false, $time_format ) . '</em>';
                  } else {
                      $date_format = date('F jS', $start_date) . ' <em>@ ' . tribe_get_start_date( $event, false, $time_format ) . '<br />' . __('to', 'espresso') . '</em> ' . date('F jS', $end_date) . ' <em>@' . tribe_get_end_date( $event, false, $time_format ) . '</em>';
                  }
              }
          }
          $short_event_list .= '<article class="upcoming-event-block clearfix">';
          $short_event_list .= tribe_event_featured_image( $event->ID, 'medium' );
          $short_event_list .= '<div class="tribe-events-event-description">';
          $short_event_list .= '<h3>'.apply_filters('the_title', $event->post_title).'</h3>';
          $short_event_list .= "<strong>".$date_format."</strong>";

          $short_event_list .= wpautop( $event->post_content );

          $short_event_list .= '</a></div></article>';
      }
      $short_event_list .= '</div>';

  }
  wp_reset_query();
  return $short_event_list;
}
add_shortcode( 'short_event_list', 'short_event_list_func' );

// [featured_video media="5"]
function featured_video( $atts ){
  // noop, handled in content-page.php
  return "";
}
add_shortcode( 'featured_video', 'featured_video' );

function truncate($string, $length)
{
    if (strlen($string) > $length) {
        $string = substr($string, 0, $length) . '...';
    }

    return $string;
}

//*** custom shortcodes ***

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
