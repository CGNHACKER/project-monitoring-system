<!DOCTYPE html>
<html>
<table align="center" width="1000">
<tr>
<td>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Check Computer Detail</title>

<link href="<?php echo base_url(); ?>extension/css/chart.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script>



<script>

		$(document).ready(function(){

			$("#log").click(function(){
				$("#data_use").toggle(500);
				$("#show_log").toggle(500);
			});
		});
	
	    function get_process(){

            var a = '<?php echo $sq['agent_ip']?>';
            var f = ":9000/get_process";
            var s = "http://";
            var g = s.concat("localhost");
            var h = g.concat(f);
            $.post(h,function(data){


                
                var process_json = data;
                var obj = jQuery.parseJSON(process_json);
                var json_obj = obj["process"];
                var json_use = obj["agent_use"];
                var num_of_json = Object.keys(json_obj).length;
                var content = '';


                        var ram = Math.round(json_use[0])+"%";
                		var disk = Math.round(json_use[1])+"%";
                		var network = (json_use[2]).toFixed(5)+"%";
                		var cpu = Math.round(json_use[3])+"%";
                		var network_kb = Math.round(json_use[4])+" kb";

                  	$(document).ready(function(){

			  			$('#ram').text(ram);
			  			$('#disk').text(disk);
			  			$('#cpu').text(cpu);
			  			$('#network').text(network);
			  			$('#network_kb').text(network_kb);

			  			
						$(function(){
							$('#easypiechart-blue').data('easyPieChart').update(ram);
							$('#easypiechart-teal').data('easyPieChart').update(disk);
							$('#easypiechart-orange').data('easyPieChart').update(cpu);
							$('#easypiechart-red').data('easyPieChart').update(network);
						});

			  		});




                for(var i=0;i<num_of_json;i++)
                {
                	var del = json_obj[i];
                	content += '<tr>';
					content += '<td class="cursor">' +	'<img src="<?php echo base_url(); ?>extension/img/stop.png " title="หยุดการทำงาน" data-dismiss="modal" onclick="del_process('+json_obj[i]+')">'	+ '</td>';
                	content += '<td>' + json_obj[i] + '</td>';
                	content += '<td>' + json_obj[i+1] + '</td>';
                	content += '<td align="right">' + (((json_obj[i+2]/1000)/1000).toFixed(2)) + '</td>';
                	content += '</tr>';
                	i=i+2;

                }

                $('#tb tbody').html(content);


            	})
		            .fail(function() {
		            	
		            	$.ajax({
			              url:"<?php echo base_url(); ?>" + "index.php/dashboard_control/update_agent",
			              type:"POST",
			              cache:false,
			              data:"ip="+a,
			              success:function(res)
			              {
			                if(res=="ok")
			                {
			                	alert('Agent Offline');
			                }
			              },
			              error:function(err)
			                {
			                  alert("Error");
			                }

			            	});

		            });

            setTimeout(function(){

                get_process();

             }, 60000);

  		}

  		function del_process(name_process){

  			var r = confirm("Do you want to Stop Process!!");

  			if(r == true){
		  			var a = '<?php echo $sq['agent_ip']?>';
		            var f = ":9000/echoPost";
		            var k = f.concat(name_process);
		            var s = "http://";
		            var g = s.concat("localhost");
		            var h = g.concat(f);
		            console.log(h);
		            $.post(h,
		            	{
		            		name_process
		            	},function(data){

			               var log_del 	= data;
			               var obj_del 	= jQuery.parseJSON(log_del);
			               var ip 		= obj_del['ip'];
			               var event 	= obj_del['event'];


			              $.ajax({
			              url:"<?php echo base_url(); ?>" + "index.php/index_control/log_del",
			              type:"POST",
			              cache:false,
			              data:"ip="+ip+"&event="+event,
			              success:function(res)
			              {
			                if(res=="ok")
			                {
			                	alert('Stop Process Success');
			                }
			              },
			              error:function(err)
			                {
			                  alert("error Stop Process");
			                }

			            	});
		            		
		            });
		            get_process();
  			}

  		}



</script>
<style>
			.cursor {
		    cursor: pointer;
		}
</style>

</head>
<body>



<div class="row">
  <div class="col-xs-6" align="widget-left">

  					<div class="col-md-12">

  					<?php  if($sq['type_id'] == 1){ ?>

							<img src="<?php echo base_url();?>extension/img/color_monitor/green_shadow.png "style="width:100px;height:60px;" align=left hspace="10" vspace="10"">


					<?php  }elseif($sq['type_id'] == 2){ ?>

							<img src="<?php echo base_url(); ?>extension/img/color_monitor/yellow_shadow.png " style="width:100px;height:60px;" align=left hspace="10" vspace="10"">

					<?php  }else{?>		

							<img src="<?php echo base_url(); ?>extension/img/color_monitor/red_shadow.png " style="width:100px;height:60px;" align=left hspace="10" vspace="10"">

					<?php  }?>


							<FONT size="4">&nbsp&nbsp&nbsp&nbsp IP Address&nbsp&nbsp: <font color="violet"><?php echo $sq['agent_ip'];?></font><br></FONT><br>
							<FONT size="4">&nbsp&nbsp&nbsp&nbsp Hostname &nbsp&nbsp: <font color="violet"><?php echo $sq['agent_hostname'];?></font><br></FONT></FONT><br>
							<div style="float:center;" class="col-md-2"><input type="button" name="log" id="log" class="btn btn-info" value="Audit Log"></div><br><br><br>


					<div id="show_log" style="display:none" class="col-md-12">

						<div class="row">
							<div class="col-md-12" style="padding-right:0px;padding-left:0px;">
								<div class="panel panel-default chat">
									<div class="panel-heading" id="qqq" style="padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"> Audit Log 

									</div>
									<div class="panel-body" style="height:390px;">

					<table class="table table-hover" align="center">
					    <thead>
					      <tr>
					        <th class="col-md-3"><p align="center">Timestamp</p></th>
					        <th class="col-md-4"><p align="center">Description</p></th>

					      </tr>
					    </thead>
					    <tbody>

					    <?php if($sq1 != null){?>


					    		<?php for($i=0;$i<count($sq1);$i++){ ?>


					    			<?php if($sq1[$i]['type_id'] == '1'){?>

					    				<tr class="success" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq1[$i]['agent_ip'];?>">
					    					<td><p align="center"><?php echo $sq1[$i]['log_time'];?></p></td>
					    					
					    					<td><p align="left"><?php echo $sq1[$i]['log_event'];?></p></td>
					    				</tr>

					    				<?php }elseif ($sq1[$i]['type_id'] == '2') {?>

					    					<tr class="warning" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq1[$i]['agent_ip'];?>">
					    						<td><p align="center"><?php echo $sq1[$i]['log_time'];?></p></td>
					    						
					    						<td><p align="left"><?php echo $sq1[$i]['log_event'];?></p></td>
					    					</tr>

					    					<?php }elseif ($sq1[$i]['type_id'] == '3') {?>

					    						<tr class="danger" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq1[$i]['agent_ip'];?>">
					    							<td><p align="center"><?php echo $sq1[$i]['log_time'];?></p></td>
					    						
					    							<td><p align="left"><?php echo $sq1[$i]['log_event'];?></p></td>
					    						</tr>

					    						<?php } ?>


					    						<?php } ?>
					    						<?php }else{

					    							echo '<tr><td></td><td></td><td><h3>'."No Data Query!".'</h2></td></tr>';

					    						} ?>

					    					</tbody>
								</table>
							</div>
						</div>
					</div><!--/.col-->
					</div>
					</div>

					</div>

<div id="data_use">
						<div class="col-xs-5 col-md-6">
							<div class="panel panel-default">
								<div class="panel-body easypiechart-panel" id="test_ram">
									<h4>RAM Usage</h4>
									<div class="easypiechart" id="easypiechart-blue" data-percent="">
									<span class="percent" id="ram"></span>

									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-5 col-md-6">
							<div class="panel panel-default">
								<div class="panel-body easypiechart-panel">
									<h4>CPU Usage</h4>
									<div class="easypiechart" id="easypiechart-orange" data-percent="" >
									<span class="percent" id="cpu"></span>
									</div>
								</div>
							</div>
						</div>
							<br><br><br><br><br><br><br><br><br><br><br><br>
						<div class="col-xs-6 col-md-6">
							<div class="panel panel-default">
								<div class="panel-body easypiechart-panel">
									<h4>Disk C: Usage</h4>
									<div class="easypiechart" id="easypiechart-teal" data-percent="" >
									<span class="percent" id="disk"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-6">
							<div class="panel panel-default">
								<div class="panel-body easypiechart-panel">
									<h4>Network</h4>
									<div class="easypiechart" id="easypiechart-red" data-percent="" >
									<span class="percent" id="network_kb"></span>
									</div>
								</div>
							</div>
						</div>
	</div>
 </div>

  
 <div class="col-xs-6">
<!-- <font size="4">Last Update &nbsp: <font  color="violet"><?php echo date("Y-m-d h:i:s");?></font></font><button class="btn btn-success" style="float: right;" onclick="get_process()"> Refresh </button></div><br> -->
		    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion" style="float:padding-top:10px;padding-bottom:10px;padding-left:8px;padding-right:8px;"> Process List <span style="float:right">Last Update : <?php echo date("Y-m-d h:i:s");?>&nbsp&nbsp&nbsp&nbsp<img  src="<?php echo base_url();?>/extension/img/1.png" onclick="get_process();" class="cursor" title="Refresh"></span></div>
						<div class="panel-body" style="height:540px;">
									<table class="table table-hover" id="tb">
									  <thead>
									    <tr>
									   	  <th></th>
									      <th>PID</th>
									      <th>Process name</th>
									      <th>Memmory (MB)</th>
									    </tr>
									  </thead>
									  <tbody>




									  </tbody>
									</table>
						</div>
				</div>
			</div><!--/.col-->

	</div>

<script>
	$(function(){
		get_process();

});

</script>


  </div>
  	<script src="<?php echo base_url(); ?>extension/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/chart-data.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/easypiechart.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url(); ?>extension/js/bootstrap-datepicker.js"></script>
</div>
</body>
</html>