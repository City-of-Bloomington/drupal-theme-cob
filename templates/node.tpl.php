<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Additional custom variables for COB:
 * $news_releases: An array of press release nodes associated with this node
 * $boards_commissions An array of boards nodes associated with this node
 * $contactInfo: JSON object with contact info from Directory
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
hide($content['comments']);
hide($content['links']);
hide($content['field_board_commission']);
hide($content['field_news_contacts']);
hide($content['field_committee']);
hide($content['field_directory_dn']);
hide($content['field_directory_cn']);
hide($content['field_physical_address']);
hide($content['field_phone_number']);
hide($content['field_email']);
hide($content['field_facebook_page']);
hide($content['field_twitter_account']);
hide($content['field_call_to_action']);
hide($content['field_attachment']);
hide($content['field_category']);
hide($content['field_department']);
hide($content['book_navigation']);
hide($content['field_cover_image']);
hide($content['field_page_header_image']);
hide($content['field_content_image']);

// Teaser Mode /-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/

if ($view_mode == 'teaser') {
    $formatted_date = '';
    if ($display_submitted) {
        $d = format_date($created, 'medium');
        $formatted_date = "<time>$d</time>";
    }
    echo '<article class="cob-mainText">';
    echo "$formatted_date<h1><a href=\"$node_url\">".render($title)."</a></h1>";
    echo render($content);
    echo '</article>';
}

// Main Mode /-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/
else {
    $contentHTML = render($content);
    $toc = _cob_create_toc($contentHTML, 2, 2);
    if ($toc['toc']) { $contentHTML = $toc['content']; }
    $content_sidebar = false;
    if(
        $node->type == 'news_release'
        || $node->type == 'board_commission'
    ) {
        $content_sidebar = ' cob-ext-hasSidebar';
    }

    // Declare the content types to check for entity relationships
    // with the current node being displayed
    $relatedContent = [
        'news_releases'     => 'Latest News',
        'boards_commissions' => 'Boards &amp; Commissions'
    ];
    foreach ($relatedContent as $type=>$title) {
        if (!empty($$type)) {
            $toc['toc'][$type] = $title;
        }
    }

    if (!empty($safe_summary) || !empty($contactInfo) || $toc['toc']
        || !empty($content['field_call_to_action'])   || !empty($content['field_physical_address'])
        || !empty($content['field_phone_number'])     || !empty($content['field_email'])
        || !empty($content['field_facebook_page'])    || !empty($content['field_twitter_account'])) {

        include __DIR__.'/partials/pageOverview.inc';
    }
    ?>
        <section id="node-<?= $node->nid ?>" class="cob-main-container <?= $classes ?>"<?= $attributes ?>>
            <article class="cob-mainText<?=$content_sidebar?>"<?= $content_attributes ?>>
                <?php if(!empty($node->field_content_image)): ?>
                    <?php
                        $content_image_url  = mediamanager_field_url($node->field_content_image, 'Content Image');
                        $content_image_info = _mediamanager_media_info($node->field_content_image['und'][0]['media_id']);
                    ?>
                    <figure class="cob-main-content_image">
                        <img src="<?= $content_image_url ?>" alt="<?= $content_image_info->title ?>" />
                        <?php if(!empty($content_image_info->description)): ?>
                            <figcaption><?= $content_image_info->description ?></figcaption>
                        <?php endif ?>
                    </figure>
                <?php endif ?>

                <?php
                    if ($node->type == 'news_release') {
                        $formatted_date = format_date($created, 'medium');
                        echo "
                            <time>$formatted_date</time>
                            <h1>{$node->title}</h1>
                        ";
                    }
                ?>
                <?= $contentHTML ?>
            </article>
            <?php if($content_sidebar !== false): ?>
                <aside class="cob-mainText-sidebar">
                    <?php if (!empty($content['field_news_contacts'])): ?>
                        <?= render($content['field_news_contacts']); ?>
                    <?php endif; ?>
                    <?php if (!empty($committee  )): ?>
                        <?= cob_include('committeeMembers', ['committee'   => $committee  ]); ?>
                    <?php endif; ?>
                </aside>
            <?php endif ?>
        </section>
        <?php include('partials/fsCal.inc'); ?>

        <?php
            foreach ($relatedContent as $type=>$title) {
                if (!empty($$type)) {
                    cob_include($type, [$type => $$type, 'title'=>$title]);
                }
            }
//            if (!empty($contactInfo)) { cob_include('departmentStaff',  ['contactInfo' => $contactInfo]); }
        ?>
    <?php
}
?>
