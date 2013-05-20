/**
* @version $Id: fonction.js,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

var x;
var nbr = 0;
var var1 = 2;
var var2 = 10;
var nbrTotal = 31;
var verif = true;
var verifDeplacement = false;


function infobulle(titre, donnee, taille, couleur) 
{
	return overlib(donnee , WIDTH , taille , CAPTION , titre, TEXTSIZE, '12px', FGCOLOR, '#FFFFCC', BGCOLOR, couleur, ABOVE);
}

function popup_color_picker()
{
	window.open('components/com_mafiajob/views/couleur.html.php', 'cp', 'resizable=no, location=no, width=400, height=300, menubar=no, status=yes, scrollbars=no, menubar=no');
}

function affimage(source, div) 
{
	$(div).innerHTML = '<img class="imgBlock" alt="image" height="60" src="'+source+'" />';
}

function sonChoix()
{
	var choix = Cookie('choixSon');
	
	if(choix == null || choix == 'sans')
	{
		Sound.enable();
		createCookie('choixSon','avec',365);
		$('ClickSon').innerHTML = '<img src="./components/com_mafiajob/images/SonSans.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="sonChoix();">Désactiver le son</a>';
	}
	else
	{
		Sound.disable();
		createCookie('choixSon','sans',365)
		$('ClickSon').innerHTML = '<img src="./components/com_mafiajob/images/SonAvec.png" alt="Top" align="top" width="15" height="15" /> <a href="javascript:;" onclick="sonChoix();">Activer le son</a>';
	}
	return false;
}

function verif_champ_mafia()
{
	 if ($("nommafia").value == "")
	{
		alert("Donner un nom à votre équipe");
		return false;
	}
	else if ($("imagemafia").value == "")
	{
		alert("Donner une image à votre équipe");
		return false;
	}
	else if ($("couleur").value == "")
	{
		alert("Donner une couleur à votre équipe");
		return false;
	}
	else
		return true;
}

function verif_champ_invite()
{
	if ($("idinvite").value == ""  && $("idsupp").value == "")
	{
		alert("Veuillez sélectionner un joueur.");
		return false;
	}
	else
		return true;
}

function Init()	
{
	x = window.setInterval('Decompte()', 1000);
}

//compteur
function Decompte()	
{	
	if($('compteur'))
		valeur = $('compteur').value;
		
	if(valeur > 0)
		--valeur ;
	else
	{
		valeur = 0 ;
		clearInterval(x)
	}
	
	$('compteur').value = valeur ;
	
	for(i=1; i <= 8; i++)
	{
		if($('lienDeplacement-'+i))
		{
			if(valeur != 0)
				couleurRouge(i);
			else
				couleurVert(i);
		}
	}
}

function couleurRouge(i)
{
	var lien = $('lienDeplacement-'+i);
	lien.style.backgroundImage = 'url(\'./components/com_mafiajob/images/map/rouge.png\')';
	lien.style.border = '1px solid #990000';
	lien.style.cursor = 'default';
	lien.style.width = '48px';
	lien.style.height = '48px';
}

function couleurVert(i)
{
	var lien = $('lienDeplacement-'+i);
	lien.style.backgroundImage = 'url(\'./components/com_mafiajob/images/map/vert.png\')';
	lien.style.border = '1px solid #006600';
	lien.style.cursor = 'pointer';
	lien.style.width = '48px';
	lien.style.height = '48px';
}


//function pour lancer le deplacement et vérifie qu aucun déplacement est en cours pour les multi cliques
function ajaxdeplacement(lien, numeroLien, batiment)
{
	verifDeplacement = true;
	if($("MonPersonnage") && $('compteur').value <= 0 )
	{
		if(verif == true) 
		{
			verif = false;
			
			if(batiment)
				Effect.Fade('MonPersonnage');
				
			deplacement(lien, numeroLien);
		}
	}
	else
	{
		CarteAjax(lien, 'ajax=actualiser&direction=' + numeroLien);
		verif = true;
	}
}

//function pour déplacer le joueur sur la carte
function deplacement(lien, numeroLien)
{
	ld = $("MonPersonnage");
			
	switch(numeroLien) 
	{
		case 1:
			ld.style.top = parseInt(ld.offsetTop - var1,var2)+"px";
			ld.style.left = parseInt(ld.offsetLeft - var1,var2)+"px";
			break;
		
		case 2:
			ld.style.top = parseInt(ld.offsetTop - var1,var2)+"px";
			break;
			
		case 3:
			ld.style.top = parseInt(ld.offsetTop - var1,var2)+"px";
			ld.style.left = parseInt(ld.offsetLeft + var1,var2)+"px";
			break;
		
		case 4:
			ld.style.left = parseInt(ld.offsetLeft - var1,var2)+"px";
			break;
		
		case 5:
			ld.style.left = parseInt(ld.offsetLeft + var1,var2)+"px";
			break;
			
		case 6:
			ld.style.top = parseInt(ld.offsetTop + var1,var2)+"px";
			ld.style.left = parseInt(ld.offsetLeft - var1,var2)+"px";
			break;
		
		case 7:
			ld.style.top = parseInt(ld.offsetTop + var1,var2)+"px";
			break;
			
		case 8:
			ld.style.top = parseInt(ld.offsetTop + var1,var2)+"px";
			ld.style.left = parseInt(ld.offsetLeft + var1,var2)+"px";
			break;
	}
	nbr++;
	
	if(nbr == nbrTotal)
	{
		clearTimeout(timer);
		nbr = 0;
		Init();
		CarteAjax(lien, 'ajax=actualiser&direction=' + numeroLien);
		verif = true;
	}
	else
		timer = setTimeout("deplacement('"+lien+"',"+numeroLien+")",20);

}

// vérifi si le prix pour le parking convient
function verifprixparking(valeurmax, valeurmin, url)
{
	if ($("prixvente").value > valeurmax)
		alert("Veuillez ne pas vendre votre voiture trop cher.");
	else if ($("prixvente").value < valeurmin && $("prixvente").value != "" && $("prixvente").value != 0)
		alert("Veuillez ne pas vendre votre voiture peu cher ("+valeurmin+" $).");
	else
		conteneur(url, champ('prixvente')+'&depot=true');
}

// function pour récupérer les value des formulaire pour ajax

// input
function champ(reponse) 
{
	return reponse+'='+$(reponse).value;
}

// plusieur input avec le meme nom
function champ2(reponse,nom) 
{
	return nom+'='+$(reponse).value;
}

//select
function champ3(reponse) 
{
	for(i=0;i<$(reponse).length;++i)
	{
  		if($(reponse).options[i].selected == true)
   			return reponse+'='+$(reponse).options[i].value;
	}
}

function Cookie(nom)
{
	var arg=nom+"=";
	var alen=arg.length;
	var clen=document.cookie.length;
	var i=0;
	while (i<clen)
	{
		var j=i+alen;
		if (document.cookie.substring(i, j)==arg) 
			return getCookieVal(j);
		i=document.cookie.indexOf(" ",i)+1;
		if (i==0) 
			break;
	}
	return null;
}

function getCookieVal(offset)
{
	var endstr=document.cookie.indexOf (";", offset);
	if (endstr==-1) 
		endstr=document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

function createCookie(name,value,days) 
{
  if (days) 
	{
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
	
  document.cookie = name+"="+value+expires+"; path=/";
}

function dieCookie(name)
{
	date=new Date;
	date.setFullYear(date.getFullYear()-1);
	createCookie(name,null,date);
}

// AJAX
function ajax(url,parametre,div)
{	
	new Ajax.Updater(div, url+'&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				onComplete:function(request){Effect.Fade('chargement');}, 
				onLoading:function(request){Element.show('chargement');}, 
				parameters:parametre
			});
	return;
}

// conteur principal du jeu
function conteneur(url,parametre) 
{
	new Ajax.Updater('ajax', url+'&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				onComplete:function(request){ajax('modules/mod_wub_joueur.php?option=com_mafiajob&Itemid=66&ajax_menu=1', '', 'ModJoueur');}, 
				onLoading:function(request){Element.show('chargement');}, 
				parameters:parametre
			});
	return;
}

//pop up ou se trouve la carte
function CarteAjax(url,parametre) 
{
	if(valeur <= 0 && verifDeplacement == true)
	{
		new Ajax.Updater('CarteAjax', url+'&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				onComplete:function(request){ window.opener.conteneur('index2.php?option=com_mafiajob&Itemid=66&task=action'); verifDeplacement = false; }, 
				parameters:parametre
			});
	}
}

//pop up ou se trouve la carte
function CarteAjaxRefresh(url) 
{
		new Ajax.Updater('CarteAjax', url+'&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				parameters:'ajax=actualiser&RefreshCarte=refresh'
			});
}

//pop up ou se trouve la carte
function RetourHisto() 
{
	var task = Cookie('MafTaskSauv');
	
	if(task == null || task == 'carte')
		task = null;
	
		new Ajax.Updater('ajax', 'index2.php?option=com_mafiajob&Itemid=66&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				onComplete:function(request){Effect.Fade('chargement');}, 
				onLoading:function(request){Element.show('chargement');},
				parameters:'task='+ task
			});
}

function delaiDisparait(div, temps)
{
	try {
		new PeriodicalExecuter(function(pe) 
		{
			try{
				Effect.Fade(div); 
			}
			catch(e){}
			pe.stop();
		}, temps);
	}catch(e){}

}

// conteur principal du jeu
function VoirInventaire(type,choix) 
{
	new Ajax.Updater('ajax','index2.php?option=com_mafiajob&Itemid=66&task=inventaire&no_html=1', {
				asynchronous:true, 
				evalScripts:true, 
				onComplete:function(request){ 
								
				if(getTop($(choix))> 600)				
					new Effect.ScrollTo(choix);
					
				new PeriodicalExecuter(function(pe) 
				{
					try{
						new Effect.Highlight(choix); 
					}
					catch(e){}
					pe.stop();
				}, 1);
				}, 
				onLoading:function(request){}, 
				parameters:'type='+type	
			});
}

function pageNavigation(valeur,type)
{
	for(i=0;i<$('limit').length;++i)
	{
		if($('limit').options[i].selected == true)
			createCookie('limit',$('limit').options[i].value,365);
	}
	conteneur('index2.php?option=com_mafiajob&Itemid=66&task='+type,'limitstart='+valeur); 
	new Effect.ScrollTo('bg-top');
	return false;
}

function getTop(MyObject)
{
	if (MyObject.offsetParent)
		return (MyObject.offsetTop + getTop(MyObject.offsetParent));
	else
		return (MyObject.offsetTop);
}
