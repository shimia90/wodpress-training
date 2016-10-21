<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<style>
.zendvn_mp_taxonomy_category{
	border: solid 1px #CCC;
	padding: 5px;
	margin-bottom: 10px;
	background: #F2F7FC;
}

.zendvn_mp_taxonomy_category .img{
	float: left;
	margin: 5px;
}

.zendvn_mp_taxonomy_category .summary{
	font-size: 14px;
	font-style: italic;
}

.zendvn_mp_taxonomy_category h1{
	clear: none;
	margin-bottom: 7px !important;
	font-size: 16px;
}

.clr{
	clear: both;
}

</style>
		<div id="container">
			<div id="content" role="main">
				<div class="zendvn_mp_taxonomy_category">
					<div class="img"><img src="<?php echo $zendvn_mp_taxonomy_category['picture'];?>"></div>
					<div class="summary">
					<h1 class="page-title"><?php
						printf( __( 'Category: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>
						<?php echo $zendvn_mp_taxonomy_category['summary'];?>
					</div>
					<div class="clr"></div>
				</div>
				<?php 

				/*
				 * Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
