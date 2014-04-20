<?=$this->load->view('v_head')?>
  <body>
     <div class="ui fluid form segment" style=" background-color:rgba(192,192,192,.5)">
        <label><h1 style="color:white; text-align: center;">EARTH-PUZZLE</h1></label>
     </div>
     <div class="ui fluid form segment" style=" background-color:rgba(0,0,0,.5)">
       <label><h2 style="color:white; text-align: center;">Where is this?</h2></label>
     </div>

     <div class="ui two column grid">
        <a class="column" href="#">
        </a> 

        <a class="column" href="#">
        </a> 

      </div>
      
      <div class="ui two column grid"></div>
	<div class="ui modal" id="modal">
	  <i class="close icon"></i>
	  <div class="header">
		Modal Title
	  </div>
	  <?php for($x=0;$x<20;$x++){?>
	  <div class="content">
		<div class="left">
		  Content can appear on left
		</div>
		</div>
		<?php }?>
	  <div class="actions">
		<div class="ui button">Cancel</div>
		<div class="ui button">OK</div>
	  </div>
	</div>
  <script>
	$(function(){
		$("#modal").modal("show",function(){
			$(this).css("top",0);
			$(this).css("position","fixed");
		});
	});
    </script>
  </body>
</html>