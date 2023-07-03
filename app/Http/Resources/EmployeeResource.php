<?php

namespace App\Http\Resources;

use App\Models\Skill;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'job' => $this->job,
            'lat' => $this->lat,
            'lng' => $this->lng,

            'skills' => Skill::join('employee_skill', 'skills.id', '=', 'employee_skill.skill_id')
                ->where('employee_id', $this->id)
                ->get(['skills.name', 'employee_skill.value'])
        ];
    }
}
