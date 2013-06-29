<?php ini_set('display_errors', 'on'); ?>
<?php include_once('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title><?php echo ucwords($myname); ?></title>

	    <!-- CSS -->
	    <link href="<?php echo "css/bootstrap/bootstrap.css" ?>" rel="stylesheet">
	    <style type="text/css">

			/* Custom page CSS
			-------------------------------------------------- */
			/* Not required for template or sticky footer method. */

			.container {
				width: auto;
				max-width: 980px;
			}
			.container .credit {
				margin: 20px 0;
			}

	    </style>
      <link href="<?php echo "css/bootstrap/bootstrap-responsive.css" ?>" rel="stylesheet">
      <link href="<?php echo "css/style.css" ?>" rel="stylesheet">

	</head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="brand" href="index.php"><?php echo ucwords($myname); ?></a>

            <div class="nav-collapse collapse">
              <ul class="nav pull-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="status.php">Status</a></li>
              </ul>
            </div><!--/.nav-collapse -->

          </div><!--/.container-fluid -->
        </div><!--/.navbar-inner -->
      </div>


      <!-- Begin page content -->
      <div class="container" style="margin-top:60px;">

        <?php foreach ($services as $service_name => $details) { ?>
        <div class="accordion" id="accordion-<?php echo $service_name; ?>">

          <div class="accordion-group">                  
            <div class="accordion-heading">              
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?php echo $service_name; ?>" href="#collapseOne-<?php echo $service_name; ?>">
                <?php echo ucwords($service_name); ?>
              </a> 
            </div>
            <div id="collapseOne-<?php echo $service_name; ?>" class="accordion-body collapse in">
              <div class="accordion-inner">

                <br />                
                <div id="<?php echo $service_name;?>-msg-block">
                  <div class="alert alert-block alert-info">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    Not connected to <?php echo ucwords($service_name); ?> Service
                  </div>
                </div>

              </div>
            </div>
          </div>
                        
          <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?php echo $service_name; ?>" href="#collapseTwo-<?php echo $service_name; ?>">
                  <?php echo ucwords($service_name); ?> Server Details
                </a>
              </div>        
              <div id="collapseTwo-<?php echo $service_name; ?>" class="accordion-body collapse">
                <div class="accordion-inner">
                  <pre>
                    <?php print_r($details); ?>
                  </pre>
                </div>
              </div>
          </div>
          
        </div>

      <?php } ?>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Opscode Chef Deployment Demo by <a href="http://martinbean.co.uk">Jai Bapna</a></p>
      </div>
    </div>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <script type="text/javascript">

      var $services = <?php echo json_encode($services); ?>;
      var $self = <?php echo json_encode($self); ?>;
      var $myname = <?php echo json_encode($myname); ?>;
      var $app = <?php echo json_encode($app); ?>;      

      $(document).ready(function() {    

          for (var $service_name in $services) {
            doAjax($service_name);
          }

          function doAjax($service_name) {

            $url = 'http://'+$services[$service_name]['automatic']['ec2']['public_ipv4']+'/demo-'+$service_name+'/status.php';
            
            $.ajax({
              url: $url,
              type: 'GET',
              dataType: 'json',
              statusCode: {

                200: function(data) {

                  $class = new Array();
                  $class['Yellow'] = '';
                  $class['Green'] = 'alert-success';
                  
                  $msg = '<div class="alert alert-block ' + $class[data['status']] + '">\
                            <button type="button" class="close" data-dismiss="alert">x</button>\
                            <p>Last Updated: '+ getTime() + '</p>\
                            <p>\
                              Request ID: ' + data['id'] + '<br />\
                              Name: ' + data['name'] + '<br />' +
                              data['message'] + 
                            '</p>\
                          </div>';


                  $('#'+$service_name+'-msg-block').empty().html($msg);

                },
                500: function() {

                  $msg = '<div class="alert alert-block alert-error">\
                            <button type="button" class="close" data-dismiss="alert">x</button>\
                            Cannot connect to service. Internal Service Error.\
                          </div>';

                  $('#'+$service_name+'-msg-block').empty().html($msg);

                },
                404: function() {

                  $msg = '<div class="alert alert-block alert-error">\
                            <button type="button" class="close" data-dismiss="alert">x</button>\
                            Cannot connect to service. Service Not Found.\
                          </div>';

                  $('#'+$service_name+'-msg-block').empty().html($msg);

                }
              },
              complete: function() {
                
                setTimeout(function(){
                  doAjax($service_name);
                },3000);

              }

            });

          }

          function getTime() {
            d = new Date();
            var time = d.toLocaleTimeString();
            return time;
          }


      });

  </script>
  </body>
</html>
