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

<div class="chat-box col-md-12 fb-msg">
    <div class="row">
        <div class="chat-control col-md-7 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading"> 
                    <h3><?php echo $toUser['User']['name']; ?> </h3>
                    <span class="label label-success">Typically replies after an hour...</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <input type="text" placeholder="Search conversation"  class="pull-right search" id="search">
                        </div>
                    </div>
                    <textarea class="" id="message-content" placeholder="Hello..."></textarea>
                    <button id="send-reply" class="btn btn-primary">Reply Message</button>
                    <div class="row chat-convo" id="messages-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	$this->Js->set('data', array('to_id' => $to_id,'from_id' => $from_id, 'last_id' => $last_id));
	echo $this->Html->script('messages', array('block' => 'messagesScript')); 
	echo $this->Js->writeBuffer(array('onDomReady' => false));
	
?>