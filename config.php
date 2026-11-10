<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    config.php: els valors que es fan servir a més d'un lloc.

    APARTAT 2 · config.php
    - Aquí hi va tot el que surt a més d'un lloc i que algun dia pot canviar.
    - Si demà canviés i l'hagués de tocar més d'una vegada, va aquí.
    - Aquest fitxer NO escriu res a la pantalla: ni un echo ni un espai abans del <?php.
*/

// faig servir const i no variables: una constant no es pot canviar un cop creada,
// aixi ningu pot canviar el nom de la botiga a mitja pagina.
// per fer-les servir s'escriuen sense dolar i sense cometes: echo BOTIGA_NOM;

// dades de la botiga (surten al title, al header i al footer de totes les pagines)
const BOTIGA_NOM    = 'BitBazar';
const BOTIGA_LEMA   = 'Material informàtic al millor preu';
const BOTIGA_CORREU = 'info@bitbazar.cat';

// regles de validacio. les faig servir al missatge d'error i a l'etiqueta del formulari,
// aixi els dos llocs sempre diuen el mateix numero
const MIN_USUARI = 4;
const MIN_CLAU   = 6;

// rutes dels fitxers
const FULL_ESTILS   = 'estils.css';
const PAG_FORMULARI = 'registre.php';

// no tanco el php al final a posta: si despres del tancament quedes un salt de linia
// o un espai s'escriuria a la pantalla i trencaria les pagines que inclouen aquest fitxer.
// (compte: l'etiqueta de tancar el php no es pot escriure ni dins d'un comentari amb //,
// perque el php la llegeix igual i tanca)
