<?php

namespace App\Validation;

use App\Models\PersonaModel;

class UsuarioValidation
{
    public function is_unique_persona(string $str, string $fields, array $data): bool
    {
        $dat = explode(',', $fields);
        $model = new PersonaModel();
        $row = $model->where(['id !=' =>  $dat[1], $dat[0] => $str])->first();
        if ($row == null) {
            return true;
        } else {
            return false;
        }
        return false;
    }
}
