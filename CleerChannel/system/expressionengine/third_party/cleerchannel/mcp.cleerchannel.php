<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
if ( ! class_exists('channel_data'))
{
	require_once(PATH_THIRD.'cleerchannel/helper/channel_data.php');
}

/**
 * clEErChannel Module Control Panel File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		Jeremy Congdon
 * @link		http://www.jcongdon.com
 */

class Cleerchannel_mcp {
	
	public $return_data;
	
	private $_base_url;
	private $_form_url;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=cleerchannel';
		$this->_form_url = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=cleerchannel';
		
		$this->EE->cp->set_right_nav(array(
			'module_home'	=> $this->_base_url,
		));

		 // Display flash data if it exists in the session (set prior to a redirect).
        if($this->EE->session->flashdata('message'))
        {
            // Output javascript to display the message.
            $this->EE->javascript->output(array(
                '$.ee_notice("' . $this->EE->session->flashdata('message') . '",{type:"success",open:true});', 'window.setTimeout(function(){$.ee_notice.destroy()}, 2000);'
            ));
        }
	}
	
	// ----------------------------------------------------------------

	/**
	 * Index Function
	 *
	 * @return 	void
	 */
	public function index()
	{
		$this->EE->cp->set_variable('cp_page_title', 
								lang('cleerchannel_module_name'));

		$this->EE->load->helper('form');

		$vars = array();

		$vars['channel_data'] = channel_data::Channel_ids();
		$vars['form_url'] = $this->_form_url;

        return $this->EE->load->view('mcp_index', $vars, true);
	}

	public function delete_entries(){

		//Delete Entries from All Channels submitted
		$channel_ids = $_POST['channel_id'];

		foreach ($channel_ids as $channel_id) {

			$this->EE->db->where('channel_id', $channel_id);
			$this->EE->db->delete('channel_data');

			$this->EE->db->where('channel_id', $channel_id);
			$this->EE->db->delete('channel_titles');
			
		}

		//Reset Auto Increment
		$this->EE->db->select_max('entry_id', 'max');
		$query = $this->EE->db->get('channel_titles');
		$result = $query->result();
		$auto_inc = $result[0]->max;
		$this->EE->db->query('ALTER TABLE exp_channel_data AUTO_INCREMENT = ' . $auto_inc . ';');
		$this->EE->db->query('ALTER TABLE exp_channel_titles AUTO_INCREMENT = ' . $auto_inc . ';');

		//Send Confimration that Data was completed!
		$this->EE->session->set_flashdata('Data Deletion was successful!');
        $this->EE->functions->redirect($this->_base_url . AMP . "method=index");
	}
	
}
/* End of file mcp.cleerchannel.php */
/* Location: /system/expressionengine/third_party/cleerchannel/mcp.cleerchannel.php */