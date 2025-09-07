# Midtrans Payment Integration - Setup Guide

This guide will help you complete the setup of Midtrans payment integration for your Laravel hotel booking system.

## Prerequisites

1. **Midtrans Account**: You need a Midtrans account (sandbox for testing, production for live)
2. **Laravel Project**: Your Laravel project should be properly set up
3. **Database**: MySQL database should be configured and running

## Step 1: Get Midtrans Credentials

1. Go to [Midtrans Dashboard](https://dashboard.midtrans.com/)
2. Login or create an account
3. Navigate to **Settings > Access Keys**
4. Copy your:
   - **Merchant ID**
   - **Client Key** (starts with `SB-Mid-client-` for sandbox)
   - **Server Key** (starts with `SB-Mid-server-` for sandbox)

## Step 2: Configure Environment Variables

Update your `.env` file with your Midtrans credentials:

```env
# Midtrans Configuration
MIDTRANS_MERCHANT_ID=your_merchant_id_here
MIDTRANS_CLIENT_KEY=SB-Mid-client-your_actual_client_key_here
MIDTRANS_SERVER_KEY=SB-Mid-server-your_actual_server_key_here
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

**Important**: Replace the placeholder values with your actual Midtrans credentials!

## Step 3: Run Database Migrations

Execute the following commands in your project root:

```bash
# Run the new migrations
php artisan migrate

# If you encounter issues with the enum column, you might need to:
php artisan migrate:fresh --seed
```

## Step 4: Clear Application Cache

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Regenerate optimized files
php artisan config:cache
php artisan route:cache
```

## Step 5: Test the Payment Flow

1. **Create a reservation** through your booking system
2. **Navigate to payment page** using the generated link
3. **Fill payment form** with test data
4. **Use Midtrans test credentials** for payment

### Test Credit Card Numbers (Sandbox)
- **Success**: 4811 1111 1111 1114
- **Failure**: 4911 1111 1111 1113
- **Challenge**: 4411 1111 1111 1118

### Test CVV and Expiry
- **CVV**: Any 3 digits (e.g., 123)
- **Expiry**: Any future date (e.g., 12/25)

## Step 6: Configure Webhooks (Important for Production)

1. Go to **Midtrans Dashboard > Settings > Configuration**
2. Set **Payment Notification URL** to:
   ```
   https://yourdomain.com/payment/midtrans/callback
   ```
3. Set **Finish Redirect URL** to:
   ```
   https://yourdomain.com/payment/success
   ```
4. Set **Error Redirect URL** to:
   ```
   https://yourdomain.com/payment/failed
   ```
5. Set **Pending Redirect URL** to:
   ```
   https://yourdomain.com/payment/pending
   ```

## How the Payment System Works

### 1. **Payment Initiation**
- User completes booking
- System generates reservation
- User is redirected to payment page (`/payment/{reservasi}`)

### 2. **Payment Processing**
- User fills billing information
- System creates Midtrans transaction via `MidtransService`
- Midtrans Snap popup opens with payment options

### 3. **Payment Completion**
- User completes payment
- Midtrans sends notification to webhook (`/payment/midtrans/callback`)
- System updates transaction status
- User is redirected to appropriate page (success/pending/failed)

## Payment Status Flow

```
pending → settlement/capture → sukses (confirmed reservation)
pending → deny/cancel/expire → gagal (cancelled reservation)
pending → challenge → manual review required
```

## File Structure

```
app/
├── Services/MidtransService.php      # Main payment service
├── Http/Controllers/Payment/         # Payment controllers
├── Models/Transaksi.php             # Transaction model
config/midtrans.php                  # Midtrans configuration
resources/views/payment/             # Payment views
├── show.blade.php                   # Payment form
├── success.blade.php               # Success page
├── pending.blade.php               # Pending page
└── failed.blade.php                # Failed page
```

## Troubleshooting

### Common Issues:

1. **"Client key not found"**
   - Check your `.env` file has correct MIDTRANS_CLIENT_KEY
   - Run `php artisan config:clear`

2. **"Server key not found"**
   - Check your MIDTRANS_SERVER_KEY in `.env`
   - Ensure it starts with `SB-Mid-server-` for sandbox

3. **Payment popup doesn't open**
   - Check browser console for JavaScript errors
   - Ensure Midtrans Snap JS is loaded correctly
   - Verify CSRF token is included

4. **Webhook not receiving notifications**
   - Check your webhook URL is publicly accessible
   - Verify the URL in Midtrans dashboard
   - Check server logs for errors

5. **Database errors**
   - Run migrations: `php artisan migrate`
   - Check database connection
   - Verify table structure matches model

### Debug Mode:

Enable debug logging in `MidtransService.php`:

```php
// Add this in methods for debugging
\Log::info('Midtrans Response:', $response);
```

## Security Considerations

1. **Never expose Server Key** in frontend code
2. **Validate webhook notifications** using Midtrans signature
3. **Use HTTPS** in production
4. **Sanitize user inputs** (already implemented)
5. **Keep libraries updated**

## Production Checklist

- [ ] Replace sandbox credentials with production keys
- [ ] Set `MIDTRANS_IS_PRODUCTION=true`
- [ ] Configure production webhook URLs
- [ ] Test all payment methods
- [ ] Implement proper error handling
- [ ] Set up monitoring and logging
- [ ] Configure SSL certificate

## Support

If you need help:
1. Check [Midtrans Documentation](https://docs.midtrans.com/)
2. Review server logs
3. Test with Midtrans sandbox first
4. Contact Midtrans support for payment-specific issues

---

**Note**: This integration supports all major Indonesian payment methods including:
- Credit/Debit Cards
- Bank Transfer (Virtual Account)
- E-Wallets (GoPay, ShopeePay, DANA, LinkAja, OVO)
- Convenience Store payments
