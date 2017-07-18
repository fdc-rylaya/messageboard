<?php $this->start('navbar'); ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if (!AuthComponent::user('id')) { ?>
          <li class="active"><a href="/">Login</a></li>
          <li><a href="/users/add">Register</a></li>
        <?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (AuthComponent::user('id')) { ?>
        	<li class="active"><a href="/messages">Message</a></li>
          <li class=""><a href="/users/profile">Profile</a></li>
          <li><a href="/users/logout">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>

<div class="chat-box col-md-12">
	
	<div class="row">
		<div class="chat-control col-md-5 col-md-offset-4">
			<textarea class="form-control"></textarea>
			<button id="send-text" class="btn btn-primary">Send</button>
			<div class="row chat-convo">
				<?php foreach ($messages as $key => $value) { 
						if($value['Message']['id'] == $user['id']) {
					?>
					<div class="row">
						<div class="pull-right chat-msg from">
							<?php echo (!empty($user['image'])) ?  $this->Html->image($user['image'],array('class' => 'img-responsive')) : '' ; ?>
							<p><?php echo $value['Message']['content'] ?></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="pull-left chat-msg to">
						<?php echo (!empty($toUser['User']['image'])) ?  $this->Html->image($toUser['image'], array('class' => 'img-responsive')) : ''; ?>
							<p ><?php echo $value['Message']['content'] ?></p>
						</div>
					</div>
				<?php } 
				} ?>
			</div>
			<?php echo $this->Paginator->next(__('Load more'), array('tag' => false )); ?>
		</div>
	</div>
</div>
