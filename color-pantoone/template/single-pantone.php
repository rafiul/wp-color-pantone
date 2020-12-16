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
 * @package presspen
 */

get_header();
?>
<main id="site-content" class="site-main container">
    <div id="primary" class="content-area mt-5">
		<?php
		while ( have_posts() ) :
			the_post();?>
			
			<table class="table">
			  <tbody>
				<tr>
					<td width="15%">
						<div class="color-pantone" style="background-color:<?php echo $meta = get_post_meta( get_the_ID(), 'header_color', TRUE );?>">
						</div>
						<h2>Pantone</h2>
						<h6><?php echo $meta = get_post_meta( get_the_ID(), 'header_color', TRUE );?></h6>
					</td>
				  <td><?php echo get_the_excerpt(); ?></td>
				</tr>
			  </tbody>
			</table>
		<?php endwhile;?>
    </div><!-- #primary -->
</main><!-- #main -->

<?php
get_footer();