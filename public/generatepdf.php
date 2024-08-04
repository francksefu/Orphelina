<?php
// include autoloader
require_once __DIR__.'/../dompdf/autoload.inc.php';
require_once __DIR__.'/../features/Comptabilite.php';


use Dompdf\Dompdf;
use Dompdf\Options;


// Initialize Dompdf
$compte = new Comptabilite();

$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

// HTML content for the PDF
$facture = $compte->find_one($_GET['q']);
if ($facture) {
    $facture = $facture[0];
    $html = "
<html>
<head>
    <style>
       .flexi { color: blue; } 
       .contain { width: 60%; }
       .border { border: 1px solid black; padding: 10px; }
    </style>
</head>
<body>
    <h1 class='flexi'>Open spring</h1>
    <div class='contain'>
        <h4>{$facture['typeComptabilite']} comptabilité</h4>
        <div>date: {$facture['Date']}</div>
        <div class='flexi'>numero: {$facture['Nfacture']}</div>
        <div >date et heure d enregistrement: {$facture['heure']}</div>
        <hr>
        <div class='flexi border'>Montant: {$facture['montant']} USD</div>
        <div class='border'>Motif: <p >{$facture['motif']}</p></div>
    </div>
</body>
</html>";
} else {
    $html = "
<html>
<head>
    <style>
       .flexi { color: blue; } 
       .contain { width: 50%; }
       .border { border: 1px solid black; padding: 10px; }
    </style>
</head>
<body>
    <div class='contain'>
        <h4>Comptabilité </h4>
        <div class='flexi'>Open spring</div>
        <div>date: </div>
        <div class='flexi'>numero: </div>
        <hr>
        <div class='flexi'>Montant: </div>
        <div>Motif: <p class='border'></p></div>
    </div>
</body>
</html>";
}

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A5', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to browser
$dompdf->stream("document.pdf", ["Attachment" => 0]);
?>
