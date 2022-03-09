<?php
/**
 * The template for displaying the top-nav reserved for portal pages.
 *
 * @package Shoreditch
 */
?>
 
 <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Not For Distribution</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The content of Blueprint North Carolina's password-protected portal is confidential and intended for the recipient of this message only. It is strictly forbidden to share any part of this portal- the directory, resource library, or calendar - with any third party. By proceeding, you agree to these terms and conditions.</p>
      </div>
      <div class="modal-footer">
        <button id="ModalClose" type="button" class="btn btn-primary">I Agree</button>
      </div>
    </div>
  </div>
</div>
 
 
 <div id="portal_nav" class="">
	<h5>Partner</br>Portal</h5>
	<nav>
		<ul>
			<li class="directory"><a href="partner-portal-directory/"><i class="fas fa-address-card"></i> Directory</a></li>
			<li class="calendar"><a href="partner-portal-calendar/"><i class="fas fa-calendar-check"></i> Calendar</a></li>
			<li class="resources"><a href="partner-portal-resource-library/"><i class="fas fa-briefcase"></i> Resources</a></li>
		</ul>
	</nav>
</div>

<script>
$( document ).ready(function() {
	var disclaimermodal = Cookies.get('disclaimermodal_cookie');
	
	if (disclaimermodal != 1){
		$('.modal').modal('show');
	}
});

$( "#ModalClose" ).click(function() {
	$('.modal').modal('hide')
	Cookies.set('disclaimermodal_cookie', '1', { expires: 7 });
});

$( document ).ready(function() {
	if(window.location.pathname == "/partner-portal-directory/"){
		console.log('path name checks');
		$('li.directory').addClass('active');
	}
	
	if(window.location.pathname == "/partner-portal-calendar/"){
		console.log('path name checks');
		$('li.calendar').addClass('active');
	}
	
	if(window.location.pathname == "/partner-portal-resource-library/"){
		console.log('path name checks');
		$('li.resources').addClass('active');
	}
});
</script>