<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Oops</title>
    <style>
    body{
      height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      text-align:center;
      font-size:2em;
    }
    a{ text-decoration:none}
    p{margin:2em;}
    </style>
  </head>
  <body>
    <div>
      <h1>Oups :(</h1>
      <?php if(isset($message)) echo '<p>'.$message.'</p>';?>
      <a href="javascript:history.go(-1)">&laquo; retour</a>
    </div>
  </body>
</html>
