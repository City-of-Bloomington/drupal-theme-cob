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
	<?php
		include __DIR__.'/../includes/dropdowns.php';

		
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
			<div id="frontpagelargeColumn">
				<?php
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
				?>
				<div id="frontpageCurrent">
					<div id="frontpageNews">
						<h2>City News Highlights</h2>
	
						<ul><li>Bloomington Offers Opportunity to Educate Children on Gardening and Healthy Eating</li>
							<li>MOSAIC Presents A Diversity Film Festival</li>
							<li>City of Bloomington Arts Commission Announces April 2012 Grant Recipients</li>
							<li>First Annual Eco-Hero Award Contest</li>
							<li>Teens Serve the Community on Global Youth Service Day</li>
							<li>More News...</li>
						</ul>
					</div>
	
					<div id="frontpageEvents">
						<h2>Upcoming Events</h2>
						<h4>Thu, Oct 3</h4>
						<div class="frontpageEventListings">
						<ul>
							<li>SilverSneakers Cardio Circuit</li>
							<li>SilverSneakers Muscle Strength and Range of Movement</li>
							<li>Bloomington Digital Underground Advisory Committee</li>
							<li>Commission on the Status of Women</li>
							<li>Bloomington Walking Club</li>
						</ul>
						<h4>Fri, Oct 4</h4>
						<ul><li>Hola Bloomington</li></ul>
						</div>
					</div>
				</div>
				<div id="frequentlyRequested">
					<h2>Frequently Requested</h2>
					<div class="frRow">
						<div class="homepageFeaturedservice"><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/parks.png" />
							<h4>Parks and Recreation Services</h4>
							<p>Sign up for tee times, classes and leagues, and reserve park shelters</p>
						</div>
						<div class="homepageFeaturedservice"><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/ureport_0.png" />
							<h4>Report Issues</h4><p>Notify the City of community issues, such as potholes, graffiti, malfunctioning street lights, and more.</p>
						</div>
					</div>
					<div class="frRow">
						<div class="homepageFeaturedservice"><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/contactus_1.png" />
							<h4>Contact the City</h4>
							<p>Staff directory, primary phone numbers, and other contact options</p>
						</div>
						<div class="homepageFeaturedservice"><img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/logo.png" />
							<h4>Employment Opportunities</h4><p>See current City openings</p>
						</div>
					</div>
					
				</div>
			</div>
			<div id="frontpageFeatured">
				<div id="homepageFeaturedNews">
					<div class="featuredItem">
						<img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/shermie.jpg" />
						<h4>Test City Celebrates Be Kind to Animals Week in 2013</h4>
						<p>Mayor Mark Kruzan announced that the City of Bloomington will recognize Be Kind to Animals Week, May 5 - 13, 2012, in conjunction with American Humane Associations annual national celebration.</p>
					</div>
					<div class="featuredItem">
						<img src="http://rogue.bloomington.in.gov/drupal/sites/default/files/brain-exhibit.jpg" />
						<h4>Brain Extravaganza set to Invate Bloomington</h4>
						<p>Twenty-two brains will soon be displayed throughout the Bloomington community from late April until October of this year. Sponsored by Jill Bolte Taylor BRAINS, Inc, these brains stand 5 feet tall, and will be a sight to see!</p>
					</div>
				</div>
			</div>
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
