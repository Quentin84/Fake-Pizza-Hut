<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Clients_model extends CI_Model {
        public function __construct(){
            parent::__construct();
            
        }
        
        public function get(){
            
        }
        
        public function validation(){
        
                //requête sur la db dans la table mangeur
            $this->db->where('pseudo_mangeur', $this->input->post('pseudo'));
            $this->db->where('password_mangeur', $this->input->post('password'));  // md5($this->input->post('password')
            $query = $this->db->get('mangeur');
            
            if($query->num_rows() == 1){ // si le nombre de lignes correspondantes est == 1, renvoie TRUE
                
                return true;
            }
        }
        
        public function ajoute_mangeur(){
            //recuperation des champs du formulaire
            $data = array(
                        'nom_mangeur' => $this->input->post('nom'),
                        'pseudo_mangeur' => $this->input->post('pseudo'),
                        'password_mangeur' => $this->input->post('password'), // pour crypter le mot de passe, normalement on aurait du utiliser md5($this->input->post('password').  Ou mieux, SHA()
            
            );
            // Et insertion dans la table "mangeur"
            $insert = $this->db->insert('mangeur', $data);
            return $insert;
            
        }
        
        
        
}
?>