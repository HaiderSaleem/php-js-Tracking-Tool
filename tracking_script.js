	$(document).ready(function() {
		var scrollTop;
		var text;
			$(document).scroll(function(event){

		var scrollLeft = (window.pageXOffset !== undefined) ? window.pageXOffset : (document.documentElement || document.body.parentNode || document.body).scrollLeft;
scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;

		$("#none1").load("scroll.php", {
				scroll: scrollTop
			});

    	
});

		$(document).click(function(event) {
    text = $(event.target).text();
    if(text!="")
    {
    	$("#none1").load("text.php", {
				text: text
			});
    	
    }
});

	
	
	
  var start = new Date();
  var sh=start.getHours();
  var sm=start.getMinutes();
  var ss=start.getSeconds();
/*alert("time: "+ );*/

  $(window).on("beforeunload", function(e) {
      var end = new Date();
      var eh=end.getHours();
  	  var em=end.getMinutes();
  	  var es=end.getSeconds();
  	    eh= parseInt(eh)-parseInt(sh);
  	    em= parseInt(em)-parseInt(sm);
  	    es= parseInt(es)-parseInt(ss);

       
     
    $("#none1").load("log.php", {
				em: em,
				es:es
			});


   });
   var keyCode="";
	$(document).keypress(function(e) {
    keyCode+= String.fromCharCode(e.keyCode);
    
    if(keyCode.length>3)
    {
    $("#none1").load("text.php", {
				enter: keyCode
			});
   		alert(keyCode);
   	}
    });
});
