<?php 

	// echo "<pre>";
	// var_dump($rows);	
	// echo "</pre>";
?>


<style>
	body {
		margin-left: 70px;
	}
</style>

<div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">شناسه</th>
				<th scope="col">ویژگی</th>
				<th scope="col">مقدار</th>
			</tr>
		</thead>

		<tbody>
			<?php for ($i = 0; $i < $rows_count; $i++) { ?>
				<tr>
					<form action="/admin/setting" method="post">
						<input type="hidden" name="_method" value="put">
						<input type="hidden" name="key_name" value="<?php echo $rows[$i]['key_name']; ?>" />
						<th scope="row">
							<?php echo $i; ?>
						</th>
						<td>
							<?php echo $rows[$i]['name']; ?>
						</td>
						<td>
							<?php 
								switch ($rows[$i]['key_name']) {
									case 'life_time':
										$value = $rows[$i]['value'] . ' ثانیه';
										break;
									case 'max_size':
										$value = $rows[$i]['value'] . ' مگابایت';
										break;
									default:
										$value = $rows[$i]['value'];
										break;
								}
							?>
							<?php echo $value; ?>
							<br>
								
							<p style="margin-top: 8px !important;">
								<button type="button" value="ویرایش" style="background: none; border: none; color: blue;text-decoration: none; cursor: pointer;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $rows[$i]['key_name']; ?>">ویرایش</button>
							</p>


							<div class="modal fade" id="<?php echo $rows[$i]['key_name']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">توجه</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
												<div class="mb-3">
													<label for="recipient" class="col-form-label">لطفا مقدار را وارد کنید:</label>
													<input type="text" class="form-control" id="recipient" name="value" placeholder="<?php echo $rows[$i]['value']; ?>">
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
											<button type="submit" class="btn btn-primary">ارسال</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					</form>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>