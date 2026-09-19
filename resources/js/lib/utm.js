// Name kept in sync by hand with TrackUTM::COOKIE_NAME (PHP) and the
// bootstrap/app.php encryptCookies() except list.
const COOKIE_NAME = "utm_data";

export function getUtmParams() {
    const match = document.cookie.match(
        new RegExp(`(?:^|; )${COOKIE_NAME}=([^;]*)`),
    );

    if (!match) {
        return {};
    }

    try {
        const data = JSON.parse(decodeURIComponent(match[1]));
        return {
            utm_source: data.utm_source ?? null,
            utm_medium: data.utm_medium ?? null,
            utm_campaign: data.utm_campaign ?? null,
        };
    } catch {
        return {};
    }
}
