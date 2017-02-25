<?php

function set_active($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function number_of_bookings($userId, $status) {
    if ($status === 'all') {
        return \App\Models\Booking::where('user_id', $userId)->count();
    }

    return \App\Models\Booking::where('status', $status)
        ->where('user_id', $userId)->count();
}