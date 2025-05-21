<style>
.cookie-banner {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #eacaca;
    color: white;
    padding: 15px;
    text-align: center;
    z-index: 9999;
}
.cookie-buttons button {
    margin: 5px;
    padding: 10px 20px;
    border: none;
    background-color: #555;
    color: white;
    cursor: pointer;
}
.cookie-buttons button:hover {
    background-color: #777;
}
</style>
<?php 
$cookieAccepted = isset($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] === 'accepted';
?>

<?php if (!$cookieAccepted): ?>
<div class="cookie-banner" id="cookieBanner">
    <p>Ne përdorim cookies për ta përmirësuar përvojën tuaj. A pranoni?</p>
    <div class="cookie-buttons">
        <button onclick="acceptCookies()">Pranoj</button>
        <button onclick="declineCookies()">Refuzoj</button>
    </div>
</div>

<script>
    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days*24*60*60*1000));
        document.cookie = name + "=" + value + ";expires=" + d.toUTCString() + ";path=/";
    }

    function acceptCookies() {
        setCookie("cookie_consent", "accepted", 365);
        document.getElementById("cookieBanner").style.display = "none";
    }

    function declineCookies() {
        setCookie("cookie_consent", "declined", 365);
        document.getElementById("cookieBanner").style.display = "none";
    }
</script>
<?php endif; ?> 