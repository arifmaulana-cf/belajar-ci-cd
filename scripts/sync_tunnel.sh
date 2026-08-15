#!/usr/bin/env bash
set -u
APP_DIR="/home/ubuntu/digiflora"
UNIT="cloudflared-laravel.service"
LOG="/var/log/digiflora-sync.log"

URL=""
PREV=""
for i in $(seq 1 45); do
  CUR=$(journalctl -u "$UNIT" --no-pager -n 100 2>/dev/null | grep -oE 'https://[a-z0-9-]+\.trycloudflare\.com' | tail -1)
  if [ -n "$CUR" ]; then
    if [ "$CUR" = "$PREV" ]; then
      URL="$CUR"
      break
    fi
    PREV="$CUR"
  fi
  sleep 2
done
if [ -z "$URL" ]; then
  URL="$PREV"
fi

if [ -z "$URL" ]; then
  echo "$(date) [sync] tunnel URL not found, skip" >> "$LOG"
  exit 0
fi

# Update APP_URL in .env if it changed
CURRENT=$(grep -E '^APP_URL=' "$APP_DIR/.env" | cut -d= -f2-)
if [ "$CURRENT" != "$URL" ]; then
  sed -i "s#^APP_URL=.*#APP_URL=$URL#" "$APP_DIR/.env"
fi

cd "$APP_DIR" || exit 0
/usr/bin/php artisan config:clear >/dev/null 2>&1
/usr/bin/php artisan digiflora:sync-qr >> "$LOG" 2>&1

echo "$(date) [sync] APP_URL=$URL" >> "$LOG"
echo "$URL" > "$APP_DIR/CURRENT_URL.txt"
exit 0
