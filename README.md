# SoundFusion

A PHP and MySQL music website featuring a list of trending artists.

## Tech stack

- PHP (PDO)
- MySQL
- HTML and CSS

## Features

- Loads trending artist cards from MySQL.
- Displays artist images and descriptions.
- Includes an artist detail page linked from each card.

## Local setup with Laragon

1. Start Apache and MySQL in Laragon.
2. Create an empty MySQL database named `soundfusion` using `utf8mb4`.
3. Import `database/soundfusion.sql` into that database.
4. Copy `config.example.php` to `config.local.php`.
5. Edit `config.local.php` with your local MySQL username and password. For a default Laragon-only setup, these may differ from the example placeholders.
6. Open `http://localhost/soundfusion/`.

`config.local.php` is intentionally excluded from Git. Never commit real database credentials. The included SQL file contains demo artist entries, not a production dataset.
