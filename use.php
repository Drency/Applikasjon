<?php
    session_start();

    
    require_once __DIR__ . '/include/header.php';
?>


<!-- Cards for use page -->
<h1 class="text-center" id="use-heading">Hvordan bruke applikasjonen</h1>
<div class="container" style="width:100%; margin-left:50%; margin:auto; display:block;">
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/login.png" alt="Logg Inn" style="width:120%">
            <div class="caption">
                <p>Det første du må gjøre er å logge inn på accounten din. logg inn knappen finner du opp i høyre hjørne
                    på nettsiden.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/registrerdeg.png" alt="registrerdeg" style="width:120%">
            <div class="caption">
                <p>Her kan du logge inn. Om du ikke har en account kan du registrere deg, som du ser på bilde.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/ferdigregistrert.png" alt="ferdigregistrert" style="width:120%">
            <div class="caption">
                <p>Dersom du ikke har en bruker, vil du få muligheten til å registrere en ny bruker. Her blir du nødt til å lage et brukernavn, 
                sette inn en e-mail som du bruker og ha et passord som du kan huske. Deretter vil du ha muligheten til å registrere brukeren med den 
                informasjonen som du har fylt inn. Etter registrering kan du trykke på knappen som er innrammet på bildet og bli videreført til en logg inn side.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/nymappe.png" alt="nymappe" style="width:120%">
            <div class="caption">
                <p>Du har muligheten til å lage en ny mappe under din egen bruker.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/navnmappe.png" alt="navnmappe" style="width:120%">
            <div class="caption">
                <p>Etter du har valgt en ny mappe, vil du få opp en tekstboks hvor du har muligheten til å velge navnet på mappen din.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/klikkmappa.png" alt="klikkmappa" style="width:120%">
            <div class="caption">
                <p>Etter du har opprettet en ny mappe vil den komme opp under "Ny mappe" knappen. Som vist i et eksempel her så har vi kalt mappen NewHome.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/nyknapper.png" alt="nyknapper" style="width:120%">
            <div class="caption">
                <p>Når du trykker på mappen din vil du få opp 4 nye knapper. Disse knappene velges ettersom hva du skal lagre. Dersom du skal lagre en fil 
                vil du trykke på fil og det samme dersom du vil lagre en link.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/leggtilimappa.png" alt="leggtilimappa" style="width:120%">
            <div class="caption">
                <p>Her er et eksempel på når du trykker på "Link". Du vil kunne kopiere URL'en på ønsket link og laget et navn slik at du kan huske den eller 
                skille den mellom andre linker.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/eksempelforlink.png" alt="eksempelforlink" style="width:120%">
            <div class="caption">
                <p>Som vist i eksempel, her har vi kalt filen "vg" og deretter vist til URL'en som leder til VG sin nettside.</p>

            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/lagttillink.png" alt="lagttillink" style="width:120%">
            <div class="caption">
                <p>Etter linken er lagt til vil det se slikt ut. Til høyre vil du se "delete" dersom du vil fjerne enkelte ting som du har lagret.</p>
            </div>
        </div>
    </div>
    <div class="col-4" id="midtstill">
        <div class="thumbnail">
            <img src="img/logout.png" alt="logout" style="width:120%">
            <div class="caption">
                <p>Helt oppe til høyre på applikasjonen vil du se en rød "Logg ut" knapp. Denne vil du bruke dersom du ikke lengre skal bruke 
                applikasjonen på tidligere brukt enhet. Det vil fortsatt være mulig å logge seg inn fra samme eller en annen enhet om ønsket.</p>
            </div>
        </div>
    </div>
</div>




<?php
    require_once __DIR__ . '/include/footer.php';