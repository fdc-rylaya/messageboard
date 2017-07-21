
<?php 

	if(!empty($message) && $message['Message']['from_id'] == $user['id']) {
	?>
		<div class="row">
			<div class="chat-msg-container">
				<div class="pull-right chat-msg from">
					<div class="row">
						<div class="col-md-12">
							<a href="#" class="remove" msg-id="<?php echo $message['Message']['id']; ?>">X</a>
						</div>
					</div>
					<p><?php echo $message['Message']['content'] ?></p>
					
				</div>
				<div class="clear"></div>
				<p class="time from"><i>Sent on <?php echo $message['Message']['created'] ?></i></p>
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
							<a href="#" class="remove" msg-id="<?php echo $message['Message']['id']; ?>">X</a>
						</div>		
					</div>
				
					<p ><?php echo $message['Message']['content'] ?></p>
					
				</div>
				<div class="clear"></div>
				<p class="time to"><i>Sent on <?php echo $message['Message']['created'] ?></i></p>
				<?php if (!empty($toUser['User']['image'])) {  
					echo '<a href="/users/view/'.$toUser['User']['id'].'" class="to">'.$this->Html->image($toUser['User']['image'], array('class' => 'img-responsive img-circle')).'</a>';
				} ?>
				
			</div>
			<div class="clear"></div>
		</div>
	<?php }
	     $to_id = (isset($to_id)) ?  $to_id : '';
	     $from_id = (isset($from_id)) ?  $from_id : '';
	     $last_id = (isset($last_id)) ?  $last_id : '';
		$this->Js->set('data', array('to_id' => $to_id,'from_id' => $from_id, 'last_id' => $last_id))
	 ?>

