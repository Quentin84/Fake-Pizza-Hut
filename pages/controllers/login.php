<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_CONTROLLER {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Clients_model');
        
    }
    function index() {
        
            //affiche le formulaire de login
        
        $data['contenu'] = 'login_form_view';
        $this->load->view('template', $data);
    }
    
    function validation() {
        
        $query = $this->Clients_model->validation();
        if($query){ //si validation est true
            
            $data = array( //recupereation du username et nouvelle variable is_logged_in 
                    'pseudo' => $this->input->post('pseudo'),
                    'is_logged_in' => TRUE,
                    'is_admin' => FALSE
            
                            );
            $this->session->set_userdata($data); //envoi du tableau $data dans la variable SESSION
            redirect('vente'); //redirection vers "vente"
            
        }elseif($this->input->post('pseudo')=='Admin' && $this->input->post('password') == 'pass'){
            $data = array( //recupereation du username et nouvelle variable is_logged_in 
                    'pseudo' => $this->input->post('pseudo'),
                    'is_logged_in' => TRUE,
                    'is_admin' => TRUE
                            );
            
            $this->session->set_userdata($data); //envoi du tableau $data dans la variable SESSION
            redirect('administration');
            
        }else{
            
            $this->index();
        }
    }
    function inscription(){
        $data['contenu'] = 'inscription_form_view';
        $this->load->view('template', $data);
        }
        
    function nouveau_mangeur(){
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required'); //parametrage regles de la validaiton
        $this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required|min_length[4]'); //parametrage regles de la validaiton
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[12]'); //parametrage regles de la validaiton
        $this->form_validation->set_rules('confirm', 'confrim', 'trim|required|matches[password]'); //parametrage regles de la validaiton
        
        if($this->form_validation->run() == FALSE){ // si la validation echoue, redirection vers inscription
            
            $this->inscription();
        }else{ //Sinon appel du modele ajoute_mangeur
            if($query = $this->Clients_model->ajoute_mangeur()){
                
                $data['contenu']= 'inscription_ok_view';
                $this->load->view('template', $data);
            
                
            }else{
                
                $this->validation();
                
            }
        }
    }
    
    // Deconnexion
    function deconnexion(){
        
        $this->session->sess_destroy();
        redirect('');
    }
}