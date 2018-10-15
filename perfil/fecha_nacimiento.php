<!-- DIA -->
<select name='dia' id='dia'>
	<option value="<?php echo $fecha['2']; ?>"><?php echo $fecha['2']; ?></option>
	<?php
		for($i=1; $i <=31; $i++){
	?>
		<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
	<?php
	}
	?>
</select>

<!-- MES -->
<select name='mes' id='mes'>
	<option value="<?php echo $fecha['1']; ?>"><?php echo $fecha['1']; ?></option>
	<option value='1'>Enero</option>
	<option value='2'>Febrero</option>
	<option value='3'>Marzo</option>
	<option value='4'>Abril</option>
	<option value='5'>Mayo</option>
	<option value='6'>Junio</option>
	<option value='7'>Julio</option>
	<option value='8'>Agosto</option>
	<option value='9'>Septiembre</option>
	<option value='10'>Octubre</option>
	<option value='11'>Noviembre</option>
	<option value='12'>Diciembre</option>
</select>

<!-- AÑO -->
<select name='anio' id='anio'>
	<option value="<?php echo $fecha['0']; ?>"><?php echo $fecha['0']; ?></option>
	<?php
		for($i=2013; $i>=1900; $i--){
	?>
	<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
	<?php } ?>
</select>