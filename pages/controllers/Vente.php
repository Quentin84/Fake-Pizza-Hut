<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vente extends CI_CONTROLLER {
    public function __construct(){
        parent::__construct();
        $this->load->model('vente_model');
    }
    function index() {
            $this->liste();
            
    }
    
    function liste(){ // Liste des pizzas
        
        $data['pizzas'] = $this->vente_model->get_all();
        $data['contenu'] = 'liste_pizzas_view';
        $this->load->view('template', $data);
    }
    
//    ajouter au panier
     
    function ajout_panier(){
        
        //recupère le produit avec la methode get du model.  
        $pizza = $this->vente_model->get($this->input->post('id'));
       
        
        //renseignement des infos dans le tableau: id, qty, price, name.
        $insert= array(
                        'id' => $this->input->post('id'),
                        'qty' => $this->input->post('quantite'),
                        'price' => $pizza->prix,
                        'name' => $pizza->nom_pizza
                        );
        
        //insert dans cart
        $this->cart->insert($insert);

        redirect('vente');
    }
    function supprimer($rowid){ //Supprime la ligne du caddie
        $this->cart->remove($rowid);
        
        //        retour page vente
        redirect('vente');
    }
    
//  Mise à jour quantité
    public function update(){
        $maj = array('rowid' => $this->input->post('rowid'),
                     'qty' => $this->input->post('majqty')
                    );
        $this->cart->update($maj);
        
        //        retour page vente
        redirect('vente');
    }
    
//  Detruire le panier    
    public function destroy(){
        $this->cart->destroy();
        
        redirect('vente');
    }

// recapitulatif de la commande avant envoi
    public function recapitulatif(){
        //Si l'utilisateur est connecté
        if ($this->session->userdata('is_logged_in')){

            $data['commande'] = $this->cart->contents();
            $data['contenu'] = 'recap_commande_view';
            $this->load->view('template', $data);
        }
        else{
            redirect('login');
            
        }
        
    }

// Envoi de la commande
    public function commander(){
        if ($this->session->userdata('is_logged_in')){
            //vérifie que l'utilisateur n'est pas un admin (Admin n'est pas dans la db, commande impossible)
            if($this->session->userdata('is_admin')){
                
                $data['contenu'] = 'erreur_admin_view';
                $this->load->view('template', $data);
                
            }else{
                
                $cmd = array('user' => $this->session->userdata('pseudo'),
                             'commande' => $this->cart->contents()
                            );
                $var = $this->vente_model->new_cmd($cmd);
                if ($var == TRUE){

                    $this->cart->destroy();

                    $data['contenu'] = 'confirm_cmd_view';
                    $this->load->view('template', $data);
                }
            }
        }
        
       else{
            redirect('login');
            
        } 
    }
}