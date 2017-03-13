<?php 
if ($this->session->userdata('login') == true){
    redirect(base_url('takip'));
}
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="veri takip sistemleri www.veritakip.net adresi üzerinden müşterilerine veri takip hizmeti sunan %100 Türk veri takip markasıdır" />
        <meta name="keywords" content="veritakip,gebze veri takibi,veritakip sistemleri,veri takip cihazları,veri takip haberleri,uydu veri,takip sistemi,veri takip" />
        <title><?php echo $lang_login['website-title']; ?> | Takip Paneli</title>
		<!-- Favicon ico -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png'); ?>" type="image/x-icon" />
        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/login.panel.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/signin.css'); ?>" rel="stylesheet" />
        <!-- Google Fonts için gerekli Linkler -->
        <!-- link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css" / -->
        <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/font-awesome-animation.css'); ?>" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-66780261-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- #Google Analytics -->
        <style>
            body { 
                background: url(<?php echo base_url('assets/img/login/aplan_' .  rand(1, 8) . '.jpg'); ?>)  no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-default fa-box-shadow navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><strong class="fa-shadow"><?php echo $lang_login['navbar-brand']; ?></strong></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 15px; margin-right: 45px;">
                <ul class="nav navbar-nav navbar-right language-bar">
                    <a href="<?php echo base_url('pages/languageload?lang=tr'); ?>" alt="" <?php if($this->session->userdata('lang') == 'tr') { ?>class="active"<?php } ?> ><img src="<?php echo base_url('assets/img/flags/tr.png'); ?>" alt="tr" /></a>
                    <a href="<?php echo base_url('pages/languageload?lang=en'); ?>" alt="" <?php if($this->session->userdata('lang') == 'en') { ?>class="active"<?php } ?> ><img src="<?php echo base_url('assets/img/flags/gb.png'); ?>" alt="en" /></a>
                    <a href="<?php echo base_url('pages/languageload?lang=irn'); ?>" alt="" <?php if($this->session->userdata('lang') == 'irn') { ?>class="active"<?php } ?> ><img src="<?php echo base_url('assets/img/flags/irn.png'); ?>" alt="irn" /></a>
                    <!-- <a href="<?php echo base_url(); ?>?lang=es" ><img src="<?php echo base_url('assets/img/flags/es.png'); ?>"></a>
                    <a href="<?php echo base_url(); ?>?lang=de" ><img src="<?php echo base_url('assets/img/flags/de.png'); ?>"></a>
                    <a href="<?php echo base_url(); ?>?lang=fr" ><img src="<?php echo base_url('assets/img/flags/fr.png'); ?>"></a>
                    <a href="<?php echo base_url(); ?>?lang=ar" ><img src="<?php echo base_url('assets/img/flags/ar.png'); ?>"></a> -->
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav><!-- /.nav -->
    <div class="account-container">
        <div class="content clearfix">
            <form action="<?php echo base_url('pages/login'); ?>" method="post">
                <!-- <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    Kullanıcı Adı veya Şifreniz Yanlış
                </div>-->
                <h1><?php echo $lang_login['user-login']; ?></h1>		
                <div class="login-fields">
                    <p><?php echo $lang_login['user-login-small']; ?></p>
                    <div class="field">
                        <label for="username"><?php echo $lang_login['your-e-mail']; ?></label>
                        <input type="email" id="username" name="useremail" value="" placeholder="<?php echo $lang_login['your-e-mail']; ?>" class="username-field" />
                    </div> <!-- /field -->
                    <div class="field">
                        <label for="password"><?php echo $lang_login['your-password']; ?></label>
                        <input type="password" id="password" name="password" value="" placeholder="<?php echo $lang_login['your-password']; ?>" class="password-field"/>
                    </div> <!-- /password -->
                </div> <!-- /login-fields -->
                <div class="login-actionsx">
                    <i class="fa fa-key fa-green fa-4x"></i>
                </div> <!-- .actions -->
                <div class="login-actions">
                    <button class="button btn btn-success btn-large"><?php echo $lang_login['login']; ?></button>
                </div> <!-- .actions -->
            </form>
        </div> <!-- /content -->
    </div> <!-- /account-container -->
    <h2></h2>
    <h3></h3>
    <h5></h5>
    <h6></h6>
    <b></b>
    <em></em>
    <strong></strong>
    <small></small>
<!-- /################### zemin kat ##################################################### -->    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/js/loginjs/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/loginjs/signin.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/loginjs/prefixfree.min.js'); ?>"></script>
        <!-- mapbox and google maps api JavaScript plugins and library -->
    </body>
</html> 
