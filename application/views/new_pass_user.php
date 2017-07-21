<?php 
require('require/header_side.php'); 

?>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome2.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/mystyle.css">
      <section id="main-content">
          <section class="wrapper"> 		
				<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add new Admin
                          </header>
                          <div class="panel-body">
                              <div class="form font">
                                  <form class="form-validate form-horizontal " id="register_form" method="post" action="<?php echo site_url('admin_c/submit_add/')?>">
									<center><div class="he" style="width:40%">
										<div class="info-box gray-bg">
											<div>Username: <?php echo $u; ?></div>
											<div>Password: <?php echo $p; ?></div>
											
											<a onclick="myFunction()"><i style="color:lightblue; font-size:150%;" class="r fa fa-refresh iconrefresh" aria-hidden="true"></i></a>
											
												<input type="hidden" name="f" value="<?php echo $f;?>"></input>
												<input type="hidden" name="m" value="<?php echo $m;?>"></input>
												<input type="hidden" name="u" value="<?php echo $u;?>"></input>
												<input type="hidden" name="l" value="<?php echo $l;?>"></input>
												<input type="hidden" name="g" value="<?php echo $g;?>"></input>
												<input type="hidden" name="a" value="<?php echo $a;?>"></input>
												<input type="hidden" name="p" value="<?php echo $p;?>"></input>
												<input type="hidden" name="c" value="<?php echo $c;?>"></input>
												<input type="hidden" name="e" value="<?php echo $e;?>"></input>
										</div>
										<button class="btn btn-primary" type="submit">ADD</button>
									</div><center>
								  <div class="form-group">
                                          
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
			</section>
		</section>
		<script>
		function myFunction() {
			location.reload();
		}</script>
<?php 
require('require/footer.php'); 
?>			  