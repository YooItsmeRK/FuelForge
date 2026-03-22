<?php
$is_logged_in = isset($_SESSION['user_id']);
$btn_link = $is_logged_in ? 'dashboard.php' : 'get_started.php';
$btn_text = $is_logged_in ? ($_SESSION['username'] ?? 'Dashboard') : 'Get Started';
?>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid px-lg-5">
    <a class="navbar-brand text-decoration-none" href="index.php">
      <div class="logo-container d-flex align-items-center">
        <img src="images/logo.png" alt="FuelForge" style="height: 45px; object-fit: contain; transform: scale(2.2); transform-origin: left center;">
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
      aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
      <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="recipes.php">Recipes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="submit.php">Submit Recipes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item d-lg-none mt-3">
          <a href="<?php echo htmlspecialchars($btn_link); ?>" class="btn w-100" style="background-color: #ff5722; color: white; border: none; padding: 10px; border-radius: 5px; text-transform: uppercase; font-weight: bold;"><?php echo htmlspecialchars($btn_text); ?></a>
        </li>
      </ul>
    </div>

    <!-- Desktop Button -->
    <div class="d-none d-lg-flex ms-auto">
      <a href="<?php echo htmlspecialchars($btn_link); ?>" class="btn" style="background-color: #ff5722; color: white; border: none; padding: 10px 25px; border-radius: 5px; text-transform: uppercase; font-weight: bold; text-decoration: none; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e64a19'" onmouseout="this.style.backgroundColor='#ff5722'"><?php echo htmlspecialchars($btn_text); ?></a>
    </div>
  </div>
</nav>
