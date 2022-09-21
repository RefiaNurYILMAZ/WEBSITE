<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS - İçerik Yönetim Sistemi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{$ThemeURL}/css/login.css">

</head>



<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page  pace-done" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper"><!--Login Page Starts-->
<section id="login" class="auth-height">
  <div class="row full-height-vh m-0">
    <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="card overflow-hidden">
        <div class="card-content">
          <div class="card-body auth-img">

          <form action="{$BaseAdminURL}/?cmd={$modulName}/kontrol.html" method="post" class="form-element" id="loginCheck">
            <div class="row m-0">
              <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                <img src="{$ThemeURL}/images/login.png" alt="" class="img-fluid" width="300" height="230">
              </div>
              <div class="col-lg-6 col-12 px-4 py-3">
                <h4 class="mb-2 card-title">Giriş Yap</h4>
         
                <input type="text" class="form-control mb-3" name="user" placeholder="Kullanıcı Adı">
                <input type="password" name="pass" class="form-control mb-2" placeholder="Şifre">
                <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                  <div class="remember-me mb-2 mb-sm-0">
                    <div class="checkbox auth-checkbox">
                      <input type="checkbox" id="auth-ligin"  name="hatirla" value="1">
                      <label for="auth-ligin"><span>Beni Hatırla</span></label>
                    </div>
                  </div>
                </div>
                <p class="login-box-msg" style="min-height=24px;"> </p>
                <div class="d-flex justify-content-between flex-sm-row flex-column">
                  <button type="submit" class="btn btn-primary">Giriş</butt>
                </div>
                <hr>
               
              </div>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
<script src="{$ThemeURL}/assets/vendor_components/jquery/dist/jquery.min.js"></script>

<script src="{$ThemeURL}/assets/vendor_components/popper/dist/popper.min.js"></script>

<script src="{$ThemeURL}/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $(window).ready(function(e){

            $("#loginCheck").submit(function(e){
                $.ajax({
                    url :  $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success:function(g)
                    {
                        if(g==1) window.location.href = '{$BaseAdminURL}/';
                        else {
                            $('.login-box-msg').fadeIn(100).css('color','#c20000').html('Kullanıcı Adı veya Şifre Hatalı');
                            setTimeout(function(){
                                $('.login-box-msg').fadeOut(2000)
                            }, 4000);
                        }
                    }
                });
                return false;
            });

        });

    });
</script>
</html>


