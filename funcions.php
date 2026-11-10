<?php
declare(strict_types=1);
/*
    ACTIVITAT 6 · Modularitzar el codi
    funcions.php: totes les funcions pròpies del projecte.

    APARTAT 3 · funcions.php
    - camp(): recull un camp de text del formulari ja net d'espais.
    - etiqueta(): converteix la clau de l'array en un text llegible per a la taula.
    - Totes porten tipus als paràmetres, tipus de retorn i el seu PHPDoc.
    - Aquest fitxer tampoc escriu res a la pantalla, només declara funcions.

    A l'entrega diu "les quatre funcions", així que a part de camp() i etiqueta()
    he passat a funcions dues coses més de l'Activitat 3:
    - massaCurt(): la comprovació de la llargada mínima, que estava repetida
      (nom d'usuari i contrasenya).
    - missatgeTipus(): el missatge segons el tipus de client (l'ampliació 2).
*/

/**
 * Recull un camp de text del formulari ja net d'espais.
 *
 * @param string $camp    Nom del camp (l'atribut name del formulari)
 * @param string $defecte Valor si el camp no ha arribat
 * @return string         El valor net
 */
function camp(string $camp, string $defecte = ''): string
{
    // es el mateix que feia a l'activitat 3 dotze vegades, pero escrit un sol cop.
    // ?? posa el valor per defecte si el camp no ha arribat, i trim() treu els espais
    return trim($_POST[$camp] ?? $defecte);
}

/**
 * Converteix la clau de l'array en una etiqueta llegible.
 *
 * @param string $clau Clau de l'array ('cp', 'naixement'...)
 * @return string      Etiqueta per mostrar a la taula
 */
function etiqueta(string $clau): string
{
    // un array amb el nom intern de cada camp i el text que vull que vegi l'usuari
    $noms = [
        'nom'        => 'Nom',
        'cognoms'    => 'Cognoms',
        'naixement'  => 'Data de naixement',
        'telefon'    => 'Telèfon',
        'correu'     => 'Correu electrònic',
        'usuari'     => "Nom d'usuari",
        'carrer'     => 'Carrer i número',
        'poblacio'   => 'Població',
        'cp'         => 'Codi postal',
        'tipus'      => 'Tipus de client',
        'origen'     => 'Com ens has conegut',
        'butlleti'   => 'Vol rebre ofertes',
        'condicions' => 'Accepta les condicions',
    ];

    // si la clau no esta a la llista no peta: torna el nom amb la primera lletra en majuscula
    return $noms[$clau] ?? ucfirst($clau);
}

/**
 * Diu si un text té menys caràcters dels que toca.
 *
 * @param string $text   El text que vull comprovar
 * @param int    $minim  Quants caràcters ha de tenir com a mínim
 * @return bool          true si és massa curt
 */
function massaCurt(string $text, int $minim): bool
{
    // strlen compta els caracters del text
    return strlen($text) < $minim;
}

/**
 * Torna el missatge que toca segons el tipus de client.
 *
 * @param string $tipus El tipus de client triat ('particular', 'empresa' o 'estudiant')
 * @return string       El missatge per mostrar al resum
 */
function missatgeTipus(string $tipus): string
{
    // igual que l'ampliacio 2 de l'activitat 3, pero ara dins d'una funcio
    if ($tipus === 'empresa') {
        return 'Com que ets una empresa, et farem factura de totes les compres.';
    } elseif ($tipus === 'estudiant') {
        return 'Com que ets estudiant, tens un 10% de descompte a tota la botiga.';
    } else {
        return "Com que ets particular, tens l'enviament gratis a partir de 50 €.";
    }
}

// no tanco el php al final per si queda algun espai, igual que a config.php
