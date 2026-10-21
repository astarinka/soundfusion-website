<?php
require_once 'db.php';

$stmt = $pdo->query("
    SELECT *
    FROM artists
    WHERE is_trending = 1
    ORDER BY id ASC
    LIMIT 4
");

$artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundFusion</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="header-color">
        <header class="container">
            <span class="logo"><a href="index.php">SoundFusion</a></span>
            <nav>
                <ul>
                    <li class="act"><a href="#">Home</a></li>
                    <li><a href="#">Music</a></li>
                    <li><a href="#">About us</a></li>
                </ul>
            </nav>
        </header>
    </div>

        <div class="hero container">
            <div class="hero-text">
                <h1>Voices of a Generation</h1>
                <h2>Experience the music that changed the world and the artists shaping tomorrow.</h2>
                <button class="btn">Watch now</button>
            </div>
                <img src="heromain.svg" alt="">
        </div>

    <div class="trend">
        <div class="container">
            <a href="#" class="see-all">SEE ALL</a>
            <h3>Trending artists</h3>

            <div class="cards">

            <?php foreach ($artists as $artist): ?>

                <div class="block">
                    <img src="<?= htmlspecialchars($artist['image']) ?>" alt="">

                    <span>
                        <img src="fire.png" alt="">
                        <?= htmlspecialchars($artist['name']) ?>
                    </span>

                    <p>
                        <?= htmlspecialchars($artist['description']) ?>
                    </p>

                    <div class="see-more">
                        <a href="artist.php?id=<?= $artist['id'] ?>">See more <img src="more.png" alt=""></a>
                    </div>
                </div>

    <?php endforeach; ?>

        </div>
        </div>
    </div>
</body>

</html>