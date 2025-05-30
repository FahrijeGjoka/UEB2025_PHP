<?php
// KËRKESA: ERROR HANDLER
set_error_handler("customErrorHandler");

function customErrorHandler($errno, $errstr, $errfile, $errline, $errcontext = [])
{
    echo "<div style='color: red; font-weight: bold;'>
        <p><u>Gabim i personalizuar!</u></p>
        <p><b>Gabimi:</b> [$errno] $errstr</p>
        <p><b>Skedari:</b> $errfile</p>
        <p><b>Linja:</b> $errline</p>
    </div>";
    return true;
}

// DEFINIMI I KLASAVE
class PerfumeMedia
{
    protected $title;
    protected $filePath;

    public function __construct($title, $filePath)
    {
        $this->title = $title;
        $this->filePath = $filePath;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    public function displayMedia()
    {
        return "<video controls><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }

    public function __destruct()
    {
        echo "<p style='color: gray;'>Objekti për '{$this->title}' u shkatërrua.</p>";
    }
}

class WomensPerfume extends PerfumeMedia
{
    public function displayMedia()
    {
        return "<video controls poster='women_thumbnail.png'><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }
}

class MensPerfume extends PerfumeMedia
{
    public function displayMedia()
    {
        return "<video controls poster='men_thumbnail.png'><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }
}

class AudioMedia extends PerfumeMedia
{
    public function displayMedia()
    {
        return "<audio controls><source src='" . $this->filePath . "' type='audio/mpeg'>Your browser does not support the audio tag.</audio>";
    }
}

// KËRKESA: TRAJTIMI I PËRJASHTIMEVE
class SecurePerfumeMedia extends PerfumeMedia
{
    public function __construct($title, $filePath)
    {
        if (empty($title)) {
            throw new Exception("Titulli nuk mund të jetë bosh! Ju lutem jepni emrin e parfumit.");
        }
        parent::__construct($title, $filePath);
    }
}

try {
  //  $invalidMedia = new SecurePerfumeMedia("", "missing.mp4"); 
} catch (Exception $e) {
    echo "<p style='color:red;'>Përjashtim i kapur: " . $e->getMessage() . "</p>";
}

// KRIJIMI I OBJEKTEVE
$womenPerfume = new WomensPerfume("Women's Perfume", "video/women perfumes.mp4");
$menPerfume = new MensPerfume("Men's Perfume", "video/men perfumes.mp4");
$arome = new AudioMedia("Arom&eacute;", "video/arome.mp3");
$blackFriday = new AudioMedia("Black Friday", "video/discount.mp3");

// KËRKESA 25: GABIM I PERSONALIZUAR
if (empty($arome->getFilePath())) {
    trigger_error("Gabim: Skedari për Aromé mungon!", E_USER_WARNING);
}

$mediaList = [
    $womenPerfume,
    $menPerfume,
    $arome,
    $blackFriday
];
$companyName = "Arom&eacute;";
$title = "Arom&eacute;'s Perfume Media Collection";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Video</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(244, 211, 211);
            color: #333;
        }

        header,
        footer {
            background-color: #eacaca;
            color: #2c3e50;
            text-align: center;
            padding: 1rem 0;
        }

        header h1 {
            font-size: 2.5rem;
            margin: 0;
            font-style: italic;
            margin: 20px;
        }

        footer p {
            font-size: 1rem;
            margin: 20px;
        }

        main {
            padding: 2rem;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            align-items: center;
            color: #2c3e50;
            font-weight: bold;
            margin: 100px auto;
            background-color: #eacaca;
            box-shadow: 0 4px 6px #2c3e50;
        }

        td,
        th {
            border: 1px solid #2c3e50;
            padding: 1rem;
            text-align: center;
        }

        th {
            background-color: #eacaca;
            color: #2c3e50;
        }

        video,
        audio {
            width: 100%;
            max-width: 300px;
            max-height: 500px;
        }
    </style>
</head>

<body>

    <header>
        <h1><?php echo $title; ?></h1>
    </header>

    <main>

        <table>
            <thead>
                <tr>
                    <th>Lloji i Mediave</th>
                    <th>Përmbajtja</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mediaList as $media): ?>
                    <tr>
                        <td><?php echo $media->getTitle(); ?></td>
                        <td><?php echo $media->displayMedia(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y") . " " . $companyName; ?> Perfume Media. Të gjitha të drejtat e rezervuara.</p>
    </footer>

</body>

</html>