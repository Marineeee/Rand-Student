<?php

include('database/login_to_db.php');

function r_error($message)
{
    header('Location: index.php?error=' . strip_tags($message));
}

function tire_supperieur_eleves($rand)
{
    $db = login_db();
    $db = $db->query('SELECT COUNT(prenom) as nbr FROM students');
    $db = $db->fetch();

    if($rand > $db['nbr'])
    { return 1; }
    else
    { return 0; }
}

function choose_student($nbr)
{
    $db1 = login_db();
    $db1 = $db1->query('SELECT nom_absence FROM students');

    $i = 0;

    while($scrive = $db1->fetch())
    {
        $students[$i] = $scrive['nom_absence'];
        $i++;
    }

    $return[] = NULL;

    for($x = 0; $x < $nbr; $x++)
    {
        $stud = $students[rand(0, $i)];

        while(in_array($stud, $return))
        {
            $stud = $students[rand(0, $i)];
        }

        if(!empty($stud))
        $return[$x] = $stud;
        else
        $stud = $students[rand(0, $i)];
    }

    return serialize($return);
}

if(!isset($_POST['rand']) || empty($_POST['rand']))
{ r_error('Veuillez réessayer.'); exit(); }

if(!is_int(intval($_POST['rand'])))
{ r_error('Le nombre de personnes tirées au sort doit être en nombres. Pas de lettres.'); exit(); }

if(tire_supperieur_eleves($_POST['rand']))
{ r_error('Vous ne pouvez pas tirer plus d\'élèves que vous en avez.'); exit(); }

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