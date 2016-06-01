<nav class="navbar navbar-inverse">
   <a class="navbar-brand" href="<?= site_url(); ?>">Pizza Hut</a>
   <div class="container">
    <ul class="nav navbar-nav">
        <?php if($this->session->userdata('is_logged_in')):?>
            <li><?= anchor('/login/deconnexion', '<span class="glyphicon glyphicon-off"></span> Se déconnecter'); ?></li>
        <?php else: ?>
            <li><?= anchor('/login/', '<span class="glyphicon glyphicon-user"></span> Se connecter'); ?></li>
        <?php endif; ?>
           <li><?= anchor('/vente', 'Les Pizzas'); ?></li>
        </ul>
    </div>
</nav>
<div class="container" id="wrap">