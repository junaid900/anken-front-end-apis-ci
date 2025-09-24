<?php
require_once(APPPATH.'core/SecureApiController.php');

class Common extends SecureApiController {
    
    public function uploadImage()
    {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return response(400, 1, 'No file uploaded or upload error.', []);
        }
    
        $file = $_FILES['image'];
    
        // Optional: validate mime type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($file['tmp_name']);
    
        if (!in_array($fileType, $allowedTypes)) {
            return response(400, 1, 'Invalid file type.', []);
        }
    
        // Generate unique filename
        $newName = uniqid() . '_' . basename($file['name']);
    
        // Ensure upload directory exists
        $uploadPath = FCPATH . 'uploads/editor_images/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
    
        $destination = $uploadPath . $newName;
    
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return response(500, 1, 'Failed to move uploaded file.', []);
        }
    
        $url = base_url('uploads/editor_images/' . $newName);
    
        return response(200, 0, 'Image uploaded successfully.', ['url' => $url]);
    }
    
}