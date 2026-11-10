<?php
declare(strict_types=1);
/*
    ACTIVITAT 6 · Modularitzar el codi
    processa.php: només la lògica (recollir, validar i mostrar).

    APARTAT 5 · Muntar les dues pàgines
    L'ordre del fitxer ha de ser exactament aquest:
    1. Els require_once de config.php i funcions.php.
    2. La comprovació del REQUEST_METHOD.
    3. Recollir les dades i desar-les a l'array associatiu.
    4. Validar-les i omplir l'array d'errors.
    5. Calcular $titolPagina segons si hi ha errors o no.
    6. Incloure la capçalera i, a partir d'aquí, escriure l'HTML.
    7. Incloure el peu.
*/

// 1. la configuracio i les funcions, sempre amb require_once
require_once 'config.php';
require_once 'funcions.php';

/*
    APARTAT 3 · Per què require_once i no require
    Ho he provat posant a posta dues línies seguides de require 'funcions.php';
    i surt aquest error (la pàgina es para):

    PHP Fatal error:  Cannot redeclare camp() (previously declared in C:\wamp64\www\M0613\CLASE\ACT06\funcions.php:27) in C:\wamp64\www\M0613\CLASE\ACT06\funcions.php on line 27

    Amb require PHP torna a llegir el fitxer i intenta declarar les mateixes funcions
    dues vegades. Amb require_once PHP es recorda que ja l'ha inclòs i la segona vegada
    no fa res. Per això config.php i funcions.php sempre van amb require_once.
*/

// 2. si algu entra escrivint la url directament, el metode es GET i no hi ha dades.
// ara que tinc header i footer, aquesta pagina tambe surt amb el disseny de la botiga
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $titolPagina = 'Accés directe';
    require 'header.php';
    echo '<h2>Aquí no s\'hi arriba directament</h2>';
    echo '<p>Has d\'arribar aquí des del formulari.</p>';
    // abans l'enllac anava a registre.html, ara surt de la constant PAG_FORMULARI
    echo '<a class="tornar" href="' . PAG_FORMULARI . '">Anar al formulari</a>';
    require 'footer.php';
    // exit para la pagina aqui, la resta del fitxer no s'executa
    exit;
}

// 3. recullo les dades en un array associatiu.
// camp() fa el trim($_POST[...] ?? '') que abans escrivia dotze vegades
// les caselles no es poden recollir amb camp() perque si no es marquen no s'envien,
// per aixo continuen amb isset(), com a l'activitat 3
$usuari = [
    'nom'        => camp('nom'),
    'cognoms'    => camp('cognoms'),
    'naixement'  => camp('naixement'),
    'telefon'    => camp('telefon'),
    'correu'     => camp('correu'),
    'usuari'     => camp('usuari'),
    'carrer'     => camp('carrer'),
    'poblacio'   => camp('poblacio'),
    'cp'         => camp('cp'),
    'tipus'      => camp('tipus'),
    'origen'     => camp('origen', 'no ho ha dit'),
    'butlleti'   => isset($_POST['butlleti']) ? 'Si' : 'No',
    'condicions' => isset($_POST['condicions']) ? 'Si' : 'No',
];

// les contrasenyes a part, nomes les faig servir per comparar-les i no es mostren mai.
// aqui no faig servir camp() perque no vull treure els espais de la contrasenya
$clau = $_POST['clau'] ?? '';
$clau2 = $_POST['clau2'] ?? '';

// ampliacio 1: el correu repetit tambe va a part, nomes el faig servir per comparar
$correu2 = camp('correu2');

// 4. valido les dades. cada error va a l'array $errors, si al final es buit tot ha anat be
$errors = [];

// nom i cognoms: miro si estan buits
if ($usuari['nom'] === '') {
    $errors[] = 'El nom és obligatori.';
}

if ($usuari['cognoms'] === '') {
    $errors[] = 'Els cognoms són obligatoris.';
}

// correu: primer miro si esta buit, i si no ho esta miro si te format de correu
// filter_var torna false si no es un correu valid
if ($usuari['correu'] === '') {
    $errors[] = 'El correu és obligatori.';
} elseif (filter_var($usuari['correu'], FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'El correu no té un format vàlid.';
}

// ampliacio 1: els dos correus han de ser iguals, igual que les contrasenyes
if ($usuari['correu'] !== $correu2) {
    $errors[] = 'Els correus no coincideixen.';
}

// els minims surten de config.php. les constants no van dins les cometes, s'enganxen amb el punt
if (massaCurt($usuari['usuari'], MIN_USUARI)) {
    $errors[] = "El nom d'usuari ha de tenir com a mínim " . MIN_USUARI . ' caràcters.';
}

if (massaCurt($clau, MIN_CLAU)) {
    $errors[] = 'La contrasenya ha de tenir com a mínim ' . MIN_CLAU . ' caràcters.';
}

if ($clau !== $clau2) {
    $errors[] = 'Les contrasenyes no coincideixen.';
}

// el codi postal no es obligatori, nomes el miro si l'han omplert
// el patro /^[0-9]{5}$/ vol dir exactament 5 numeros i res mes
if ($usuari['cp'] !== '') {
    if (!preg_match('/^[0-9]{5}$/', $usuari['cp'])) {
        $errors[] = 'El codi postal ha de tenir exactament 5 xifres.';
    }
}

// la primera opcio del desplegable te el value buit
if ($usuari['tipus'] === '') {
    $errors[] = 'Has de triar un tipus de client.';
}

// si la casella no s'ha marcat no existeix dins $_POST
if (!isset($_POST['condicions'])) {
    $errors[] = "Has d'acceptar les condicions del servei.";
}

// ampliacio 2: el missatge segons el tipus de client ara el fa la funcio missatgeTipus()
$missatgeTipus = missatgeTipus($usuari['tipus']);

// 5. el titol depen de si hi ha errors, per aixo el calculo ABANS d'incloure el header.
// si ho fes despres, el header ja hauria escrit el <title> i seria tard
if (count($errors) > 0) {
    $titolPagina = 'No s\'ha creat el compte';
} else {
    $titolPagina = 'Compte creat';
}

// 6. a partir d'aqui ja escric l'HTML
require 'header.php';
?>

    <?php if (count($errors) > 0): ?>

        <!-- hi ha errors: els mostro tots en una llista -->
        <h2>No s'ha pogut crear el compte</h2>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <!-- abans anava a registre.html, ara a la constant PAG_FORMULARI -->
        <a class="tornar" href="<?= PAG_FORMULARI ?>">Torna al formulari</a>

    <?php else: ?>

        <!-- no hi ha errors: benvinguda i taula amb el resum -->
        <!-- htmlspecialchars fa que si algu escriu codi surti com a text i no s'executi (atac XSS) -->
        <h2>Benvingut/da, <?= htmlspecialchars($usuari['nom']) ?>!</h2>
        <p>Hem creat el teu compte amb el correu <?= htmlspecialchars($usuari['correu']) ?>.</p>

        <!-- ampliacio 2: el missatge segons el tipus de client (el text l'he escrit jo, no fa falta htmlspecialchars) -->
        <p><?= $missatgeTipus ?></p>

        <!-- el foreach fa una fila per cada camp. etiqueta() canvia 'cp' per 'Codi postal', etc -->
        <table>
            <?php foreach ($usuari as $clauCamp => $valor): ?>
                <tr>
                    <th><?= etiqueta($clauCamp) ?></th>
                    <td><?= htmlspecialchars($valor) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- apartat 6: el boto del resum porta a la pagina nova gracies.php -->
        <a class="tornar" href="gracies.php">Continuar</a>

    <?php endif; ?>

<?php
// 7. el peu tanca el main, el body i el html
require 'footer.php';
