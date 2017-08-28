 <!DOCTYPE html>
 <html>
<table align="center" width="1000">
<tr>
<td>
<style>
      .cursor {
        cursor: pointer;
    }
</style>
<script type="text/javascript" src="<?php echo base_url();?>extension/js/jquery-1.11.1.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>extension/js/input_js.js"></script> -->
<link href="<?php echo base_url(); ?>extension/css/chart.css" rel="stylesheet">
<!-- <link href="<?php echo base_url(); ?>extension/css/check_box.css" rel="stylesheet"> -->
<script>
 $(document).ready(function(){


          $("#insert_normal").click(function(){

            if($("input[name=field_name_url_ano").val()=="")
            {
              $("input[name=field_name_url_ano").focus();
              return false;
            }
            
            var html = 
                "<tr><td>"
                +$("input[name=field_name_url_ano]").val()+
                '</td><td align="center">'
                +'<a href="javascript:void(0);" onclick="del(this);"><img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor"></a>'
                "</td></tr>";

                $(html).appendTo("#data_danger tbody");

                  $("input[name=field_name_url_ano]").val("");

          });

          $("#add_field_protocal_another").click(function(){

              if($("input[name=field_port_another").val()=="")
              {
                $("input[name=field_port_another").focus();
                return false;
              }

              if($("#field_protocal_another option:selected").val()=="")
              {
                $("input[name=field_protocal_another").focus();
                return false;
              }
            
            var html = 
                "<tr><td>"
                +$("input[name=field_port_another]").val()+
                "</td><td>"
                +$("#field_protocal_another option:selected").val()+
                '</td><td align="center">'
                +'<a href="javascript:void(0);" onclick="del(this);"><img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor"></a>'
                "</td></tr>";

                $(html).appendTo("#port_block tbody");

                  $("input[name=field_port_another]").val("");

          });



          $("#submit").click(function(){


                  var obj = {};
                  var port_block = [];
                  obj.port_block = [];
                  var url_block  = [];
                  obj.url_block  = [];

//----------------------------------------------------------------------------------------------------
                  if(!$('input[name=on_off_port_another]').is(':checked'))
                  {

                      if($("#field_protocal_another option:selected").val()!="" && $('input[name="field_port_another[]"]').val()!="")
                      {


                          var i =0;
                            $('#port_block tr').each(function() {

                              if(i!=0){
                                    var port = $(this).find("td:first").html();
                                    var protocal = $(this).find("td:eq(1)").html(); 

                                    obj.port_block.push({'port': port,'protocal': protocal});
                                    }
                                  i++; 
                               });

                      }else{
                        obj.port_block.push();
                      }

                  }else{
                    obj.port_block.push("all");
                  }
//----------------------------------------------------------------------------------------------------

                  if(!$('input[name=on_off_url_another]').is(':checked')){

                    if($('input[name="field_name_url_ano[]"]').val()!=""){

                        var i =0;
                          $('#data_danger tr').each(function() {

                                if(i!=0){
                                  var url = $(this).find("td").html(); 
                                  obj.url_block.push(url);
                                }
                                i++; 
                             });

                    }else{
                      obj.url_block.push();
                    }
                  }else{

                    obj.url_block.push("all");
                  }

//---------------------------------------------------------------------------------------------------
                  var block = JSON.stringify(obj);

              if(!$('input[name=on_off_url_another]').is(':checked')  && 
                 !$('input[name=on_off_port_another]').is(':checked') && 
                  $('input[name="field_name_url_ano[]"]').val()==""    && 
                  $('input[name="field_name_port_ano[]"]').val()==""   && 
                  $('input[name="field_protocal_another"]').val()=="")
                  {
                     alert("Please Check to Block-Unblock !");
                  }

                    jQuery.ajax({
                      type: "POST",
                      url: "ip",
                      data: {block : block},
                      success: function(data){
                        
                          location.reload();

                      } 
                    });
                  // }

      });



});
        function del(obj)
          {
            $(obj).parent().parent().remove();
          }


</script>
<style>
  #input {
    width: 100%;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
  }
</style>
<body>
<h2 align="center"> Internet Policy Management </h2>
<br>

<div class="row">
      <div class="col-xs-4" style="padding-right:0px;">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default chat">
              <div class="panel-heading" id="accordion" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"> URL block all By default <input type="checkbox"  data-toggle="toggle" id="on_off_url_another" name="on_off_url_another" data-on="Block" data-off="Unblock" ></div>
              <div class="panel-body" style="height:380px;padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
                <table class="table table-hover" id="data_danger">
                  <thead>
                    <tr>
                      <th style="text-align:center;">

                          <div class="form-group">
                            <input type="email" class="form-control" name="field_name_url_ano" id="field_wrapper_url_ano" aria-describedby="URL" placeholder="EX.URL www.example.com" size="15">
                          </div>
                      </th>
                      <th>
                        <img src="<?php echo base_url();?>/extension/img/add.png" class="cursor" id="insert_normal" title="Add">
                      </th>
                    </tr> 
                  </thead>
                  <tbody>

                  </tbody>
                  </table>
                </div>
              </div>
            </div><!--/.col-->
          </div>
        </div>

      <div class="col-xs-4" style="padding-right:0px;" id="current_rules">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default chat">
              <div class="panel-heading" id="accordion" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;background-color:#E4FFFA;"><b>Current Rules</b></div>
              <div class="panel-body" style="height:380px;padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>URL</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $json  = file_get_contents('http://localhost/project/extension/file/json_block_web.json');
                    $json_data = json_decode($json,true);

                    if(count($json_data['url_block']) != 0){

                        for($i=0;$i<count($json_data['url_block']);$i++){ ?>
                        <tr>
                          <td>
                            <?php
                            if($json_data['url_block'][$i] != "all"){ 
                                echo $json_data['url_block'][$i];
                              }else{
                                echo "Block URL All";
                              }
                              }?>

                          </td>
                        </tr>
                    <?php } else{?>

                        <tr>
                          <td>
                          No Current Rule
                          </td>
                        </tr>

                    <?php } ?> 

                  </tbody>
                  </table>
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Port</th>
                      <th>Protocol</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
                      if(count($json_data['port_block']) != 0){
                      for($i=0;$i<count($json_data['port_block']);$i++){  ?>
                    <tr>
                      <td>
                      <?php if($json_data['port_block'][$i] != "all" ){ ?>
                      <?php echo $json_data['port_block'][$i]['port']; ?>

                      </td>
                      <td>
                      <?php echo $json_data['port_block'][$i]['protocal']; ?>
                      <?php }else{echo "Block Port All";} ?>
                      </td>
                    </tr>
                    <?php }}else{ ?> 
                      <tr>
                        <td>No Current Rule</td>
                      </tr>
                      <?php } ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div><!--/.col-->
          </div>
        </div>
   <div class="col-sm-4" style="padding-left:0px;padding-right:0px;">

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default chat">
              <div class="panel-heading" id="accordion" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"> Port block all By default &nbsp&nbsp&nbsp&nbsp<input type="checkbox"  data-toggle="toggle" id="on_off_port_another" name="on_off_port_another" data-on="Block" data-off="Unblock"></div>
              <div class="panel-body" style="height:380px;padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
                <table class="table table-hover" id="port_block">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-group">
                          <input type="email" class="form-control" name="field_port_another" aria-describedby="Port" placeholder="Example Port 80" size="10">
                        </div>
                      </th>
                      <th>
                              <div class="form-group">
                                <select class="form-control" id="field_protocal_another">
                                  <option value="TCP">TCP</option>
                                  <option value="UDP">UDP</option>
                                </select>
                              </div>
                      </th>
                      <th>
                        <img src="<?php echo base_url();?>/extension/img/add.png" class="cursor" id="add_field_protocal_another" title="Add">
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  </table>
                </div>
              </div>
            </div><!--/.col-->
          </div>

</div>

</div>
<div align="center" >

        <button class="btn btn-success" id="submit"> Activate Policy </button>
        <button class="btn btn-info" type="file" data-toggle="modal" data-target="#myModal">Import</button>
        <a href="<?php echo base_url('index.php/policy_control/export_file') ?>" target="_blank"><button class="btn btn-info">Export</button></a>
        
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add File Policy!</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('policy_control/import_file') ?>
          <input type="file" name="file_import" id="file_import">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save">
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Time &nbsp;&nbsp;<input type="text" size="15" align="left"> <br><br><br> -->

    
        </tr>    

</body>
</td>
</html>