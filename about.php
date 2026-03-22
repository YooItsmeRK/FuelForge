<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | FuelForge</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background-color: #050505;
      color: white;
    }

    .about-hero {
      padding: 80px 0 40px;
      text-align: center;
    }

    .about-hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      letter-spacing: 2px;
      margin-bottom: 20px;
    }

    .about-hero-subtitle {
      font-size: 1.4rem;
      font-weight: 400;
      font-family: 'Inter', sans-serif;
    }

    .our-story-section {
      padding: 60px 0;
      text-align: center;
    }

    .section-title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 30px;
    }

    .story-text {
      max-width: 800px;
      margin: 0 auto;
      font-size: 1.25rem;
      line-height: 1.6;
      font-family: 'Inter', sans-serif;
      color: #eaeaea;
    }

    .our-mission-section {
      background-color: #0a0a0a;
      padding: 80px 0;
      text-align: center;
    }

    .mission-card {
      background-color: #1a1a1a;
      border: 1px solid #222;
      border-radius: 8px;
      padding: 30px 20px;
      height: 100%;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    }

    .mission-card h4 {
      color: #ff9800;
      font-family: 'Inter', sans-serif;
      font-size: 1.15rem;
      font-weight: 700;
      margin-bottom: 15px;
      text-transform: none;
    }

    .mission-card p {
      color: #bbbbbb;
      font-size: 0.9rem;
      line-height: 1.5;
      margin: 0;
    }

    .why-choose-section {
      background-color: #161616;
      padding: 80px 0;
      text-align: center;
    }

    .checklist-container {
      max-width: 650px;
      margin: 0 auto;
      text-align: left;
    }

    .checklist-item {
      background-color: #1e1e1e;
      border: 1px solid #333;
      padding: 15px 25px;
      margin-bottom: -1px;
      /* collapse double borders */
      font-size: 1.1rem;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      color: #e0e0e0;
      display: flex;
      align-items: center;
    }

    .checklist-item:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .checklist-item:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .checkmark {
      font-weight: bold;
      margin-right: 15px;
    }
  </style>
</head>

<body class="scroll-animate">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- About Hero -->
  <section class="about-hero scroll-animate">
    <div class="container">
      <h1 class="about-hero-title font-heading text-white">ABOUT FUELFORGE</h1>
      <p class="about-hero-subtitle text-white">Fuel Your Body. Forge Your Meals.</p>
    </div>
  </section>

  <!-- Our Story -->
  <section class="our-story-section scroll-animate">
    <div class="container text-center">
      <h2 class="section-title font-heading text-white">OUR STORY</h2>
      <p class="story-text">
        FuelForge was created to inspire men to take control of their nutrition and cooking skills. Many university
        students and gym enthusiasts struggle to find simple, powerful meals. FuelForge provides easy-to-follow recipes
        that are practical, high-protein, and built for strength.
      </p>
    </div>
  </section>

  <!-- Our Mission -->
  <section class="our-mission-section scroll-animate">
    <div class="container text-center">
      <h2 class="section-title font-heading text-white">OUR MISSION</h2>
      <div class="row justify-content-center px-lg-4 mt-5">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
          <div class="mission-card">
            <h4>Empower Independence</h4>
            <p>Encourage men to cook confidently<br>and independently.</p>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
          <div class="mission-card">
            <h4>Promote Strength</h4>
            <p>Provide high-protein and<br>performance-focused meals.</p>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
          <div class="mission-card">
            <h4>Modern Experience</h4>
            <p>Deliver a clean, interactive, and<br>responsive web experience.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose FuelForge -->
  <section class="why-choose-section scroll-animate">
    <div class="container text-center">
      <h2 class="section-title font-heading text-white mb-5">WHY CHOOSE FUELFORGE?</h2>
      <div class="checklist-container">
        <div class="checklist-item">
          <span class="checkmark">&#10003;</span> High-protein muscle-building recipes
        </div>
        <div class="checklist-item">
          <span class="checkmark">&#10003;</span> Quick and easy bachelor-friendly meals
        </div>
        <div class="checklist-item">
          <span class="checkmark">&#10003;</span> Clean and modern design
        </div>
        <div class="checklist-item">
          <span class="checkmark">&#10003;</span> Interactive search and filtering system
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>Ãƒâ€šÃ‚Â© 2026 FuelForge | Recipes for Real Men</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>

</html>