<form class="form-horizontal az-form" id="form" name="form" method="POST">
	<input type="hidden" name="idwarehouse" id="idwarehouse">
	<div class="form-group">
		<label class="control-label col-md-4">Jenis <red>*</red></label>
		<div class="col-md-5">
			<select class="form-control" id="warehouse_type" name="warehouse_type">
				<option value="Gudang Besar">Gudang Besar</option>
				<option value="Gudang Kecil">Gudang Kecil</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Nama Gudang <red>*</red></label>
		<div class="col-md-5">
			<input type="text" class="form-control" id="warehouse_name" name="warehouse_name"/>
		</div>
	</div>
</form>