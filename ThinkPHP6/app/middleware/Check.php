<?php
declare (strict_types = 1);

namespace app\middleware;

class Check
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许的源
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // 允许的HTTP方法
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type'); // 允许的请求头部字段
        header('Access-Control-Max-Age: 3600'); 

        if ($request->isOptions()) {
            return response('');
        }

        return $next($request);
    }
}
