<?php
/**
 * Shortcodes
 *
 * @author Getnudged
 */

/**
 * Author Shortcode
 */
function g_authors_shortcode( $atts ) {
	
	if( is_single() && is_singular( 'post' ) ) {
	
		global $post;
		$id 	= $post->post_author;
		$user	= md5($_SERVER['REMOTE_ADDR']);
		
		$args = array(
			'author'        =>  $id,
			'orderby'       =>  'post_date',
			'order'         =>  'ASC',
		);
		$posts = get_posts( $args );
		
		$views = g_authors_view_count($id);

		$author = array(
			'id' 			=> get_the_author_meta('id', $id),
			'display_name' 	=> get_the_author_meta('display_name', $id),
			'posts' 		=> count($posts),
			'views' 		=> $views,
			);
		
		$networks = apply_filters( 'g_authors_networks', $networks, $id );
		
		ob_start();
		
		include( G_AUTHORS_PATH .'/templates/author.php' );
		
		$html = ob_get_clean();

		return $html;
		
	}
}
add_shortcode( 'author', 'g_authors_shortcode' );

// Allow shortcodes in sidebar widgets
add_filter('widget_text','do_shortcode');