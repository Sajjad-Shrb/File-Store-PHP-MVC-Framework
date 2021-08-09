<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>

  <?php 
    use app\core\Application;

    $id = Application::$app->session->get('id');
    $username = Application::$app->session->get('username');
    $name = Application::$app->session->get('name');
    $email = Application::$app->session->get('email');

    if ($id)
      echo "You are logged in. your mail is: $email | <a href=\"/user/logout\">Logout</a>";
    else
      echo "You are Guest! | <a href=\"/user/login\">Login</a> or <a href=\"/user/register\">Register</a>" ;
  ?>

  
  {{content}}

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>