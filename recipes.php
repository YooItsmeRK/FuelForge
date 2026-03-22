<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipes | FuelForge</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Recipes Header Section -->
  <section class="section-padding text-center border-bottom border-dark pb-5">
    <div class="container">
      <h2 class="font-heading mb-4">FuelForge RECIPES</h2>

      <!-- Search and Filter -->
      <div class="row justify-content-center mb-4">
        <div class="col-md-6">
          <input type="text" id="searchInput" class="form-control text-center mb-4 py-3"
            placeholder="Search for recipes (e.g., Steak, Chicken...)">

          <div class="d-flex justify-content-center flex-wrap gap-2" id="filterContainer">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="high-protein">High Protein</button>
            <button class="filter-btn" data-filter="quick">Quick Meals</button>
            <button class="filter-btn" data-filter="bbq">BBQ Grilling</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Dynamic Recipe Grid bg-darker -->
  <section class="section-padding bg-darker">
    <div class="container">
      <div class="row g-4" id="recipeContainer">
        <!-- Recipe Cards will be inserted here dynamically via JavaScript -->
      </div>

      <div id="noResults" class="text-center text-muted mt-5 d-none">
        <h4>No recipes found. Try a different search!</h4>
      </div>
    </div>
  </section>

  <!-- Recipe Modal -->
  <div class="modal fade" id="recipeModal" tabindex="-1" aria-labelledby="recipeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content text-light"
        style="background-color: var(--bg-card); border: 1px solid var(--border-color);">
        <div class="modal-header border-dark">
          <h5 class="modal-title font-heading fs-3" id="recipeModalLabel" style="color: var(--primary-color);">Recipe
            Title</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0 zoom-in-animation">
          <img id="modalRecipeImg" src="" alt="Recipe Image" class="img-fluid w-100"
            style="max-height: 400px; object-fit: cover;">
          <div class="p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
              <span id="modalRecipeCategory" class="badge bg-primary text-uppercase fs-6 px-3 py-2">Category</span>
              <span id="modalRecipeTime" class="badge bg-secondary text-uppercase fs-6 px-3 py-2">Time</span>
            </div>
            <p id="modalRecipeDescription" class="fs-4 text-light mb-5 font-italic"></p>

            <div class="row">
              <div class="col-md-5 mb-4">
                <h4 class="font-heading mb-3"
                  style="color: var(--primary-color); border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; display: inline-block;">
                  Ingredients</h4>
                <ul id="modalRecipeIngredients" class="mb-4 text-light lh-lg ps-3"
                  style="font-size: 1.1rem; list-style-type: square;">
                  <!-- Inserted dynamically -->
                </ul>
              </div>
              <div class="col-md-7">
                <h4 class="font-heading mb-3"
                  style="color: var(--primary-color); border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; display: inline-block;">
                  Instructions</h4>
                <ol id="modalRecipeInstructions" class="mb-0 text-light lh-lg ps-3" style="font-size: 1.1rem;">
                  <!-- Inserted dynamically -->
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-dark px-4 py-3">
          <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="mb-0">Ãƒâ€šÃ‚Â© 2026 FuelForge | Recipes For Real Men</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>

</html>