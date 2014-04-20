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
	}#map_canvas1 {
		height: 328px;
		width: 100%;
	}
	.asd{
		width:100%;
	}
	.btn-primary:hover{
		background-color:#194368 !important;
	}
	.activ{
			background-color:white;
	}
body{
background: url("<?= base_url()?>assets/img/fondo.png");
background-color:cadetblue;
}
</style>
 	<script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script> 
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
		</div>navbar-fixed-top-->
    <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand img-responsive" src='<?=base_url()?>assets/img/earthpuzzlelogo.png'></img><a href="#" class="navbar-brand">Earth Puzzle</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">					
					<li class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
						<a><span class="glyphicon glyphicon-star-empty"></span>&nbsp;&nbsp;Score : <?= (empty($score))?"0":$score?></a>
					</li>
					<li class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
						<a ><span class="glyphicon glyphicon-star-empty"></span>&nbsp;&nbsp;Points : <span id='points' data-set1='0' data-set2='0'>10</span></a>
					</li>
					<li class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
						<a ><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Question # <?= $this->session->userdata("questions_num")+1?></i>	</a>	
				   </li>
					<li class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." style="cursor:pointer;" id='btn_hint'>					
						<a ><i><span class="glyphicon glyphicon-heart-empty"></span>&nbsp;&nbsp;Get Hint 1</i>	</a>	
				   </li>
					<li class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." style="cursor:pointer;" id='btn_hint2' >					
						<a ><i><span  class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;Get Hint 2</i>	</a>	
				   </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
				   <li  id="logout" class="hover_instruct" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">									
						<a href="#">
						<?if($this->session->userdata("image")==""){?>
							<span class="glyphicon glyphicon-log-out"></span>
						<?}else{?>
							<i class="ban small">
								<img class="ui avatar image" height="" src="<?= $this->session->userdata("image");?>"/>
							</i>
						<?}?>Logout <?= $this->session->userdata("name")?></a>
				   </li>
            </ul>
        </div>
    </nav>
	<div class="container">
	
		<form class="form" method="POST">
				<div class="row">
				<br/><br/>
				</div>
			<style>
			</style>
			<div class="jumbotron"   style="background-color:rgba(0,0,0,.5);margin-top:15px;">
				<div class="row">			
					<div class="col-xs-12 col-sm-12 text-center img-responsive">
						<!--<iframe style="width:100%;height:350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14666.085180701442!2d-106.42260437879115!3d23.224110078699912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1397697908091" ></iframe>-->
						<div id="map_canvas" >
						<? foreach($correct_question as $item){
							if($item->answer==1){?>
								<img style="position:absolute;bottom:0;" id="img_satellite" class="img-responsive img-rounded" src="<?= $item->image?>">
								<!--<input type="hidden" name="question" value="<?=  md5($item->id)?>" />-->	
								<img style="width:100%;height:100%;" id="img_map" class="img-responsive img-rounded" src="http://maps.googleapis.com/maps/api/staticmap?province=false&center=<?= trim($item->latitude)?>,<?= trim($item->length)?>&zoom=4&size=600x400&sensor=false&maptype=satellite">
								<? $this->session->set_userdata("quest", md5($item->id))?>
								<!--markers=color:red%7Clabel=G%7C<?= trim($item->latitude)?>,<?= trim($item->length)?>-->
							<?}
						}?>		
						</div>
						<div id="map_canvas1" style="display:none;"></div>
					</div>					
				<script>
					$(function(){
					$("#img_satellite").css("width",($("#img_map").width()/4)+"px");
						$( window ).resize(function() {
						  $("#img_satellite").css("width",($("#img_map").width()/4)+"px");

						});
					});
				</script>
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
										<!--
										<a href="<?= base_url()?>index.php/question" class="btn btn-primary">Not yet? Try another image</a>
										-->
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
			</div>
			<div class="img-responsive img-rounded text-center" style=" background-color:rgba(0,0,0,.5)">
				<div class="row">
					<h2 style="color:white; text-align: center;">Where is this?</h2>
				</div>
				<div class="row" style="padding:4px;">
						<div class="btn-group col-md-3">	
						</div>
						<div class="col-md-6" id="btn_content">
							<div  class="hover_instruct btn-group" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
										<button style="white-space: normal" type="button" class="hovr btn btn-primary btn-block btn-answer" name="answer_select" value="<?= md5($correct_question[0]->id_place)?>"><?=$correct_question[0]->place;?></button>
										<button style="white-space: normal" type="button" class="hovr btn btn-primary btn-block btn-answer" name="answer_select" value="<?= md5($correct_question[1]->id_place)?>"><?=$correct_question[1]->place;?></button>
										<button style="white-space: normal" type="button" class="hovr btn btn-primary btn-block btn-answer" name="answer_select" value="<?= md5($correct_question[2]->id_place)?>"><?=$correct_question[2]->place;?></button>
										<button style="white-space: normal" type="button" class="hovr btn btn-primary btn-block btn-answer" name="answer_select" value="<?= md5($correct_question[3]->id_place)?>"><?=$correct_question[3]->place;?></button>
							</div>
						</div>
						<input type="hidden" value="" id="answer" name="answer"/>
						<div class="btn-group col-md-3">	
						</div>
				</div>		
				<script>
					$(function(){
						$("button[name=answer_select]").click(function(){
							$("#answer").val($(this).val());
						});
					});
				</script>
				<!--<div class="ui two column grid">
							  
				</div>-->
				<div class="row">
					<br/>
				</div>
				<div class="row text-center">
					<div class="col-md-3"></div>
					<div class="col-md-6 text-center">
						<button id="pop_answer" type="submit" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." class="btn btn-success btn-block hover_instruct">
						  	<span class="glyphicon glyphicon-record"></span> Answer
						</button>
					</div>
					<div class="col-md-3"></div>
				</div>
				<div class="row">
					<br/>
				</div>
			</div>
		</form>
		<script>
			$(function(){
				$(".hover_instruct").hover(function(){
					//$(this).popover('show');
					$(this).popover({placement: "bottom"});
					//$(this).data('popover').tip().css('z-index', 1030);
					$(this).popover('show');​​​​​​​​​​​​​​​​​​​​​​​​
				},function(){
					$(this).popover('hide');
				});
			});
		</script>
	</div>
		<? if(isset($images)){?>
			<div class="modal fade" id="references" tabindex="-1" role="dialog" aria-labelledby="modal_response" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					Images references
				  </div>
				  <div class="modal-body text-center row">
						<div class="col-sm-5 col-md-6"> 
							<?=$images[0]?>
						</div>	
						<div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
							<?=$images[1]?>
						</div>
						<div class="col-sm-5 col-md-6"> 
							<?=$images[2]?>
						</div>	
						<div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
							<?=$images[3]?>
						</div>
						<a href="<?= base_url()?>index.php/question" class="btn btn-primary">Not yet? Try another image</a>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
		<?}?>
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
		<script> 
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
			$(document).ready(function(){ +
			$(".hovr").click(function(){
				$(".hovr").css("background-color","#428bca");
				$(".hovr").removeClass("activ");
				$(this).css("background-color","#194368 !important");
				$(this).addClass("activ");
				//$(this).children("button").addClass("activ");
			});
			//	google.maps.event.addDomListener(window, 'load', initialize);
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
			});
			<?}?>		
			$("form").submit(function(){			
				if($("#answer").val()!="" && $("#answer").length==32){
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