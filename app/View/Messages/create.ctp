<?php 

$this->start('navbar'); ?>
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
        	<li class="active"><a href="/messages">Message</a></li>
          <li class=""><a href="/users/profile"><?php echo AuthComponent::user('name'); ?></a></li>
          <li><a href="/users/logout">Logout</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php $this->end(); ?>
<div class="col-md-7 col-md-offset-2">
  <div class="form-group">
    <label class="form-label">Name</label>
    <div class="row">
    <div class="col-md-12">
      <select class="search-recipients form-control" id="recipient-id" style = "width:100%;">
        <option value=""><img src="" style="width:50px; background-color:black;">Search Recipient</option>
      </select>
      </div> 
    </div>

  </div>
  <div class="form-group">
    <label class="form-label">Message</label>
    <textarea class="form-control" id="message-content"></textarea>
  </div>
  <button type="button" class="btn btn-primary" id="send-message">Send</button>
</div>

<?php
  echo $this->Html->script('create', array('block' => 'messagesScript')); 
  $this->Js->set('data', array('from_id' => $from_id));
  echo $this->Js->writeBuffer(array('onDomReady' => false));
?>