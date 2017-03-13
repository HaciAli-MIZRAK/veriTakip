<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-bottom-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                <h2 class="left-h2"><?php echo $lang_product['your-device-attached-to-the-system']; ?></h2>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" style="padding-top: 22px; padding-bottom: 6px;">
                <form id="demo-2" action="<?php echo base_url('takip/AddProduct'); ?>" method="get" autocomplete="on">
                    <input type="search" name="search" autocomplete="on"/>
                </form>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="padding-bottom: 6px;">
                <h2 class="right-h2 btn btn-primary" data-toggle="modal" data-target="#AddProduct"><i class="fa fa-plus"></i>  <?php echo $lang_product['device-add']; ?><h2>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-th-center fa-pull-center table-striped">
            <thead>
                <tr>
                    <th><?php echo $lang_product['order-no']; ?></th>
                    <th><?php echo $lang_product['device-imeiid']; ?></th>
                    <th><?php echo $lang_product['gsm-no']; ?></th>
                    <th><?php echo $lang_product['car-plate-number']; ?></th>
                    <th><?php echo $lang_product['drivers-name']; ?></th>
                    <th><?php echo $lang_product['drivers-id']; ?></th>
                    <th><?php echo $lang_product['brand-model']; ?></th>
                    <th><?php echo $lang_product['device-type']; ?></th>
                    <th><?php echo $lang_product['product-submitted']; ?></th>
                    <th><?php echo $lang_product['date-added']; ?></th>
                    <th><?php echo $lang_product['last-data-date']; ?></th>
                    <th><?php echo $lang_product['device-status']; ?></th>
                    <th <?php $this->session->userdata('userstatus') == 6 ? 'colspan="3"' : 'colspan="1"' ; ?>><?php echo $lang_product['transactions']; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $deviceCount = 1;
                    $Disabled = null;
                    if (count($DeviceList[0]) == 0) {
                        echo '<tr><td colspan="13" style="font-size: 1.3em;">' . $lang_product['no-products-have-been-added-yet'] . '</td></tr>';
                    }
                    for ($i = 0;$i < count($DeviceList[0]);$i++) {
                        if($this->session->userdata('userstatus') < 6){
                            if ($DeviceList[0][$i]->adminstatus == 0) {
                                $Disabled = 'disabled';
                            }
                        }
                        
                        $DeviceAddingDate   = strtotime($DeviceList[0][$i]->deviceaddingdate);
                        $DeviceEndDate      = strtotime($DeviceList[0][$i]->deviceenddate);
                    ?>
                <tr>
                    <td><?php echo $deviceCount++; ?></td>
                    <td><?php echo $DeviceList[0][$i]->deviceimeiid; ?></td>
                    <td><?php echo $DeviceList[1][$i][6]->metavalue; ?></td>
                    <td><?php echo $DeviceList[1][$i][4]->metavalue; ?></td>
                    <td><?php echo $DeviceList[1][$i][0]->metavalue; ?></td>
                    <td><?php echo $DeviceList[1][$i][1]->metavalue; ?></td>
                    <td><?php echo $DeviceList[1][$i][2]->metavalue; ?></td>
                    <td><?php echo $DeviceList[1][$i][3]->metavalue; ?></td>
                    <td><?php echo $DeviceList[0][$i]->username; ?></td>
                    <td><?php echo date('H:i:s | d-m-Y', $DeviceAddingDate); ?></td>
                    <td><?php echo date('H:i:s | d-m-Y', $DeviceEndDate); ?></td>
                    <td>
                        <?php echo $DeviceList[0][$i]->devicestatus == 0 ? '<button class="fa fa-times fa-red fa-lg btn btn-link ProductChecked" value="1" ' . $Disabled . ' title="' . $lang_product['device-inactive'] . '" id="ProductChecked_' . $DeviceList[0][$i]->deviceimeiid . '"></button>' : '<button class="fa fa-check fa-green fa-lg btn btn-link ProductChecked" value="0" ' . $Disabled . ' title="' . $lang_product['device-active'] . '" id="ProductChecked_' . $DeviceList[0][$i]->deviceimeiid . '"></button>';?>
                    </td>
                    <td>
                        <i class="fa fa-pencil-square-o fa-green fa-lg" data-toggle="modal" data-target="#EditProduct" title="<?php echo $lang_product['device-edit']; ?>"></i>
                    </td>
                    <?php if ($this->session->userdata('userstatus') == 6) { ?>
                    <td>
                        <a href="<?php echo base_url('takip/deviceclearsystem?deviceClearId=' .  $DeviceList[0][$i]->deviceimeiid); ?>" onclick="return confirmDel();">
                            <i class="fa fa fa-trash fa-lg" title="<?php echo $lang_product['device-clear']; ?>"></i>
                        </a>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal AddProduct -->
<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $lang_product['adding-new-device-panel-modal']; ?></h4>
            </div>
            <form action="" method="" class="addProductModal" name="AddDevicePlus" id="AddDevicePlus">
            <div class="modal-body">
                <table class="table table-bordered table-hover table-th-center fa-pull-center table-striped">
                    <tbody>
                        <tr>
                            <td><?php echo $lang_product['drivers-name']; ?></td>
                            <td><input class="form-control" type="text" name="drivername" required /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_product['drivers-id']; ?></td>
                            <td><input class="form-control" type="text" name="driverId" required /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_product['brand-model']; ?></td>
                            <td><input class="form-control" type="text" name="brandmodels" required /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_product['device-type']; ?></td>
                            <td>
                                <select class="form-control" name="cartype" id="selectcontrolx" required>
                                    <option></option>
                                    <option><?php echo $lang_product['autocar-modal']; ?></option>
                                    <option><?php echo $lang_product['camion-modal']; ?></option>
                                    <option><?php echo $lang_product['bus-modal']; ?></option>
                                    <option><?php echo $lang_product['container-modal']; ?></option>
                                    <option><?php echo $lang_product['personnel-modal']; ?></option>
                                    <option><?php echo "Sabit Cihaz"; ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_product['car-plate-number']; ?></td>
                            <td><input class="form-control" type="text" name="carplateno" required /></td>
                        </tr>
                        <tr class="imeiidControltr">
                            <td><?php echo $lang_product['device-imeiid']; ?></td>
                            <td><input class="form-control" type="text" name="deviceimeiid" id="ImeiIdControl" required /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_product['gsm-no']; ?></td>
                            <td><input class="form-control" type="tel" name="devicegsmno" required /></td>
                        </tr>
                        <?php if ($this->session->userdata('userstatus') == 4) { ?>
                        <tr>
                            <td><?php echo "Özel Alan"; ?></td>
                            <td><input class="form-control" type="text" name="accessory" required /></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div id="uyari"></div>
                <div id="test"></div>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="windowClose"><?php echo $lang_product['close-the-window-modal']; ?></button>
                <button type="button" type="submit" class="btn btn-primary" id="submit"><?php echo $lang_product['add-device-modal']; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>
