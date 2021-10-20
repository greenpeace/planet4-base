#!/bin/bash

if [ "$APP_ENV" = "development" ]; then
  wp user create dtovbein tdhooper@greenpeace.org --first_name="Taylor" --last_name="Kaus - P4 team" --role=administrator --porcelain || true
fi
