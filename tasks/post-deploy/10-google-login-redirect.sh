#!/bin/bash

echo "Force to redirect to Google login page..."
wp option patch update planet4_features enforce_sso on
