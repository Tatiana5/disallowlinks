<?php
/**
 *
 * @package       phpBB Extension - Disallow links before x posts
 * @copyright (c) 2017 Татьяна5
 * @license       http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'LINKS_AFTER_NUM_POSTS'			=> 'Min post count before posting links',
	'LINKS_AFTER_NUM_POSTS_EXPLAIN'	=> 'Users will need this number of posts before they are able to use the [URL] BBCode tag and automatic/magic URLs.',
));
