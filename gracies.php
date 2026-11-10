<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    gracies.php: una pàgina nova, feta de zero.

    APARTAT 6 · Una pàgina nova de zero
    - S'hi arriba des del botó del resum de processa.php quan el registre ha anat bé.
    - Té el mateix disseny que les altres: el mateix header, el mateix footer i el
      mateix full d'estils.
    - Sense comptar els comentaris, el codi és de menys de deu línies.

    Comparació amb l'Activitat 3: allà hauria hagut de tornar a escriure el doctype,
    el head amb el title i el link del css, el body, el header i el footer, unes 25 línies
    abans d'escriure res de la pàgina. Aquí ho fan els dos require.
*/

require_once 'config.php';
$titolPagina = 'Gràcies';
require 'header.php';
?>
    <h2>Gràcies per registrar-te</h2>
    <!-- el nom i el correu de la botiga surten de config.php -->
    <div class="ok">
        <p>El teu compte de <?= BOTIGA_NOM ?> ja està actiu. Si tens cap problema, escriu-nos a <?= BOTIGA_CORREU ?>.</p>
    </div>
    <a class="tornar" href="<?= PAG_FORMULARI ?>">Registrar un altre compte</a>
<?php
require 'footer.php';
