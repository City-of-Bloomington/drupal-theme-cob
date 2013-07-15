<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $sponsors
 */
echo "
<div class=\"block\">
	<h2>Sponsors</h2>
";
	foreach ($sponsors as $s) {
		echo "<div>";
		if (isset($s['entity']->field_logo['und'][0]['uri'])) {
			echo theme('image_style', array(
				'path'=>$s['entity']->field_logo['und'][0]['uri'],
				'style_name'=>'thumbnail'
			));
		}
		echo "
			<div>".l($s['entity']->title, "node/$s[target_id]")."</div>
		";
			$u = $s['entity']->field_link_url['und'][0]['url'];
		echo "
			<div>".l($u, $u)."</div>
		</div>
		";
	}
echo "
</div>
";
