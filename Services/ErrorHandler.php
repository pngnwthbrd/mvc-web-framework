<?php
namespace application\services;

use Services\FileLogger;
use Services\Interfaces\ErrorHandlerInterface;

class ErrorHandler implements ErrorHandlerInterface
{
        protected $log;
            
        public function __construct()
        {
                $this->log = new FileLogger();
        }

        public function shutdown()
        {
                $errorArray = error_get_last();

                if (isset($errorArray) && count($errorArray) > 0)
                {
                        $this->handleError($errorArray['type'],
                                           $errorArray['message'],
                                           $errorArray['file'],
                                           $errorArray['line']);
                }
        }

        public function handleError($type, $message, $file, $line)
        {
                $error = 0;
                $errorData = [];

                switch ($type) {
                        case E_ERROR:
                                $error++;
                                $errorData[] = [
                                        'level'     => 'FATAL_ERROR',
                                        'message'   => $message,
                                        'file'      => $file,
                                        'line'      => $line
                                ];

                                break;

                        case E_WARNING:
                                $error++;
                                $errorData[] = [
                                        'level'     => 'WARNING',
                                        'message'   => $message,
                                        'file'      => $file,
                                        'line'      => $line
                                ];

                                break;

                        case E_PARSE:
                                $error++;
                                $errorData[] = [
                                        'level'     => 'PARSE_ERROR',
                                        'message'   => $message,
                                        'file'      => $file,
                                        'line'      => $line
                                ];

                                break;

                        case E_NOTICE:
                                $error++;
                                $errorData[] = [
                                        'level'     => 'NOTICE',
                                        'message'   => $message,
                                        'file'      => $file,
                                        'line'      => $line
                                ];

                                break;

                        case E_CORE_ERROR:

                                break;

                        case E_CORE_WARNING:

                                break;

                        case E_COMPILE_ERROR:

                                break;

                        case E_USER_ERROR:

                                break;

                        case E_USER_WARNING:

                                break;

                        case E_USER_NOTICE:

                                break;

                        case E_STRICT:

                                break;

                        case E_RECOVERABLE_ERROR:

                                break;

                        case E_DEPRECATED:
                                $error++;
                                $errorData[] = [
                                        'level'     => 'DEPRECATED',
                                        'message'   => $message,
                                        'file'      => $file,
                                        'line'      => $line
                                ];

                                break;

                        case E_USER_DEPRICATED:

                                break;
                }

                if ((int)$error > 0)
                        $this->log->writeLog($errorData);
        }
}