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
        	<li><a href="/messages">Message</a></li>
          <li class="active"><a href="/users/profile">Profile</a></li>
          <li><a href="/users/logout">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>
<div class="col-md-8 col-md-offset-2">
	<div class="row">
		<div class="col-md-4">
		
			<?php if (!empty($user['image'])) {
				echo $this->Html->image($user['image'], array('class' => 'img-responsive'));
			 } else { ?>
				<img src="https://placehold.it/150x150" class="img-responsive">
			<?php } ?>
				
		</div>
		<div class="col-md-8">
			<h2><?php echo $user['name']; ?></h2>
			<p>Gender: <?php echo (!empty($user['gender'])) ? ($user['gender'] == 1) ? 'Male' : 'Female' : ''; ?></p>
			<p>Birthdate: <?php echo (!empty($user['birthdate'])) ? date("F d, Y", strtotime($user['birthdate'])) : ''; ?></p>
			<p>Joined: <?php echo (!empty($user['created'])) ? date("F d, Y g a", strtotime($user['created'])) : ''; ?></p>
			<p>Last Login: <?php echo (!empty($user['last_login_time'])) ? date("F d, Y g a", strtotime($user['last_login_time'])) : ''; ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>
				<?php echo $user['hubby']; ?>
			</p>
			<?php //debug($user) ?>
			<a href="/users/edit">Edit</a>
		</div>
	</div>

</div>
