<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<div id="page">
	<div id="header">
		<div id="topRow">

	<?php
		echo theme('links__system_main_menu', array(
			'links'      => $main_menu,
			'attributes' => array(
				'id' => 'main-menu',
				'class'      => array('links')
			)
		));

		$home_text = t('Home');
		if ($logo) {
			echo "
			<div id=\"logo\">
				<a href=\"$front_page\" title=\"$home_text\" rel=\"home\">
					<img src=\"$logo\"    alt=\"$home_text\" />
				</a>
				</div>
			";
		}

		echo "<div id=\"mobileMenu\"><button class=\"nav-button\"></button></div>";


		if ($site_name) {
			echo "
				<div id=\"site_name\">
					<h1>
						<a href=\"$front_page\" title=\"$home_text\" rel=\"home\">
						$site_name
						</a>
					</h1>

				</div>
			";
		}
echo "
		</div> <!--topRow -->
		<div id=\"headerLinks\">
			<ul>
				<li><i class=\"icon-star\"></i>Dashboard</li>
				<li> <i class=\"icon-comments\"></i>uReport</li>
				<li class=\"last\"><i class=\"icon-user\"></i>myBloomington</li>
			</ul>
		</div>
		";

			if ($site_slogan) {
				echo "<div id=\"site-slogan\"><h2>$site_slogan</h2></div>";
			}

			echo render($page['header']);

	?>
	</div> <!--/#header -->
		<ul class="megadropdown primary-nav">
				<li class="main-nav-item">
					<a href="" class="withDD main-nav-tab">My Government</a>
					<div class="megadropdown-region" id="governmentItem">
						<div class="smleft">
								<div class="topics">
									<ul>
									<div class="item">
										<li><h4>Mayor Mark Kruzan</h4></li>
										<li><a href="/news">City News</a></li>
										<li>State of the City Address</li>
										<li>Proclamations</li>
										<li>More</li>
									</div>
									<div class="item">
										<li><h4>Bloomington Common Council</h4></li>
										<li>Meeting Schedule and Agenda</li>
										<li>Meeting Minutes</li>
										<li>Contacting the Council</li>
										<li>Find your Council Representative</li>
									</div>
									<div class="item">
										<li><h4>Topics</h4></li>
										<li>Citizen Involvement</li>
										<li>City Projects</li>
										<li>City Initiatives</li>
									</div>
									<div class="item">
										<li>Doing Business with the City</li>
										<li>Employment Opportunities</li>
										<li>Municipal Code</li>
										<li>See more about Government</li>
									</div>
									</ul>
								</div>
								<div class="smbottom">
									<h4>City Boards and Commissions</h4>
									<form action="URL">
										<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
											<option>Animal Control Commission</option>
											<option>Bicycle and Pedestrian Safety Commission</option>
											<option>Bloomington Community Arts Commission</option>
											<option>Bloomington Digital Underground Advisory Committee</option>
										</select>
									</form>
									<h4>City Departments</h4>
									<form action="URL">
									<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
									<option value="">Select a department</option>
									<option value="/drupal/content/animal-care-and-control">Animal Care and Control</option>
									<option value="">Bloomington Transit</option>
									<option value="">City Clerk</option>
									<option value="">Community and Family Resources (CFRD)</option>
									<option value="">Controller</option>
									<option value="">Council Office</option>
									<option value="">Economic &amp; Sustainable Development</option>
									<option value="">Engineering</option>
									<option value="">Fire</option>
									<option value="">Housing and Neighborhood Development (HAND)</option>
									<option value="">Human Resources</option>
									<option value="">Information &amp; Technology Services (ITS)</option>
									<option value="">Legal</option>
									<option value="">Office of the Mayor (OOTM)</option>
									<option value="">Parking Enforcement</option>
									<option value="">Parks and Recreation</option>
									<option value="">Planning</option>
									<option value="">Police</option>
									<option value="">Public Works</option>
									<option value="">Risk Management</option>
									<option value="">Sanitation</option>
									<option value="">Street</option>
									<option value="">Traffic</option>
									<option value="">Utilities</option>
									</select>
								</form>
								</div>
						</div>
						<div class="smright">
							<p>
								<img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/contactus.png" />
							</p>
						</div>
					</div>
				</li>
				<li class="main-nav-item">
					<a href="" class="main-nav-tab withDD">I Want to</a>

					<div class="megadropdown-region">
						<div class="smleft">
							<div class="topics">
								<ul>
									<div class="item">
										<li><h4>Apply</h4></li>
										<li>City Jobs</li>
										<li>Board & Commissions</li>
										<li>Foster a shelter animal</li>
										<li>Pet behavior consultation</li>
									</div>
									<div class="item">
										<li><h4>Pay</h4></li>
										<li>Parking Ticket</li>
										<li>Utility Bill</li>
										<li>Parks & Recreation Dept Facilities</li>
										<li>Park Shelterhouses</li>
										<li>Tee Time</li>
									</div>
									<div class="item">
										<li><h4>Sign Up</h4></li>
										<li>Citizen's Academy</li>
										<li>Parks & Recreation Dept programs</li>
										<li>Utilities Services</li>
									</div>
									<div class="item">
										<li><h4>Report</h4></li>
										<li>Things related to:</li>
										<li>Land and Housing</li>
										<li>Traffic, Roads and Sidewalks</li>
										<li>Parks & Trails</li>
										<li>Utilities</li>
										<li>Quality of Living, City Comments</li>
									</div>
								</ul>
							</div>
						</div>
							<div class="smright">
								<h4>Pay Your Utility Bill</h4>
								<p><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/healthinsurance.png" /></p>
							</div>
					</div>
				</li>
				<li class="main-nav-item">
					<a href="" class="main-nav-tab withDD">Learn About</a>

					<div class="megadropdown-region">
						<div class="smleft">
							<div class="topics">
								<ul>
									<div class="item">
										<li>About Bloomington</li>
										<li>Accessibility</li>
										<li><?php echo l("Animals", "node/91"); ?></li>
										<li>Arts & Culture</li>
										<li>Biking and Walking</li>
										<li>Business</li>
										<li>Civic Engagement</li>
										<li>Community Events</li>
									</div>
									<div class="item">
										<li>Diversity</li>
										<li>Employment</li>
										<li><?php echo l("Farmers Market", "node/40"); ?></li>
										<li>Grants and Funding</li>
										<li>Health Resources</li>
										<li>Historic Preservation</li>
										<li><?php echo l("Housing", "taxonomy/term/9"); ?></li>
									</div>
									<div class="item">
										<li>Legislation</li>
										<li>Maps, GIS, Location Tools</li>
										<li>Neighborhoods</li>
										<li><a href="/news">News</a></li>
										<li>Parking</li>
										<li><?php echo l("Parks & Recreation Programs", "node/103"); ?></li>
									</div>
									<div class="item">
										<li>Public Safety</li>
										<li>Residential Services</li>
										<li>Roads and Traffic</li>
										<li><?php echo l("Sports & Fitness", "node/102"); ?></li>
										<li>Sustainable City</a></li>
										<li>Trash and Recycling</li>
										<li>Volunteering</li>
									</div>
								</ul>
							</div>
						<div class="smbottom">
							<h4>Community Facilities</h4>
							<p>Directions, hours, other info</p>
							<form action="URL">
								<fieldset>
									<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
										<option value="">Allison-Jukebox Community Center</option>
										<option value="">Banneker Community Center</option>
										<option value="">Bryan Park Pool</option>
										<option value="">Cascades Golf Course</option>
										<option value="">Frank Southern Ice Arena</option>
										<option value="">Griffy Lake Boathouse</option>
										<option value="">Mills Pool</option>
										<option value="">Skate Park</option>
										<option value="">Twin Lakes Recreation Center</option>
										<option value="">Twin Lakes Sports Park</option>
										<option>Winslow Sports Complex</option>
									</select>
								</fieldset>
							</form>
							<h4>Parks, Trails and Gardens</h4>
							<p>Directions, playground/shelter offerings, other info</p>
							<form action="URL">
								<fieldset>
								<select name="URL" onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
								<option value="">Broadview Park</option>
								<option value="/drupal/content/bryan-park">Bryan Park</option>
								<option value="">Building Trades Park</option>
								<option value="">Clear Creek Trail</option>
								<option value="">Crestmont Park &amp; Garden</option>
								<option value="">Goat Farm</option>
								<option value="">Griffy Lake Nature Preserve</option>
								<option value="">Highland Village Park</option>
								<option value="">Latimer Woods</option>
								<option value="">Leonard Springs Nature Park</option>
								<option value="">Lower Cascades Park</option>
								<option value="">Miller-Showers Park</option>
								<option value="">Olcott Park</option>
								<option value="">Park Ridge East Park</option>
								<option value="">Park Ridge Park</option>
								<option value="">Peoples Park</option>
								<option value="">RCA Park</option>
								<option value="">Rev Ernest D Butler Park</option>
								<option value="">Schmalz Farm Park</option>
								<option value="">Seminary Square Park</option>
								<option value="">Sherwood OaksPark</option>
								<option value="">Skate Park</option>
								<option value="">Southeast Park</option>
								<option value="">Third Street Park</option>
								<option value="">Twin Lakes Sports Park</option>
								<option value="">Upper Cascades Park</option>
								<option value="">Wappehani Mountain Bike Park</option>
								<option value="">Willie Streeter Community Gardens</option>
								<option value="">Winslow Sports Complex</option>
								<option value="">Winslow Woods Park</option>
								</select>
								</fieldset>
							</form>
						</div>
					</div>
						<div class="smright">
							<h4>Health Insurance Info</h4>
							<p><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/healthinsurance.png" /></p>
						</div>
					</div>
				</li>
			<li class="main-nav-item">
				<a href="/content/students" class="main-nav-tab">Students</a>
			</li>
			<li class="main-nav-item">
				<a href="/content/businesses" class="main-nav-tab">Businesses</a>
			</li>
			<li class="main-nav-item">
				<a href="/content/residents" class="main-nav-tab">Residents</a>
			</li>
			<li class="main-nav-item">
				<a href="/content/visitors" class="main-nav-tab">Visitors</a>
			</li>
			<li class="sm-links">
				<a href="https://twitter.com/citybloomington">
					<i class="icon-twitter"></i>
					<span class="hidden-label">Twitter</span>
				</a>
			</li>
			<li class="sm-links">
				<a href="http://youtube.com/user/cityofbloomington">
					<i class="icon-youtube"></i>
					<span class="hidden-label">Youtube</span>
				</a>
			</li>
			<li class="sm-links">
				<a href="http://facebook.com/cityofbloomington">
					<i class="icon-facebook"></i>
					<span class="hidden-label">Facebook</span>
				</a>
			<li>
		</ul>
	<?php
		if ($title || $breadcrumb) {
			echo "<div id=\"breadcrumb\">";
			echo render($title_prefix);
			if ($title) {
				echo "<h1 class=\"title\" id=\"page-title\">$title</h1>";
			}
			echo render($title_suffix);
			if ($breadcrumb) {
				echo $breadcrumb;
			}
			echo "</div>";
		}

		echo $messages;
	?>
	<div id="main" class="clearfix">
		<div id="content" class="column">
			<div id="main-content">
			<?php
				if ($page['highlighted']) {
					echo '<div id="highlighted">';
					echo render($page['highlighted']);
					echo '</div>';
				}
				if ($tabs) {
					echo '<div class="tabs">';
					echo render($tabs);
					echo '</div>';
				}
				echo render($page['help']);
				if ($action_links) {
					echo '<ul class="action-links">';
					echo render($action_links);
					echo '</ul>';
				}
				if (isset($node['field_banner'])){
					echo render($node['field_banner']);
				}
				echo '<div id="sidebar-second" class="region region-sidebar-second sidebar">';
				if (isset($node) && $node['#view_mode'] == 'full') {
					if (isset($node['field_sidebar_image'])) {
						echo render($node['field_sidebar_image']);
					}

					if (   isset($node['field_running_from'  ])
						|| isset($node['field_cost'          ])
						|| isset($node['field_ages'          ])
						|| isset($node['field_registration'  ])
						|| isset($node['field_instructor'    ])
						|| isset($node['field_program'       ])
						|| isset($node['field_service'       ])
						|| isset($node['field_location_group'])) {

						echo '<div class="block">';
						if (isset($node['field_location_group'])) { echo render($node['field_location_group']); }
						if (isset($node['field_program'       ])) { echo render($node['field_program'       ]); }
						if (isset($node['field_running_from'  ])) { echo render($node['field_running_from'  ]); }
						if (isset($node['field_cost'          ])) { echo render($node['field_cost'          ]); }
						if (isset($node['field_ages'          ])) { echo render($node['field_ages'          ]); }
						if (isset($node['field_registration'  ])) { echo render($node['field_registration'  ]); }
						if (isset($node['field_instructor'    ])) { echo render($node['field_instructor'    ]); }
						echo '</div>';
					}

					if (isset($node['field_hours_of_operation'])) {
						echo '<div class="block">';
						echo render($node['field_hours_of_operation']);
						echo '</div>';
					}

					if (isset($node['field_contact_info'])) {
						echo '<div class="block">';
						echo render($node['field_contact_info']);
						echo '</div>';
					}

					if (!empty($children)) { cob_include('children', ['children'=>$children, 'title'=>$title]); }
				}
				if ($page['sidebar_second']) {
					echo render($page['sidebar_second']);
				}
				echo '</div>';

				echo render($page['content']);
				echo $feed_icons;

				echo '<div class="directLinks">';

				if (!empty($pages) || !empty($services) || !empty($webforms)) {
					echo '<div class="columnLists">';
					if (!empty($pages   )) { cob_include('pages',    ['pages'   => &$pages   ]); }
					if (!empty($services)) { cob_include('services', ['services'=> &$services]); }
					if (!empty($webforms)) { cob_include('webforms', ['webforms'=> &$webforms]); }
					echo '</div>';
				}
				if (!empty($programs))     { cob_include('programs', ['programs'=> &$programs]); }
				echo '</div>';
			?>
			</div>
			<?php
			echo '<div id="sidebar-first" class="region region-sidebar-first sidebar">';
				if (!empty($field_location)) {
					cob_include('location', ['location' => &$field_location]);
				}
				if (!empty($location)) {
					cob_include('map', ['location' => &$location]);
				}
				if (isset($node) && $node['#bundle']=='location_group' && !empty($children)) {
					cob_include('map', ['locations'=>&$children]);
				}

				if (!empty($department))      { cob_include('department'     , ['department'     =>&$department     ]); }
				if (!empty($departments))     { cob_include('departments'    , ['departments'    =>&$departments    ]); }
				if (!empty($boards))          { cob_include('boards'         , ['boards'         =>&$boards         ]); }
				if (!empty($siblings))        { cob_include('siblings'       , ['siblings'       =>&$siblings       ]); }
				if (!empty($sponsors))        { cob_include('sponsors'       , ['sponsors'       =>&$sponsors       ]); }
				if (!empty($news))            { cob_include('news'           , ['news'           =>&$news           ]); }
				if (!empty($location_groups)) { cob_include('location_groups', ['location_groups'=>&$location_groups]); }

				if (isset($related)) {
					foreach ($related as $type=>$nodes) {
						if (!empty($nodes)) {
							cob_include("related_{$type}", [$type=>$nodes]);
						}
					}
				}
				if ($page['sidebar_first']) {
					echo render($page['sidebar_first']);
				}
			echo '</div>';

		?>
		</div> <!-- /#content -->
	</div> <!-- /#main -->

	<div id="footer">
		<?php
			echo render($page['footer']);
			echo theme('links__system_secondary_menu', array(
				'links' => $secondary_menu,
				'attributes' => array(
					'id' => 'secondary-menu',
					'class' => array('links', 'inline')
				)
			));
		?>
	</div> <!-- /#footer -->
</div> <!-- /#page -->
