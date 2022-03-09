<?php
/**
 * Template Name: Partner Portal - Profile Template
 *
 * @package Shoreditch
 */

get_header(); ?>

<?php if ( is_user_logged_in() ) { ?>

<?php
$profile = $_GET['profile'];
//echo $profile;

$query = new AirpressQuery();
$query->setConfig("default");
$query->table("Table 1")->view("Grid view");
$query->filterByFormula("{Organization Name}='$profile'");

$orgs = new AirpressCollection($query);

foreach($orgs as $org){
  //echo $org["Organization Name"].": ".$org["Website"]."<br>";
}

//get URL for header image from attachment field array
$hero_img_fields = $org["Main Hero Image"];

foreach($hero_img_fields as $hero_img){
	$hero_url = $hero_img["url"];
}
///

//get URL for logo image from attachment field array
$logo_img_fields = $org["Organization Logo"];

foreach($logo_img_fields as $logo_img){
	$logo_url = $logo_img["url"];
}
///

//prepare each field in Issue Areas array for display

///

?>

<?php get_template_part( 'portal', 'nav' ); ?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<main id="main" class="site-main" role="main">
				<div class="container">
					<!-- profile hero image container -->
					<div class="hero-image" style="background-image: linear-gradient(rgba(25, 55, 97, 0.55), rgba(25, 55, 97, 0.85)), url('<?= $hero_url ?>');">
						<div class="hero-text">
							<h2><?= $org["Organization Name"] ?></h2>
						</div>
						<div class="hero-logo">
							<img src="<?= $logo_img["url"] ?>" />
						</div>
					</div>
					
					<!-- organization information row -->
					<div id="org_info" class="row">
						<div class="col-4">
							<span><?= $org["Office Address 1"] ?></span><br>
							<span><?= $org["Office Address City/State"] ?>&nbsp;<?= $org["Office Address Zip"] ?></span><br>
							<span><i class="fas fa-phone fa-xs"></i> <?= $org["Office Phone"] ?></span>
						</div>
						
						<div class="col-4">
							<span><i class="fab fa-facebook"></i> <?= $org["Facebook Handle"] ?></span><br>
							<span><i class="fab fa-twitter-square"><a href="https://twitter.com/<?= $org["Twitter Handle"] ?>"></i> <?= $org["Twitter Handle"] ?></a></span><br>
							<span><i class="fab fa-instagram"></i><a href="https://www.instagram.com/<?= $org["Instagram Handle"] ?>"><?= $org["Instagram Handle"] ?></a></span><br>
						</div>
						
						<div class="col-4">
							<span><a href="https://<?= $org["Website"] ?>">Website&nbsp;<i class="fas fa-external-link-alt"></i></a></span><br>
							<span><a href="#"><i class="fas fa-file-pdf"></i> Directory PDF</a></span><br>
						</div>
					</div>
					
					<!-- start of main content row -->
					<div id="org_content_main" class="row">
						<div class="col-sm-8">
							<div class="organization-contacts">
								<div class="row">
									<div class="col-1">
										<i class="fas fa-address-card fa-2x"></i>
									</div>
									<div class="col-4">
										<span><strong><?= $org["Executive Director"] ?></strong></span><br>
										<span>Executive Director</span><br>
										<span><a href="mailto:<?= $org["Executive Director Email"] ?>"><?= $org["Executive Director Email"] ?></a></span>
									</div>
									<div class="col-1">
									</div>
									<div class="col-1">
										<i class="fas fa-address-card fa-2x"></i>
									</div>
									<div class="col-4">
										<span><strong><?= $org["Communications"] ?></strong></span><br>
										<span>PR/Communications</span><br>
										<span><a href="mailto:<?= $org["Communications Email"] ?>"><?= $org["Communications Email"] ?></a></span>
									</div>
								</div>
								<div class="row staff-totals">
									<div class="col-12">
										<span>Total number of staff: <strong><?= $org["Number of Staff"] ?></strong></span>
									</div>
								</div>
							</div>
							<div class="organization-description-text">
								<p><?= $org["Description Paragraph 1"] ?></p>
								<p><?= $org["Description Paragraph 2"] ?></p>
								<p><?= $org["Description Paragraph 3"] ?></p>
								<p><?= $org["Description Paragraph 4"] ?></p>
							</div>
							<div class="organization-additional-text">
								<h3>How is our state better because of the work of your organization?</h3>
								<p><?= $org["How is Our State Better?"] ?></p>
								<h3>How can Blueprint partners support this organization and your cause?</h3>
								<p><?= $org["How Can Blueprint Support?"] ?></p>
								<h3>Does your organization use VAN?</h3>
								<p><?= $org["Use Van?"] ?></p>
							</div>
						</div>
						<div id="profile_categories" class="col-sm-4">
							<h3>Issue Areas</h3>
							<div class="issue-areas">
								<?php
								$issue_areas_array = $org["Issue Areas"];
								foreach($issue_areas_array as $issue_area){
									$issue_area_display = "<span class='profile-tag'><a href=/partner-portal-directory/?areas=".urlencode ($issue_area).">".$issue_area."</a></span>";
									echo $issue_area_display;
								}
								?>
							</div>
							<h3>Strategic Capacities</h3>
							<div class="strategic-capacities">
								<?php
								$strategic_caps_array = $org["Strategic Capacities"];
								foreach($strategic_caps_array as $strategic_caps){
									$strategic_caps_display = "<span class='profile-tag'><a href=http://blueprintnc.org/partner-portal-directory/?capacities=".urlencode ($strategic_caps).">".$strategic_caps."</a></span>";
									echo $strategic_caps_display;
								}
								?>
							</div>
							<h3>Blueprint Workgroups</h3>
							<div class="blueprint-workgroups">
								<?php
								$blueprint_workgroups_array = $org["Blueprint Workgroups"];
								foreach($blueprint_workgroups_array as $blueprint_workgroup){
									$blueprint_workgroup_display = "<span class='profile-tag'><a href=http://blueprintnc.org/partner-portal-directory/?workgroups=".urlencode ($blueprint_workgroup).">".$blueprint_workgroup."</a></span>";
									echo $blueprint_workgroup_display;
								}
								?>
							</div>
						</div>
					</div><!-- .row -->
					<div class ="directory-backlink">
						<a href="/partner-portal-directory/" class=""><i class="fas fa-arrow-circle-left"></i> Partner Directory</a>
					</div>
				</div><!-- .container -->
			</main><!-- #main -->
		</div>
	</div>
</div>

<script>
$('.organization-description-text').readmore({
  collapsedHeight: 300,
  heightMargin: 16,
  speed: 25,
  lessLink: '<a class="readmore-link" href="#"><i class="fas fa-minus-circle"></i> show less</a>',
  moreLink: '<a class="readmore-link" href="#"><i class="fas fa-plus-circle"></i> show more</a>'
});
</script>

<?php } else { ?>

	<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>

<?php } ?>

<?php
get_sidebar( 'footer' );
get_footer();
