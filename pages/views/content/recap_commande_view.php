
<?php
    if(!empty($commande)): ?>
       
       <div id="caddie" class="row">
           <div class="col-md-12">
           <table  class="table table-striped">
                <caption>Récapitulatif de votre commande</caption>


                <thead>
                    <tr>
                        <th>Quantité</th>
                        <th>Nom</th>
                        <th>Prix</th>
                    </tr>
                </thead>
    <!--                parcours le caddie -->
                <?php foreach ($commande as $article): ?>
                    <tr>
                        <td> 
                            <?= form_open('vente/update', 'class="form-inline"'); ?>
                            <?= form_hidden ('rowid', $article['rowid']); ?>
                            <div class="form-group">
                                <label for="majqty" class="sr-only">Quantité</label>
                                <input type="number" name="majqty" value="<?= $article['qty']; ?>" class="form-control" style="width: 7rem;">
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span></button>
                                <?= anchor('vente/supprimer/'.$article['rowid'], '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'); ?>
                            </div>
                            <?= form_close(); ?>
                        </td>
                        <td><?= $article['name']; ?></td>
                        <td><?= $article['subtotal'] ?> €</td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
                <tfoot>
                    <tr class="total">
                        <td colspan="2">Total</td>
                        <td><?= $this->cart->total(); ?> €</td>
                    </tr>
                </tfoot>
            </table>
            <?= anchor('vente/commander', '<button type=button class="btn btn-info"><span class="glyphicon glyphicon-cutlery"></span> Commander</button>'); ?>
             <?= anchor('vente/destroy', '<button type=button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Annuler</button>'); ?>
        </div>
    </div>
    
    <?php else: ?>
    <div id="caddievide">
        
        <h3>Que puis-je vous servir?</h3>
        <?= anchor('vente', 'Voir la carte'); ?>
        
    </div>
   
<?php endif; ?>
    
    
    
    