#!/bin/bash

set -e

# Start the Supervisor service
service supervisor start

# Execute the provided command
exec "$@"
