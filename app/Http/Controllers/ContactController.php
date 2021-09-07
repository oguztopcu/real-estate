<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Managers\ContactManager;
use App\Http\Requests\Contact\StoreRequest;
use App\Http\Requests\Contact\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @var ContactManager $contactManager
     */
    private $contactManager;

    public function __construct(ContactManager $contactManager)
    {
        $this->middleware('auth');

        $this->contactManager = $contactManager;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->contactManager->all()
        ], Response::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            $this->contactManager->create($request->only(['name', 'surname', 'email', 'phone']));
        });

        return response()->json([
            'message' => 'Kişi bilgisi başarıyla kaydedildi.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param UpdateRequest $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Contact $contact): JsonResponse
    {
        DB::transaction(function () use ($request, $contact) {
            $this->contactManager->update($contact, $request->only(['name', 'surname', 'email', 'phone']));
        });

        return response()->json([
            'message' => 'Kişi bilgisi başarıyla kaydedildi.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Contact $contact
     * @return JsonResponse
     */
    public function destroy(Contact $contact): JsonResponse
    {
        DB::transaction(function () use ($contact) {
            $this->contactManager->delete($contact);
        });

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
