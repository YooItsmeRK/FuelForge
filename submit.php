<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 
require 'includes/db.php';

$logged_in_email = '';
$logged_in_name = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT email, username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($logged_in_email, $logged_in_name);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Recipe | FuelForge</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Submit Page Content -->
    <section class="section-padding" style="min-height: calc(100vh - 150px);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <h2 class="font-heading text-center mb-5 border-bottom border-dark pb-3">Submit Your Recipe</h2>

                    <form class="rounded" id="submitRecipeForm">

                        <div class="mb-4">
                            <label for="name" class="form-label text-white">Your name</label>
                            <input type="text" class="form-control" id="name"
                                value="<?php echo htmlspecialchars($logged_in_name); ?>"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                <?php echo !empty($logged_in_name) ? 'readonly' : 'required'; ?>>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-white">Email address</label>
                            <input type="email" class="form-control" id="email"
                                value="<?php echo htmlspecialchars($logged_in_email); ?>"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                <?php echo !empty($logged_in_email) ? 'readonly' : 'required'; ?>>
                            <?php if(!empty($logged_in_email)): ?>
                            <small class="text-secondary d-block mt-1">This email links the recipe to your private dashboard account.</small>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4">
                            <label for="recipeTitle" class="form-label text-white">Recipe Title</label>
                            <input type="text" class="form-control" id="recipeTitle"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label text-white">Category</label>
                            <select class="form-select" id="category"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                required>
                                <option value="" disabled selected>Select category</option>
                                <option value="bbq">BBQ Grilling</option>
                                <option value="high-protein">High Protein Meals</option>
                                <option value="quick">Quick Meals</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="prep_time" class="form-label text-white">Preparation Time (e.g., 20 Mins)</label>
                            <input type="text" class="form-control" id="prep_time" name="prep_time"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="ingredients" class="form-label text-white">Ingredients</label>
                            <textarea class="form-control" id="ingredients" rows="4"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                required></textarea>
                        </div>

                        <div class="mb-5">
                            <label for="instructions" class="form-label text-white">Instructions</label>
                            <textarea class="form-control" id="instructions" rows="4"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;"
                                required></textarea>
                        </div>
                        
                        <div class="mb-5">
                            <label for="image" class="form-label text-white">Recipe Image (Optional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                style="background-color: var(--bg-dark); color: white; border: 1px solid #333;">
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 4px;">Submit
                                Recipe</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="margin-top: auto;">
        <div class="container">
            <p class="mb-0">Ãƒâ€šÃ‚Â© 2026 FuelForge | Recipes For Real Men</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('submitRecipeForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerText;
            submitBtn.innerText = 'Submitting...';
            submitBtn.disabled = true;

            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('title', document.getElementById('recipeTitle').value);
            formData.append('category', document.getElementById('category').value);
            formData.append('prep_time', document.getElementById('prep_time').value);
            formData.append('ingredients', document.getElementById('ingredients').value);
            formData.append('instructions', document.getElementById('instructions').value);
            
            const imageFile = document.getElementById('image').files[0];
            if(imageFile) {
                formData.append('image', imageFile);
            }
            
            fetch('submit_recipe.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.innerText = originalText;
                submitBtn.disabled = false;
                
                Swal.fire({
                    title: data.status === 'success' ? 'Forged!' : 'Error',
                    text: data.message,
                    icon: data.status,
                    background: '#1a1a1a',
                    color: '#fff',
                    confirmButtonColor: '#ff5722'
                }).then(() => {
                    if (data.status === 'success') {
                        document.getElementById('submitRecipeForm').reset();
                    }
                });
            })
            .catch(error => {
                submitBtn.innerText = originalText;
                submitBtn.disabled = false;
                console.error('Error:', error);
                
                Swal.fire({
                    title: 'System Error',
                    text: 'An error occurred while submitting the recipe. Check your connection.',
                    icon: 'error',
                    background: '#1a1a1a',
                    color: '#fff',
                    confirmButtonColor: '#ff5722'
                });
            });
        });
    </script>
</body>

</html>