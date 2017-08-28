<head>
<script src="<?php echo base_url(); ?>extension/js/jsq-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script>

<link href="<?php echo base_url(); ?>extension/css/w3.css" rel="stylesheet">

</head>
<style>
    .col-md-3{
        padding-right: 0px;
        padding-left :0px;
    }
    p {
    font-family: "Times New Roman", Times, serif;
}
</style>

<body>


    <div class="container">


    <div class="col-md-12">
        <div class="col-xs-6">
            <h2 style="margin-top:0px;margin-top:0px;"><p style="font-weight:bold;"><font color="blue">Dashboard </font><font color="green">Computer Laboratory 3 </font></p></h2>
        </div>
        <div class="col-xs-4 pull-right">
            <div class="col-md-3">
                <div class="w3-panel w3-red">
                    <h7 align="center">Error</h7>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-panel w3-yellow">
                    <h7 align="center">Warning</h7>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-panel w3-green">
                    <h7 align="center">Normal</h7>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-panel w3-black">
                    <h7 align="center">Offline</h7>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>


        <div class="row">
           <?php 


           for($i=0;$i<count($sq);$i++){?>

           
                <?php  if($sq[$i]['agent_status'] == '0') { ?>

                        <div class="col-md-2 portfolio-item">
                            <img class="img-responsive" src="<?php echo base_url();?>\extension\img\color_monitor\black.png" >
                            <h3> <p align="center"><font size="3px;" color="grey"><?php echo $sq[$i]['agent_ip']; ?></font></p>
                            </a>
                        </div>
                <?php }else{ ?>


                <?php if($sq[$i]['type_id'] == 1){ ?>

                        <div class="col-md-2 portfolio-item">
                            <a onclick="get_process()" target="_blank" [....]  href="<?php echo base_url();?>index.php\dashboard_control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>" style="text-decoration: none" title="<?php echo $sq[$i]['agent_ip'];?>">
                                <img  class="img-responsive"  src="<?php echo base_url();?>\extension\img\color_monitor\green.png"  >

                                <h3> <p  align = "center"><font size="3px;" color="green"><?php echo $sq[$i]['agent_ip']; ?></font></p>
                            </a>
                        </div>

                    <?php }elseif ($sq[$i]['type_id']==2) {?>

                        <div class="col-md-2 portfolio-item">
                            <a onclick="get_process()" target="_blank" [....]  href="<?php echo base_url();?>index.php\dashboard_control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>" style="text-decoration: none" title="<?php echo $sq[$i]['agent_ip'];?>">
                                <img  class="img-responsive"  src="<?php echo base_url();?>\extension\img\color_monitor\yellow.png"  >

                                <h3> <p  align = "center"><font size="3px;" color="#999900"><?php echo $sq[$i]['agent_ip']; ?></font></p>
                            </a>
                        </div>


                    <?php }elseif ($sq[$i]['type_id']==3){ ?>

                        <div class="col-md-2 portfolio-item">
                            <a onclick="get_process()" target="_blank" [....]  href="<?php echo base_url();?>index.php\dashboard_control\show_agent_detail\<?php echo $sq[$i]['agent_ip'];?>" style="text-decoration: none" title="<?php echo $sq[$i]['agent_ip'];?>">
                                <img  class="img-responsive"  src="<?php echo base_url();?>\extension\img\color_monitor\red.png"  >

                                <h3> <p  align = "center"><font size="3px;" color="red"><?php echo $sq[$i]['agent_ip']; ?></font></p>
                            </a>
                        </div>

                    <?php } ?>


            <?php }} ?>

        </div>




    </div>




</body>
