<!DOCTYPE html>
<html lang="en" data-theme="light" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content="LaReponse" name="author">
  <link rel="stylesheet" href="/public/assets/dashly/css/theme.bundle.css" id="stylesheetLTR">
  <link rel="icon" href="/public/assets/dashly/favicon/favicon.ico" sizes="any">
  <title>Connection</title>
</head>

<body class="d-flex align-items-center bg-light-green">

<main class="container">
  <div class="row align-items-center justify-content-center vh-100">
      <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 py-6">

          <h1 class="mb-2 text-center">Connection</h1>
          <p class="text-secondary text-center">Entrez votre adresse email et votre mot de passe</p>

          <form method="POST" action="<?php echo $controller->router()->hyp('identify');?>">
              <div class="row">
                  <div class="col-12">
                      <div class="mb-4">
                          <!-- Label -->
                          <label class="form-label">Email</label>
                          
                          <input type="text" name="username" class="form-control" value="krafto" placeholder="Votre adresse email">
                      </div>
                  </div>

                  <div class="col-12">
                      <!-- Password -->
                      <div class="mb-4">

                          <div class="row">
                              <div class="col">
                                  <label class="form-label">Mot de passe</label>
                              </div>

                              <!-- <div class="col-auto">
                                  <a href="./reset-password-illustration.html" class="form-text small text-muted link-primary">Forgot password</a>
                              </div> -->
                          </div> 

                          
                          <div class="input-group input-group-merge">
                              <input type="password" name="password" value="krafto" class="form-control" autocomplete="off" data-toggle-password-input placeholder="Votre mot de passe">
                              <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                          </div>
                      </div>
                  </div>
              </div> 

              <div class="row align-items-center text-center">
                  <div class="col-12">
                      <button type="submit" class="btn w-100 btn-primary mt-6 mb-2">Se connecter</button>
                  </div>

              </div> 
          </form>
      </div>
  </div> 
</main> <!-- / main -->

</body>
</html>
