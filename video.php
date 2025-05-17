<?php
//Perdorimi i klasave, trashegimise, modifikatorit protected, konstruktorit, destruktorit, metodave get dhe set
class PerfumeMedia {
    protected $title;
    protected $filePath;

    public function __construct($title, $filePath) {
        $this->title = $title;
        $this->filePath = $filePath;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function displayMedia() {
        return "<video controls><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }

    public function __destruct() {
        echo "<p>Object for '{$this->title}' is being destroyed.</p>";
    }
    
}
class WomensPerfume extends PerfumeMedia {
    public function displayMedia() {
        return "<video controls poster='women's thumbnail.png'><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }
}
class MensPerfume extends PerfumeMedia {
    public function displayMedia() {
        return "<video controls poster='men's thumbnail.png'><source src='" . $this->filePath . "' type='video/mp4'>Your browser does not support the video tag.</video>";
    }
}
class AudioMedia extends PerfumeMedia {
    public function displayMedia() {
        return "<audio controls><source src='" . $this->filePath . "' type='audio/mpeg'>Your browser does not support the audio tag.</audio>";
    }
}

$womenPerfume = new WomensPerfume("Women's Perfume", "women perfumes.mp4");
$menPerfume = new MensPerfume("Men's Perfume", "men perfumes.mp4");
$arome = new AudioMedia("Arom&eacute;", "arome.mp3");
$blackFriday = new AudioMedia("Black Friday", "discount.mp3");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Video</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(244, 211, 211);
            color: #333;
        }
        header,footer{
            background-color: #eacaca;
            color: #2c3e50;
            text-align: center;
            padding: 1rem 0;
        }
        header h1{
            font-size: 2.5rem;
            margin: 0;
            font-style: italic;
            margin: 20px;
        }
        footer p{
            font-size: 1rem;
            margin: 20px;
        }
        main{
            padding: 2rem;
        }
        table{
            width: 70%;
            border-collapse: collapse;
            align-items: center;
            color: #2c3e50;
            font-weight: bold;
            margin-right: 200px;
            margin-left: 200px;
            margin-top: 100px;
            margin-bottom: 100px;
            background-color: #eacaca;
            box-shadow: 0 4px 6px #2c3e50;
        }
        td,th{
            border:1px solid #2c3e50;
            padding: 1rem;
            text-align: center;
        }
        th{
            background-color: #eacaca;
            color:#2c3e50;
        }
        video,audio{
            width: 100%;
            max-width: 300px;
            max-height: 500px;
        }
    </style>
</head>
    <body>
    <?php
    $title = "Arom&eacute;'s Perfume Media Collection";
    ?>

    <header>
        <h1><?php echo $title; ?></h1>
    </header>

    <main>
        <?php
$mediaList = [
    $womenPerfume,
    $menPerfume,
    $arome,
    $blackFriday
];
?>

<table>
    <thead>
        <tr>
            <th>Media Type</th>
            <th>Content</th>
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
    <?php
    $companyName = "Arom&eacute;";
    ?>

    <footer>
        <p>&copy; <?php echo date("Y") . " " . $companyName; ?> Perfume Media. All Rights Reserved.</p>
    </footer>

</body>
</html>
