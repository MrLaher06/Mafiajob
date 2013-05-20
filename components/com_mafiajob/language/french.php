<?php
/**
* @version $Id: fr.php,v 5 01/04/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );



/*
**	./class/bot.class.php
*/

define( '_BOT_HUMEUR_1', 'Un peu tendu' );
define( '_BOT_HUMEUR_2', 'Ennerv&eacute;' );
define( '_BOT_HUMEUR_3', 'Des envies de meurtre' );
define( '_BOT_HUMEUR_4', 'Tranquille' );


/*
**	./class/plusieurs.class.php
*/

define( '_PLUSIEURS_ROLE_1', 'Organisateur' );
define( '_PLUSIEURS_ROLE_2', 'Participant' );

define( '_PLUSIEURS_TYPE_1', 'Joueur' );
define( '_PLUSIEURS_TYPE_2', 'Etablissement' );
define( '_PLUSIEURS_TYPE_3', 'Habitant' );



/*
**	./class/mission.class.php
*/

define( '_TYPE_MISSION_1', 'Tu dois revenir nous voir avec un score attaque supérieur ou égal à : %a attaques' );
define( '_TYPE_MISSION_2', 'Tu dois revenir nous voir avec un score de stupéfiant supérieur ou égal à : %a ventes de stupéfiants' );
define( '_TYPE_MISSION_3', 'Tu dois revenir nous voir avec une expérience supérieur ou égal à : %a pts d\'expérience' );
define( '_TYPE_MISSION_4', 'Tu dois revenir nous voir avec un score de vole d\'arme supérieur ou égal à : %a armes' );
define( '_TYPE_MISSION_5', 'Tu dois revenir nous voir avec un score de vole de voiture supérieur ou égal à : %a voitures' );

define( '_MISSION_NIVEAU_1', 'Ta mission est de niveau facile' );
define( '_MISSION_NIVEAU_2', 'Ta mission est de niveau normal' );
define( '_MISSION_NIVEAU_3', 'Ta mission est de niveau difficile' );
define( '_MISSION_NIVEAU_4', 'Ta mission est de niveau extrème' );

define( '_INFO_TYPE_MISSION_1', '%a Pour réussir ta mission, tu dois avoir un score attaque supérieur à : %b attaques.<br /> Actuellement tu as un score de : %c pt(s)' );
define( '_INFO_TYPE_MISSION_2', '%a Pour réussir ta mission, tu dois avoir un score de stupéfiant supérieur à : %b ventes de stupéfiants.<br /> Actuellement tu as un score de : %c vente(s)' );
define( '_INFO_TYPE_MISSION_3', '%a Pour réussir ta mission, tu dois avoir une expérience supérieur à : %b pts d\'expérience.<br /> Actuellement tu as un score de : %c pt(s) d\'expérience' );
define( '_INFO_TYPE_MISSION_4', '%a Pour réussir ta mission, tu dois avoir un score de vole d\'arme supérieur à : %b armes.<br /> Actuellement tu as un score de : %c vole(s)' );
define( '_INFO_TYPE_MISSION_5', '%a Pour réussir ta mission, tu dois avoir un score de vole de voiture supérieur à : %b voitures.<br /> Actuellement tu as un score de : %c vole(s)' );


/*
**	./class/territoire.class.php
*/

define( '_POSITION_TERRITOIRE', 'X' );
define( '_TITRE_TERRITOIRE', 'Carte représentant le territoire de chaques équipes' );
define( '_INFO_BULLE_TERRITOIRE', 'Territoire des : <b>%a</b><br />Victoire de : %b<br />A : %c' );
define( '_MASQUE_INFO_TERRITOIRE', 'Afficher / Masquer les informations de la carte' );
define( '_LEGENDE_EQUIPE_TERRITOIRE', 'L&eacute;gende des équipes' );


/*
**	./class/carte.class.php
*/

define( '_DEPLACEMENT_CARTE', 'D&eacute;placement :' );
define( '_JOUEUR_CARTE', 'Joueur(s) :' );
define( '_HABITANT_CARTE', 'Habitant(s) :' );
define( '_BATIMENT_CARTE', 'Batiment(s) :' );


/*
**	./class/historique.class.php
*/

define( '_HISTORIQUE_1', 'D&eacute;placement du personnage' );
define( '_HISTORIQUE_2', 'Pr&eacute;paration braquage &eacute;tablissement' );
define( '_HISTORIQUE_3', 'Achat &eacute;tablissement' );
define( '_HISTORIQUE_4', 'Vente &eacute;tablissement' );
define( '_HISTORIQUE_5', 'Achat arme' );
define( '_HISTORIQUE_6', 'Vente arme' );
define( '_HISTORIQUE_7', 'Achat v&eacute;hicule' );
define( '_HISTORIQUE_8', 'Vente v&eacute;hicule' );
define( '_HISTORIQUE_9', 'Mise en planque du personnage' );
define( '_HISTORIQUE_10', 'Le personnage est sorti de sa planque' );
define( '_HISTORIQUE_11', 'Le personnage a fait un achat de drogue' );
define( '_HISTORIQUE_12', 'Pr&eacute;paration d\une attaque contre un habitant' );
define( '_HISTORIQUE_13', 'Pr&eacute;paration d\une attaque contre un autre joueur' );
define( '_HISTORIQUE_14', 'Un virement bancaire a &eacute;t&eacute; effectu&eacute;' );
define( '_HISTORIQUE_15', 'Un retrait bancaire a &eacute;t&eacute; effectu&eacute;' );
define( '_HISTORIQUE_16', 'Obtention de faux papiers pour ton personnage' );
define( '_HISTORIQUE_17', 'D&eacute;pot d\'un v&eacute;hicule au parking' );
define( '_HISTORIQUE_18', 'R&eacute;cup&eacute;ration d\'un v&eacute;hicule au parking' );
define( '_HISTORIQUE_19', 'Achat  d\'un v&eacute;hicule d\'occassion au parking' );
define( '_HISTORIQUE_20', 'Traverser d\'un tunnel' );
define( '_HISTORIQUE_21', 'Vole d\'argent contre un habitant' );
define( '_HISTORIQUE_22', 'Vole d\'arme contre un habitant' );
define( '_HISTORIQUE_23', 'Un habitant vient de d&eacute;poser ton personnage en voiture' );
define( '_HISTORIQUE_24', 'Discution avec un habitant' );
define( '_HISTORIQUE_25', 'R&eacute;cup&eacute;ration d\'essence' );
define( '_HISTORIQUE_26', 'R&eacute;cup&eacute;ration de munition(s)' );
define( '_HISTORIQUE_27', 'Vole d\'un v&eacute;hicule contre un habitant' );
define( '_HISTORIQUE_28', 'Vole d\'argent contre un autre joueur' );
define( '_HISTORIQUE_29', 'Vole d\'arme contre un autre joueur' );
define( '_HISTORIQUE_30', 'Vole d\'un v&eacute;hicule contre un autre joueur' );
define( '_HISTORIQUE_31', 'Annulation de l\'action en cours de pr&eacute;paration' );
define( '_HISTORIQUE_32', 'Participation à un action' );
define( '_HISTORIQUE_33', 'Retrait d\'un joueur qui participait à l\'action en cours de pr&eacute;paration' );
define( '_HISTORIQUE_34', 'Retrait de ta participation à l\'action en cours de pr&eacute;paration' );
define( '_HISTORIQUE_35', 'Lancement de l\'action qui &eacute;tait en cours de pr&eacute;paration' );
define( '_HISTORIQUE_36', 'L\'action en cours de pr&eacute;paration a &eacute;t&eacute; annul&eacute; pour raison de d&eacute;placement du personnage' );
define( '_HISTORIQUE_37', 'Un joueur vient de te voler de l\'argent' );
define( '_HISTORIQUE_38', 'Un joueur a voulu te voler de l\'argent mais il a échoué' );
define( '_HISTORIQUE_39', 'Tentative de vole d\'argent qui a échoué' );
define( '_HISTORIQUE_40', 'Un joueur a voulu te voler ton véhicule mais il a échoué' );
define( '_HISTORIQUE_41', 'Tentative de vole de véhicule qui a échoué' );
define( '_HISTORIQUE_42', 'Un joueur vient de te voler ton véhicule' );
define( '_HISTORIQUE_43', 'Un joueur a voulu te voler ton arme mais il a échoué' );
define( '_HISTORIQUE_44', 'Tentative de vole d\'arme qui a échoué' );
define( '_HISTORIQUE_45', 'Un joueur vient de te voler ton arme' );
define( '_HISTORIQUE_46', 'Un joueur prépare une action contre votre personnage' );
define( '_HISTORIQUE_47', 'VICTOIRE - action reussite contre un autre joueur - ATTAQUE' );
define( '_HISTORIQUE_48', 'Ton personnage vient d\'être attaquer par un ou plusieurs joueur(s) - ATTAQUE' );
define( '_HISTORIQUE_49', 'DEFAITE - action non réussite contre un autre joueur - ATTAQUE' );
define( '_HISTORIQUE_50', 'Ton personnage vient de repousser une action organisé par un ou plusieurs joueur(s) - DIVERS' );
define( '_HISTORIQUE_51', 'VICTOIRE - action reussite contre l\'établissement - ATTAQUE' );
define( '_HISTORIQUE_52', 'DEFAITE - action non réussite contre l\'établissement - ATTAQUE' );
define( '_HISTORIQUE_53', 'VICTOIRE - action reussite contre un habitant - ATTAQUE' );
define( '_HISTORIQUE_54', 'DEFAITE - action non réussite contre un habitant - ATTAQUE' );
define( '_HISTORIQUE_55', 'DEFAITE - action non réussite contre un habitant - VOLE DE VEHICULE' );
define( '_HISTORIQUE_56', 'DEFAITE - action non réussite contre un habitant - VOLE D\'ARGENT' );
define( '_HISTORIQUE_57', 'DEFAITE - action non réussite contre un habitant - VOLE D\'ARME' );
define( '_HISTORIQUE_58', 'Tu viens de donner un géricane' );
define( '_HISTORIQUE_59', 'On vient de te donner de l\'essence' );
define( '_HISTORIQUE_60', 'Tu viens de donner des munitions' );
define( '_HISTORIQUE_61', 'On vient de te donner des munitions' );
define( '_HISTORIQUE_62', 'Tu viens de mettre un mec au pénitencier car il n\'avait pas de quoi payer l\'amende' );
define( '_HISTORIQUE_63', 'On vient de te mettre au pénitencier car tu n\'avais pas de quoi payer l\'amende' );
define( '_HISTORIQUE_64', 'Tu as mis une amende' );
define( '_HISTORIQUE_65', 'On t\'a collé une amende' );
define( '_HISTORIQUE_66', 'Ton perssonage vient de gagner des points pour ses statistique car il a vendu un établissement' );
define( '_HISTORIQUE_67', 'Ton personnage s\'est engagé dans la police.' );
define( '_HISTORIQUE_68', 'Ton personnage a été positionné au commissariat suite à un control de routine' );
define( '_HISTORIQUE_69', 'L\'action en cours de pr&eacute;paration a &eacute;t&eacute; annul&eacute; pour des raisons d\'attaque' );
define( '_HISTORIQUE_70', 'GAME OVER' );
define( '_HISTORIQUE_71', 'Tu as utilisé un Mafia-pass pour ne pas avoir GAME OVER' );
define( '_HISTORIQUE_72', 'Ton personnage vient de planquer un autre personnage, il a gagné de l\'expérience' );
define( '_HISTORIQUE_73', 'Ton personnage a été planqué par un flic, il a perdu de l\'expérience' );
define( '_HISTORIQUE_74', 'Ton personnage a acheté des munitions' );
define( '_HISTORIQUE_75', 'Ton personnage a fait le plein de son véhicule' );
define( '_HISTORIQUE_76', 'Ton personnage a échangé des points d\'expérience contre de la santé à l\'hospital' );
define( '_HISTORIQUE_77', 'Ton personnage a utilisé un Mafia-pass pour ce remettre de la santé à l\'hospital' );
define( '_HISTORIQUE_0', 'Une erreur dans votre historique' );

/*
**	./control/achatBatiment.control.php
*/

define( '_ACHAT_BAT', 'Achat de l\'établissement %a pour le prix de %b $' );
define( '_VENTE_BAT', 'Vente de l\'établissement %a pour le prix de %b $' );
define( '_VENTE_HISTORIQUE_BAT', 'Ton personnage a gagné %a pt(s) de %b lors des négociations de vente d\'un établissement.' );


/*
**	./control/equipe.control.php
*/

define( '_SELECT_JOUEUR', 'S&eacute;lectionner un joueur' );

/*
**	./control/batiment.control.php
*/

define( '_PREPARATION_BRAQUAGE_BAT', 'Pr&eacute;paration d\'un braquage contre : %a' );

?>