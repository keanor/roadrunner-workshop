#!/bin/bash
docker run \
    --rm \
    --volume $(pwd)/server:/go/src/server \
    --workdir /go/src/server \
    golang:1.13 \
    go build && \
cp server/server application/rr