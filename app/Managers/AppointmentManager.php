<?php

namespace App\Managers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Repositories\Appointments\AppointmentRepository;
use App\Services\Postcode\Postcode;
use App\Services\RealEstate\RealEstate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class AppointmentManager
{
    /**
     * @var AppointmentRepository $appointmentRepository
     */
    private $appointmentRepository;

    /**
     * @var Postcode $postcodeService
     */
    private $postcodeService;

    /**
     * @var DistanceMatrix $distanceMatrix
     */
    private $distanceMatrix;

    /**
     * @param AppointmentRepository $appointmentRepository
     * @param Postcode $postcodeService
     */
    public function __construct(AppointmentRepository $appointmentRepository, Postcode $postcodeService)
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->postcodeService = $postcodeService;
        $this->distanceMatrix = new DistanceMatrix(new StandardLicense(env('GOOGLE_KEY')));
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->appointmentRepository->all();
    }

    /**
     * @param array $request
     * @return Model
     */
    public function create(array $request)
    {
        $request = $this->getRequest($request);

        return $this->appointmentRepository->create($request);
    }

    /**
     * @param Appointment $appointment
     * @param array $request
     * @return Appointment
     */
    public function update(Appointment $appointment, array $request): Appointment
    {
        $request = $this->getRequest($request);

        return $this->appointmentRepository->update($appointment, $request);
    }

    /**
     * @param Appointment $appointment
     */
    public function delete(Appointment $appointment): void
    {
        $this->appointmentRepository->delete($appointment);
    }

    /**
     * @param string $postcode
     * @return array|null
     */
    private function getCoordinate(string $postcode): ?array
    {
        $response = collect($this->postcodeService->lookup($postcode)['result']);

        return $response->only(['latitude', 'longitude'])->values()->reverse()->toArray();
    }

    /**
     * @param array $currentCoordinate
     * @param array $targetCoordinate
     * @return int|null
     */
    private function getDuration(array $currentCoordinate, array $targetCoordinate): ?int
    {
        $distance = $this->distanceMatrix
            ->addOrigin(
                implode(',', $currentCoordinate)
            )
            ->addDestination(
                implode(',', $targetCoordinate)
            )
            ->request();

        return $distance->row()->element()->duration();
    }

    /**
     * @param array $request
     * @return array
     */
    protected function getRequest(array $request): array
    {
        $appointmentDate = Carbon::createFromFormat('d/m/Y H:i', $request['appointment_date']);
        $request['appointment_date'] = $appointmentDate->format('Y-m-d H:i');

        $coordinate = $this->getCoordinate($request['postcode']);
        $duration = $this->getDuration(RealEstate::getCoordinates(), $coordinate);

        $departureDate = Carbon::parse($appointmentDate)->subSeconds($duration);
        $arrivalDate = Carbon::parse($appointmentDate)->addHour()->addSeconds($duration);

        $request['est_departure_date'] = $departureDate->format('Y-m-d H:i');
        $request['est_arrival_date'] = $arrivalDate->format('Y-m-d H:i');

        return $request;
    }
}
