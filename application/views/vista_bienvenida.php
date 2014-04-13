<?=$this->load->view('head_vista')?>
	<body>
		<div class="ui fluid form segment" style=" background-color:#4086AA; margin:auto;width:600px;">
	        <div class="field" align="center">
				<label><!--
					<h1 style="color:white; text-align: center;">
						Earth Puzzle
					</h1>-->
					<img class="ui medium image" height="" src="<?= base_url()?>assets/img/earthpuzzlelogo.png"/>
				</label>
			</div>
     	</div>	
		<br><br>
		<form action="<?= base_url()?>index.php/welcome/iniciar" method="post" onsubmit="" id="form_enviar" style="margin:auto;width:600px; ">
			<div class="ui fluid form segment" style=" background-color:rgba(0,0,0,.5)">
				<div class="ui one field">
					<div style="text-align: center">
						<div class="field">
							<input placeholder="Name" type="text" id="nombre" , name="nombre" class="required" style="text-align:center"/>
						</div>
					</div>	
				</div> 
			</div>
			<div class="ui warning form segment" style="background-color:gray">
				<div class="two fields">
					<div class="field">
						<div style="text-align: center">
							<button class="ui red submit button labeled" type="submit" id="empezar" style="text-align: center">
								<i class=" smile icon medium"></i> Begin
							</button>
						</div>
					</div>
					<div class="field">
						<div style="text-align: center">
							<div style="background-color:#4c66a4; text-align: center" id="loginfb" class="ui labeled icon button facebook">
								<i style="background-color:#4c66a4" class="icon facebook"></i>Login
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ui warning form segment" style="background-color:gray">
				<div id="contenedor_imagen"></div>
			<div class="ui page three column grid">
			<div class="column"></div>
			<div class="column "><div class="ui button fluid" style="margin:auto" onclick='cambiar_img()'>Load random image</div></div>
			<div class="column"></div>
		</div>
			
			</div>
			
		</form>
		<div id="fb-root"></div>
		<script>
			function cambiar_img(){
			$.ajax({
						type:"POST",
						url: '<?=base_url()?>index.php/welcome/img_random',
						async:false,
						success:function(response){
						   $("#contenedor_imagen").html(response);
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
				data:"nombre="+response.name,
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