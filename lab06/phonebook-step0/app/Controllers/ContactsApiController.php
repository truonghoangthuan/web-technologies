<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactsApiController extends Controller
{
    public function getContactById($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            $this->notFound();
        }
        send_json_success(['Contact' => $contact->toArray()]);
    }

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
}
