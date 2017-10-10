<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baseline extends CI_Controller {

	public function index()
	{
		
		$this->main();
	}
	
public function main()
	{
	}
	
public function getRules($networktype)
	{
		$this->load->model('model_baseline');
		$dataRes =  $this->model_baseline->getRules($networktype);
	
	$data="{";

 foreach($dataRes as $row){
	 $data = $data."k".$row->id.":\"".$row->name."\",";
 }
 
	$data = rtrim($data, ",");
	$data = $data."}";
 
echo $data;

}

public function getClusters($networktype)
	{
		$this->load->model('model_baseline');
		$dataRes =  $this->model_baseline->getClusters($networktype);
	
	$data="";

 foreach($dataRes as $row){
	 $data = $data.$row->cluster.',';
 }
 
 
echo $data;

}



	
public function Rules2G()
	{
			$networktype = "2G";
			$this->getRules($networktype);
	}
	
public function Rules3G()
	{
			$networktype = "3G";
			$this->getRules($networktype);
	}
	
public function Rules4G()
	{
			$networktype = "4G";
			$this->getRules($networktype);
	}
	
	
public function Clusters2G()
	{
			$networktype = "2G";
			$this->getClusters($networktype);
	}
	
public function Clusters3G()
	{
			$networktype = "3G";
			$this->getClusters($networktype);
	}
	
public function Clusters4G()
	{
			$networktype = "4G";
			$this->getClusters($networktype);
	}
	
	
public function baselineF()
{
	
	//define("BASEPATH",""); //solução temporaria
//	include_once("../config/database.php"); 
//	include_once("baselineStructure.php"); 

	$uri_array = $this->uri->uri_to_assoc(3);

	$networktype = $uri_array['networktype'];
	$cluster = $uri_array['cluster'];

	$baselineRule = 'UCELLDRD Rule';
	$baselineRuleID = $uri_array['rule']; //1; 

	$this->load->model('model_baseline');
	$this->model_baseline->getCheckDone($networktype, $cluster, $baselineRuleID);
	
}
 
		
}
