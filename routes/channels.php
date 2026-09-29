<?php

use App\Models\Timetable;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('api.timetable_set.{id}', function ($id) {
    return true;
});
