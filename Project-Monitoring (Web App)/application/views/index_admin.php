 <html>

<!-- ////////////////////// -->
<style>

table tr[data-href] {
    cursor: pointer;
}

</style>
<!-- ////////////////////// -->

 <body>


 <div class="row">
 <div class="col-md-12" align="center">

 <hr>
<div class="container" align="center">
  <h2>การแจ้งเตือน</h2>
  <hr>
  <p></p>
  <table class="table table-hover" align="center">
    <thead>
      <tr>
        <th class="col-md-2"><p align="center">Timestamp</p></th>
        <th class="col-md-3"><p align="center">IP Address</p></th>
        <th class="col-md-7"><p align="center">Description</p></th>

      </tr>
    </thead>

    <tbody>
    <?php foreach ($query as $item): {?>
      <?php if($item['type_name'] == '1'){?>

      <tr class="success" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $item['agent_ip'];?>">
        <td><p align="center"><?php echo $item['log_time'];?></p></td>
        <td><p align="center"><?php echo $item['agent_ip'];?></p></td>
        <td><p align="center"><?php echo $item['log_event'];?></p></td>
      </tr>

      <?php }elseif ($item['type_name'] == '2') {?>

        <tr class="warning" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $item['agent_ip'];?>">
        <td><p align="center"><?php echo $item['log_time'];?></p></td>
        <td><p align="center"><?php echo $item['agent_ip'];?></p></td>
        <td><p align="center"><?php echo $item['log_event'];?></p></td>
        </tr>

      <?php }elseif ($item['type_name'] == '3') {?>

        <tr class="danger" data-href="<?php echo base_url()?>\index.php\control\show_agent_detail\<?php echo $item['agent_ip'];?>">
        <td><p align="center"><?php echo $item['log_time'];?></p></td>
        <td><p align="center"><?php echo $item['agent_ip'];?></p></td>
        <td><p align="center"><?php echo $item['log_event'];?></p></td>
        </tr>

      <?php } ?>


    <?php  } endforeach;?>       
    </tbody>
  </table>
</div>
</div>
</div>
</body>

<script type="text/javascript">
$(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).data('href');
        return false;
    });
});
</script>


</html>

