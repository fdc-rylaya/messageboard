
<?php 

	foreach ($messages as $key => $value) { 
			if($value['Message']['from_id'] == $user['id']) {
	?>
		<div class="row">
			<div class="chat-msg-container">
				<div class="pull-right chat-msg from">
					<div class="row">
						<div class="col-md-12">
							<a href="#" class="remove" msg-id="<?php echo $value['Message']['id']; ?>">X</a>
						</div>
					</div>
						
						<p><?php echo $value['Message']['content'] ?></p>
						<p class="time"><i><?php echo $value['Message']['created'] ?></i></p>
					</div>
				<div class="clear"></div>
				<?php 
						if (!empty($user['image'])) {  
							echo '<a href="/users/profile" class="from">'.$this->Html->image($user['image'],array('class' => 'img-responsive img-circle')).'</a>';
						}
					?>
			</div>
		</div>
	<?php 
		} else { 
	?>
		<div class="row">
			<div class="chat-msg-container">
				<div class="pull-left chat-msg to">
					<div class="row">
						<div class="col-md-12">
							<a href="#" class="remove" msg-id="<?php echo $value['Message']['id']; ?>">X</a>
						</div>		
					</div>				
					<p ><?php echo $value['Message']['content'] ?></p>
					<p class="time"><i><?php echo $value['Message']['created'] ?></i></p>
				</div>
				<div class="clear"></div>
				<?php if (!empty($toUser['User']['image'])) {  

					echo '<a href="/users/view/'.$toUser['User']['id'].'" class="to">'.$this->Html->image($toUser['User']['image'], array('class' => 'img-responsive img-circle')).'</a>';

				} ?>
			</div>
		</div>
	<?php } 
	} 
	echo $this->Paginator->next(__('Load more'), array('tag' => false )); 


?>
