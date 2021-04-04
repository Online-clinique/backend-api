<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("../database.php");
require_once("../query.php");
// require_once('../get_query_result.php');

$medic = new Medecine($db);

// Read all medics

$stmt = $medic->read();
$num  = $stmt->rowCount();

if ($num > 0) {
    $product_arr = array();
    $product_arr["result"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $MEDCINE_ID = $id;

        $item = array(
            "id" => intval($id),
            "username" => $username,
            "full_name" => $name . " " . $last_name,
            "ville" => $ville
        );


        // populate expertise
        $item["expertise"] = array();
        $expetise_query = "select e.val from expertise e where e.medic_id = $MEDCINE_ID";
        $tmpq = new Query($expetise_query, $db);
        [$result] = $tmpq->runQuery();

        while ($tmprow = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($tmprow);
            array_push($item["expertise"], $val);
        }

        // populate horaire

        $item["horaire"] = array();

        $horaire_query = "select h.* from horaire h where h.medic_id = $MEDCINE_ID";

        [$horaire_result] = (new Query($horaire_query, $db))->runQuery();

        while ($horaire_row = $horaire_result->fetch(PDO::FETCH_ASSOC)) {
            extract($horaire_row);

            array_push($item["horaire"], array($label => $val));
        }

        // Populate lang
        $item["lang"] = array();

        $lang_query = "select l.* from lang l where l.medic_id = $MEDCINE_ID";

        [$lang_result] = (new Query($lang_query, $db))->runQuery();

        // print_r($lang_result);

        while ($lang_row = $lang_result->fetch(PDO::FETCH_ASSOC)) {
            extract($lang_row);

            array_push($item["lang"], $val);
        }


        // echo "Counted: " . $count;


        array_push($product_arr["result"], $item);
        // echo json_encode($item);
        // echo "<img src=\"" . $photo_de_profile . "\"  alt=\"\">";
        // echo "<h1>Hello From " . $name  . "</h1>";
        // echo "<p>And my email is " .  $username . "</p>";
    }

    http_response_code(200);
    // echo query_result();
    // array_merge($product_arr["result"][0], $product_arr["result"][1]);

    // echo json_encode(
    //     array("message" => "no result")
    // );

    echo json_encode($product_arr);
} else {
    $arr = array(
        "message" => "fuck off"
    );

    for ($i = 0; $i < count($stmt->errorinfo()); $i++) {
        echo $stmt->errorinfo()[$i] . "<br/>";
    };

    // echo json_encode($arr);
    // echo json_encode($arr);
}
