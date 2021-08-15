<div id="user-profile-2" class="user-profile">
	<div class="tabbable">


		<div class="tab-content no-border padding-24">
			<div id="home" class="tab-pane in active">
				<div class="row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt=" Avatar" id="avatar2" src="http://bootdey.com/img/Content/avatar/avatar6.png">
						</span>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle"><?php echo strtoupper($user['name']); ?></span>

							<span class="label label-purple arrowed-in-right">
								<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
								Profile
							</span>
						</h4>

						<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name"> شناسه </div>

								<div class="profile-info-value">
									<span><?php echo $user['id']; ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> نام </div>

								<div class="profile-info-value">
									<i class="fa fa-map-marker light-orange bigger-110"></i>
									<span><?php echo $user['name']; ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> نام کاربری </div>

								<div class="profile-info-value">
									<span><?php echo $user['username']; ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> ایمیل </div>

								<div class="profile-info-value">
									<span><?php echo $user['email']; ?></span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> نوع کاربر </div>

								<div class="profile-info-value">
									<span>
										<?php
										switch ($user['type']) {
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
									</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> اعتبار </div>

								<div class="profile-info-value">
									<span><?php echo $user['credit']; ?></span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> وضعیت </div>

								<div class="profile-info-value">
									<span> <?php echo ($user	['is_active']) ? 'فعال' : 'غیرفعال'; ?></span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> تعداد فایل‌های آپلود شده </div>

								<div class="profile-info-value">
									<span><?php echo $user['num_files']; ?></span>
								</div>
							</div>
						</div>

						<div class="hr hr-8 dotted"></div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /#home -->
	</div>
</div>
</div>