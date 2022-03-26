<?php
use yii\helpers\VarDumper;

?>
<?php if($property->display_office_hours_widget && !empty($property->office_hours)):?>
	<div class="card-box">
		<div class="header">
			<h2 class="title">Office hours</h2>
		</div>
		<div class="body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Day</th>
						<th scope="col">From</th>
						<th scope="col">To</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($property->office_hours as $day => $hours):?>
					<?php if(!empty($hours['from']) || !empty($hours['to'])):?>
					<tr>
						<td><?=$day;?></td>
						<td><?=$hours['from'];?></td>
						<td><?=$hours['to'];?></td>
					</tr>
					<?php endif;?>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif;?>

