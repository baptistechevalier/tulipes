<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('header.php');?>
    <div id="emoji">🌷</div>
    


    <script>
  const emoji = document.getElementById('emoji');
  let isVisible = false;

  function getRandomPosition() {
    const x = Math.floor(Math.random() * window.innerWidth);
    const y = Math.floor(Math.random() * window.innerHeight);
    return { x, y };
  }

  function moveEmoji() {
    const { x, y } = getRandomPosition();
    emoji.style.left = `${x}px`;
    emoji.style.top = `${y}px`;
  }

  function showAndMoveEmoji() {
    if (!isVisible) {
      emoji.style.display = 'block';
      isVisible = true;
    }
    moveEmoji();
  }

  // Faire apparaître le 🌷 toutes les minutes
  setInterval(() => {
    emoji.style.display = 'none';
    isVisible = false;

    // Après 1 minute (60000 ms), réapparaît et commence à se déplacer
    setTimeout(showAndMoveEmoji, 60000);
  }, 60000);

  // Déplacer l'emoji constamment
  setInterval(moveEmoji, 1000);
</script>    
</body>
</html>