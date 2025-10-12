<form class="form-horizontal" id="form_language" method="POST" action="<?php echo app_url();?>azlang/save">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label col-md-2"><?php echo azlang('Choose Language');?></label>
				<div class="col-md-3">
					<select class="form-control select" id="idlanguage" name="idlanguage" placeholder="<?php echo azlang('Choose Language');?>">
						<?php 
							foreach ($list_lang as $key => $value) {
								$sel = '';
								if ($sel_language == $value) {
									$sel = ' selected ';
								}
								echo "<option ".$sel." value='".$value."'>".azlang(ucfirst($value))."</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 txt-center">
			<h4><?php echo azlang('Default Language');?></h4>
		</div>
		<div class="col-sm-6 txt-center">
			<h4><?php echo azlang(ucfirst($sel_language));?></h4>
		</div>
	</div>

	<div class="container-lang">
	<?php
		foreach ($data as $key => $value) {
	?>
		<div class="row field-azlang">
			<div class="col-sm-6">
				<input type="text" class="form-control" name="key[]" value="<?php echo $key;?>"/>
			</div>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="value[]" value="<?php echo $value;?>"/>
			</div>
		</div>
	<?php
		}
	?>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<button class="btn btn-primary" id="btn_add_lang" type="button"><?php echo azlang('Add');?></button>
			<button class="btn btn-primary" id="btn_save_lang" type="button"><?php echo azlang('Save');?></button>
		</div>
	</div>
</form>