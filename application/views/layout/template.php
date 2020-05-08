<?php include('head.php');?>
  <body class="scroll <?=($this->session->has_userdata('isAdmin'))? 'bg-dark':''?>">
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
			<div class="alert-<?=$color?>" role="alert">
				<button type="button" class="alert">&times;</button>
				<?=$message?>
			</div>
			<?php } ?>

					
		<div class="main-content">
				<?php $this->load->view($contents); ?>
		</div>
			

		<div>
			<?php $this->load->view('/layout/footer'); ?>
		</div>

		<?php if($this->session->has_userdata('idUser') || $this->session->has_userdata('idTeacher')){?>
		  	<div id="contact-button">
				<button href="#" data-target="modal-mail" onclick="modalOpen(this)">
					<i class="fas fa-envelope fa-lg mr-2"></i>Contact Us
				</button>
			</div>
		<?php }?>
		
		<!-- Modal -->
		<div class="modal" id="modal-mail">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Write to us</h5>
					<button type="button" data-target="modal-mail" onclick="modalClose(this)">
						&times;
					</button>
				</div>
				<div class="modal-body">
					<?=form_open('user/sendEmail',array('class' => 'form'))?>
						<div class="inline-label-icon">
							<i class="fas fa-tag prefix grey-text"></i>
							<label data-error="wrong" data-success="right" for="subject">Subject</label>
						</div>
						<input name="subject" type="text" id="subject">
		
						<div class="inline-label-icon">
							<i class="fas fa-pencil-alt"></i>
							<label data-error="wrong" data-success="right" for="form8">Your message</label>
						</div>
						<textarea name="message" type="text" rows="4"></textarea>
				</div>
				<div class="modal-footer">
					<button type="submit" class="button"><i class="fas fa-paper-plane"></i>Send</button>
					<?=form_close()?>
				</div>
			</div>
		</div>

		<script src="<?=base_url('js/app.js')?>"></script>
  </body>
</html>


