<?php

use Illuminate\Support\Facades\Broadcast;
Broadcast::channel('chat.{storeId}', function ($user, $storeId) {
    return true;
});

Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    return true; // Simplified for prototype
});
