package main

import (
    rr "github.com/spiral/roadrunner/cmd/rr/cmd"
    "github.com/spiral/roadrunner/service/headers"
    "server/hellomiddleware"
    "server/hellorpc"

    // services (plugins)
    "github.com/spiral/roadrunner/service/env"
    "github.com/spiral/roadrunner/service/http"
    "github.com/spiral/roadrunner/service/limit"
    "github.com/spiral/roadrunner/service/rpc"
    "github.com/spiral/roadrunner/service/static"

    // additional commands and debug handlers
    _ "github.com/spiral/roadrunner/cmd/rr/http"
    _ "github.com/spiral/roadrunner/cmd/rr/limit"
)

func main() {
    rr.Container.Register(env.ID, &env.Service{})
    rr.Container.Register(rpc.ID, &rpc.Service{})
    rr.Container.Register(http.ID, &http.Service{})
    rr.Container.Register(headers.ID, &headers.Service{})
    rr.Container.Register(static.ID, &static.Service{})
    rr.Container.Register(limit.ID, &limit.Service{})

    rr.Container.Register(hellomiddleware.ID, &hellomiddleware.Service{})
    rr.Container.Register(hellorpc.ID, &hellorpc.Service{})

    rr.Execute()
}