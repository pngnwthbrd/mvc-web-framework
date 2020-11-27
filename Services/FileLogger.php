<?php
namespace Services;

use Services\ErrorHandler;

class FileLogger
{
        private $conf = [
                'location'          => __DIR__ . '/../logfiles/',
                'extension'         => '.log',
                'fileinfo'          => [
                        '%level',
                        '%date'
                ],
                'format'            => '%level_%date',
                'dateFormat'        => 'Y-m-d',
                'dateTimeFormat'    => 'Y-m-d H:i:s'
        ];

        public function writeLog($errorData)
        {
                if (count($errorData) > 0) {
                        foreach ($errorData as $error) {
                                $level = $error['level'];
                                $file = $error['file'];
                                $line = $error['line'];
                                $message = $error['message'];

                                $filename = $this->_prepareFilename($level);
                                $message = $this->_prepareMessage($level, $file, $line, $message);

                                file_put_contents($filename, $message, FILE_APPEND);
                        }
                }
        }

        public function writeCustomLog($customData)
        {
                $level = 'CUSTOM';
                $filename = $this->_prepareFilename($level);
                $message = $this->_prepareMessage($level, '', '', $customData['message']);

                file_put_contents($filename, $message, FILE_APPEND);
        }

        private function _prepareMessage($level, $file, $line, $message)
        {
                $return = date($this->conf['dateTimeFormat']) . "\n";
                $return .= "Level: " . $level . "\n";
                $return .= "File: " . $file . "\n";
                $return .= "Line: " . $line . "\n";
                $return .= "Message:\n\t" . $message;
                $return .= "\n\r----------------------------------------\n\r";

                return $return;
        }

        private function _prepareFilename($errorLevel)
        {
                $filenameFormat = $this->conf['format'];
                $filenameSearch = $this->conf['fileinfo'];
                $filenameReplace = [$errorLevel, date($this->conf['dateFormat'])];

                return $this->conf['location'] . str_replace($filenameSearch,
                                                             $filenameReplace,
                                                             $filenameFormat)
                                                . $this->conf['extension'];
        }
}