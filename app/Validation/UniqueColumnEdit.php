<?php

namespace App\Validation;

use App\Models\LinkModel;

class UniqueColumnEdit
{
    public function is_unique_edit(string $str, string $fields, array $data): bool
    {
        $dat = explode(',', $fields);
        $model = new LinkModel();
        $row = $model->where(['id !=' =>  $dat[1], $dat[0] => $str])->first();
        if ($row == null) {
            return true;
        } else {
            return false;
        }
    }
}
