<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\Module\Exceptions;

use Throwable;

class PermissionDenyException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        if (request()->expectsJson()) {
            return ['code' => 401, 'message' => $this->message];
        }
        session()->flash('error', $this->getMessage());

        return redirect()->back();
    }
}
