<div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">شناسه</th>
        <th scope="col">نام‌کاربری</th>
        <th scope="col">نام فایل</th>
        <th scope="col">نوع فایل</th>
        <th scope="col">پسوند</th>
        <th scope="col">حجم</th>
        <th scope="col">لینک</th>
        <th scope="col">قیمت</th>
        <th scope="col">تعداد دانلود</th>
        <th scope="col">وضعیت تائید</th>
        <th scope="col">وضعیت فایل</th>
        <th scope="col">عملیات</th>
      </tr>
    </thead>
    <tbody>

      <?php for ($i = 0; $i < $file_count; $i++) { ?>
        <tr>
          <form action="/admin/files" method="post">
            <input type="hidden" name="id" value="<?php echo $files[$i]['id']; ?>">
            <th scope="row">
              <?php echo $files[$i]['id']; ?>
            </th>
            <td>
              <?php echo ($files[$i]['username'] ?? 'مهمان'); ?>
            </td>
            <td>
              <p style="direction: ltr; width: 180px;">
                <?php echo $files[$i]['name']; ?>
              </p>
            </td>
            <td>
              <?php echo $files[$i]['type']; ?>
            </td>
            <td>
              <?php echo $files[$i]['extension']; ?>
            </td>
            <td>
              <?php echo $files[$i]['size']; ?>
            </td>
            <td>
              <p style="direction: ltr; width: 180px;">
                <a target="_blank" href="<?php echo $files[$i]['url']; ?>">
                  <?php echo $files[$i]['url']; ?>
                </a>
              </p>
            </td>
            <td>
              <?php echo $files[$i]['price']; ?>
            </td>
            <td>
              <?php echo $files[$i]['downloads']; ?>
            </td>
            <td>
              <?php echo ($files[$i]['is_verified']) ? 'تائید شده' : 'تائید نشده'; ?>
            </td>

            <td>
              <?php echo ($files[$i]['is_private']) ? 'خصوصی' : 'عمومی'; ?>
            </td>

            <td>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $files[$i]['id']; ?>">
                <input type="hidden" name="_method" value="put">
                <?php if ($files[$i]['is_verified'] == 1) : ?>
                  <button type="submit" class="btn btn-danger" name="is_verified" value="0">عدم تائید</button>
                <?php else : ?>
                  <button type="submit" class="btn btn-success" name="is_verified" value="1">تائید</button>
                <?php endif; ?>
              </form>

              <form style="display: inline-block;" action="/admin/files" method="post">
                <input type="hidden" name="id" value="<?php echo $files[$i]['id']; ?>">

                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="btn btn-danger">حذف</button>
              </form>
            </td>
          </form>
        </tr>
      <?php } ?>

    </tbody>
  </table>
</div>