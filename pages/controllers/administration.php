<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class administration extends CI_CONTROLLER {
    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('vente_model');
    }
    function index(){
        if($this->admin_model->is_admin()){
            
            $data['pizzas'] = $this->vente_model->get_all(); //récupère toutes les pizzas 
            $data['contenu'] = 'admin_view';
            $this->load->view('template', $data);
        }
    }
    function ajout_pizza(){
        if($this->admin_model->is_admin()){
            
            $data['contenu'] = 'ajout_pizza_view';
            $this->load->view('template', $data);
        }
    }
    function nouvelle_pizza(){
        if($this->admin_model->is_admin()== FALSE){
            redirect('login');
        }else{
            $this->form_validation->set_rules('nom', 'Nom', 'trim|required');
            $this->form_validation->set_rules('ingredients', 'ingredients', 'trim|required');
            $this->form_validation->set_rules('prix', 'Prix', 'trim|required');

            if($this->form_validation->run() == FALSE){
                $data['contenu'] = 'ajout_pizza_view';
                $this->load->view('template', $data);
            }else{

                if($this->admin_model->add_pizza()){

                    //chargement de la vue
                    $data['contenu'] = 'ajout_pizza_ok_view';
                    $this->load->view('template', $data);
                    
                }
            }
        }
    }
    function supprimer_pizza($id){
        if($this->admin_model->is_admin()== FALSE){ //vérification est un admin
            redirect('login');
        }else{
            $this->admin_model->delete_pizza($id);
            redirect ('administration');
        }
        
    }
    function modif_pizza($id){
        if($this->admin_model->is_admin()== FALSE){ //vérification est un admin
            redirect('login');
        }else{
            
            $data['pizza'] = $this->vente_model->get($id);
            $data['contenu']= 'modif_pizza_view';
            $this->load->view('template', $data);
        }
    }
    function maj_pizza($id){
        if($this->admin_model->is_admin()== FALSE){ //vérification est un admin
            redirect('login');
        }else{
            
            $this->form_validation->set_rules('nom', 'Nom', 'trim|required');
            $this->form_validation->set_rules('ingredients', 'ingredients', 'trim|required');
            $this->form_validation->set_rules('prix', 'Prix', 'trim|required');

            if($this->form_validation->run() == FALSE){
                $data['contenu'] = 'modif_pizza_view';
                $this->load->view('template', $data);
            }else{

                if($this->admin_model->update_pizza($id)){

                    $data['contenu'] = 'modif_pizza_ok_view';
                    $this->load->view('template', $data);
                }
            }
            
        }
        
        
    }
    
    
    
}
?>