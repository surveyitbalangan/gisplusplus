<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('fusioncharts_helper')){

	// function Fusioncharts($chartType, $width, $height, $chartID, $isTransparent){
	// 	require_once('FusionCharts_Gen_1.php');
	// 	$FC = new Fusioncharts($chartType, $width, $height, $chartID, $isTransparent);
	// 	$FC->setSWFPath(base_url().'/asset/charts/');
	// 	return $FC;
	// }

	function Fusioncharts($chartType, $width, $height){
		include 'FusionCharts_Gen_1.php';
		$FC = new Fusioncharts($chartType, $width, $height);
		$FC->setSWFPath(base_url().'/asset/charts/');
		return $FC;
	}

}