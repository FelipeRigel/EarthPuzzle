<?=$this->load->view('head_vista')?>
<meta name="title" content="The title of the link being shared"/>
<meta name="description" content="A description of the page"/>
  <body align="center">
	<div class="ui fluid form segment" style="background-color:rgba(192,192,192,.5)">
		<label><h1 style="color:white; text-align: center;">Earth-Puzzle</h1></label>	
		<div class="ui icon header">
		Your score is
		  <i class="circular icon"><?= $this->session->userdata("score")?></i>
		</div><br/>
	<a href="<?= base_url()?>index.php/score/restart" class="ui button red" style="text-decoration:none;" id="">Try again</a>
	<a href="#" id="share">
	<div style="background-color:#4c66a4" class="ui labeled icon button facebook">
          <i style="background-color:#4c66a4" class="icon facebook"></i>Share with facebook
        </div>
	</a>	
	<div class="ui twitter button" id="twitter">
		<i class="twitter icon"></i>
			Twitter
	</div>
		<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '1440835399494787',
			  status     : true,
			  xfbml      : true
			});
		  };

		  (function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		   $("#share").click(function(){
				FB.ui(
				  {
					method: 'feed',
					name: 'EarthPuzzle',
					link: "<?= base_url()?>index.php",
					caption: '<?= $this->session->userdata("nombre");?> has shared his score in EarthPuzzle',
					description: 'Score: <?= $this->session->userdata("score")?>'
				  },
				  function(response) {
				  }
				);
			});
		</script>


	<script>
	$("#twitter").click(function(){
					
		window.open('https://twitter.com/intent/tweet?hashtags=SPACEAPPSSINALOA%2CSpaceApps&original_referer=http%3A%2F%2Fearthpuzzle.azurewebsites.net%2Ftimtra%2Findex.php%2Fscore&text=You%20score%20is%3A%20<?= $this->session->userdata("score")?>!&tw_p=tweetbutton&url=http%3A%2F%2Fearthpuzzle.azurewebsites.net%2Ftimtra%2Findex.php%2Fscore','popup','width=500,height=400');
	});
		/*!function(d,s,id){
			var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){
				js=d.createElement(s);
				js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
				fjs.parentNode.insertBefore(js,fjs);
			}
		}(document, 'script', 'twitter-wjs');
	*/
	
	</script>
</body>
</html>