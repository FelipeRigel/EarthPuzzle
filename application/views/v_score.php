<?=$this->load->view('v_head')?>
<script type="text/javascript" src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>


<style>
body{
background: url("<?= base_url()?>assets/img/fondo.png");
background-color: cadetblue;
}

/*
@media only screen and (max-width: 990px){
	div.responsiva{
		max-width:600px !important;
			margin:auto !important;
	}
}
@media only screen and (max-width: 620px){
	div.responsiva{
		max-width:400px !important;
			margin:auto !important;
		
	}
}

@media only screen and (max-width: 420px){
	div.responsiva{
		max-width:200px !important;
			margin:auto !important;
		
	}
}*/


</style>	
	<body>
		<div class="container-fluid" style="">
			<div class="col-lg-3">
				
			</div>
			<div class="col-lg-6">
	        <div class="row" align="center">
	        	<div class="col-lg-3">&nbsp;</div>
	        	<div class="col-lg-6">
					<img class="img-responsive" height="" src="<?= base_url()?>assets/img/banner_small.png"/>
				</div>
				<div class="col-lg-3">&nbsp;</div>
			</div>
			<br><br>
			<form class="form" role="form" action="<?= base_url()?>index.php/welcome/start" method="post" onsubmit="" id="form_send" style="">
				<div class="row img-rounded" style="background-color:rgba(0,0,0,.5)">
					<br/>
					<div class="col-lg-3">&nbsp;</div>
					<div class="col-lg-6 text-center ">
							<h1  style="color:white;" class="">Your score is</h1>
							<h2  style="color:white;"><?= $this->session->userdata("score")?></h2>
					</div>
					<div class="col-lg-3"></div> 
				</div>
				<div class="row" style=" background-color:rgba(0,0,0,.5)">
					<div class="col-lg-3">&nbsp;</div>
					<div class="col-lg-6 text-center">
						<h1 style="color:white;"> 
							<?php
								//$this->session->set_userdata('score','200');
								$rating=0;
								if($this->session->userdata('score')>=0){
									if($this->session->userdata('score')<30){
										$rating=1;
										echo "<i class='glyphicon glyphicon-thumbs-down'></i> Try again";
									}else if($this->session->userdata('score')<90){
										$rating=2;
										echo "<i class='glyphicon glyphicon-asterisk'></i> Not bad,but keep trying";
									}else if($this->session->userdata('score')<140){
										$rating=3;
										echo "<i class='glyphicon glyphicon-thumbs-up'></i> Good.!";
									}else if($this->session->userdata('score')<200){
										$rating=4;
										echo "<i class='glyphicon glyphicon-star-empty'></i> Very good.!";
									}else{
										$rating=5;
										echo "<i class='glyphicon glyphicon-star-empty'></i> PERFECT!!! Congratulations!,You will never get lost in this planet";
									}
								}
							?>
						</h1>
					</div>
					<div class="col-lg-3">&nbsp;</div>
				</div>
				<div class="row" style=" background-color:rgba(0,0,0,.5)"><!--glyphicon glyphicon-star-->
					<div class="col-lg-3">&nbsp;</div>
					<div class="col-lg-6 text-center" style="font-size: 29pt;">
						<div id="rank" class="" style="color:#FFCB08;">
						</div>
					</div>
					<div class="col-lg-3">&nbsp;</div>
				</div>
				<div class="row img-rounded text-center" style=" background-color:rgba(0,0,0,.5)">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<a class="btn btn-danger" href="<?= base_url()?>index.php/score/restart" id="">Try again</a>
						<a id="twitter" class="btn btn-primary"><span class="fa fa-twitter"></span> Twitter</a>
						<a id="loginfb" style="" class="btn btn-primary"><span class="fa fa-facebook"></span> Share</a>
					</div>
					<div class="col-lg-3"></div>
				</div>
				<div class="row" style=" background-color:rgba(0,0,0,.5)">
					<div class="col-lg-3"></div>
					<div class="col-lg-6"><br/></div>
					<div class="col-lg-3"></div>
				</div>
			</form>
		</div>
		<div class="col-lg-3"></div>	
     </div>	
		<?if(isset($modal) and $modal==true){?>
			<style>
				#img1{
					cursor:pointer;
				}
			</style>
			<div class="modal fade" id="modal_response" tabindex="-1" role="dialog" aria-labelledby="modal_response" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?= ($correct==1)?"Correct!":"Incorrect!"?></h4>
				  </div>
				  <div class="modal-body">
						<div class="text-center row" style="text-align:center;">
							<?= "<img id='img1' class='img-responsive text-center' src='".$image->image."'/>"?><br/>
							<div data-latitude="<?= $image->latitude?>" data-length="<?= $image->length?>" class="btn btn-primary btn-sm" id="maps">
								View on Google Maps
							</div>
						</div>
						<div class="text-center row" id="anchor" >
							<?= html_entity_decode($image->description)?>
						</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
		<?}?>
		<div id="fb-root"></div>
		<script>
			$( document ).ready(function() {
				/*$('#rank').rating('set rating','<?=$rating?>');
				$('#rank').rating('disable');*/
				
				for(x=0;x<<?=$rating?>;x++){
					$("#rank").append('<i class="glyphicon glyphicon-star" ></i>');
				}
				for(x=<?=$rating?>;x<5;x++){
					
					$("#rank").append('<i class="glyphicon glyphicon-star-empty" ></i>');
				}
				
			<?php if(isset($modal) and $modal==true){?>
				$('#modal_response').modal("show");
				$("#img1").click(function(event) {
					window.open($(this).attr("src"));
				});
				$("#anchor").children("a").html("");
				$("#maps").click(function(){
					$(this).data("latitud");
					$(this).data("length");
					//document.location=;
					window.open("http://maps.google.com/maps?q="+$(this).data("latitude")+","+$(this).data("length"),"Search","width=600,height=500");
				});
			<?php }?>
				
				
			});
			
			
		
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
				FB.ui({
					method: 'feed',
					name: 'EarthPuzzle',
					link: "<?= base_url()?>index.php",
					caption: '<?= $this->session->userdata("name");?> has shared his score in EarthPuzzle',
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
		
		</script>
	</body>