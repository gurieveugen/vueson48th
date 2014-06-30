<?php

class LatestNews extends WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct('latest_news_widget', __('Latest news on sidebar'), array( 'description' => __('Add a Latest News block to sidebar.')));
	}

	function widget($args, $instance) 
	{
		$category = !empty($instance['category']) ? get_category($instance['category']) : false;
		$count    = !empty($instance['count']) ? intval($instance['count']) : 0;
		
		if (!$category || !$count) return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) ) echo $args['before_title'] . $instance['title'] . $args['after_title'];
		
		$args = array(
			'posts_per_page'   => $count,
			'offset'           => 0,
			'category'         => $category->term_id,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		$posts = get_posts($args);
		echo '<ul>';
		foreach ($posts as $p) 
		{
			$this->wrapPost($p);
		}
		echo '</ul>';
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title']    = strip_tags( stripslashes($new_instance['title']) );
		$instance['category'] = (int) $new_instance['category'];
		$instance['count']    = (int) $new_instance['count'];
		return $instance;
	}

	function form($instance) 
	{
		$arr = fillArray(array('title', 'category', 'count'), $instance);
		extract($arr);
		
		$args = array(
			'type'         => 'post',
			'child_of'     => 0,
			'parent'       => '',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => FALSE,
			'hierarchical' => 1,
			'exclude'      => '',
			'include'      => '',
			'number'       => '',
			'taxonomy'     => 'category',
			'pad_counts'   => false);
		$categories = get_categories($args); 

		$select_args = array(
			'name'    => $this->get_field_name('category'),
			'current' => $category
			);
		
		if (!$categories) 
		{
			echo '<p>'.sprintf( __('No Categories have been created yet. <a href="%s">Create some</a>.'), admin_url('edit-tags.php?taxonomy=category') ) .'</p>';
			return;
		}

		foreach ($categories as $cat) 
		{
			$cat_values[] = array($cat->term_id, $cat->name);
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to show:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $count; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select category:'); ?></label>
			<?php echo getSelectCtrl($select_args, $cat_values); ?>			
		</p>
		<?php
	}

	function wrapPost($p)
	{
		if(!$p) return false;
		$url = get_permalink($p->ID);
		?>
		<li>
			<h2><a href="<?php echo $url; ?>"><?php echo $p->post_title; ?></a></h2>
			<div class="entry">
				<p><?php echo $p->post_excerpt; ?></p>
				<a href="<?php echo $url; ?>" class="more">more</a>							
			</div>
		</li>
		<?php

	}
}