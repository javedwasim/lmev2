<?php

$html = "<!DOCTYPE html>
<html>
<head><link rel='stylesheet' href='".SITE_URL."treant/Treant.css'><link rel='stylesheet' href='".SITE_URL."treant/custom-colored.css'></head>
<body >
<div></div>
<div class='wrapper'> 
	<div id='titlepage' style='text-align:center;  background:rgb(189, 63, 38);min-height: 1300px;'>
		<img src='http://members.launchmyempire.com/img/MAIN.png'/>
	</div>
	<div id='normalpages'>
		<h1>YOUR BUSINESS PLAN DETAILS</h1>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 1: Create a List of Possible Niches
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
		<ol>
			<li><strong>Niches:</strong> $s1_niches_idea1[0] <strong>, Micro Niches:</strong> $s1_niches_idea1[1]</li>
			<li><strong>Niches:</strong> $s1_niches_idea2[0] <strong>, Micro Niches:</strong> $s1_niches_idea2[1]</li>
			<li><strong>Niches:</strong> $s1_niches_idea3[0] <strong>, Micro Niches:</strong> $s1_niches_idea3[1]</li>
			<li><strong>Niches:</strong> $s1_niches_idea4[0] <strong>, Micro Niches:</strong> $s1_niches_idea4[1]</li>
			<li><strong>Niches:</strong> $s1_niches_idea5[0] <strong>, Micro Niches:</strong> $s1_niches_idea5[1]</li>
			</ol>
		</div>
		
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 2: Finalize the Niche to Build
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			<strong>Niches:</strong> $s2_selected_niche[0] <strong>, Micro Niches: </strong> $s2_selected_niche[1]
		</div>
		
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 3: Find 5 of The Top Products In Your Market
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
		<ol>";
if ($database->num_rows($businessplanbonusesResult_3Step)) {
    while ($businessplanbonusesResult_3StepRow = $database->fetch_array($businessplanbonusesResult_3Step)) {
        $s3_url = isset($businessplanbonusesResult_3StepRow['s3_url']) ? $businessplanbonusesResult_3StepRow['s3_url'] : "";
        $html .=" <li><a href='$s3_url'>$s3_url</a></li>";
    }//end of LOOP
}//end of if ($database->num_rows($businessplanbonusesResult_3Step)) {
$html .=" </ol>
		</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 4: Look For Common Trends In Your Market
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			<ol>";
if ($database->num_rows($businessplanbonusesResult_4Step)) {
    while ($businessplanbonusesResult_4StepRow = $database->fetch_array($businessplanbonusesResult_4Step)) {
        $s3_url1 = isset($businessplanbonusesResult_4StepRow['s3_url']) ? $businessplanbonusesResult_4StepRow['s3_url'] : "";
        $s4_price = isset($businessplanbonusesResult_4StepRow['s4_price']) ? $businessplanbonusesResult_4StepRow['s4_price'] : "";
        $s4_type = isset($businessplanbonusesResult_4StepRow['s4_type']) ? $businessplanbonusesResult_4StepRow['s4_type'] : "";
        $s4_platform = isset($businessplanbonusesResult_4StepRow['s4_platform']) ? $businessplanbonusesResult_4StepRow['s4_platform'] : "";
        $s4_network = isset($businessplanbonusesResult_4StepRow['s4_network']) ? $businessplanbonusesResult_4StepRow['s4_network'] : "";
        $s4_main_hook = isset($businessplanbonusesResult_4StepRow['s4_main_hook']) ? $businessplanbonusesResult_4StepRow['s4_main_hook'] : "";
        $s4_product_promise = isset($businessplanbonusesResult_4StepRow['s4_product_promise']) ? $businessplanbonusesResult_4StepRow['s4_product_promise'] : "";

        $html .="<li>";
        $html .="<a href='$s3_url1'>$s3_url1</a><br /><br />";
        $html .="<ul>
                                   <li><strong>Price:</strong> $s4_price, <strong>Type:</strong>$s4_type, <strong>Sold on:</strong> $s4_platform ($s4_network)</li>
                                   <li><strong>Main hook:</strong> $s4_main_hook</li>
				   <li><strong>Provides</strong>: $s4_product_promise</li>
				   </ul>";
        $html .="</li><br/>";
    }
}


$html .=" </ol>
		</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 5: Determine Your Price
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s5_main_product_price
		</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 6: Determine The Type of Product You Will Create
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s6_product_type - $s6_product_type_detail
		</div>
		
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 7: Why Should Someone Buy Your Product?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			<ul>
				<li><strong>URL:</strong> $s7_product_url</li>
				<li><strong>Name:</strong> $s7_product_name</li>
				<li><strong>USP:</strong> $s7_product_usp</li>
				<li><strong>Benefits:</strong> $s7_product_benifit</li>
			</ul>
		</div>
		
		
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 8 - part1: Let's Get a Detailed Idea of What's Inside Your Product
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>";
if ($database->num_rows($businessplanmoduleReslut)) {
    $html .=" <ul>";

    while ($businessplanmoduleRow = $database->fetch_array($businessplanmoduleReslut)) {
        $s8_module_name = isset($businessplanmoduleRow['s8_module_name']) ? $businessplanmoduleRow['s8_module_name'] : "&nbsp";
        $html .= "<li>$s8_module_name</li>";
    }
    $html .=" </ul>";
}


$html .=" </div>
		
		
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 8 - Part2 - Let's Dive Into Each $step8heading Now!
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>";
if ($database->num_rows($businessplanmoduleReslut_2)) {
    $html .=" <ul>";
    while ($businessplanmoduleRow2 = $database->fetch_array($businessplanmoduleReslut_2)) {
        $s8_module_name2 = isset($businessplanmoduleRow2['s8_module_name']) ? $businessplanmoduleRow2['s8_module_name'] : "&nbsp";
        $s8_module_bullets = isset($businessplanmoduleRow2['s8_module_bullets']) ? $businessplanmoduleRow2['s8_module_bullets'] : NULL;
        if (!empty($s8_module_bullets)) {
            $s8_module_bullets_arr = explode("\n", $s8_module_bullets);
        }

        $html .= "<li>";
        $html .= "$s8_module_name2";
        if (!empty($s8_module_bullets_arr)) {
            $html .=" <ul>";
            foreach ($s8_module_bullets_arr as $s8_bullets) {
                $html .= "<li>";
                $html .= "$s8_bullets";
                $html .= "</li>";
            }
            $html .=" </ul>";
        }
        $html .= "</li>";
    }
    $html .=" </ul>";
}
$html .= "</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 9: Are You Going To Want Some Additional Help?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			<ul>
				<li>Will you use outsourcing? : <strong>$s9_outsourcing</strong></li>
				<li>Will you use expert interviews? :<strong> $s9_interview</strong></li>
			</ul>
		</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 10: Your Bonus Titles & Information
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>";
$html .="<ul>";
if ($database->num_rows($businessplanbonusesResult)) {
    $counter=1;
    while ($businessplanbonusesRow = $database->fetch_array($businessplanbonusesResult)) {
        $s10_bonus_title = isset($businessplanbonusesRow['s10_bonus_title']) ? $businessplanbonusesRow['s10_bonus_title'] : "&nbsp";
        $s10_bonus_price = isset($businessplanbonusesRow['s10_bonus_price']) ? $businessplanbonusesRow['s10_bonus_price'] : NULL;
        $s10_bonus_type = isset($businessplanbonusesRow['s10_bonus_type']) ? $businessplanbonusesRow['s10_bonus_type'] : NULL;
        $html .="<li><strong>Bonus# $counter</strong> : $s10_bonus_title ($s10_bonus_type)";
        $counter++;
        
    }//end of LOOP
}//end of if ($database->num_rows($businessplanbonusesResult)) {

$html .="</ul>";

$html .="</div>
		
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 11: Your UPSELL and DOWNSELL?
		</div>
                <div style='position:relative'>
                <div class='step' style='font-weight:bold; font-size:18px; color:#BD3F26;padding:15px;'>
			Your Sales Funnel:
		</div>
                <div class='chart' style='padding-bottom: 25px;padding-left: 15px;' id='productChart'></div></div>
                <div class='step' style='border-bottom: 1px solid #BD3F26;'>
                <div class='step' style='font-weight:bold; font-size:18px; color:#BD3F26;padding:15px;'>
			Your Sales Funnel Detailed Information:
		</div>";
if ($database->num_rows($upsellResult_11Step)) {
    $counter = 1;
    while ($upsellResult_11StepRow = $database->fetch_array($upsellResult_11Step)) {
        $s11_has_upsell = isset($upsellResult_11StepRow['s11_has_upsell'])?$upsellResult_11StepRow['s11_has_upsell']:"&nbsp";
        $s11_upsell_prod_name = isset($upsellResult_11StepRow['s11_upsell_prod_name']) ? $upsellResult_11StepRow['s11_upsell_prod_name'] : "&nbsp";
        $s11_upsell_price = isset($upsellResult_11StepRow['s11_upsell_price']) ? $upsellResult_11StepRow['s11_upsell_price'] : "&nbsp";
        $s11_upsell_detail = isset($upsellResult_11StepRow['s11_upsell_detail']) ? $upsellResult_11StepRow['s11_upsell_detail'] : "&nbsp";
        $s11_upsell_type = isset($upsellResult_11StepRow['s11_upsell_type']) ? $upsellResult_11StepRow['s11_upsell_type'] : "&nbsp";
        $s11_has_downsell = isset($upsellResult_11StepRow['s11_has_downsell']) ? $upsellResult_11StepRow['s11_has_downsell'] : "&nbsp";
        $s11_downsell_prod_name = isset($upsellResult_11StepRow['s11_downsell_prod_name']) ? $upsellResult_11StepRow['s11_downsell_prod_name'] : "&nbsp";
        $s11_downsell_price = isset($upsellResult_11StepRow['s11_downsell_price']) ? $upsellResult_11StepRow['s11_downsell_price'] : "&nbsp";
        $s11_downsell_detail = isset($upsellResult_11StepRow['s11_downsell_detail']) ? $upsellResult_11StepRow['s11_downsell_detail'] : "&nbsp";
        $s11_downsell_type = isset($upsellResult_11StepRow['s11_downsell_type']) ? $upsellResult_11StepRow['s11_downsell_type'] : "&nbsp";
        $html .="<div class='answer' style='padding-bottom: 7px;    padding-left: 15px;'>";
        if ($s11_has_upsell > 0) {
            $html .="<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;'> Upsell # $counter</div>";
            $html .=" <ul>
				<li><strong>Name:</strong> $s11_upsell_prod_name</li>
				<li><strong>Price:</strong>$$s11_upsell_price</li>
				<li><strong>Main hook:</strong> $s11_upsell_detail</li>
                                <li><strong>Deliver method:</strong> $s11_upsell_type</li>
			</ul>";
        } else {
            $html .="";
        }

        $html .=" </div>
		<div class='answer' style=' padding-bottom: 25px;    padding-left: 15px;'>";
        if ($s11_has_downsell > 0 && $s11_has_upsell > 0) {
            $html .="<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;'> Downsell # $counter</div>";
            $html .=" <ul>
				<li><strong>Name:</strong> $s11_downsell_prod_name</li>
				<li><strong>Price:</strong>$$s11_downsell_price</li>
				<li><strong>Main hook:</strong> $s11_downsell_detail</li>
                                <li><strong>Deliver method:</strong> $s11_downsell_type</li>
			</ul>";
        } else {
            $html .="";
        }

        $html .=" </div>";
        if ($s11_has_upsell > 0) {
        $counter++;
        }
    }//end of LOOP;
}//end of if($database->num_rows($upsellResult_11Step)){
$html .= " </div><div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 12: Are You Going To Want Some Additional Help For Upsells?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			<ul>
				<li>Will you use outsourcing? : <strong>$s12_outsourcing</strong></li>
				<li>Will you use expert interviews? :<strong>$s12_interview</strong></li>
			</ul>
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 13: Which Technology Do You Want To use?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s13_system
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 14: How Will You Reach Your Prospects & Customers? Which autoresponder do you want to use?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s14_autoresponder
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 15: How Will You Transact Sales & Collect Revenue? Which payment processor do you want to use?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s15_payment_process
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 16: How Will You Take Great Care of Your Customers? Which customer support system do you want to use?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s16_customer_support
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 17: You Have 3 Options : Pick Your Favorite! How are you going to sell your product?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s17_product_type
		</div>
		<div class='step' style='font-weight:bold; font-size:20px; color:#BD3F26;padding: 15px;text-decoration: underline;'>
			Step # 18: Are you going to outsource your copywriting?
		</div>
		<div class='answer' style='border-bottom: 1px solid #BD3F26; padding-bottom: 25px;    padding-left: 15px;'>
			$s18_copywriting
		</div>
	</div>
</div>

<script src='".SITE_URL."treant/vendor/raphael.js'></script>
    <script src='".SITE_URL."treant/Treant.js'></script>
    <script>
        var config = {
        container: '#productChart',

        nodeAlign: 'BOTTOM',
        
        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1'
        }
    },
    step5 = {
        HTMLclass: 'light-gray',
        innerHTML: '".$Step5InnerHTML."'
    },
    ";
if ($database->num_rows($upsellResult_11ChartStep)) {
    $counter = 1;
    $arrForJsVar = array();
    $firstLevel = 1;
    $secondLevel = 2;
    $thirdLevel = 3;
    $forthLevel = 4;
    $lastLevel = 5;
    while ($upsellResult_11StepChartRow = $database->fetch_array($upsellResult_11ChartStep)) {
        $Charts11_has_upsell = isset($upsellResult_11StepChartRow['s11_has_upsell']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_has_upsell'])) : "&nbsp";
        $Chart_s11_upsell_prod_name = isset($upsellResult_11StepChartRow['s11_upsell_prod_name']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_upsell_prod_name'])) : "&nbsp";
        $Chart_s11_upsell_price = isset($upsellResult_11StepChartRow['s11_upsell_price']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_upsell_price'])) : "&nbsp";
        $Chart_s11_upsell_detail = isset($upsellResult_11StepChartRow['s11_upsell_detail']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_upsell_detail'])) : "&nbsp";
        $Chart_s11_upsell_type = isset($upsellResult_11StepChartRow['s11_upsell_type']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_upsell_type'])) : "&nbsp";
        $Chart_s11_has_downsell = isset($upsellResult_11StepChartRow['s11_has_downsell']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_has_downsell'])) : "&nbsp";
        $Chart_downsell_prod_name = isset($upsellResult_11StepChartRow['s11_downsell_prod_name']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_downsell_prod_name'])) : "&nbsp";
        $Chart_s11_downsell_price = isset($upsellResult_11StepChartRow['s11_downsell_price']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_downsell_price'])) : "&nbsp";
        $Chart_s11_downsell_detail = isset($upsellResult_11StepChartRow['s11_downsell_detail']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_downsell_detail'])) : "&nbsp";
        $Chart_s11_downsell_type = isset($upsellResult_11StepChartRow['s11_downsell_type']) ? trim(preg_replace('/\s\s+/', ' ', $upsellResult_11StepChartRow['s11_downsell_type'])) : "&nbsp";
        $Upsell_innerHTMl = '<div class="proudctBox"><div class="topbox group"><p class="productHeading">Upsell# '.$counter.' </p><p class="produtname">'.$Chart_s11_upsell_prod_name.'</p><p class="produtprice">$ '.$Chart_s11_upsell_price.'</p></div>';
        $Upsell_innerHTMl .= '</div>';
        $Upsell_innerHTMl   = minify_html($Upsell_innerHTMl);
        
        $downsell_innerHTMl = '<div class="proudctBox"><div class="topbox group"><p class="productHeading">Downsell# '.$counter.' </p><p class="produtname">'.$Chart_downsell_prod_name.'</p><p class="produtprice">$ '.$Chart_s11_downsell_price.'</p></div>';
        $downsell_innerHTMl .= '</div>';
        $downsell_innerHTMl   = minify_html($downsell_innerHTMl);
        if ($Chart_s11_has_downsell > 0 && $Charts11_has_upsell > 0) {
            switch ($counter) {
                case $firstLevel:
                    $html .= " downsell_" . $counter . " = {
                    parent: step5,
                    HTMLclass: 'light-gray',
                    innerHTML:'".$downsell_innerHTMl."'
                    },";
                    break;
                case $secondLevel:
                    $html .= " downsell_" . $counter . " = {
                    parent:  upsell_".$firstLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$downsell_innerHTMl."'
                },";
                    break;
                case $thirdLevel:
                    $html .= " downsell_" . $counter . " = {
                    parent: upsell_".$secondLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$downsell_innerHTMl."'
                    },";
                    break;
                case $forthLevel:
                    $html .= " downsell_" . $counter . " = {
                    parent: upsell_".$thirdLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$downsell_innerHTMl."'
                    },";
                    break;
                case $lastLevel:
                    $html .= " downsell_" . $counter . " = {
                    parent: upsell_".$forthLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$downsell_innerHTMl."'
                    },";
                    break;
            }//end of switch ($counter) {
            array_push($arrForJsVar, "downsell_" . $counter);
        }//end of if ($Chart_s11_has_downsell > 0 && $Charts11_has_upsell > 0) {
        if ($Charts11_has_upsell > 0) {
             switch ($counter) {
                case $firstLevel:
                        $html .= " upsell_" . $counter . " = {
                        parent: step5,
                        HTMLclass: 'light-gray',
                       innerHTML:'".$Upsell_innerHTMl."'
                        },";
                        break;
                case $secondLevel:
                    $html .= " upsell_" . $counter . " = {
                    parent: upsell_".$firstLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$Upsell_innerHTMl."'
                    },";
                    break;
                case $thirdLevel:
                    $html .= " upsell_" . $counter . " = {
                    parent: upsell_".$secondLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$Upsell_innerHTMl."'
                    },";
                    break;
                case $forthLevel:
                    $html .= " upsell_" . $counter . " = {
                    parent: upsell_".$thirdLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$Upsell_innerHTMl."'
                    },";
                    break;
                case $lastLevel:
                    $html .= " upsell_" . $counter . " = {
                    parent: upsell_".$forthLevel.",
                    HTMLclass: 'light-gray',
                    innerHTML:'".$Upsell_innerHTMl."'
                    },";
                    break;
            }//end of switch ($counter) {
        array_push($arrForJsVar, "upsell_" . $counter);
        }//end of if ($Charts11_has_upsell > 0) { 
        if ($Charts11_has_upsell > 0) {
            $counter++;
        }//end of if ($Charts11_has_upsell > 0) {
    }//end of LOOP
}//end of if ($database->num_rows($upsellResult_11Step)) {
$html .= " chart_config = [
        config,
        step5,";
if (!empty($arrForJsVar)) {
    $splitArry = implode(', ', $arrForJsVar);
    $html .= " $splitArry";
}
$html .= " ];
        new Treant( chart_config );
    </script>
</body>";
