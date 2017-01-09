<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model {		
	
	
	function get_all_role()
	{
	$query = $this->db->get('a3m_acl_role'); 
	return $query ->result();		
	}
	
	function get_all_site()
	{
	$query = $this->db->get('eh_project_site'); 
	return $query ->result();			
	}
	
	function get_all_user()
	{
	$this->db->order_by('id', 'asc');	
	$query = $this->db->get('a3m_account'); 
	return $query ->result();			
	}
	
	function get_all_user_role($user_id)
	{
	$this->db->where('account_id',$user_id);
	$query = $this->db->get('a3m_rel_account_role'); 
	return $query ->result();	
	}
	
	function get_role_name_by_id($role_id)
	{
	$this->db->where('id',$role_id);
	$result_set = $this->db->get('a3m_acl_role'); 
	return $result_set->row()->name;					
	}
	
	
	
	
	function get_all_user_battalion($user_id)
	{
	$this->db->where('account_id',$user_id);
	$query = $this->db->get('bgb_user_battalion_map'); 
	return $query ->result();	
	}
	
	function get_battalion_region_by_id($battalion_id)
	{
	$this->db->where('battalion_id',$battalion_id);
	$result_set = $this->db->get('battalion_and_licence'); 
	return $result_set->row()->region_id;					
	}
	
	function get_battalion_sector_by_id($battalion_id)
	{
	$this->db->where('battalion_id',$battalion_id);
	$result_set = $this->db->get('battalion_and_licence'); 
	return $result_set->row()->sector_id;					
	}
	
	
	function get_battalion_name_by_id($battalion_id)
	{
	$this->db->where('battalion_id',$battalion_id);
	$result_set = $this->db->get('battalion_and_licence'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->battalion_name_bn;					
	else
	return $result_set->row()->battalion_name;					
	}
	
	
	function get_region_name_by_id($region_id)
	{
	$this->db->where('region_id',$region_id);
	$result_set = $this->db->get('bgb_region'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->region_name_bn;					
	else
	return $result_set->row()->region_name;	
	}
	
	function get_sector_name_by_id($sector_id)
	{
	$this->db->where('sector_id',$sector_id);
	$result_set = $this->db->get('bgb_sector'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->sector_name_bn;					
	else
	return $result_set->row()->sector_name;	
	}
	
	function get_designation_name_by_id($designation_id)
	{
	$this->db->where('designation_id',$designation_id);
	$result_set = $this->db->get('bgb_designation'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->designation_name_bn;					
	else
	return $result_set->row()->designation_name;	
	}
	
	function get_company_name_by_id($company_id)
	{
	$this->db->where('company_id',$company_id);
	$result_set = $this->db->get('bgb_company'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->company_name_bn;					
	else
	return $result_set->row()->company_name;	
	}
	
	
	function get_season_name_by_id($season_id)
	{
	$this->db->where('season_id',$season_id);
	$result_set = $this->db->get('bgb_season'); 
	$language = $this->session->userdata('site_lang');
	if($language=='bangla') 
	return $result_set->row()->season_name_bn;					
	else
	return $result_set->row()->season_name;	
	}
	
	function check_if_user_in_the_battalion($account_id,$battalion_id)
	{
	$this->db->where('account_id',$account_id);
	$this->db->where('battalion_id',$battalion_id);
	$query = $this->db->get('bgb_user_battalion_map'); 
	if($query->num_rows() > 0)
	return "checked";
	else
	return false;
	}
	
	function check_user_in_the_site($user_id,$site_id)
	{
	$this->db->where('user_id',$user_id);
	$this->db->where('project_id',$site_id);
	$query = $this->db->get('eh_site_user_map'); 
	if($query->num_rows() > 0)
	return true;
	else
	return false;
	}
	
	function is_same_site($current_user_id,$want_to_see_user_id)
	{
	$current_user_site=$this->site_model->get_all_user_battalion($current_user_id);
	$want_to_see_user_site=$this->site_model->get_all_user_battalion($want_to_see_user_id);
	
	foreach($current_user_site as $current_user_sites)
		{
			//echo $current_user_sites->project_id;
			foreach($want_to_see_user_site as $want_to_see_user_sites)
			{
			if($current_user_sites->battalion_id==$want_to_see_user_sites->battalion_id)
			return true;
			break;
			}
		}
	return false;	
	//var_dump($current_user_site);
	//var_dump($want_to_see_user_site);
	}
	
	function site_wise_checkup_count($site_id)
	{
	$query="SELECT count(*) AS total_checkup
  FROM    eh_patient_checkup eh_patient_checkup
       INNER JOIN
          eh_site_user_map eh_site_user_map
       ON (eh_patient_checkup.user_id = eh_site_user_map.user_id)
 WHERE (eh_site_user_map.project_id = ".$site_id.")";
 	$result_set=$this->db->query($query);
 	return $result_set->row()->total_checkup; 
	}
	
	function site_and_color_wise_checkup_count($site_id)
	{
	$query="SELECT  
    COUNT(*) AS total_checkup, 
    COUNT(IF(eh_patient_checkup.color_status=1,1,null)) AS green,
    COUNT(IF(eh_patient_checkup.color_status=2,1,null)) AS yellow,
		COUNT(IF(eh_patient_checkup.color_status=3,1,null)) AS orange,
		COUNT(IF(eh_patient_checkup.color_status=4,1,null)) AS red
FROM   eh_patient_checkup eh_patient_checkup
       INNER JOIN
          eh_site_user_map eh_site_user_map
       ON (eh_patient_checkup.user_id = eh_site_user_map.user_id)
 WHERE (eh_site_user_map.project_id = ".$site_id.")";
 	$resultSet=$this->db->query($query);
 	return $resultSet->row();
	}
	
	function get_unit_wise_designation_quota($battalion_id,$designation_id)
	{
	$this->db->where('battalion_id',$battalion_id);
	$this->db->where('designation_id',$designation_id);	
	$result_set = $this->db->get('bgb_unit_wise_designation_quota');
	
	if($result_set->num_rows() > 0)		
	return $result_set->row()->designation_quota;
	else
	return "";
	}
	
	
}


/* End of file account_model.php */
/* Location: ./application/models/general_model.php */