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
          <li class=""><a href="/users/profile"><?php echo AuthComponent::user('name'); ?></a></li>
          <li><a href="/users/logout">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>
<div class="col-md-8 col-md-offset-2">
<a href="/messages/create" class="button-like btn btn-danger pull-right">Create Message</a>
<br>
  <table>
    <tr>
      <th>Name</th>
      <th>&nbsp;</th>
    </tr>
    <?php foreach ($users as $key => $value) { ?>
    <tr>
      <td><a href="/users/view/<?php echo $value['User']['id']; ?>"><?php echo  $value['User']['name']; ?></a></td>
      <td><a href="/messages/view/<?php echo $value['User']['id'] ?>">Message Detail</a></td>
    </tr>
    <?php } ?>
  </table>
</div>  