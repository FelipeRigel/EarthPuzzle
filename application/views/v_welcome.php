<?=$this->load->view('v_head')?>
<script type="text/javascript" src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>


<style>
body{
background: url("<?= base_url()?>assets/img/fondo.png");
background-color:cadetblue;
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
		<div class="container-fluid">
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
	        <div class="row" align="center">
	        	<div class="col-md-3">&nbsp;</div>
	        	<div class="col-md-6">
					<img class="img-responsive" height="" src="<?= base_url()?>assets/img/banner_small.png"/>
				</div>
				<div class="col-md-3">&nbsp;</div>
			</div>
			<br><br>
			<form class="form" role="form" action="<?= base_url()?>index.php/welcome/start" method="post" onsubmit="" id="form_send" style="">
				<div class="row img-rounded" style="background-color:rgba(0,0,0,.5)">
					<br/>
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-6 ">
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input placeholder="Name" class="form-control" type="text" id="user_name" name="name" class="required" style="text-align:center"/>
						</div>
					</div>
					<div class="col-md-3"></div> 
				</div>
				<div class="row img-rounded" style=" background-color:rgba(0,0,0,.5)">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="form-group" >
							<button class="btn btn-danger pull-left" type="submit" id="begin" ><span class="glyphicon glyphicon-play"></span> Begin</button>
							<button id="loginfb" style="" class="btn btn-primary pull-right icon-large icon-facebook"><span class="fa fa-facebook"></span> Login with Facebook</button>
						</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php if(isset($error)){?>
				<div class="row" style="background-color:rgba(0,0,0,.5)">
					<br/>
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-6 alert alert-dismissable alert-danger">
						<strong>We need a username to begin.</strong>
					</div>
					<div class="col-lg-3"></div> 
				</div>
				<?php }?>
				<div class="row img-rounded" style=" background-color:rgba(0,0,0,.5)">
					<br/>
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-6" style="">
						<div class="table-responsive img-rounded">
							<table style="background-color:white;" class="table table-hovers table-bordered table-striped tablesorter">
								<thead>
									<th>User</th>
									<th class="">Ranking</th>
									<th class="">Score</th>
								</thead>
								<tbody>
								<?php
									$i=0;
									foreach($ranking as $rank){
										$i++;?>
											<tr>
												<td style="background-color:white;"><?=$rank->user?></td>
												<td><?=$i?></td>
												<td><?=$rank->score?></td>
											</tr>
										<?php
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-3">&nbsp;</div>
				</div>			
				
				<!--
				<div class="ui warning form segment responsiva" style=" background-color:rgba(0,0,0,.5)">
					<div id="image_container"></div>
					<div class="ui page three column grid">
						<div class="column"></div>
						<div class="column "><div class="ui button fluid" style="margin:auto" onclick='change_img()'>Load random image</div></div>
						<div class="column"></div>
					</div>			
				</div>	
				-->
				
			</form>
		</div>
		<div class="col-md-3"></div>
     	</div>	
		<div id="fb-root"></div>
		<script>
			function change_img(){
				$.ajax({
					type:"POST",
					url: '<?=base_url()?>index.php/welcome/img_random',
					async:false,
					success:function(response){
					   $("#image_container").html(response);
					}						
				});
			}
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '1440835399494787',
					status     : true, // check login status
					cookie     : true, // enable cookies to allow the server to access the session
					xfbml      : true  // parse XFBML
				});			
				// Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
				// for any authentication related change, such as login, logout or session refresh. This means that
				// whenever someone who was previously logged out tries to log in again, the correct case below 
				// will be handled. 
				FB.Event.subscribe('auth.authResponseChange', function(response) {
					if (response.status === 'connected') {
						testAPI();
					} else if (response.status === 'not_authorized') {
						FB.login();
					} else {
						FB.login();
					}
				});
			};
			$("#loginfb").click(function(){
				FB.login(function(response) {});
			});
			// Load the SDK asynchronously
			(function(d){
				var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement('script'); js.id = id; js.async = true;
				js.src = "//connect.facebook.net/en_US/all.js";
				ref.parentNode.insertBefore(js, ref);
			}(document));		
			// Here we run a very simple test of the Graph API after login is successful. 
			// This testAPI() function is only called in those cases. 
			function testAPI() {
				//console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
					console.log('Good to see you, ' + response.name + '.');
					$.ajax({
						url:"<?= base_url()?>index.php/welcome/login_fb",
						data:"user_name="+response.name+"&f_id="+response.username,
						type:"POST",
						async:false,
						success:function(){
							FB.api("/me/picture?width=180&height=180",  function(response_2) {
								$.ajax({
									url:"<?= base_url()?>index.php/welcome/setimage",
									data:"image="+response_2.data.url,
									type:"POST",
									async:false,
									success:function(){
										location.replace("<?= base_url()?>index.php/welcome/");
									}
								});
							}); 
						}
					});
				});
			}

		</script>
	</body>