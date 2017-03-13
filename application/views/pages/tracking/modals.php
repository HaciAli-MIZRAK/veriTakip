<!-- Modal -->
<div class="modal fade" id="myModalUyari" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $lang_header['navbar-brand']; ?> <?php echo $lang_modals['system-alert']; ?></h4>
      </div>
      <div class="modal-body">
          <h4><?php echo $lang_modals['no-vehicle-has-been-added-yet']; ?></h4>
          <p><?php echo $lang_modals['no-vehicle-has-been-added-yetp']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang_modals['close-the-window']; ?></button>
        <a href="<?php echo base_url('takip/addproduct'); ?>" type="button" class="btn btn-primary"><?php echo $lang_modals['go-to-product-insertion-panel']; ?></a>
      </div>
    </div>
  </div>
</div>
<!-- #Modal -->

<!-- ModalAlarmInfo -->
<div class="modal fade" id="myModalAlarm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $lang_header['navbar-brand']; ?> <?php echo "Alarm Paneli"; ?></h4>
      </div>
      <div class="modal-body" style="text-align: center;">
		<i class="fa fa-exclamation-triangle fa-5x fa-red faa-flash animated"></i>
        <div id="myModalAlarmText"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang_modals['close-the-window']; ?></button>
      </div>
    </div>
  </div>
</div>
<!-- #ModalAlarmInfo -->

<!-- xSensorDataSliderButton04-01-Modal -->
<div class="modal fade" id="xSensorDataSliderButton04-01-Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="backgorund: rgba(68, 97, 157, 0.9);">
            <h4 class="modal-title" id="myModalLabel"><!-- <u><span id="divecePlate" class="fa-red"></span></u>--> <?php echo "Plakalı Araç Bilgileri"; ?></h4>
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
        </div>
        <div class="modal-body">
            <?php require_once 'xsensor/temp0401.php' ;?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang_modals['close-the-window']; ?></button>
        </div>
    </div>
  </div>
</div>
<!-- #Modal -->

<!-- atcPhoto Modal -->
<div class="modal fade" id="AtcPhotoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><em>IMEI ID: </em><b><span id="xAtcModalPanelImei" class="fa-green"></span></b> Bu Cihaza Ait Fotoğraflar</h4>
            </div>
            <div class="modal-body" id="photoitemid">
            </div><!-- class modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang_modals['close-the-window']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- #atcPhoto Modal -->

<div id="gaugeContainer" style="display: none;"></div>
<div id="xSensorDatauyari" style="position: absolute; margin-top: 180px; background: #fff;"></div>
<!-- NavbarGostergePaneli -->
<div class="container-fluid">
    <div class="row">
        <div id="NavbarGostergePaneli" class="fa-box-shadow">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-bottom: 1px; padding-top: 5px;">
                <i id="bateryStatus" class="fa fa-battery-empty fa-red fa-lg">&nbsp;<span style="font-size: 0.7em;"></span></i>
                <i id="power-voltaj" class="fa fa-plug fa-green fa-lg"></i>
                <i id="satelliteCount" class="icon-satellitedish-remotemysql fa-red fa-lg">&nbsp;<span style="font-family: sans-serif; font-size: 0.9em;"></span></i>
            </div>
            <div id="divecePlate" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="font-family: arial; padding-bottom: 1px; padding-top: 5px; font-weight: bold; text-align: center;"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <i id="rulesxWarning" class="fa fa-bell-slash fa-lg"><span>0</span></i>
                <a href="#" data-toggle="modal" title="Görmeniz Gereken Fotoğraflar var" data-target="#AtcPhotoModal"><i id="atcPhoto" class="fa fa-picture-o fa-lg" style="display: none;"><span id="xAtcPhotoModalCount" class="fa-red">0</span></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php require_once 'xSensorData.php'; ?>