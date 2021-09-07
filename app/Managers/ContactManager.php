<?php

namespace App\Managers;

use App\Models\Contact;
use App\Repositories\Contacts\ContactRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactManager
{
    /**
     * @var ContactRepository $contactRepository
     */
    private $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->contactRepository->all();
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request)
    {
        return $this->contactRepository->create($request);
    }

    /**
     * @param Contact $contact
     * @param array $request
     * @return Contact
     */
    public function update(Contact $contact, array $request = []): Contact
    {
        return $this->contactRepository->update($contact, $request);
    }

    /**
     * @param Contact $contact
     */
    public function delete(Contact $contact)
    {
        $this->contactRepository->delete($contact);
    }
}
