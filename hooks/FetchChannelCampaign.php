<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FetchChannelCampaign {
    function __construct() {
        $this->ci =& get_instance();
        if(!isset($this->ci->session))
        {
            $this->ci->load->library('session');
        }
    }

    function initialize() {
        $params = $_GET;
        $result = array('channel'=>'website','campaign'=>'website');
        $rp_channel = $_SESSION['rp_channel'];
        $rp_campaign = $_SESSION['rp_campaign'];
        if(!empty($params)){
            if(array_key_exists('ch', $params) && array_key_exists('ca', $params)){
                $this->ci->db->select('channel_name');
                $this->ci->db->where('channel_id',$params['ch']);
                $channelData = $this->ci->db->get('channel')->row_array();
                $this->ci->db->select('campaign_name');
                $this->ci->db->where('campaign_id',$params['ca']);
                $campaignData = $this->ci->db->get('campaign')->row_array();      
                $result = array('channel'=>$channelData['channel_name'],'campaign'=>$campaignData['campaign_name']);
            } else if(array_key_exists('utm_source', $params) && array_key_exists('utm_medium', $params) && array_key_exists('utm_campaign', $params)){
                $result = array('channel'=>$params['utm_source'],'campaign'=>$params['utm_campaign']);
            }else {
                $result = array('channel'=>"Other",'campaign'=>"Other");
            }
        }else if ($rp_channel!='' && $rp_campaign!='') {
            $result = array('channel'=>$rp_channel,'campaign'=>$rp_campaign);
        }
        $this->ci->session->set_userdata('rp_channel', $result['channel']);
        $this->ci->session->set_userdata('rp_campaign', $result['campaign']);
    }
}