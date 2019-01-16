<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gbc_theme
 *
 * Template Name: Grid Page Template
 */

get_header();
?>
  <!-- this is a custom grid page -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

    endwhile; // End of the loop.

		?>

    <div class="mdl-grid">

    <?php
      $args = array(
        'child_of' => $post->ID,
        'parent' => $post->ID,
        'hierarchical' => 0,
        'sort_column' => 'menu_order',
        'sort_order' => 'asc'
      );
      $mypages = get_pages( $args );
      foreach( $mypages as $post )
      { ?>
        <div class="mdl-cell mdl-cell--4-col center">

          <a href="<?php echo get_permalink($post) ?>">
            <img alt="<?php echo $post->post_title; ?>" class="grid__image" src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post ), 'post-thumbnail' ) ?>">
          </a>
        </div>
      <?php
      }
    ?>
    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
