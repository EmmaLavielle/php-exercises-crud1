<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php-exercises-crud1</title>
</head>
<body>
    
<?php

$myPDO = new PDO
(
    'mysql:host=localhost;dbname=colyseum',
    'root',
    'root'
);

echo "<b> PHP-EXERCICES-CRUD1 </b> <br> <br> <br>";

// Exercice 1
echo "<b> Exercice 1 : Afficher tous les clients.</b> <br> <br>";
foreach($myPDO->query('SELECT * FROM clients') as $clients)
{
	echo "$clients[firstName] $clients[lastName] <br>";	
} 

// Exercice 2
echo "<br> <hr> <b> Exercice 2 : Afficher tous les types de spectacles possibles. </b> <br> <br>";
foreach($myPDO->query('SELECT * FROM showTypes') as $showTypes)
{
    echo "$showTypes[type] <br>";
}

// Exercice 3
echo "<br> <hr> <b> Exercice 3 : Afficher les 20 premiers clients </b> <br> <br>";
foreach($myPDO->query('SELECT * FROM clients LIMIT 20') as $id)
{
	echo "$id[id] : $id[firstName] $id[lastName] <br>";	
}

// Exercice 4
echo "<br> <hr> <b> Exercice 4 : N'afficher que les clients possédant une carte. </b> <br> PS : La consigne initiale demandait d'afficher les clients possédant une carte <i>de fidélité</i> spécifiquement. Cependant il n'est visiblement pas possible de satisfaire cette demande sans modifier la base de données, car les deux tables dont on a besoin pour faire un 'INNER JOIN' ne possèdent pas de clé commune. J'ai donc pris l'initiative de n'afficher que les clients possédant une carte, sans différenciation de type (d'autant plus que je pense que c'est plutôt ceci que vous cherchiez à nous demander) <br> <br>";
foreach($myPDO->query('SELECT * FROM clients WHERE card = 1') as $card)
{
    echo "$card[firstName] $card[lastName] <br>";
}

// Exercice 5
echo "<br> <hr> <b> Exercice 5 : Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre 'M'. </b> <i> Les afficher comme ceci : <br> Nom : *Nom du client* <br> Prénom : *Prénom du client* <br> Trier les noms par ordre alphabétique. </i> <br> <br>";
foreach($myPDO->query('SELECT * FROM clients WHERE lastName LIKE "M%" ORDER BY lastName ASC') as $M)
{
    echo "Nom : $M[lastName] <br> Prénom : $M[firstName] <br><br>";
}

// Exercice 6
echo "<hr> <b> Exercice 6 : Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. </b> <br> <i> Trier les titres par ordre alphabétique. <br> Afficher les résultat comme ceci : *Spectacle* par *artiste*, le *date* à *heure*. </i> <br> <br>";
foreach($myPDO->query('SELECT * FROM shows ORDER BY title ASC') as $shows)
{
    echo "$shows[title] par $shows[performer], le $shows[date] à $shows[startTime] <br>";
}

// Exercice 7
echo "<br> <hr> <b> Exercice 7 : Afficher tous les clients comme ceci : </b> <br> <i> Nom : *Nom de famille du client* <br> Prénom : *Prénom du client* <br> Date de naissance : *Date de naissance du client* <br> Carte de fidélité : *Oui (Si le client en possède une) ou Non (s'il n'en possède pas)* <br> Numéro de carte : *Numéro de la carte fidélité du client s'il en possède une.* </i> <br> <br>";
foreach($myPDO->query('SELECT * FROM clients') as $clients)
{
    echo "Nom : $clients[lastName] <br> Prénom : $clients[firstName] <br> Date de naissance : $clients[birthDate] <br> Carte de fidélité :";
    if($clients[card])
    {
        echo "Oui <br> Numéro de carte : $clients[cardNumber] <br> <br>"; 
    }
    else
    {
        echo "Non <br> <br>";
    }
}

?>

</body>
</html>
