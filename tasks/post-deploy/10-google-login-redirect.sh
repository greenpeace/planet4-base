#!/bin/bash

echo "Force to redirect to Google login page..."
wp option patch insert planet4_features enforce_sso on

