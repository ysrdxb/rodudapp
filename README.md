# Laravel Order Management Application

## Overview
This Laravel application simplifies order management with features for both users and administrators. It leverages Livewire for dynamic user interfaces and Pusher for real-time notifications.

## Features
- User and Admin authentication
- Order creation, tracking, and management
- Real-time notifications
- Email communications
- User management (Admin)
- Search and filtering capabilities

## Architecture
### Routes
- **Web (web.php):** Handles user dashboard, authentication, and profile management.
- **Admin (admin.php):** Manages admin dashboard, user management, and order operations.
- **API (api.php):** Provides RESTful endpoints for orders secured with Sanctum.

## Components
### User Components
- **Order Management (App\Livewire\User\OrderManagement):**
  - Create, view, edit, delete, and search orders.
  - Track order status with real-time updates and form validation.

### Admin Components
- **Order Management (App\Livewire\Admin\Orders\OrderManagement):**
  - View, update, search, and filter orders.
  - Send messages to users and access detailed order information.
- **User Management (App\Livewire\Admin\Users\Index):**
  - Add, edit, delete, and search users with pagination.

## Notifications
- **Real-Time Notifications (App\Notifications\NewOrderPlaced):** Alerts admins for new orders and updates.
- **Email Communications (App\Mail\OrderMessage):** Sends customizable order-related emails to users.

## API Integration
- **Order Controller (App\Http\Controllers\Api\OrderController):**
  - Handles order creation, updates, deletion, and listing.
  - Validates input and ensures authentication.

## Usage
### For Users
1. Log in to the user dashboard.
2. Create, view, edit, or delete orders.
3. Track order statuses.

### For Admins
1. Access the admin dashboard.
2. Monitor real-time notifications for orders.
3. Manage orders: update statuses, send messages, and view details.
4. Manage users: add, edit, delete, and search users.

## Requirements
- Laravel framework
- Livewire
- Pusher account (for real-time notifications)
- Mail server configuration
- MySQL database

## Security
- Authentication middleware
- Sanctum API token authentication
- Role-based access control
- Form validation and CSRF protection