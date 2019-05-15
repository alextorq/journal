<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

/**
 * Валидация добовляемого расписания
 */
class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'group_id'  => 'required',
            'user_id'   => 'required',
            'lesson_id' => 'required',
            'dateFrom'  => 'required',
            'dateTo'    => 'required',
            'day'       => 'required'
        ];
    }

    /**
     * @param  Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $this->validateTime($validator);
    }

    protected function validateTime(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $schedule = Schedule::where([
                'user_id' => $this->get('user_id'),
                'day' => $this->get('day')
            ])->get();
            $schedule->each(function (Schedule $schedule) {
                $dateFrom = new Carbon($schedule->dateFrom);
                $dateTo = new Carbon($schedule->dateFrom);

                $requestDateFrom = new Carbon($this->get('dateFrom'));
                $requestDateTo = new Carbon($this->get('dateTo'));

                if ($requestDateFrom->between($dateFrom, $dateTo)) {
                    $this->validator->errors()->add('dateFrom', 'Время начала совпадает с другим занятием.');
                    return false;
                }

                if ($requestDateTo->between($dateFrom, $dateTo)) {
                    $this->validator->errors()->add('dateFrom', 'Время завершения совпадает с другим занятием.');
                    return false;
                }
            });
        });
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}