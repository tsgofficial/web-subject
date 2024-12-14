<?php
$api_url = "https://api.jikan.moe/v4/top/anime";
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$anime_list = $data['data'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anime Player - Browse Anime</title>
  <link rel="stylesheet" href="style.css" />

  <style>
    .top-rated-anime {
      padding: 20px;
    }

    .anime-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .anime-item {
      position: relative;
      width: 22%;
      margin-bottom: 20px;
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .anime-item img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .anime-info {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.3);
      color: #ffffff;
      padding: 10px;
      text-align: left;
    }

    .anime-info h3 {
      margin: 0;
      font-size: 1.2rem;
      color: #e91e63;
    }

    .anime-info p {
      margin: 5px 0 0;
      font-size: 0.9rem;
      color: #ffffff;
    }

    .anime-item:hover {
      transform: scale(1.05);
    }
  </style>
</head>

<body>
  <div class="navbar">
    <a
      href="index.php"
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
      <a href="genres.php">Genres</a>
    </div>
  </div>

  <div class="popular-anime-content">
    <section class="top-rated-anime">
      <h2>Browse Anime</h2>
      <ul class="anime-list">
        <?php foreach ($anime_list as $anime): ?>
          <li class="anime-item">
            <a href="anime-detail.php?id=<?= $anime['mal_id'] ?>">
              <img
                src="<?= htmlspecialchars($anime['images']['jpg']['image_url']) ?>"
                alt="<?= htmlspecialchars($anime['title']) ?>" />
              <div class="anime-info">
                <h3><?= htmlspecialchars($anime['title']) ?></h3>
                <p>
                  <?= htmlspecialchars(substr($anime['synopsis'] ?? 'No description available.', 0, 100)) . '...' ?>
                </p>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>


  <footer class="footer">
    <p>&copy; 2024</p>
  </footer>
</body>

</html>