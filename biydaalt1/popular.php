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
  <title>Anime Player - Popular Anime</title>
  <link rel="stylesheet" href="style.css" />

  <style>
    .popular-anime-content {
      display: flex;
    }

    .popular-anime {
      flex: 7;
      padding: 20px;
    }

    .popular-anime-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 20px;
    }

    .popular-anime-item img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      height: 300px;
      object-fit: cover;
    }

    .popular-anime-item h3 {
      font-size: 18px;
      margin: 10px 0 5px;
      color: #fff;
      display: inline-block;
    }

    .popular-anime-item p {
      font-size: 14px;
      color: #aaa;
      display: inline-block;
    }

    .top10-anime {
      flex: 3;
      padding: 20px;
    }

    .top10-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .top10-list a {
      text-decoration: none;
      color: inherit;
      display: flex;
      align-items: center;
    }

    .top10-list li {
      list-style: none;
      border-bottom: 1px solid #333;
      padding: 10px 0;
    }

    .top10-list li img {
      width: 50px;
      height: 70px;
      margin-right: 10px;
      border-radius: 4px;
    }

    .top10-list li span {
      font-size: 16px;
      display: inline-block;
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <a href="index.html" class="logo">
      <img src="https://cdn.dribbble.com/userupload/10008676/file/original-4790efe7d328855b920b19eef6f67ff1.jpg?resize=400x300&vertical=center" alt="Anime" />
      <span>Storm Anime</span>
    </a>

    <div class="nav-links">
      <a href="anime-list.php">Anime List</a>
      <a href="genres.php">Genres</a>
    </div>
  </div>

  <div class="popular-anime-content">
    <section class="popular-anime">
      <h2>Popular Anime</h2>
      <div class="popular-anime-grid">
        <?php foreach ($anime_list as $anime): ?>
          <a href="anime-detail.php?id=<?= $anime['mal_id'] ?>" class="popular-anime-item">
            <img src="<?= $anime['images']['jpg']['image_url'] ?>" alt="<?= htmlspecialchars($anime['title']) ?>" />
            <h3><?= htmlspecialchars($anime['title']) ?></h3>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="top10-anime">
      <h2>Top 10 Anime</h2>
      <ul class="top10-list">
        <?php foreach ($anime_list as $index => $anime): ?>
          <li>
            <a href="anime-detail.php?id=<?= $anime['mal_id'] ?>">
              <img src="<?= $anime['images']['jpg']['image_url'] ?>" alt="<?= htmlspecialchars($anime['title']) ?>" />
              <span><?php echo $index + 1 ?>. <?= htmlspecialchars($anime['title']) ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>

  <footer>
    <p>&copy; 2024 Storm Anime</p>
  </footer>
</body>

</html>