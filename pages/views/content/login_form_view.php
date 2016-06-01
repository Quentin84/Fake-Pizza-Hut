<div id="login_form" class="row">
   <div class="col-md-6 col-md-offset-3">
        <h1>Login</h1>
        <?= form_open('login/validation');?>
        <div class="form-group">
            <?= form_label('Pseudo', 'pseudo'); ?>
            <?= form_input('pseudo', '', 'placeholder="Pseudo" class="form-control"'); ?>
        </div>
        <div class="form-group">
            <?= form_label('Password', 'password'); ?>
            <?= form_password('password', '', 'placeholder="Password" class="form-control"'); ?>
        </div>
        <?= form_submit('submit', 'Login', 'class="btn btn-info"'); ?>
        <?= anchor('login/inscription', 'Inscription', 'class="btn btn-info"'); ?>  <!--Anchor permet de creer un bouton -->
        <?= form_close(); ?>
    </div>

</div>