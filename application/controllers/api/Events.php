<?php
require_once(APPPATH.'core/SecureApiController.php');

class Events extends SecureApiController {

    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
         $required = [
            'date', 'title_en', 'title_ch',
            'short_description_en', 'short_description_ch',
            'description_en', 'description_ch',
            // 'location_en', 'location_ch',
        ];
        foreach ($required as $field) {
            if (!$request->$field) {
                response(403, 1, ucfirst(str_replace('_', ' ', $field)) . ' is required.', []);
            }
        }
        

        // Prepare data
        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'location_en' => $request->location_en,
            'location_ch' => $request->location_ch,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'description_en' => $request->description_en,
            'description_ch' => $request->description_ch,
            'date' => $request->date,
            'status' => $request->status ?? 1,
            'position' => $request->position ?? 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($request->id && $request->id != 0) {
            // Update existing
            $this->db->where('id', $request->id);
            $this->db->update('anken_events', $data);
            response(200, 0, 'Event updated successfully.', []);
        } else {
            // Insert new
            $data['created_at'] = date('Y-m-d H:i:s');
            $res = $this->db->insert('anken_events', $data);
            if ($res) {
                response(200, 0, 'Event added successfully.', []);
            } else {
                response(500, 1, 'Failed to insert event.', []);
            }
        }
    }

    public function get() {
        $this->db->from('anken_events');
        $this->db->order_by('position', 'ASC');
        $results = $this->db->get()->result();

        if ($results) {
            response(200, 0, 'Events fetched successfully.', $results);
        } else {
            response(200, 0, 'No events found.', []);
        }
    }

    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete an event.', []);
        }

        $exists = $this->db->get_where('anken_events', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Event not found.', []);
        }

        $deleted = $this->db->delete('anken_events', ['id' => $id]);
        if ($deleted) {
            response(200, 0, 'Event deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete event.', []);
        }
    }
}

