<!DOCTYPE html>
<html>
<head>
    <title>Number Gambling Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, #00008b, #ff0000);
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        h1 {
            color: white;
        }
        .number {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 100px;
            margin: 10px;
            perspective: 800px;
        }
        .cube {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transform: translateZ(-50px);
            transition: transform 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .cube-front, .cube-back, .cube-top, .cube-bottom, .cube-left, .cube-right {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #ff4081;
        }
        .cube-front {
            transform: rotateY(0deg) translateZ(50px);
        }
        .cube-back {
            transform: rotateY(180deg) translateZ(50px);
        }
        .cube-top {
            transform: rotateX(90deg) translateZ(50px);
        }
        .cube-bottom {
            transform: rotateX(-90deg) translateZ(50px);
        }
        .cube-left {
            transform: rotateY(-90deg) translateZ(50px);
        }
        .cube-right {
            transform: rotateY(90deg) translateZ(50px);
        }
        .number:hover .cube {
            transform: translateZ(-50px) rotateX(20deg) rotateY(20deg);
        }
        .number:hover .cube-front,
        .number:hover .cube-back,
        .number:hover .cube-top,
        .number:hover .cube-bottom,
        .number:hover .cube-left,
        .number:hover .cube-right {
            background-color: #fdd835;
        }
        .selected .cube-front,
        .selected .cube-back,
        .selected .cube-top,
        .selected .cube-bottom,
        .selected .cube-left,
        .selected .cube-right {
            background-color: #ffee58;
        }
        .decorations {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }
        .decoration {
            position: absolute;
            width: 60px;
            height: 60px;
            background-color: #ff4081;
            border-radius: 50%;
            opacity: 0.7;
            animation: move 3s ease-in-out infinite;
        }
        .decoration:nth-child(1) {
            top: 20px;
            left: 20px;
        }
        .decoration:nth-child(2) {
            top: 80px;
            right: 60px;
        }
        .decoration:nth-child(3) {
            bottom: 30px;
            right: 20px;
        }
        @keyframes move {
            0% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(-30px, -30px);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        #result {
            font-size: 28px;
            margin-top: 20px;
            color: white;
            animation: enlarge 0.5s ease-in-out;
        }
        @keyframes enlarge {
            0% {
                transform: scale(0.8);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Number Gambling Game</h1>
        <p>Choose a number:</p>
        <?php
        $luckyNumber = mt_rand(1, 6); // Generate a random lucky number (1-6)
        $colors = ['#ff4081', '#3f51b5', '#4caf50', '#f44336', '#9c27b0', '#ff9800'];
        $messages = [
            'Congratulations! You won!',
            'Better luck next time!',
            'You missed the chance!',
            'Unlucky this time!',
            'You nearly hit it!',
            'Almost there, try again!'
        ];
        shuffle($messages); // Randomize the order of messages
        for ($i = 1; $i <= 6; $i++) {
            $color = $colors[$i - 1];
            $message = $messages[$i - 1];
            echo '<div class="number" onclick="selectNumber(' . $i . ')">
                    <div class="cube">
                        <div class="cube-front" style="background-color: ' . $color . ';"></div>
                        <div class="cube-back" style="background-color: ' . $color . ';"></div>
                        <div class="cube-top" style="background-color: ' . $color . ';"></div>
                        <div class="cube-bottom" style="background-color: ' . $color . ';"></div>
                        <div class="cube-left" style="background-color: ' . $color . ';"></div>
                        <div class="cube-right" style="background-color: ' . $color . ';"></div>
                    </div>
                    <span style="position: absolute; top: 40%; left: 40%; color: white; font-size: 24px;">' . $i . '</span>
                </div>';
        }
        ?>
        <div class="decorations">
            <div class="decoration"></div>
            <div class="decoration"></div>
            <div class="decoration"></div>
        </div>
        <div id="result"></div>
    </div>

    <script>
        function selectNumber(number) {
            var numbers = document.getElementsByClassName('number');
            for (var i = 0; i < numbers.length; i++) {
                numbers[i].classList.remove('selected');
            }
            document.getElementById('result').innerHTML = '';
            var selectedNumber = document.getElementsByClassName('number')[number - 1];
            selectedNumber.classList.add('selected');
            checkLuckyNumber(number);
        }

        function checkLuckyNumber(number) {
            var luckyNumber = <?php echo $luckyNumber; ?>;
            var messages = <?php echo json_encode($messages); ?>; // Get the shuffled messages array
            var message = messages[number - 1]; // Get the corresponding message for the selected number
            document.getElementById('result').innerHTML = message;
        }
    </script>
</body>
</html>
