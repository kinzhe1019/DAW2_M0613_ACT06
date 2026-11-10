<?php
/*
    ACTIVITAT 6 · Modularitzar el codi
    registre.php: el formulari de registre (abans era registre.html).

    APARTAT 1 · Preparar la carpeta
    - registre.html passa a dir-se registre.php. Un .html el servidor l'envia tal qual,
      i un .php el passa abans per PHP. Com que ara inclou la capçalera i el peu,
      ha de ser .php per força.

    APARTAT 5 · Muntar les dues pàgines
    - Només hi queda el que és propi d'aquesta pàgina: el formulari.
    - El disseny de dalt i de baix surt de header.php i footer.php.
*/

// la configuracio amb require_once, aixi si algu la torna a incloure no passa res
require_once 'config.php';

// el titol s'ha de posar ABANS del require del header, si no el header no el veu
$titolPagina = 'Crea el teu compte';
require 'header.php';
?>
        <h2>Crea el teu compte</h2>
        <p class="intro">Crea el teu compte per comprar material informàtic.</p>

        <!-- action: on van les dades. method: com hi van (amb post no es veuen a la url) -->
        <form action="processa.php" method="post">

            <!-- el for del label es igual que l'id del camp, i el name es el que arriba al php -->
            <fieldset>
                <legend>Dades personals</legend>

                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom">

                <label for="cognoms">Cognoms</label>
                <input type="text" id="cognoms" name="cognoms">

                <label for="naixement">Data de naixement</label>
                <input type="date" id="naixement" name="naixement">

                <label for="telefon">Telèfon</label>
                <input type="tel" id="telefon" name="telefon">
            </fieldset>

            <fieldset>
                <legend>Dades del compte</legend>

                <label for="correu">Correu electrònic</label>
                <input type="email" id="correu" name="correu">

                <!-- ampliacio 1 de l'activitat 3: repetir el correu per comprovar que l'ha escrit be -->
                <label for="correu2">Repetir correu electrònic</label>
                <input type="email" id="correu2" name="correu2">

                <!-- el minim surt de config.php, aixi l'etiqueta i el missatge d'error diuen el mateix numero -->
                <label for="usuari">Nom d'usuari (mínim <?= MIN_USUARI ?> caràcters)</label>
                <input type="text" id="usuari" name="usuari">

                <label for="clau">Contrasenya (mínim <?= MIN_CLAU ?> caràcters)</label>
                <input type="password" id="clau" name="clau">

                <label for="clau2">Repetir contrasenya</label>
                <input type="password" id="clau2" name="clau2">
            </fieldset>

            <fieldset>
                <legend>Adreça</legend>

                <label for="carrer">Carrer i número</label>
                <input type="text" id="carrer" name="carrer">

                <label for="poblacio">Població</label>
                <input type="text" id="poblacio" name="poblacio">

                <label for="cp">Codi postal</label>
                <input type="text" id="cp" name="cp">
            </fieldset>

            <fieldset>
                <legend>Preferències</legend>

                <!-- la primera opcio te el value buit, aixi al php se si no n'ha triat cap -->
                <label for="tipus">Tipus de client</label>
                <select id="tipus" name="tipus">
                    <option value="">-- Tria'n un --</option>
                    <option value="particular">Particular</option>
                    <option value="empresa">Empresa</option>
                    <option value="estudiant">Estudiant</option>
                </select>

                <!-- els radio del mateix grup tenen el mateix name i un value diferent -->
                <p class="grup">Com ens has conegut?</p>
                <label class="linia"><input type="radio" name="origen" value="xarxes"> Xarxes socials</label>
                <label class="linia"><input type="radio" name="origen" value="amics"> Un amic o amiga</label>
                <label class="linia"><input type="radio" name="origen" value="cercador"> Cercador</label>

                <!-- les caselles tambe porten value. si no es marquen no s'envien -->
                <p class="grup">Altres</p>
                <label class="linia"><input type="checkbox" name="butlleti" value="si"> Vull rebre ofertes</label>
                <label class="linia"><input type="checkbox" name="condicions" value="si"> Accepto les condicions</label>
            </fieldset>

            <button type="submit">Crear el compte</button>

        </form>
<?php
// el peu tanca el main, el body i el html que ha obert el header
require 'footer.php';
