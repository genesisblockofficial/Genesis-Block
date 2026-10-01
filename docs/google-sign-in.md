# Google sign-in setup

Google sign-in is available on the sign-in page, registration page, and guest login dialog. An admin configures the Google Client ID and Client Secret under **Website CRM → Google Sign-in**. The client secret is encrypted in the database and never displayed after saving.

In Google Cloud Console, create an OAuth client for a web application and add the callback URL shown on the admin settings page to its authorized redirect URIs. For local development, this may be `http://127.0.0.1:8000/auth/google/callback`.

Google sign-in requires a Google-verified email. New accounts receive the `customer` role; an existing account with the same verified email is linked to that Google account. OAuth does not grant roles or permissions. Removing credentials in the admin page disables Google sign-in.