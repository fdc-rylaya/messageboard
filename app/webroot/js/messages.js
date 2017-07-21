var root = location.protocol + '//' + location.host, messageIds = [];

//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms (5 seconds)



$('body').on('click','.next',function(e) {
  $.ajax({
    url: $(this).attr('href'),
    cache: false
  }).done(function( html ) {
    $("#messages-container").find('.next').remove();
    $("#messages-container").append(html);
    $("#messages-container").find('span.next').remove();
    console.log(html)
  });

	e.preventDefault();
});

$("#send-reply").on('click',function(){
  $.ajax({
        type: 'POST',
        url: root + '/messages/add',
        data:{
          'to_id' : window.app.data.to_id,
          'from_id' : window.app.data.from_id,
          'content' : $("#message-content").val()
        }
      }).done(function( html ) {
        $("#messages-container").prepend(html).fadeIn('slow'); 
        $("#message-content").val('')       
        //console.log(html)
      });
});

// setInterval(function(){ 
//   $.ajax({
//     url: root + '/messages/latest',
//     data: {
//       'to_id' :  window.app.data.to_id,
//       'last_id' : window.app.data.last_id
//     },
//     type:'post',
//     cache: false
//   }).done(function( html ) {
//     $("#messages-container").prepend(html);
//     //console.log(html)
//   });
// }, 1000);


//on keyup, start the countdown
$('#search').keyup(function(){
    clearTimeout(typingTimer);
    if ($('#search').val()) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    }
});

//user is "finished typing," do something
function doneTyping () {
  $.ajax({
    url: root + '/messages/search',
    cache: false,
    data: {
      'search': $('#search').val(),
      'to_id' : window.app.data.to_id
    },
    type: 'post'
  }).done(function( html ) {
    $("#messages-container").html(html);
    $("#messages-container").find('span.next').remove();
    $("#messages-container").find('.next').remove();
    
  });
}

$("body").on('click','.remove',function(){
    var that = this;

    swal({
      title: "Delete Message?",
      text: "Are you sure you want to delete?",
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
    },
    function(){
      $.ajax({
      type: 'POST',
      url: root + '/messages/delete/' + $(that).attr('msg-id')
      }).done(function( value ) {
        value = JSON.parse(value);

        if(value.status == 'success'){
          $(that).parent().parent().parent().parent().fadeOut(500);
          swal("Success!","Message deleted",'success');
        }
      });
    });

    
  });

$.ajax({
    url: root + '/messages/fetchMessages/'+ window.app.data.to_id,
  cache: false
}).done(function( html ) {
  $("#messages-container").find('.next').remove();
  $("#messages-container").append(html);
  $("#messages-container").find('span.next').remove();
});