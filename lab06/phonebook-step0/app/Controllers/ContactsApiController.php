<?php

namespace App\Controllers;

use App\Models\Contact;
use App\ApiTokenGuard;

class ContactsApiController extends Controller
{
    // Thông tin người dùng được chứng thực.
    protected $user;

    public function __construct()
    {
        $apiGuard = new ApiTokenGuard();

        if (!$apiGuard->verifyToken()) {
            send_json_fail(['message' => 'Unauthenticated'], 401);
        }

        $this->user = $apiGuard->getUser();
        parent::__construct();
    }

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

    // Hàm lấy danh sách contact.
    public function getAllContacts()
    {
        $userId = $this->user->id;
        $contacts = Contact::where('user_id', $userId)->get();
        send_json_success(['list' => $contacts]);
    }

    // Hàm tìm kiếm theo tên contact.
    public function search()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parts = parse_url($url);
        parse_str($parts['query'], $query);

        $keyword = $query['name'];
        $userId = $this->user->id;
        $result = Contact::where('user_id', $userId)
            ->where('name', 'like', '%' . $keyword . '%')
            ->get();
        send_json_success(['contact' => $result]);
    }
}
