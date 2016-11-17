<h2><?php echo $headline; ?></h2>

<table class="form-table">
	
	<?php if($networks) : foreach($networks as $network) : ?>
	
	<tr>
		<th>
			<label for="<?php echo $network['id']; ?>"><?php echo $network['name']; ?></label>
		</th>
		<td>
			<input 
				   type="text" 
				   name="<?php echo $network['id']; ?>" 
				   id="<?php echo $network['id']; ?>" 
				   value="<?php echo $network['meta']; ?>" 
				   class="regular-text" 
				   />
			
			<p class="description"><?php echo $network['description']; ?></p>
		</td>
	</tr>
	
	<?php endforeach; endif; ?>
	
</table>