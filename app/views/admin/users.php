<div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">شناسه</th>
				<th scope="col">نام</th>
				<th scope="col">نام‌کاربری</th>
				<th scope="col">ایمیل</th>
				<th scope="col">نقش</th>
				<th scope="col">اعتبار</th>
				<th scope="col">وضعیت</th>
				<th scope="col">تعداد فایل‌ها</th>
				<th scope="col">فعال/غیرفعال سازی</th>
				<th scope="col">تغییر نقش</th>
			</tr>
		</thead>
		<tbody>

			<?php for ($i = 0; $i < $user_count; $i++) { ?>
				<tr>
					<form action="/admin/users" method="post">
						<input type="hidden" name="id" value="<?php echo $users[$i]['id']; ?>" />
						<th scope="row">
							<input type="hidden" name="id" value="<?php echo $users[$i]['id']; ?>">
							<?php echo $users[$i]['id']; ?>
						</th>
						<td>
							<?php echo $users[$i]['name']; ?>
						</td>
						<td>
							<?php echo $users[$i]['username']; ?>
						</td>
						<td>
							<?php echo $users[$i]['email']; ?>
						</td>
						<td>
							<?php
							switch ($users[$i]['type']) {
								case 1:
									echo 'ادمین';
									break;
								case 2:
									echo 'تائید کننده';
									break;
								case 3:
									echo 'کاربر';
									break;
								default:
									echo 'مهمان';
									break;
							}
							?>
						</td>
						<td>
							<?php echo $users[$i]['credit']; ?>
						</td>
						<td>
							<?php echo ($users[$i]['is_active']) ? 'فعال' : 'غیرفعال'; ?>
						</td>
						<td>
							<?php echo $users[$i]['num_files']; ?>
						</td>
						<td>
							<?php if ($users[$i]['is_active'] == 1) : ?>
								<button type="submit" class="btn btn-danger" name="is_active" value="0">غیرفعال‌سازی</button>
							<?php else : ?>
								<button type="submit" class="btn btn-success" name="is_active" value="1">فعال‌سازی</button>
							<?php endif; ?>
						</td>
						<td>
							<select name="type">
								<option selected disabled value="rule-change">تغییر نقش</option>
								<option value="1">ادمین</option>
								<option value="2">تائید کننده</option>
								<option value="3">کاربر</option>
							</select>
							<br>
							<p style="margin-top: 8px !important;">
								<input type="submit" value="اعمال" style="background: none; border: none; color: blue;text-decoration: none; cursor: pointer;">
							</p>
						</td>
					</form>
				</tr>
			<?php } ?>

		</tbody>
	</table>
</div>