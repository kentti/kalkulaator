<?php 

require_once("/resources/config.php");

$product = $_POST["product"]; 
$type = $_POST["type"]; 

switch ($product) {
    
    case Products::Window :
        echo getWindowFields($type);
        break;
    case Products::Door :
        echo getDoorFields($type);
        break;
    case Products::Stairs :
        echo getStairsFields();
        break;
}

function createFormRow($label, $html, $additional = "", $labeladditional = ""){
    return
    "<div class='row form-group' ".$additional.">
        <div class='col-xs-12 col-md-3 priceform-lbl '". $labeladditional .">
            ".$label."
        </div>
        <div class='col-xs-12 col-md-9'>
            <div class='transp-container'>
                ".$html."
            </div>
        </div>
    </div>";
}

function radioButton($name, $value, $label, $additional = ""){
    return "<span class='radio-item'><input type='radio' name='" . $name . "' value='" . $value . "'" . $additional . "> " . label($label) . "</span>";
}

function textBox($name, $placeholder = ""){
    return "<input type='text' placeholder='" . $placeholder . "' name='" . $name . "'>";
}

function checkBox($name, $label){
    return "<input type='checkbox' name='". $name . "'>" . $label;
}

function label($text, $additional = ""){
    return "<label " . $additional . ">" . $text . "</label>";
}

function getWindowFields($type){
    $frameHtml = ""; 
    $openingHtml = "";
    $glassHtml = "";
    
    if ($type == WindowTypes::Cottage) {
        $frameHtml = createFormRow("RAAM", radioButton("window-frame", WindowFrame::Single, "Ühekordne", "checked"));
        
        $openingHtml = createFormRow("AVANEMINE",
                                   radioButton("window-opening", WindowOpeningSimple::In, "Sisse")  
                                   .radioButton("window-opening", WindowOpeningSimple::Out, "Välja"));
        
        $glassHtml = createFormRow("KLAAS", radioButton("window-glass", WindowGlass::Double, "2x klaaspakett", "checked"));
        
    }
    else if ($type == WindowTypes::House){
        $frameHtml = createFormRow("RAAM",
                                 radioButton("window-frame", WindowFrame::Single, "Ühekordne")
                                 .radioButton("window-frame", WindowFrame::Double, "Kahekordne"), "id='js-window-frame'");
                                 
        $openingHtml = createFormRow("AVANEMINE",
                                   radioButton("window-opening", WindowOpeningSimple::In, "Sisse")  
                                   .radioButton("window-opening", WindowOpeningSimple::Out, "Välja"), "id='js-window-opening-single' style='display:none;'")
                       .createFormRow("AVANEMINE",
                                   radioButton("window-opening", WindowOpeningDouble::InPlusIn, "Sisse + sisse")  
                                   .radioButton("window-opening", WindowOpeningDouble::InPlusOut, "Sisse + välja"), "id='js-window-opening-double' style='display:none;'");
                                 
        $glassHtml = createFormRow("KLAAS",
                                 radioButton("window-glass", WindowGlass::Double, "2x klaaspakett")
                                 .radioButton("window-glass", WindowGlass::Triple, "3x klaaspakett"), "id='js-window-glass-single' style='display:none;'")
                     .createFormRow("KLAAS", 
                                 radioButton("window-glass", WindowGlass::DoublePlusSingle, "2x klaaspakett + tavaline klaas", "checked disabled")
                                 , "id='js-window-glass-double'  style='display:none;'");

    }
    else{
        return "";
    }
                                
    $widthHtml = createFormRow("LAIUS", textBox("width", "Sisesta akna laius(cm)"));
    $heightHtml = createFormRow("KÕRGUS", textBox("height", "Sisesta akna kõrgus(cm)"));
    $jambWidthHtml = createFormRow("PIIDA LAIUS", textBox("jamb", "Sisesta akna piida laius(cm) - vaikimisi 25"));
    
    return $frameHtml . $openingHtml . $glassHtml . $widthHtml . $heightHtml . $jambWidthHtml;
}

function getDoorFields($type){
    $variantHtml = "";
    
    if ($type == DoorTypes::Internal){
        $variantHtml = createFormRow("VARIANT",
                                  radioButton("door-variant", DoorVariant::Panel, "Tahveluks")
                                  .radioButton("door-variant", DoorVariant::Glass, "Klaasuks"));
    }
    else if ($type == DoorTypes::External){
        $variantHtml = createFormRow("VARIANT",
                                  radioButton("door-variant", DoorVariant::Plank, "Lauduks")
                                  .radioButton("door-variant", DoorVariant::InsulatedPanel, "Soojustatud tahveluks")
                                  .radioButton("door-variant", DoorVariant::Thick, "Paksem uks"));
    }
    else{
        return "";
    }
    
    $divisionHtml = createFormRow("TAHVLITE JAOTUS",
                                   textBox("door-division-no", "Sisesta ukse tahvlite/klaaside arv - vaikimisi 2")
                                   ,"", "id='door-division-lbl'")
                                   .createFormRow("ÜLEMINE TAHVEL KLAASIGA", checkBox("door-division-upper-curve", "Ülemine kaarega"));
    $lockHtml = createFormRow("LUKK",
                               radioButton("door-lock", DoorLock::Cheap, "Valnes")       
                               .radioButton("door-lock", DoorLock::MidRange, "ASSA analoog")       
                               .radioButton("door-lock", DoorLock::Expensive, "ASSA originaal"));   
    
    $widthHtml = createFormRow("LAIUS", textBox("width", "Sisesta ukse laius(cm)"));
    $heightHtml = createFormRow("KÕRGUS", textBox("height", "Sisesta ukse kõrgus(cm)"));
    $jambWidthHtml = createFormRow("PIIDA LAIUS", textBox("jamb", "Sisesta ukse piida laius(cm) - vaikimisi 25"));
    
    return $variantHtml . $divisionHtml . $lockHtml . $widthHtml . $heightHtml . $jambWidthHtml;
}

function getStairsFields(){
    $stepTypeHtml = createFormRow("ASTME TÜÜP",
                               radioButton("stairs-step-type", StepType::Open, "Avatud")
                               .radioButton("stairs-step-type", StepType::Closed, "Suletud"));
    
    $borderHtml = createFormRow("ÜLEMISE PIIRDE PIKKUS", textBox("stairs-top-border", "Sisesta ülemise piirde pikkus(cm) - vaikimisi piiret ei arvestata"));
    $heightHtml = createFormRow("KÕRGUS", textBox("stairs-height", "Sisesta trepi kõrgus(cm)"));
    
    return $stepTypeHtml . $borderHtml . $heightHtml;
}
    
?>