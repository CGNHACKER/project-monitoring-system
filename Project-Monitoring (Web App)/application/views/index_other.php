<!DOCTYPE html>
<html>
<head>
<link href="<?php echo base_url(); ?>extension/css/chart.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script>

	<script>
		$(document).ready(function(){

			$("#latest").click(function(){
				$("#2").hide();
				$("#3").hide();
				$("#1").show(500);
			});
			$("#ip").click(function(){
				$("#1").hide();
				$("#3").hide();
				$("#2").show(500);
			});

			$("#submit").click(function(){
				$("#1").hide();
				var ip = $('#selec').find(":selected").val();
				var type = $('#se_type').find(":selected").val();

				show_ip(ip,type);


			});
			$("#type").click(function(){
				$("#1").hide();
				$("#2").hide();
				$("#3").show(500);
			});
			$("#submit_type").click(function(){
				var type = $('#se_type').find(":selected").val();
				var str1 = type;
				show_type(str1);
			});

		});

		$(document).ready(function(){
			$('table tr').click(function(){
				window.location = $(this).data('href');
				return false;
			});
		});

		function show_ip(ip,type) {
				// alert(str);

				if (ip=="") {
					document.getElementById("txtHint").innerHTML="";
					return;
				} 
				if (window.XMLHttpRequest) {
			          // code for IE7+, Firefox, Chrome, Opera, Safari
			          xmlhttp=new XMLHttpRequest();
			      } else { // code for IE6, IE5
			      	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			      }
			      
			      xmlhttp.onreadystatechange=function() {
			      	if (this.readyState==4 && this.status==200) {
			      		document.getElementById("txtHint").innerHTML=this.responseText;
			      	}
			      }
			      xmlhttp.open("GET","query_real/?ip="+ip+"&type="+type,true);
			      xmlhttp.send();

			  }


			</script>

			<style>

				table tr[data-href] {
					cursor: pointer;
				}
				.cursor {
					cursor: pointer;
				}



			</style>
		</head>




					<!-- <font>Filter IP&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font> -->
<!-- <div class="col-md-6 col-md-offset-3"> -->
<div class="col-md-12" align="center">
					<select class="selectpicker" id="selec" name="selec">
						<optgroup label="Default">
							<option value="1"> All IP Address</option>
						</optgroup>
						<optgroup label="IP Address">
							<?php foreach ($query1 as $item1): ?>

								<option value="<?php echo $item1['agent_ip'];?>"><?php echo $item1['agent_ip'];?></option>

							<?php endforeach ?>
						</optgroup>	  
					</select>

					

					<!-- <font>Filter Type &nbsp&nbsp&nbsp&nbsp&nbsp</font> -->


					<select class="selectpicker" id="se_type" name="se_type">
						<optgroup label="Default">
							<option value="0">All Level</option>
						</optgroup>
						<optgroup label="Log level">
							<option value="1">Normal</option>
							<option value="2">Warning</option>
							<option value="3">Error</option>
						</optgroup>		
					</select>


					<button type="button" class="btn btn-info btn-sm" id="submit">
						<span class="glyphicon glyphicon-filter"></span> Filter 
					</button>

					<span id="txtHint"></span>


			
			<br><br>
	</div>
	
	<div class="row">
		
		<div class="col-md-9 col-md-offset-1">




			<div id="1">
		    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion" style="float:padding-top:10px;padding-bottom:10px;padding-left:8px;padding-right:8px;" align="center"> Log event List</div>
						<div class="panel-body" style="height:500px;">
							
									<table class="table table-hover" align="center">
									  <thead>
									    <tr>
									    	<th class="col-md-2"><p align="center">Timestamp</p></th>
									    	<th class="col-md-2"><p align="center">IP Address</p></th>
									    	<th class="col-md-6"><p align="center">Description</p></th>
									    </tr>
									  </thead>
									
									  <tbody>
								<?php $i=0;?>
								<?php foreach ($query as $item): {?>


									<?php  //if($i < 10){?> 

										<?php if($item['type_id'] == '1'){?>

											<tr class="success" data-href="<?php echo base_url()?>index.php\dashboard_control\show_agent_detail\<?php echo $item['agent_ip'];?>">
												<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $item['log_time'];?></p></td>
												<td style="padding-right:0px;padding-bottom:0px;><p align="left"><?php echo $item['agent_ip'];?></p></td>
												<td style="padding-right:0px;padding-bottom:0px;><p align="left"><?php echo $item['log_event'];?></p></td>
											</tr>

											<?php }elseif ($item['type_id'] == '2') {?>

											<tr class="warning" data-href="<?php echo base_url()?>index.php\dashboard_control\show_agent_detail\<?php echo $item['agent_ip'];?>">
													<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $item['log_time'];?></p></td>
													<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $item['agent_ip'];?></p></td>
													<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $item['log_event'];?></p></td>
												</tr>

												<?php }elseif ($item['type_id'] == '3') {?>

											<tr class="danger" data-href="<?php echo base_url()?>index.php\dashboard_control\show_agent_detail\<?php echo $item['agent_ip'];?>">
														<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $item['log_time'];?></p></td>
														<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $item['agent_ip'];?></p></td>
														<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $item['log_event'];?></p></td>
													</tr>

													<?php } ?>


													<?php //$i++;} ?>

													<?php  } endforeach;?>       
												</tbody>

									</table>
									</div>
</div>
		</html>

