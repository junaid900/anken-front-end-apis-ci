<?php
require_once(APPPATH.'core/SecureApiController.php');

class OurCompanyPage extends SecureApiController {

    // Main Table Operations (anken_our_company_page)

    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        // Required field validation
        $requiredFields = [
            'title_en' => 'English title',
            'title_ch' => 'Chinese title',
            'slug' => 'Slug',
            'short_description_en' => 'Short Description EN',
            'short_description_ch' => 'Short Description CH',
            'top_image' => 'Top Image'
        ];

        foreach ($requiredFields as $field => $label) {
            if (!$request->$field) {
                response(403, 1, "$label cannot be empty.", []);
            }
        }

        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'slug' => $request->slug,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'page_description_en' => $request->page_description_en ?? '',
            'page_description_ch' => $request->page_description_ch ?? '',
            'top_image' => $request->top_image,
            'status' => $request->status ?? 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($request->id && $request->id != 0) {
            unset($data['created_at']); // Don't update created_at on edit
            $data['updated_at'] = date('Y-m-d H:i:s');
            
            $this->db->where('id', $request->id);
            $this->db->update('anken_our_company_page', $data);
            response(200, 0, 'Our company page updated successfully.', []);
        } else {
            $res = $this->db->insert('anken_our_company_page', $data);
            if ($res) {
                response(200, 0, 'Our company page added successfully.', []);
            } else {
                response(500, 1, 'Failed to insert our company page.', []);
            }
        }
    }

    public function get() {
        $this->db->select('p.*, 
            f.id as file_id, f.file as file_name, f.directory_id as file_directory');
        $this->db->from('anken_our_company_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        $results = $this->db->get()->result();
        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;

            $topImage = null;
            if (!empty($row->file_id)) {
                $filePath = ($row->file_directory == 0)
                    ? "{$this->libraryPath}/{$row->file_name}"
                    : "{$this->libraryPath}/{$row->file_directory}/{$row->file_name}";
                $topImage = [
                    'id' => $row->file_id,
                    'file' => $row->file_name,
                    'directory_id' => $row->file_directory,
                    'path' => $filePath
                ];
            }

            $rowArray['top_image_data'] = $topImage;

            unset($rowArray['file_id'], $rowArray['file_name'], $rowArray['file_directory']);

            $final[] = $rowArray;
        }

        response(200, 0, 'Our company pages fetched successfully.', $final);
    }

    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch our company page.', []);
        }

        $this->db->select('p.*, 
            f.id as file_id, f.file as file_name, f.directory_id as file_directory');
        $this->db->from('anken_our_company_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            response(404, 1, 'Our company page not found.', []);
        }

        $rowArray = (array) $row;

        $topImage = null;
        if (!empty($row->file_id)) {
            $filePath = ($row->file_directory == 0)
                ? "{$this->libraryPath}/{$row->file_name}"
                : "{$this->libraryPath}/{$row->file_directory}/{$row->file_name}";
            $topImage = [
                'id' => $row->file_id,
                'file' => $row->file_name,
                'directory_id' => $row->file_directory,
                'path' => $filePath
            ];
        }

        $rowArray['top_image'] = $topImage;

        unset($rowArray['file_id'], $rowArray['file_name'], $rowArray['file_directory']);

        response(200, 0, 'Our company page fetched successfully.', $rowArray);
    }

    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete our company page.', []);
        }

        // Check if there are associated partners
        $partnersCount = $this->db->get_where('anken_our_company_partners', ['our_company_page_id' => $id])->num_rows();
        if ($partnersCount > 0) {
            response(400, 1, 'Cannot delete page. There are partners associated with this page.', []);
        }

        $exists = $this->db->get_where('anken_our_company_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Our company page not found.', []);
        }

        $deleted = $this->db->delete('anken_our_company_page', ['id' => $id]);
        if ($deleted) {
            response(200, 0, 'Our company page deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete our company page.', []);
        }
    }

    // Partners Table Operations (anken_our_company_partners)

    public function add_partner() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        // Required field validation
        $requiredFields = [
            'title_en' => 'English title',
            'title_ch' => 'Chinese title',
            'company_name_en' => 'Company Name EN',
            'company_name_ch' => 'Company Name CH',
            'our_company_page_id' => 'Our Company Page ID'
        ];

        foreach ($requiredFields as $field => $label) {
            if (!$request->$field) {
                response(403, 1, "$label cannot be empty.", []);
            }
        }

        // Verify that the our_company_page_id exists
        $pageExists = $this->db->get_where('anken_our_company_page', ['id' => $request->our_company_page_id])->row();
        if (!$pageExists) {
            response(404, 1, 'Our company page not found.', []);
        }

        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'company_name_en' => $request->company_name_en,
            'company_name_ch' => $request->company_name_ch,
            'type' => $request->type,
            'our_company_page_id' => $request->our_company_page_id,
            'status' => $request->status ?? 1
        ];

        if ($request->id && $request->id != 0) {
            $this->db->where('id', $request->id);
            $this->db->update('anken_our_company_partners', $data);
            response(200, 0, 'Partner updated successfully.', []);
        } else {
            $res = $this->db->insert('anken_our_company_partners', $data);
            if ($res) {
                response(200, 0, 'Partner added successfully.', []);
            } else {
                response(500, 1, 'Failed to insert partner.', []);
            }
        }
    }

    public function get_partners($page_id = null) {
        $this->db->select('p.*');
        $this->db->from('anken_our_company_partners p');
        
        if ($page_id) {
            $this->db->where('p.our_company_page_id', $page_id);
        }
        
        $this->db->order_by('p.id', 'ASC');
        $results = $this->db->get()->result();

        response(200, 0, 'Partners fetched successfully.', $results);
    }

    public function get_partner($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch partner.', []);
        }

        $partner = $this->db->get_where('anken_our_company_partners', ['id' => $id])->row();

        if (!$partner) {
            response(404, 1, 'Partner not found.', []);
        }

        response(200, 0, 'Partner fetched successfully.', $partner);
    }

    public function delete_partner($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete partner.', []);
        }

        $exists = $this->db->get_where('anken_our_company_partners', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Partner not found.', []);
        }

        $deleted = $this->db->delete('anken_our_company_partners', ['id' => $id]);
        if ($deleted) {
            response(200, 0, 'Partner deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete partner.', []);
        }
    }

    // Get complete page data with partners
    public function get_complete_page($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch page data.', []);
        }

        // Get page data
        $this->db->select('p.*, 
            f.id as file_id, f.file as file_name, f.directory_id as file_directory');
        $this->db->from('anken_our_company_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
        $this->db->where('p.id', $id);
        $page = $this->db->get()->row();

        if (!$page) {
            response(404, 1, 'Our company page not found.', []);
        }

        $pageArray = (array) $page;

        // Process top image
        $topImage = null;
        if (!empty($page->file_id)) {
            $filePath = ($page->file_directory == 0)
                ? "{$this->libraryPath}/{$page->file_name}"
                : "{$this->libraryPath}/{$page->file_directory}/{$page->file_name}";
            $topImage = [
                'id' => $page->file_id,
                'file' => $page->file_name,
                'directory_id' => $page->file_directory,
                'path' => $filePath
            ];
        }

        $pageArray['top_image_data'] = $topImage;
        unset($pageArray['file_id'], $pageArray['file_name'], $pageArray['file_directory']);

        // Get partners for this page
        $partners = $this->db->get_where('anken_our_company_partners', ['our_company_page_id' => $id])->result();

        $response = [
            'page' => $pageArray,
            'partners' => $partners
        ];

        response(200, 0, 'Complete page data fetched successfully.', $response);
    }
}