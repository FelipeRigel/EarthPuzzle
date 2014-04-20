<?= $this->load->view('v_head')?>
<? $this->load->library("session");?>
<style>
	div.ui.checkbox.radio{
		display: block;
		width: 100%;
	}
	label{
		display: block;
		width: 100%;
	}
.ho:hover{
		background-color:white !important; 
		color:black !important;
	}
	.btn_hint{
	max-width:70px;
	max-height:50px;
	}
	.btn_hint:hover{
	max-width:70px;
	cursor:pointer;W
	}
	#map_canvas {
		width: 100%;
		height: 328px;
	}#map_canvas1 {
		height: 328px;
		width: 100%;
	}
</style>
 <noscript>
 	<style>
		body{
			display: block;
		} 
 	</style>
 </noscript>
 	<script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script> 
	<script type="text/javascript">
		
	
	
	</script>
		<!--<div class="ui fluid form segment" style=" background-color:#4086AA;display:none">
			<div class="ui three fields">
				<div class="field">&nbsp;
				</div>
				<div class="field" align="center">
					<label><!--
						<h1 style="color:white; text-align: center;">
							Earth Puzzle
						</h1>-d->
						<img class="ui medium image" height="" src="<?= base_url()?>assets/img/earthpuzzlelogo.png"/>
					</label>
				</div>
			</div>
		</div>-->
		<nav class="navbar navbar-inverse" role="navigation">  
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand"><span class="glyphicon glyphicon-star-empty"></span>&nbsp;&nbsp;Score : <?= (empty($score))?"0":$score?></a>
			    </div>
			    <div class="navbar-header">
					<a class="navbar-brand"><span class="glyphicon glyphicon-star-empty"></span>&nbsp;&nbsp;Points : <span id='points' data-set1='0' data-set2='0'>10</span></a>
			    </div>
			    <div class="navbar-header">
				    <a class="navbar-brand"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Question # <?= $this->session->userdata("questions_num")+1?></i>			
			    </div>
			    <div class="navbar-header" id="logout" style="float:right">
					<?if($this->session->userdata("image")==""){?>
						<span class="glyphicon glyphicon-log-out"></span>
					<?}else{?>
						<i class="ban small">
							<img class="ui avatar image" height="" src="<?= $this->session->userdata("image");?>"/>
						</i>
					<?}?>									
					<a class="navbar-brand">Logout <?= $this->session->userdata("name")?></a>
			   </div>
			</div>  
		</nav>
		<script type="text/javascript">$('.ui.sidebar')
		  .sidebar("toggle")
		;
		</script>
		<form class="form" method="POST">
			<div class="container-fluid" style="background-color:rgba(192,192,192,.5); margin:10px">
				<div class="row">
					<div class="row">
						<div class="col-xs-6 col-sm-4">
							<div ><img src='<?=base_url()?>assets/img/wohint1.png' id='btn_hint' class='btn_hint'></img></div>
						</div>
						<div class="col-xs-6 col-md-4 img-responsive text-center">
							<? foreach($correct_question as $item){
								if($item->answer==1){?>
									<img class="img-responsive" src="<?= $item->image?>">
									<!--<input type="hidden" name="question" value="<?=  md5($item->id)?>" />-->	
									<? $this->session->set_userdata("quest", md5($item->id))?>
								<?}
							}?>
						</div>
						<div class="col-xs-6 col-sm-4">
							<div><br><img src='<?=base_url()?>assets/img/wohint2.png' id='btn_hint2' class='btn_hint'></img></div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center img-responsive">
							<!--<iframe style="width:100%;height:350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14666.085180701442!2d-106.42260437879115!3d23.224110078699912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1397697908091" ></iframe>-->
						 	<div id="map_canvas" class="img-responsive text-center"></div>
							<div id="map_canvas1" style="display:none"></div>
						</div>
						
					</div>				
					<!--<div class="ui button red small" id="btn_hint">Hint1</div>-->
					<!--<i class="puzzle piece icon" id="btn_hint">Hint1</i>-->
					<div class="row" style="display:none">
						
						
					</div>
					<div class="modal fade" id="hints">
						<div class="modal-dialog" style="background-color:white">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Information Hint</h4>
							</div>
							<div class="modal-body">
								<?php if($hints){foreach($hints as $item):?>
									<div class="row">
										<div class="col-xs-6 col-md-4">
											<img class="uimg-responsive" title="" src="<?= $item->image?>" width="100" height="100"/><br/>
										</div>
										<div class="col-xs-12 col-md-8">
											<p><?= $item->hint?></p>
										</div>
									</div>
								<?php endforeach;}else if(isset($images)){?>
									<div class="row" align="center">
										<div class="row">			
											<div class="col-xs-6 col-md-4"> 
												<?=$images[0]?>
												<?=$images[1]?>
											</div>	
											<div class="col-xs-6 col-md-4"> 
												<?=$images[2]?>
												<?=$images[3]?>
											</div>	
										</div>
										<a href="<?= base_url()?>index.php/question" class="btn btn-primary">Not yet? Try another image</a>
									</div>
								<?php }?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
					<script>
						$(function(){
							$("#btn_hint").click(function(){
								$('#hints').modal("show",function(){
									$(this).css("top",0);
									$(this).css("position","fixed");
								});
									$.ajax({
										url: "<?= base_url()?>index.php/question/restar_puntos",
										type:'POST',
										data: "hint=1",
										success:function(){
										if($('#points').data('set1')=='0'){
											$('#points').html($('#points').html()-3);
											$('#points').data('set1','1');		
										}
											
										}
									})
							});
								$("#btn_hint2").click(function(){
									$.ajax({
										url: "<?= base_url()?>index.php/question/restar_puntos",
										type:'POST',
										data: "hint=2",
										success:function(){
										if($('#points').data('set2')=='0'){
											$('#points').html($('#points').html()-3);
											$('#points').data('set2','1');		
										}
											
										}
									})
							});
						});
					</script>
				</div>
				<? if(isset($images)){?>
				
					<div style="text-align: center;display:none"><a id="openReference" onsubmit="return false;" class="ui red button">
						<i class="globe icon small">
							</i>You don´t know? Click here!</a>
					</div>
				<?}?>
			</div><br><br>
			<div class="img-responsive" style=" background-color:rgba(0,0,0,.5)">
				<label >
					<h2 style="color:white; text-align: center;">Where is this?</h2>
				</label>     
				<div class="row" style="margin:10px">
					<div class="row">
						<div class="col-xs-6" href="#">
							<div class="input-group"> 
								<span class="input-group-addon">
									<input type="radio"  id="resp1" name="answer" value="<?= md5($correct_question[0]->id_place)?>" />
								</span>
								<label for="resp1" href="#" class="navbar-link form-control"><?=$correct_question[0]->place;?></label>
							</div>
						</div> 
						<div class="col-xs-6" href="#">
							<div class="input-group">  
								<span class="input-group-addon">
									<input type="radio"  id="resp2" name="answer" value="<?= md5($correct_question[1]->id_place)?>" />
								</span>
								<label  for="resp2" href="#" class="navbar-link form-control"><?=$correct_question[1]->place;?></label>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-xs-6" href="#">
							<div class="input-group" >
								<span class="input-group-addon">
									<input type="radio"  id="resp3" name="answer" value="<?=md5($correct_question[2]->id_place)?>" />
								</span>
								<label  for="resp3" href="#" class="navbar-link form-control"><?=$correct_question[2]->place;?></label>
							</div>
						</div>
						<div class="col-xs-6" href="#">
							<div class="input-group"> 
								<span class="input-group-addon">
									<input type="radio"  id="resp4" name="answer" value="<?= md5($correct_question[3]->id_place)?>" />
								</span>
								<label  for="resp4" href="#" class="navbar-link form-control"><?=$correct_question[3]->place;?></label>
							</div>
						</div>
					</div>		
				</div>				  
				<!--<div class="ui two column grid">
							  
				</div>-->
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
						<button type="button" class="btn btn-default btn-lg">
						  	<span class="glyphicon glyphicon-record"></span> Submit
						</button>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
				</div>
			</div>
		</form>
		<? if(isset($images)){?>
			<div class="ui modal" id="references">
				<i class="close icon"></i>
				<div class="header">
					Images references
				</div>
				<div class="content" align="center">
					<div class="ui two columns">			
						<div class="column"> 
							<?=$images[0]?>
							<?=$images[1]?>
						</div>	
						<div class="column"> 
							<?=$images[2]?>
							<?=$images[3]?>
						</div>	
					</div>
					<a href="<?= base_url()?>index.php/question" class="ui button blue">Not yet? Try another image</a>
				</div>
				<div class="actions">
					<div class="ui button">Close</div>
				</div>
			</div>
		<?}?>
		<?if(isset($modal) and $modal==true){?>
			<style>
				#img1{
					cursor:pointer;
				}
			</style>
			<div class="ui  modal" id="modal_response">
				<i class="close icon"></i>
				<div class="header">
					<?= ($correct==1)?"Correct!":"Incorrect!"?>					
				</div>
				<div class="content">
					<div class="center">
						<?= "<img id='img1' class='ui huge image' src='".$image->image."'/>"?><br/>
						<div data-latitude="<?= $image->latitude?>" data-length="<?= $image->length?>" class="mini ui button" id="maps">
							View on Google Maps
						</div>
					</div>
					<div class="right" id="anchor">
						<?= html_entity_decode($image->description)?>
					</div>
				</div>
				<div class="actions">
					<div class="ui button">Close</div>
					
				</div>
			</div>
		<?}?>
		<script>
			var geocoder;
		function initialize() {
			var styleOff = [{ visibility: 'off' }];
			var stylez = [
				{   
					featureType: 'administrative',
					elementType: 'labels',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.province',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.locality',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.neighborhood',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.land_parcel',
					stylers: styleOff
				},
				{   
					featureType: 'poi',
					stylers: styleOff
				},
				{   
					featureType: 'landscape',
					stylers: styleOff
				},
				{  
					featureType: 'road',
					stylers: styleOff
				}
			];
			geocoder = new google.maps.Geocoder();
			var mapDiv = document.getElementById('map_canvas');
			var map = new google.maps.Map(mapDiv, {
				<? foreach($correct_question as $item){
					if($item->answer==1){?>
						center: new google.maps.LatLng(<?= trim($item->latitude)?>,<?= trim($item->length)?>),
					<?}
				}?>
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				draggableCursor: 'pointer',
				draggingCursor: 'pointer',
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI:true,
				disableDoubleClickZoom:true,
				draggable:false,
				mapTypeControl: false,
				mapTypeControlOptions: {
					mapTypeIds: ['Border View']
				}
			});
			var customMapType = new google.maps.StyledMapType(stylez,{name: 'Border View'});
			map.mapTypes.set('Border View', customMapType);
			marker = new google.maps.Marker({
				<? foreach($correct_question as $item){
					if($item->answer==1){?>
						position: new google.maps.LatLng(<?= trim($item->latitude)?>,<?= trim($item->length)?>),
					<?}
				}?>
				map: map
			});
		}
		var geocoder1;
		var map1;
		function initialize1() {
			var styleOff = [{ visibility: 'off' }];
			var stylez = [
				{   
					featureType: 'administrative',
					elementType: 'labels',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.province',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.locality',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.neighborhood',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.land_parcel',
					stylers: styleOff
				},
				{   
					featureType: 'poi',
					stylers: styleOff
				},
				{   
					featureType: 'landscape',
					stylers: styleOff
				},
				{  
					featureType: 'road',
					stylers: styleOff
				}
			];
			geocoder1 = new google.maps.Geocoder();
			var mapDiv1 = document.getElementById('map_canvas1');
			map1 = new google.maps.Map(mapDiv1, {
				<? foreach($correct_question as $item){
					if($item->answer==1){?>
						center: new google.maps.LatLng(<?= trim($item->latitude)?>,<?= trim($item->length)?>),
					<?}
				}?>
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				draggableCursor: 'pointer',
				draggingCursor: 'pointer',				
				mapTypeControlOptions: {
					mapTypeIds: ['Border View']
				}
			});
			stylez = [
				/*{   
					featureType: 'administrative',
					elementType: 'labels',
					stylers: styleOff
				},*/
				{   
					featureType: 'administrative.province',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.locality',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.neighborhood',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.land_parcel',
					stylers: styleOff
				},
				{   
					featureType: 'poi',
					stylers: styleOff
				},
				/*{   
					featureType: 'landscape',
					stylers: styleOff
				},*/
				{  
					featureType: 'road',
					stylers: styleOff
				}
			];
			var customMapType = new google.maps.StyledMapType(stylez,{name: 'Border View'});
			map1.mapTypes.set('Border View', customMapType);
			marker = new google.maps.Marker({
				<? foreach($correct_question as $item){
					if($item->answer==1){?>
						position: new google.maps.LatLng(<?= trim($item->latitude)?>,<?= trim($item->length)?>),
					<?}
				}?>
				map: map1
			});
		}
			$("body").css("display","none");
			$("body").fadeIn("slow");
			$(document).ready(function(){
				google.maps.event.addDomListener(window, 'load', initialize);
				google.maps.event.addDomListener(window, 'load', initialize1);			

				$("#btn_hint2").click(function(){
					$("#map_canvas").css("display","none");
					$("#map_canvas1").css("display","block");
					google.maps.event.trigger(map1, 'resize');
				});
				$("#openReference").click(function(){
					$('#references').modal("show",function(){
						$(this).css("top",0);
						$(this).css("position","fixed");
					});		
				});
				$('.ui.selection.dropdown').dropdown();
			});
			<?if(isset($modal) and $modal==true){?>
			$(function(){
				$('#modal_response').modal("show",function(){
					$(this).css("top",0);
					$(this).parent().css("position","fixed");
					$(this).css("position","fixed");
				});
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
			});
			<?}?>		
			$("form").submit(function(){			
				if(!$("input[name=answer]").is(':checked')){
					alert("Select an answer please");
					return false;
				}else{
					$("body").fadeOut('slow');
					return true;
				}				
			})
			$("#logout").click(function(){
				$.ajax({
					type:"POST",
					async:false,
					url:"<?= base_url()?>index.php/question/logout",
					success:function(){
						window.location.href="<?= base_url()?>index.php/welcome";
					}
				});
			});
			$("#categoria").change(function(){
			});
			$("image").error(function(){
				$(this).attr("src","<?= base_url()?>assets/img/earthpuzzlelogo.png");
			});
		</script>
  </body>
</html>