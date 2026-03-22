<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
require 'includes/db.php';

// Fetch user email to find their submitted recipes
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_email);
$stmt->fetch();
$stmt->close();

$user_recipes = [];
if ($user_email) {
    $r_stmt = $conn->prepare("SELECT id, title, category, created_at, image FROM recipes WHERE email = ? ORDER BY created_at DESC");
    $r_stmt->bind_param("s", $user_email);
    $r_stmt->execute();
    $res = $r_stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $user_recipes[] = $row;
    }
    $r_stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | FuelForge</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background-color: #050505; color: white; font-family: 'Inter', sans-serif; }
        
        /* Dashboard Banner */
        .dash-banner {
            background: linear-gradient(135deg, #ff5722 0%, #a32200 100%);
            padding: 80px 0 120px 0;
            text-align: center;
            position: relative;
            box-shadow: inset 0 -20px 30px rgba(0,0,0,0.5);
        }
        
        /* Creative profile card overlapping the banner */
        .profile-container {
            max-width: 1000px;
            margin: -70px auto 60px auto;
            background-color: #151515;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.9);
            padding: 40px;
            position: relative;
            z-index: 10;
            border: 1px solid #333;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #2a2a2a;
            padding-bottom: 30px;
            margin-bottom: 35px;
        }
        
        .avatar-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #333, #111);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #ff9800;
            margin-right: 25px;
            border: 2px solid #555;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        
        .profile-info h2 { font-family: 'Cinzel', serif; font-weight: 700; margin: 0 0 5px 0; color: #ff5722; font-size: 2.2rem; }
        .profile-info p { color: #aaa; margin: 0; font-size: 0.95rem; }
        
        /* Recipe Cards */
        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .recipe-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 25px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        
        .recipe-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 4px; height: 100%;
            background-color: #ff9800;
            transition: width 0.3s ease;
        }
        
        .recipe-card:hover { 
            border-color: #ff5722; 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(255,87,34,0.15); 
        }
        
        .recipe-card:hover::before {
            width: 6px;
            background-color: #ff5722;
        }
        
        .recipe-title { font-family: 'Inter', sans-serif; font-size: 1.25rem; font-weight: 700; color: white; margin-bottom: 15px; margin-top:15px; }
        
        .badge-category {
            background-color: rgba(255, 152, 0, 0.15);
            color: #ff9800;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        
        .empty-state { text-align: center; padding: 60px 20px; background-color: #0f0f0f; border-radius: 12px; border: 2px dashed #333; }
        .empty-state i { font-size: 3.5rem; color: #444; margin-bottom: 20px; }
        
        /* Actions */
        .dash-actions a { padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weight: 700; font-size: 0.9rem; margin-left: 10px; transition: all 0.3s; display: inline-flex; align-items: center; }
        .btn-submit { background-color: #ff5722; color: white; border: none; }
        .btn-submit:hover { background-color: #e64a19; color: white; transform: scale(1.05); }
        .btn-logout-sm { background-color: transparent; border: 1px solid #dc3545; color: #dc3545; }
        .btn-logout-sm:hover { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <!-- Import Dynamic Consistent Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <div class="dash-banner">
        <h1 style="font-family: 'Cinzel', serif; font-weight: 900; color: white; text-shadow: 0 4px 8px rgba(0,0,0,0.6); font-size: 3.5rem; letter-spacing: 2px;">YOUR ARSENAL</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; font-weight: 300;">Manage your crafted masterpieces.</p>
    </div>

    <div class="container px-4 px-lg-0">
        <div class="profile-container">
            <!-- Header Section -->
            <div class="profile-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-4 mb-md-0">
                    <div class="avatar-circle">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                        <p><i class="bi bi-envelope-at-fill me-2" style="color: #666;"></i><?php echo htmlspecialchars($user_email); ?></p>
                        <p class="mt-2" style="font-weight: 600;"><i class="bi bi-fire me-2" style="color:#ff5722;"></i><?php echo count($user_recipes); ?> Recipes Forged</p>
                    </div>
                </div>
                <div class="dash-actions text-md-end w-100 w-md-auto d-flex justify-content-md-end justify-content-center">
                    <a href="submit.php" class="btn-submit"><i class="bi bi-plus-lg me-2"></i>New Recipe</a>
                    <a href="auth/logout.php" class="btn-logout-sm"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a>
                </div>
            </div>

            <!-- Content Section -->
            <h4 class="mb-4 d-flex align-items-center" style="color: #fca311; font-weight: 700; font-family: 'Cinzel', serif;">
                <i class="bi bi-journal-medical me-3" style="font-size: 1.5rem;"></i> Submitted Masterpieces
            </h4>
            
            <?php if (empty($user_recipes)): ?>
                <div class="empty-state">
                    <i class="bi bi-journal-x d-block"></i>
                    <h4 class="mt-3 text-white">No recipes forged yet</h4>
                    <p class="text-secondary mt-2">It's time to unleash your culinary power onto the community.</p>
                    <a href="submit.php" class="btn btn-submit mt-4 px-5 py-3 fs-5"><i class="bi bi-fire me-2"></i>Forge Your First Recipe</a>
                </div>
            <?php else: ?>
                <div class="recipe-grid">
                    <?php foreach ($user_recipes as $recipe): ?>
                    <div class="recipe-card px-0 pt-0">
                        <?php if(!empty($recipe['image'])): ?>
                            <div style="width:100%; height:160px; overflow:hidden; border-radius: 10px 10px 0 0; margin-bottom: 20px;">
                                <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="Recipe Image" style="width:100%; height:100%; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                        
                        <div class="px-4">
                            <div class="d-flex justify-content-between align-items-center <?php echo empty($recipe['image']) ? 'mt-2' : ''; ?>">
                                <span class="badge-category"><?php echo htmlspecialchars($recipe['category']); ?></span>
                            </div>
                            <div class="recipe-title text-truncate" title="<?php echo htmlspecialchars($recipe['title']); ?>">
                                <?php echo htmlspecialchars($recipe['title']); ?>
                            </div>
                            
                            <div class="mt-4 pt-3 d-flex justify-content-between align-items-center" style="border-top: 1px solid #333;">
                                <span class="text-secondary" style="font-size: 0.8rem;">
                                    <i class="bi bi-calendar3 me-1"></i> <?php echo date("M j, Y", strtotime($recipe['created_at'])); ?>
                                </span>
                                <div class="d-flex align-items-center">
                                    <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>" class="btn btn-sm btn-outline-warning text-warning p-1 me-2" style="border-radius:6px; font-size:0.8rem; border-color:#ff9800; text-decoration:none;"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form method="POST" action="delete_recipe.php" class="delete-form" style="margin: 0;">
                                        <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-danger p-1 delete-btn" style="border-radius:6px; font-size:0.8rem; border:none; background:transparent; color:#dc3545;" title="Delete Recipe"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Delete this Recipe?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff5722',
                    cancelButtonColor: '#333',
                    confirmButtonText: 'Yes, burn it!',
                    background: '#1a1a1a',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    
    <?php if(isset($_SESSION['flash_msg'])): ?>
    <script>
        Swal.fire({
            title: 'Deleted!',
            text: '<?php echo addslashes($_SESSION['flash_msg']); ?>',
            icon: 'success',
            background: '#1a1a1a',
            color: '#fff',
            confirmButtonColor: '#ff5722'
        });
    </script>
    <?php unset($_SESSION['flash_msg']); endif; ?>
</body>
</html>
