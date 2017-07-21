<?php 
require('require/header_side.php'); 
date_default_timezone_set('asia/singapore');
$military = date('His');
$date = date('Y-m-d');

function get_interval($ghr,$gmin,$gsec,$lhr,$lmin,$lsec){
          $sec = $gsec-$lsec;
          if($sec<0){
            $gmin-=1;
            $gsec+=60;
            $sec = $gsec-$lsec;
          }
          $min = $gmin-$lmin;
          if($min<0){
            $ghr-=1;
            $gmin+=60;
            $min = $gmin-$lmin;
          }
          $hr = $ghr-$lhr;

            return $hr.":".$min.":".$sec." ";
        }
function ftime($time,$f) {
        if (gettype($time)=='string') 
            $time = strtotime($time);  
                              
            return ($f==24) ? date("G:i:s", $time) : date("g:i:s a", $time);  
}

function sum_time($time,$count){
	
	//add-checksec-devide

	$asas = explode(' ',"$time") ;

	
	$t[] = null;
	$c = 0;
	foreach ($asas as $k) {
		$t[$c] = $k;
		$c+=1;
	}
	// var_dump($t);
	$c-=1;
	$sums = null;
	$summ = null;
	$sumh = null;
	for($a=0;$a<$c;$a++){
		list($h,$m,$s) = explode(':',$t[$a]);
		$sums = $sums+$s;
		$summ = $summ+$m;
		$sumh = $sumh+$h;
	}

	if($sums>=60){
		$sums-=60;
		$summ+=1;
	}
	if($summ>=60){
		$summ-=60;
		$sumh+=1;
	}
	if($count!=0){
	$sums=round($sums/$count,1);
	$summ=round($summ/$count,1);
	$sumh=round($sumh/$count,1);
	}

	if($summ!=round($summ)){
		list($a,$c) = explode('.', $summ);
		$b = ($c*.10)*60;
		$summ=$a;
		$sums+=$b;
	}

	if($sumh!=round($sumh)){
		list($a,$c) = explode('.', $sumh);
		$b = ($c*.10)*60;
		$sumh=$a;
		$summ+=$b;
	}
	if($sums>=60){
		$summ+=1;
		$sums-=60;
	}
	if($summ>=60){
		$sumh+=1;
		$summ-=60;
	}
	if($sumh>0){
		return $sumh." hr ".$summ." min ".$sums." sec";
	}elseif($summ>0){
		return $summ." min ".$sums." sec";
	}else{
		return $sums." sec";
	}	
}         
?>
<head>
	<!-- <meta http-equiv="refresh" content="10"> -->
</head>
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Caretaker Account Table
							  <div class="btn-group">
							  <a class="btn btn-success btn-xs" href="<?php echo site_url('caretaker_c/add_view'); ?>"><i class="icon_plus_alt2"></i> Register new Caretaker</a>
							  </div>
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Full Name</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_mobile"></i> Mobile</th>
                                 <th><i class="icon_cogs"></i>Performance Average</th>
                                  <th><i class="icon_cogs"></i> Status</th>
                                 <th><i class="icon_cogs"></i> Action</th>

                              </tr>
                              <tr>
                                 
									<?php foreach($caretakers as $d){ ?>
									<?php	if($d->deleted==0){ ?>
										<td><?php echo $d->fname." ".$d->mname." ".$d->lname ?></td>
										<td><?php echo $d->email ?></td>
										<td><?php echo $d->contact_no ?></td>
										<td>
											<?php 
											$request_attend_interval = null;
											$ccount[$d->id] = 0;

													$sum1[$d->id] = "0:0:0 ";
													$sum2[$d->id] = "0:0:0 ";
												foreach ($avg as $k) {
													if($k->staff_id==$d->id){
														$ccount[$d->id]+=1;
														$time_attended = ftime($k->time_attended,24);
							                            $time_requested = ftime($k->time,24);
							                            $time_finished = ftime($k->time_finished,24);

							                            list($raiat_hr,$raiat_min,$raiat_sec) = explode(':',$time_attended);
							                            list($rair_hr,$rair_min,$rair_sec) = explode(':',$time_requested);
							                            list($tf_hr,$tf_min,$tf_sec) = explode(':',$time_finished);

							                            $request_attend_interval = get_interval($raiat_hr,$raiat_min,$raiat_sec,$raiat_hr,$rair_min,$rair_sec);
							                            $attend_finish_interval = get_interval($tf_hr,$tf_min,$tf_sec,$raiat_hr,$raiat_min,$raiat_sec);
							                           	
							                           	if($request_attend_interval==null){
							                           		$sum1[$d->id] .= "0:0:0 ";
							                           	}else{
							                            	$sum1[$d->id] .= $request_attend_interval;
							                            	$sum2[$d->id] .= $attend_finish_interval;
							                            }

													}
													 
													
												}
												  echo "Accept Request Average: ".sum_time($sum1[$d->id],$ccount[$d->id])."<br>";	
												  echo "Attend Request Average: ".sum_time($sum2[$d->id],$ccount[$d->id]);
											 ?>
										</td>
											<?php if(($military-$d->last_logged_in)<5&&$date==$d->last_logged_in_date){ ?>
										<td>
											<span class="label-primary label label-default">Online</span> 
										</td>
											<?php }else{ ?>
										<td>
											<span style="background-color:#E1542B;" class="label label-default">Offline</span>
										</td>
											<?php } ?>

										<?php	} elseif($d->deleted==1){ ?>
										<td style="background-color:#B8B8B8;"><?php echo $d->fname." ".$d->mname." ".$d->lname ?></td>
										<td style="background-color:#B8B8B8;"><?php echo $d->gender ?></td>
										<td style="background-color:#B8B8B8;"><?php echo $d->email ?></td>
										<td style="background-color:#B8B8B8;"><?php echo $d->contact_no ?></td>
										<td style="background-color:#B8B8B8;"></td>

									<?php } ?>
								
								<?php if($d->deleted==0){ ?>
								 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-success" title="View Caretaker" href="<?php echo site_url('caretaker_c/profile/'.$d->id) ?>"><i class="fa fa-eye"></i></a>
                                     	<?php if($d->deleted==0){ ?>
                                      <a class="btn btn-danger" title="Deactivate Caretaker" data-toggle="modal" data-target="#deactivate<?php echo $d->id; ?>"><i class="icon_close_alt2"></i></a>
                                 		<?php }elseif($d->deleted==1){ ?>
                                 	  <a class="btn btn-primary" title="Activate Caretaker" data-toggle="modal" data-target="#activate<?php echo $d->id; ?>"><i class="fa fa-check"></i></a>
                                 	  	<?php } ?>
                                  </div>
                                  </td>
                                <?php } elseif($d->deleted==1){ ?>

                                 <td style="background-color:#B8B8B8;">
                                  <div class="btn-group">
                                      <a class="btn btn-success" title="View Caretaker" href="<?php echo site_url('caretaker_c/profile/'.$d->id) ?>"><i class="fa fa-eye"></i></a>
                                     	<?php if($d->deleted==0){ ?>
                                      <a class="btn btn-danger" title="Deactivate Caretaker" data-toggle="modal" data-target="#deactivate<?php echo $d->id; ?>"><i class="icon_close_alt2"></i></a>
                                 		<?php }elseif($d->deleted==1){ ?>
                                 	  <a class="btn btn-primary" title="Activate Caretaker" data-toggle="modal" data-target="#activate<?php echo $d->id; ?>"><i class="fa fa-check"></i></a>
                                 	  	<?php } ?>
                                  </div>
                                  </td>
                                  <?php } ?>
                              </tr>
								
								
								
								<div class="modal fade" id="deactivate<?php echo $d->id; ?>" role="dialog">
									<div class="modal-dialog modal-sm" style="width:30%;">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
										</div>
										<div class="modal-body">
										  Deactivate <?php echo $d->lname."'s caretaker account?"; ?>
										</div>
										<div class="modal-footer">
										<a type="button" class="btn btn-danger" href="<?php echo site_url('caretaker_c/del_caretaker/'.$d->id)?>">Confirm</a>
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									  </div>
									</div>
								</div>


								<div class="modal fade" id="activate<?php echo $d->id; ?>" role="dialog">
									<div class="modal-dialog modal-sm" style="width:30%;">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
										</div>
										<div class="modal-body">
										  Activate <?php echo $d->lname."'s caretaker account?"; ?>
										</div>
										<div class="modal-footer">
										<a type="button" class="btn btn-danger" href="<?php echo site_url('caretaker_c/act_caretaker/'.$d->id)?>">Confirm</a>
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