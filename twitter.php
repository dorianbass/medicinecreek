<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	twitter.php																				*/
/* 	Custom twitter widget that displays the most recent 3 tweets from medicinecreek in a 	*/
/*	text box. 																				*/
/********************************************************************************************/

?>

<h2>Twitter:</h2>
					
<div class="text-box">
					
	<a class="twitter-timeline" width="100%" href="https://twitter.com/medicinecreek1" data-chrome="noheader nofooter noborders noscrollbar"
		data-tweet-limit="3" data-widget-id="357867084262285312">Tweets by @medicinecreek1</a>
				
	<script>
		!function(d,s,id){
			var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){
				js=d.createElement(s);
				js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
				}
			}
		(document,"script","twitter-wjs");
	</script>

</div>