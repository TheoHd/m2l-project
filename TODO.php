<?php

//  Revoir ClassReader pour AnnotationReader pour toutes les class possibles

// @Cascade remove,persist
// You want to save a non saved entity, please use @Cascade persist

//  revoir système upload de fichier

//    UserController
//    AdminUserController


//    revoir system upload de fichier

//    * pareil pour getForm

// Revoir method get Form dans les controllers et en statique

//    //$router->add('/changePseudo/{:id}', 'App/Controller/UserController@changePseudo', 'change_pseudo_route_id', ['id' => $router::TYPE_INT]);
//    //$router->add('/changeEmail/{:id}', 'App/Controller/UserController@changeEmail', 'change_email_route_id', ['id' => $router::TYPE_INT]);
//    //$router->add('/changePassword/{:id}', 'App/Controller/UserController@changePassword', 'change_password_route_id', ['id' => $router::TYPE_INT]);
//    //$router->add('/forgotPassword/{:id}', 'App/Controller/UserController@forgotPassword', 'change_password_route_id', ['id' => $router::TYPE_INT]);

// method appelé lors de la suppresion d'un element pour supprimer un fichier par exemple

// systeme de profiler

//mapped by / onetomany , manytoone , manytomany, onetoone

// TODO : getClassName() -> Utils:: ? -> obj ou name / option pour juste nom ou tout le namespace
// TODO : method retourne nom bundle

// TODO : Services (fonction php qui peut être accesible partout) -> include de fichier ?
// TODO : annotations routes