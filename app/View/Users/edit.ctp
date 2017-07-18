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
<div class="col-md-8 col-md-offset-2 edit">
  <?php echo $this->Form->create('User',array('type' => 'file')); ?>
    <div class="row">
      <div class="col-md-12">
        <?php if (!empty($user['image'])) { 
          echo $this->Html->image($user['image'], array('class' => 'img-responsive','id'=>"upload-target"));
        } else { ?>
          <img src="https://placehold.it/150x150" class="img-responsive" id="upload-target">
        <?php } ?>   
        <?php echo $this->Form->input('image',array('type' => 'file','id' => 'upload-image','required'=>false)); ?>
      </div>
      <div class="col-md-12">
        <p><?php echo $this->Form->input('name',array('class'=>'form-control','value'=>$user['name'])); ?></p>
        <p><?php echo $this->Form->input('email',array('class'=>'form-control','value'=>$user['email'])); ?></p>
        <p class="gender">
        <?php 
          $options = array('1' => 'Male', '2' => 'Female');
          $attributes = array('legend' => false,'class'=>'');
          echo $this->Form->radio('gender', $options, $attributes); 
        ?></p>
        <label class="form-label"> Birthdate </label>
        <div class="input-group">
          <input type="text" class="form-control" name="data[User][birthdate]" aria-describedby="basic-addon2" value="<?php echo $user['birthdate']; ?>" id="jq-calendar">
          <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
      </div>
      <div class="col-md-12">
      <label class="form-label"> Hubby </label>
        <textarea class="form-control" name="data[User][hubby]"><?php echo $user['hubby']; ?></textarea>
      </div>
    </div>
  <?php echo $this->Form->end(__('Submit')); ?>
</div>

