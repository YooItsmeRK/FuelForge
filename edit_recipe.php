<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
require 'includes/db.php';
require 'includes/functions.php';

// Fetch current user email
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_email);
$stmt->fetch();
$stmt->close();

$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$recipe = null;

if ($recipe_id > 0) {
    // Only fetch recipe if it belongs to this user (matching by email)
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ? AND email = ?");
    $stmt->bind_param("is", $recipe_id, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc();
    }
    $stmt->close();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $recipe) {
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $category = $conn->real_escape_string($_POST['category'] ?? '');
    $prep_time = $conn->real_escape_string($_POST['prep_time'] ?? '');
    $ingredients = $conn->real_escape_string($_POST['ingredients'] ?? '');
    $instructions = $conn->real_escape_string($_POST['instructions'] ?? '');

    if (empty($title) || empty($category) || empty($prep_time) || empty($ingredients) || empty($instructions)) {
        $error = "All text fields are required.";
    } else {
        $image_path = $recipe['image']; // Keep old image by default
        
        // Handle new image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($_FILES['image']['name']));
            $targetFilePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $image_path = $conn->real_escape_string($targetFilePath);
            }
        }
        
        $updateSql = "UPDATE recipes SET title='$title', category='$category', prep_time='$prep_time', ingredients='$ingredients', instructions='$instructions', image=" . ($image_path ? "'$image_path'" : "NULL") . " WHERE id=$recipe_id AND email='$user_email'";
        if ($conn->query($updateSql) === TRUE) {
            $success = "Recipe updated successfully!";
            // Refresh recipe data
            $recipe['title'] = stripslashes($title);
            $recipe['category'] = stripslashes($category);
            $recipe['prep_time'] = stripslashes($prep_time);
            $recipe['ingredients'] = stripslashes($ingredients);
            $recipe['instructions'] = stripslashes($instructions);
            $recipe['image'] = stripslashes($image_path);
        } else {
            $error = "Error updating recipe: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe | FuelForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: #0a0a0a; color: white;">
    <?php include 'includes/navbar.php'; ?>

    <section class="section-padding" style="min-height: calc(100vh - 150px); padding-top: 50px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <h2 class="font-heading text-center mb-4 border-bottom border-dark pb-3" style="color:#ff5722;">Edit Recipe</h2>
                    
                    <?php if (!$recipe): ?>
                        <div class="alert alert-danger text-center">Recipe not found or you do not have permission to edit it.</div>
                        <div class="text-center"><a href="dashboard.php" class="btn btn-secondary">Return to Dashboard</a></div>
                    <?php else: ?>

                        <?php if ($error): ?>
                            <div class="alert alert-danger" style="background-color: #2a0808; border-color: #dc3545; color: #ffcccc;"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form class="rounded" method="POST" enctype="multipart/form-data">

                            <div class="mb-4">
                                <label for="title" class="form-label text-white">Recipe Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;" required>
                            </div>

                            <div class="mb-4">
                                <label for="category" class="form-label text-white">Category</label>
                                <select class="form-select" id="category" name="category" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;" required>
                                    <option value="bbq" <?php if($recipe['category']=='bbq') echo 'selected'; ?>>BBQ Grilling</option>
                                    <option value="high-protein" <?php if($recipe['category']=='high-protein') echo 'selected'; ?>>High Protein Meals</option>
                                    <option value="quick" <?php if($recipe['category']=='quick') echo 'selected'; ?>>Quick Meals</option>
                                    <option value="other" <?php if($recipe['category']=='other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="prep_time" class="form-label text-white">Preparation Time (e.g., 20 Mins)</label>
                                <input type="text" class="form-control" id="prep_time" name="prep_time" value="<?php echo htmlspecialchars($recipe['prep_time'] ?? ''); ?>" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white">Current Image</label><br>
                                <?php if($recipe['image']): ?>
                                    <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="Recipe Image" style="max-width: 200px; border-radius: 8px; border: 1px solid #555;">
                                <?php else: ?>
                                    <span class="text-secondary">No image uploaded.</span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label text-white">Update Image (Optional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;">
                            </div>

                            <div class="mb-4">
                                <label for="ingredients" class="form-label text-white">Ingredients</label>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="5" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
                            </div>

                            <div class="mb-5">
                                <label for="instructions" class="form-label text-white">Instructions</label>
                                <textarea class="form-control" id="instructions" name="instructions" rows="5" style="background-color: var(--bg-dark); color: white; border: 1px solid #333;" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="dashboard.php" class="btn btn-outline-warning p-2 px-4" style="border-radius: 4px;">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: #ff5722; border:none; border-radius: 4px;">Save Changes</button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if ($success): ?>
    <script>
        Swal.fire({
            title: 'Updated!',
            text: '<?php echo addslashes($success); ?>',
            icon: 'success',
            background: '#1a1a1a',
            color: '#fff',
            confirmButtonColor: '#ff5722'
        });
    </script>
    <?php endif; ?>
</body>
</html>
