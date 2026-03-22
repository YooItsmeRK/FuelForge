<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FuelForge | Recipes For Real Men</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background-color: #050505;
      color: white;
      height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
      overflow-x: hidden;
    }



    /* Main Hero Area */
    .main-hero {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      text-align: center;
    }

    .hero-title-complex {
      font-family: 'Cinzel', serif;
      font-weight: 900;
      line-height: 1;
      z-index: 2;
      position: relative;
    }

    .hero-title-complex .line1 {
      font-size: 5.5rem;
      position: relative;
    }

    .hero-title-complex .for-text {
      color: #ff5722;
      font-size: 3rem;
      text-transform: uppercase;
      font-family: 'Rockwell', serif;
      font-weight: 900;
      vertical-align: super;
      margin-left: -10px;
    }

    .hero-title-complex .line2 {
      font-size: 6.5rem;
      display: block;
      margin-top: -15px;
    }

    .orange-text {
      background: -webkit-linear-gradient(#fca311, #d64000);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .white-text {
      color: #e6e6e6;
      background: -webkit-linear-gradient(#ffffff, #b0b0b0);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .subtitle {
      font-family: 'Inter', sans-serif;
      color: #ff9800;
      font-size: 1.25rem;
      font-weight: 700;
      margin-top: -10px;
      z-index: 3;
      position: relative;
      letter-spacing: 0.5px;
    }

    .pan-image-container {
      position: relative;
      width: 100%;
      max-width: 700px;
      margin-top: -90px;
      z-index: 1;
      display: flex;
      justify-content: center;
    }

    /* Fallback styling to simulate the pan image until actual assets are loaded */
    .pan-image-container img {
      width: 100%;
      height: 450px;
      object-fit: contain;
      filter: drop-shadow(0 0 30px rgba(255, 69, 0, 0.4));
    }

    /* Bottom Tags Bar */
    .bottom-tags {
      width: 100%;
      max-width: 900px;
      margin: auto auto 40px auto;
      border-top: 1px solid rgba(255, 255, 255, 0.3);
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 0;
      z-index: 3;
      position: relative;
    }

    .bottom-tags div {
      flex: 1;
      text-align: center;
      font-weight: 800;
      font-size: 1.3rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      font-family: 'Inter', sans-serif;
      color: white;
    }

    .bottom-tags div:not(:last-child) {
      border-right: 2px solid white;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .hero-title-complex .line1 {
        font-size: 3rem;
      }

      .hero-title-complex .line2 {
        font-size: 3.5rem;
      }

      .hero-title-complex .for-text {
        font-size: 1.5rem;
      }

      .bottom-tags {
        flex-direction: column;
        border: none;
      }

      .bottom-tags div {
        border: none !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
        padding: 10px 0;
      }
    }
  </style>
</head>

<body class="scroll-animate">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Main Content Area -->
  <div class="main-hero">

    <!-- Background Full Page Carousel -->
    <div id="bgCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
      style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0;">
      <div class="carousel-inner" style="width: 100%; height: 100%;">
        <div class="carousel-item active" data-bs-interval="4000" style="height: 100%;">
          <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to bottom, rgba(5,5,5,0.7) 0%, rgba(5,5,5,0.4) 50%, rgba(5,5,5,0.9) 100%); z-index: 1;">
          </div>
          <img
            src="https://images.unsplash.com/photo-1600891964092-4316c288032e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
            style="object-fit: cover; width: 100%; height: 100%;" alt="Steak">
        </div>
        <div class="carousel-item" data-bs-interval="4000" style="height: 100%;">
          <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to bottom, rgba(5,5,5,0.7) 0%, rgba(5,5,5,0.4) 50%, rgba(5,5,5,0.9) 100%); z-index: 1;">
          </div>
          <img
            src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
            style="object-fit: cover; width: 100%; height: 100%;" alt="Ribs">
        </div>
        <div class="carousel-item" data-bs-interval="4000" style="height: 100%;">
          <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to bottom, rgba(5,5,5,0.7) 0%, rgba(5,5,5,0.4) 50%, rgba(5,5,5,0.9) 100%); z-index: 1;">
          </div>
          <img
            src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
            style="object-fit: cover; width: 100%; height: 100%;" alt="Power Bowl">
        </div>
      </div>
    </div>

    <!-- Title Text -->
    <div class="hero-title-complex mt-auto" style="padding-top: 40px;">
      <div class="line1">
        <span class="white-text">Recipes </span><span class="for-text">FOR</span>
      </div>
      <div class="line2">
        <span class="orange-text">R</span><span class="white-text">eal </span><span class="white-text">M</span><span
          class="white-text">en</span>
      </div>
    </div>

    <div class="subtitle mb-auto">Fuel Your Body. Forge Your Meals.</div>

    <!-- Bottom Categories Bar -->
    <div class="bottom-tags mt-auto mb-4">
      <div>BBQ GRILLING</div>
      <div>HIGH PROTEIN MEALS</div>
      <div>QUICK MEALS</div>
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>

</html>