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
$term = &$page['content']['system_main']['term_heading']['term']['#term'];
if (!empty(  $term->parent)) {
    $title = $term->parent->name;
}

include __DIR__.'/partials/homeHeader.inc';
?>
<div           class="cob-portalSearch">
    <div       class="cob-portalSearch-container">
    <?php
        $search = module_invoke('search', 'block_view', 'form');
        #print_r($search);
        $search['content']['search_block_form']['#attributes']['placeholder'] = 'Search All';
        echo render($search['content']);
    ?>
    </div>
</div>
<header  class="cob-portalHeader">
    <div class="cob-portalHeader-container">
    <?php
        echo $messages;
        include __DIR__.'/partials/siteAdminBar.inc';

        echo "<h1 class=\"cob-portalHeader-title\">$title</h1>";
    ?>
    </div>
</header>
<main    class="cob-portalMain" role="main">
    <div class="cob-portalMain-container">
        <?php
            if (isset($term->parent)) {
                $children = taxonomy_get_children($term->parent->tid);
                $category_is_selected = 'cob-state-isSelected';
            }
            else {
                $children = taxonomy_get_children($term->tid);
                $category_is_selected = '';
            }
        ?>
        <div     class="cob-portalSidebar <?= $category_is_selected; ?>" id="taxonomy-term-<?= $term->tid ?>">
            <nav class="cob-portalSidebar-nav">
                <?php
                    foreach ($children as $child) {
                        $options = ['html'=>true];
                        if ($term->tid == $child->tid) {
                            $options['attributes'] = ['class'=>['current']];
                        }

                        echo l(
                            "<span class=\"title\">{$child->name}</span><span class=\"description\">{$child->description}</span>",
                            'taxonomy/term/'.$child->tid,
                            $options
                        );
                    }
                ?>
            </nav>
        </div>
        <?php
            if ($category_is_selected) { cob_include('term_nodes', ['term' => $term]); }
        ?>
    </div>
</main>
<?php
    include __DIR__.'/partials/footer.inc';
    include __DIR__.'/partials/sectionTemplates.inc';
?>
