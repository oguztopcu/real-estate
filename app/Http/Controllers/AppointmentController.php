<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Managers\AppointmentManager;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentManager $appointmentManager
     */
    private $appointmentManager;

    /**
     * @param AppointmentManager $appointmentManager
     */
    public function __construct(AppointmentManager $appointmentManager)
    {
        $this->middleware('auth');

        $this->appointmentManager = $appointmentManager;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->appointmentManager->all()
        ], Response::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            $this->appointmentManager->create($request->validated());
        });

        return response()->json([
            'message' => 'Randevu başarıyla oluşturuldu.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param UpdateRequest $request
     * @param Appointment $appointment
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Appointment $appointment): JsonResponse
    {
        DB::transaction(function () use ($request, $appointment) {
            $this->appointmentManager->update($appointment, $request->validated());
        });

        return response()->json([
            'message' => 'Randevu başarıyla güncellendi.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Appointment $appointment
     * @return JsonResponse
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        DB::transaction(function () use ($appointment) {
            $this->appointmentManager->delete($appointment);
        });

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
