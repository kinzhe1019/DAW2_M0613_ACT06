<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    footer.php: el disseny de baix de qualsevol pàgina.

    APARTAT 4 · footer.php
    - Tanca el que ha obert header.php (<main>, <body> i <html>).
    - Hi afegeix el peu de pàgina amb el nom i el correu de la botiga.
*/
?>
    </main>
    <!-- el nom i el correu surten de config.php, si els canvio alla canvien a totes les pagines -->
    <footer>
        <p><?= BOTIGA_NOM ?> &middot; Projecte de classe del M0613</p>
        <p>Contacte: <?= BOTIGA_CORREU ?></p>
    </footer>
</body>
</html>
