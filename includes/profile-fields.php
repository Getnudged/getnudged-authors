<?php
/**
 * Profile Fields
 *
 * @author Getnudged
 */

/**
 * Add Profile Fields
 */
function g_authors_user_profile_fields($user) {		
	
	// Get networks hook
	$networks = apply_filters( 'g_authors_networks', $networks, $user->ID );
	
	// Block headline
	$headline = __('Social Networks');
	
	// Get template: profile
	include( G_AUTHORS_PATH .'/templates/profile.php');
}
add_action('show_user_profile', 'g_authors_user_profile_fields');
add_action('edit_user_profile', 'g_authors_user_profile_fields');

/**
 * Update Profile Fields
 */ 
function g_authors_update_user_profile_fields($user_id) {
	
	$networks = apply_filters( 'g_authors_networks', $networks, $user_id );
	
	if($networks) : foreach( $networks as $network ) : 
	
	if ( current_user_can( 'edit_user', $user_id) )
		update_user_meta($user_id, $network['id'], $_POST[$network['id']]);
	
	endforeach; endif;
}
add_action('personal_options_update', 'g_authors_update_user_profile_fields');
add_action('edit_user_profile_update', 'g_authors_update_user_profile_fields');