<?php 
    require_once __DIR__ . '/include/header.php';  
?>



    <!-- Heading for landingpage -->
<h1 class="text-center" id="index-heading">New Home</h1>

<div class="card-deck" id="bg-color">
    <div class="card" id="bg-color">
        <h5 class="card-title">Brukerveiledning</h5>
        <p class="card-text">Trykk på knappen under om du trenger hjelp til bruken av New Home.</p>
        <a href="use.html" class="btn btn-light">Brukerveiledning</a>
    </div>
    <div class="card" id="bg-color">
        <h5 class="card-title">Om Oss</h5>
        <p class="card-text">Om du vil lære mer om oss i New Home kan du trykke på knappen under.</p>
        <a href="about.html" class="btn btn-light">Brukerveiledning</a>
    </div>
    <div class="card" id="bg-color">
        <h5 class="card-title">Registrering / Logg inn</h5>
        <p class="card-text">Her kan du registrere deg som ny bruker eller logg inn hvis du er eksisterende bruker</p>
        <a href="login.php" class="btn btn-light">Brukerveiledning</a>
    </div>
</div>
<div style="height: 555px;" id="bg-color"></div>
<?php
include_once __DIR__ . '/include/footer.php';
