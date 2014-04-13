<?=$this->load->view('head_vista')?>
  <body>
     <div class="ui fluid form segment" style=" background-color:rgba(192,192,192,.5)">
        <label><h1 style="color:white; text-align: center;">EARTH-PUZZLE</h1></label>
       <? foreach($pregunta_correcta as $item){
              if($item->respuesta==1){?>
                <img class="ui large image" src="<?= $item->imagen?>" style="margin:auto">
             <?}
       }?>
     </div>
     <div class="ui fluid form segment" style=" background-color:rgba(0,0,0,.5)">
       <label><h2 style="color:white; text-align: center;">Where is this?</h2></label>
     </div>

     <div class="ui two column grid">
        <a class="column" href="#">
          <div class="ui segment">
            <?= $pregunta_correcta[0]->place;?>
          </div>
        </a> 

        <a class="column" href="#">
          <div class="ui segment">
            <?= $pregunta_correcta[1]->place;?>
          </div>
        </a> 

      </div>
      
      <div class="ui two column grid">
      
        <a class="column" href="#">
          <div class="ui segment" >
            <?= $pregunta_correcta[2]->place;?>
          </div>
        </a>

        <a class="column" href="#">
          <div class="ui segment">
            <?= $pregunta_correcta[3]->place;?>
          </div>
        </a>

     </div>
  <script>
      $( "#slider" ).slider({ max: 44 });
      
      // setter
      $( "#slider" ).slider( "option", "max", 44 );

      $( "#slider" ).slider({
      change: function( event, ui ) {
        var set_anio= 1970+$( "#slider" ).slider( "option", "value" );

        $("#anio").val(set_anio);
      }
      
      });

    </script>
  </body>
</html>