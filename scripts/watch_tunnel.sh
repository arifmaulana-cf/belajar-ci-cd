#!/usr/bin/env bash
set -u
APP_DIR="/home/ubuntu/digiflora"
UNIT="cloudflared-laravel.service"
LOG="/var/log/digiflora-sync.log"

while true; do
  CUR=$(journalctl -u "$UNIT" --no-pager -n 100 2>/dev/null | grep -oE 'https://[a-z0-9-]+\.trycloudflare\.com' | tail -1)
  if [ -n "$CUR" ]; then
    ENV_URL=$(grep -E '^APP_URL=' "$APP_DIR/.env" | cut -d= -f2-)
    if [ "$CUR" != "$ENV_URL" ]; then
      sed -i "s#^APP_URL=.*#APP_URL=$CUR#" "$APP_DIR/.env"
      cd "$APP_DIR" || true
      /usr/bin/php artisan config:clear >/dev/null 2>&1
      /usr/bin/php artisan digiflora:sync-qr >> "$LOG" 2>&1
      echo "$CUR" > "$APP_DIR/CURRENT_URL.txt"
      echo "$(date) [watch] APP_URL synced -> $CUR" >> "$LOG"
    fi
  fi
  sleep 30
done
