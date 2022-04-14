#!/bin/bash

# This will trigger planet4-master-theme activation/deactivation hooks.
# It is meant for running one-off actions like adding custom roles and capabilities.
if (wp theme is-active planet4-master-theme) || (wp theme status | grep -q 'P planet4-master-theme'); then
  echo "Run P4_Activator..."
  wp p4-run-activator
else
  echo "Skip running P4_Activator, neither planet4-master-theme nor one of its child themes is activated."
fi
