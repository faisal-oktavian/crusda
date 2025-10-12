<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	12-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("AZ.php");

class CI_AZModal extends CI_AZ {
	protected $ci;
	protected $modal;
	protected $modal_title;
	protected $action_modal;


	public function __construct() {
		$this->ci =& get_instance();
		$this->ci->load->helper("array");

		$this->column = array();
		$this->modal = "";
		$this->action_modal = array();
	}

	public function set_modal($data) {
		return $this->modal = $data;
	}
	public function set_modal_title($data) {
		return $this->modal_title = $data;
	}
	public function set_action_modal($data) {
		return $this->action_modal = $data;
	}

	public function render() {
		$modal = '<div class="modal fade az-modal az-modal-'.$this->id.'" data-width="800">
				    <div class="modal-dialog modal-lg">
				        <div class="modal-content">
				            <div class="modal-header">
				                <div class="az-modal-close" data-dismiss="modal" aria-hidden="true">
				                	<div class="caret-close"></div>
				                	<div class="modal-btn-close">
				                		<button type="button" class="close">X</button>
				                	</div>
				                </div>
				                <h4 class="modal-title">'.$this->modal_title.'</h4>
				            </div>
				            <div class="modal-body">';
		$modal .= $this->modal;
		$modal .= '    		</div>
				            <div class="modal-footer">
				                <div class="pull-right">';

        if (count($this->action_modal) > 0) {
        	foreach ($this->action_modal as $key => $value) {
				$modal .='	          <button class="btn btn-primary btn-action-'.$key.'" type="button">'.$value.'</button>';
        	}
        }


		$modal .= '		            
				                </div>
				            </div>
				        </div>
				    </div>
				</div>';
		return $modal;
	}

}