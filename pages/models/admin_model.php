<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        
    }
        

       

    public function is_admin(){ //vérifie que l'utilisateur est loggé et est un administrateur
        
        if(!empty($this->session->userdata('is_admin')) && $this->session->userdata('is_logged_in') == TRUE){
            return TRUE;
        }else{
        // Si pas admin, retour à la page login
            redirect('login');
        }
    }
    
    public function add_pizza(){
        //Insère les données de la pizza dans la db
        $data = array('nom_pizza' => $this->input->post('nom'),
                      'ingredients' => $this->input->post('ingredients'),
                      'prix' => $this->input->post('prix')
                        );
        $insert = $this->db->insert('pizza', $data);
        $id = $this->db->insert_id();
        
        // ajout de l'image au dossier assets/images
        $config = array('upload_path' => './assets/images/',
                        'allowed_types' => 'gif|jpg|png',
                        'max_size' => 2048,
                        'file_name' => $id
                                    );
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        
        //Redimensionne l'image
        $imagedata = $this->upload->data();  //retourne le chemin complet
        $imageconfig = array('source_image' => $imagedata['full_path'], 
                            'width' => 200,
                             'height' => 100
                            );
        $this->load->library('image_lib', $imageconfig);
        $this->image_lib->resize();
        
            return $insert;
    }
    
    public function delete_pizza($id){
        
        return $this->db->delete('pizza', array('PK_Pizza' => $id));
        
    }
    
    public function update_pizza($id){
        
        //mise a jour des champs à modifier
        $data = array('nom_pizza' => $this->input->post('nom'),
                      'ingredients' => $this->input->post('ingredients'),
                      'prix' => $this->input->post('prix')
                        );
        $insert = $this->db->where('PK_Pizza', $id)->update('pizza', $data);
        
            // ajout de l'image au dossier assets/images
        
            $config = array('upload_path' => './assets/images/',
                            'allowed_types' => 'gif|jpg|png',
                            'overwrite' => TRUE,  
                            'max_size' => 2048,
                            'file_name' => $id
                                        );
            $this->load->library('upload', $config);
            $this->upload->do_upload('image');

            //Redimensionne l'image
            $imagedata = $this->upload->data();  //retourne le chemin complet
            $imageconfig = array('source_image' => $imagedata['full_path'], 
                                 'overwrite' => TRUE,
                                'width' => 200,
                                 'height' => 100
                                );
            $this->load->library('image_lib', $imageconfig);
            $this->image_lib->resize();
        
        
        return true;
        
    }
}
?>