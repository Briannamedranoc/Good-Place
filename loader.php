<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style class="text/css">
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
       body{
            width:100%;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            
        }
        .container{
            position:relative;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .ring{
            width:200px;
            height:200px;
            border:4px solid white;
            border-radius:40%;
            position:absolute;
        }
        .ring:nth-child(1){
            border-bottom-width:8px;
            border-color:#1A30D0;
            animation:rotate1 2s linear infinite;
        }
        .ring:nth-child(2){
            border-right-width:8px;
            border-color:#071788;
            animation:rotate3 2s linear infinite;
        }
        .ring:nth-child(3){
            border-top-width:8px;
            border-color:#A1A6CB;
            animation:rotate2 2s linear infinite;
        }
        @keyframes rotate1{
            0%{
                transform:rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
            }
            100%{
                transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
            }
        }
        @keyframes rotate2{
            0%{
                transform:rotateX(50deg) rotateY(10deg) rotateZ(0deg);
            }
            100%{
                transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg);
            }
        }
        @keyframes rotate3{
            0%{
                transform:rotateX(35deg) rotateY(55deg) rotateZ(0deg);
            }
            100%{
                transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg);
            }
        }
        .loading{
            font-family:sans-serif;
            color:#000;
        }
        
    </style>

    <div class="container">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
        <span class="loading">Cargando...</span>
    </div>
    
</body>
</html>