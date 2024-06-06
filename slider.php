<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <title>Slider Promocional</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style class="text/css">
.slider {
    position: relative;
    width: 80%;
    max-width: 800px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slide {
    min-width: 100%;
    position: relative;
}

.slide img {
    width: 100%;
    display: block;
}

.caption {
    position: absolute;
    bottom: 20px;
    left: 20px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px;
    border-radius: 5px;
}

.caption h2 {
    margin: 0 0 10px;
    font-size: 24px;
}

.caption p {
    margin: 0;
    font-size: 16px;
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    user-select: none;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

 </style>
   <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Promocional</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
    <div class="slider">
        <div class="slides">
            <div class="slide">
                <img src="imagenes/res/imagen1.jpg" alt="Imagen 1">
                <div class="caption">
                    <h2>Ring</h2>
                    <p>Habitacion a la comidad de tu casa...</p>
                </div>
            </div>
            <div class="slide">
                <img src="imagenes/res/imagen2.jpg" alt="Imagen 2">
                <div class="caption">
                    <h2>King</h2>
                    <p>Alberca exclusiva para todos los habitantes.</p>
                </div>
            </div>
            <div class="slide">
                <img src="imagenes/res/rojo2.jpg" alt="Imagen 3">
                <div class="caption">
                    <h2>Ocean</h2>
                    <p>La mejor vista de toda la ciudad.</p>
                </div>
            </div>
            <div class="slide">
                <img src="imagenes/res/pub.jpg" alt="Imagen 4">
                <div class="caption">
                    <h2>Size</h2>
                    <p>Actividades realistas para cualquiera.</p>
                </div>
            </div>
        </div>
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>
    </center>

    <script src="js/slider.js"></script>    
</body>
</html>