<?php
require_once(APPPATH.'core/SecureApiController.php');

class File_library extends SecureApiController
{
    protected $libraryPath = 'uploads/file_library';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'file']);
    }

    // protected function get_json_input($key = null)
    // {
    //     $input = json_decode(trim(file_get_contents('php://input')), true);
    //     return $key ? ($input[$key] ?? null) : $input;
    // }

    public function get_files()
    {
        $req = $this->get_json_input();
        if (!isset($req['ids'])) {
            return response(400, 1,'items not found',[]);
        }

        $this->db->from('anken_file_library');
        $this->db->where_in('id', $req['ids']);
        $files = $this->db->get()->result();

        $finalFiles = [];
        foreach ($req['ids'] as $fid) {
            foreach ($files as $file) {
                if ($fid == $file->id) {
                    $path = $file->directory_id == 0 
                        ? $this->libraryPath."/{$file->file}" 
                        : $this->libraryPath."/{$file->directory_id}/{$file->file}";
                    $finalFiles[] = array_merge((array)$file, ['path' => $path]);
                    break;
                }
            }
        }

        return response(200, 0, 'Success', $finalFiles);
    }

    public function get_folder_data()
    {
        $req = $this->get_json_input();
        $dir = $req['dir'] ?? 0;
        $dirPath = $dir == 0 ? '' : $dir;
        $mPath = APPPATH . "../{$this->libraryPath}/{$dirPath}";
    
        if (!is_dir($mPath)) {
            mkdir($mPath, 0777, true);
        }
    
        // === Directories Query ===
        $dirBuilder = $this->db->from('anken_file_directory')->where('parent_id', $dir);
    
        if (isset($req['name'])) {
            $dirBuilder->like('name', $req['name']);
        }
        if (isset($req['date'])) {
            $today = new DateTime();
            switch ($req['date']) {
                case 'week': $today->modify('-1 week'); break;
                case 'month': $today->modify('-1 month'); break;
                case '6-month': $today->modify('-6 months'); break;
                case '1-year': $today->modify('-1 year'); break;
            }
            $formattedDate = $today->format('Y-m-d');
            $dirBuilder->where('DATE(created_at) >=', $formattedDate);
        }
        if (isset($req['sort'])) {
            switch ($req['sort']) {
                case 'name_asc': $dirBuilder->order_by('name', 'ASC'); break;
                case 'name_desc': $dirBuilder->order_by('name', 'DESC'); break;
                case 'date_asc': $dirBuilder->order_by('created_at', 'ASC'); break;
                case 'date_desc': $dirBuilder->order_by('created_at', 'DESC'); break;
            }
        }
        $directories = $dirBuilder->get()->result();
    
        // === Files Query ===
        $fileBuilder = $this->db->from('anken_file_library');
        $fileBuilder->where('directory_id', $dir);
        if (isset($req['fileQuery'])) {
            $fileBuilder->like('file_name', $req['fileQuery']);
        } else {
        }
    
        if (isset($req['name'])) {
            $fileBuilder->like('file_name', $req['name']);
        }
        if (isset($req['type'])) {
            $fileBuilder->where('type', $req['type']);
        }
        if (isset($req['extension'])) {
            $fileBuilder->like('file', $req['extension'], 'before');
        }
        if (isset($req['date'])) {
            $fileBuilder->where('DATE(created_at) >=', $formattedDate);
        }
        if (isset($req['sort'])) {
            switch ($req['sort']) {
                case 'name_asc': $fileBuilder->order_by('tag', 'ASC'); break;
                case 'name_desc': $fileBuilder->order_by('tag', 'DESC'); break;
                case 'date_asc': $fileBuilder->order_by('created_at', 'ASC'); break;
                case 'date_desc': $fileBuilder->order_by('created_at', 'DESC'); break;
            }
        }
    
        $files = $fileBuilder->get()->result();
    
        // Format file path
        $finalFiles = [];
        foreach ($files as $file) {
            $path = $file->directory_id == 0
                ? $this->libraryPath . "/{$file->file}"
                : $this->libraryPath . "/{$file->directory_id}/{$file->file}"; 
            $finalFiles[] = array_merge((array)$file, ['path' => $path]);
        }
    
        return response(200, 0, 'Success', [
            'files' => $finalFiles,
            'directories' => $directories
        ]);
    }


    public function get_directory_tree()
    {
        $req = $this->get_json_input();
        $rows = $this->db->get('anken_file_directory')->result();

        $itemMap = [];
        foreach ($rows as $item) {
            $itemMap[$item->id] = [
                'title' => $item->name,
                'key' => $item->id,
                'parent_id' => $item->parent_id,
                'children' => []
            ];
        }

        $tree = [];
        foreach ($itemMap as &$item) {
            if ($item['parent_id'] == 0) {
                $tree[] = &$item;
            } else {
                $itemMap[$item['parent_id']]['children'][] = &$item;
            }
        }

        $path = [];
        if (isset($req['dir_id'])) {
            $currentId = $req['dir_id'];
            while ($currentId !== 0 && isset($itemMap[$currentId])) {
                $directory = $itemMap[$currentId];
                array_unshift($path, [
                    'id' => $directory['key'],
                    'name' => $directory['title']
                ]);
                $currentId = $directory['parent_id'];
            }
        }

        return response(200, 0,'Success',[
                'path' => $path,
                'directories' => [[
                    'title' => 'file-library',
                    'key' => '0',
                    'children' => $tree,
                    'isLeaf' => false
                ]]
            ]);
    }

    public function create_directory()
    {
        $req = $this->get_json_input();
        $parentId = $req['parent'] ?? null;
        $name = $req['name'] ?? null;

        if (!$name || $parentId === null) {
            return response(400, 1,'Invalid name or parent directory',[]);
        }

        $this->db->insert('anken_file_directory', [
            'name' => $name,
            'parent_id' => $parentId
        ]);
        $dirId = $this->db->insert_id();

        $mPath = APPPATH . "../{$this->libraryPath}";
        if (!is_dir($mPath)) {
            mkdir($mPath, 0777, true);
        }

        $dirPath = "{$mPath}/{$dirId}";
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
            return response(200, 0,'Directory created',[]);
        }

        return response(400, 1,'Directory already exists',[]);
    }

    public function remove_item()
    {
        $req = $this->get_json_input();
        if ($req['type'] == 'multiple') {
            $success = $this->remove_multiple_items($req);
            if ($success) {
                return response(200, 0,'Deleted successfully',[]);
            }
            return response(500, 1,'Internal server error',[]);
        }

        if ($req['type'] == 'directory') {
            $this->delete_directory_recursive($req['id']);
            return response(200, 0,'Directory deleted',[]);
        }

        // Handle file deletion
        $filePath = APPPATH . "../app/public/{$req['path']}";
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $this->db->where('id', $req['id'])->delete('anken_file_library');
        return response(200, 0,'File deleted',[]);
    }

    private function delete_directory_recursive($dirId)
    {
        // Get child directories
        $childDirs = $this->db->where('parent_id', $dirId)
                             ->get('anken_file_directory')
                             ->result();

        foreach ($childDirs as $child) {
            $this->delete_directory_recursive($child->id);
        }

        // Delete physical directory
        $dirPath = APPPATH . "../app/public/file_library/{$dirId}";
        if (is_dir($dirPath)) {
            $this->rrmdir($dirPath);
        }

        // Delete from database
        $this->db->where('id', $dirId)->delete('anken_file_directory');
        $this->db->where('directory_id', $dirId)->delete('anken_file_library');
    }

    private function rrmdir($dir)
    {
        foreach (glob("{$dir}/*") as $file) {
            if (is_dir($file)) {
                $this->rrmdir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
    }

    private function remove_multiple_items($req)
    {
        if (!isset($req['selectedItems'])) {
            return false;
        }

        $errors = [];
        foreach ($req['selectedItems'] as $item) {
            if ($item['type'] == 'directory') {
                $this->delete_directory_recursive($item['id']);
            } else {
                $filePath = APPPATH . "../app/public/{$item['path']}";
                if (file_exists($filePath)) {
                    if (!unlink($filePath)) {
                        $errors[] = "Failed to delete file: {$item['path']}";
                    }
                }
                $this->db->where('id', $item['id'])->delete('anken_file_library');
            }
        }

        return empty($errors);
    }

    public function edit_item()
    {
        $req = $this->get_json_input();
        if (!isset($req['type']) || !isset($req['id'])) {
            return response(400, 1,'Invalid type or ID',[]);
        }

        if ($req['type'] == 'file') {
            $data = [];
            if (isset($req['name'])) {
                $data['file_name'] = $req['name'];
            }
            $this->db->where('id', $req['id'])->update('anken_file_library', $data);
        } elseif ($req['type'] == 'directory') {
            $data = [];
            if (isset($req['name'])) {
                $data['name'] = $req['name'];
            }
            $this->db->where('id', $req['id'])->update('anken_file_directory', $data);
        }
        return response(200, 0,'success',[]);
    }

    public function move_to_directory()
    {
        $req = $this->get_json_input();
        if (!isset($req['type']) || !isset($req['id']) || !isset($req['moveDirId'])) {
            return response(400, 1,'Invalid input',[]);
        }

        if ($req['type'] == 'multiple') {
            return $this->move_multiple($req);
        }

        if ($req['type'] == 'file') {
            $file = $this->db->where('id', $req['id'])
                           ->get('anken_file_library')
                           ->row();

            if (!$file) {
                return response(404, 1,'File not found',[]);
            }

            $sourcePath = $file->directory_id != 0
                ? APPPATH . "../{$this->libraryPath}/{$file->directory_id}/{$file->file}"
                : APPPATH . "../{$this->libraryPath}/{$file->file}";

            $destPath = $req['moveDirId'] == 0
                ? APPPATH . "../{$this->libraryPath}/{$file->file}"
                : APPPATH . "../{$this->libraryPath}/{$req['moveDirId']}/{$file->file}";

            $destDir = dirname($destPath);
            if (!is_dir($destDir)) {
                mkdir($destDir, 0777, true);
            }

            if (!rename($sourcePath, $destPath)) {
                return response(500, 1,'Failed to move file',[]);
            }

            $this->db->where('id', $req['id'])
                   ->update('anken_file_library', ['directory_id' => $req['moveDirId']]);

        } elseif ($req['type'] == 'directory') {
            $this->db->where('id', $req['id'])
                   ->update('anken_file_directory', ['parent_id' => $req['moveDirId']]);
        }
        return response(200, 0,'success',[]);
    }

    private function move_multiple($req)
    {
        if (!isset($req['moveDirId']) || !isset($req['selectedItems'])) {
            return response(400, 1,'Invalid input',[]);
        }

        $errors = [];
        foreach ($req['selectedItems'] as $item) {
            if (!isset($item['type']) || !isset($item['id'])) {
                $errors[] = 'Invalid item format';
                continue;
            }

            if ($item['type'] == 'file') {
                $file = $this->db->where('id', $item['id'])
                               ->get('anken_file_library')
                               ->row();

                if (!$file) {
                    $errors[] = "File with ID {$item['id']} not found";
                    continue;
                }

                $sourcePath = $file->directory_id != 0
                    ? APPPATH . "../{$this->libraryPath}/{$file->directory_id}/{$file->file}"
                    : APPPATH . "../{$this->libraryPath}/{$file->file}";

                $destPath = $req['moveDirId'] == 0
                    ? APPPATH . "../{$this->libraryPath}/{$file->file}"
                    : APPPATH . "../{$this->libraryPath}/{$req['moveDirId']}/{$file->file}";

                $destDir = dirname($destPath);
                if (!is_dir($destDir)) {
                    mkdir($destDir, 0777, true);
                }

                if (!rename($sourcePath, $destPath)) {
                    $errors[] = "Cannot move file ID {$item['id']}";
                    continue;
                }

                $this->db->where('id', $item['id'])
                       ->update('anken_file_library', ['directory_id' => $req['moveDirId']]);

            } elseif ($item['type'] == 'directory') {
                $this->db->where('id', $item['id'])
                       ->update('anken_file_directory', ['parent_id' => $req['moveDirId']]);
            }
        }
        return response(200, 0,'success',$errors);
    }

    public function get_categories()
    {
        $result = $this->db->where('status', 0)
                          ->get('anken_file_category')
                          ->result();
        return response(200, 0,'success',$result);
    }

    public function upload()
    {
        $dir = $this->json_data['dir'] ?? '0';
        $type = $this->json_data['type'] ?? 'files';
        $tag = $this->json_data['tag'] ?? null;
        $file_category = $this->json_data['file_category'] ?? null;
    
        $dirPath = ($dir == '0') ? '' : "/{$dir}";
        $uploadBaseDir = FCPATH . "{$this->libraryPath}";
        $uploadDir = $uploadBaseDir . $dirPath;
    
        if (!is_dir($uploadBaseDir)) {
            mkdir($uploadBaseDir, 0777, true);
        }
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        if (empty($_FILES['files'])) {
            return response(400, 1, 'No files uploaded', []);
        }
    
        $fileCount = count($_FILES['files']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }
    
            $originalName = $_FILES['files']['name'][$i];
            $tmpName = $_FILES['files']['tmp_name'][$i];
            $fileSizeInBytes = $_FILES['files']['size'][$i];
            $fileTypeMime = $_FILES['files']['type'][$i];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $fileSizeInMb = round($fileSizeInBytes / (1024 * 1024), 2);
            $filename = "{$fileSizeInMb}__" . time() . uniqid() . ".{$ext}";
            $targetPath = "{$uploadDir}/{$filename}";
    
            if (!move_uploaded_file($tmpName, $targetPath)) {
                continue;
            }
    
            // Detect type
            $finalType = 'files';
            if (strpos($fileTypeMime, 'image/') === 0) {
                $finalType = 'images';
            } elseif (strpos($fileTypeMime, 'video/') === 0) {
                $finalType = 'videos';
            }
    
            // Read dimension_X if passed
            $dimensionKey = "dimension_{$i}";
            $dimension = $this->json_data[$dimensionKey] ?? '';
    
            // Insert record into DB
            $this->db->insert('anken_file_library', [
                'tag' => $tag ?? $filename,
                'category_id' => $file_category,
                'directory' => $dir == '0' ? '/' : $dir,
                'directory_id' => $dir,
                'file' => $filename,
                'size' => $fileSizeInBytes,
                'dimensions' => $dimension,
                'file_name' => pathinfo($originalName, PATHINFO_FILENAME),
                'type' => $finalType,
            ]);
        }
    
        return response(200, 0, 'Files uploaded successfully', []);
    }
}