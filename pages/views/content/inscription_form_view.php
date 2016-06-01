<div id="inscription" class="row">
   <div class="col-md-6 col-md-offset-3">
        <h1>Création d'un compte</h1>
        <?= form_open('/login/nouveau_mangeur'); ?>
        <fieldset class="form-group">
          <legend> Informations personnelles</legend>
               <?= form_label('Entrez votre nom', 'nom'); ?>
                <?= form_input('nom', set_value('nom'), 'class="form-control" placeholder="Nom"') ?>


        </fieldset>
        <fieldset class="form-group">
            <legend>Informations de connexion</legend>
            <?= form_label('Choisissez un pseudo'); ?>
            <?= form_input('pseudo', set_value('pseudo'), 'class="form-control" placeholder="Pseudo"'); ?>
            <?= form_label('Choisissez un password', 'password'); ?>
            <?= form_password('password', set_value('password'), 'class="form-control" placeholder="Password"'); ?> 

            <label for="confirm">Confirmez le password </label>
            <?= form_password('confirm', set_value('confirm'), 'class="form-control" placeholder="Password"'); ?>
        </fieldset>
    <?= form_submit('submit', 'Créer le compte', 'class="btn btn-info"'); ?>
    <?= validation_errors('<p class="alert alert-danger">'); ?>
    <?= form_close(); ?>
    </div>
    
</div>