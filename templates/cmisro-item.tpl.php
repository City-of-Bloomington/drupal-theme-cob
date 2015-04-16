<?php
/**
 * @copyright 2014 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param mixed $variables['object']
 */
$mime_types = [
    'image/jpeg'                           => 'jpg',
    'image/gif'                            => 'gif',
    'image/png'                            => 'png',
    'image/tiff'                           => 'tiff',
    'application/pdf'                      => 'pdf',
    'application/rtf'                      => 'rtf',
    'application/msword'                   => 'doc',
    'application/msexcel'                  => 'xls',
    'application/x-gzip'                   => 'gz',
    'application/zip'                      => 'zip',
    'text/plain'                           => 'txt',
    'video/x-ms-wmv'                       => 'wmv',
    'video/quicktime'                      => 'mov',
    'application/vnd.rn-realmedia'         => 'rm',
    'audio/vnd.rn-realaudio'               => 'ram',
    'audio/mpeg'                           => 'mp3',
    'video/mp4'                            => 'mp4',
    'video/x-flv'                          => 'flv',
    'audio/x-ms-wma'                       => 'wma',
    'image/vnd.dwg'                        => 'dwg',
    'application/vnd.google-earth.kml+xml' => 'kml',
    'application/x-shockwave-flash'        => 'swf',
    'application/postscript'               => 'eps'
];
?>
<div class="cob-pageOverview-actions">
	<?php
		global $base_url;
		$download = "$base_url/cmisro/download";

		$item  = &$variables['object'];
		$class = array_key_exists($item['type'], $mime_types) ? 'cob-mod-'.$mime_types[$item['type']] : '';
		$title = check_plain($item['title']);

		echo "
        <a href=\"$download/$item[id]\" class=\"cob-btn-cta $class\">
            <span class=\"cob-ext-title\">$item[title]</span>
        </a>
        ";
	?>
</div>
