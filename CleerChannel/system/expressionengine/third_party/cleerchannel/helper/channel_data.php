<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Low Reorder Module class
 *
 * @package        cleerchannel
 * @author         Jeremy Congdon
 * @link           http://jcongdon.com
 */
class Channel_data  {
	var $return_data = '';


	/* This function will get all channel IDs in the system */
	public function Channel_ids(){

		$this->EE =& get_instance(); 

 		$channel_query = $this->EE->db
			->select(array('channel_title', 'channel_id'))
			->from('channels')
			->get();

        foreach($channel_query->result() as $channel)
        {
            $channels[$channel->channel_id] = $channel->channel_title;
        }

        return $channels;
	}

	public static function all_entries($channel_id){
		/* 
		This will recieve a channel id with $channel_id and return all entries 

		TODO:
		Build this!
		*/


		return "all_entries";
	}
}

?>