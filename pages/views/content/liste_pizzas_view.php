<?php 
    if(!empty($message)){
        echo '<p>'.$message.'</p>';
    }
?>
<div class="row">
    <section class="col-xs-8">
        <h2>Liste des Pizzas</h2>      
            <?php 
                foreach($pizzas as $p): ?> <!--Listage des pizzas-->
                    <div class="col-xs-4 thumb-pizza">
                       <div class="thumbnail">
                            <h3 class="caption"><?= $p->nom_pizza; ?></h3>
                                <?= img($p->PK_Pizza.'.jpg', $p->nom_pizza); ?>
                            
                            <div class="prix text-center">
                                <p><?= $p->prix; ?><span class="glyphicon glyphicon-euro"></span></p>
                            </div>
                            <div class="ingredients">
                                <p><?= $p->ingredients; ?></p>
                            </div>
                            <!--//ouverture du formulaire pour changer la quantité-->
                            <?= form_open('vente/ajout_panier', array('class' => 'form-inline')); ?>
                               <div class="form-group">
                                   <label class="sr-only" for="quantite">quantite</label>
                                    <input type="number" class="form-control" style="width: 6rem;" value="1" name="quantite">
                                    <?= form_hidden('id', $p->PK_Pizza); ?>
                               </div>
                                <button type="submit" class="btn btn-info">
                                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Ajouter
                                </button>
                               
                            <?= form_close(); ?>
                        </div>
                    </div>
                    
            <?php endforeach; ?> 
    </section>
    <!--    Affichage du caddie si existe-->
      
        <?php if($caddie = $this->cart->contents()): ?>

    <aside id="caddie" class="col-xs-4">
        <table class="table table-striped">
            <caption>Votre commande</caption>


                <thead>
                    <tr>
                        <th>Qté</th>
                        <th>Nom</th>
                        <th>Prix</th>
                    </tr>
                </thead>
    <!--                parcours le caddie -->
                <?php foreach ($caddie as $article): ?>
                    <tr>
                        <td> <?= form_open('vente/update', array('class' => 'form-inline')); ?>
                            <?= form_hidden ('rowid', $article['rowid']); ?>
                            <label for="majqty" class="sr-only">Quantité</label>
                            <input type="number" class="form-control" style="width: 5rem" name="majqty" value="<?= $article['qty']; ?>">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span></button>
                            <?= anchor('vente/supprimer/'.$article['rowid'], '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'); ?>
                            <?= form_close(); ?>
                            
                        </td>
                        <td><?= $article['name']; ?></td>
                        <td><?= $article['subtotal'] ?> €</td>
                        
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tfoot>
                    <tr class="total">
                        <td colspan="2">Total</td>
                        <td><?= $this->cart->total(); ?> €</td>
                    </tr>
                </tfoot>
            </table>
            <?= anchor('vente/recapitulatif', '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-bullhorn"></span> Pronto !</button>'); ?>
            <?= anchor('vente/destroy', '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Annuler</button>'); ?>
        </aside>
        <?php endif; ?>
    </div> <!--fin de row-->
