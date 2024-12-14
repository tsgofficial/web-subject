<?php
$api_url = "https://api.jikan.moe/v4/genres/anime";
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$genres = $data['data'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anime Player - Genres</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #ffffff;
      margin: 0;
      padding: 0;
    }

    .genres {
      padding: 20px;
    }

    .anime-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
    }

    .anime-item {
      background-color: #222;
      border-radius: 8px;
      text-align: center;
      overflow: hidden;
      text-decoration: none;
      color: #ffffff;
    }

    .anime-item img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .anime-item h3 {
      font-size: 18px;
      margin: 10px 0 5px;
    }

    .anime-item p {
      font-size: 14px;
      color: #aaa;
      padding: 0 10px 10px;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <a
      href="index.html"
      class="logo"
      style="text-decoration: none; color: inherit">
      <img
        src="https://cdn.dribbble.com/userupload/10008676/file/original-4790efe7d328855b920b19eef6f67ff1.jpg?resize=400x300&vertical=center"
        alt="Anime"
        style="height: 50px; vertical-align: middle" />
      <span style="margin-left: 10px">Storm Anime</span>
    </a>

    <div class="nav-links">
      <a href="popular.php">Popular Anime</a>
      <a href="anime-list.php">Anime List</a>
    </div>
  </div>

  <div class="genres">
    <section>
      <h2>Genres</h2>
      <div class="anime-grid">
        <?php foreach ($genres as $genre): ?>
          <a class="anime-item">
            <!-- <img
              src="<?= $genre['url'] ?>"
              alt="<?= htmlspecialchars($genre['name']) ?>" /> -->
            <h3><?= htmlspecialchars($genre['name']) ?></h3>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
  <footer class="footer">
    <p>&copy; 2024</p>
  </footer>
</body>

</html>