
console.log(window.app.data)
//$(document).ready(function(){
	
	var websocket = new WebSocket("ws://localhost:8181/server.php");
	var root = location.protocol + '//' + location.host
	 //Connected to server
	websocket.onopen = function(ev) {
		$("#status").html('Connected to server');
		$("#status").removeClass('label-danger');
		$("#status").addClass('label-success');
	    console.log('Connected to server ');
	}

	//Connection close
	websocket.onclose = function(ev) { 
	    console.log('Disconnected');
	};

	//Message Receved
	websocket.onmessage = function(ev) { 
		var data;
		if(typeof ev.data === 'string'){
			ev.data = JSON.parse(ev.data);
			resultData = JSON.parse(ev.data);
		}

		console.log(resultData);
		if(resultData.type == 'usermsg' && resultData.message != null)
		{
			console.log(resultData);
			var html = '';
			if(resultData.from_id == window.app.data.from.id)	{
				html = '<div class="row">' + 
					'<div class="chat-msg-container">' +
						'<div class="pull-right chat-msg from">'+
							'<div class="row">'+
								'<div class="col-md-12">'+
									'<a href="#" class="remove" msg-id="">X</a>'+
								'</div>'+
							'</div>'+
							'<p>'+resultData.message+'</p>'+
						'</div>'+
						'<div class="clear"></div>'+
						'<p class="time from"><i>'+ window.app.data.messageCreated +'</i></p>'+
						'<a href="/users/profile" class="from"><img src="'+root+'/img/'+window.app.data.from.image+'" class="img-responsive img-circle"></a>'+
					'</div>'+
				'</div>';
			}
			else {
				html = '<div class="row">' + 
					'<div class="chat-msg-container">' +
						'<div class="pull-left chat-msg to">'+
							'<div class="row">'+
								'<div class="col-md-12">'+
									'<a href="#" class="remove" msg-id="">X</a>'+
								'</div>'+
							'</div>'+
							'<p>'+resultData.message+'</p>'+
						'</div>'+
						'<div class="clear"></div>'+
						'<p class="time to"><i>'+window.app.data.messageCreated+'</i></p>'+
						'<a href="/users/view/'+window.app.data.to.id+'" class="to"><img src="'+ root+'/img/'+window.app.data.to.image+'" class="img-responsive img-circle"></a>'+
					'</div>'+
				'</div>';
			}

			$("#messages-container").prepend(html)
		}
	};

	//Error
	websocket.onerror = function(ev) { 
	    console.log('Error '+ev.data);
	};

	 //Send a Message
	$('#send-reply').click(function(){ 

		var msg = {
			message: $('#message-content').val(),
			from : window.app.data.from_id,
			to: window.app.data.to_id
		};

	
	    websocket.send(JSON.stringify(msg));
	});
//});
