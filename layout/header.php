<?php
ob_start();

use Launch\PDFGenerator;

require_once 'vendor/autoload.php';

if (isset($_POST['flight']))
{
    if (is_numeric($_POST['flight_number']) === false)
    {
        echo '<p>The value ['.$_POST['flight_number'] .'] is not numeric flight number.</p>' . PHP_EOL;
    }
    else
    {
        require_once 'vendor/TCPDF/tcpdf.php';
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Alexander Cvetkov');
        $pdf->SetTitle('flight_mission_' . $_POST['flight_number']);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage();

        $launchPage = new PDFGenerator($_POST['flight_number']);
        $pdf->writeHTML($launchPage->getContent(), true, false, true, false, '');

        $pdf->lastPage();
        ob_end_clean();
        $pdf->Output('flight_mission_'.$_POST['flight_number'].'.pdf', 'I');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Space X Launches</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .homeimages {
            vertical-align: middle;
            border-style: none;
            height: 220px;
        }
        .patches {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="jumbotron text-center" style="margin-bottom:0">
        <h1>Space X Launches</h1>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allLaunches.php">All launches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upcomingLaunches.php">Upcoming launches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pastLaunches.php">Past launches</a>
                </li>
            </ul>
        </div>
    </nav>
