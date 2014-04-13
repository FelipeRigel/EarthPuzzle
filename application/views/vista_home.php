<?=$this->load->view('head_vista')?>
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
</style>
  <body>
	<div class="ui fluid form segment" style=" background-color:#4086AA">
		<div class="ui three fields">
			<div class="field">&nbsp;
			</div>
			<div class="field" align="center">
				<label><!--
					<h1 style="color:white; text-align: center;">
						Earth Puzzle
					</h1>-->
					<img class="ui medium image" height="" src="<?= base_url()?>assets/img/earthpuzzlelogo.png"/>
				</label>
			</div>
		</div>
	</div>
  <form method="POST" id="" >
     <div class="ui fluid form segment" style=" background-color:rgba(192,192,192,.5)">
		<div class="ui three fields grid">			
			<div class="field">
				<div style="text-align: center">
					<div class=" ui  purple button">
						<i class="star icon white"></i>
						score : <?= (empty($score))?"0":$score?>
					</div> 
				</div>
			</div>
			<div class="field">
				
				<div style="text-align: center">
				<!--<button id="logout"class="ui blue button">
					<i class="ban circle icon big"></i>
					Logout <?= $this->session->userdata("nombre")?>
				</button>-->
					<div class=" ui  teal button" >
						<i class="question icon white"></i>
						Question # <?= $this->session->userdata("num_preguntas")+1?>
					</div>
				</div>
			</div>
			
			<div class="field">	
				<div style="text-align: center">			

					<div id="logout"class="ui blue small button">
						<script>
						</script>
						<i class="ban small"><img class="ui avatar image" height="" src="<?= $this->session->userdata("image");?>"/>				</i>
						Logout <?= $this->session->userdata("nombre")?>
					</div>
				</div>
			</div>
		</div><br>
		<? foreach($pregunta_correcta as $item){
			if($item->respuesta==1){?>
				<img class="ui large image rounded" width="250" height="300" src="<?= $item->imagen?>" style="margin:auto">
				<input type="hidden" name="pregunta" value="<?=  md5($item->id)?>" />
			<?}
		}?><br/>
		<? if(isset($imagenes)){?>
		<div class="" style="text-align: center"><a id="openReference" onsubmit="return false;" class="ui red button"><i class="globe icon small"></i>You don´t know? Click here!</a></div>
		<?}?>
     </div>
     <div class="ui fluid form segment" style=" background-color:rgba(0,0,0,.5)">
       <label><h2 style="color:white; text-align: center;">Where is this?</h2></label>     
     <div class="ui two column grid">
        <div class="column" href="#">
          <div class="ui segment"> 
		  <div class="field">
				<div class="ui checkbox radio">
			   <input type="radio"  id="resp1" name="respuesta" value="<?= md5($pregunta_correcta[0]->id_place)?>" />
				<label  for="resp1">
				<?=$pregunta_correcta[0]->place;?>
				</label>
				</div>
			</div>
          </div>
        </div> 

        <div class="column" href="#">
          <div class="ui segment">  
           <div class="field">
				<div class="ui checkbox radio">
			   <input type="radio"  id="resp2" name="respuesta" value="<?= md5($pregunta_correcta[1]->id_place)?>" />
				<label  for="resp2">
				<?=$pregunta_correcta[1]->place;?>
				</label>
				</div>
			</div>
          </div>
        </div> 

      </div>
      
      <div class="ui two column grid">
      
        <div class="column" href="#">
          <div class="ui segment" >
            <div class="field">
				<div class="ui checkbox radio">
			   <input type="radio"  id="resp3" name="respuesta" value="<?=md5($pregunta_correcta[2]->id_place)?>" />
				<label  for="resp3">
				<?=$pregunta_correcta[2]->place;?>
				</label>
				</div>
			</div>
          </div>
        </div>

        <div class="column" href="#">
          <div class="ui segment"> 
           <div class="field">
				<div class="ui checkbox radio" >
			   <input type="radio"  id="resp4" name="respuesta" value="<?= md5($pregunta_correcta[3]->id_place)?>" />
				<label  for="resp4" >
				<?=$pregunta_correcta[3]->place;?>
				</label>
				</div>
			</div>
          </div>
        </div>
      
     </div>
	 <div class="ui three column grid">
		 <div class="column"></div>
		 <div class="column">
			<div class="" style="text-align: center"><button class="ui red button"><i class="globe icon small"></i>Submit</button></div>
		 </div>
		 <div class="column"></div>
		 
	 </div>
	
     </div>
</form>
<? if(isset($imagenes)){?>
<div class="ui modal" id="references">
	<i class="close icon"></i>

	<div class="header">
	 Images references
	</div>
	<div class="content" align="center">
		<div class="ui two columns">			
			<div class="column"> 
			<?=$imagenes[0]?>
			<?=$imagenes[1]?>
			</div>	
			<div class="column"> 
			<?=$imagenes[2]?>
			<?=$imagenes[3]?>
			</div>	
		</div>
		<a href="<?= base_url()?>index.php/c_preguntas" class="ui button blue">Not yet? Try another image</a>
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
					<?= "<img id='img1' class='ui huge image' src='".$imagen->imagen."'/>"?><br/>
					<div data-latitud="<?= $imagen->latitud?>" data-longitud="<?= $imagen->longitud?>" class="mini ui button" id="maps">View on Google Maps</div>
				</div>
				<div class="right" id="anchor">
					<?= html_entity_decode($imagen->description)?>
				</div>
			</div>
			<div class="actions">
				<div class="ui button">Close</div>
				
			</div>
		</div>
	<?}?>
  <script>
	$(document).ready(function(){
		$("#openReference").click(function(){
		$('#references')
		  .modal("show")
		;
		
		});
		$('.ui.selection.dropdown').dropdown();
		/*$.ajax({
			dataType:"JSON",
			url:"https://maps.googleapis.com/maps/api/geocode/json?latlng= 31.121,-82.423&sensor=true",
			type:"GET",
			success:function(datos){
				$.ajax({
					url:"
				});
			}
		});*/
	});
	<?if(isset($modal) and $modal==true){?>
		$('#modal_response')
		  .modal("show")
		;
		$("#img1").click(function(event) {
			window.open($(this).attr("src"));

		});
		$("#anchor").children("a").html("");
		$("#maps").click(function(){
			$(this).data("latitud");
			$(this).data("longitud");
			//document.location=;
			window.open("http://maps.google.com/maps?q="+$(this).data("latitud")+","+$(this).data("longitud"),"Search","width=600,height=500");
		});
	<?}?>
      $( "#slider" ).slider({ max: 44 });
      
      // setter
      $( "#slider" ).slider( "option", "max", 44 );

      $( "#slider" ).slider({
      change: function( event, ui ) {
        var set_anio= 1970+$( "#slider" ).slider( "option", "value" );

        $("#anio").val(set_anio);
      }
      
      });
		$("form").submit(function(){			
			if(!$("input[name=respuesta]").is(':checked')){
				alert("Select an answer please");
				return false;
			}else{
				return true;
			}
			
		})
		$("#logout").click(function(){
			$.ajax({
				type:"POST",
				async:false,
				url:"<?= base_url()?>index.php/c_preguntas/logout",
				success:function(){
					window.location.href="<?= base_url()?>index.php/welcome";
				}
			});
		});
		$("#categoria").change(function(){
			alert(1);
		});
		$("image").error(function(){
			$(this).attr("src","<?= base_url()?>assets/img/earthpuzzlelogo.png");
		});
    </script>
  </body>
</html>