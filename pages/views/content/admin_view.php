<h2>Bienvenue Chef</h2>
<div class="row">
    <section class="col-xs-8">
        <h2>Liste des Pizzas</h2>    
           <p>
               <?= anchor('administration/ajout_pizza', '<button class="btn btn-info"><span class="glyphicon glyphicon-asterisk"></span> Nouvelle Pizza</button>'); ?>
           </p> 
           
           <!--Listage des pizzas--> 
            <?php 
                foreach($pizzas as $p): ?> 
                    <div class="col-xs-4 thumb-pizza">
                       <div class="thumbnail">
                        

                            <h3 class="caption"><?= $p->nom_pizza; ?></h3>
                            <?= img($p->PK_Pizza.'.jpg', $p->nom_pizza); ?>
                            
                            <div class="prix text-center">
                                <p><?= $p->prix; ?> €</p>
                            </div>
                            <div class="ingredients">
                                <p><?= $p->ingredients; ?></p>
                            </div>
                            <?= anchor('administration/modif_pizza/'.$p->PK_Pizza, '<button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>'); ?>
                            <?= anchor('administration/supprimer_pizza/'.$p->PK_Pizza, '<button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>'); ?>
                        </div>
                    </div>
            <?php endforeach; ?> 
    </section>
</div>