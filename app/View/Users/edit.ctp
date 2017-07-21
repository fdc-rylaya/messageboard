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
            <a class="navbar-brand" href="#">Message Board</a>
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
                  <li class="active"><a href="/users/profile"><?php echo AuthComponent::user('name'); ?></a></li>
                  <li><a href="/users/logout">Logout</a></li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>
<div class="col-md-8 col-md-offset-2 edit">
  <div class="panel panel-primary">
      <div class="panel-heading"> 
        <h1>Edit</h1>
      </div>
      <div class="panel-body">
      <?php echo $this->Form->create('User',array('type' => 'file')); ?>
          <div class="row">
              <div class="col-md-5 col-md-offset-4">
                  <?php if (!empty($user['image'])) { 
                    echo $this->Html->image($user['image'], array('class' => 'img-responsive img-circle','id'=>"upload-target",'label' => false));
                  } else { ?>
                    <img src="https://placehold.it/150x150" class="img-responsive img-circle" id="upload-target">
                  <?php } ?>   
                  <?php echo $this->Form->input('image',array('type' => 'file','id' => 'upload-image', 'required'=>false)); ?>
              </div>
              <div class="col-md-12">
                  <div><?php echo $this->Form->input('name',array('class'=>'form-control','value'=>$user['name'], 'required'=>true , 'format' => array('before', 'label', 'between', 'input', 'after'))); ?>
                    <?php 
                      echo (isset($this->validationErrors['User']['name'][0])) ? '<p style="color:red; padding-left:10px;">'.$this->validationErrors['User']['gender'][0].'</p>' : '';
                    ?>

                  </div>
                  <div><?php echo $this->Form->input('email',array('class'=>'form-control','value'=>$user['email'], 'required'=>true, 'format' => array('before', 'label', 'between', 'input', 'after'))); ?>
                    
                    <?php 
                      echo (isset($this->validationErrors['User']['email'][0])) ? '<p style="color:red; padding-left:10px;">'.$this->validationErrors['User']['gender'][0].'</p>' : '';
                    ?>
                  </div>
                
                <label class="form-label">Gender</label>
                  <div class="gender">
                  <?php 

                    $options = array('1' => 'Male', '2' => 'Female');
                    $attributes = array('legend' => false,'class'=>'','value'=>$user['gender'], 'required'=>true);
                    echo $this->Form->radio('gender', $options, $attributes);
                    echo (isset($this->validationErrors['User']['gender'][0])) ? '<p style="color:red; padding-left:10px;">'.$this->validationErrors['User']['gender'][0].'</p>' : '';
                    //echo $this->Form->input('gender', array('type'=>'radio','options' => array('Male', 'Female'), 'value' => $user['gender'], 'required'=>true)); 
                  ?></div>

                  <label class="form-label">Birthdate</label>
                  <div class="input-group">
                    <?php 
                    echo $this->Form->input('birthdate',array('type'=>'text', 'class'=>'form-control jq-calendar', 'aria-describedby'=>"basic-addon2", 'value'=>$user['birthdate'], 'required'=>true,'label' => false, 'div'=> false, 'legend' => false, 'format' => array('before', 'label', 'between', 'input', 'after')));
                    ?>
                    <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                   <?php 
                      echo (isset($this->validationErrors['User']['birthdate'][0])) ? '<p style="color:red; padding-left:10px;">'.$this->validationErrors['User']['gender'][0].'</p>' : '';
                    ?>

              </div>
              <div class="col-md-12">
                  <div>
                  <label>Hobby</label>
                  <?php echo $this->Form->input('hubby',array('class'=>'form-control','value'=>$user['hubby'], 'required'=>true, 'format' => array('before', 'between', 'input'))); ?>
                    
                    <?php 
                      echo (isset($this->validationErrors['User']['hubby'][0])) ? '<p style="color:red; padding-left:10px;">'.$this->validationErrors['User']['gender'][0].'</p>' : '';
                    ?>
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
          <?php echo $this->Form->end(); ?>
      </div>
</div>
</div>

