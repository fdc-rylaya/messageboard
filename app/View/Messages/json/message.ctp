
<?php 

	if(!empty($message) && $message['Message']['from_id'] == $user['id']) {
	?>
		<div class="row">
			<div class="pull-right chat-msg from">
				<?php 
					if (!empty($user['image'])) {  
						echo '<a href="/users/profile">'.$this->Html->image($user['image'],array('class' => 'img-responsive')).'</a>';
					} 
				?>
				<p><?php echo $message['Message']['content'] ?></p>
				<p class="time"><i><?php echo $message['Message']['created'] ?></i></p>
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
				<p ><?php echo $message['Message']['content'] ?></p>
				<p class="time"><i><?php echo $message['Message']['created'] ?></i></p>
			</div>
			<div class="clear"></div>
		</div>
	<?php } 
		$this->Js->set('data', array('to_id' => $to_id,'from_id' => $from_id, 'last_id' => $last_id))
	 ?>

