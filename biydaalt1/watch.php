<?php
$anime_id = $_GET['id'] ?? null;
$current_episode = $_GET['episode'] ?? 1;

$api_url = "https://api.jikan.moe/v4/anime/{$anime_id}/episodes";
$response = file_get_contents($api_url);
$episode_data = json_decode($response, true);
$episodes = $episode_data['data'] ?? [];

$current_episode_index = $current_episode - 1;
$selected_episode = $episodes[$current_episode_index] ?? null;

$next_episode = $current_episode < count($episodes) ? $current_episode + 1 : null;
$prev_episode = $current_episode > 1 ? $current_episode - 1 : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Episode Player - <?= htmlspecialchars($selected_episode['title'] ?? 'Unknown') ?></title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #333;
      color: white;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 50px;
      border-radius: 5px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
    }

    .container {
      display: flex;
      flex-direction: row;
      align-items: flex-start;
      justify-content: center;
      padding: 20px;
      gap: 20px;
    }

    .player-container {
      flex: 3;
      height: 70vh;
      position: relative;
    }

    .player-section iframe {
      width: 100%;
      height: 90vh;
      border: none;
    }

    .navigation-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .button {
      background-color: #007bff;
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
    }

    .info-section {
      flex: 1;
      max-width: 400px;
      text-align: center;
    }

    .info-section h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .info-section p {
      font-size: 16px;
      color: #555;
    }

    .episode-list ul {
      list-style: none;
      padding: 0;
    }

    .episode-list ul li {
      margin: 5px 0;
    }

    .episode-list ul li a {
      text-decoration: none;
      color: #007bff;
    }

    .footer {
      text-align: center;
      padding: 10px;
      background-color: #333;
      color: white;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="logo">
      <img
        src="https://cdn.dribbble.com/userupload/10008676/file/original-4790efe7d328855b920b19eef6f67ff1.jpg?resize=400x300&vertical=center"
        alt="Anime"
        style="height: 50px; vertical-align: middle" />
      <span style="margin-left: 10px">Storm Anime</span>
    </div>

    <div class="nav-links">
      <a href="popular.php">Popular Anime</a>
      <a href="anime-list.php">Anime List</a>
      <a href="genres.php">Genres</a>
    </div>
  </div>

  <div class="container">
    <?php if (!empty($selected_episode)): ?>
      <div class="player-container">
        <div class="player-section">
          <iframe
            src="<?= htmlspecialchars('http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4') ?>"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
        <div class="navigation-buttons">
          <?php if ($prev_episode): ?>
            <a class="button" href="?id=<?= urlencode($anime_id) ?>&episode=<?= $prev_episode ?>">Previous Episode</a>
          <?php endif; ?>
          <?php if ($next_episode): ?>
            <a class="button" href="?id=<?= urlencode($anime_id) ?>&episode=<?= $next_episode ?>">Next Episode</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="info-section">
        <h1 class="anime-title">Episode: <?= htmlspecialchars($selected_episode['title'] ?? 'Unknown Title') ?></h1>
        <p class="anime-description">Description: <?= htmlspecialchars($selected_episode['description'] ?? 'No description available.') ?></p>
        <div class="episode-list">
          <h3>Episodes</h3>
          <ul>
            <?php foreach ($episodes as $index => $eachEpisode): ?>
              <li><a href="?id=<?= urlencode($anime_id) ?>&episode=<?= $index + 1 ?>">Episode <?= $index + 1 ?>: <?= htmlspecialchars($eachEpisode['title'] ?? 'Untitled') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php else: ?>
      <p>Episode not found or ID missing!</p>
    <?php endif; ?>
  </div>

  <div class="footer">
    <p>&copy; 2024 AnimePlayer. All rights reserved.</p>
  </div>
</body>

</html>