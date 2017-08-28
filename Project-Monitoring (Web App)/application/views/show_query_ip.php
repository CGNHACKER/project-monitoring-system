<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>

<br>
<br>
<div class="col-md-9 col-md-offset-1">

		   <div class="row">
			 <div class="col-md-12">
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion" style="float:padding-top:10px;padding-bottom:10px;padding-left:8px;padding-right:8px;"> Log event List</div>
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

									  	<?php if($sq != null){?>


									  		<?php for($i=0;$i<count($sq);$i++){ ?>


									  			<?php if($sq[$i]['type_id'] == '1'){?>

									  				<tr class="success" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
									  					<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
									  					<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
									  					<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
									  				</tr>

									  				<?php }elseif ($sq[$i]['type_id'] == '2') {?>

									  					<tr class="warning" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
									  						<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
									  						<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
									  						<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
									  					</tr>

									  					<?php }elseif ($sq[$i]['type_id'] == '3') {?>

									  						<tr class="danger" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
									  							<td style="padding-right:0px;padding-bottom:0px;"><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
									  							<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
									  							<td style="padding-right:0px;padding-bottom:0px;"><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
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








 <!--  <table class="table table-hover" align="center">
    <thead>
      <tr>
        <th class="col-md-2"><p align="center">Timestamp</p></th>
        <th class="col-md-2"><p align="center">IP Address</p></th>
        <th class="col-md-6"><p align="center">Description</p></th>

      </tr>
    </thead>

			<tbody>

			<?php if($sq != null){?>

				
			<?php for($i=0;$i<count($sq);$i++){ ?>


		      <?php if($sq[$i]['type_id'] == '1'){?>

		      <tr class="success" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
		        <td><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
		      </tr>

		      <?php }elseif ($sq[$i]['type_id'] == '2') {?>

		        <tr class="warning" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
		        <td><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
		        </tr>

		      <?php }elseif ($sq[$i]['type_id'] == '3') {?>

		        <tr class="danger" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>">
		        <td><p align="center"><?php echo $sq[$i]['log_time'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['agent_ip'];?></p></td>
		        <td><p align="left"><?php echo $sq[$i]['log_event'];?></p></td>
		        </tr>

		      <?php } ?>


			<?php } ?>
			<?php }else{

				echo '<tr><td></td><td></td><td><h3>'."No Data Query!".'</h2></td></tr>';

				} ?>

			</tbody> -->
<!-- 			</table> -->
</body>
</html>