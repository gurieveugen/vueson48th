<?php

class GoogleMap{
	//                          __              __      
	//   _________  ____  _____/ /_____ _____  / /______
	//  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
	// / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
	// \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
	const URL_GEOCODE = 'http://maps.googleapis.com/maps/api/geocode/json?address=';	 
	const CACHE_ON    = TRUE;                                                

	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
	private $tax_class;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($tax_class)
	{
		$this->tax_class = $tax_class;
	}	

	/**
	 * Get all location groups
	 * @return array --- groups objects
	 */
	public function getGroups()
	{		
		$groups = $this->tax_class->getTerms();
		foreach ($groups as &$group) 
		{
			$key   = md5($group->meta['location_address']);
			$cache = $this->getCache($key);
			if($cache)
			{
				$group->meta['location'] = $cache;
			}
			else
			{
				$group->meta['location'] = $this->getLatLngByAddress($group->meta['location_address']);
			}
			$this->setCache($key, $group->meta['location']);
		}
		return $groups;
	}

	public function getSliders()
	{
		$first  = true;
		$groups = $this->getGroups();
		if(!$groups) return false;
		ob_start();
		foreach ($groups as $group) 
		{
			$args = array(
				'posts_per_page'   => -1,
				'offset'           => 0,
				'category'         => '',
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'include'          => '',
				'exclude'          => '',
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'location',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'tax_query' 	   => array(
					array(
						'taxonomy' => 'location_group',
						'field'    => 'id',
						'terms'    => array($group->term_id)
					)
				)
			);

			$locations = get_posts($args);            						
			if($locations)
			{
				$hide = $first ? '' : 'hide';
				$first = false;
				?>
				<div class="slider-location <?php echo $hide; ?>" id="group-<?php echo $group->term_id; ?>">
                    <?php if ( count($locations) > 1 ) : ?>
					<nav class="flexslider-controls-one">
						<a href="prev" data-id="<?php echo $group->slug.$group->term_id; ?>" class="prev">prev</a>
						<a href="next" data-id="<?php echo $group->slug.$group->term_id; ?>" class="next">next</a>
					</nav>
                    <?php endif; ?>

					<aside class="flexslider-carousel-one" id="<?php echo $group->slug.$group->term_id; ?>">
						<div class="border-top">&nbsp;</div>
						<div class="border-left">&nbsp;</div>
						<div class="border-right">&nbsp;</div>
						<div class="border-bottom">&nbsp;</div>						
						<ul class="slides">
							<?php							
							foreach ($locations as $loc) 
							{
								$large = get_post_meta($loc->ID, 'location_large_image', true);
								// if(!has_post_thumbnail($loc->ID)) continue;
                                
        //                         if (empty($large)) {
        //                             $thumb_id = get_post_thumbnail_id($loc->ID);
        //                             $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
        //                         	$large = $thumb_url[0];
        //                             echo "<!--<pre>";
        //                             var_dump($large);
        //                             echo "</pre>-->";                                    
        //                         }                                
								?>
								<li>
									<figure>
										<a href="<?php echo $large; ?>" class="zoom fancybox">zoom</a>
										<?php echo get_the_post_thumbnail($loc->ID, 'location-img'); ?>										
									</figure>
									<div class="txt">
										<h2><?php echo $loc->post_title; ?></h2>
										<p>
											<?php echo $loc->post_content; ?>
										</p>
									</div>
								</li>
								<?php
							}							
							?>
						</ul>
					</aside>
				</div>
				<?php	
			}
			
		}
		return ob_get_clean();
	}

	/**
	 * Get markers JavaScript variable
	 * @param  string $map --- Google map JavaScript variable
	 * @return string      --- JavaScript variable
	 */
	public function getMarkers()
	{	
		$groups = $this->getGroups();
		if(!$groups) return '';
		foreach ($groups as $group) 
		{
			$markers[$group->term_id] = array(
				'ID'          => $group->term_id,
				'title'       => $group->name,
				'description' => $group->description,
				'location'    => $group->meta['location'],
				'address'     => $group->meta['location_address'],
				'icon'        => $group->meta['location_icon']
			);
		}		
		return sprintf('var markers = %s;', json_encode($markers));
	}

	/**
	 * Get geometry info from address
	 * @param  string $address --- address
	 * @return mixed           --- lat and lng [array] | false [boolean]
	 */
	public function getLatLngByAddress($address)
	{
		$url         = self::URL_GEOCODE.urlencode($address);		
		$json_string = $this->fileGetContentsCurl($url);			
		$json        = json_decode($json_string, true);
		if(isset($json['results'][0]))
		{
			return $json['results'][0]['geometry']['location'];
		}
		return false;
	}      

	/**
	 * Get contents 
	 * @param  string $url
	 * @return string
	 */
	public function fileGetContentsCurl($url) 
	{
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	    curl_setopt($ch, CURLOPT_URL, $url);

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
	}   

	/**
	 * Set Cache
	 * @param string  $key    
	 * @param string  $val    
	 * @param integer $time   
	 * @param string  $prefix 
	 */
	public function setCache($key, $val, $time = 3600, $prefix = 'cheched-')
	{		
		set_transient($prefix.$key, $val, $time);
	}
	 
	/**
	 * Get Cache
	 * @param  string $key    
	 * @param  string $prefix 
	 * @return mixed
	 */
	public function getCache($key, $prefix = 'cheched-')
	{		
		if(self::CACHE_ON)
		{
			$cached   = get_transient($prefix.$key);
			if (false !== $cached) return $cached;	
		}
		return false;
	}                               
}