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
if (isset($node)
	&& isset(   $page['content']['system_main']['nodes'][$node->nid])) {
	$content = &$page['content']['system_main']['nodes'][$node->nid];
}
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
				$i = $logged_in && isset($node) ? " (node/{$node->nid})" : '';
				echo "<h1 class=\"title\" id=\"page-title\">$title$i</h1>";
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
				if (isset($content['field_banner'])){
					echo render($content['field_banner']);
				}
				echo '<div id="sidebar-second" class="region region-sidebar-second sidebar">';
				if (isset($node)) {
					if (isset($content['field_sidebar_image'])) {
						echo render($content['field_sidebar_image']);
					}

					if (isset($content['field_sidebar_caption'])) {
						echo '<div class="block">';
						echo render($content['field_sidebar_caption']);
						echo '</div>';
					}

					if (isset($content['field_description'])) {
						echo '<div class="block">';
						echo render($content['field_description']);
						echo '</div>';
					}

					if (isset($node) && $node->type == 'program') {
						$events = cob_upcoming_events($node->nid);
						if ($events->rowCount()) {
							cob_include('upcoming_events', ['events' => $events]);
						}
					}


					if (   isset($content['field_running_from'  ])
						|| isset($content['field_meetings'      ])
						|| isset($content['field_cost'          ])
						|| isset($content['field_ages'          ])
						|| isset($content['field_registration'  ])
						|| isset($content['field_instructor'    ])
						|| isset($content['field_program'       ])
						|| isset($content['field_project'       ])
						|| isset($content['field_service'       ])
						|| isset($content['field_location_group'])) {

						echo '<div class="block">';
						if (isset($content['field_location_group'])) { echo render($content['field_location_group']); }
						if (isset($content['field_program'       ])) { echo render($content['field_program'       ]); }
						if (isset($content['field_service'       ])) { echo render($content['field_service'       ]); }
						if (isset($content['field_project'       ])) { echo render($content['field_project'       ]); }
						if (isset($content['field_running_from'  ])) { echo render($content['field_running_from'  ]); }
						if (isset($content['field_meetings'	     ])) { echo render($content['field_meetings'	  ]); }
						if (isset($content['field_cost'          ])) { echo render($content['field_cost'          ]); }
						if (isset($content['field_ages'          ])) { echo render($content['field_ages'          ]); }
						if (isset($content['field_instructor'    ])) { echo render($content['field_instructor'    ]); }
						if (isset($content['field_holds'         ])) { echo render($content['field_holds'   	  ]); }
						if (isset($content['field_electricity'   ])) { echo render($content['field_electricity'   ]); }
						if (isset($content['field_accessible'    ])) { echo render($content['field_accessible'    ]); }
						if (isset($content['field_registration'  ])) { echo render($content['field_registration'  ]); }
						echo '</div>';
					}


					if (isset($content['field_contact_info'])) {
						echo '<div class="block">';
						echo render($content['field_contact_info']);
						echo '</div>';
					}

					if (isset($content['field_staff'])) {
						echo '<div class="block">';
						echo render($content['field_staff']);
						echo '</div>';
					}

					if (isset($content['field_hours'])) {
						echo '<div class="block">';
						echo render($content['field_hours']);
						echo '</div>';
					}

					if (!empty($committee_data)) { cob_include('committee_sidebar', ['committee'=>$committee_data]); }
					if (!empty($children)) { cob_include('children', ['children'=>$children, 'title'=>$title]); }
				}

				if (isset($content['field_park_amb_pic']) && ($content['field_park_ambassador_info'])) {
					echo '<div class="block">';
					echo render($content['field_park_amb_pic']);
					echo render($content['field_park_ambassador_info']);
					echo '</div>';
				}


				if ($page['sidebar_second']) {
					echo render($page['sidebar_second']);
				}
				echo '</div>';

				echo render($page['content']);
				echo $feed_icons;

				echo '<div class="directLinks">';

					if (!empty($pages) || !empty($services) || !empty($webforms) || !empty($residential_services)) {
						echo '<div class="columnLists">';
						if (!empty($pages   )) { cob_include('pages',    ['pages'   => &$pages   ]); }
						if (!empty($services)) { cob_include('services', ['services'=> &$services]); }
						if (!empty($residential_services)) { cob_include('residential_services', ['residential_services'=> &$residential_services]); }
						if (!empty($residential_services)) { cob_include('residential_services', ['residential_services'=> &$residential_services]); }
						echo '</div>
						<div class="columnLists">
						';
						if (!empty($webforms)) { cob_include('webforms', ['webforms'=> &$webforms]); }
						echo '</div>';

					}

					if (!empty($park_shelters)){ cob_include('park_shelters', ['park_shelters'=> &$park_shelters]); }
					if (!empty($programs))     { cob_include('programs', ['programs'=> &$programs]); }
					if (!empty($projects))     { cob_include('projects', ['projects'=> &$projects]); }
				echo '</div>';

				if (!empty($committee_data)) { cob_include('committee_members', ['committee'=>$committee_data]); }

				if (isset($content['field_meeting_schedule'])) {
					echo '<div class="block">';
					echo render($content['field_meeting_schedule']);
					echo '</div>';
				}

				if (isset($content['field_topics'])) {
					echo '<div class="block">';
					echo render($content['field_topics']);
					echo '</div>';
				}
			?>
			</div>
			<?php
			echo '<div id="sidebar-first" class="region region-sidebar-first sidebar">';

				if ($page['sidebar_first']) {
					echo render($page['sidebar_first']);
				}

				if (!empty($field_location)) {
					cob_include('location', ['location' => &$field_location]);
				}
				if (!empty($location)) {
					cob_include('map', ['location' => &$location]);
				}
				if (isset($node) && $node->type=='location_group' && !empty($children)) {
					cob_include('map', ['locations'=>&$children]);
				}

				if (!empty($department))      { cob_include('department'     , ['department'     =>&$department     ]); }
				if (!empty($departments))     { cob_include('departments'    , ['departments'    =>&$departments    ]); }
				if (!empty($division))        { cob_include('division'       , ['division'       =>&$division       ]); }
				if (!empty($divisions))       { cob_include('divisions'      , ['divisions'      =>&$divisions      ]); }
				if (!empty($boards))          { cob_include('boards'         , ['boards'         =>&$boards         ]); }
				if (!empty($board))           { cob_include('board'          , ['board'          =>&$board          ]); }
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

				if (isset($content['field_link_url'])) {
					echo '<div class="block">';
					echo render($content['field_link_url']);
					echo '</div>';
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
