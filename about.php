<?php
    session_start();

    require_once __DIR__ . '/include/header.php';
    
?>

<!-- Cards for landing page -->
<h1 class="text-center" id="index-heading">Om Oss</h1>

<div class="container">
    <div class="text-center">
        <div class="card-deck" id="bg-color">
            <div class="card" id="bg-color">
                <h2 class="card-title">Studenter</h5>
                <p class="card-text">New Home ble lagd av 4 studenter i USN.
                Vi bestemte oss å lage applikasjonen fordi vi liker å ha et system på linker.
                Vi synes bokmerker på nettleseren ikke var godt nok.
                Første halvåret på dette porsjektet ble å finne ut ideer
                og hvordan vi skulle fullføre oppgaven vår.
                Siste halvåret har blitt å gjøre oppgaven vår ferdig.</p>
            </div>
                <div class="card" id="bg-color">
                <h2 class="card-title">New Home</h5>
                <p class="card-text">New Home er et sted for deg som har mange linker, og
                liker å ha et system på det du trenger.
                Vi er her for å gjøre hverdagen din litt lettere.
                Du slipper å leite eller miste linkene dine, som du kanskje trenger senere.
                Med en litt enklere hverddag blir livet litt bedre.</p>
                
            </div>
        </div>
    </div>
</div>

<?php
    require_once __DIR__ . '/include/footer.php';