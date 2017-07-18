$(document).ready(function(){
	$("#jq-calendar").datepicker({
		maxDate: 0,
		dateFormat:'yy-mm-dd'
	});

	function showImage(src,target) {
	  var fr = new FileReader();
	 
	  fr.onload = function(e) { target.src = this.result; };

	  src.addEventListener("change",function() {
	    fr.readAsDataURL(src.files[0]);
	  });

	}

	var src = document.getElementById("upload-image");
	var target = document.getElementById("upload-target");
	showImage(src,target);
})