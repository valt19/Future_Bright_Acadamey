<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdminLogin();

$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['image']['name'])) {
    $title = trim($_POST['title'] ?? '');
    $caption = trim($_POST['caption'] ?? '');
    $image = $_FILES['image'];

    if ($image['error'] === UPLOAD_ERR_OK && in_array($image['type'], ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true) && $image['size'] <= 2 * 1024 * 1024) {
        $safeName = sanitizeFileName($image['name']);
        $destination = __DIR__ . '/../uploads/gallery/' . $safeName;

        if (move_uploaded_file($image['tmp_name'], $destination)) {
            $entry = [
                'id' => time(),
                'title' => $title !== '' ? $title : 'Uploaded gallery image',
                'caption' => $caption !== '' ? $caption : 'Uploaded from the admin dashboard.',
                'image_path' => '/uploads/gallery/' . $safeName,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $pdo = getDbConnection();
            if ($pdo && tableExists($pdo, 'gallery')) {
                $stmt = $pdo->prepare('INSERT INTO gallery (title, caption, image_path, created_at) VALUES (:title, :caption, :image_path, NOW())');
                $stmt->execute([
                    'title' => $entry['title'],
                    'caption' => $entry['caption'],
                    'image_path' => $entry['image_path'],
                ]);
                $notice = 'Image uploaded successfully to the database.';
            } else {
                $_SESSION['demo_gallery'] = array_values(array_merge($_SESSION['demo_gallery'] ?? [], [$entry]));
                $notice = 'Image uploaded successfully and is now visible on the gallery page.';
            }
        } else {
            $notice = 'The image could not be uploaded. Please try again.';
        }
    } else {
        $notice = 'Invalid file type or file is too large. Please upload JPG, PNG, GIF, or WEBP under 2MB.';
    }
}

$adminPageTitle = 'Manage Gallery';
$adminCurrentPage = 'gallery.php';
require __DIR__ . '/../includes/admin-header.php';
$galleryItems = $_SESSION['demo_gallery'] ?? getGalleryItems();
?>
<main class="admin-shell">
    <div class="container admin-content">
        <div class="page-title-row">
            <h1>Gallery Management</h1>
        </div>

        <div class="admin-panel">
            <h3>Upload Image</h3>
            <?php if ($notice !== ''): ?>
                <div class="notice"><?php echo e($notice); ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data" class="form-wrap">
                <div>
                    <label for="gallery_title">Title</label>
                    <input id="gallery_title" name="title" type="text" required>
                </div>
                <div>
                    <label for="gallery_caption">Caption</label>
                    <textarea id="gallery_caption" name="caption"></textarea>
                </div>
                <div>
                    <label for="gallery_image">Image</label>
                    <input id="gallery_image" name="image" type="file" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload image</button>
            </form>
        </div>

        <div class="admin-panel">
            <h3>Uploaded Images</h3>
            <?php if (empty($galleryItems)): ?>
                <p>No images uploaded yet.</p>
            <?php else: ?>
                <div class="gallery-grid admin-gallery-list">
                    <?php foreach ($galleryItems as $item): ?>
                        <?php $imagePath = $item['image_path'] ?? '/assets/images/placeholder-school.svg'; ?>
                        <div class="gallery-item admin-gallery-item">
                            <img src="<?php echo BASE_URL . e($imagePath); ?>" alt="<?php echo e($item['title'] ?? 'Gallery image'); ?>">
                            <div class="article-body">
                                <h3><?php echo e($item['title'] ?? 'Gallery image'); ?></h3>
                                <p><?php echo e($item['caption'] ?? 'Uploaded image'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
