#!/bin/bash

echo "Force to redirect to Google login page..."
wp option patch update galogin ga_auto_login 1
