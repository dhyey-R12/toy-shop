<?php /* Template Name: Custom */ ?>
<!DOCTYPE HTML>
<!--
  Hielo by TEMPLATED
  templated.co @templatedco
  Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
  <title>Hielo by TEMPLATED</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href=" <?php echo get_template_directory_uri() ?>/assets/css/main.css" />
  <!-- <link rel="stylesheet" href=" <?php //echo get_template_directory_uri() ?>/assets/css/font-awesome.min.css" /> -->
</head>
<body>

  <!-- Header -->
  <header id="header" class="alt">
    <div class="logo"><a href="index.html">Hielo <span>by TEMPLATED</span></a></div>
    <a href="#menu">Menu</a>
  </header>

  <!-- Nav -->
  <nav id="menu">
    <ul class="links">
      <li><a href="index.html">Home</a></li>
      <li><a href="generic.html">Generic</a></li>
      <li><a href="elements.html">Elements</a></li>
    </ul>
  </nav>

  <!-- Banner -->
  <section class="banner full">
    <article>
      <img src="<?php echo get_template_directory_uri() ?>/assets/img/slide01.jpg" alt="" />
      <div class="inner">
        <header>
          <p>A free responsive web site template by <a href="https://templated.co">TEMPLATED</a></p>
          <h2><?php the_field('banner');?></h2>
        </header>
      </div>
    </article>
  </section>

  <!-- One -->
  <section id="one" class="wrapper style2">
    <div class="inner">
      <div class="grid-style">
        <?php 
        if(have_rows('image')):

          while(have_rows('image')): the_row();
            ?>
            <div>
              <div class="box">
                <div class="image fit">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/" alt="" />
                  <img src="<?php the_sub_field('image');?>" alt="" />

                </div>
                <div class="content">
                  <header class="align-center">
                    <p><?php the_sub_field('text')?></p>
                    <h2><?php the_sub_field('header')?></h2>
                  </header>
                  <p> <?php echo the_sub_field('paragraph') ?></p>
                  <footer class="align-center">
                    <a href="#" class="button alt">Learn More</a>
                  </footer>
                </div>
              </div>
            </div>
            <?php 
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
  <!-- Two -->
  <section id="two" class="wrapper style3">
    <div class="inner">
      <header class="align-center">
        <p>Nam vel ante sit amet libero scelerisque facilisis eleifend vitae urna</p>
        <h2>Morbi maximus justo</h2>
      </header>
    </div>
  </section>

  <!-- Three -->
  <section id="three" class="wrapper style2">
    <div class="inner">
      <header class="align-center">
        <p class="special">Nam vel ante sit amet libero scelerisque facilisis eleifend vitae urna</p>
        <h2>Morbi maximus justo</h2>
      </header>
      <div class="gallery">
        <?php 
        if(have_rows('photo')):

          while(have_rows('photo')): the_row();
            ?>
            <div>
              <div class="image fit">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/" alt="" />
                <img src="<?php the_sub_field('photos');?>" alt="" /></a>
              </div>
            </div>
            <?php 
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <ul class="icons">
        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
      </ul>
    </div>
    <div class="copyright">
      &copy; Untitled. All rights reserved.
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    theme_directory = "<?php echo get_template_directory_uri() ?>";
  </script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.scrollex.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/skel.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/util.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>

</body>
</html>






















































<!-- <div>
          <div class="box">
            <div class="image fit">
              <img src="<?php //echo get_template_directory_uri() ?>/assets/img/pic02.jpg" alt="" />
            </div>
            <div class="content">
              <header class="align-center">
                <p>maecenas sapien feugiat ex purus</p>
                <h2>Lorem ipsum dolor</h2>
              </header>
              <p> Cras aliquet urna ut sapien tincidunt, quis malesuada elit facilisis. Vestibulum sit amet tortor velit. Nam elementum nibh a libero pharetra elementum. Maecenas feugiat ex purus, quis volutpat lacus placerat malesuada.</p>
              <footer class="align-center">
                <a href="#" class="button alt">Learn More</a>
              </footer>
            </div>
          </div>
        </div>

        <div>
          <div class="box">
            <div class="image fit">
              <img src="<?php //echo get_template_directory_uri() ?>/assets/img/pic03.jpg" alt="" />
            </div>
            <div class="content">
              <header class="align-center">
                <p>mattis elementum sapien pretium tellus</p>
                <h2>Vestibulum sit amet</h2>
              </header>
              <p> Cras aliquet urna ut sapien tincidunt, quis malesuada elit facilisis. Vestibulum sit amet tortor velit. Nam elementum nibh a libero pharetra elementum. Maecenas feugiat ex purus, quis volutpat lacus placerat malesuada.</p>
              <footer class="align-center">
                <a href="#" class="button alt">Learn More</a>
              </footer>
            </div>
          </div>
        </div> -->


        <!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Custom</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="mx-auto w-50">
  <h2 class="text-center"><?php //the_field('special'); ?></h2>
  <form action="/action_page.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
   <div class=""><?php //the_field('text_field'); ?></div> 
  <div class=""><?php //the_field('special'); ?></div>
</div>

</body>
</html> -->

<!-- <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="/action_page.php" method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html> -->