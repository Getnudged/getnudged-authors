<?php
/**
 * Backend
 *
 * @author Getnudged
 */

/**
 * Columns in Post List
 */

// Add Columns
add_filter('manage_posts_columns', 'g_authors_column_head');
function g_authors_column_head($columns) 
{
	$new = array();
	
	foreach($columns as $key => $title) {
		if ($key == 'date' ) :
			$new['g_authors'] = __('Aufrufe');
		endif;
		$new[$key] = $title;
	}
	
	return $new;
}

// Add Columns Content
add_action('manage_posts_custom_column', 'g_authors_column_content', 10, 2);
function g_authors_column_content($column_name, $post_ID) 
{	
	if ($column_name == 'g_authors') echo intval(get_post_meta( $post_ID, 'g_authors_views', true ));
}