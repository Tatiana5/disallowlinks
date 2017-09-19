<?php
/**
*
* @package phpBB Extension - Disallow links before x posts
* @copyright (c) 2017 Татьяна5
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace tatiana5\disallowlinks\migrations;

class disallowlinks_0_0_1 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['disallowlinks_version']) && version_compare($this->config['disallowlinks_version'], '0.0.1', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.add', array('disallowlinks_version', '0.0.1')),

			array('config.add', array('disallowlinks_num', '10')),
		);
	}
}