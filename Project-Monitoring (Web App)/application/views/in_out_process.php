<html>
<head>
  <meta charset="utf-8">
<script type="text/javascript" src="<?php echo base_url();?>extension/js/jquery-1.11.1.min.js"></script>
<link href="<?php echo base_url(); ?>extension/css/chart.css" rel="stylesheet">


<!-- <script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script> -->
<style>
      .cursor {
        cursor: pointer;
    }
</style>
<script>

  $(document).ready(function(){

          $("#insert_danger").click(function(){

            if($("#process_name_danger option:selected").val()=="")
            {
              $("#process_des_danger").focus();
              return false;
            }

            var des_danger = $("#process_des_danger").val();

            if(des_danger == ""){
              des_danger = $("#process_name_danger option:selected").text();
            }
            var i = $("#data_danger tbody tr").length;


            $.ajax({
              url:"insert_process_danger",
              type:"POST",
              cache:false,
              data:"process_name_danger="+$("#process_name_danger option:selected").val()+"&process_des_danger="+des_danger,
              success:function(res)
              {
                if(res=="ok")
                {
                i++;
                $(".showtotal").text(i);
                var html = "<tr><td>"
                +i+
                "</td><td>"
                +$("#process_name_danger option:selected").val()+
                "</td><td>"
                +des_danger+
                '</td><td align="center">'
                +'<img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor">'
                "</td></tr>";

                $(html).appendTo("#data_danger tbody");

                  $("#process_name_danger option:selected").val("");
                  $("#process_des_danger").val("");
                  alert("save successfull");
                }
              },
              error:function(err)
                {
                  alert("error");
                }

            });
    });

          $("#insert_normal").click(function(){

            if($("input[name=process_name_normal]").val()=="")
            {
              $("input[name=process_name_normal]").focus();
              return false;
            }

            var des_normal = $("#process_des_normal").val();

            if(des_normal == ""){
              des_normal = $("#process_name_normal option:selected").text();
            }


            var i = $("#data_normal tbody tr").length;


            $.ajax({
              url:"insert_process_normal",
              type:"POST",
              cache:false,
              data:"process_name_normal="+$("#process_name_normal option:selected").val()+"&process_des_normal="+des_normal,
              success:function(res)
              {
                if(res=="ok")
                {
                i++;
                $(".showtotal").text(i);
                var html = "<tr><td>"
                +i+
                "</td><td>"
                +$("#process_name_normal option:selected").val()+
                "</td><td>"
                +des_normal+
                '</td><td align="left">'
                +'<img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor">'
                "</td></tr>";

                $(html).appendTo("#data_normal tbody");

                  $("#process_name_normal option:selected").val("");
                  $("#process_des_normal").val("");
                  alert("Add process success");
                }
              },
              error:function(err)
                {
                  alert("error");
                }

            });
    });


  });
  function del(id,obj)
  {
    var conf=confirm("คุณต้องการลบข้อมูลหรือไม่ ?");
    if(conf)
    {
        $.ajax({
            url:"del_process/"+id,
            type:"POST",
            success:function(res)
            {
               $(obj).parent().parent().remove();
            },
            error:function(err)
            {
              console.log("error: "+err);
            }
        });


    }
    else{
            return false;
    }
  }



    function activate_allow(){
    $.post("http://localhost/project/index.php/policy_control/activate_policy_allow",function(data){
        alert("Generate Policy Success!!!");
      });
    }
    function activate_mallicious(){
    $.post("http://localhost/project/index.php/policy_control/activate_policy_mallicious",function(data){
        alert("Generate Policy Success!!!");
      });
    }

    function run_policy_allow(){

        var number = <?php echo count($query2);?>;
        <?php $j = 0;?>

        <?php for($j=0;$j<count($query2);$j++){?>

            <?php if($query2[$j]['agent_status'] == '1'){?>

                var a = '<?php echo $query2[$j]['agent_ip'];?>';
                var f = ":9000/get_process_normal";
                var s = "http://";
                var g = s.concat(a);
                var h = g.concat(f);
                $.post(h,function(data){

                      $.ajax({

                        url:"<?php echo base_url(); ?>" + "index.php/policy_control/log_activate_process_normal",
                        type:"POST",
                        cache:false,
                        data:"ip="+a
                      });
                })

                 .fail(function() {
                  
                      $.ajax({
                        url:"<?php echo base_url(); ?>" + "index.php/policy_control/log_unactivate_process_normal",
                        type:"POST",
                        cache:false,
                        data:"ip="+a

                        });

                });

            <?php }?>
        <?php } ?>

  }
      function run_policy_mallicious(){

        var number = <?php echo count($query2);?>;
        <?php $j = 0;?>

        <?php for($j=0;$j<count($query2);$j++){?>

            <?php if($query2[$j]['agent_status'] == '1'){?>

                var a = '<?php echo $query2[$j]['agent_ip'];?>';
                var f = ":9000/get_process_mallicious";
                var s = "http://";
                var g = s.concat(a);
                var h = g.concat(f);
                $.post(h,function(data){

                      $.ajax({

                        url:"<?php echo base_url(); ?>" + "index.php/policy_control/log_activate_process_malicious",
                        type:"POST",
                        cache:false,
                        data:"ip="+a
                      });
                })

                 .fail(function() {
                  
                      $.ajax({
                        url:"<?php echo base_url(); ?>" + "index.php/policy_control/log_unactivate_process_malicious",
                        type:"POST",
                        cache:false,
                        data:"ip="+a

                        });

                });

            <?php }?>
        <?php } ?>

  }

  
</script>

</head>
<!-- <table align="center" width="1000" cellspacing="3">
<tr> -->
                                <?php 
                                        $json  = file_get_contents('http://localhost/project/extension/file/list_process.json');
                                        $json_data = json_decode($json,true);
                                ?>

<div class="container">
<div class="col-md-12">
      <h2 align="center" style="margin-top:0px;">Process policy management</h2>
</div>
</div>
<br>
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-md-12">
          <div class="panel panel-default chat">
              <div class="panel-heading" id="accordion" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"> Process Tracking &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          <input type="button" name="activate" class="btn btn-info" size="1" value="Generate Policy" id="activate" onclick="activate_allow()">
          <input type="button" name="run_policy" class="btn btn-success" size="1" value="Activate Policy" id="run_policy" onclick="run_policy_allow()">
              </div>
              <div class="panel-body" style="height:400px;">
                <table class="table table-hover" id="data_normal">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Process Name</th>
                      <th>Description</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="<?php echo base_url();?>extension/file/process_list.txt" target="_blank"> <img src="<?php echo base_url();?>extension/img/document.png" title="Process List" class="cursor"></a></td>
                      <td>
                          <div class="form-group">
                    <select class="form-control" id="process_name_normal" name="process_name_normal">


       
                    <optgroup label="Web Browser">
                          <?php for($j=0;$j<count($json_data['web_browser']);$j++){ ?> 
                              <option value="<?php echo $json_data['web_browser'][$j]['value']?>"><?php echo $json_data['web_browser'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>
                                 
                    <optgroup label="Microsoft Office">
                          <?php for($j=0;$j<count($json_data['microsoft_office']);$j++){ ?> 
                              <option value="<?php echo $json_data['microsoft_office'][$j]['value']?>"><?php echo $json_data['microsoft_office'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>

                    <optgroup label="Other Program">
                          <?php for($j=0;$j<count($json_data['other_program']);$j++){ ?> 
                              <option value="<?php echo $json_data['other_program'][$j]['value']?>"><?php echo $json_data['other_program'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>

                    </select>
                    </div>
                      </td>
                      <td>
                          <div class="form-group">
                            <input type="text" class="form-control" name="process_des_normal" id="process_des_normal" size="15">
                          </div>
                      </td>
                      <td><img src="<?php echo base_url();?>/extension/img/add.png" class="cursor" id="insert_normal" title="Add"></td>
                    </tr> 

                    <?php $i = 1;?>
                    <?php foreach ($query as $item):?>
                      <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $item['process_name'];?></td>
                        <td><?php echo $item['process_description'];?> </td>
                        <td>
                          <a href="javascript:void(0);" onclick="del('<?php echo $item['process_id']?>',this);"><img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor" title="Delete"></a>
                        </td>
                          <?php $i = $i+1;?> 
                        </tr>      
                      <?php endforeach;?>  
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="col-xs-6">

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default chat">
              <div class="panel-heading" id="accordion" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"> Malicious Process &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

          <input type="button" name="activate" class="btn btn-info" size="1" value="Generate Policy" id="activate" onclick="activate_mallicious()">
          <input type="button" name="run_policy" class="btn btn-success" size="1" value="Activate Policy" id="run_policy" onclick="run_policy_mallicious()">


              </div>
              <div class="panel-body" style="height:400px;">
                <table class="table table-hover" id="data_danger">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Process Name</th>
                      <th>Description</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="<?php echo base_url();?>extension/file/process_list.txt" target="_blank"> <img src="<?php echo base_url();?>extension/img/document.png" title="Process List" class="cursor"></a></td>

                      <td>
                    <div class="form-group">
                    <select class="form-control" id="process_name_danger" name="process_name_danger">


       
                    <optgroup label="Web Browser">
                          <?php for($j=0;$j<count($json_data['web_browser']);$j++){ ?> 
                              <option value="<?php echo $json_data['web_browser'][$j]['value']?>"><?php echo $json_data['web_browser'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>
                                 
                    <optgroup label="Microsoft Office">
                          <?php for($j=0;$j<count($json_data['microsoft_office']);$j++){ ?> 
                              <option value="<?php echo $json_data['microsoft_office'][$j]['value']?>"><?php echo $json_data['microsoft_office'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>

                    <optgroup label="Other Program">
                          <?php for($j=0;$j<count($json_data['other_program']);$j++){ ?> 
                              <option value="<?php echo $json_data['other_program'][$j]['value']?>"><?php echo $json_data['other_program'][$j]['name']?></option>
                          <?php } ?> 
                    </optgroup>

                    </select>
                    </div>
                      <!-- <input type="text" name="process_name_danger" id="process_name_danger" size="8"> -->
                      </td>

                      <td>
                          <div class="form-group">
                            <input type="text" class="form-control" name="process_des_danger" id="process_des_danger" size="15">
                          </div>
                      </td>

                      <td align="center"><img src="<?php echo base_url();?>/extension/img/add.png" class="cursor" id="insert_danger" title="Add"></td>

                    </tr> 

                    <?php $i = 1;?>
                    <?php foreach ($query1 as $item):?>
                      <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $item['process_name'];?></td>
                        <td><?php echo $item['process_description'];?> </td>
                        <td align="center">
                          <a href="javascript:void(0);" onclick="del('<?php echo $item['process_id']?>',this);"><img src="<?php echo base_url();?>/extension/img/remove.png" class="cursor" title="Delete"></a>
                          
                          </td>
                          <?php $i = $i+1;?> 
                        </tr>      
                      <?php endforeach;?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!--/.col-->
          </div>
        </div>
      </div>
    </div>
    


</html>