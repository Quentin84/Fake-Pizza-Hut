<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class vente_model extends CI_Model {
    public function __construct(){
        parent::__construct();

    }
    function get_all(){ //renvoie toutes les pizzas dans un array
        
        $results = $this->db->get('pizza')
                    ->result();
        
        return $results;
        
    }
    function get($id) { //recupère un element id dans la db
            
            $results = $this->db->get_where('pizza', array('PK_Pizza' => $id))
                ->result();
//            recupère premier resultat
            $result = $results[0];
            

            return $result;
        }
    
    function new_cmd($cmd){
        
        $user = $this->db->get_where('mangeur', array('pseudo_mangeur' => $cmd['user']))
                        ->row();
        
        $commande = $cmd['commande'];
                
        // insère la commande et recupère PK_commande
        
        $this->db->insert('commande', array('FK_mangeur' => $user->PK_mangeur));
        $numcmd = $this->db->insert_id();
        
        // insère les données dans le détail de la commande
        
        foreach($commande as $article){
            
            $pizza = $this->db->select('PK_Pizza')->get_where('pizza', array('nom_pizza' => $article['name']))
                    ->row();
            
            $row = array('FK_cmd' => $numcmd,
                         'FK_pizza' => $pizza->PK_Pizza,
                         'quantite' => $article['qty']
                        );
            
            $this->db->insert('detail_cmd', $row);
        }
    return TRUE;    
    }
}
?>