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
<div class="col-md-8 col-md-offset-2 profile">
  <div class="panel panel-primary">
    <div class="panel-heading">
    <h2><?php echo $user['name']; ?></h2>
    </div>
    	<div class="row">
      		<div class="col-md-6 col-md-offset-3">
        			<?php if (!empty($user['image'])) {
        				echo $this->Html->image($user['image'], array('class' => 'img-responsive img-circle'));
        			 } else { ?>
        				<img src="https://placehold.it/150x150" class="img-responsive img-circle">
        			<?php } ?>
      		</div>
      		<div class="col-md-12">
        			
        			<p><?php echo (!empty($user['gender'])) ? ($user['gender'] == 1) ? 'Male' : 'Female' : ''; ?></p>
        			<p><?php echo (!empty($user['birthdate'])) ? date("F d, Y", strtotime($user['birthdate'])) : ''; ?></p>      			
      		</div>
          <div class="col-md-6">
          <table>
            <tr>
              <td>Joined</td>            
            </tr>
            <tr>
              <td> <?php echo (!empty($user['created'])) ? date("F d, Y g a", strtotime($user['created'])) : ''; ?></td>
            </tr>
          </table>
          </div>
          <div class="col-md-6">
          <table>
            <tr>
              <td>Last Login</td>
            </tr>
            <tr>
              <td><?php echo (!empty($user['last_login_time'])) ? date("F d, Y g a", strtotime($user['last_login_time'])) : ''; ?></td>
            </tr>
          </table>
          </div>
    	</div>
    	<div class="row">
      		<div class="col-md-12 hobby">
          <hr>
      			<p>
      				<?php echo $user['hubby']; ?>
      			</p>
      			<?php if(isset($myProfile) && $myProfile) { ?>
              <a href="/users/edit" class="btn btn-primary">Edit</a>
            <?php } ?>
      		</div>
    	</div>
    </div>
</div>

