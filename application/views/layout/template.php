<!doctype html>
<html lang="en">
  <head>
    <title><?= $title;?></title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-signin-client_id" 
    content="293153048084-oh88r7c3hf34sp3q3vlkbb43p8m4j7tn.apps.googleusercontent.com">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
		<link rel="icon" href="<?=base_url()?>logo.ico">
		<link rel="stylesheet" href="<?= base_url()?>css/custom.css">
    <link href="<?= base_url()?>css/all.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/all.js"></script>
    <link href="<?= base_url()?>css/solid.css" rel="stylesheet">
    <script defer src="<?= base_url()?>js/solid.js"></script>
		
  </head>
  <body>
		  <div>
				<?php 
					if($this->session->userdata('idUser') || $this->session->userdata('idTeacher')){
						$this->load->view('/layout/navigation'); 
					} else $this->load->view('/layout/guest_navigation');
				?>
		  </div>

		  <div class="container-fluid">
        <div class="row">
          <div class="col-xs py-5 px-5">
						<div class="row justify-content-center py-3">
							<div class="cleanslate w24tz-current-time w24tz-middle" 
								style="display: inline-block !important; visibility: hidden !important; min-width:300px !important; min-height:145px !important">
								<p><a href="//24timezones.com/Manila/time" style="text-decoration: none" class="clock24" id="tz24-1585030937-c1145-eyJob3VydHlwZSI6IjEyIiwic2hvd2RhdGUiOiIxIiwic2hvd3NlY29uZHMiOiIxIiwiY29udGFpbmVyX2lkIjoiY2xvY2tfYmxvY2tfY2I1ZTc5YTcxOWQ1ZmQzIiwidHlwZSI6ImRiIiwibGFuZyI6ImVuIn0=" 
									title="Manila - Clock" target="_blank" rel="nofollow">Taguig</a>
								</p>
								<div id="clock_block_cb5e79a719d5fd3"></div>
							</div>
								<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>		
						</div>
						<div class="row justify-content-center py-3">
							<iframe src="https://calendar.google.com/calendar/embed?height=300&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=Asia%2FManila&amp;showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0&amp;showCalendars=0&amp;mode=MONTH" 
							style="border-width:0" width="300" height="300" frameborder="0" scrolling="no"></iframe>
						</div>
						<div class="row">
							<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftaguigcity%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" 
							width="340" height="500" style="border:none;overflow:hidden" 
							scrolling="no" frameborder="0" allowTransparency="true" 
							allow="encrypted-media">
							</iframe>
						</div>
					</div>
					
          	<div class="col-xl">
			      <?php $this->load->view($contents); ?>
					</div>
					
          	<div class="col-xs py-5 px-5">
				  <div class="row py-3">
					  <?php if(isset($side_content_1)) $this->load->view($side_content_1);?>
				  </div>
				  <div class="row py-3">
				  	<?php if(isset($side_content_2)) $this->load->view($side_content_2);?>
				  </div>
			</div>
					
        </div>
		  </div>

		  <div>
			  <?php $this->load->view('/layout/footer'); ?>
		  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
