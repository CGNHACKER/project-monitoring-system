<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<script>
			$(document).ready(function(){
	    		$('table tr').click(function(){
	        	window.location = $(this).data('href');
	        	return false;
    		});
		});
			
</script>
<style>
			table tr[data-href] {
		    cursor: pointer;
		}
</style>
<body>
<hr>
<h2 align="center">Query By Log Type</h2>
  <table class="table table-hover" align="center">
    <thead>
      <tr>
        <th class="col-md-3"><p align="center">Timestamp</p></th>
        <th class="col-md-3"><p align="center">IP Address</p></th>
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

				echo '<tr><td></td><td><h3>'."No Data Query!".'</h2></td></tr>';

				} ?>

			</tbody>
			</table>
</body>
</html>