<?php
/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
$committee_id = $element['#items'][0]['value'];
$url = "http://apps.bloomington.in.gov/committee_manager/committees/view?format=json;committee_id=$committee_id";
$response = drupal_http_request($url);

$committee = json_decode($response->data);


echo "
<div class=\"$classes\"$attributes>
";
if (!$label_hidden) {
	$name = $committee->info->name;
	echo "<div class=\"field-label\"$title_attributes>$name:</div>";
}

module_load_include('php', 'markdown', 'markdown');
$text = Markdown($committee->info->description);

echo "
<div class=\"field-items\"$content_attributes>
	$text
";
if (count($committee->seats)) {
	echo "
	<h3>Members</h3>
	<table>
		<thead>
			<tr><th>Appointee</th>
				<th>Appointed By</th>
				<th>Term End Date</th>
			</tr>
		</thead>
		<tbody>
	";
	foreach ($committee->seats as $seat) {
		$c = 0;
		foreach ($seat->currentMembers as $member) {
			$c++;
			echo "
			<tr><td>{$member->name}</td>
				<td>{$seat->appointedBy}</td>
				<td>{$member->termEnd}</td>
			</tr>
			";
		}
		while ($c < $seat->maxCurrentTerms) {
			echo "
			<tr><td>Vacancy</td>
				<td>{$seat->appointedBy}</td>
				<td></td>
			</tr>
			";
			$c++;
		}

	}
	echo "
		</tbody>
	</table>
	";
}
echo "
	</div>
</div>
";
