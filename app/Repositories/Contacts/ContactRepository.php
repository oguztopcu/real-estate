<?php

namespace App\Repositories\Contacts;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository
{
    /**
     * @var Contact $model
     */
    private $model;

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->query()->get();
    }

    public function create(array $request)
    {
        return $this->model->query()->create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'phone' => $request['phone']
        ]);
    }

    /**
     * @param Contact $contact
     * @param array $request
     * @return Contact
     */
    public function update(Contact $contact, array $request): Contact
    {
        $contact->update([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'phone' => $request['phone']
        ]);

        return $contact;
    }

    /**
     * @param Contact $contact
     */
    public function delete(Contact $contact): void
    {
        $contact->delete();
    }
}
