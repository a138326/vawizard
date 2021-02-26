<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    

    	
    
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 

    		 // User
    		  $('#userText').keyup(function(e) {				 
    			  if (e.keyCode == 13) { 
    			 	 var text = $(this).val();
		    		 name = "bubble-user";
					 chat.send(text, name);
		    		 $(this).val("");
					}
             });
    		 
			$("#userSubmit").click(function() {
				if  ($("#userText").val())  {
					console.log('your message');
					var text = $("#userText").val();
					name = "bubble-user";
					chat.send(text, name);
					$("#userText").val("");
				}
			});
			
			
			// Agent
			$('#agentText').keyup(function(e) {			 
    			  if (e.keyCode == 13) { 
    			 	 var text = $(this).val();
		    		 name = "bubble-agent";
					 chat.send(text, name);
		    		 $(this).val("");
					}
             });
             
			$("#agentSubmit").click(function() {
				if  ($("#agentText").val())  {
					var text = $("#agentText").val();
					name = "bubble-agent";
					chat.send(text, name);
					$("#agentText").val("");
				}
			});
			
			
			// Quick Reply – Post
			$('#agentQr').keyup(function(e) {			 
    			  if (e.keyCode == 13) { 
    			 	 var text = $(this).val();
		    		 name = "quick-reply";
					 chat.send(text, name);
		    		 $(this).val("");
					}
             });
             
             
             // Quick reply
			 $(document).on('click','.quick-reply',function(){
			 	console.log("Quick Reply – clicked");			 	
			 	var text = $(this).text();
			 	$(".quick-reply").remove();
				name = "bubble-user";
				chat.send(text, name);
			 })

             
			// Action board
						
			var Payment_1A = {
				'Title' : 'Payment',				
				'Agent' :	'I can help with the following payments',
				'QuickReplies' :	["Extend", "Pay now", "Talk to an agent"]	
			}	
			
			
			$(document).on('click','#Payment',function(){
				text = Payment_1A.Agent;
				name = "bubble-agent";
				chat.send(text, name);
				
				$.each( Payment_1A.QuickReplies, function( i, val ) {
					text = Payment_1A.QuickReplies[i];
					name = "quick-reply";
					chat.send(text, name);
				});
			});
			
			
			function showPreReply(preReply) {
				console.log(preReply);
				$( "#pre-reply" ).after( "<input type='button' value='Post reply + Qrs' id='" + preReply.Title + "'>" );
				$.each( preReply.QuickReplies, function( i, val ) {
					$( "#pre-reply" ).after( "<p" + " class='reply-qr quick-reply' " + ">" + preReply.QuickReplies[i] + "</p>" );
				});
				$( "#pre-reply" ).after( "<p" + " class='reply-agent' " + ">" + preReply.Agent + "</p>" );
				$( "#pre-reply" ).after( "<h3" + " class='reply-title' " + ">" + preReply.Title + "</h3>" );
			}
			
			showPreReply(Payment_1A);
			
			
            
    	});
    </script>
    
    <style>
	  .user-input {display: none;}  
	    </style>

</head>

<body onload="setInterval('chat.update()', 1000)">
	
	<div class="wrapper">
	    <h2 style="color: fuchsia">Agent</h2>
	    <div class="window">
	        <div id="chat-area">
		        <div id="window-footer"></div>
	        </div>
	    </div>
        
        <form class="user-input">
	        <p>User</p>
            <textarea  type="text" name="userText" placeholder="message" id="userText" ></textarea>
            <input type="button" value="Submit" id="userSubmit">
        </form>
        
        <div class="agent-input">
			<p>Agent</p>
			<textarea type="text" name="agentText" placeholder="message" id="agentText" ></textarea>
			<textarea type="text" name="agentQr" placeholder="quick reply"  id="agentQr" ></textarea>
			<input type="button" value="Submit" id="agentSubmit">
		</div>
        
        
    		<div id="pre-reply"> 
	    	<h2> Pre-canned</h2>
		</div>
    
    </div>

</body>

</html>