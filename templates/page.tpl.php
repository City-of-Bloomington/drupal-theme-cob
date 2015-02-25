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

<header class="btown-siteHeader">
    <div class="btown-siteHeader-container">
        <?php
        /*
        <?php if ($main_menu || $secondary_menu): ?>
            <div id="navigation"><div class="section">
            <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
            <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
            </div></div> <!-- /.section, /#navigation -->
        <?php endif; ?>
        */
        ?>
        <?php
            if (!empty($page['header_site'])) { echo render($page['header_site']); }
            if ($logo) {
                $t = t('Home');
                $alt_attribute = $site_name ? $site_name : $t;
                echo "
                <a href=\"$front_page\" class=\"btown-siteHeader-logo\" title=\"$t\" rel=\"home\" id=\"logo\">
                    <img src=\"$logo\" alt=\"$alt_attribute\" />
                </a>
                ";
            }
        ?>
    </div>
</header>

<header class="btown-pageHeader">
    <div class="btown-pageHeader-container">
        <?php render($title_prefix) ?>
        <h1><span><?php echo $title; ?></span></h1>
        <?php print render($page['header_page']); ?>
        <?php print render($title_suffix); ?>
    </div>
    <?php
        if (!empty($node->field_cmis_documents['und'][0]['folder'])) {
            echo "
            <div class=\"btown-pageHeader-navigation\">
                <nav class=\"btown-pageHeader-navigation-container\">
                    <a href=\"#\" class=\"btown-ext-current\">About</a>
            ";
            foreach ($node->field_cmis_documents['und'][0] as $key=>$value) {
                if ($key != 'folder') {
                    if (!empty($value)) {
                        $label = substr($key, 9);
                        $url = "{$base_path}node/{$node->nid}/$label";
                        echo "<a href=\"$url\">$label</a>";
                    }
                }
            }
            echo "
                </nav>
            </div>
            ";
        }
    ?>
</header>

<?php
    echo $messages;

    if ($tabs || $action_links) {
        echo "<div class=\"btown-siteAdminBar\">";
            if ($tabs)         { echo render($tabs); }
            if ($action_links) { echo "<ul class=\"action-links\">".render($action_links)."</ul>"; }
        echo "</div>";
    }

    /*
        <?php if ($breadcrumb): ?>
        <div id="breadcrumb"><?php print $breadcrumb; ?></div>
        <?php endif; ?>
    */

    echo render($page['content']);
    echo $feed_icons;
?>

<footer class="btown-footer">
    <div class="btown-footer-container">
        <?php print render($page['footer']); ?>      
    </div>
</footer>
