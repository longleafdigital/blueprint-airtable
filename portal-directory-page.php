<?php
/**
 * Template Name: Partner Portal - Directory Template
 *
 * @package Shoreditch
 */

get_header(); ?>

<?php if ( is_user_logged_in() ) { ?>

<?php
$profile = $_GET['profile'];
$areas = $_GET['areas'];
$capacities = $_GET['capacities'];
$workgroups = $_GET['workgroups'];
//echo $profile;

$query = new AirpressQuery();
$query->setConfig("default");
$query->table("Table 1")->view("Grid view");

//
//filter is working, needs to be attached to URL parameter logic.
if (isset($areas)):
	$query->filterByFormula("FIND('$areas',{Issue Areas})");
elseif (isset($capacities)):
	$query->filterByFormula("FIND('$capacities',{Strategic Capacities})");
elseif (isset($workgroups)):
	$query->filterByFormula("FIND('$workgroups',{Blueprint Workgroups})");
endif;

$orgs = new AirpressCollection($query);

//
//
//set new API query to have unfiltered results
$query_base = new AirpressQuery();
$query_base->setConfig("default");
$query_base->table("Table 2")->view("Grid view");
$query->filterByFormula("FIND({Organization Name}=_Test_Partner");

$base = new AirpressCollection($query_base);

foreach($base as $base_org) {
  $issue_areas = ($base_org['Issue Areas']);
  $strategic_capacities = ($base_org['Strategic Capacities']);
  $blueprint_workgroups = ($base_org['Blueprint Workgroups']);
}

//get value for Issue Areas from attachment field array
//$issue_areas = $base['Issue Areas'];
//print_r($issue_areas);
?>


<?php get_template_part( 'portal', 'nav' ); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<main id="main" class="site-main" role="main">
				<div id="directory_list" class="container">
				<span class="directory-info">Number of Partners:&nbsp;<span data-count="<?= count($orgs) ?>" class="counter"></span></span>
					<?php foreach($orgs as $org):
						$org_slug = urlencode($org['Organization Name']); ?>
					<div class='organization-card row'>
						<div class="col-12 col-lg-9">
							<h3><?= $org["Organization Name"] ?></h3>
							<span><?= $org["Office Address 1"] ?></span><br>
							<span><?= $org["Office Address City/State"] ?>&nbsp;<?= $org["Office Address Zip"] ?></span><br>
							<span><i class="fas fa-phone fa-xs"></i> <?= $org["Office Phone"] ?></span>
						</div>
						<div class="col-12 col-lg-3">
							<a class="profile-button" href="/partner-portal-profile/?profile=<?php echo $org_slug ?>">Profile&nbsp;&nbsp;<i class="fas fa-arrow-right fa-xs"></i></a>
							<br>
							<ul class="profile-social">
								<li><a href="https://facebook.com/<?= $org["Facebook Handle"] ?>"><i class="fab fa-facebook fa-lg"></i></a></li>
								<li><a href="https://twitter.com/<?= $org["Twitter Handle"] ?>"><i class="fab fa-twitter-square fa-lg"></i></a></li>
								<li><a href="https://www.instagram.com/<?= $org["Instagram Handle"] ?>"><i class="fab fa-instagram fa-lg"></i></a></li>
							</ul>
							<br>
							<a class="profile-link" href="<?= $org["Website"] ?>">Website <i class="fas fa-external-link-alt fa-xs"></i></a>
						</div>
					</div>
					<?php endforeach; ?>
				</div><!-- .row -->
			</main><!-- #main -->
		</div>
		<div class="col-lg-4">
			<div class="directory-download-link">
				<a href="#"><i class="fas fa-file-pdf"></i> Download Directory</a>
			</div>
			
			<!-- Tags/Filtering dropdowns -->
			<select name="issues" id="tag_filter">
			<option selected="selected">Issue Areas</option>
			<?php
				foreach($issue_areas as $area) { ?>
					<option value="<?= $area ?>"><?= $area ?></option>
				<?php
			} ?>
			</select>
			
			<select name="capacities" id="tag_filter">
			<option selected="selected">Strategic Capacities</option>
			<?php
				foreach($strategic_capacities as $capacity) { ?>
					<option value="<?= $capacity ?>"><?= $capacity ?></option>
				<?php
			} ?>
			</select>
			
			<select name="workgroups" id="tag_filter">
			<option selected="selected">Blueprint Workgroups</option>
			<?php
				foreach($blueprint_workgroups as $workgroup) { ?>
					<option value="<?= $workgroup ?>"><?= $workgroup ?></option>
				<?php
			} ?>
			</select>
			<!-- Tags/Filtering dropdowns END -->
			
			<div class="datapoints-section">
				<h4>Blueprint Partners<br>Data Points</h4>
				<div>Total Number of Partners: <span>25</span></div>
				<div>Partners using the VAN: <span>23</span></div>
				<div>Smallest Partner Staff: <span>1</span></div>
				<div>Largest Partner Staff: <span>250</span></div>
			</div>
		</div>
	</div>
</div>


<script>
$('select[name="issues"]').change(function() {
	var issues = $( 'select[name="issues"]' ).val();
	window.location.search = "&areas="+issues;
});

$('select[name="capacities"]').change(function() {
	var capacities = $( 'select[name="capacities"]' ).val();
	window.location.search = "&capacities="+capacities;
});

$('select[name="workgroups"]').change(function() {
	var workgroups = $( 'select[name="workgroups"]' ).val();
	window.location.search = "&workgroups="+workgroups;
});

//Added scripts to make number count-up visualization
$('.counter').each(function() {
  var $this = $(this),
	  countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
	countNum: countTo
  },

  {

	duration: 1000,
	easing:'linear',
	step: function() {
	  $this.text(Math.floor(this.countNum));
	},
	complete: function() {
	  $this.text(this.countNum);
	  //alert('finished');
	}

  });
});
</script>

<?php } else { ?>
<div class="container">
	<div class="row">
		<div id="user_login" class="col-lg-12">
			<p>This section of the site is for authenticated users only. Please login to access.</p>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login"><i class="fas fa-user-circle"></i> Log In</a>
		</div>
	</div>
</div>
<?php } ?>

<?php
get_sidebar( 'footer' );
get_footer();
