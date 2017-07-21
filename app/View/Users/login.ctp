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
              <li class="active"><a href="/">Login</a></li>
              <li><a href="/users/add">Register</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>

<div class="col-md-12">

  	<div class="row">

    		<div class="col-md-4 col-md-offset-4">
          <div class='panel panel-primary'>
            <div class="panel-heading">Login</div>
            <div class="panel-body">
              <?php //echo $this->Flash->render('auth'); ?>
              <?php echo $this->Form->create('User'); ?>
                  <fieldset>
                      <?php echo $this->Form->input('email');
                      echo $this->Form->input('password');
                  ?>
                  </fieldset>
                  <button class="btn btn-success">Login</button>
              <?php echo $this->Form->end(); ?>
              </div>
          </div>
    		</div>	
  	</div>
</div>