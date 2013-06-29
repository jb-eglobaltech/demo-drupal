<?php ini_set('display_errors', 'on'); ?>
<?php include_once('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title><?php echo ucwords($self); ?> Application</title>

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

            <a class="brand" href="http://localhost:8888/laravel/"><?php echo ucwords($self); ?></a>

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

        <?php foreach ($instances as $name => $instance) { ?>
        <?php // if ($name==$self) continue; ?>
        <div class="accordion" id="accordion-<?php echo $name; ?>">

          <div class="accordion-group">                  
            <div class="accordion-heading">              
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?php echo $name; ?>" href="#collapseOne-<?php echo $name; ?>">
                <?php echo ucwords($name); ?>
              </a> 
            </div>
            <div id="collapseOne-<?php echo $name; ?>" class="accordion-body collapse in">
              <div class="accordion-inner">

                <br />                
                <div id="<?php echo $name;?>-msg-block">
                  <div class="alert alert-block alert-info">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    Not connected to <?php echo ucwords($name); ?> Service
                  </div>
                </div>

              </div>
            </div>
          </div>
                        
          <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-<?php echo $name; ?>" href="#collapseTwo-<?php echo $name; ?>">
                  <?php echo ucwords($name); ?> Server Details
                </a>
              </div>        
              <div id="collapseTwo-<?php echo $name; ?>" class="accordion-body collapse">
                <div class="accordion-inner">
                  <pre>
                    <?php print_r($instance); ?>
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

      var $instances = <?php echo json_encode($instances); ?>;
      var $self = <?php echo json_encode($self); ?>;

      $(document).ready(function() {    

          for (var $name in $instances) {
            //if($name==$self) continue;
            doAjax($name);
          }

          function doAjax($name) {

            $url = 'http://'+$instances[$name]['automatic']['ec2']['public_ipv4']+'/status.php';
            
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
                            <p>Name: '+ data['name'] + '</p>\
                            '+data['message']+'\
                          </div>';

                  $('#'+$name+'-msg-block').empty().html($msg);

                },
                500: function() {

                  $msg = '<div class="alert alert-block alert-error">\
                            <button type="button" class="close" data-dismiss="alert">x</button>\
                            Cannot connect to service. Internal Service Error.\
                          </div>';

                  $('#'+$name+'-msg-block').empty().html($msg);

                },
                404: function() {

                  $msg = '<div class="alert alert-block alert-error">\
                            <button type="button" class="close" data-dismiss="alert">x</button>\
                            Cannot connect to service. Service Not Found.\
                          </div>';

                  $('#'+$name+'-msg-block').empty().html($msg);

                }
              },
              complete: function() {
                
                setTimeout(function(){
                  doAjax($name);
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
