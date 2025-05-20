
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("MIN_PASS_LEN", 8);


$name = $dob = $email = $password = $confirmPassword = $phone = '';


$errors = [];


function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPassword($password) {
    return preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{" . MIN_PASS_LEN . ",}$/", $password);
}

function isValidPhone($phone) {
    return preg_match("/^\+?[0-9]{10,15}$/", $phone);
}

function isValidName($name) {
    return preg_match("/^[a-zA-Z\s]{2,50}$/", $name);
}

class User {
    public $name;
    public $email;
    protected $dob;
    protected $password;

    public function __construct($name, $email, $dob, $password) {
        $this->name = htmlspecialchars($name);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->dob = htmlspecialchars($dob);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getInfo() {
        return "Emri: $this->name <br> Emaili: $this->email <br> Data e lindjes: $this->dob";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Marrja dhe pastrimi i të dhënave
    $name = trim($_POST['name'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirmPassword'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    
    if(empty($name)) {
        $errors[] = "Emri është i detyrueshëm!";
    } elseif (!isValidName($name)) {
        $errors[] = "Emri duhet të përmbajë vetëm shkronja dhe të jetë midis 2 dhe 50 karakteresh!";
    }

    if (empty($dob)) {
        $errors[] = "Data e lindjes është e detyrueshme!";
    }

    if (empty($email)) {
        $errors[] = "Email-i është i detyrueshëm!";
    } elseif (!isValidEmail($email)) {
        $errors[] = "Email-i nuk është valid!";
    }

    if (empty($password)) {
        $errors[] = "Fjalëkalimi është i detyrueshëm!";
    } elseif (!isValidPassword($password)) {
        $errors[] = "Fjalëkalimi duhet të përmbajë të paktën një shkronjë të madhe, një të vogël, një numër, një karakter special dhe të ketë minimumi " . MIN_PASS_LEN . " karaktere.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Fjalëkalimet nuk përputhen!";
    }

    if (empty($phone)) {
        $errors[] = "Numri i telefonit është i detyrueshëm!";
    } elseif (!isValidPhone($phone)) {
        $errors[] = "Numri i telefonit nuk është valid!";
    }

    
    if (empty($errors)) {
        $user = new User($name, $email, $dob, $password);
        echo "<div class='success-message'>";
        echo "<p style='color: green; font-weight: bold;'>Regjistrimi i kryer me sukses!</p>";
        echo $user->getInfo();
        echo "</div>";
        
        
        $name = $dob = $email = $password = $confirmPassword = $phone = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css?v=1.1">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            margin: 5px 0;
            font-size: 0.9em;
        }
        .success-message {
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="form-container">
        <h1>Sign Up</h1>

        <?php if (!empty($errors)) : ?>
            <div class="error-container">
                <?php foreach ($errors as $error) : ?>
                    <p class="error-message"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="signup-form" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                <label for="name">Name</label>
            </div>

            <div class="input-container">
                <i class="fas fa-calendar-alt"></i>
                <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($dob) ?>" required>
            </div>

            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                <label for="email">Email</label>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirm-password" name="confirmPassword" required>
                <label for="confirm-password">Confirm Password</label>
            </div>

            <div class="input-container">
                <i class="fas fa-phone"></i>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
                <label for="phone">Phone Number</label>
            </div>

            <div class="button-container">
                <button type="submit" class="btn">Sign Up</button>
                <button type="reset" class="btn">Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('signup-form');

    form.addEventListener('submit', function (e) {
        let isValid = true;

        
        document.querySelectorAll('.error-message.client').forEach(el => el.remove());

        
        const name = document.getElementById('name').value.trim();
        if (!/^[a-zA-Z\s]{2,50}$/.test(name)) {
            showError('name', 'Emri duhet të përmbajë vetëm shkronja dhe të jetë midis 2 dhe 50 karakteresh!');
            isValid = false;
        }

        
        const email = document.getElementById('email').value.trim();
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('email', 'Ju lutem shkruani një email valid!');
            isValid = false;
        }

        
        const password = document.getElementById('password').value.trim();
        if (!/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password)) {
            showError('password', 'Fjalëkalimi duhet të përmbajë të paktën një shkronjë të madhe, një të vogël, një numër, një karakter special dhe të ketë minimumi 8 karaktere.');
            isValid = false;
        }

        
        const confirmPassword = document.getElementById('confirm-password').value.trim();
        if (password !== confirmPassword) {
            showError('confirm-password', 'Fjalëkalimet nuk përputhen!');
            isValid = false;
        }

        
        const phone = document.getElementById('phone').value.trim();
        if (!/^\+?[0-9]{10,15}$/.test(phone)) {
            showError('phone', 'Ju lutem shkruani një numër telefoni valid!');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const error = document.createElement('p');
        error.className = 'error-message client';
        error.textContent = message;
        field.parentNode.insertBefore(error, field.nextSibling);
    }
});
</script>
</body>
</html>