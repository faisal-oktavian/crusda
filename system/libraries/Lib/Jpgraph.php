<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class CI_Jpgraph {
	    public function barchart() {
			include ("jpgraph/src/jpgraph.php");    		
			include ("jpgraph/src/jpgraph_pie.php"); 
			include ("jpgraph/src/jpgraph_pie3d.php");
			include ("jpgraph/src/jpgraph_bar.php");
	  	}

		public function linechart() {
			include ("jpgraph/src/jpgraph.php");
			include ("jpgraph/src/jpgraph_line.php");
		}
	}
?>