<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gbc_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/renner" type="text/css"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gbc_theme' ); ?></a>


  <!-- Always shows a header, even in smaller screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--no-desktop-drawer-button">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">
        <?php
          the_custom_logo();
          /*
          if ( is_front_page() && is_home() ) :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            <?php
          else :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            <?php
          endif;
          */
          $gbc_theme_description = get_bloginfo( 'description', 'display' );
          if ( $gbc_theme_description || is_customize_preview() ) :
            ?>
            <!-- <span class="headline">
              <?php echo $gbc_theme_description; /* WPCS: xss ok. */ ?>
            </span> -->
          <?php endif; ?>
        </span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>

        <?php
        // <nav id="site-navigation" class="mdl-navigation mdl-layout--large-screen-only main-navigation">
        //   <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><? php esc_html_e( 'Primary Menu', 'gbc_theme' ); ? ></button>
        //   < ?php
        //   wp_nav_menu( array(
        //     'theme_location' => 'menu-1',
        //     'menu_id'        => 'primary-menu',
        //   ) );
        //   ? >
        // </nav><!-- #site-navigation -->
        ?>
      </div>
    </header>
    <?php
    // <div class="mdl-layout__drawer">
    //   <span class="mdl-layout-title">
    //     <?php
    //       if ( is_front_page() && is_home() ) :
    //         ? >
    //         <a href="<?php echo esc_url( home_url( '/' ) ); ? >" rel="home"><?php bloginfo( 'name' ); ? ></a>
    //         <?php
    //       else :
    //         ? >
    //         <a href="<?php echo esc_url( home_url( '/' ) ); ? >" rel="home"><?php bloginfo( 'name' ); ? ></a>
    //     <?php endif; ? >
    //   </span>
    //   <nav class="mdl-navigation">
    //     <?php
    //         wp_nav_menu( array(
    //           'theme_location' => 'menu-1',
    //           'menu_id'        => 'primary-menu',
    //         ) );
    //         ? >
    //   </nav>
    // </div>
    ?>
    <nav id="site-navigation">
      <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gbc_theme' ); ?></button>
      <?php
      wp_nav_menu( array(
        'theme_location' => 'menu-1',
        'menu_id'        => 'primary-menu',
      ));
      ?>
    </nav>

    <main class="mdl-layout__content">
      <div class="page-content">


        <!-- Site content begins -->
