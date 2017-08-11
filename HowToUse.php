<?php

//Per utilizzare la libreria è necessaria includerla ( o copiarla direttamente nel file in cui la si vuole utilizzare ).
/*Per ottenere le traduzioni è necessario inserirne almeno una in quanto si crea la directory "Languages"
* essenziale per l'utilizzo di queste classi.
*
* Il language code ( lCode ) è la lingua; Esaminiamo ora come inserire ed ottenere delle traduzioni basandoci sulla lingua
* spagnola. */

$q = new inserTrad("es"); /*es è il nostro language code di esempio. Se si utilizza libreria per creare bot telegram
è consigliato selezionare solo la lingua e NON il codice paese (e. "es-it") di cui "es" è il codice lingua, "it" il codice paese.*/
$q->insert("start", "Este comando inicializa el bot!");
//In questo modo abbiamo inserito la nostra prima traduzione.
//Per ottenerla...
$r = new trad("es");
$r->build("help");
$traduzione = $r->getTrad();
echo $traduzione; //Stamperà "Este comando inicializa el bot!";
//Per quest'ultimo passaggio è consigliato però creare una funzione per rendere più veloce ed intuitivo il procedimento:

function gT($language, $variable) //gT = getTraduction
{
  $r = new trad($language);
  $r->build($variable);
  $trad = $r->getTrad();
  return $trad;
}

//Prendendo l'esempio di telegram, utilizzando la base AltervistaBot sarà necessario quindi scrivere:

if($msg == "/start")
{
  $languageCode = $update['message']['from']['language_code'];
  $response = gT($languageCode, "start");
  sm($chatID, $response, $menu, "html");
}

//Mentre per inserirlo...

//Prendiamo conto che il messaggio sia "/inserisici es start Il comando start etc."
if(strpos($msg, "/inserisci")===0)
{
  $e = explode(" ", $msg, 4);
  $languageCode = $e[1];
  $var = $e[2];
  $trad = $e[3];
  $r = new insertTrad($languageCode);
  $r->insert($var, $trad);
  sm($chatID, "fatto!");
}


/* !!!IMPORTANTE!!!

Tutte le funzioni della classi sono case-sensitive. Ciò per impedire la selezione di una varabile errata.
Consigliamo, in ogni caso, di utilizzare i nomi delle variabili strutturati così:

_NOMEVARIABILE (es. _START).

La versione 1.0 potrebbe contenere bug. Verranno sistemati con le prossime versioni.

Utilizzi questa libreria per Telegram? Entra nel nostro canale! t.me/getTrad !
