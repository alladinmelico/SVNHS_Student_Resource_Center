<?php include('head.php');?>
  <body>
		  <div>
				<?php 
					if($this->session->userdata('isAdmin')){
						$this->load->view('/layout/admin_navigation');
					}elseif($this->session->userdata('idUser') || $this->session->userdata('idTeacher')){
						$this->load->view('/layout/navigation'); 
					} else $this->load->view('/layout/guest_navigation');
				?>
		  </div>

		  <?php
		  	if($this->session->flashdata()){
				if($this->session->flashdata('emailSend')){
					$color = 'success';
					$message = 'Mail has been sent!';
				}
				if($this->session->flashdata('invalidCode')){
					$color = 'danger';
					$message = 'Invalid Code';
				}

				if($this->session->flashdata('isRequested')){
					$color = 'info';
					$message = 'You already requested to join the class, Please wait for the confirmation of your teacher.';
				}

				if($this->session->flashdata('requested')){
					$color = 'info';
					$message = 'Your request to enroll in this class has been submitted, please wait for the confirmation of your teacher.';
				}


			?>
				<div class="alert alert-<?=$color?>" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?=$message?>
				</div>
			<?php } ?>

	<div class="container-fluid ">
        <div class="row">
			<?php if((($this->uri->segment(1)) == 'user') || (($this->uri->segment(1)) == 'teacher') || (($this->uri->segment(1)) == '')){?>
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
			<?php }?>		
			  
			<div class="col-xl no-gutters">
			      <?php $this->load->view($contents); ?>
			</div>
			
			<?php if((($this->uri->segment(1)) == 'user') || (($this->uri->segment(1)) == 'teacher') || (($this->uri->segment(1)) == '')){?>
				<div class="col-xs py-5 px-5">
					<div class="row py-3">
						<?php if(isset($side_content_1)) $this->load->view($side_content_1);?>
					</div>
					<div class="row py-3">
						<?php if(isset($side_content_2)) $this->load->view($side_content_2);?>
					</div>
				</div>
			<?php }?>
        </div>
	</div>

		  <div>
			  <?php $this->load->view('/layout/footer'); ?>
		  </div>

		  <div class="fixed-bottom d-flex justify-content-end">
		  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">
			  <i class="fas fa-envelope fa-lg mr-2"></i>Contact Us

		  </a>
			</div>

  	
  </body>
</html>


<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

		<?=form_open('user/sendEmail')?>

        <div class="md-form mb-5">
          <i class="fas fa-tag prefix grey-text"></i>
          <input name="subject" type="text" id="form32" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form32">Subject</label>
        </div>

        <div class="md-form">
			<i class="fas fa-pencil-alt	prefix grey-text"></i>
          <textarea name="message" type="text" id="form8" class="md-textarea form-control" rows="4"></textarea>
          <label data-error="wrong" data-success="right" for="form8">Your message</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
		<button class="btn btn-info">Send <i class="fas fa-paper-plane ml-1"></i></button>
			
		<?=form_close()?>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('.alert').alert()
</script>
