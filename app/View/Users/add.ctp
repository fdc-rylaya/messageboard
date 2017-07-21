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
                <li class=""><a href="/">Login</a></li>
                <li class="active"><a href="/users/add">Register</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
    <div class="panel-heading">User's Info</div>
    <div class="panel-body">
    <?php echo $this->Form->create('User'); ?>
    	<fieldset>
      		
          		<div class="form-group">
            			<?php
            				echo $this->Form->input('name', array('class' => 'form-control'));
            				echo $this->Form->input('email', array('type'=>'text', 'class' => 'form-control'));
            				echo $this->Form->input('password', array('class' => 'form-control'));
            				echo $this->Form->input('confirm_password', array('type'=>'password', 'class' => 'form-control'));
            			?>
          		</div>
    	</fieldset>
      <button class="btn btn-success">Submit</button>
      </div>
    <?php echo $this->Form->end(); ?>
    </div>
</div>
