<?php 
require('require/header_side.php'); 
?>
<head>
  <meta http-equiv="refresh" content="10">
</head>
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Patient Table
							  <div class="btn-group">
							  <a class="btn btn-success btn-xs" href="<?php echo site_url('patient_c/add_patient_vvv');?>"><i class="icon_plus_alt2"></i> Register new Patient</a>
							  </div>
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                <th><i class="icon_profile"></i> Full Name</th>
                                <th><i class="icon_cogs"></i> Action</th>

                              </tr>

                    <?php $count = 0; ?>
                 <?php foreach($pat as $d){ ?>
                        
                  <tr>
                   <?php $count++; ?>
                    <?php  echo "<td>".$count.". "." " .$d->fname." ".$d->mname." ".$d->lname."</td>"; ?>
                          <td>
                                  <div class="btn-group">
                                      <a class="btn btn-success" title="View Information" href="<?php echo site_url('patient_c/profileses/'.$d->patient_id) ?>"><i class="fa fa-eye"></i></a>
                                      <a class="btn btn-danger" title="Delete Patient" data-toggle="modal" data-target="#myModal<?php echo $d->patient_id; ?>"><i class="icon_close_alt2"></i></a>
                                   
                                  </div>
                          </td>
                  </tr>
                

                              <div class="modal fade" id="myModal<?php echo $d->patient_id; ?>" role="dialog">
                                <div class="modal-dialog modal-sm" style="width:30%;">
                                  <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
                                  </div>
                                  <div class="modal-body">
                                    Delete <?php echo $d->lname."'s patient account?"; ?>
                                  </div>
                                  <div class="modal-footer">
                                  <a type="button" class="btn btn-danger" href="<?php echo site_url('patient_c/del_patient/'.$d->patient_id)?>">Confirm</a>
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