<?php
  if (!empty($_POST)) {
    // validate
    $errors = [];

    //// If fields empty or other errors

    // username errors
    // username should be not empty, should include only letters (no spaces)
    if (empty($_POST['username'])) {
      $errors['username'] = "A username is required!";
    } else if (!preg_match("/^[a-zA-Z]+$/", $_POST['username'])){
        $errors['username'] = "Username can only have letters and no spaces";
    }

    // email errors
    // email field should not be empty, should be unique, and be valid
    $query = "select id from users where email = :email limit 1";
    $email = db_query($query, ['email'=>$_POST['email']]);
    if (empty($_POST['email'])) {
      $errors['email'] = "An email is required!";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email is NOT valid";
    } else if ($email) {
      $errors['email'] = "That email is already in use";
    }

    // password errors
    // password should not be empty, must be bigger than 8 chars must be retyped correctly
     if(empty($_POST['password'])) {
      $errors['password'] = "A password is required";
    } else if(strlen($_POST['password']) < 8) {
      $errors['password'] = "Password must be 8 character or more";
    }

    // retype password errors
    // retype password field should not be empty, and must much password
    if(empty($_POST['retype_password'])) {
      $errors['retype_password'] = "Please confirm password!";
    }
    else if($_POST['password'] !== $_POST['retype_password']) {
      $errors['password'] = "Passwords do not match";
    }

    // accept terms errors
    // input should not be empty

  if(empty($_POST['terms']))
    {
      $errors['terms'] = "Please accept the terms";
    }


    if (empty($errors)) {
      // save to db
      $data = [];
      $data['username'] = $_POST['username'];
      $data['email'] = $_POST['email'];
      $data['password'] =  password_hash($_POST['password'], PASSWORD_DEFAULT);
      // $data['retype_password'] = password_hash($_POST['retype_password'], PASSWORD_DEFAULT);
      $data['role'] = 'user'; // Everyone starts out as a user -- hence the hardcode

      $query = "Insert into users (username,email,password,role) values (:username,:email,:password,:role)";
      db_query($query, $data);

      redirect('login');
    }
  }
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Register | <?=APP_NAME?></title>
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
       <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/sign-in.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/main.css" rel="stylesheet">
    <!-- <script src="<?=ROOT?>/assets/js/togglePassword.js" defer></script> -->
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      .logo-img {
        object-fit: contain;
        border: 2px solid #461395;
        background-color: #FBF3F3;
        box-shadow: 3px 3px 2px 2px rgba(0, 0, 255, .1);
      }

      .form-signin {
        max-width: 330px;
        padding: 1rem;
      }

    .form-signin .form-floating:focus-within {
        z-index: 2;
      }

    .form-signin input[type="email"] {
      margin-bottom: 7px;
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
    }

    .form-signin input[type="text"] {
      margin-bottom: 7px;
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
    }

    .form-signin input[type="password"] {
        margin-bottom: 0px;

      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .form-controller {
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid #dee2e6;
      background-color: #fff;
      margin-bottom: 7px;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
      padding: .75rem .75rem;
    }

    .form-controller img {
      width: 30px;
      height: 30px;
      margin-right: 5px;
      cursor: pointer;

    }


  .form-floating.form-controller > .form-control, .form-floating > .form-control-plaintext, .form-floating > .form-select {
  height: calc(1.5rem + calc(var(--bs-border-width) * 2));
  min-height: calc(1.5rem + calc(var(--bs-border-width) * 2));
  line-height: 1.25;
  outline: none;
  border: none;
}



</style>

</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>


<main class="form-signin w-100 m-auto" id=formSignin>
  <form method="post">
    <a href="home">
      <img class="mb-4 rounded-circle logo-img mx-auto d-block" src="<?=ROOT?>/assets/images/logo.png" alt="" width="100" height="100">
    </a>
    <h1 class="h3 mb-3 fw-normal">Please Join Us</h1>
    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix the errors below</div>
    <?php endif;?>
  <!-- Username -->
    <div class="form-floating">
      <input value="<?= retrieve_info('username') ?>" name="username" type="text" class="form-control" id="floatingInput js--floatingInput" placeholder="Username">
      <label class="sr-only" for="floatingInput">User name</label>
    </div>
    <?php if(!empty($errors['username'])):?>
      <div class="text-danger"><?=$errors['username']?></div>
    <?php endif;?>
  <!-- Email -->
    <div class="form-floating my-1">
      <input value="<?= retrieve_info('email') ?>" name="email" type="email" class="form-control" id="floatingInput js--floatingInput" placeholder="name@example.com">
      <label  for="floatingInput">Email address</label>
    </div>
    <?php if(!empty($errors['email'])):?>
      <div class="text-danger"><?=$errors['email']?></div>
    <?php endif;?>

  <!-- Password -->
    <div class="form-floating form-controller my-1">

        <input value="<?= retrieve_info('password') ?>" name="password" type="password" class="form-control" id="floatingPassword js--floatingPassword" placeholder="Password">
        <img src="<?=ROOT?>/assets/images/icons/eye-slash.png"
                     style="vertical-align: baseline"
                     id="js--togglePassword" alt="eye-slash icon"
                     >


      <label  for="floatingPassword">Password</label>
    </div>
    <?php if(!empty($errors['password'])):?>
      <div class="text-danger"><?=$errors['password']?></div>
    <?php endif;?>

  <!-- Password Retype -->
    <div class="form-floating my-1">
      <input value="<?= retrieve_info('retype_password') ?>" name="retype-password" type="password" class="form-control" id="floatingPasswordRetype js--floatingPasswordRetype" placeholder="Retype Password">
      <label for="floatingPasswordRetype">Retype Password</label>
    </div>
    <?php if(!empty($errors['retype_password'])):?>
      <div class="text-danger"><?=$errors['retype_password']?></div>
    <?php endif;?>


    <small class="my-2">Already have an account? <a href="login">Login here</a></small>
  <!-- Terms -->
     <div class="form-check text-start my-2">
      <input <?=retrieve_checked('terms')?> name="terms" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Accept Terms
      </label>
      <?php if(!empty($errors['terms'])):?>
        <div class="text-danger"><?=$errors['terms']?></div>
      <?php endif;?>
    </div>
    <button class="btn btn-custom w-100 py-2" type="submit">Register</button>
    <p class="mt-5 mb-3 text-body-secondary">Copyright&copy;<?php echo date('Y');?></p>
  </form>
</main>
<script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
