<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    header.php: el disseny de dalt de qualsevol pàgina.

    APARTAT 4 · header.php
    - Tot el que hi ha des del <!DOCTYPE> fins a l'obertura del <main>.
    - Fa servir $titolPagina, que l'ha de posar la pàgina ABANS del require.
    - Obre etiquetes que no tanca (<html>, <body> i <main>). No és un error:
      les tanca footer.php.
*/

// el fitxer inclos s'executa dins de la pagina que l'inclou, per aixo veu $titolPagina.
// si una pagina s'oblida del titol, poso 'Inici' i aixi no surt cap avis
if (!isset($titolPagina)) {
    $titolPagina = 'Inici';
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <!-- el titol de la pagina i despres el nom de la botiga, que surt de config.php -->
    <title><?= htmlspecialchars($titolPagina) ?> · <?= BOTIGA_NOM ?></title>
    <link rel="stylesheet" href="<?= FULL_ESTILS ?>">
</head>
<body>
    <header>
        <h1><?= BOTIGA_NOM ?></h1>
        <p><?= BOTIGA_LEMA ?></p>
    </header>
    <main>
