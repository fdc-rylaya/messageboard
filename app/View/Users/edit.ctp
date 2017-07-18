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
          <li><a href="/users/profile">Profile</a></li>
          <li><a href="/users/logout">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>

<div class="col-md-8 col-md-offset-2">
  <?php echo $this->Form->create('User'); ?>
    <div class="row">
      <div class="col-md-12">
      
        <?php if (!empty($user['image'])) { ?>
          <img src="<?php echo $user['image']; ?>" class="img-responsive">
        <?php } else { ?>
          <img src="https://placehold.it/150x150" class="img-responsive">
        <?php } ?>
          
      </div>
      <div class="col-md-12">
        <p><?php echo $this->Form->input('name'); ?></h2>
        <p>
        <?php 
          $options = array('1' => 'Male', '2' => 'Female');
          $attributes = array('legend' => false);
          echo $this->Form->radio('gender', $options, $attributes); 
        ?></p>
        <p>Birthdate: <?php echo (!empty($user['birthdate'])) ? date("d-m-Y", strtotime($user['birthdate'])) : ''; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p>
          <?php $user['hubby']; ?>
        </p>
      </div>
    </div>
  <?php echo $this->Form->end(__('Submit')); ?>
</div>

