# Google reCAPTCHA Setup Guide

This guide explains how to set up Google reCAPTCHA for the login and register pages in your Laravel application.

## Prerequisites

The reCAPTCHA system has been implemented in the following pages:
- Front-end Login page (`/login`)
- Front-end Register page (`/register`) 
- Admin Login page (`/admin/login`)

## Configuration Steps

### 1. Get Google reCAPTCHA Keys

1. Visit [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Click "Create" to add a new site
3. Choose reCAPTCHA v2 → "I'm not a robot" Checkbox
4. Add your domain(s) (e.g., `localhost`, `yourdomain.com`)
5. Copy the **Site Key** and **Secret Key**

### 2. Update Environment Variables

Open your `.env` file and update the reCAPTCHA configuration:

```env
# Google reCAPTCHA
NOCAPTCHA_SITEKEY=your_actual_site_key_here
NOCAPTCHA_SECRET=your_actual_secret_key_here
```

Replace:
- `your_site_key_here` with your actual Site Key from Google
- `your_secret_key_here` with your actual Secret Key from Google

### 3. Clear Configuration Cache

After updating the `.env` file, run:

```bash
php84 artisan config:cache
```

## Features Implemented

### Frontend Changes

1. **Login Form** (`resources/views/front/login/index.blade.php`)
   - Added reCAPTCHA widget below password field
   - Added error display for reCAPTCHA validation

2. **Register Form** (`resources/views/front/register/index.blade.php`)
   - Added reCAPTCHA widget before the agreement checkbox
   - Added error display for reCAPTCHA validation

3. **Admin Login Form** (`resources/views/admin/login.blade.php`)
   - Added reCAPTCHA widget below password field
   - Added error display for reCAPTCHA validation

### Backend Changes

1. **LoginController** (`app/Http/Controllers/LoginController.php`)
   - Updated `clientLogin()` method to validate reCAPTCHA
   - Updated `AdminLogin()` method to validate reCAPTCHA
   - Added custom error messages for reCAPTCHA validation

2. **FrontController** (`app/Http/Controllers/FrontController.php`)
   - Updated `register()` method to validate reCAPTCHA
   - Added custom error messages for reCAPTCHA validation

## Testing

### For Development/Testing

If you're testing locally and don't want to use real reCAPTCHA keys, you can use these test keys:

```env
# Test keys (will always pass - USE ONLY FOR DEVELOPMENT)
NOCAPTCHA_SITEKEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
NOCAPTCHA_SECRET=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

**Important**: These test keys should NEVER be used in production!

### For Production

Always use your actual Google reCAPTCHA keys in production.

## Validation Rules

The system validates:
- `g-recaptcha-response` field is required
- `g-recaptcha-response` passes Google's captcha validation

Error messages:
- "Please verify that you are not a robot." (when reCAPTCHA is not completed)
- "Captcha error! Please try again later or contact site admin." (when reCAPTCHA validation fails)

## Optional: Using the Recaptcha Middleware

A `RecaptchaMiddleware` has been created and registered for future use. You can apply it to any routes that need reCAPTCHA protection:

```php
// In your routes/web.php file
Route::post('/contact', [ContactController::class, 'store'])->middleware('recaptcha');

// Or for a group of routes
Route::middleware('recaptcha')->group(function () {
    Route::post('/contact', [ContactController::class, 'store']);
    Route::post('/feedback', [FeedbackController::class, 'store']);
});
```

This middleware will automatically validate reCAPTCHA for all POST requests in the protected routes.

## Troubleshooting

1. **reCAPTCHA not showing**: Check if the Site Key is correct in `.env`
2. **Validation always fails**: Check if the Secret Key is correct in `.env`
3. **Domain errors**: Make sure your domain is registered in Google reCAPTCHA console
4. **Localhost issues**: Add `localhost` and `127.0.0.1` to your reCAPTCHA domain list

## Security Notes

- Never commit real reCAPTCHA keys to version control
- Use different keys for development and production environments
- Regularly monitor your reCAPTCHA usage in Google's admin console
