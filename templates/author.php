<div id="g-author">

	<div class="g-author-head clearfix">
		
		<div class="g-ah-image">
			<img src="<?php echo get_avatar_url( $author['id'], array( 'size' => '500' ) ); ?>" alt="<?php echo $author['display_name']; ?>" />
		</div>
		
		<div class="g-ah-name">
			<?php echo $author['display_name']; ?>
		</div>
		
	</div>
	
	<div class="g-author-stats clearfix">
		
		<div class="g-as-left">
			<span><?php echo $author['posts']; ?></span><?php _e('Artikel'); ?>
		</div>
		
		<div class="g-as-right">
			<span><?php echo $author['views']; ?></span><?php _e('Aufrufe'); ?>
		</div>
		
	</div>

	<div class="g-author-content">		
		<div class="g-ac-social">
			<?php if($networks) : foreach( $networks as $network ) : if($network['meta']) : ?>
			
			<a href="<?php echo $network['meta']; ?>" title="<?php echo $network['name']; ?>" target="_blank">
				<?php if($network['icon']) : ?>
				<span class="<?php echo $network['icon']; ?>"></span>
				<?php endif; echo $network['name']; ?>
			</a>
			<?php endif; endforeach; endif; ?>
		</div>		
	</div>

</div>