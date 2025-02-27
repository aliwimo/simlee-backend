<?php

namespace App\Http\Requests;

use App\Models\League;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property int $teams_number
 * @property int $season
 */
class StoreLeagueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'teams_number' => ['required', 'integer', 'min:4', 'max:20'],
            'season' => ['required', 'integer', 'min:2000', 'max:2100'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = League::query()
                ->where('name', $this->name)
                ->where('season', $this->season)
                ->exists();

            if ($exists) {
                $validator->errors()->add('name', 'A league with this name already exists for the selected season.');
            }
        });
    }
}
