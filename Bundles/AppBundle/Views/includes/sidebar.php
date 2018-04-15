<?php use Bundles\AppBundle\Controller\ProfilController;
use Core\Utils\Utils; ?>
<div class="desktop-menu menu-side-w color-scheme-dark">
<div class="logo-w">
  <a class="logo" href="<?= BASE_URL ?>"><img src="<?= App::getRessource('appBundle:images:logo.png') ?>"><span>Maison des ligues de Lorraine</span></a>
</div>
<div class="menu-and-user">
  <div class="logged-user-w">
    <div class="avatar-w">
      <img alt="" src="<?= App::getRessource('appBundle:images:avatar1.jpg') ?>">
    </div>
    <div class="logged-user-info-w">
      <div class="logged-user-name">
        <?= App::getUser()->getNom() ?>
      </div>
      <div class="logged-user-role">
        <?= ProfilController::getRole(App::getUser()) ?>
      </div>
    </div>
  </div>
  <ul class="main-menu">
    <li class="">
      <a href="<?= BASE_URL ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-window-content"></div>
        </div>
        <span>Accueil</span></a>
    </li>
    <li class="">
      <a href="<?= App::generateUrl('showProfil'); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-user-male-circle"></div>
        </div>
        <span>Mon Profil</span></a>
    </li>
    <li class="">
      <a href="<?= App::generateUrl('list_formations'); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-delivery-box-2"></div>
        </div>
        <span>Formations</span>
      </a>
    </li>
    <li class="">
      <a href="<?= App::generateUrl('history'); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-newspaper"></div>
        </div>
        <span>Historique</span></a>
    </li>
    <li class="">
      <a href="<?= App::generateUrl('messagerie'); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-tasks-checked"></div>
        </div>
        <span>Messagerie</span></a>
    </li>
    <li class="">
      <a href="<?= App::generateUrl('contact'); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-grid-squares"></div>
        </div>
        <span>Contact</span></a>
    </li>
    <br>
    <br>
      <?php if(App::getUser()->hasRole('ROLE_CHEF') and !App::getUser()->hasRole('ROLE_ADMIN')) : ?>
    <li class="has-sub-menu">
      <a href="<?= App::generateUrl(''); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-hierarchy-structure-2"></div>
        </div>
        <span>Accès Chef</span>
      </a>
      <ul class="sub-menu">
        <li><a href="<?= App::generateUrl('gestion_equipe') ?>">Gérer mon équipe</a></li>
        <li><a href="<?= App::generateUrl('gestion_demand') ?>">Gérer les demandes</a></li>
      </ul>
    </li>
      <?php endif; ?>
      <?php if(App::getUser()->hasRole('ROLE_ADMIN')) : ?>
    <li class="has-sub-menu">
      <a href="<?= App::generateUrl(''); ?>">
        <div class="icon-w">
          <div class="os-icon os-icon-robot-1"></div>
        </div>
        <span>Accès Admin</span>
      </a>
      <ul class="sub-menu">
          <li><a href="<?= App::generateUrl('gestion_demand') ?>">Gérer les demandes</a></li>
        <li><a href="<?= App::generateUrl('list_equipes') ?>">Gestion des équipes</a></li>
        <li><a href="<?= App::generateUrl('list_membres') ?>">Gestion des membres</a></li>
        <li><a href="<?= App::generateUrl('list_cadres') ?>">Gestion de chefs</a></li>
        <li><a href="<?= App::generateUrl('list_prestataires') ?>">Gestion des prestataires</a></li>
        <li><a href="<?= App::generateUrl('manage_formations') ?>">Gestion des formations</a></li>
      </ul>
    </li>
      <?php endif; ?>
      <br><br>
      <li class="">
          <a href="<?= App::generateUrl('logout'); ?>">
              <div class="icon-w">
                  <div class="os-icon os-icon-signs-11"></div>
              </div>
              <span>Déconnexion</span></a>
      </li>
  </ul>
</div>
    <div style="position: absolute; bottom: 10px; left: 0; right: 0; text-align: center;">
        <small>Dernière connexion le <b style="color:white;"><?= Utils::format_date(App::getAuthentification()->refresh()->getLastCo(), 6) ?></b>.</small>
    </div>
</div>