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

function format_booking_status($status) {
    $statusHTML = '';
    $upperStatus = strtoupper($status);

    switch ($status) {
        case 'pending':
            $statusHTML = "<span class='label label-warning'>$upperStatus</span>";

            break;
        case 'accepted':
            $statusHTML = "<span class='label label-primary'>$upperStatus</span>";

            break;
        case 'completed':
            $statusHTML = "<span class='label label-success'>$upperStatus</span>";

            break;
        case 'rejected':
            $statusHTML = "<span class='label label-danger'>$upperStatus</span>";

            break;
    }

    return $statusHTML;
}