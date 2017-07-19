
<?php 
	foreach ($messages as $key => $value) { 
			if($value['Message']['from_id'] == $user['id']) {
	?>
		<div class="row">
			<div class="pull-right chat-msg from">
				<?php 
					if (!empty($user['image'])) {  
						echo '<a href="/users/profile">'.$this->Html->image($user['image'],array('class' => 'img-responsive')).'</a>';
					}
				?>
				<p><?php echo $value['Message']['content'] ?></p>
				<p class="time"><i><?php echo $value['Message']['created'] ?></i></p>
			</div>
			<div class="clear"></div>
		</div>
	<?php 
		} else { 
	?>
		<div class="row">
			<div class="pull-left chat-msg to">
			<?php if (!empty($toUser['User']['image'])) {  

				echo '<a href="/users/view/'.$toUser['User']['id'].'">'.$this->Html->image($toUser['User']['image'], array('class' => 'img-responsive')).'</a>';

				} ?>
				<p ><?php echo $value['Message']['content'] ?></p>
				<p class="time"><i><?php echo $value['Message']['created'] ?></i></p>
			</div>
			<div class="clear"></div>
		</div>
	<?php } 
	} 
	echo $this->Paginator->next(__('Load more'), array('tag' => false )); 


?>
