<?php
/*
/* ------------------------------ */
/* Include Mobile Detect Library */
/* ---------------------------- */

/* -------------------------- */
require_once 'Mobile_Detect.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckDevice{
	public function make()
	{
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'Tablet' : 'Mobile') : 'Desktop');
		$scriptVersion = $detect->getScriptVersion();
		return $deviceType;
	}
}