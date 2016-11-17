<?php
/**
 * Hooks
 *
 * @author Getnudged
 */

/**
 * Networks Hook
 */
function g_authors_add_networks($networks, $id) {
	
	$networks = array(
		
			'facebook' => array(
				'id'			=> 'g_author_facebook',
				'name' 			=> __('Facebook'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_facebook', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-facebook'
				),		
			'googleplus' => array(
				'id'			=> 'g_author_googleplus',
				'name' 			=> __('Google+'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_googleplus', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-googleplus',
				),		
			'twitter' => array(
				'id'			=> 'g_author_twitter',
				'name' 			=> __('Twitter'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_twitter', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-twitter',
				),
			'xing' => array(
				'id'			=> 'g_author_xing',
				'name' 			=> __('Xing'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_xing', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-xing',
				),
			'linkedin' => array(
				'id'			=> 'g_author_linkedin',
				'name' 			=> __('LinkedIn'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_linkedin', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-linkedin',
				),
			'instagram' => array(
				'id'			=> 'g_author_instagram',
				'name' 			=> __('Instagram'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_instagram', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-instagram',
				),
			'youtube' => array(
				'id'			=> 'g_author_youtube',
				'name' 			=> __('Youtube'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_youtube', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-youtube',
				),
			'github' => array(
				'id'			=> 'g_author_github',
				'name' 			=> __('Github'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_github', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-github',
				),
			'dribbble' => array(
				'id'			=> 'g_author_dribbble',
				'name' 			=> __('Dribbble'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_dribbble', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-dribbble',
				),
			'behance' => array(
				'id'			=> 'g_author_behance',
				'name' 			=> __('Behance'),
				'meta' 			=> esc_attr( get_the_author_meta( 'g_author_behance', $id ) ),
				'description' 	=> '',
				'icon'			=> 'icon-behance',
				),
		);		
	
	return $networks;
}
add_filter( 'g_authors_networks', 'g_authors_add_networks', 10, 2 );

// Add Google Authorship add wp-head if g+ exists
function g_authors_google_authorship() {
	
	global $post;
	$id = get_the_author_meta('id', $post->post_author);
	
	$networks = apply_filters( 'g_authors_networks', $networks, $id );
		
	if($networks['googleplus']['meta'] !== '') {
		?>
<link rel="author" href="<?php echo $networks['googleplus']['meta']; ?>" />
	<?php	
	}
}
add_action('wp_head', 'g_authors_google_authorship');