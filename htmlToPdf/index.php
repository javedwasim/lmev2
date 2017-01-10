<?php 
require_once "includes/initialize.php";
$db_obj = new PdfDB();
$planObj    =   new BusinessplandetailModel();

if(!isset($_REQUEST['p_id'])){
    die();
}
$bp_id = $_REQUEST['p_id'];
$plan_name = $planObj->plan_name($bp_id);
// QUERY FROM DATBASE--------------------------------------------------------------
$row = $db_obj->getSingleRecordByCol("businessplandetail", "bp_id",$bp_id);
$businessplanmoduleReslut = $db_obj->getAllRecordsByCol("businessplanmodule", "bp_id",$bp_id);
$businessplanmoduleReslut_2 = $db_obj->getAllRecordsByCol("businessplanmodule", "bp_id",$bp_id);
$businessplanbonusesResult = $db_obj->getAllRecordsByCol("businessplanbonuses", "bp_id",$bp_id);

$businessplanbonusesResult_3Step = $db_obj->getAllRecordsByCol("businessplanproductdetail", "bp_id",$bp_id);
$businessplanbonusesResult_4Step = $db_obj->getAllRecordsByCol("businessplanproductdetail", "bp_id",$bp_id);
$upsellResult_11Step = $db_obj->getAllRecordsByCol("upsell", "bp_id",$bp_id);
$upsellResult_11ChartStep = $db_obj->getAllRecordsByCol("upsell", "bp_id", $bp_id);
//die();
//------------------------------------------------------------------------------------------------
$s1_niches_idea1 = isset($row['s1_niches_idea1'])?$row['s1_niches_idea1']:NULL;
if($s1_niches_idea1 !=NULL){
    $s1_niches_idea1 = explode("###", $s1_niches_idea1);
 }else{
    $s1_niches_idea1 = array("&nbsp","&nbsp");
}
$s1_niches_idea2 = isset($row['s1_niches_idea2'])?$row['s1_niches_idea2']:NULL;
if($s1_niches_idea2 !=NULL){
    $s1_niches_idea2 = explode("###", $s1_niches_idea2);
 }else{
    $s1_niches_idea2 = array("&nbsp","&nbsp");
}
$s1_niches_idea3 = isset($row['s1_niches_idea3'])?$row['s1_niches_idea3']:NULL;
if($s1_niches_idea3 !=NULL){
    $s1_niches_idea3 = explode("###", $s1_niches_idea3);
 }else{
    $s1_niches_idea3 = array("&nbsp","&nbsp");
}
$s1_niches_idea4 = isset($row['s1_niches_idea4'])?$row['s1_niches_idea4']:NULL;
if($s1_niches_idea4 !=NULL){
    $s1_niches_idea4 = explode("###", $s1_niches_idea4);
 }else{
    $s1_niches_idea4 = array("&nbsp","&nbsp");
}
$s1_niches_idea5 = isset($row['s1_niches_idea5'])?$row['s1_niches_idea5']:NULL;
if($s1_niches_idea5 !=NULL){
    $s1_niches_idea5 = explode("###", $s1_niches_idea5);
 }else{
    $s1_niches_idea5 = array("&nbsp","&nbsp");
}
$s2_selected_niche = isset($row['s2_selected_niche'])?$row['s2_selected_niche']:NULL;
if($s2_selected_niche !=NULL){
    $s2_selected_niche = explode("###", $s2_selected_niche);
 }else{
    $s2_selected_niche = array("&nbsp","&nbsp");
}
$s5_main_product_price = isset($row['s5_main_product_price'])?$row['s5_main_product_price']:"&nbsp";
$s6_product_type = isset($row['s6_product_type'])?$row['s6_product_type']:"&nbsp";
if($s6_product_type =="software"){
    $step8heading = "Feature";
}else{
    $step8heading = "Module";
}
$s6_product_type_detail = isset($row['s6_product_type_detail'])?$row['s6_product_type_detail']:"&nbsp";
$s7_product_url = isset($row['s7_product_url'])?$row['s7_product_url']:"&nbsp";
$s7_product_name = isset($row['s7_product_name'])?$row['s7_product_name']:"&nbsp";
$s7_product_usp = isset($row['s7_product_usp'])?$row['s7_product_usp']:"&nbsp";
$s7_product_benifit = isset($row['s7_product_benifit'])?$row['s7_product_benifit']:"&nbsp";
$s9_outsourcing = isset($row['s9_outsourcing'])?$row['s9_outsourcing']:"&nbsp";
$s9_interview = isset($row['s9_interview'])?$row['s9_interview']:"&nbsp";

$s11_has_upsell = isset($row['s11_has_upsell'])?$row['s11_has_upsell']:"&nbsp";


$s12_outsourcing = isset($row['s12_outsourcing'])?$row['s12_outsourcing']:"&nbsp";
$s12_interview = isset($row['s12_interview'])?$row['s12_interview']:"&nbsp";
$s13_system = isset($row['s13_system'])?$row['s13_system']:"&nbsp";
$s14_autoresponder = isset($row['s14_autoresponder'])?$row['s14_autoresponder']:"&nbsp";
$s15_payment_process = isset($row['s15_payment_process'])?$row['s15_payment_process']:"&nbsp";
$s16_customer_support = isset($row['s16_customer_support'])?$row['s16_customer_support']:"&nbsp";
$s17_product_type = isset($row['s17_product_type'])?$row['s17_product_type']:"&nbsp";
$s18_copywriting = isset($row['s18_copywriting'])?$row['s18_copywriting']:"&nbsp";

$Step5InnerHTML = '<div class="proudctBox"><div class="topbox group"><p class="productHeading">Frontend</p><p class="produtprice"> $'.$s5_main_product_price.'</p></div></div>';


require_once 'html.php'; // HTML Place here..................
//echo $html;
//FOR HTML Template FILE
$templateFile = TEMPLATE_PATH."plan".$bp_id."template.html";
$file = fopen($templateFile, "w") or die("can't open file");
	fwrite($file,$html);
	fclose($file);
        
// FOR PDF 


$path = "wkhtmltopdf\bin\wkhtmltopdf.exe";

$fileName = $plan_name.time().".pdf";
$url = SITE_URL .$templateFile;
$output_path = PDF_PATH . $fileName;
shell_exec("$path $url $output_path");
echo SITE_URL.$output_path;

//DELTE HTML TEMPLATE
unlink($templateFile);
?>