<div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">شناسه</th>
				<th scope="col">نام فایل</th>
				<th scope="col">نوع فایل</th>
				<th scope="col">پسوند</th>
				<th scope="col">حجم</th>
				<th scope="col">لینک</th>
				<th scope="col">قیمت</th>
				<th scope="col">تعداد دانلود</th>
				<th scope="col">وضعیت تائید</th>
				<th scope="col">وضعیت فایل</th>
			</tr>
		</thead>
		<tbody>

			<?php for ($i = 0; $i < $file_count; $i++) { ?>
				<tr>
					<form action="/admin/files" method="post">
						<input type="hidden" name="id" value="<?php echo $file[$i]['id']; ?>">
						<th scope="row">
							<?php echo $file[$i]['id']; ?>
						</th>
						<td>
							<p style="direction: ltr; width: 180px;">
								<?php echo $file[$i]['name']; ?>
							</p>
						</td>
						<td>
							<?php echo $file[$i]['type']; ?>
						</td>
						<td>
							<?php echo $file[$i]['extension']; ?>
						</td>
						<td>
							<?php echo $file[$i]['size']; ?>
						</td>
						<td>
							<p style="direction: ltr; width: 180px;">
								<a target="_blank" href="<?php echo $file[$i]['url']; ?>">
									<?php echo $file[$i]['url']; ?>
								</a>
							</p>
						</td>
						<td>
							<?php echo $file[$i]['price']; ?>
						</td>
						<td>
							<?php echo $file[$i]['downloads']; ?>
						</td>
						<td>
							<?php echo ($file[$i]['is_verified']) ? 'تائید شده' : 'تائید نشده'; ?>
						</td>

						<td>
							<?php echo ($file[$i]['is_private']) ? 'خصوصی' : 'عمومی'; ?>
						</td>
					</form>
				</tr>
			<?php } ?>

		</tbody>
	</table>
</div>