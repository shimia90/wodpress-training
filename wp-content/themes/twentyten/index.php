<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<style>
    #zendvn-mp-info {
    	border: 1px solid #ccc;
        background: #fff;
    	min-height: 100px;
    }
</style>
		<div id="container">
			<div id="content" role="main">
				<div id="zendvn-mp-info">
					<ul>
						<li>get_search_form() 	: 	<?php echo get_search_form(); ?></li>
						<li>wp_loginout() 	: 	<?php wp_loginout(); ?></li>
						<li>wp_logout_url() 	: 	<?php echo wp_logout_url(); ?></li>
						<li>wp_login_url() 	: 	<?php echo wp_login_url(); ?></li>
						<li>wp_login_form() 	: 	<?php echo wp_login_form(); ?></li>
						<li>wp_lostpassword_url() 	: 	<?php echo wp_lostpassword_url(); ?></li>
						<li>wp_register() 	: 	<?php echo wp_register(); ?></li>
					</ul>

					<ul>
						<li>bloginfo('name') 	: 	<?php bloginfo('name'); ?></li>
						<li>get_bloginfo('name') 	: 	<?php echo get_bloginfo('name'); ?></li>
						<li>bloginfo('admin_email') 	: 	<?php bloginfo('admin_email'); ?></li>
						<li>get_bloginfo('admin_email') 	: 	<?php echo get_bloginfo('admin_email'); ?></li>
					</ul>

					<ul>
						<li>wp_get_archives( $args ) 	: 	<?php wp_get_archives(); ?></li>
					</ul>

					<ul>
						<li>get_calendar() : 	<?php echo get_calendar(); ?></li>
					</ul>
				</div>
			<?php
			/*
			 * Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
