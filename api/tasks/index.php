<?php
// Dico che voglio rispondere in linguaggio json
header('Content-Type: application/json');


// Salvo il path del file json
$source_path = __DIR__ . '/../../database/tasks.json';

// Prendo i contenuti del file json
$json_data = file_get_contents($source_path);

// Converto i dati json un array associativo php
$tasks = json_decode($json_data, true);

// Controllo se ho un nuovo task
$new_task_name = $_POST['task'] ?? '';


// Controllo se ho un nuovo task
if(!empty($new_task_name)){

    // Creo un nuovo task sotto forma di oggetto
    $new_task = new stdClass();
    $new_task->id = count($tasks) + 1;
    $new_task->text = $new_task_name;
    $new_task->done = false;

    // Aggiungo il new_task all'array tasks
    $tasks[] = $new_task;  
    
    // Riconverto l'array di task in json
    $tasks_json = json_encode($tasks);

    //Sovrascrivo l'array originale
    file_put_contents($source_path, $tasks_json);
} 

// Stampo i task, riconvertendoli in json
    echo json_encode($tasks);
?>