<?php

//------------------------------SET LocalTimeZone-------------------------------------
//if(function_exists('date_default_timezone_set')) date_default_timezone_set(TIME_ZONE);
//--------------------------mysql_prep function-------------------------

function redirect_JS($page) {
    echo '<script>window.location = "' . $page . '";</script>';
}

function getHttpVars() {
    $superglobs = array(
        '_POST',
        '_REQUEST',
        '_GET',
        '_FILES',
        'HTTP_POST_VARS',
        'HTTP_GET_VARS');
    $httpvars = array();
    // extract the right array
    foreach ($superglobs as $glob) {
        global $$glob;
        if (isset($$glob) && is_array($$glob)) {
            $httpvars = $$glob;
        }
        if (count($httpvars) > 0)
            break;
    }
    return $httpvars;
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function output_message($message = "") {
    
}

function show_msg($message) {
    
}

function msg_box() {
    echo '<div class="alert alert-danger display-none msg_box">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              			<div class="msg_err"></div>
              		</div>';
}

function err_msg_box($id) {
    echo '<div class="alert alert-danger display-none msg_box" id="msg_box_' . $id . '">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              			<div class="msg_err" id="msg_err_' . $id . '"></div>
              		</div>';
}

function sucess_alert() {
    
}

function loader_box() {
    echo '<div class="loder_box text-center display-none">
                    	<img src="images/loading-bars.svg" alt="Loading..." />
                    </div>';
}
function wizrd_loader_box() {
    echo '<div class="loder_box display-none">
                    	<img src="images/loading-bars.svg" alt="Loading..." />
                    </div>';
}

function msg_box2() {
    
}

function message_box($id) {
    
}

function success_message($id) {
    echo '<div id="successmsgBx' . $id . '" class="alert alert-success display-none">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              			<div id="msg_suc' . $id . '"></div>
              		</div>';
}

function spanner_loder($id) {
    echo '<span id="spinner_' . $id . '">
            <img src="images/loading-bars.svg" width="20" height="20" style="width:20px;height:20px" />
           </span>';
}

function loader_box2() {
    
}

function active_current_page(array $page) {
    global $currentPage;
    if (in_array($currentPage, $page)) {
        echo "active";
    }
}

function selected_arrow(array $page) {
    global $currentPage;
    if (in_array($currentPage, $page)) {
        echo "selected";
    }
}

function is_home_page() {
    global $currentPage;
    if ($currentPage == "index.php") {
        return true;
    }
}

function is_page($page) {
    global $currentPage;
    //$page  =   $page.".php";
    if ($currentPage == $page) {
        return true;
    }
}

function open_child_nav(array $page) {

    global $currentPage;
    if (in_array($currentPage, $page)) {
        echo 'style="display:block"';
    }
}

//function open_child_nav(array $page){

function beutifyArray(array $arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function SetOrNot($input) {
    return isset($input) ? $input : "";
}

function page_heading() {
    global $currentPage;
    if (is_home_page() || is_page("mortgageprofessional.php")) {
        echo " Dashboard";
    } elseif (is_page("buyerlead.php")) {
        echo "Lead";
    } elseif (is_page("loadbuyer.php")) {
        echo "Load A Buyer";    
    } elseif (is_page("loadlisting.php")) {
        echo "Market a Listing";
    } elseif (is_page("adsetreports.php")) {
        echo "Reports";
    } elseif (is_page("admin.php")) {
        echo "Admin Dashboard";
    } elseif (is_page("realtors.php")) {
        echo "Realtors List";
    } elseif (is_page("getAds.php")) {
        echo "Ads";
    } elseif (is_page("profile.php")) {
        echo "My Profile";
    } elseif (is_page("AdDetail.php")) {
        echo "MARKETING REPORT";
    } elseif (is_page("teamsettings.php") || $currentPage == 'adminteam.php') {
        echo "Team Settings";
    } elseif (is_page("loadrealtor.php")) {
        echo "Load Realtor";
    } elseif (is_page("brokerprofile.php")) {
        echo "Profile";
    } elseif (is_page("realtorsettings.php")) {
        echo "Realtor Settings";
    } elseif (is_page("realtorleads.php")) {
        echo "Realtor Leads";
    } elseif (is_page("listingview.php")) {
        echo "Sellers";
    } elseif (is_page("buyerslist.php")) {
        echo "Buyers";
    } elseif (is_page("hubusers.php")) {
        echo "Hub Users";
    } elseif (is_page("myrealtors.php")) {
        echo "My Realtors";
    } elseif (is_page("realtorsteam.php")) {
        echo "Team Member";
    } elseif (is_page("listingspackages.php") || is_page("addlistingpkg.php")) {
        echo "Listings Packages";    
    } else {
        echo str_replace(".php", "", $currentPage);
    }
}

function generatePassword($l = 8, $c = 0, $n = 0, $s = 0) {
    // get count of all required minimum special chars
    $count = $c + $n + $s;
    $out = "";
    // sanitize inputs; should be self-explanatory
    if (!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
        trigger_error('Argument(s) not an integer', E_USER_WARNING);
        return false;
    } elseif ($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
        trigger_error('Argument(s) out of range', E_USER_WARNING);
        return false;
    } elseif ($c > $l) {
        trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($n > $l) {
        trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($s > $l) {
        trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($count > $l) {
        trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
        return false;
    }

    // all inputs clean, proceed to build password
    // change these strings if you want to include or exclude possible password characters
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $caps = strtoupper($chars);
    $nums = "0123456789";
    $syms = "!@#$%^&*()-+?";

    // build the base password of all lower-case letters
    for ($i = 0; $i < $l; $i++) {
        $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    // create arrays if special character(s) required
    if ($count) {
        // split base password to array; create special chars array
        $tmp1 = str_split($out);
        $tmp2 = array();

        // add required special character(s) to second array
        for ($i = 0; $i < $c; $i++) {
            array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
        }
        for ($i = 0; $i < $n; $i++) {
            array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
        }
        for ($i = 0; $i < $s; $i++) {
            array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
        }

        // hack off a chunk of the base password array that's as big as the special chars array
        $tmp1 = array_slice($tmp1, 0, $l - $count);
        // merge special character(s) array with base password array
        $tmp1 = array_merge($tmp1, $tmp2);
        // mix the characters up
        shuffle($tmp1);
        // convert to string for output
        $out = implode('', $tmp1);
    }

    return $out;
}

function object_to_array($object) {
    if (is_object($object)) {
        return array_map(__FUNCTION__, get_object_vars($object));
    } else if (is_array($object)) {
        return array_map(__FUNCTION__, $object);
    } else {
        return $object;
    }
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

function isAdmin($id) {
    global $database;
    $sql = "SELECT ID FROM my_realhub_users WHERE ID={$id} AND (user_role='Admin' OR user_role='SubAdmin') LIMIT 1";
    $result = $database->query($sql);
    $row = $database->fetch_array($result);
    if (isset($row['ID']) && !empty($row['ID'])) {
        return true;
    } else {
        return false;
    }
}

function isBroker($id) {
    global $database;
    $sql = "SELECT ID FROM my_realhub_users WHERE ID={$id} AND user_role='Broker' LIMIT 1";
    $result = $database->query($sql);
    $row = $database->fetch_array($result);
    if (isset($row['ID']) && !empty($row['ID'])) {
        return true;
    } else {
        return false;
    }
}

function isRealtor($id) {
    global $database;
    $sql = "SELECT ID FROM my_realhub_users WHERE ID={$id} AND (user_role='Realtor' OR user_role='SubRealtor') LIMIT 1";
    $result = $database->query($sql);
    $row = $database->fetch_array($result);
    if (isset($row['ID']) && !empty($row['ID'])) {
        return true;
    } else {
        return false;
    }
}

function admin_pages_previliges() {
    global $contactGlobalObj, $session;
    if (is_page("admin.php") || is_page("realtors.php") || is_page("realtorsettings.php") || is_page("realtorleads.php") || is_page("adminteam.php") || is_page("hubusers.php")) {
        if (!$contactGlobalObj->isIsAdmin($session->ID)) {
            redirect_JS("index.php");
            die();
        }
    }
}

function broker_pages_previliges() {
    global $contactGlobalObj, $session;
    if (is_page("mortgageprofessional.php") || is_page("brokerprofile.php") || is_page("loadrealtor.php") || is_page("realtorsteam.php") || is_page("myrealtors.php")) {
        if (!$contactGlobalObj->isIsBroker($session->ID)) {
            redirect_JS("login.php");
            die();
        }
    }
}

function realtor_pages_previliges() {
    global $contactGlobalObj, $session;
    if (is_page("AdDetail.php") || is_page("adsetreports.php") || is_page("getAds.php") || is_page("loadlisting.php") || is_page("buyerlead.php") || is_page("loadbuyer.php") || is_page("index.php") || is_page("teamsettings.php")) {
        if (!$session->is_logged_in()) { //If Not Login
            redirect_JS("login.php");
            die();
        } else {
            if (!$contactGlobalObj->isIsRealtor($session->ID)) {
                redirect_JS("login.php");
                die();
            }
        }
    }
}

function check_img_type($img_name, $img_type) {
    if ($img_name != '') {
        if ($img_type != 'image/jpeg' && $img_type != 'image/jpg' && $img_type != 'image/gif' && $img_type != 'image/png') {
            echo '<div class="form-group">
					<div class="alert alert-error" style="color:#B94A48; background:#F2DEDE; text-align:left; margin-top:20px;">
					<strong>Error!</strong> Please upload only Image file!
				</div>
				</div>';
            die();
        }
    }
}

//-------------------------------
function generate_unique_name($flieName) {
    if ($flieName != '') {
        $random_digit = rand(0000, 9999);
        $time = time();
        $ext = substr($flieName, -3);
        $newFileName = $time . '_' . $random_digit . '.' . $ext;
        return $newFileName;
    }
}

//------------------------------
function upload_image($fileName, $fileTemp, $location) {
    if ($fileName != '') {
        //Upload an Image on Server----
        return move_uploaded_file($fileTemp, $location . $fileName);
    }
}

//END OF function upload_image

function createDateRangeArray($strDateFrom, $strDateTo) {
    $aryRange = array();

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom+=86400; // add 24 hours 241200
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

function generateErrorLog($titel, $errorMessage) {
    $txtfile = 'GenerlErrorLog.txt';
    $txt = "Dated : " . date('Y-m-d H:i:s') . PHP_EOL;
    $txt .= $titel . ' -------- ' . $errorMessage . PHP_EOL;
    $txt .= '____________________________________________' . PHP_EOL;
    $fh = fopen($txtfile, 'a');
    fwrite($fh, $txt); // Write information to the file
    fclose($fh); // Close the file
}

function getActualYears() {
    $html = "";
    for ($i = date("Y"); $i < date("Y", strtotime(date("Y") . " +10 years")); $i++) {
        $html .= '<option value="' . $i . '">' . $i . '</option>';
    }
    return $html;
}

function countries_list() {
    $countries = array("AF" => "Afghanistan",
        "AX" => "Åland Islands",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo, The Democratic Republic of The",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote D'ivoire",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands (Malvinas)",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GG" => "Guernsey",
        "GN" => "Guinea",
        "GW" => "Guinea-bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard Island and Mcdonald Islands",
        "VA" => "Holy See (Vatican City State)",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran, Islamic Republic of",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IM" => "Isle of Man",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JE" => "Jersey",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "Korea, Democratic People's Republic of",
        "KR" => "Korea, Republic of",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Lao People's Democratic Republic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libyan Arab Jamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macao",
        "MK" => "Macedonia, The Former Yugoslav Republic of",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia, Federated States of",
        "MD" => "Moldova, Republic of",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "ME" => "Montenegro",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PS" => "Palestinian Territory, Occupied",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "SH" => "Saint Helena",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint Lucia",
        "PM" => "Saint Pierre and Miquelon",
        "VC" => "Saint Vincent and The Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "RS" => "Serbia",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and The South Sandwich Islands",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan, Province of China",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania, United Republic of",
        "TH" => "Thailand",
        "TL" => "Timor-leste",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "US" => "United States",
        "UM" => "United States Minor Outlying Islands",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "Viet Nam",
        "VG" => "Virgin Islands, British",
        "VI" => "Virgin Islands, U.S.",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe");
    return $countries;
}

function timeAgo($time_ago) {
    $time_ago = strtotime($time_ago);
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}
/**
 * -----------------------------------------------------------------------------------------
 * Based on `https://github.com/mecha-cms/mecha-cms/blob/master/engine/kernel/converter.php`
 * -----------------------------------------------------------------------------------------
 */
// HTML Minifier
function minify_html($input) {
    if(trim($input) === "") return $input;
    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if(strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
        }, $input);
    }
    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1\x1A>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            // Force line-break with `&#10;` or `&#xa;`
            '#&\#(?:10|xa);#',
            // Force white-space with `&#32;` or `&#x20;`
            '#&\#(?:32|x20);#',
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            "<$1$2</$1\x1A>",
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            "\n",
            ' ',
            ""
        ),
    $input);
}
// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
function minify_css($input) {
    if(trim($input) === "") return $input;
    // Force white-space(s) in `calc()`
    if(strpos($input, 'calc(') !== false) {
        $input = preg_replace_callback('#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
            return 'calc(' . preg_replace('#\s+#', "\x1A", $matches[1]) . ')';
        }, $input);
    }
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
            '#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
            '#\x1A#'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2',
            ' '
        ),
    $input);
}
// JavaScript Minifier
function minify_js($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
            // Replace `true` with `!0`
            '#(?<=return |[=:,\(\[])true\b#',
            // Replace `false` with `!1`
            '#(?<=return |[=:,\(\[])false\b#',
            // Clean up ...
            '#\s*(\/\*|\*\/)\s*#'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3',
            '!0',
            '!1',
            '$1'
        ),
    $input);
}
?>