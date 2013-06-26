
<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>Sticky footer &middot; Twitter Bootstrap</title>

	    <!-- CSS -->
	    <link href="<?php echo "css/bootstrap/bootstrap.css" ?>" rel="stylesheet">
	    <style type="text/css">

			/* Custom page CSS
			-------------------------------------------------- */
			/* Not required for template or sticky footer method. */

			.container {
				width: auto;
				max-width: 680px;
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

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Drupal</h1>
        </div>

        <div class="accordion" id="accordion1">
          
          <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#a1-collapseOne">
                  SOLR
                </a>
              </div>
              <div id="a1-collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                  Environment Details
                </div>
              </div>
            </div>
          
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#a1-collapseTwo">
                  CKAN
                </a>
              </div>
              <div id="a1-collapseTwo" class="accordion-body collapse in">
                <div class="accordion-inner">
                  Environment Details
                  <ul class="check_list">
                    <li>Leading a multi-million operation in the development and deployment of global sales, service delivery and billing applications using Siebel, IIS, Oracle, J2EE and .Net, JAVA, J2EE, C++.</li>
                    <li>Managing a staff of 300, including senior professionals located in the United States, England and France.</li>
                  </ul>
                </div>
              </div>
            </div>  
        </div>

      </div>


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
    <script src="js/bootstrap/bootstrap.min.js"></script>

  </body>
</html>
