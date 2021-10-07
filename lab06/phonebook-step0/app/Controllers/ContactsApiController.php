<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactsApiController extends Controller
{
    // API lấy thông tin contact từ id.
    public function getContactById($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            $this->notFound();
        }
        send_json_success(['Contact' => $contact->toArray()]);
    }

    // API thêm contact mới.
    public function create()
    {
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);

        if (!$data) {
            send_json_fail(['message' => 'Invalid data format']);
        }

        $contact = new Contact();
        if ($contact->validate($data)) {
            $contact->fill($data)->save();
            send_json_success(['contact' => $contact->toArray()]);
        } else {
            send_json_fail($contact->getErrors());
        }
    }

    // Hàm lấy data của contact để edit.
    protected function getContactData()
    {
        return [
            'name' => filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING),
            'phone' => preg_replace('/[^0-9]+/', '', $_POST['phone']),
            'notes' => filter_var(trim($_POST['notes']), FILTER_SANITIZE_STRING)
        ];
    }

    // API chỉnh sửa contact.
    public function edit($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            $this->notFound();
        }
        $data = $this->getContactData();
        if ($contact->validate($data)) {
            if ($contact->fill($data)->save()) {
                send_json_success(['contact' => $contact->toArray()]);
            } else {
                send_json_fail($contact->getErrors());
            }
        }
    }
}
