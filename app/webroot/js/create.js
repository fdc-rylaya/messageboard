var data = [];
var root = location.protocol + '//' + location.host;

//get recipients for data
$.ajax({
    url: root + '/users',
  cache: false
}).done(function( value ) {
	value = JSON.parse(value);
	var data = [];
	for(var x = 0; x < value.length; x++){
		data.push({'id': value[x].id,'text': value[x].name, 'image' : value[x].image});
	}
	$(".search-recipients").select2({
		data: data,
	  	templateResult: userStyle,
	  	templateSelection: userStyle
	});
});

function userStyle(selection) {
    if (!selection.id) { return selection.text; }
    var $selection = $(
      '<img src="' + root + '/img/' + selection.image  + '" class="img-responsive" style="width:50px; display:inline-block; margin-right:15px;"> ' + 
      '<span style=""color:black;>'+ selection.text +'</span>'
    );
    return $selection;
};

$("#send-message").on('click',function(){
	$.ajax({
    type: 'POST',
    url: root + '/messages/send',
    data:{
      'to_id' : $("#recipient-id").val(),
      'from_id' : window.app.data.from_id,
      'content' : $("#message-content").val()
    }
  }).done(function( value ) {
  	value = JSON.parse(value);
    
  	if(value.status == 'success') {
  		window.location.href = root + '/messages/view/'+ $("#recipient-id").val()
  	}
  });
});