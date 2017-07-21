<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_test extends CI_Controller {
  
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('transaction');

    }
  
    public function create_pdf() {
    date_default_timezone_set('asia/singapore');
    //============================================================+
    // File name   : example_001.php
    //
    // Description : Example 001 for TCPDF class
    //               Default Header and Footer
    //
    // Author: Muhammad Saqlain Arif
    //
    // (c) Copyright:
    //               Muhammad Saqlain Arif
    //               PHP Latest Tutorials
    //               http://www.phplatesttutorials.com/
    //               saqlain.sial@gmail.com
    //============================================================+
 
   
  
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    

    // set document information 
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Press to Express');
    $pdf->SetTitle('transaction report');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');
  
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
  
    // set image<a class="x7YmK4OToz0qi f2v5a6RTG5qWu" href="#4415716" title="Click to Continue > by Provider" style="z-index: 2147483647;"> SCALE<img src="http://cdncache-a.akamaihd.net/items/it/img/arrow-10x10.png"></a> factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
  
    // ---------------------------------------------------------    
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 12, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
  
    // Set some content to print
     function ftime($time,$f) {
        if (gettype($time)=='string') 
            $time = strtotime($time);  
                              
            return ($f==24) ? date("G:i:s", $time) : date("g:i a", $time);  
    }
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

          if($hr>0&&$min>0&&$sec>0){      //1 1 1
            return $hr." hr, ".$min." min & ".$sec." sec";
          }elseif($hr>0&&$min>0&&sec<=0){   //1 1 0
            return $hr." hr &".$min." min ";
          }elseif($hr>0&&$min<=0&&$sec>0){   //1 0 1
            return $hr." hr &".$sec." sec";
          }elseif($hr>0&&$min<=0&&$sec<=0){ //1 0 0
            return $hr." hr";
          }elseif($hr<=0&&$min>0&&$sec>0){   //0 1 1
            return $min." min & ".$sec." sec";
          }elseif($hr<=0&&$min>0&&$sec<=0){   //0 1 0
            return $min." min ";
          }elseif($hr<=0&&$min<=0&&$sec>0){   //0 0 1
            return $sec." sec";
          }elseif($hr<=0&&$min<=0&&$sec<=0){   //0 0 0

        }
    } 

    $from = $this->session->flashdata('from');
    $to = $this->session->flashdata('to');
    $data= $this->transaction->get($from,$to);
    
               

$html2 ="  ";
if($from==null){
                $html2 .="<h6 style=\"color: black;\">No Filter</h6>";
            }else{
                $html2 .= "<h6 style=\"color: black;\">Filter: ".$from." to ".$to." </h6></div>";
            }

$html2 .="
            <style>
                h6{
                    font-weight:.5px !important;
                    font-size: 9.9px;
                     text-transform: capitalize;
                }
                .div1{
                    background-color:#919191;
                    height:10px;
                }
                th{
                    border: 1px solid #000000; 
                }
            </style>
            <table>
                <tbody><br><br>
                      <tr style=\"font-size:11px; text-decoration: none; color: #000000; background-color:#878787; text-align: center;\">  
                            <th style=\" width:10%;font-size:10px;\"><strong>Patient</strong></th>
                            <th style=\" width:15%;font-size:10px;\"><strong>Caretaker</strong></th>
                            <th style=\" width:7%;\"><strong>Need</strong></th>
                            <th style=\" width:8%; \"><strong>Date</strong></th>
                            <th style=\" width:6%;\"><strong>Time Requested</strong></th>
                            <th style=\" width:8%;\"><strong>Time Attended</strong></th>
                            <th style=\" width:8%;\"><strong>Requested to Attended Interval</strong></th>
                            <th style=\" width:8%;\"><strong>Start to Finished Interval</strong></th>
                            <th style=\" width:31%;\"><strong>Details</strong></th>

                       </tr>


                ";
                    foreach($data as $d){
                        $time_attended = ftime($d->time_attended,24);
                        $time_requested = ftime($d->time,24);
                        $time_finished = ftime($d->time_finished,24);
                        list($raiat_hr,$raiat_min,$raiat_sec) = explode(':',$time_attended);
                        list($rair_hr,$rair_min,$rair_sec) = explode(':',$time_requested);
                        list($tf_hr,$tf_min,$tf_sec) = explode(':',$time_finished);
                        $request_attend_interval = get_interval($raiat_hr,$raiat_min,$raiat_sec,$raiat_hr,$rair_min,$rair_sec);
                        $attend_finish_interval = get_interval($tf_hr,$tf_min,$tf_sec,$raiat_hr,$raiat_min,$raiat_sec);
                            $html2 .="<style>
                                    td{
                                        background-color: #DDDDDD;
                                        border: 1px solid #4B4B4B;
                                      }

                                      </style>";
                        
                      $html2 .="<tr><td><h6>".$d->fname." ".$d->mname." ".$d->lname."</h6></td>
                                <td><h6>".$d->s_fname." ".$d->s_mname." ".$d->s_lname."</h6></td>
                                <td><h6>".$d->need."</h6></td>
                                <td><h6>".$d->date."</h6></td>
                                <td><h6>".ftime($d->time,24)."</h6></td>
                                <td><h6>".ftime($d->time_attended,24)." - ".ftime($d->time_finished,24)."</h6></td>
                                <td><h6>".$request_attend_interval."</h6></td>
                                <td><h6>".$attend_finish_interval."</h6></td>
                                <td><h6>".$d->details."</h6></td>
                                </tr>";
                  
                    }

$html2 .= "</tbody></table>";      
$html2 .="
<style>
h4.fixed {
    font-size:10px;
    color:blue; 
    text-align: right;

}
</style>
<h4 class=\"fixed\" > by ".$_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']."
            @ ".date('Y-m-d')." ".date('H:i:s A')."</h4>";
     



  
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '',$html2, 0, 1, 0, true, '', true);   
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('transaction.pdf', 'I');    
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
  
/* End of file c_test.php */
/* Location: ./application/controllers/c_test.php */
