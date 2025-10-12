<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	07-03-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("AZ.php");

class CI_AZAppCRUD extends CI_AZ {
	protected $ci = "";
	protected $column = "";
	protected $sort = "";
	protected $width = "";
	protected $th_class = "";
	protected $select = "";
	protected $select_align = "";
	protected $select_number = "";
	protected $select_decimal = "";
	protected $select_date = "";
	protected $filter = "";
	protected $table = "";
	protected $sorting = "";
	protected $join = array();
	protected $join_manual = array();
	protected $select_table = "";
	protected $column_show = array();
	protected $cfilter = array();
	protected $where = array();
	protected $order_by = "";
	protected $url = "";
	protected $url_edit = "";
	protected $url_delete = "";
	protected $url_save = "";
	protected $ttotal_item = "true";
	protected $tinfo = "true";
	protected $tpaginate = "true";
	protected $form = "";
	protected $modal = "";
	protected $modal_title = "";
	protected $special_filter = array();
	protected $single_filter = true;
	protected $custom_style = "";
	protected $edit = true;
	protected $delete = true;
	protected $btn_add = true;
	protected $limit_entries = true;
	protected $btn_save_modal = true;
	protected $custom_btn = "";
	protected $default_url = false;
	protected $callback_save = "";
	protected $callback_add = "";
	protected $callback_delete = "";
	protected $callback_edit = "";
	protected $top_filter = "";
	protected $btn_top_custom = "";
	protected $data_save = array();
	protected $filter_placeholder = "";
	protected $top_filter_btn = "";
	protected $selected_delete = true;
	protected $selected_button = array();	
	protected $btn_left_modal = array();
	protected $btn_right_modal = array();
	protected $callback_table_complete = '';
	protected $group_by = '';
	protected $aodata = array();
	protected $idtable = '';

	protected $custom_first_column = false;
	protected $last_column_sorting = false;

	// select union
	protected $select_union = "";
	protected $union = '';
	protected $select_id = '';
	// end select union
	protected $manual_query = "";
	//last query
	protected $last_query = "";

	//additional response
	protected $additional_response = null;

	protected $edit_type = "1";

	//close modal on save 
	protected $close_modal_on_save = true;
	protected $before_save = "";

	public function __construct() {
		$this->ci =& get_instance();
		// $this->ci->load->helper("az_crud");
		$this->ci->load->helper("array");
		$this->ci->load->library("encrypt");
	}

	public function set_column($data) {
		return $this->column = $data;
	}

	public function set_sort($data) {
		return $this->sort = $data;
	}

	public function set_width($data) {
		return $this->width = $data;
	}

	public function set_th_class($data) {
		return $this->th_class = $data;
	}

	public function set_select($data) {
		return $this->select = $data;
	}

	// select union
	public function set_select_union($data) {
		return $this->select_union = $data;
	}

	public function set_select_id($data) {
		return $this->select_id = $data;
	}
	// end select union

	public function set_manual_query($data) {
		return $this->manual_query = $data;
	}

	public function set_select_table($data) {
		return $this->select_table = $data;
	}

	public function set_select_align($data) {
		return $this->select_align = $data;
	}

	public function set_select_number($data) {
		return $this->select_number = $data;
	}

	public function set_select_decimal($data) {
		return $this->select_decimal = $data;
	}

	public function set_select_date($data) {
		return $this->select_date = $data;
	}

	public function set_filter($data) {
		return $this->filter = $data;
	}

	public function set_table($data) {
		return $this->table = $data;
	}

	public function set_sorting($data) {
		return $this->sorting = $data;
	}

	public function set_top_filter($data) {
		return $this->top_filter = $data;
	}

	public function set_close_modal_on_save($data) {
		return $this->close_modal_on_save = $data;
	}

	public function add_join($data, $type = "", $other = "", $join_x = "") {
		$rdata = array(
			"join" => $data,
			"type" => $type,
			"other" => $other,
			"join_x" => $join_x
		);
		return $this->join[] = $rdata;
	}

	public function add_join_manual($join, $on, $type = 'inner') {
		$jm_data = array(
			"join" => $join,
			"on" => $on,
			"type" => $type
		);
		return $this->join_manual[] = $jm_data;
	}

	public function set_join_multiple($data) {
		return $this->join_multiple = $data;
	}

	public function set_column_show($data) {
		return $this->cfilter = $data;
	}

	public function add_where($data) {
		return $this->where[] = $data;
	}

	public function set_order_by($data) {
		return $this->order_by = $data;
	}

	public function set_url($data) {
		return $this->url = $data;
	}

	public function set_url_edit($data) {
		return $this->url_edit = $data;
	}

	public function set_url_save($data) {
		return $this->url_save = $data;
	}

	public function set_url_delete($data) {
		return $this->url_delete = $data;
	}

	public function set_tinfo($data) {
		return $this->tinfo = $data;
	}

	public function set_ttotal_item($data) {
		return $this->ttotal_item = $data;
	}

	public function set_tpaginate($data) {
		return $this->tpaginate = $data;
	}

	public function set_form($data) {
		return $this->form = $data;
	}

	public function set_modal($data) {
		return $this->modal = $data;
	}
	
	public function set_modal_title($data) {
		return $this->modal_title = $data;
	}

	public function set_special_filter($data) {
		return $this->special_filter = $data;
	}

	public function set_single_filter($data) {
		return $this->single_filter = $data;
	}

	public function set_custom_style($data) {
		return $this->custom_style = $data;
	}

	public function set_edit($data) {
		return $this->edit = $data;
	}

	public function set_delete($data) {
		return $this->delete = $data;
	}

	public function set_custom_first_column($data) {
		return $this->custom_first_column = $data;
	}

	public function set_last_column_sorting($data) {
		return $this->last_column_sorting = $data;
	}

	public function set_btn_add($data) {
		return $this->btn_add = $data;
	}

	public function set_limit_entries($data) {
		return $this->limit_entries = $data;
	}

	public function set_btn_save_modal($data) {
		return $this->btn_save_modal = $data;
	}

	public function set_custom_btn($data) {
		return $this->custom_btn = $data;
	}

	public function set_default_url($data) {
		return $this->default_url = $data;
	}
	
	public function set_before_save($data){
		$this->before_save = $data;
	}

	public function set_callback_save($data) {
		return $this->callback_save = $data;
	}

	public function set_callback_delete($data) {
		return $this->callback_delete = $data;
	}

	public function set_callback_add($data) {
		return $this->callback_add = $data;
	}

	public function set_callback_edit($data) {
		return $this->callback_edit = $data;
	}

	public function set_btn_top_custom($data) {
		return $this->btn_top_custom = $data;
	}

	public function add_data_save($key, $value) {
		return $this->data_save[$key] = $value;
	}

	public function set_filter_placeholder($data) {
		return $this->filter_placeholder = $data;
	}

	public function set_top_filter_btn($data) {
		return $this->top_filter_btn = $data;
	}

	public function set_selected_delete($data) {
		return $this->selected_delete = $data;
	}

	public function add_selected_button($key, $data) {
		return $this->selected_button[$key] = $data;
	}

	public function add_btn_left_modal($key, $data) {
		return $this->btn_left_modal[$key] = $data;
	}

	public function add_btn_right_modal($key, $data) {
		return $this->btn_right_modal[$key] = $data;
	}

	public function set_callback_table_complete($data) {
		return $this->callback_table_complete = $data;
	}

	public function set_group_by($data) {
		return $this->group_by = $data;
	}

	public function add_aodata($key, $data) {
		return $this->aodata[$key] = $data;
	}
	public function set_idtable($data) {
		return $this->idtable = $data;
	}

	public function set_current_last_query($data)
	{
		return $this->last_query = $data;
	}

	public function get_last_query()
	{
		return $this->last_query;
	}

	public function set_additional_response($data)
	{
		return $this->additional_response = $data;
	}

	public function set_edit_type($data) {
		return $this->edit_type = $data;
	}

	public function render() {
		$ci =& get_instance();

		$btn_add_position = "pos-relative";
		$hide_search = "";
		if ($this->single_filter == true) {
			$btn_add_position = "pull-left";
			$hide_search = "f";
		}
		
		$limit_entries = "";
		if ($this->limit_entries) {
			$limit_entries = "l";
		}


		$table = "";

		if (strlen($this->top_filter) > 0) {
			$table .= '
				<div class="form-top-filter form-top-filter-'.$this->id.'">
					<div class="azcrud-container-show-hide azcrud-container-show-hide-'.$this->id.'">
						<div class="azcrud-show-hide-filter"><i class="fa fa-search"></i> '.azlang('Show/Hide Filter').'</div>
						<div class="form-top-filter-hide form-top-filter-hide-'.$this->id.'">
							<i class="fa fa-chevron-circle-down"></i>
						</div>
					</div>

					<div class="form-top-filter-body form-top-filter-body-'.$this->id.'">
						'.$this->top_filter.'
					    <div>
					    	<button class="btn btn-info" id="btn_top_filter_'.$this->id.'" type="button"><i class="fa fa-search"></i> &nbsp;Filter</button>
					    	'.$this->top_filter_btn.'
					    </div>
					</div>
				</div>
			';
		}

		$table .= "<div class='".$btn_add_position." btn-top-table'>";
		if ($this->btn_add) {
			$table .= '<button class="btn btn-primary az-btn-primary btn-add-'.$this->id.'" type="button"><span class="glyphicon glyphicon-plus"></span> '.azlang('Add').'</button>';
		}

		if (strlen($this->btn_top_custom) > 0) {
			$table .= $this->btn_top_custom;
		}

		$table .= '
			&nbsp;&nbsp;<button class="btn btn-info btn-option-table btn-select-all-'.$this->id.' btn-xs" type="button"><i class="fa fa-check-square-o"></i> '.azlang('Select All').'</button>

			&nbsp;&nbsp;<button class="btn btn-info btn-option-table btn-unselect-all-'.$this->id.' btn-xs" type="button"><i class="fa fa-square-o"></i> '.azlang('Clear Selection').'</button>
			';

		if($this->selected_delete) {
			$table .= '&nbsp;&nbsp;<button class="btn btn-danger btn-option-table btn-delete-selected-'.$this->id.' btn-xs" type="button"><span class="glyphicon glyphicon-remove"></span> '.azlang('Delete Selection Data').'</button>';
		}

		$txt_selected_button = '';
		foreach ($this->selected_button as $key => $value) {
			$text = $value;
			$btn_class = 'success';
			$btn_icon = 'th-large';
			if(is_array($value)) {
				$text = azarr($value, 0);
				$btn_class = azarr($value, 1);
				$btn_icon = azarr($value, 2);
			}

			$table .= '&nbsp;&nbsp;<button class="btn btn-'.$btn_class.' btn-option-table btn-'.$key.'-selected-'.$this->id.' btn-xs" type="button"><span class="glyphicon glyphicon-'.$btn_icon.'"></span> '.$text.'</button>';
			$txt_selected_button = ', .btn-'.$key.'-selected-'.$this->id;
		}

		$table .= '&nbsp;&nbsp;<span class="selected-data-'.$this->id.'"></span>
			';

		$table .= "</div>";

		$table_class = " table-bordered table-condensed ";

		$app_version = $ci->config->item('app_version');
		if ($app_version == '3') {
			$table_class = '';
		}

		$table .= "<table class='".$this->class." az-table table table-striped ".$table_class." table-hover dt-responsive display nowrap' id='".$this->id."'>";
		$table .= "	<thead>";

		$table .= "<tr role='row' class='heading'>";
		$table_column = azarr_explode($this->column);
		$col_width = azarr_explode($this->width);
		$th_class = azarr_explode($this->th_class);

		$last_col = count($table_column) - 1;			
		if (count($col_width) == 0) {
			$col_width[0] = '10px';
			$col_width[$last_col] = '120px';
		}

		if (count($th_class) == 0) {
			$th_class[0] = 'no-sort';
			if($this->last_column_sorting == false) {
				$th_class[$last_col] = 'no-sort';
			}
		}

		$i = 0;
		foreach ($table_column as $value) {
			$column_width = '';
			if (isset($col_width[$i])) {
				$column_width = "width='".$col_width[$i]."'";
			}

			$column_class = '';
			if (isset($th_class[$i])) {
				$column_class = "class='".$th_class[$i]."'";
			}
			$i++;

			$table .= "<th ".$column_width." ".$column_class.">";
			$table .= $value;
			$table .= "</th>";
		}
		$table .= "</tr>";

		if (count($this->special_filter) > 0) {
			$table .= "<tr role='row' class='filter'>";
			$table .= "<td></td>";
			$c_special_filter = count($this->special_filter);
			$c_table_column = count($table_column);
			if ($c_special_filter < $c_table_column) {
				$loop_special_filter = $c_table_column - $c_special_filter;
				for ($i=2; $i < $loop_special_filter; $i++) { 
					$this->special_filter[] = '';
				}
			}
			foreach ($this->special_filter as $value) {
				$table .= "<td>";
				$table .= $value;
				$table .= "</td>";
			}
			$table .= "	<td>";
			$table .= '<button class="btn btn-primary az-btn-primary filter-submit full-width" type="button" id="btn_filter_'.$this->id.'"><i class="fa fa-search"></i>&nbsp;&nbsp;Filter</button>';
			$table .= "	</td>";
			$table .= "</tr>";
		}

		$table .= "	</thead>";
		$table .= "	<tbody>";
		$table .= "	</tbody>";
		$table .= "</table>";
		if ($this->default_url) {
			if (strlen($this->url) == 0) {
				$this->url = "app_url+'".$this->id."/get'";
			}
			if (strlen($this->url_edit) == 0) {
				$this->url_edit = "app_url+'".$this->id."/edit'";
			}

			if (strlen($this->url_delete) == 0) {
				$this->url_delete = "app_url+'".$this->id."/delete'";
				
				// if (!method_exists($this->id, 'delete')){
				// 	$tb_name = $ci->encrypt->encode($this->id);
				// 	$tb_name = urlencode($tb_name);
				// 	$this->url_delete = "app_url+'azcrud/delete/?a=".$tb_name."'";
				// }
			}
			if (strlen($this->url_save) == 0) {
				$this->url_save = "app_url+'".$this->id."/save'";
			}
		}

		$data_save_js = "{}";
		if (count($this->data_save) > 0) {
			$dsj = "{";
			foreach ($this->data_save as $key => $value) {
				$dsj .= $key.": ".$value.",";
			}
			$dsj .= "}";
			$data_save_js = $dsj;
		}


		$js_table = '
				var request_ajax_table_'.$this->id.' = null;
				generate_table_'.$this->id.'();
				function generate_table_'.$this->id.'(){
				    var total_column = [];
				    var column = jQuery("#'.$this->id.' thead tr:eq(0) th").length;
				    for(var i = 0;i<column;i++){
				        total_column.push(null);
				    }
				       
				    jQuery("#'.$this->id.'").dataTable({
				        "bServerSide": true,
				        "sAjaxSource": '.$this->url.',
				        "bFilter": true,
				        "bProcessing": true,
				        "bLengthChange": '.$this->ttotal_item.',
				        "bSort": true,
				        "bSortCellsTop": true,
				        "dom": \'<"row"<"col-sm-6 col-sm-offset-6"'.$hide_search.'>> <"row"<"col-sm-12"tr>><"row"<"col-sm-5"'.$limit_entries.'><"col-sm-7"p>><"row"<"col-sm-12"i>>\',
				        "bAutoWidth": false,
				        "bPaginate": '.$this->tpaginate.',
				        "bInfo": '.$this->tinfo.',
				        "lengthMenu": [ [10, 25, 50, 100, 200, 300, 500, -1], [10, 25, 50, 100, 200, 300, 500, "'.azlang('All').'"] ],
				        // "lengthMenu": [ [10, 25, 50, 100, 200, 300, 500], [10, 25, 50, 100, 200, 300, 500] ],
				        "aoColumns": total_column,
				        "columnDefs": [{
				                "targets": "no-sort",
				                "orderable": false,
				                "order": []
				            }],
				        "fnServerParams": function ( aoData ) {
		                    jQuery("#'.$this->id.' .form-filter").each(function() {
		                    	var id_filter = jQuery(this).attr("data-filter");
		                    	var clear_id_filter = id_filter.substring(2);
		                    	aoData.push({"name": "cfilter["+clear_id_filter+"]", "value": jQuery(this).val()});
						    });
						    jQuery(".form-top-filter-'.$this->id.' .element-top-filter").each(function() {
						    	var id_filter = jQuery(this).attr("data-id");
						    	var value_filter = jQuery(this).val();
						    	var con_value = "";
						    	var tpwh = jQuery(this).attr("data-w");
						    	if (tpwh == "true") {
						    		if (value_filter != null) {
						    			value_filter = "x~aztpwh~"+value_filter;
						    		}
						    	}

						    	jQuery(this).find(".con-element-top-filter").each(function() {
						    		var pre = "";
						    		if (con_value != "") {
						    		 	pre = "~az~";
						    		} 
						    		con_value += pre+jQuery(this).val();
						    	});

						    	if (con_value != "") {
						    		value_filter = con_value;
						    	}
						    	aoData.push({"name": "topfilter["+id_filter+"]", "value": value_filter});
						    });
						    ';

		if (count($this->aodata) > 0) {
			foreach ($this->aodata as $key => $value) {
				$js_table .= '
			                   	aoData.push({"name": "'.$key.'", "value": jQuery("#'.$value.'").val()});
				';
			}
		}

		$js_table .= '		
						    jQuery("#'.$this->id.' .form-filter").each(function() {
		                    	var id_filter = jQuery(this).attr("data-filter");
		                    	var clear_id_filter = id_filter.substring(2);
		                    	aoData.push({"name": "cfilter["+clear_id_filter+"]", "value": jQuery(this).val()});
						    });
		                },
						fnServerData: function (sSource, aoData, fnCallback, oSettings) {
							if (request_ajax_table_'.$this->id.' !== null) {
								request_ajax_table_'.$this->id.'.abort();
							}

							request_ajax_table_'.$this->id.' = $.ajax({
								dataType: "json",
								type: "GET",
								url: sSource,
								data: aoData,
								success: function (data) {
									// console.log(data);
									oSettings.json = data;
									fnCallback(data);
								},
								complete: function () {
									request_ajax_table_'.$this->id.' = null;
								}
							});
						},

		                "drawCallback": function(settings) {
					        // var api = this.api();
					        // var json = api.ajax.json();

					        var json = settings.json;
							// console.log(json);

					        callback_table_complete_'.$this->id.'(json);
					    },
					    "language":{
						    "sProcessing":   "'.azlang('Processing...').'",
						    "sLengthMenu":   "'.azlang('Showing').' _MENU_ '.azlang('entries').'",
						    "sZeroRecords":  "'.azlang('No matching records found').'",
						    "sInfo":         "'.azlang('Showing').' _START_ '.azlang('to').' _END_ '.azlang('of').' _TOTAL_ '.azlang('Entries').'",
						    "sInfoEmpty":    "'.azlang('Showing').' 0 '.azlang('to').' 0 '.azlang('of').' 0 '.azlang('Entries').'",
						    "sInfoFiltered": "('.azlang('filtered from').' _MAX_ '.azlang('total entries').')",
						    "sInfoPostFix":  "",
						    "sSearch":       "'.azlang('Search:').'",
						    "sUrl":          "",
						    "oPaginate": {
						        "sFirst":    "'.azlang('First').'",
						        "sPrevious": "'.azlang('Previous').'",
						        "sNext":     "'.azlang('Next').'",
						        "sLast":     "'.azlang('Last').'"
						    }
					    }
				    });
				}

				function callback_table_complete_'.$this->id.'(json) {
					'.$this->callback_table_complete.';
				}

				var callback_edit_'.$this->id.' = function(response) {
			    	'.$this->callback_edit.'
			    };

				jQuery("body").on("click", ".btn-edit-'.$this->id.'", function(){
			        var id = jQuery(this).attr("data_id");

			        edit('.$this->url_edit.', id, "'.$this->form.'", "'.$this->id.'", callback_edit_'.$this->id.', '.$this->edit_type.');
			    });

			    var callback_delete_'.$this->id.' = function(response) {
			    	'.$this->callback_delete.'
			    };

			    jQuery("body").on("click", ".btn-delete-'.$this->id.'", function(){
			        var id = jQuery(this).attr("data_id");
			        remove('.$this->url_delete.', id, "'.$this->id.'", callback_delete_'.$this->id.');
			    });

			    var callback_save_'.$this->id.' = function(response) {
			    	'.$this->callback_save.'
			    };

			    var callback_add_'.$this->id.' = function() {
			    	'.$this->callback_add.'
			    };

			    var data_save_'.$this->id.' = '.$data_save_js.';

			    jQuery("body").on("click", ".btn-save-'.$this->id.'", async function(){
					'.$this->before_save.'
					save('.$this->url_save.', "'.$this->form.'", "'.$this->id.'", callback_save_'.$this->id.', data_save_'.$this->id.', '.($this->close_modal_on_save ? 'true' : 'false').');
			    });

			    jQuery("body").on("click", ".btn-add-'.$this->id.'", function(){
			        clear();
			        jQuery(".modal-title span").text("'.azlang('Add').'");
			        show_modal("'.$this->id.'");
			        callback_add_'.$this->id.'();
			        
	                jQuery(".az-image-container .az-image img").attr("src", base_url + "assets/images/no-image.jpg");
	                jQuery(".az-image-file-div").show();
			    });

			    jQuery("#btn_filter_'.$this->id.'").click(function(){
		            var dtable = $("#'.$this->id.'").dataTable({bRetrieve:true});
		            dtable.fnDraw();
		        });

		        jQuery("#btn_top_filter_'.$this->id.'").click(function(){
		            var dtable = $("#'.$this->id.'").dataTable({bRetrieve:true});
		            dtable.fnDraw();
		        });
 
 				jQuery(document).on("click", ".az-table#'.$this->id.' tbody tr td", function (event) {
			        var btn = jQuery(this).find("button");
			        if (btn.length == 0) {
			            var selected = check_table_'.$this->id.'();
 						init_selected_table_'.$this->id.'();
			        }
			    });

 				jQuery(".btn-select-all-'.$this->id.'").on("click", function() {
 					sel_un_all_'.$this->id.'("select");
 				});

 				jQuery(".btn-unselect-all-'.$this->id.'").on("click", function() {
 					sel_un_all_'.$this->id.'("unselect");
 				});

 				jQuery(".az-table#'.$this->id.'").on("draw.dt", function () {
 					init_selected_table_'.$this->id.'();
 				});

 				jQuery(document).on("hidden.bs.modal", ".modal", function () {
 					sel_un_all_'.$this->id.'();
 				});

 				jQuery(".btn-delete-selected-'.$this->id.'").on("click", function() {
 					var id_delete = check_table_'.$this->id.'();
 					remove('.$this->url_delete.', id_delete, "'.$this->id.'", callback_delete_'.$this->id.');
 				});

 				// jQuery(".form-top-filter-hide-'.$this->id.'").on("click", function() {
 				// 	jQuery(".form-top-filter-body-'.$this->id.'").slideToggle("fast");
 				// 	jQuery(".form-top-filter-hide-'.$this->id.'").find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up");
 				// });

 				jQuery(".azcrud-container-show-hide-'.$this->id.'").on("click", function() {
 					jQuery(".form-top-filter-body-'.$this->id.'").slideToggle("fast");
 					jQuery(".form-top-filter-hide-'.$this->id.'").find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up");
 				});

 				jQuery(".az-'.$this->id.'").on("click", function() {
 					jQuery(".form-top-filter-body-'.$this->id.'").slideToggle("fast");
 					jQuery(this).find(".fa").toggleClass("fa-chevron-circle-down fa-chevron-circle-up");
 				});

 				jQuery("#'.$this->id.'_filter input").attr("placeholder", "'.$this->filter_placeholder.'");


			function init_selected_table_'.$this->id.'() {
				var selected = check_table_'.$this->id.'();
				var btn_hide = jQuery(".btn-select-all-'.$this->id.', .btn-unselect-all-'.$this->id.', .btn-delete-selected-'.$this->id.', .selected-data-'.$this->id.$txt_selected_button.'");
				if (selected.length > 0) {
					btn_hide.show();
				}
				else {
					btn_hide.hide();
				}
			}

		    function check_table_'.$this->id.'() {
		    	var table_select = jQuery(".az-table#'.$this->id.' tbody tr.selected");
		    	var arr_delete = [];
		    	table_select.each(function() {
		    		var check_data = jQuery(this).find(".btn-delete-'.$this->id.'").attr("data_id");
		    		if (typeof check_data != "undefined") {
		    			arr_delete.push(check_data);
		    		}
		    	});
		    	jQuery(".selected-data-'.$this->id.'").text(arr_delete.length+" Data Terpilih");
		    	return arr_delete;
		    }

		    function sel_un_all_'.$this->id.'(type) {
		    	if (type == "select") {
		    		jQuery(".az-table#'.$this->id.' tbody tr").addClass("selected");
		    	}
		    	else {
		    		jQuery(".az-table#'.$this->id.' tbody tr").removeClass("selected");	
		    	}
		    	init_selected_table_'.$this->id.'();
		    }
		';

		$ci->load->library('AZApp');
		$azapp = $ci->azapp;
		$azapp->add_js_ready($js_table);

		return $table;
	}

	public function get_table() {
		$records = array();
		$records["aaData"] = array();
		$records["sMessage"] = "";

		$select = $this->select;
		$select_union = $this->select_union; // select union
		$select_id = $this->select_id;
		$select_align = azarr_explode($this->select_align);
		$select_number = azarr_explode($this->select_number);
		$select_decimal = azarr_explode($this->select_decimal);
		$select_date = azarr_explode($this->select_date);
		$filter = $this->filter;
		$table = $this->table;
		$select_table = $this->select_table;
		$sorting = azarr_explode($this->sorting);
		$join  = $this->join;
		$join_manual = $this->join_manual;
		$column_show = $this->column_show;
		$cfilter = '';
		$top_filter = array();
		$_REQUEST = array_merge($this->ci->input->get(), $_REQUEST);
		if (isset($_REQUEST['cfilter'])) {
			$cfilter = $_REQUEST['cfilter'];
		}

		if (isset($_REQUEST['topfilter'])) {
			$top_filter = $_REQUEST['topfilter'];
		}

		// parse_str($_SERVER['QUERY_STRING'], $str);
		// $top_filter = $str['topfilter'];

		$where = $this->where;
		$order_by = azarr_explode($this->order_by);

		$column_show = array();

		if(strlen($select) > 0){
			$column_show = azarr_explode($select);
		}

		// jika menggunakan select_union
		if (strlen($select_union) > 0) {

			// ambil apa yang diselect di query pertamanya saja dan teks "SELECT".
			$column_show = str_replace("SELECT", "", $select);
			$column_show = explode(" ",$column_show);
			$column_show = str_replace(",", "", $column_show);

			$arr_arr_column_show = array();
			$loop = true;
			foreach ($column_show as $key => $value) {
				// ambil data yang ada nilainya dari query select saja
				if (strlen($value) > 0 && $loop == true) {

					// jika nilai mengandung kata "FROM", lalu kata "FROM" dihapus dari nilainya
					if(preg_match("/FROM/i", $value)) {
					  $loop = false;
					  $value = preg_replace("/FROM/i", "", $value);
					  $value = preg_replace('/\s+/', '', $value);
					}
					// jika nilai mengandung simbol `, maka dihilangkan
					$value = preg_replace("/`/i", "", $value);
					$arr_column_show[] = $value;
				}
			}

			$column_show = $arr_column_show;
			// ambil apa yang diselect di query kedua saja dan teks "SELECT".
			$column_show_union = str_replace("SELECT", "", $select_union);
			$column_show_union = explode(" ",$column_show_union);

			$arr_arr_column_show_union = array();
			$loop = true;
			foreach ($column_show_union as $key => $value) {
				// ambil data yang ada nilainya dari query select saja
				if (strlen($value) > 0 && $loop == true) {

					// jika nilai mengandung kata "FROM", lalu kata "FROM" dihapus dari nilainya
					if(preg_match("/FROM/i", $value)) {
					  $loop = false;
					  $value = preg_replace("/FROM/i", "", $value);
					  $value = preg_replace('/\s+/', '', $value);
					  $value = preg_replace("/`/i", "", $value);
					}
					// jika nilai mengandung simbol `, maka dihilangkan
					$value = preg_replace("/`/i", "", $value);
					$arr_column_show_union[] = $value;
				}
			}
			$column_show_union = $arr_column_show_union;
		}

		if(strlen($select_table) > 0){
			$column_show = azarr_explode($select_table);
		}

		$iTotalRecords = 0;
		
		$data_filter = ''; //filter untuk select union
		if($filter != ''){
			if (strlen(azarr($_REQUEST, 'sSearch')) > 0) {
				$arr_filter = explode(',', $filter);
				foreach ($arr_filter as $key => $value) {
					$value = trim($value);
					if ($key == 0) {
						$this->ci->db->group_start();
						$this->ci->db->like($value, $_REQUEST["sSearch"]);

						$data_filter = " (".$value." LIKE '%".$_REQUEST["sSearch"]."%' ESCAPE '!'";
					}
					else {
						$this->ci->db->or_like($value, $_REQUEST["sSearch"]);

						$data_filter .= " OR ".$value." LIKE '%".$_REQUEST["sSearch"]."%' ESCAPE '!'";
					}
					if (($key + 1) == count($arr_filter)) {
						$this->ci->db->group_end();

						$data_filter .= ")";
					}
				}
			}
		}

		if(count($where) > 0){
			foreach($where as $pw_k => $pw_v){
				$this->ci->db->where($pw_v);
			}
		}

		if (count($top_filter) > 0) {
			foreach ($top_filter as $key => $value) {
				$key = $this->ci->encrypt->decode($key);
				$check = explode("~az~", $value);
				$check_tpwh = explode("~aztpwh~", $value);
				if (count($check) > 1) {
					$top_filter1 = azarr($check, "0");
					$top_filter2 = azarr($check, "1");
					$check_date = explode("-", $top_filter1);
					if (count($check_date) > 1) {
						$top_filter1 = Date("Y-m-d H:i:s", strtotime($top_filter1." 00:00:00"));
						$top_filter2 = Date("Y-m-d H:i:s", strtotime($top_filter2." 23:59:59"));
					}
					$this->ci->db->where("(".$key." BETWEEN '".$top_filter1."' AND '".$top_filter2."')");
				}
				else if (count($check_tpwh) > 1) {
					$tpwh_val = azarr($check_tpwh, "1");
					if (strlen($tpwh_val) > 0) {
						$this->ci->db->where($key, $tpwh_val);
					}
				}
				else {
					if (strlen($value) > 0) {
						$is_id = '.id';
						if (strpos($key, $is_id) !== false) {
							$this->ci->db->where($key, $value);
						} else {
							$this->ci->db->like($key, $value);
						}
					}
				}
			}
		}


		if (count($join) > 0) {
			foreach ($join as $key => $value) {
				$data_join = azarr($value, 'join');
				$data_type = azarr($value, 'type');
				$data_other = azarr($value, 'other');
				$data_join_x = azarr($value, 'join_x');
				$data_join_y = azarr($value, 'join_y');

				$join_target = $table;
				if (strlen($data_other) > 0) {
					$join_target = $data_other;
				}

				$data_join_col = "id".$data_join;
				if (strlen($data_join_x) > 0) {
					$data_join_col = $data_join_x;
				}

				if (strlen($data_type) > 0) {
					$this->ci->db->join($data_join, $data_join.".".$data_join_col." = ".$join_target.".".$data_join_col, $data_type);
				}
				else {
					$this->ci->db->join($data_join, $data_join.".".$data_join_col." = ".$join_target.".".$data_join_col);
				}
			}
		}

		if (count($join_manual) > 0) {
			foreach ($join_manual as $key => $value) {
				$jm_join = azarr($value, 'join');
				$jm_on = azarr($value, 'on');
				$jm_type = azarr($value, 'type');
				$this->ci->db->join($jm_join, $jm_on, $jm_type);
			}
		}

		if($cfilter != ''){
			foreach($cfilter as $pcf_k => $pcf_v){
				$pcf_k = $this->ci->encrypt->decode($pcf_k);
				if(strlen($pcf_v) > 0){
					$this->ci->db->like($pcf_k, $pcf_v);
				}
			}
		}

		if(strlen($this->group_by) > 0){
			$this->ci->db->group_by($this->group_by);
		}  

		if (strlen($select_union) > 0) {
			$link = '';
			// cek apakah ada filter search
			if ($data_filter != '') {
				if(preg_match("/WHERE/i", $select.' UNION '.$select_union)) {
		            $link = ' AND ';
		        }
		        else {
		        	$link = ' WHERE ';
		        }
			}
			// $query_union = $this->ci->db->query($select.' UNION '.$select_union.$link.$data_filter);
			$query_union = $this->ci->db->query('select * from ('.$select.' UNION '.$select_union.') as new_query '.$link.$data_filter);
			$last_query_union = $this->ci->db->last_query();
			$iTotalRecords = $query_union->num_rows();
		}

		if(strlen($this->manual_query) > 0) {
			// var_dump($this->manual_query);
			$manuq = $this->manual_query;

			if(strlen($this->group_by) > 0){
				$manuq = $manuq.' GROUP BY '.$this->group_by;
			}

			$iTotalRecords = $this->ci->db->query($manuq)->num_rows();
		}

		// jika tidak menggunakan select_union
		if (strlen($select_union) == 0 && strlen($this->manual_query) == 0) {
			$this->ci->db->select($select);
			$iTotalRecords = $this->ci->db->get($table)->num_rows();
		}
		// var_dump($iTotalRecords);

		$iTotalDisplayRecords = $iTotalRecords;

		$iDisplayLength = intval(azarr($_REQUEST, 'iDisplayLength'));
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval(azarr($_REQUEST, 'iDisplayStart'));
		$sEcho = intval($_REQUEST['sEcho']);

		$this->ci->db->limit($iDisplayLength);
		$this->ci->db->offset($iDisplayStart);

		if($filter != ''){
			if (strlen(azarr($_REQUEST, 'sSearch')) > 0) {
				$arr_filter = explode(',', $filter);
				foreach ($arr_filter as $key => $value) {
					$value = trim($value);
					if ($key == 0) {
						$this->ci->db->group_start();
						$this->ci->db->like($value, $_REQUEST["sSearch"]);
					}
					else {
						$this->ci->db->or_like($value, $_REQUEST["sSearch"]);
					}
					if (($key + 1) == count($arr_filter)) {
						$this->ci->db->group_end();
					}
				}
			}
		}
		
		$data_order_by = ''; // order by select_union
		$iSortCol_0 = azarr($_REQUEST, "iSortCol_0");
		foreach($sorting as $ps_k => $ps_v){
	        if($iSortCol_0 == ($ps_k + 1)) {          
	            $this->ci->db->order_by($ps_v, $_REQUEST["sSortDir_0"]);
	            $data_order_by = ' ORDER BY '.$ps_v.' '.$_REQUEST["sSortDir_0"];
	        }
		}

		if(count($where) > 0){
			foreach($where as $pw_k => $pw_v){
				$this->ci->db->where($pw_v);
			}
		}       

		// $select = implode(", ", $select);
		if (strlen($select_union) == 0) {
			$this->ci->db->select(array($select), false);
		}

		if (count($join) > 0) {
			foreach ($join as $key => $value) {
				$data_join = azarr($value, 'join');
				$data_type = azarr($value, 'type');
				$data_other = azarr($value, 'other');
				$data_join_x = azarr($value, 'join_x');

				$join_target = $table;
				if (strlen($data_other) > 0) {
					$join_target = $data_other;
				}

				$data_join_col = "id".$data_join;
				if (strlen($data_join_x) > 0) {
					$data_join_col = $data_join_x;
				}

				if (strlen($data_type) > 0) {
					$this->ci->db->join($data_join, $data_join.".".$data_join_col." = ".$join_target.".".$data_join_col, $data_type);
				}
				else {
					$this->ci->db->join($data_join, $data_join.".".$data_join_col." = ".$join_target.".".$data_join_col);
				}
			}
		}


		if (count($join_manual) > 0) {
			foreach ($join_manual as $key => $value) {
				$jm_join = azarr($value, 'join');
				$jm_on = azarr($value, 'on');
				$jm_type = azarr($value, 'type');
				$this->ci->db->join($jm_join, $jm_on, $jm_type);
			}
		}

		if($cfilter != ''){
			foreach($cfilter as $pcf_k => $pcf_v){
				$pcf_k = $this->ci->encrypt->decode($pcf_k);
				if(strlen($pcf_v) > 0){
					$this->ci->db->like($pcf_k, $pcf_v);
				}
			}
		}	

		if (count($top_filter) > 0) {
			foreach ($top_filter as $key => $value) {
				$key = $this->ci->encrypt->decode($key);
				$check = explode("~az~", $value);
				$check_tpwh = explode("~aztpwh~", $value);
				if (count($check) > 1) {
					$top_filter1 = azarr($check, "0");
					$top_filter2 = azarr($check, "1");
					$check_date = explode("-", $top_filter1);
					if (count($check_date) > 1) {
						$top_filter1 = Date("Y-m-d H:i:s", strtotime($top_filter1." 00:00:00"));
						$top_filter2 = Date("Y-m-d H:i:s", strtotime($top_filter2." 23:59:59"));
					}
					$this->ci->db->where("(".$key." BETWEEN '".$top_filter1."' AND '".$top_filter2."')");
				}
				else if (count($check_tpwh) > 1) {
					$tpwh_val = azarr($check_tpwh, "1");
					if (strlen($tpwh_val) > 0) {
						$this->ci->db->where($key, $tpwh_val);
					}
				}
				else {
					if (strlen($value) > 0) {
						$is_id = '.id';
						if (strpos($key, $is_id) !== false) {
							$this->ci->db->where($key, $value);
						} else {
							$this->ci->db->like($key, $value);
						}
					}
				}
			}
		}

		foreach($order_by as $po_k => $po_v){
			$this->ci->db->order_by($po_v);
		}

		if(strlen($this->group_by) > 0){
			$this->ci->db->group_by($this->group_by);
		}  

		if(strlen($select_union) > 0) {
			$limit = '';
			if (strlen($iDisplayLength) > 0) {
				$limit = 'LIMIT '.$iDisplayLength;

				$offset = '';
				if (strlen($iDisplayStart) > 0) {
					$offset = 'OFFSET '.$iDisplayStart;
				}
			}
			
			$query_union = $this->ci->db->query($last_query_union.' '.$data_order_by.' '.$limit.' '.$offset);
			$ambil = $query_union;

			$idtable = $select_id;
		}

		if(strlen($this->manual_query) > 0) {
			$this->ci->db->reset_query();
			// echo $this->manual_query;die;

			// manual order by
			$manual_po = '';
			if(count($order_by) > 0) {
				$m_po = '';
				foreach($order_by as $po_k => $po_v){
					if($po_k == 0) {
						$m_po .= $po_v;
					} else {
						$m_po .= ', '.$po_v;
					}
				}

				$manual_po = ' ORDER BY '.$m_po;
			}

			// manual group by
			$manual_group = '';
			if(strlen($this->group_by) > 0){
				$manual_group = ' GROUP BY '.$this->group_by;
			}

			// manual filter
			$manual_filter = '';
			if(strlen($data_filter) > 0) {
				$manual_filter = ' WHERE '.$data_filter;
			}

			$manual_query = $this->manual_query.$manual_filter.$manual_group.$manual_po.' LIMIT '.$iDisplayStart.', '.$iDisplayLength;
			// echo $manual_query;die;
			$ambil = $this->ci->db->query($manual_query);

			if(strlen($data_filter) > 0) {
				$iTotalDisplayRecords = $ambil->num_rows();
			}
		}

		if(strlen($select_union) == 0 && strlen($this->manual_query) == 0) {
			$ambil = $this->ci->db->get($table);
		}

		$idtable = 'id'.$table;
		if (strlen($this->idtable) > 0) {
			$idtable = $this->idtable;
		}


		$current_last_query = $this->ci->db->last_query();
		$current_last_query = str_replace(" LIMIT ".$iDisplayStart.', '.$iDisplayLength,'',$current_last_query);
		$current_last_query = str_replace(" LIMIT ".$iDisplayLength,'',$current_last_query);
		$this->last_query = $current_last_query;

// echo"<pre>";print_r($this->ci->db->last_query());die;
		$arr_column_show = array();
		foreach($column_show as $ps_value){
			$xvalue = explode(".", $ps_value);
			if(count($xvalue) > 1){
				$ps_value = $xvalue[1];
			}
			if($ps_value != $idtable){
				$arr_column_show[] = $ps_value;
			}
		}
		$i = 0;
		foreach ($ambil->result_array() as $value) {
			$i++;
			$no = $iDisplayStart + $i;

			$arr_get = array("no" => $no);
			if ($this->custom_first_column) {
				$arr_get = array();
			}
			foreach ($arr_column_show as $acs_value) {
				// $arr_get[$acs_value] = $value[$acs_value];
				$arr_get[$acs_value] = azarr($value, $acs_value);
			}

			$btn_ = "";
			if ($this->edit) {
				$btn_ .= '<button class="btn btn-default btn-xs btn-edit-'.$this->id.'" data_id= "'.$value[$idtable].'"><span class="glyphicon glyphicon-pencil"></span> '.azlang('Edit').'</button>';
			}
			if ($this->delete) {
				$btn_ .= '<button class="btn btn-danger btn-xs btn-delete-'.$this->id.'" data_id= "'.$value[$idtable].'"><span class="glyphicon glyphicon-remove"></span> '.azlang('Delete').'</button>';
			}

			if (strlen($this->custom_btn) > 0) {
				$custom_button = $this->custom_btn;
				$btn_ .= $this->ci->$custom_button($value);
			}

			$arr_get["action"] = $btn_;
			$arr_get_ok = array();
			$numb = -1;
			foreach ($arr_get as $acs_key => $acs_value) {
				$get_ok = $acs_value;

				// if ($acs_key != "action") {
				// 	$get_ok = htmlspecialchars($get_ok);	
				// }

				//ALIGN
				$palign = "";
				if ($acs_key == "no" || $acs_key == "action") {
					$palign = " class='txt-center'";
				}
				if (count($select_align) > 0) {
					$palign_x = azarr($select_align, $numb);
					if (strlen($palign_x) > 0) {
						$palign = " class='txt-".$palign_x."'";
					}
				}

				//NUMBER SEPARATOR THOUSAND
				if (count($select_number) > 0) {
					if (in_array($numb, $select_number)) {
						if (is_numeric($acs_value)) {
							$get_ok = number_format($acs_value, 0, '', '.');
						}
					}
				}

				//NUMBER SEPARATOR THOUSAND
				if (count($select_decimal) > 0) {
					if (in_array($numb, $select_decimal)) {
						if (is_numeric($acs_value)) {
							$get_ok = number_format($acs_value, 2, ',', '.');
						}
					}
				}

				//FORMAT DATE
				if (count($select_date) > 0) {
					if (in_array($numb, $select_date)) {
						$get_ok = Date('d-m-Y', strtotime($acs_value));
					}
				}

				//CUSTOM STYLE
				if (strlen($this->custom_style) > 0) {
					$style_column = $this->custom_style;
					$get_ok = $this->ci->$style_column($acs_key, $get_ok, $value);
				}

				$arr_get_ok[] = "<div".$palign.">".$get_ok."</div>";
				$numb++;
			}

			$records["aaData"][] = $arr_get_ok;
		}
		$records["sEcho"] = $sEcho;
		$records["iTotalRecords"] = $iTotalRecords;
		$records["iTotalDisplayRecords"] = $iTotalDisplayRecords;
		if($this->additional_response != null){
			$records["additional_response"] = $this->additional_response;
		}

		return json_encode($records);
	}

	public function generate_modal() {
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
				                <h4 class="modal-title"><span>'.azlang('Add').'</span>&nbsp;'.$this->modal_title.'</h4>

				            </div>
				            <div class="modal-body">';
		$modal .= $this->modal;
		$modal .= '    		</div>
				            <div class="modal-footer">
				                <div class="pull-right">';

        if ($this->btn_left_modal) {
        	foreach ($this->btn_left_modal as $key => $value) {
				$modal .='	      <button class="btn btn-primary az-btn-primary btn-'.$key.'" type="button">'.$value.'</button>';
        	}
        }

        if ($this->btn_save_modal) {
			$modal .='	          <button class="btn btn-primary az-btn-primary btn-save-'.$this->id.'" type="button">'.azlang('Save').'</button>';
        }

        if ($this->btn_right_modal) {
        	foreach ($this->btn_right_modal as $key => $value) {
				$modal .='	      <button class="btn btn-primary az-btn-primary btn-'.$key.'" type="button">'.$value.'</button>';
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