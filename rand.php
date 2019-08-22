<?php

include('database/login_to_db.php');

function r_error($message)
{
    header('Location: index.php?error=' . strip_tags($message));
}

# Choisi un nombre entre 0 et le nombre d'élèves choisis, sans compter ceux déjà choisis
function rand_number($min, $max, $already_rand)
{
    do
    {
        $number = rand($min, $max);
    } while (in_array($already_rand, $number));

    return $number;
}

function choose_student($nbr)
{
    $students = array(); // création du tableau qui va contenir tous les prénoms
    $return = array();
    $already_rand = array(); // enregistre tous les nombres déjà tirés dans le tableau d'étudiants

    for($i = 0; $i < 29; $i++)
    {
        if(isset($_POST[$i]) && !empty($_POST[$i])) // check si le nom est envoyé
        $students[$i] = $_POST[$i]; // si oui on l'ajoute au tableau
    }

    # Vérifie si le nombre d'élèves à tirer n'est pas supérieurs de celui d'élèves cochés
    if($_POST['rand'] > count($students)) 
    { r_error('Vous ne pouvez pas tirer plus d\'élèves que vous en avez cochés.'); exit(); }

    $nbr_to_choose = strip_tags($_POST['rand']);
    $students_size = count($students);

    # Fonction qui choisis les étudiants
    for($x = 0; $x < $nbr_to_choose; $x++)
    {
        $number = rand_number(0, $students_size - 1, $already_rand); // choissis un nombre aléatoirement parmis ceux disponibles
        $return[$x] = $students[$number]; // ajout l'étudiant tiré au tableau de ceux tirés
        $already_rand[$x] = $number; // ajoute le nombre tiré au tableau des déjà tirés
    }

    return serialize($return);
}

if(!isset($_POST['rand']) || empty($_POST['rand']))
{ r_error('Veuillez réessayer.'); exit(); }

if(!is_int(intval($_POST['rand'])))
{ r_error('Le nombre de personnes tirées au sort doit être en nombres. Pas de lettres.'); exit(); }

$rand = choose_student($_POST['rand']);

$db = login_db();
$db = $db->prepare('INSERT INTO rand(randid, unlucky_student, rand_ip, date) VALUES (:randid, :unlucky_student, :rand_ip, :date)');
$db->execute(array(
    'randid'=>$randid = rand(100000000000000, 999999999999999),
    'unlucky_student'=>$rand,
    'rand_ip'=>$_SERVER['REMOTE_ADDR'],
    'date'=>date('Y/m/d H:i:s')
));

header('Location: index.php?randid=' . $randid);

?>