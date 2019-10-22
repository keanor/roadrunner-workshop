#!/bin/bash
docker run --interactive --tty --ignore-platform-reqs \
    --volume $(pwd)/application:/app \
    composer:latest \
    composer install
