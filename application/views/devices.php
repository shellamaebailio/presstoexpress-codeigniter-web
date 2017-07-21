<?php 
require('require/header_side.php'); 
date_default_timezone_set('asia/singapore');
$military = date('His');
$date = date('Y-m-d');
?>
<style>
#rcorners1 {
    border-radius: 30px;
    background: #73AD21;
    padding: 2px;
    margin-top: 0px; 
    margin-left: 5px;
    width: 10px;
    height: 10px;  

}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome2.css">
<head>
 <!--  <meta http-equiv="refresh" content="5"> -->
</head>
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Express Devices &nbsp;
                                <div class="btn-group">
                              <a class="btn btn-success btn-xs" href="<?php echo site_url('express_device_c/view_add_device'); ?>"><i class="icon_plus_alt2"></i> Add New Express Device</a>
                              </div> 
                          </header>
							  
                          <table class="table table-striped table-advance table-hover">
							<tbody>

								  <tr>
      								 <th><i class="icon_profile capitalize"></i> Device Name (Online)</th>
                       <th><i class=" icon_cogs capitalize"></i> Mac</th>
                       <th><i class="icon_profile"></i> Patient</th>
                        <th><i class="icon_cogs"></i> Action</th>
                  </tr>
<!-- $d->last_logged_in_date==$date&&($military-$d->last_logged_in)<3 -->
                  <?php $count =1; ?>
							    <?php foreach($device as $d){ ?>
                  <tr>
      								<td><p style="display: inline-block; "><?php echo $d->name; ?></p>
                        <?php if($date==$d->last_logged_in_date&&($military-$d->last_logged_in)<3){ ?> 
                          <p style="display: inline-block; " id="rcorners1"></p>
                        <?php } ?></td>
                      <td><?php echo $d->mac; ?></td>
                      <?php $count++; ?>
                      <td>

                          <?php foreach ($patient as $p) {
                            if($d->device_id==$p->device_id){
                          ?>
                            <span class="label-danger label label-default"><?php echo $p->fname." ".$p->mname." ".$p->lname;?></span> 
                          <?php }}?> 
      								  <td>
                          <div class="btn-group">
                            <a class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $d->device_id."device"; ?>"><i class="icon_close_alt2"></i></a>
                            <a class="btn btn-success" href="<?php echo site_url('express_device_c/update_device_view/'.$d->device_id) ?>"><i class="fa fa-pencil"></i></a>
                          </div>
                        </td>
                  </tr>		

                    <!-- delete modal -->
                            <div class="modal fade" id="myModal<?php echo $d->device_id."device"; ?>" role="dialog">
                              <div class="modal-dialog modal-sm" style="width:30%;">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to Delete Device <?php echo $d->name ?> ?
                                </div>
                                <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="<?php echo site_url('express_device_c/delete_device/'.$d->device_id)?>">Confirm</a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                              </div>
                           </div>
                <?php } ?>
										  
							         </tbody>
                        </table>
                      </section>
                  </div>
              </div>
          </section>
      </section>
  </section>
<?php 
require('require/footer.php'); 
?>