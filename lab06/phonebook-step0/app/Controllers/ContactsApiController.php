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

    // API chỉnh sửa contact.
    public function edit($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            $this->notFound();
        }

        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);

        if ($contact->validate($data)) {
            if ($contact->fill($data)->save()) {
                send_json_success(['contact' => $contact->toArray()]);
            } else {
                send_json_fail($contact->getErrors());
            }
        }
    }

    // API xóa contact.
    public function delete($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            $this->notFound();
        }
        $contact->delete();
        $message = ['success' => 'Contact deleted'];
        send_json_success(['message' => $message]);
    }
}
