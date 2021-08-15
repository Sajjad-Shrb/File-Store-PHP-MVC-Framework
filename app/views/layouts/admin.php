<html lang="fa" dir="rtl">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-XfhC/Sid4FIGSXYebcOtcSCRFkd/zZzAMVipf0bNWucloRvcKK2/dpVWodQbQ1Ek" crossorigin="anonymous">

	<link rel="stylesheet" href="/css/admin.css">
</head>

<body>
	<div class="area">
		{{content}}
	</div>
	<nav class="main-menu">
		<ul>
			<li>
				<a href="../admin">
					<i class="fa fa-home fa-2x"></i>
					<span class="nav-text">
						داشبورد
					</span>
				</a>

			</li>
			<li class="has-subnav">
				<a href="../admin/setting">
					<i class="fa fa-upload fa-2x"></i>
					<span class="nav-text">
						تنظیمات آپلود
					</span>
				</a>

			</li>
			<li class="has-subnav">
				<a href="../admin/users">
					<i class="fa fa-user fa-2x"></i>
					<span class="nav-text">
						مدیریت کاربران
					</span>
				</a>

			</li>
			<li class="has-subnav">
				<a href="../admin/files">
					<i class="fa fa-folder-open fa-2x"></i>
					<span class="nav-text">
						مدیریت فایل‌ها
					</span>
				</a>

			</li>
			<li>
				<a href="../admin/trades">
					<i class="fa fa-dollar fa-2x"></i>
					<span class="nav-text">
						مدیریت معاملات
					</span>
				</a>
			</li>
		</ul>

		<ul class="logout">
			<li>
				<a href="../logout">
					<i class="fa fa-power-off fa-2x"></i>
					<span class="nav-text">
						خروج
					</span>
				</a>
			</li>
		</ul>
	</nav>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


</html>