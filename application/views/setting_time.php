<!DOCTYPE html>
<html>
<table align="center" width="1000">
<tr>
<td>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- <link href="<?php echo base_url(); ?>extension/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link href="<?php echo base_url(); ?>extension/css/datepicker3.css" rel="stylesheet"> -->
<link href="<?php echo base_url(); ?>extension/css/chart.css" rel="stylesheet">


<script src="<?php echo base_url(); ?>extension/js/lumino.glyphs.js"></script>


<script>
	    function config_time(){

            var a = "localhost";
            var f = ":9000/config_time";
            var s = "http://";
            var g = s.concat(a);
            var h = g.concat(f);
            $.post(h,function(data){

                var log_time = data;
                var obj 	 = jQuery.parseJSON(log_time);
                var ip 		 = obj['ip'];
                var event 	 = obj['event'];


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

        //  });
        //   });
        // });


  }
</script>
</head>
<body>

	<div class="row">
  		<div class="col-xs-6">

  		<div align="widget-left">
 			<div><img src="<?php echo base_url(); ?>extension/img/time.jpg " style="width:60px;height:60px;"  hspace="10" vspace="10""><FONT><b>ตั้งค่าเวลาการทำงานเครื่องลูกข่าย</b></font><br></FONT><br>
  		</div><br><br>

  		<form method="post" action="<?php echo base_url()?>index.php/control/save_setting_agent">

  		<div class="form-group row">
  		Send use data Agent &nbsp:
	  		<select class="selectpicker" data-size="5" id="send_data" name="send_data">
			  <option data-subtext="Second" value="30">30</option>
			  <option data-subtext="Minute" value="60">1</option>
			  <option data-subtext="Minute" value="180">3</option>
			  <option data-subtext="Minute" value="300">5</option>
			  <option data-subtext="Minute" value="600">10</option>
			</select>
		</div>
		<div class="form-group row">
		Setting time to Policy :
			<select class="selectpicker" data-size="5" id="alert_kill" name="alert_kill">
			  <option data-subtext="Second" value="30">30</option>
			  <option data-subtext="Minute" value="60">1</option>
			  <option data-subtext="Minute" value="180">3</option>
			  <option data-subtext="Minute" value="300">5</option>
			  <option data-subtext="Minute" value="600">10</option>
			</select>
		</div>
		<div class="form-group row">
		Setting time to Block &nbsp:
			<select class="selectpicker" data-size="5" id="time_block" name="time_block">
			  <option data-subtext="Second" value="30">30</option>
			  <option data-subtext="Minute" value="60">1</option>
			  <option data-subtext="Minute" value="180">3</option>
			  <option data-subtext="Minute" value="300">5</option>
			  <option data-subtext="Minute" value="600">10</option>
			</select>
		</div>
		<div class="col-md-6 col-md-offset-3">
		<div class="row">
			  <input type="submit" name="submit" id="submit" value="Save" class="btn btn-info">
			  <input type="button" name="btn" id="btn" value="Activate" class="btn btn-success" onclick="config_time();">
		</div>
		</div>

		</form>
		</div>

		</form>
	</div>
	<div class="col-xs-6">
  		<div align="widget-left">
 			<div><img src="<?php echo base_url(); ?>extension/img/time.jpg " style="width:60px;height:60px;"  hspace="10" vspace="10""><FONT><b>แสดงเวลาตั้งค่าปัจจุบัน</b></font><br></FONT><br>
  		</div><br><br>

  		<?php 
					$json 	   = file_get_contents('http://localhost/project/extension/file/config_time.json');
					$json_data = json_decode($json,true);

		?>

			<div class="form-group row">
			  <label for="example-text-input" class="col-md-5 col-form-label">Send use data Agent</label>
			  <div class="col-md-6">
			    <input class="form-control" type="int" value="<?php echo ($json_data['time_send_data']/1000)?> วินาที" id="example-text-input" disabled>
			  </div>
			</div>

			<div class="form-group row">
			  <label for="example-text-input" class="col-md-5 col-form-label">Setting time to Policy</label>
			  <div class="col-md-6">
			    <input class="form-control" type="int" value="<?php echo ($json_data['time_alert_kill']/1000)?> วินาที" id="example-text-input" disabled>
			  </div>
			</div>

			<div class="form-group row">
			  <label for="example-text-input" class="col-md-5 col-form-label">Setting time to Block</label>
			  <div class="col-md-6">
			    <input class="form-control" type="int" value="<?php echo ($json_data['time_to_block']/1000)?> วินาที" id="example-text-input" disabled>
			  </div>
			</div>
	</div>




<br><br>
</body>
</html>