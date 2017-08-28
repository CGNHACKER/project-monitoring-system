<!DOCTYPE html> 
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Monitoring System</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="<?php echo base_url(); ?>extension/css/bootstrap.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <!-- <link href="<?php echo base_url(); ?>extension/css/landing-page.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>extension/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--Icons-->
    <script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script> 


    <link href="<?php echo base_url(); ?>extension/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>extension/css/datepicker3.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>extension/css/styles.css" rel="stylesheet"> -->


    <link href="<?php echo base_url(); ?>extension/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>extension/css/datepicker.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>extension/css/font_css.css" rel="stylesheet" type="text/css">
    <!-- Table setting -->
    <script src="<?php echo base_url(); ?>extension/js/jquery_min.js"></script>

    <script src="<?php echo base_url(); ?>extension/js/bootstrap_min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <link href="<?php echo base_url(); ?>extension/css/bootstrap_toggle.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>extension/js/bootstrap_toggle.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>extension/css/bootstrap_select.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo base_url(); ?>extension/js/bootstrap_select.js"></script>
    <script src="<?php echo base_url(); ?>extension/js/slide_bar.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->

    <script src="<?php echo base_url(); ?>extension/js/jquery_multi.js"></script>

    <link href="<?php echo base_url(); ?>extension/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>extension/css/4-col-portfolio.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>extension/css/slide_bar.css" rel="stylesheet">

</head>
<script>
    function save_config_time(){

        var alert_kill = $("#alert_kill option:selected").val();
        var block_time = $("#block_time option:selected").val();

        $.ajax({
            url:"save_setting_agent",
            type:"POST",
            cache:false,
            data:"alert_kill="+alert_kill+"&block_time="+block_time,
            success:function(res)
            {
            if(res=="ok")
            {
                alert('Save success to Click Activate for Working!');
            }
            },
            error:function(err)
            {
                alert("error");
            }

            });

    }

    function config_time(){

            var a = "localhost";
            var f = ":9000/config_time";
            var s = "http://";
            var g = s.concat(a);
            var h = g.concat(f);
            $.post(h,function(data){

                var log_time = data;
                var obj      = jQuery.parseJSON(log_time);
                var ip       = obj['ip'];
                var event    = obj['event'];


                          $.ajax({
                          url:"log_activate",
                          type:"POST",
                          cache:false,
                          data:"ip="+ip+"&event="+event,
                          success:function(res)
                          {
                            if(res=="ok")
                            {
                                alert('ok');
                            }
                          },
                          error:function(err)
                            {
                              alert("error");
                            }

                            });
            });
        }
</script>


    <nav class="navbar navbar-default navbar-fixed-top topnav" style="background-color:black; margin: 0px;  " role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="<?php echo base_url(); ?>index.php/dashboard_control/show_on_off">Monitoring Computer</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <li class="dropdown" text-color = "red" style="background-color:black">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><font color="green"><?php echo $this->session->userdata('user_firstname');?> <?php  echo $this->session->userdata('user_lastname');?></font><font color="blue"> (<?php  echo $this->session->userdata('user_position');?>)</font><span class="caret" ></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="<?php echo base_url();?>index.php/index_control/logout">Logout</a></li>
                              </ul>
                        </li> 
                    </li>
                </ul>  
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


<nav class="navbar navbar-inverse sidebar " role="navigation" style="top:50px">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Menu</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php if($this->session->userdata('user_position') == 'admin'){ ?>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="dashboard"><a href="<?php echo base_url();?>index.php/dashboard_control/show_on_off">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-dashboard"></span></a></li>
                <li id="process_management"><a href="<?php echo base_url();?>index.php/policy_control/manage_process">Process Policy Management<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a></li>
                <li id="internet_management"><a href="<?php echo base_url();?>index.php/policy_control/setting">Internet Policy Management<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
                <li id="notification"><a href="<?php echo base_url();?>index.php/notification_control/index_admin_alert">Log Event<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bell"></span></a></li>
                <li id="notification"><a href="" data-toggle="modal" data-target="#myModal_1">Agent Management<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-time"></span></a></li>
            </ul>
        </div>
        <?php }elseif($this->session->userdata('user_position') == 'teacher'){ ?>
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <li id="dashboard"><a href="<?php echo base_url();?>index.php/dashboard_control/show_on_off">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-dashboard"></span></a></li>
                <li id="internet_management"><a href="<?php echo base_url();?>index.php/policy_control/setting">Internet Policy Management<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
                <li id="notification"><a href="<?php echo base_url();?>index.php/policy_control/process_tracking">Process Tracking<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pushpin"></span></a></li>
                <li id="notification"><a href="<?php echo base_url();?>index.php/notification_control/index_admin_alert">Log Event<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bell"></span></a></li>
                <li id="notification"><a href="" data-toggle="modal" data-target="#myModal_1">Agent Management<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-time"></span></a></li>
            </ul>
        </div>


        <?php } ?>
    </div>


    <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Agent policy setting</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <div class="row">
              <div class="col-xs-6">
              <label><font color="green">New Policy</font></label>
              <hr>
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Check Process every :</label>
                    <select class="selectpicker" data-size="5" id="alert_kill" name="alert_kill">
                      <option data-subtext="Second" value="30">30</option>
                      <option data-subtext="Minute" value="60">1</option>
                      <option data-subtext="Minute" value="180">3</option>
                      <option data-subtext="Minute" value="300">5</option>
                      <option data-subtext="Minute" value="600">10</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="form-control-label">Check Block every:</label>
                    <select class="selectpicker" data-size="5" id="block_time" name="block_time">
                      <option data-subtext="Second" value="30">30</option>
                      <option data-subtext="Minute" value="60">1</option>
                      <option data-subtext="Minute" value="180">3</option>
                      <option data-subtext="Minute" value="300">5</option>
                      <option data-subtext="Minute" value="600">10</option>
                    </select>
                  </div>
                </form>
              </div>
            <div class="col-xs-6">
                            <label><font color="blue">Current Policy</font></label>
                            <hr>
                        <?php 
                            $json      = file_get_contents('http://localhost/project/extension/file/config_time.json');
                            $json_data = json_decode($json,true);
                        ?>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Check Process every :</label>
                        <input type="text" class="form-control" id="recipient-name" value="<?php echo ($json_data['time_alert_kill']/1000)?> Second" disabled>
                    </div>          
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Check Block every:</label>
                        <input type="text" class="form-control" id="recipient-name" value="<?php echo ($json_data['time_to_block']/1000)?> Second" disabled>
                    </div>
                </div>
        </div>
        </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save" onclick="save_config_time();">
                <input type="submit" class="btn btn-success" value="Activate" onclick="config_time();">
            </div>
        </div>
  </div>
</div>
</nav>




</html>
<body>

<div class="main">