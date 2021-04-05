<?php

namespace App\Http\Controllers;
require_once __DIR__ . "/signJwt.php";
use Illuminate\Http\Request;

class MedecineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function getOne(Request $req, $id) {
        // header('Content-Type: application/json');
        $db = app("db");
        $tmp_result = $db->select("select m.* from medic m where m.id = " . $id);

        
        if ($tmp_result) {
            $response = (array) $tmp_result[0];
            
            // Populate tarifs
            $response["tarifs"] = $db->select("select t.price, t.label from tarifs t where t.medic_id = " . $response["id"]);
            
            
            // Populate lang
            $language = $db->select("select l.val from lang l where l.medic_id = " . $response["id"]);
            $response["language"] = array();
            
            foreach ($language as $lang) {
                array_push($response["language"], $lang->val);
            }
            
            // Populate horaire
            $response["horaire"] = $db->select("select h.label, h.val from horaire h where h.medic_id = " . $response["id"]);
            
            
            // Populate expertise
            $expertise = $db->select("select e.* from expertise e where e.medic_id = " . $response["id"]);
            $response["expertise"] = array();
            
            foreach ($expertise as $exper) {
                array_push($response["expertise"], $exper->val);
            }
            
            // Populate diplome
            $diplome = $db->select("select d.* from diplome d where d.medic_id = " . $response["id"]);
            $response["diplome"] = array();
            
            foreach ($diplome as $diplo) {
                array_push($response["diplome"], [
                    "date" => $diplo->dat_val,
                    "valeur" => $diplo->title
                    ]);
                }
                
                
                // Populate contact
                $response["contact"] = $db->select("select c.label, c.val from Contacts c where c.medic_id = " . $response["id"]);
                
                
                return response(json_encode($response))->header("Content-Type", "application/json")->header('Access-Control-Allow-Origin', '*')->header("charset", "UTF-8");
            } else {
                return response(json_encode(["message" => "nothing found"]))->header("Content-Type", "application/json");
                
            }
        }
        
        //
    }
    