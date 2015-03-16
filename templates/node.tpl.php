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
?>

<?php if($view_mode == 'full'): ?>
<div class="cob-pageOverview">
	<h2>Summary of <?= $title ?></h2>
	<div class="cob-pageOverview-container">
		<article>
			<?= $content['body']['#object']->body['und'][0]['safe_summary']; ?>
			<div class="cob-pageOverview-details">
				<?php
					if(!empty($content['field_physical_address'])){
						echo render($content['field_physical_address']);
					} else {
						echo '<div class="cob-ext-details">More helpful info coming to this space soon.</div>';
					}
				?>
				<div class="cob-pageOverview-contacts">
					<?= render($content['field_facebook_page']); ?>
					<?= render($content['field_twitter_account']); ?>
					<?= render($content['field_phone_number']); ?>
					<?= render($content['field_email']); ?>
				</div>
			</div>
		</article>
		<aside>
			Learn about
		</aside>
	</div>
</div>
<main id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> cob-main" role="main"<?php print $attributes; ?>>
	<?php print $user_picture; ?>
	<?php
		if(!empty($body[0]['safe_value'])) { echo <<<EOT
			<div class="cob-main-container">
				<article class="cob-main-content"$content_attributes;>
EOT;
			if($node->type == 'press_release') {
				$formatted_date = format_date($created, 'medium');
				echo "<time>$formatted_date</time>";
			}

			hide($content['links']);
			hide($content['field_board_commission']);
			hide($content['field_press_contacts']);

			if($node->type == 'press_release') { echo "<h1>{$node->title}</h1>";}

/* -------------------------------------
 * Actually.
 * Render.
 * The.
 * Content.
 * -------------------------------------
 */
			echo render($content);


			echo '</article>';

/* -------------------------------------
 * Begin main content area sidebar.
 * -------------------------------------
 */
			echo '<aside class="cob-main-content-sidebar">';

			if (!empty($content['field_press_contacts'])) {
				echo render($content['field_press_contacts']);
			}
			if (!empty($content['field_committee']['#items'])) {
				echo '<h2>Members</h2>';
				echo '<dl class="cob-boardsCommissions-members">';
				$json = civiclegislation_committee_info($content['field_committee']['#items'][0]['value']);
				if ($json) {
					foreach ($json->seats as $seat) {
						foreach ($seat->currentMembers as $member) {
							$memberName = '';
							$names = explode(' ', $member->name);
							foreach($names as $n){
								$memberName .= "<span>$n</span> ";
							}
							echo <<<EOT
									<dt>$memberName</dt>
									<dd>Appointed by: {$seat->appointedBy}</dd>
									<dd>Term expires: {$member->termEnd}</dd>
EOT;
						}
					}
				}
				echo '</dl>';
			}

			echo '</aside>';
			echo '</div>';
		}
	?>

	<?php
		if (!empty($press_releases)) {
			cob_include('press_releases', ['press_releases'=>$press_releases]);
		}
		if (!empty($boards_commissions)) {
			cob_include('boards_commissions', ['boards_commissions'=>$boards_commissions]);
		}
	?>
</main>
<?php endif; ?>

<?php if ($view_mode == 'teaser'): ?>
	<article class="cob-main-content"<?php print $content_attributes; ?>>
        <?php
			$formatted_date = format_date($created, 'medium');
            if ($display_submitted) { echo "<time>$formatted_date</time>"; }
        ?>
		<h2><a href="<?php echo $node_url; ?>"><?php echo render($title); ?></a></h2>
		<?php
			// We hide the comments and links.
			hide($content['comments']);
			hide($content['links']);
/* -------------------------------------
 * Actually.
 * Render.
 * The.
 * Content.
 * -------------------------------------
 */
			echo render($content);
		?>
	</article>
<?php endif; ?>
