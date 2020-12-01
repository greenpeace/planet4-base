#!/bin/sh

wp p4-cf-key-in-db "${APP_HOSTNAME}"

wp plugin activate cloudflare
