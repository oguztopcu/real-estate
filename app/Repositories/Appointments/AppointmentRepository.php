<?php

namespace App\Repositories\Appointments;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AppointmentRepository
{
    /**
     * @var Appointment $model
     */
    private $model;

    /**
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->model = $appointment;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->query()->get();
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request)
    {
        return $this->model->query()->create([
            'contact_id' => $request['contact_id'],
            'address' => $request['address'],
            'appointment_date' => $request['appointment_date'],
            'postcode' => $request['postcode'],
            'est_departure_date' => $request['est_departure_date'],
            'est_arrival_date' => $request['est_arrival_date']
        ]);
    }

    public function update(Appointment $appointment, array $request): Appointment
    {
        $appointment->update([
            'contact_id' => $request['contact_id'],
            'address' => $request['address'],
            'appointment_date' => $request['appointment_date'],
            'postcode' => $request['postcode'],
            'est_departure_date' => $request['est_departure_date'],
            'est_arrival_date' => $request['est_arrival_date']
        ]);

        return $appointment;
    }

    public function delete(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
