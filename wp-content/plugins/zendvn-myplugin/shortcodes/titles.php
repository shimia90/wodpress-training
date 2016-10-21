<?php
class Zendvn_Mp_SC_Titles{
	
	public function __construct(){
		add_shortcode('zendvn_mp_sc_titles', array($this,'show'));
		//echo '<br/>' . __METHOD__;
	}
	
	public function show($attr){
		
		if(is_single()){
			
			//ids='57,48,30' title='Các bài viết liên quan đến Triều Tiên'
			$pairs = array(
						'ids' => '18,27,54',
						'title' => 'Các bài viết khác'
					);
			$attr = shortcode_atts($pairs, $attr,'zendvn_mp_sc_titles');
			 
			extract($attr);
			$ids = explode(',', $ids);
			
			$list = '';
			if(count($ids)>0){
				$args = array(
							'post_type' 		=> 'post',
							'post__in' 			=> $ids,
							'post_status' 		=>'publish',
							'ignore_sticky_posts' => true
						);
				$wpQuery = new WP_Query($args);
				
				if($wpQuery->have_posts()){
					$list .='<ul>';
					while ($wpQuery->have_posts()){
						$wpQuery->the_post();
						$lnk = $wpQuery->post->guid;
						$list .='<li><a href="' . $lnk .'">' . get_the_title() . '</a></li>';
					}
					$list .='</ul>';
				}
				wp_reset_postdata();
			}
			
			$html = "<div><b><i>{$title}</i></b>{$list}</div>";
			return $html;
		}
	}
}
