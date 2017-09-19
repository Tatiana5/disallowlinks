<?php
/**
*
* @package phpBB Extension - Disallow links before x posts
* @copyright (c) 2017 Татьяна5
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace tatiana5\disallowlinks\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	 *
	 * @param \phpbb\auth\auth                  $auth
	 * @param \phpbb\config\config              $config
	 * @param \phpbb\user                       $user
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.posting_modify_template_vars'		=> 'posting_modify_template_vars',
			'core.message_parser_check_message'		=> 'disable_links_before_x_posts',
			'core.acp_board_config_edit_add'		=> 'acp_settings',
		);
	}

	public function posting_modify_template_vars($event)
	{
		$url_status = ($this->user->data['user_posts'] >= $this->config['disallowlinks_num']) || $this->auth->acl_get('m_');

		if (!$url_status)
		{
			$page_data = $event['page_data'];

			$page_data['URL_STATUS'] = $this->user->lang['URL_IS_OFF'];
			$page_data['S_LINKS_ALLOWED'] = false;
			$page_data['S_BBCODE_URL'] = false;

			$event['page_data'] = $page_data;
		}
	}

	public function disable_links_before_x_posts($event)
	{
		$url_status = ($this->user->data['user_posts'] >= $this->config['disallowlinks_num']) || $this->auth->acl_get('m_');

		if (!$url_status)
		{
			$event['allow_magic_url'] = false;
			$event['allow_url_bbcode'] = false;
		}
	}

	public function acp_settings($event)
	{
		if ($event['mode'] === 'post' && isset($event['display_vars']['vars']['allow_post_links']))
		{
			$this->user->add_lang_ext('tatiana5/disallowlinks', 'acp_disallowlinks');

			$display_vars = $event['display_vars'];

			$dl_config_vars = array(
				'disallowlinks_num'	=> array(
										'lang' => 'LINKS_AFTER_NUM_POSTS',
										'validate' => 'int:0',
										'type' => 'number:0:99999',
										'explain' => true
				),
			);

			$insert_after = array('after' => 'allow_post_links');
			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $dl_config_vars, $insert_after);

			$event['display_vars'] = $display_vars;
		}
	}
}
