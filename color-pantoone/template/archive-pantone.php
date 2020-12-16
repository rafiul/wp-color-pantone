<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package presspen
 */

get_header();
?>
<main id="site-content" class="site-main container mt-6">
    <div id="primary" class="content-area">
				<div class="row">
                <?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
                <header>
                    <h1 class="page-title screen-reader-text entry-title mb-3"><?php single_post_title(); ?></h1>
                </header>
                <?php
						endif;

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							 ?>
							<div class="col-md-2 wcp-5">
								<div class="box-wrap">
									<a class="color-pantone" style="background-color:<?php echo $meta = get_post_meta( get_the_ID(), 'header_color', TRUE );?>" href="<?php echo esc_url(get_permalink());?>">
									
									</a>
									<strong class="color-code"><?php echo get_the_title();?></strong>
									<span class="color-code">
									<?php echo "<strong>Hexa:</strong> " . $hexa = get_post_meta( get_the_ID(), 'header_color', TRUE );?>
									</span>
									<span class="color-code">
										<?php
										$trim_hexa	= ltrim($hexa, '#');
										$split 		= str_split($trim_hexa, 2);
										$r 			= hexdec($split[0]);
										$g 			= hexdec($split[1]);
										$b 			= hexdec($split[2]);
										echo "<strong>RGB:</strong> " . "rgb(" . $r . ", " . $g . ", " . $b . ")";
										?>
									</span>
								</div>
							</div>

						<?php 
						endwhile;

					endif;
					?>
            </div>

    </div><!-- #primary -->
</main><!-- #main -->

<?php
get_footer();