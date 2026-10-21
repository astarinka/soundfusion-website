<?php
require_once __DIR__ . '/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$artist = null;

if ($id && $id > 0) {
    $stmt = $pdo->prepare(
        'SELECT id, name, image, description FROM artists WHERE id = :id LIMIT 1'
    );
    $stmt->execute(['id' => $id]);
    $artist = $stmt->fetch();
}

if (!$artist) {
    http_response_code(404);
}

function h(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $artist ? h($artist['name']) . ' — SoundFusion' : 'Artist not found — SoundFusion' ?></title>
    <link rel="stylesheet" href="main.css">
    <style>
        .artist-detail {
            max-width: 1000px;
            margin: 48px auto;
            padding: 32px;
            display: grid;
            grid-template-columns: minmax(220px, 360px) 1fr;
            gap: 32px;
            align-items: start;
        }
        .artist-detail img {
            width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 12px;
        }
        .artist-detail h1 { margin-top: 0; }
        .artist-detail a { color: azure; }
        @media (max-width: 700px) {
            .artist-detail { grid-template-columns: 1fr; margin: 24px 16px; padding: 16px; }
        }
    </style>
</head>
<body>
    <main class="artist-detail">
        <?php if ($artist): ?>
            <img src="<?= h($artist['image']) ?>" alt="<?= h($artist['name']) ?>">
            <section>
                <h1><?= h($artist['name']) ?></h1>
                <p><?= h($artist['description']) ?></p>
                <p><a href="index.php">← Back to trending artists</a></p>
            </section>
        <?php else: ?>
            <section>
                <h1>Artist not found</h1>
                <p>The requested artist could not be found.</p>
                <p><a href="index.php">← Back to trending artists</a></p>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
