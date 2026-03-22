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
    /* Specific styles for the Get Started / About page to match the new dark design */
    body {
      background-color: #0a0a0a;
    }



    .hero-section {
      background-color: #000000;
      color: white;
      padding-top: 50px;
    }

    .hero-title {
      font-size: 3.5rem;
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .hero-subtitle {
      font-size: 1.4rem;
      margin-bottom: 40px;
      font-family: 'Inter', sans-serif;
    }

    .hero-buttons {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      max-width: 250px;
      margin: 0 auto;
    }

    .btn-hero-primary {
      background-color: #ff5722;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 600;
      width: 100%;
      text-transform: none;
      font-size: 1.1rem;
    }

    .btn-hero-secondary {
      background-color: transparent;
      color: white;
      border: 1px solid white;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 600;
      width: 100%;
      text-transform: none;
      font-size: 1.1rem;
    }

    .btn-hero-primary:hover {
      background-color: #e64a19;
      color: white;
    }

    .btn-hero-secondary:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
    }

    /* Why FuelForge */
    .why-section {
      background-color: #0d0d0d;
      padding: 80px 0;
    }

    .why-title {
      font-size: 2.5rem;
      color: white;
      margin-bottom: 50px;
    }

    .why-card {
      background-color: #1a1a1a;
      border-radius: 10px;
      padding: 30px 20px;
      height: 100%;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    }

    .why-card h4 {
      color: #ff9800;
      /* Yellowish orange matching image */
      font-size: 1.1rem;
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      margin-bottom: 15px;
      text-transform: none;
    }

    .why-card p {
      color: #bbbbbb;
      font-size: 0.85rem;
      line-height: 1.6;
      margin: 0;
    }

    /* How It Works */
    .how-section {
      background-color: #1e1e1e;
      /* Lighter gray background */
      padding: 60px 0;
    }

    .how-title {
      font-size: 2.5rem;
      color: white;
      margin-bottom: 50px;
    }

    .step-title {
      color: #ff9800;
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 15px;
      font-family: 'Inter', sans-serif;
    }

    .step-desc {
      color: #eaeaea;
      font-size: 0.95rem;
      line-height: 1.5;
    }

    /* CTA Section */
    .cta-section {
      background-color: #000000;
      padding: 80px 0;
    }

    .cta-title {
      font-size: 2.5rem;
      color: white;
      margin-bottom: 40px;
    }

    .btn-cta {
      background-color: #ff5722;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 12px 40px;
      font-weight: 600;
      font-size: 1.2rem;
      text-transform: none;
    }

    .btn-cta:hover {
      background-color: #e64a19;
      color: white;
    }

    footer {
      background-color: #000000;
      padding: 20px 0;
      border-top: none;
      text-align: center;
    }

    footer p {
      color: #888888;
      font-size: 0.9rem;
      margin: 0;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Hero Section -->
  <section class="hero-section scroll-animate">
    <div class="container-fluid pe-0 ps-0">
      <div class="row align-items-center mb-0 m-0">
        <div class="col-lg-7 text-center px-4 mb-5 mb-lg-0" style="padding-top: 80px; padding-bottom: 80px;">
          <h2 class="hero-title font-heading text-white">
            GET STARTED<br>WITH FUELFORGE
          </h2>
          <p class="hero-subtitle">Fuel Your Body. Forge Your Meals.</p>

          <div class="hero-buttons">
            <a href="auth/register.php" class="btn btn-hero-primary">Register</a>
            <a href="auth/login.php" class="btn btn-hero-secondary">Login</a>
          </div>
        </div>

        <!-- Large image like Uncle Sam on the right -->
        <div class="col-lg-5 text-center p-0 d-none d-lg-flex align-items-end justify-content-center"
          style="position: relative;">
          <!-- Fallback placeholder image resembling the chef layout from previous design -->
          <img
            src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
            alt="Chef Pointing" class="img-fluid"
            style="max-height: 600px; width: 100%; object-fit: cover; object-position: top;">

          <!-- Gradient overlay to fade the bottom to black -->
          <div
            style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100px; background: linear-gradient(to top, #000000 0%, transparent 100%);">
          </div>
        </div>

        <!-- Mobile image placeholder -->
        <div class="col-12 text-center p-0 d-flex d-lg-none mt-2 justify-content-center" style="position: relative;">
          <img
            src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
            alt="Chef Pointing" class="img-fluid"
            style="max-height: 400px; width: 100%; object-fit: cover; object-position: top;">
          <div
            style="position: absolute; bottom: 0; left: 0; width: 100%; height: 80px; background: linear-gradient(to top, #000000 0%, transparent 100%);">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why FuelForge Section -->
  <section class="why-section scroll-animate">
    <div class="container text-center">
      <h2 class="font-heading why-title">WHY FUELFORGE?</h2>

      <div class="row justify-content-center px-lg-4">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
          <div class="why-card">
            <h4>Built for Strength</h4>
            <p>High-protein meals, BBQ classics,<br>and quick recipes designed for real<br>energy.</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
          <div class="why-card">
            <h4>Easy to Follow</h4>
            <p>Step-by-step instructions, clear<br>ingredients, and simple cooking<br>methods.</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
          <div class="why-card">
            <h4>Interactive Experience</h4>
            <p>Search, filter, and explore recipes<br>with smooth and modern design.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="how-section text-center scroll-animate">
    <div class="container">
      <h2 class="font-heading how-title">HOW IT WORKS</h2>

      <div class="row mt-5 justify-content-center">
        <!-- Step 1 -->
        <div class="col-md-4 px-4 mb-5 mb-md-0">
          <div class="step-title">Step 1</div>
          <p class="step-desc">Browse categories like BBQ,<br>High Protein, and Quick Meals.</p>
        </div>

        <!-- Step 2 -->
        <div class="col-md-4 px-4 mb-5 mb-md-0">
          <div class="step-title">Step 2</div>
          <p class="step-desc">Select a recipe and view detailed<br>ingredients and instructions..</p>
        </div>

        <!-- Step 3 -->
        <div class="col-md-4 px-4">
          <div class="step-title">Step 3</div>
          <p class="step-desc">Start cooking and fuel your body<br>like a champion.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section text-center scroll-animate">
    <div class="container">
      <h2 class="font-heading cta-title">READY TO LEVEL UP YOUR COOKING?</h2>
      <a href="recipes.php" class="btn btn-cta">Start Explore</a>
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