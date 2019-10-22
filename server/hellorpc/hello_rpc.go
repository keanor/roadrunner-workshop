package hellorpc

import "github.com/spiral/roadrunner/service/rpc"

const ID = "hellorpc"

type Service struct {
}

func (s *Service) Init(r *rpc.Service) (ok bool, err error) {
	_ = r.Register(ID, &rpcService{})
	return true, nil
}

type rpcService struct {
}

func (s *rpcService) Hello(input string, output *string) error {
	*output = "Hello from RPC"
	return nil
}
