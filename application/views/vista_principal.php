<?=$this->load->view('head_vista')?>

  <body>
    <div class="ui fluid form segment">
        <div class="ui grid">
        
          <div class="six wide column">
            <div class="ui segment">
              <div class="field">
                <input placeholder="Lugar..." type="text">
              </div>
            </div>
          </div>
          
          <div class="ui button red" style="margin-top:33px;">
            Buscar
          </div>

          <div class="six wide column">
            <div class="ui segment">
              <div>
                <label >1970</label>
                <label style="float: right">2014</label>
              </div>
             <div id="slider"></div>
            </div>
          </div>

          <div class="two wide column">
            <div class="ui segment">
              <div class="field">
                <label>Año</label>
                <input value="1970" type="text" readonly="readonly" id="anio">
              </div>
            </div>
          </div>

        </div>
      </div>
       <div class="ui two column grid">
          
          <div class="column">
            <div class="ui segment">
              22
            </div>
          </div> 

          <div class="column">
            <div class="ui segment">
              22
            </div>
          </div> 

        </div>
        
        <div class="ui two column grid">
        
          <div class="column">
            <div class="ui segment">
              22
            </div>
          </div>

          <div class="column">
            <div class="ui segment">
              22
            </div>
          </div>

       </div>
 
  </body>
</html>