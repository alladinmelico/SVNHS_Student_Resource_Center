<?php include('head.php');?>
  <body class="scroll <?=($this->session->has_userdata('isAdmin'))? 'elegant-color-dark':''?>">
		<?php 
			if($this->session->userdata('isAdmin')){
				$this->load->view('/layout/admin_navigation');
			}elseif($this->session->userdata('idUser') || $this->session->userdata('idTeacher')){
				$this->load->view('/layout/navigation'); 
			} else $this->load->view('/layout/guest_navigation');
		?>

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

		<div class="main">
			<?php if((($this->uri->segment(1)) == 'user') || (($this->uri->segment(1)) == 'teacher') || (($this->uri->segment(1)) == '')){?>
				<div class="left-container">
					<div class="clock-container">
						<p>Philippine Standard Time</p>
						<div id="clock"></div>
					</div>
					<div class="calendar"></div>
				</div>	
			<?php }?>	
					
			<div class="main-content">
					<?php $this->load->view($contents); ?>
			</div>
				
			<?php if((($this->uri->segment(1)) == 'user') || (($this->uri->segment(1)) == 'teacher') || (($this->uri->segment(1)) == '')){?>
				<div class="right-container">
					<div class="side-container">
						<?php if(isset($side_content_1)) $this->load->view($side_content_1);?>
					</div>
					<div class="side-container">
						<?php if(isset($side_content_2)) $this->load->view($side_content_2);?>
					</div>
				</div>
			<?php }?>
		</div>

		<div>
			<?php $this->load->view('/layout/footer'); ?>
		</div>

		<?php if($this->session->has_userdata('idUser') || $this->session->has_userdata('idTeacher')){?>
		  	<div class="fixed-bottom d-flex justify-content-end">
				<a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">
				<i class="fas fa-envelope fa-lg mr-2"></i>Contact Us
				</a>
			</div>
		<?php }?>

		<script src="<?=base_url('js/app.js')?>"></script>
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


