<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="veri takip sistemleri www.veritakip.net adresi üzerinden müşterilerine veri takip hizmeti sunan %100 Türk veri takip markasıdır" />
        <meta name="keywords" content="veritakip,gebze veri takibi,veritakip sistemleri,veri takip cihazları,veri takip haberleri,uydu veri,takip sistemi,veri takip" />
        <title><?php echo $lang_header['website-title']; ?> | Takip Paneli</title>
        <!-- Favicon ico -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png'); ?>" type="image/x-icon" />
        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url('assets/css/atcpanel.style.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/atcpanel.assan.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <?php if (current_url() == base_url('takip/uludagpages')) { ?>
        <link href="<?php echo base_url('assets/css/atcpanel.uludag.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <?php } ?>
        <link href="<?php echo base_url('assets/css/login.panel.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/atcpanel.sweetalert.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <!-- xMetre Panel -->
        <link href="<?php echo base_url('assets/css/atcpanel.xmetre.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <?php if (current_url() == base_url('takip')) { ?>
        <link href="<?php echo base_url('assets/css/marker.style.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/atcpanel.clusters.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/atcpanel.gauge.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/atcpanel.justgage.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <?php } ?>
        <!-- Google Fonts için gerekli Linkler -->
        <!-- link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css" / -->
        <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/font-awesome-animation.css'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>" rel="stylesheet" />
        <?php if (current_url() == base_url('takip')) { ?>
        <link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.7/mapbox.css' rel='stylesheet' />
        <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css' rel='stylesheet' />
        <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
        <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
        <?php } ?>
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css" />
        <!-- Include Date Range Picker -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    </head>
    <body>
        <div id="denemesinir">
        