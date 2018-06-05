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
	'LINKS_AFTER_NUM_POSTS'			=> 'Минимум сообщений для разрешения ссылок',
	'LINKS_AFTER_NUM_POSTS_EXPLAIN'	=> 'Пользователи должны набрать это количество сообщений для возможности использовать ББкод [URL] и для преобразования ссылок в кликабельные',
));
