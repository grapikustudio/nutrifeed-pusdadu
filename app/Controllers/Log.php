<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    public function __construct()
    {
        $this->logModel = new LogModel();
    }
    public function doLog($category, $msg)
    {
        $this->logModel->save([
            'category' => $category,
            'log' => $msg
        ]);
        return $this;
    }
}
