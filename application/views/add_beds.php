<?php 
require('require/header_side.php'); 
?>
      <section id="main-content">
          <section class="wrapper"> 		
				<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add new Bed
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="register_form" method="post" action="<?php echo site_url('bed_rooms/add_beds') ?>">
								  <div style="margin-left:17%; color:red;"></div>
                                      <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Room</label>
                                          <div class="col-lg-6">
                                            
                                              <select name="room" class="form-control">
                                                  <?php foreach ($room as $r){ ?>
                                                <option value="<?php echo $r->room_no; ?>"><?php echo $r->room_no; ?></option>
                                                  <?php } ?>

                                              </select>
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Bed</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="bed" type="number" />
                                          </div>
                                      </div>
									 
									  
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Add</button>
                                              <a class="btn btn-default" href="<?php echo site_url('bed_rooms/view_beds');?>" type="button">Cancel</a>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
			</section>
		</section>
		
<?php 
require('require/footer.php'); 
?>			  