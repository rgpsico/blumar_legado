<?php

$currDirPos = "/var/www/wwwinternet/bancoimagemfotos/comercial";

function createCats($currDirPos, $level=1){
    $result = [];

    if(is_dir($currDirPos)){
        foreach (scandir($currDirPos) as $subDir) {
            // do not take ./ ../ or own script-name into consideration
            if($subDir=="."||$subDir==".."||$subDir==basename(__FILE__))continue;
            $entry = ["name"=>$subDir,"level"=>$level];
            if(is_dir($currDirPos."/".$subDir)){
                $entry["children"] = createCats($currDirPos."/".$subDir,$level+1);
            }
            $result[] = $entry;
        }
    }

    return $result;
}

function createXMLOutOfCatArray($cats){
    $xml = "<list>";
    function reduceToItemEntities($parent){
        $output = "";
        if(isset($parent["children"])){
            foreach ($parent["children"] as $listItem) {
                $output .= "<l".$listItem["level"].">".$listItem["name"]."</l".$listItem["level"].">";
                $output .= reduceToItemEntities($listItem);
            }
        }
        return $output;
    }
    foreach ($cats as $cat) {
        $xml .= "<cat>";
        $xml .= "<l".$cat["level"].">".$cat["name"]."</l".$cat["level"].">";
        $xml .= reduceToItemEntities($cat);
        $xml .= "</cat>";
    }
    return $xml."</list>";
}
$xml->formatOutput=true;
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . createXMLOutOfCatArray(createCats($currDirPos));
?>
