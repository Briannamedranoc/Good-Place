<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

.buttons-container {
    margin-bottom: 20px;
}

.btn {
    padding: 10px 20px;
    margin: 0 10px;
    font-size: 16px;
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
}

.btn:hover {
    background-color: #0056b3;
}

.message {
    margin-top: 20px;
    padding: 10px;
    border-radius: 5px;
    display: none;
}

.message.success {
    background-color: #28a745;
    color: #fff;
}

.message.error {
    background-color: #dc3545;
    color: #fff;
}

.hidden {
    display: none;
}

    </style>

<h1>Cookie Example</h1>
<div class="buttons-container">
    <button id="setCookieBtn" class="btn">Establecer Cookie</button>
    <button id="getCookieBtn" class="btn">Obtener Cookie</button>
    <button id="deleteCookieBtn" class="btn">Eliminar Cookie</button>
</div>

<div id="message" class="message hidden"></div>

<script src="../js/cookies.js"></script>
</body>
</html>
