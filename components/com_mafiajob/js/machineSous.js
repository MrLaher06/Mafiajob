/**
* @version $Id: fonction.js,v 1 24/02/2008 16:00:00 akede Exp $
* @package Mafiajob
* @copyright (C) 2008 Alban PASQUELIN
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mafiajob is Free Software
* Site web : http://www.mafiajob.fr
* E-mail : contact@mafiajob.fr
*/

slotitem = new Array('0','1','2','3','4','5','6','7','8','9');

function rollem (argent) {
	
document.slots.bet.focus();

if (document.slots.bet.value<1 || argent<1 || document.slots.bet.value == "") {alert("Vous devez miser a moins 1$.   "); return;}

if (document.slots.bet.value>500) {alert("Vous devez miser moins de 500$.   "); return;}

if (Math.floor(argent) < Math.floor(document.slots.bet.value)) {alert("votre mise "+document.slots.bet.value+" $ est supérieur a ce que vous possédez ( "+argent+" $.  )"); return;}

if (document.slots.bet.value>1) {document.slots.banner.value="Mise de "+document.slots.bet.value+" $";}

else {document.slots.banner.value="Mise de "+document.slots.bet.value+" $";}

counter=0;
spinem(counter,argent);

}

function spinem(counter,argent) {

turns1=10+Math.floor((Math.random() * 10))

for (a=0;a<turns1;a++)

	{document.slots.slot1.src="components/com_mafiajob/images/carte/"+slotitem[a % 9]+".gif"; }

turns2=10+Math.floor((Math.random() * 10))

for (b=0;b<turns2;b++)

	{document.slots.slot2.src="components/com_mafiajob/images/carte/"+slotitem[b % 9]+".gif"; }

turns3=10+Math.floor((Math.random() * 10))

for (c=0;c<turns3;c++)

	{document.slots.slot3.src="components/com_mafiajob/images/carte/"+slotitem[c % 9]+".gif"; }

counter++;

if (counter<25) {setTimeout("spinem("+counter+","+argent+");",80);} else {checkmatch(argent);}

}

function checkmatch(argent)	
{ 

if ((document.slots.slot1.src == document.slots.slot2.src) && (document.slots.slot1.src == document.slots.slot3.src)) 

	{		
		argent=Math.floor(argent)+Math.floor(document.slots.bet.value*10); 
		alert("Trois d'une même sorte\nVous gagnez "+Math.floor(document.slots.bet.value*10)+" $");

		conteneur('index2.php?option=com_mafiajob&task=batiment', 'argentcasino='+argent);
	}

else if ((document.slots.slot1.src == document.slots.slot2.src) ||

	(document.slots.slot1.src == document.slots.slot3.src) ||

	(document.slots.slot2.src == document.slots.slot3.src))

	{
		argent = Math.floor(document.slots.bet.value*2) + Math.floor(argent); 
		alert("Une Paire\nVous gagnez "+Math.floor(document.slots.bet.value*2)+" $");

		conteneur('index2.php?option=com_mafiajob&task=batiment', 'argentcasino='+argent);
	}

	else 
	{
		argent=argent-document.slots.bet.value; 
		alert("Vous perdez "+document.slots.bet.value+" $");
	
		conteneur('index2.php?option=com_mafiajob&task=batiment', 'argentcasino='+argent);
	}

}