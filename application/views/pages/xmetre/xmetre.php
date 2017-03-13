<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="left-h2" style="text-align: center;"><?php echo "xMetre veri Tablosu"; ?></h2>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <h4>Cihaz Seç: </h4>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2">
            <select id="deviceImeiIdList" class="form-control" >
                <option>Cihaz Seçin</option>
                <?php foreach($deviceId as $DeviceList) { ?>
                <option><?php echo $DeviceList->imeiid; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <h4>Komut Gönder: </h4>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-4">
            <input type="text" class="form-control" name="devicecmdsend" id="devicecmdsendinput" autocomplete="on" />
            <span class="devicecmdsendinputtext"></span>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <button class="btn btn-primary" id="devicecmdsendbutton">Gönder</button>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>
</div>
<br />
<div class="container-fluid">
    <div class="row">
        <div id="xMetreReports" class="pull-right">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
            <span></span> <b class="caret"></b>
        </div>
        <div id="xmetredatatablesLoading" style="text-align: center;"><progress></progress></div>
        <br /><br />
        <table id="xmetredatatables" class="display table table-striped table-bordered" cellspacing="0" width="100%"></table>
    </div>
</div>

