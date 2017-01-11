<?php
class Active_e_subscriber extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl','date'));
		//$this->load->library(array('account/authentication', 'account/authorization','form_validation','account/recaptcha'));
		$this->load->model(array('general_model'));				
		date_default_timezone_set('Asia/Dhaka');  // set the time zone UTC+6
		
		
	}
	
	
	/*********************** Active Subscriber Migration   **********************************/
	/* database: pmrs_test, table: e_subscribers */
	
	
	function index()
	{
		echo '<h4>Active Subscriber Migration. Table: pmrs_test.e_subscriber</h4>';
		$searchterm="SELECT * FROM e_subscriber WHERE dtt_mod >= '2016-09-01 00:00:00' AND  RegID IS NOT NULL LIMIT 0, 10";
        $subscriber_list=$this->general_model->get_all_querystring_result($searchterm);
		$date_from='2016-09-01';
		$date_to='2016-12-31';
		
		foreach($subscriber_list as $slist){
			$lmp_yyyymmdd=NULL;
			$yyyymmdd=NULL;
			if($slist->tx_mobile)
			{
				if($slist->STID=='p')
				{
				/************** Pregnant  ****************/
				$int_subscriber_type_key=1;
				$int_subscriber_key	=$slist->int_subscriber_key;
				echo "int_subscriber_key=".$int_subscriber_key." ";	
				$tx_reg_id=$slist->tx_reg_id;
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->tx_mobile."(Preg)";
				$services_days=292;
				echo $slist->tx_name;
				
					if($slist->tx_last_menstrual_period)
					{					
					$dd=substr($slist->tx_last_menstrual_period, 0, 2);
					$mm=substr($slist->tx_last_menstrual_period, 2, 2);
					$yy='20'.substr($slist->tx_last_menstrual_period, 4, 2);			
					$lmp_yyyymmdd=$yy.'-'.$mm.'-'.$dd;
					echo " LMP=".$lmp_yyyymmdd;
					$mobile_operator=substr($slist->tx_mobile, 2, 1);
					//echo " Operator=".$mobile_operator;
					$dtt_registration=$slist->dtt_registration;
					//echo "Reg. Date=".$dtt_registration;
					$dtt_deregistration=$slist->dtt_deregistration;
					//echo "De. Reg. Date=".$dtt_deregistration;
					////////////////// Calculated Date /////////////////////					 
					$date = strtotime($lmp_yyyymmdd);
					$date = strtotime("+42 week", $date);
					$calculated_date =date('Y-m-d', $date);
					
					$service_from=$this->general_model->get_form_date($calculated_date,$date_from,date("Y-m-d", strtotime($dtt_registration)));
					if($dtt_deregistration)
					$dett_deregistration=date("Y-m-d", strtotime($dtt_deregistration));
					else
					$dett_deregistration=NULL;
					$service_to=$this->general_model->get_to_date($calculated_date,$date_to,$dett_deregistration);
					}
					
				}
				else if($slist->STID=='b')
				{
				/************** Baby  ****************/	
				$int_subscriber_type_key=2;
				$int_subscriber_key	=$slist->Id;
				echo "int_subscriber_key=".$int_subscriber_key." ";
				$tx_reg_id=$slist->RegID;
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->MobNum."(Baby)";
				$services_days=364;
					
					if($slist->dtt_mod)
					{					
					$dd=substr($slist->tx_child_birth, 0, 2);
					$mm=substr($slist->tx_child_birth, 2, 2);
					$yy='20'.substr($slist->tx_child_birth, 4, 2);			
					$yyyymmdd=$yy.'-'.$mm.'-'.$dd;
					echo " DOB=".$yyyymmdd;
					$mobile_operator=substr($slist->MobNum, 2, 1);
					//echo " Operator=".$mobile_operator;
					$dtt_registration=$slist->dtt_registration;
					//echo "Reg. Date=".$dtt_registration;
					$dtt_deregistration=NULL;
					//echo "De. Reg. Date=".$dtt_deregistration;
					////////////////// Calculated Date /////////////////////					 
					$date = strtotime($yyyymmdd);
					$date = strtotime("+52 week", $date);
					$calculated_date =date('Y-m-d', $date);
					
					$service_from=$this->general_model->get_form_date($calculated_date,$date_from,date("Y-m-d", strtotime($dtt_registration)));
					if($dtt_deregistration)
					$dett_deregistration=date("Y-m-d", strtotime($dtt_deregistration));
					else
					$dett_deregistration=NULL;
					$service_to=$this->general_model->get_to_date($calculated_date,$date_to,$dett_deregistration);
					}
					
				}				
		
			if($slist->tx_last_menstrual_period || $slist->tx_child_birth)
			{
			$insert_data=array(
							'int_subscriber_key'=>$int_subscriber_key,
							'tx_reg_id'=>$tx_reg_id,
							'tx_name'=>$slist->tx_name,
							'tx_mobile'=>$slist->tx_mobile,
							'operator_key'=>$mobile_operator,
							'tx_last_menstrual_period'=>$lmp_yyyymmdd,
							'tx_child_birth'=>$yyyymmdd,
							'int_subscriber_type_key'=>$int_subscriber_type_key,
							'dtt_registration'=>$dtt_registration,
							'dtt_deregistration'=>$dtt_deregistration,
							'calculated_date'=>$calculated_date,
							'service_from'=>$service_from,
							'service_to'=>$service_to,						
							'days'=>$services_days,						
							'data_source'=>'e_subscribers'
							);
			
			echo "<pre>";
			print_r($insert_data);
			echo "</pre>";
			
			/*$success_or_fail1=$this->general_model->save_into_table('t_subscribers_for_report', $insert_data);
				if($success_or_fail1)
				{
				// Update the status
				$table_data=array(
								  'migration_status'=>1
								 );
				$this->general_model->update_table('t_subscribers', $table_data,'int_subscriber_key', $int_subscriber_key);
				}
				
			}
			else
			{
			$table_data=array(
								  'migration_status'=>2
								 );
				$this->general_model->update_table('t_subscribers', $table_data,'int_subscriber_key', $int_subscriber_key);	
									
			}*/
		}// End foreach		
		$this->load->view('active_subscriber', isset($data) ? $data : NULL);	
		
	}
	
}


/* End of file active_subscriber.php */
