package hellomiddleware

import (
	rhttp "github.com/spiral/roadrunner/service/http"
	"github.com/spiral/roadrunner/service/http/attributes"
	"net/http"
)

const ID = "hello_middleware"

type Service struct {
}

func (s *Service) Init(r *rhttp.Service) (bool, error) {
	r.AddMiddleware(s.middleware)
	return true, nil
}

func (s *Service) middleware(f http.HandlerFunc) http.HandlerFunc {
	return func(writer http.ResponseWriter, request *http.Request) {
		_ = attributes.Set(request, "RRMiddleware", "Hello World!")
		f(writer, request)
	}
}
