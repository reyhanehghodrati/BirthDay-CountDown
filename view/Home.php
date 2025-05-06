<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Birthday Page</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff7f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ffb6b9;
            color: white;
            padding: 2rem;
            text-align: center;
            border-radius: 0 0 30px 30px;
        }

        .countdown-box {
            background: white;
            padding: 1.5rem;
            margin: 1rem auto;
            border-radius: 15px;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .countdown-box h2 {
            margin: 0 0 0.5rem 0;
            color: #ff5e78;
        }

        .countdown {
            font-size: 1.2rem;
            color: #555;
        }

        .quote {
            font-style: italic;
            margin-top: 1rem;
            color: #888;
        }

        .birthdays {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            padding: 2rem;
        }

        .card {
            background: white;
            padding: 1rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0.5rem 0;
            color: #333;
        }

        .card p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body>

<header>
    <h1>Arna Vision BirthDay Core</h1>
</header>

<div class="countdown-box">
    <h2>Next Birthday: Sarah</h2>
    <div class="countdown">5 days left!</div>
    <div class="quote">"Sarah brings light wherever she goes."</div>
</div>

<section class="birthdays">
    <div class="card">
        <h3>Ali</h3>
        <p>May 8</p>
    </div>
    <div class="card">
        <h3>Fatemeh</h3>
        <p>May 12</p>
    </div>
    <div class="card">
        <h3>Reza</h3>
        <p>May 20</p>
    </div>
    <div class="card">
        <h3>Sara</h3>
        <p>May 25</p>
    </div>
</section>

</body>
</html>
