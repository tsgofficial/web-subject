<?php
$anime_id = $_GET['id'] ?? null;

if ($anime_id) {
  $api_url = "https://api.jikan.moe/v4/anime/{$anime_id}";
  $response = file_get_contents($api_url);
  $anime_data = json_decode($response, true);

  if (!empty($anime_data['data'])) {
    $anime = $anime_data['data'];
  } else {
    $error_message = "Anime not found!";
  }
} else {
  $error_message = "No anime ID provided!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anime Featuring - <?= htmlspecialchars($anime['title'] ?? 'Unknown') ?></title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      color: #fff;
      background-color: #121212;
      line-height: 1.6;
      padding: 20px;
    }

    .hero {
      display: flex;
      align-items: center;
      padding: 2rem;
      background: linear-gradient(120deg,
          rgba(0, 0, 0, 0.8),
          rgba(18, 18, 18, 0.9)),
        url("<?= $anime['images']['jpg']['image_url'] ?? 'fallback_image_url.jpg' ?>") center/cover;
      border-radius: 8px;
    }

    .hero img {
      width: 300px;
      height: auto;
      border-radius: 8px;
      margin-right: 2rem;
    }

    .hero-content h1 {
      font-size: 2.5rem;
      color: #e91e63;
      margin-bottom: 1rem;
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
      color: #ddd;
    }

    .anime-details {
      margin-top: 2rem;
    }

    .anime-details h2 {
      font-size: 2rem;
      color: #e91e63;
      margin-bottom: 1rem;
    }

    .anime-info {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      margin-top: 1rem;
      color: #ccc;
    }

    .anime-info div {
      flex: 1;
      min-width: 200px;
    }

    .anime-info h3 {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
      color: #e91e63;
    }

    .rating {
      display: flex;
      align-items: center;
      font-size: 1.5rem;
      margin-top: 0.5rem;
    }

    .rating span {
      font-size: 2rem;
      color: #ff9800;
      margin-right: 5px;
    }

    /* Watch Button */
    .watch-button {
      display: inline-block;
      padding: 0.8rem 1.5rem;
      font-size: 1.2rem;
      background-color: #e91e63;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 2rem;
      transition: background-color 0.3s;
    }

    .watch-button:hover {
      background-color: #d81b60;
    }
  </style>
</head>

<body>
  <?php if (isset($anime)): ?>
    <section class="hero">
      <img src="<?= $anime['images']['jpg']['image_url'] ?>" alt="<?= htmlspecialchars($anime['title']) ?>" />
      <div class="hero-content">
        <h1><?= htmlspecialchars($anime['title']) ?></h1>
        <div class="rating"><span><?= $anime['score'] ?? 'N/A' ?></span> / 10</div>
        <p><?= htmlspecialchars($anime['synopsis'] ?? 'No description available.') ?></p>
        <a href="watch.php?id=<?= $anime_id ?>" class="watch-button">Watch Now</a>
      </div>
    </section>

    <section class="anime-details">
      <h2>Anime Details</h2>
      <div class="anime-info">
        <div>
          <h3>Genres</h3>
          <p>
            <?= implode(', ', array_map(fn($genre) => $genre['name'], $anime['genres'] ?? [['name' => 'N/A']])) ?>
          </p>
        </div>
        <div>
          <h3>Release Date</h3>
          <p><?= $anime['aired']['from'] ?? 'N/A' ?></p>
        </div>
        <div>
          <h3>Seasons</h3>
          <p><?= $anime['episodes'] ?? 'N/A' ?> Episodes</p>
        </div>
        <div>
          <h3>Studio</h3>
          <p><?= implode(', ', array_column($anime['studios'] ?? [], 'name')) ?? 'N/A' ?></p>
        </div>
      </div>
      <div>
        <h3>Plot Summary</h3>
        <p><?= htmlspecialchars($anime['synopsis'] ?? 'No plot summary available.') ?></p>
      </div>
    </section>
  <?php else: ?>
    <p><?= $error_message ?? 'Anime not found or ID missing!' ?></p>
  <?php endif; ?>
</body>

</html>