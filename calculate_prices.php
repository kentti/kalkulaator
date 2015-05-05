<?php 

require_once("/resources/config.php");
require_once("/resources/dbfunctions.php");

function calculatePrice () {
    $product = $_POST["product"]; 
    
    switch ($product) {
        case Products::Window :
            return calculateWindowPrice();
            break;
        case Products::Door :
            return calculateDoorPrice();
            break;
        case Products::Stairs :
            return calculateStairsPrice();
            break;
        default :
            return "Error: product type";
    }
    
    return 0;
}

function calculateWindowPrice () {
    $type = $_POST["type"]; 
    
    if ($type == WindowTypes::Cottage){
        return calculateCottageWindowPrice(); 
    }
    else if ($type == WindowTypes::House){
        return calculateHouseWindowPrice();
    }
    
    return "Error: window type";
}

function calculateCottageWindowPrice () {
    $opening = $_POST["window-opening"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    $unitPrice = getWindowPrice(WindowTypes::Cottage."RM");
    
    //Sissepoole avanevale suvemaja aknale lisandub ruutmeetrihinnale parameetrist tulenev summa
    if ($opening == WindowOpeningSimple::In){
        $unitPrice += getWindowPrice(WindowFrame::Single."Avanemine");
    }
    
    return json_encode($unitPrice * ($width/100) * ($height/100));
}

function calculateHouseWindowPrice () {
    $opening = $_POST["window-opening"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    $frame = $_POST["window-frame"];
    $unitPrice = 0.0;
    
    if ($frame == WindowFrame::Single) {
        $unitPrice = getWindowPrice(WindowTypes::House."1xRM");
        $glass = $_POST["window-glass"];
        
        if ($opening == WindowOpeningSimple::In)
            $unitPrice += getWindowPrice(WindowFrame::Single."Avanemine");
        if ($glass == WindowGlass::Triple)
            $unitPrice += getWindowPrice(WindowFrame::Single."Klaas");
    }
    else if ($frame == WindowFrame::Double) {
        $unitPrice = getWindowPrice(WindowTypes::House."2xRM");
        
        if ($opening == WindowOpeningDouble::InPlusIn)
            $unitPrice += getWindowPrice(WindowFrame::Double."Avanemine");
    }
    else{
        return "Error: window frame";
    }
    //TODO: piida laiusega arvestamine
    return $unitPrice * ($width/100) * ($height/100);
}

function calculateDoorPrice () {
    $variant = $_POST["door-variant"];
    $lock = $_POST["door-lock"];
    $width = $_POST["width"];
    $height = $_POST["height"];
    $unitPrice = getDoorPrice($variant."RM");
    
    //TODO: ukse jaotuse arvestamine
    
    //TODO: piida laiusega arvestamine
    return json_encode(($unitPrice * ($width/100) * ($height/100)) + getDoorPrice($lock."Lukk"));
}

function calculateStairsPrice () {
    return json_encode(0.0);
}

echo "<div class='col-xs-12'><hr><h2>Õnnestus</h2> Selle toote hind oleks <strong class='price'>". calculatePrice() ."€</strong><hr></div>";
?>