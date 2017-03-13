</div>
<!-- /################### zemin kat ##################################################### --> 
        <script>
            var yol = '<?php echo base_url(); ?>';
            var __latitude = <?php echo $this->session->userdata('latitude'); ?>;
            var __longitude = <?php echo $this->session->userdata('longitude'); ?>;
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.0.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="<?php echo base_url('assets/js/jquery.color.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php if (current_url() == base_url('takip')) { ?>
        <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
        <?php } ?>
        
        <script language="javascript">
            function confirmDel() {
                var agree=confirm("Bu içeriği silmek istediğinizden emin misiniz?\nBu işlem geri alınamaz!");
                if (agree) {
                    return true;
                } else {
                    return false;
                }
            }
            
        </script>
        <?php if (current_url() == base_url('takip/profile')) { ?>
        <script>
            
        </script>
        <?php } ?>
        <?php if (current_url() == base_url('takip')) { ?>
        <script src="http://api-maps.yandex.ru/2.0/?load=package.map&lang=ru-RU" type="text/javascript"></script>
        <?php } ?>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url('assets/js/loginjs/bootstrap.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/loginjs/prefixfree.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/dialogpanel/dialogpanel.jquery.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/dialogpanel/multidialogpanel.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        
        <?php if (current_url() == base_url('takip/assanpages')) { ?>
        
        <script src="<?php echo base_url('assets/js/assan/assan.kroki.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/dogakoleji')) { ?>
        
        <script src="<?php echo base_url('assets/js/dogakoleji/doga.class.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/assanareas')) { ?>
        <script src="<?php echo base_url('assets/js/assan/assan.areas.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script>
            //$('[data-toggle="tooltip"]').tooltip('show');
        </script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/addproduct')) { ?>
        <script src="<?php echo base_url('assets/js/modalsprocess/modalsprocess.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/profile')) { ?>
        <script src="<?php echo base_url('assets/js/profilejs/atcpanel.profile.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/uludagpages')) { ?>
        <script src="<?php echo base_url('assets/js/uludag/uludag.otomat.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>        
        <script>
           
        </script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip')) { ?>
        <!-- Charts Librarys -->
        <script src="<?php echo base_url('assets/js/charts/Chart.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/justgage-1.1.0.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/raphael-2.1.4.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/xsensordata.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <!-- Takip Paneli Gösterge Paneli -->
        <script src="<?php echo base_url('assets/js/gauge/jqxcore.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/gauge/jqxdraw.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/gauge/jqxgauge.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/gauge/atcpanel.gauge.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <!-- mapbox and google maps api JavaScript plugins and library -->
        <script src="http://cdn.leafletjs.com/leaflet-0.4.5/leaflet-src.js"></script>
        <script src='https://api.mapbox.com/mapbox.js/v2.2.1/mapbox.js'></script>
        <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/Leaflet.fullscreen.min.js'></script>
        <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
        <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.js'></script>
        <script src="<?php echo base_url('assets/leaflet/maps.Styles.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/leaflet/leaflet-google.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/leaflet/Yandex.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/mapbox/atcpanel.mapbox.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/animated/AnimatedMarker.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/mapbox/atcpanel.library.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/mapbox/atc.motor.blokaj.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/mapbox/atcpanel.realtime.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <!-- DateRangePicker -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/moment.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/daterangepicker.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/xsensor.datepicker.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script>
            // el yapımı modal pencere için sürükleme ve sınır belirleme kodu
            $(window).resize(function(){Genislik()});
            function Genislik(){
                var $genislik = ($(window).width() - 15);
                var $yukseklik = ($(window).height() - 115);
                $('#denemesinir').width($genislik);
                $('#denemesinir').height($yukseklik);
                console.log($(window).height());
                $('.xSensor04-01, .xSensor04-02, .xSensor04-03, .xSensor12, .xSensor12-display').draggable({
                    containment: "#denemesinir",
                    scroll: false
                });
            }
            Genislik(); 
            // el yapımı modal pencere için
        </script>
        <?php } ?>
        
        <?php if (current_url() == base_url('takip/xmetrepages')) { ?>
        <!-- Charts Librarys -->
        <script src="<?php echo base_url('assets/js/charts/Chart.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/justgage-1.1.0.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/raphael-2.1.4.min.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script src="<?php echo base_url('assets/js/charts/xMetreCharts.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <!-- DateRangePicker -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/moment.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/daterangepicker.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datepicker/xsensor.datepicker.js'); ?>?date=<?php echo date('d-m-Y H:i:s'); ?>"></script>
        <?php } ?>
        
    </body>
</html>
