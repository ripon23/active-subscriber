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
		$searchterm="SELECT * FROM e_subscriber WHERE migration_status=0 AND dtt_mod >= '2016-09-01 00:00:00' AND  RegID IS NOT NULL LIMIT 0, 400";
        $subscriber_list=$this->general_model->get_all_querystring_result($searchterm);
		$date_from='2016-09-01';
		$date_to='2016-12-31';
		
		foreach($subscriber_list as $slist){
			$lmp_yyyymmdd=NULL;
			$dob_yyyymmdd=NULL;
			if($slist->MobNum)
			{
				if($slist->STID=='p')
				{
				/************** Pregnant  ****************/
				$int_subscriber_type_key=1;
				$int_subscriber_key_original=$slist->Id;
				$int_subscriber_key	=$slist->Id.mt_rand(100, 999);
				echo "int_subscriber_key=".$int_subscriber_key." ";	
				$tx_reg_id=$slist->RegID;
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->MobNum."(Preg)";
				$services_days=292;
				echo $slist->Name;
				
					if($slist->LMD)
					{					
					$dd=substr($slist->LMD, 0, 2);
					$mm=substr($slist->LMD, 2, 2);
					
					$dtt_mod=$slist->dtt_mod;
					$dtt_mod_mm=substr($slist->dtt_mod, 5, 2);
					if($mm < $dtt_mod_mm)
					$yy=2016;
					else
					$yy=2015;
					$lmp_yyyymmdd=$yy.'-'.$mm.'-'.$dd;
					echo " LMP=".$lmp_yyyymmdd;
					$mobile_operator=substr($slist->MobNum, 2, 1);
					echo " Operator=".$mobile_operator;
					
					$guardian_mobile_operator=substr($slist->GuardianNum, 2, 1);
					echo "Guardiand Num=".$slist->GuardianNum.", Gurdian Operator=".$guardian_mobile_operator;
					
					
					$dtt_registration=$slist->dtt_mod;
					$dtt_deregistration=NULL;
					//echo "Reg. Date=".$dtt_registration;
					//$dtt_deregistration=$slist->dtt_deregistration;
					//echo "De. Reg. Date=".$dtt_deregistration;
					if($slist->OutdialPref=='s')
					$tx_distribution_channel='SMS';
					else
					$tx_distribution_channel='IVR';
					
					////////////////// Calculated Date /////////////////////					 
					$date = strtotime($lmp_yyyymmdd);
					$date = strtotime("+42 week", $date);
					$calculated_date =date('Y-m-d', $date);
					
					$service_from=$this->general_model->get_form_date($lmp_yyyymmdd,date("Y-m-d", strtotime($dtt_registration)));										
					
					$service_to=$calculated_date;
					}
					
				}
				else if($slist->STID=='b')
				{
				/************** Baby  ****************/	
				$int_subscriber_type_key=2;
				$int_subscriber_key_original=$slist->Id;
				$int_subscriber_key	=$slist->Id.mt_rand(100, 999);
				echo "int_subscriber_key=".$int_subscriber_key." ";	
				$tx_reg_id=$slist->RegID;
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->MobNum."(Preg)";
				$services_days=364;
				echo $slist->Name;
				
					if($slist->DOB)
					{					
					$dd=substr($slist->DOB, 0, 2);
					$mm=substr($slist->DOB, 2, 2);
					
					$dtt_mod=$slist->dtt_mod;
					$dtt_mod_mm=substr($slist->dtt_mod, 5, 2);
					if($mm<$dtt_mod_mm)
					$yy=2016;
					else
					$yy=2015;
					$dob_yyyymmdd=$yy.'-'.$mm.'-'.$dd;
					echo " DOB=".$dob_yyyymmdd;
					$mobile_operator=substr($slist->MobNum, 2, 1);
					echo " Operator=".$mobile_operator;
					
					$guardian_mobile_operator=substr($slist->GuardianNum, 2, 1);
					echo "Guardiand Num=".$slist->GuardianNum.", Gurdian Operator=".$guardian_mobile_operator;
					
					$dtt_registration=$slist->dtt_mod;
					$dtt_deregistration=NULL;
					//echo "Reg. Date=".$dtt_registration;
					//$dtt_deregistration=$slist->dtt_deregistration;
					//echo "De. Reg. Date=".$dtt_deregistration;
					if($slist->OutdialPref=='s')
					$tx_distribution_channel='SMS';
					else
					$tx_distribution_channel='IVR';
					
					////////////////// Calculated Date /////////////////////					 
					$date = strtotime($dob_yyyymmdd);
					$date = strtotime("+52 week", $date);
					$calculated_date =date('Y-m-d', $date);
					
					$service_from=$this->general_model->get_form_date($dob_yyyymmdd,date("Y-m-d", strtotime($dtt_registration)));										
					
					$service_to=$calculated_date;
					}
					
				}
				echo "<br>";
				
			}	
			if($slist->LMD || $slist->DOB)
			{
			$insert_data=array(
							'int_subscriber_key'=>$int_subscriber_key,
							'tx_reg_id'=>$tx_reg_id,
							'tx_name'=>$slist->Name,
							'tx_mobile'=>$slist->MobNum,
							'operator_key'=>$mobile_operator,
							'tx_last_menstrual_period'=>$lmp_yyyymmdd,
							'tx_child_birth'=>$dob_yyyymmdd,
							'int_subscriber_type_key'=>$int_subscriber_type_key,
							'dtt_registration'=>$dtt_registration,
							'dtt_deregistration'=>$dtt_deregistration,
							'calculated_date'=>$calculated_date,
							'service_from'=>$service_from,
							'service_to'=>$service_to,						
							'days'=>$services_days,	
							'tx_distribution_channel'=>$tx_distribution_channel,
							'data_source'=>'e_subscribers'
							);
			
			/*echo "<pre>";
			print_r($insert_data);
			echo "</pre>";*/
			
			if($slist->RegIdGuardian && $slist->GuardianNum)
			{
			$insert_data_gurdian=array(
							'int_subscriber_key'=>$int_subscriber_key,
							'tx_reg_id'=>$slist->RegIdGuardian,
							'tx_name'=>NULL,
							'tx_mobile'=>$slist->GuardianNum,
							'operator_key'=>$guardian_mobile_operator,
							'tx_last_menstrual_period'=>$lmp_yyyymmdd,
							'tx_child_birth'=>$dob_yyyymmdd,
							'int_subscriber_type_key'=>3,  // Guardian
							'dtt_registration'=>$dtt_registration,
							'dtt_deregistration'=>$dtt_deregistration,
							'calculated_date'=>$calculated_date,
							'service_from'=>$service_from,
							'service_to'=>$service_to,						
							'days'=>$services_days,	
							'tx_distribution_channel'=>$tx_distribution_channel,
							'data_source'=>'e_subscribers'
							);
			/*echo "Gurdiant table";
			echo "<pre>";
			print_r($insert_data_gurdian);
			echo "</pre>";*/
			
			}
			$success_or_fail1=$this->general_model->save_into_table('t_subscribers_for_report', $insert_data);
				if($slist->RegIdGuardian && $slist->GuardianNum)
				{
				$success_or_fail2=$this->general_model->save_into_table('t_subscribers_for_report', $insert_data_gurdian);
				}
				
				if($success_or_fail1)
				{
				// Update the status
				$table_data=array(
								  'migration_status'=>1
								 );
				$this->general_model->update_table('e_subscriber', $table_data,'Id', $int_subscriber_key_original);
				}
				
			}			
			else
			{
			$table_data=array(
								  'migration_status'=>2
								 );
				$this->general_model->update_table('e_subscriber', $table_data,'Id', $int_subscriber_key_original);	
									
			}
		}// End foreach		
		$this->load->view('active_e_subscriber', isset($data) ? $data : NULL);	
			
	}
	
}


/* End of file active_subscriber.php */
