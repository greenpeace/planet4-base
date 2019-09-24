#!/bin/sh

# Instantiate P4_Activator and run its functions.
# This will trigger planet4-master-theme activation/deactivation hooks.
# It is meant for running one-off actions like adding custom roles and capabilities.
wp eval '(new P4_Activator())->run();'
