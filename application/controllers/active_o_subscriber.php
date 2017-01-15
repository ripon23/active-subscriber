<?php
class Active_o_subscriber extends CI_Controller {

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
		echo '<h4>Active Subscriber Migration. Table: aponjon-operations.subscribers</h4>';
		$searchterm="SELECT * FROM subscribers WHERE migration_status=0 AND mobile_number IS NOT NULL LIMIT 0, 400";
        $subscriber_list=$this->general_model->get_all_querystring_result($searchterm);
		$date_from='2016-09-01';
		$date_to='2016-12-31';
		
		foreach($subscriber_list as $slist){
			$lmp_yyyymmdd=NULL;
			$dob_yyyymmdd=NULL;
			if($slist->mobile_number)
			{
				if($slist->subscriber_type=='PREG')
				{
				/************** Pregnant  ****************/
				$int_subscriber_type_key=1;
				$orginal_subscriber_id=$slist->subscriber_id;
				$int_subscriber_key	=$slist->subscriber_id.mt_rand(1000, 9999);
				echo "int_subscriber_key=".$int_subscriber_key." ";	
				$tx_reg_id=$slist->raw_subscriber_id.mt_rand(1000, 9999);
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->mobile_number."(Preg)";
				$services_days=292;
				echo $slist->subscriber_name;
				
					if($slist->lmp)
					{					
					
					$lmp_yyyymmdd=$slist->lmp;
					echo " LMP=".$lmp_yyyymmdd;
					$mobile_operator=substr($slist->mobile_number, 2, 1);
					echo " Operator=".$mobile_operator;
										
					
					$dtt_registration=$slist->created_at;
					$dtt_deregistration=NULL;
					//echo "Reg. Date=".$dtt_registration;


					$tx_distribution_channel=$slist->distribution_channel;
					
					////////////////// Calculated Date /////////////////////					 
					$date = strtotime($lmp_yyyymmdd);
					$date = strtotime("+42 week", $date);
					$calculated_date =date('Y-m-d', $date);
					
					$service_from=$this->general_model->get_form_date($lmp_yyyymmdd,date("Y-m-d", strtotime($dtt_registration)));										
					
					$service_to=$calculated_date;
					}
					
				}
				else if($slist->subscriber_type=='BABY')
				{
				/************** Baby  ****************/	
				$int_subscriber_type_key=2;
				$orginal_subscriber_id=$slist->subscriber_id;
				$int_subscriber_key	=$slist->subscriber_id.mt_rand(1000, 9999);
				echo "int_subscriber_key=".$int_subscriber_key." ";	
				$tx_reg_id=$slist->raw_subscriber_id.mt_rand(1000, 9999);
				//echo "tx_reg_id=".$int_subscriber_key." ";
				echo $slist->mobile_number."(Baby)";
				$services_days=364;
				echo $slist->subscriber_name;
				
					if($slist->dob)
					{	
					$dob_yyyymmdd=$slist->dob;
					echo " DOB=".$slist->dob;
					$mobile_operator=substr($slist->mobile_number, 2, 1);
					echo " Operator=".$mobile_operator;
										
					
					$dtt_registration=$slist->created_at;
					$dtt_deregistration=NULL;
					//echo "Reg. Date=".$dtt_registration;


					$tx_distribution_channel=$slist->distribution_channel;
					
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
			if($slist->lmp || $slist->dob)
			{
					
			$insert_data=array(
							'int_subscriber_key'=>$int_subscriber_key,
							'tx_reg_id'=>$tx_reg_id,
							'tx_name'=>$slist->subscriber_name,
							'tx_mobile'=>$slist->mobile_number,
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
							'data_source'=>'subscribers'
							);
			
			/*echo "<pre>";
			print_r($insert_data);
			echo "</pre>";*/
			
			
			$success_or_fail1=$this->general_model->save_into_table('t_subscribers_for_report', $insert_data);
				
				if($success_or_fail1)
				{
				// Update the status
				$table_data=array(
								  'migration_status'=>1
								 );
				$this->general_model->update_table('subscribers', $table_data,'subscriber_id', $orginal_subscriber_id);
				}
				
			}			
			else
			{
			$table_data=array(
								  'migration_status'=>2
								 );
				$this->general_model->update_table('subscribers', $table_data,'subscriber_id', $orginal_subscriber_id);
									
			}
		}// End foreach		
		$this->load->view('active_o_subscriber', isset($data) ? $data : NULL);	
			
	}
	
}


/* End of file active_subscriber.php */
