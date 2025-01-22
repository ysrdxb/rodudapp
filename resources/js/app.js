import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: '0c55a8594547a8df8889',
    cluster: 'ap2',
    forceTLS: true
});

echo.private('admin-channel')
    .listen('NewOrderPlacedEvent', (event) => {
        alert('event');

        document.getElementById('notificationContent').textContent = `A new order has been placed by ${event.user_name}. Order ID: ${event.order_id}`;
        document.getElementById('viewOrderBtn').setAttribute('href', event.url);

        $('#notificationModal').modal('show');
    });


