<?php 
require('require/header_side.php'); 
?>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome2.css">
<head>
  <!-- <meta http-equiv="refresh" content="10"> -->
</head>
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Room and Bed Table
                               <div class="btn-group">
                              <a class="btn btn-success btn-xs" href="<?php echo site_url('bed_rooms/view_add_beds'); ?>"><i class="icon_plus_alt2"></i> Add New Bed</a>
                              </div>
                              <div class="btn-group">
                              <a class="btn btn-success btn-xs" href="<?php echo site_url('bed_rooms/view_add_rooms'); ?>"><i class="icon_plus_alt2"></i> Add New Room</a>
                              </div>
                          </header>
							  
                          <table class="table table-striped table-advance table-hover">
                  							<tbody>
                  								<tr>
                  								 <th><i class="icon_profile capitalize"></i> Bed Number</th>
                  								 <th><i class="icon_profile capitalize"></i> Room Number</th>
                                   <th><i class="icon_profile capitalize"></i> Patient</th>
                                   <th><i class="icon_cogs"></i> Action</th>
                                  </tr>

                  							  <?php foreach($bed_room as $d){  
                                  ?>
                                  <tr>
                  								<td <?php if($d->bed_no==0){ ?>style="background-color:#b3b3b3;"<?php }?>>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $d->bed_no; ?></td>
                  								<td <?php if($d->bed_no==0){ ?>style="background-color:#b3b3b3;"<?php }?>>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $d->room_no; ?></td>

                                  <td <?php if($d->bed_no==0){ ?>style="background-color:#b3b3b3;"<?php }?>>
                                      <?php foreach ($patient as $p) { 
                                        if($p->bed_room_id==$d->id){
                                      ?>
                                      <span class="label-info label label-default"><?php echo $p->fname." ".$p->mname." ".$p->lname; ?></span>
                                        <?php }?> 
                                      <?php } ?>

                                  </td>
                  								<td <?php if($d->bed_no==0){ ?>style="background-color:#b3b3b3;"<?php }?>>
                                    <div class="btn-group">
                                        <a class="btn btn-danger" data-toggle="modal" title="delete" data-target="#myModal<?php echo $d->id."room_bed"; ?>"><i class="icon_close_alt2"></i></a>

                                    </div>
                                  </td>
                                </tr>		

                                


                            <div class="modal fade" id="myModal<?php echo $d->id."room_bed"; ?>" role="dialog">
                              <div class="modal-dialog modal-sm" style="width:30%;">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
                                </div>
                                <div class="modal-body">


                                  <?php if($d->bed_no!=0){ ?>
                                  Are you sure you want to Delete Bed <?php echo $d->bed_no ?> from Room <?php echo $d->room_no ?> ?
                                  <?php }else{ ?>
                                  Are you sure you want to Delete Room <?php echo $d->room_no ?> ? <br>
                                  NOTE: Beds inside it will be deleted.
                                  <?php }?>

                                </div>
                                <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="<?php echo site_url('bed_rooms/del_bed/'.$d->id)?>">Confirm</a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                              </div>
                           </div>
    								<?php }?>									  
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