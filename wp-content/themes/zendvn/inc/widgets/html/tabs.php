<?php 
/*
 * Array
(
    [popular_title] => Popular
    [popular_items] => 5
    [recent_title] => Recent
    [recent_items] => 5
    [comment_title] => Comment
    [comment_items] => 5
)
 */;
?>
<div class="wpex-tabs-widget clr">
	<div class="wpex-tabs-widget-inner clr">
		<div class="wpex-tabs-widget-tabs clr">
			<ul>
				<?php if(!empty($instance['popular_title'])) :?>
					<li><a href="#" data-tab="#wpex-widget-popular-tab" class="active"><?php echo $instance['popular_title']; ?></a></li>
				<?php endif; ?>
				<?php if(!empty($instance['recent_title'])) :?>
					<li><a href="#" data-tab="#wpex-widget-recent-tab"><?php echo $instance['recent_title']; ?></a></li>
				<?php endif; ?>
				<?php if(!empty($instance['comment_title'])) :?>
					<li><a href="#" data-tab="#wpex-widget-comments-tab" class="last"><?php echo $instance['comment_title']; ?></a></li>
				<?php endif; ?>
			</ul>
		</div>
		
		<!-- .wpex-tabs-widget-tabs -->
		<?php if(!empty($instance['popular_title'])) :?>
			<?php 
			     $popular_items  =   ((int)$instance['popular_items'] == 0) ? 5 : $instance['popular_items'];
			     $meta_key       =   'zendvn_post_views_count';
			     $args       =   array(
			         'post_type'             =>      'post',
			         'order'                 =>      'DESC',
			         'posts_per_page'        =>      $popular_items,
			         'post_status'           =>      'publish',
			         'ignore_sticky_posts'   =>      true,
			         'meta_key'              =>      $meta_key,
			         'orderby'               =>      'meta_value'
			     );
			     $wpQuery    =   new WP_Query($args);
			     $i          =   1;
			     if($wpQuery->have_posts()):
			         while($wpQuery->have_posts()) : 
			             $wpQuery->the_post();
			?>
    		<div id="wpex-widget-popular-tab"
    			class="wpex-tabs-widget-tab active-tab clr">
    			<ul class="clr">
    				<li class="clr">
    					<a href="<?php the_permalink(); ?>" title="Amazing Nature Photography by Matt Tucker" class="clr">
    						<span class="counter"><?php echo $i; ?></span>
    						<span class="title strong"><?php the_title(); ?></span>
    						<?php echo mb_substr(get_the_excerpt(), 0, 55) . '...'; ?>
    					</a>
    				</li>
    			</ul>
    		</div>
		<?php 
		              $i++;
		            endwhile;
		         endif;
		      endif; 
		      wp_reset_postdata();
		?>
		<!-- wpex-tabs-widget-tab -->
		<?php if(!empty($instance['recent_title'])) :?>
		<?php 
			     $recent_items  =   ((int)$instance['recent_items'] == 0) ? 5 : $instance['recent_items'];

			     $args       =   array(
			         'post_type'             =>      'post',
			         'order'                 =>      'DESC',
			         'orderby'               =>      'ID',
			         'posts_per_page'        =>      $recent_items,
			         'post_status'           =>      'publish',
			         'ignore_sticky_posts'   =>      true,
			     );
			     $wpQuery    =   new WP_Query($args);
			?>
        		<div id="wpex-widget-recent-tab" class="wpex-tabs-widget-tab  clr">
        			<ul class="clr">
        				<?php 
        				if($wpQuery->have_posts()):
        				    while($wpQuery->have_posts()) :
        				        $wpQuery->the_post();
        				        echo $this->get_img_url($wpQuery->posts['post_content']);
        				?>
            				<li class="clr">
            					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="clr">
            						 <img src="<?php echo $this->get_img_url($wpQuery->post->post_content); ?>" alt="<?php the_title(); ?>" width="100" height="100" /> 
            						 <span class="title strong"><?php the_title(); ?></span>
            						 	<?php echo mb_substr(get_the_excerpt(), 0, 55); ?>
                				</a>
            				</li>
            			<?php 
            			     endwhile;
            			endif;
            			?>
        			</ul>
        		</div>
		<?php 
		      endif; 
		      wp_reset_postdata();
		?>
		<!-- wpex-tabs-widget-tab -->
		<?php if(!empty($instance['comment_title'])) :?>
		<?php 
		  $commnet_items  =   ((int)$instance['comment_items'] == 0) ? 5 : $instance['comment_items'];
		  $args               =   array(
		      'order'         =>      'DESC',
		      'status'        =>      'approve',
		      'number'        =>      $commnet_items
		  );
		  $comment_query      =   new WP_Comment_Query();
		  $result_comment     =   $comment_query->query($args);
		  
		  
		?>
			<?php if(count($result_comment) > 0) :?>
    		<div id="wpex-widget-comments-tab" class="wpex-tabs-widget-tab clr">
    			<ul class="clr">
    				<?php foreach($result_comment as $comment) :?>
        				<li class="clr">
        					<a href="<?php echo get_permalink($comment->comment_post_ID); ?>" title="Homepage" class="clr"> <img
        						src='<?php echo get_avatar_url($comment->user_id, '96'); ?>'
        						class="avatar avatar-100 photo" /> <span class="title strong"><?php echo $comment->comment_author; ?></span> 
        						<?php echo mb_substr($comment->comment_content, 0, 55); ?>
        					</a>
        				</li>
    				<?php endforeach; ?>
    			</ul>
    		</div>
    		<?php endif; ?>
    	<?php endif; ?>
		<!-- .wpex-tabs-widget-tab -->
	</div>
	<!-- .wpex-tabs-widget-inner -->
</div>
<!-- .wpex-tabs-widget -->