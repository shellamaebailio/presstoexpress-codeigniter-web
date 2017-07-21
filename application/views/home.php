<?php 
require('require/header_side.php'); 
?>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome2.css">
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Admin Accounts Table
							  <div class="btn-group">
							  <a class="btn btn-success btn-xs" href="<?php echo site_url('admin_c/add_admin'); ?>"><i class="icon_plus_alt2"></i> Register new Admin</a>
							  </div>
                          </header>
							  
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile capitalize"></i> Full Name</th>
                                 <th><i class="icon_profile"></i> Gender</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_mobile"></i> Mobile</th>
                                  <th><i class="icon_mobile"></i> Address</th>
                                  <th></th>
                               <!--  <th><i class="icon_cogs"></i> Action</th> -->
                              </tr>
							  <?php foreach($admin as $d){ ?>
                              <tr>
                                 <?php 
									
											echo "<td>".$d->fname." ".$d->mname." ".$d->lname."</td>";
											echo "<td>".$d->gender."</td>";
											echo "<td>".$d->email."</td>";
											echo "<td>".$d->contact_no."</td>";
											echo "<td>".$d->address."</td>";
									
								 ?>
								 <td>
                                 <!--  <div class="btn-group">
                                      <a class="btn btn-success" href=""><i class="fa fa-eye"></i></a>
                                      <a class="btn btn-danger" title="Delete admin" data-toggle="modal" data-target="#myModal<?php echo $d->id; ?>"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td> -->
                              </tr>   
							  
							  
								<div class="modal fade" id="myModal<?php echo $d->id; ?>" role="dialog">
									<div class="modal-dialog modal-sm" style="width:30%;">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
										</div>
										<div class="modal-body">
										  Delete <?php echo $d->lname."'s admin account?"; ?>
										</div>
										<div class="modal-footer">
										<a type="button" class="btn btn-danger" href="<?php echo site_url('admin_c/del_admin/'.$d->id)?>">Confirm</a>
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