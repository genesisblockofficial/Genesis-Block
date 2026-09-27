# Indicator access and payments

## Configure Stripe

The preferred configuration path is **Admin → Website CRM → Stripe Settings**. Add the Test and Live publishable keys, secret keys and webhook signing secrets separately, select the active environment and save. Saved secret values are encrypted in the database; the form never reloads or displays them. Leave a secret field blank to keep its saved value, or use the remove toggle to delete that environment's secrets.

The active environment cannot be selected until its secret key and webhook signing secret are configured. Each purchase records the environment used at checkout, and webhook verification checks both saved signing secrets so switching modes does not invalidate already-open orders.

For bootstrap/local development only, environment-variable fallback is supported if no admin Stripe settings have been saved. Never commit live credentials.

```dotenv
STRIPE_MODE=test
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
INDICATOR_ADMIN_EMAIL=admin@example.com
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=...
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS=...
MAIL_FROM_NAME="Genesis Block"
APP_URL=https://your-public-domain.example
```

`INDICATOR_ADMIN_EMAIL` receives notifications for free-access requests. Configure a real mail transport; the project example defaults to `MAIL_MAILER=log`.

After changing environment values, run `php artisan config:clear` (or rebuild the config cache for production).

## Stripe setup

1. Start with Stripe test-mode API keys.
2. Register `https://your-public-domain.example/stripe/webhook` as a webhook endpoint.
3. Subscribe to `checkout.session.completed`, `checkout.session.async_payment_succeeded`, `checkout.session.async_payment_failed`, and `checkout.session.expired`.
4. Copy the endpoint signing secret into `STRIPE_WEBHOOK_SECRET`.
5. For local testing, run `stripe listen --forward-to http://127.0.0.1:8000/stripe/webhook` and use the `whsec_...` value printed by the Stripe CLI.

Checkout uses USD and the indicator's admin-configured price in cents. The amount is read from the database on the server; browser-supplied prices are ignored. Orders remain pending until the signed webhook or verified Stripe success lookup confirms the amount, currency and purchase metadata.

## Admin workflow

1. Add an indicator under **Website CRM → Indicators**. Store its TradingView invite/access URL in the private access URL field; that URL is not rendered on the public page.
2. Add recent examples under **Website CRM → Trade Setups** and publish them when ready.
3. Free access requests appear under **Website CRM → Free Access Requests**. The configured admin receives an email; use **Approve & send access** to email the TradingView URL to the requester.
4. Successful paid checkouts appear under **Website CRM → Indicator Purchases** as paid. Review the order, then use **Approve & send access** to send the URL.

Free-request and paid-access emails require a working mail transport. With Laravel's default `MAIL_MAILER=log`, messages are written to the application log instead of delivered to inboxes. Switch to SMTP, SES, Postmark or another configured mail transport for real users.
