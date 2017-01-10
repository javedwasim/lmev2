<?php
include_once('simple_html_dom.php');
global $url;
$url = isset($_REQUEST['url'])?$_REQUEST['url']:"https://spreedly.com/";
$html = file_get_html($url);

function manageHTML($element) {
    global $url;
    //----------------------------------REMOVE FORM Header And Footer Tag data
    if ($element->tag=='header' || $element->tag=='footer'){
        $element->outertext = '';
    }
    //---------------------------------Remove Nav
    if ($element->tag=='nav'){
        $element->outertext = '';
    }
    //----------------------------------REMOVE FORM ELEMENT
    if ($element->tag=='input' || $element->tag=='textarea' || $element->tag=='button' || $element->tag=='header' || $element->tag=='footer'){
        $element->outertext = '';
    }
    //----------------------------------Set Absolute URL
    if ($element->tag=='link'){
        if (strpos($element->href, 'http') !== false) { // if already contain ULR
            $element->href = $element->href;
        }else{
            $element->href = $url.$element->href;
        }

    }
    if ($element->tag=='img' || $element->tag=='script'){
       if (strpos($element->src, 'http') !== false) { // if already contain ULR
            $element->src = $element->src;
        }else{
            $element->src = $url.$element->src;
        }
    }

    if($element->tag=='div' || $element->tag=='section'){
        //--------------------REMOVE Div data that Contain Header and Footer
        if($element->class=='footer' || $element->class=='header' || $element->id=='footer' || $element->id=='header'){
            $element->outertext = '';
        }
        if (strpos($element->class, 'footer') !== false || strpos($element->class, 'header') !== false || strpos($element->id, 'footer') !== false || strpos($element->id, 'header') !== false) {
            $element->outertext = '';
        }
        //Remove Nav
        if (strpos($element->class, 'nav') !== false || strpos($element->id, 'nav') !== false) {
            $element->outertext = '';
        }

    }
}
$html->set_callback('manageHTML');
echo $html;
